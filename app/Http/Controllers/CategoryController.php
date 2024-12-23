<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cates = Category::with([
            'posts' => function ($query) {
                $query->take(4);  // Giới hạn mỗi thể loại chỉ lấy 4 bài viết
            }
        ])->get();
        return view('admin.categories.index')->with(compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'theloaitruyen' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('status', 'Danh mục đã được thêm thành công!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cate = Category::find($id);
        return view('admin.categories.show', ['Category' => $cate, 'Category' => $cate->cate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Category::find($id);
        return view('admin.categories.edit')->with(compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'theloaitruyen' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->theloaitruyen = $validatedData['theloaitruyen'];
        $category->is_active = $validatedData['is_active'];
        $category->update($validatedData);
        $category->save();

        return redirect()->route('admin.categories.index')->with('status', 'Cập nhật danh mục thành công!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Xoá thành công Truyện');
    }
    public function filterByCategory($categoryId)
    {
        if ($categoryId == 'all') {
            // Lấy tất cả các bài viết nếu chọn "Tất cả"
            $posts = Post::all();
        } else {
            // Lấy bài viết theo thể loại
            $category = Category::with('posts')->find($categoryId);
            $posts = $category ? $category->posts : [];
        }

        // Trả về JSON
        return response()->json([
            'posts' => $posts
        ]);
    }
    public function showCategories()
    {
        $category = Category::where('name', 'Ngôn Tình')->first(); // Chỉ lấy 1 thể loại "Ngôn Tình"
        return view('admin.posts.show', compact('cate'));
    }
}
