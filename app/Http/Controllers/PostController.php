<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('admin.posts.index')->with(compact('posts'));
    }

    public function create()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.create', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tentruyen' => 'required|string|max:255',
            'anhgioithieu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theloai' => 'required|string|max:255',
            'thongtingioithieu' => 'required|string',
            'gia' => 'required|numeric',
            'tacgia' => 'required|string|max:255',
            'nxb' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('anhgioithieu')) {
            $image = $request->file('anhgioithieu');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['anhgioithieu'] = 'images/' . $imageName;
        }

        Post::create($validatedData);

        return redirect()->route('admin.posts.index')->with('status', 'Truyện đã được thêm thành công!');
    }

    public function show($id)
    {
        $posts = Post::find($id);
        return view('show.show', ['post' => $posts, 'anhgioithieu' => $posts->anhgioithieu]);
    }

    public function showDetail($id)
    {
        // Find the post by its ID
        $post = Post::findOrFail($id);

        // Fetch posts from the same category, excluding the current post
        $relatedPosts = $post->category->posts()->where('id', '!=', $id)->take(6)->get();

        // Pass the post, related posts, and image URL to the view
        return view('detail', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'anhgioithieu' => $post->anhgioithieu // Pass the image URL
        ]);
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('admin.posts.index')->with('error', 'Post not found');
        }

        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'tentruyen' => 'required|string|max:255',
            'anhgioithieu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theloai' => 'required|string|max:255',
            'thongtingioithieu' => 'required|string',
            'gia' => 'required|numeric',
            'tacgia' => 'required|string|max:255',
            'nxb' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Tìm bài viết cần cập nhật
        $post = Post::findOrFail($id);

        // Cập nhật các thông tin khác của bài viết
        $post->tentruyen = $validatedData['tentruyen'];
        if ($request->hasFile('anhgioithieu')) {
            // Xóa ảnh cũ nếu tồn tại
            if (!empty($post->anhgioithieu) && file_exists(public_path($post->anhgioithieu))) {
                unlink(public_path($post->anhgioithieu));
            }

            // Lưu ảnh mới
            $image = $request->file('anhgioithieu');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Cập nhật đường dẫn ảnh mới
            $post->anhgioithieu = 'images/' . $imageName;
        }
        // Cập nhật các thông tin còn lại
        $post->theloai = $validatedData['theloai'];
        $post->thongtingioithieu = $validatedData['thongtingioithieu'];
        $post->gia = $validatedData['gia'];
        $post->tacgia = $validatedData['tacgia'];
        $post->nxb = $validatedData['nxb'];
        $post->category_id = $validatedData['category_id'];

        // Lưu bài viết
        $post->save();

        return redirect()->route('admin.posts.index')->with('status', 'Cập nhật truyện thành công!');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Xóa ảnh nếu có
        if ($post->anhgioithieu && file_exists(public_path($post->anhgioithieu))) {
            unlink(public_path($post->anhgioithieu));
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Xoá bài viết thành công!');
    }
}
