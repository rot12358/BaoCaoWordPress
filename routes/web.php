<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Post;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $categories = Category::all();
    return view('category', compact('categories'));
});
// Route::get('/posts', function () {
//     $posts = Post::all();
//     return view('posts.post', compact('posts'));
// });
// Route::get('/adminbaiviet', function () {
//     $posts = Post::all();
//         return view('posts.post', compact('posts'));
// });
Route::get('/sanpham', function () {
    $posts = Post::all();
    return view('posts.show', compact('posts'));
});
Route::get('/post/{id}', function ($id) {
    $post = Post::find($id); // Tìm bài viết theo $id
    if (!$post) {
        abort(404); // Nếu không tìm thấy bài viết, trả về trang 404
    }
    return view('show.show', ['post' => $post]); // Truyền dữ liệu bài viết sang view
});
//Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
    Route::patch('/admin/users/{user}/{role}', [AdminController::class, 'changeRole'])->name('admin.users.changeRole');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home')->middleware('role:admin');
    // Trang user (đọc truyện)
    Route::get('/home', [UserController::class, 'index'])->name('user.home')->middleware('role:user');
    // Trang Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');  // Hiển thị chi tiết đơn hàng
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    //Thêm sửa xoá Sản Phẩm
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/sanpham', [PostController::class, 'store'])->name('admin.posts.store');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    // Thêm sửa xoá categories
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::put('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});
//Order trạng thái
Route::prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function () {
    Route::resource('orders', OrderController::class)->only(['index', 'update']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
// Route để Admin nâng cấp tài khoản user thành Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/make-admin/{id}', [UserController::class, 'makeAdmin'])->name('admin.makeAdmin');
});
// Úp Admin , User
Route::get('admin/change-role/{userId}/{role}', [AdminController::class, 'changeRole']);
Route::post('/admin/{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
Route::post('/admin/{user}/make-user', [AdminController::class, 'makeUser'])->name('admin.makeUser');
// Create User Admin
Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
// Profile 
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Chuyển hướng về trang chủ
})->name('logout');

Auth::routes();
// Route::get('/posts/create', 'PostController')->name('create');
Route::post('/', 'PostController@store')->name('posts.show');
// Route::get('/', [PostController::class, 'index']);
// Route::get('/posts/{id}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
// Route::get('/', [CategoryController::class, 'index']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [PostController::class, 'show'])->name('show.show');
//Trang Hổ Trợ gửi báo cáo
Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support', [SupportController::class, 'sendSupportRequest'])->name('support.send');
// routes/web.php
Route::resource('post', PostController::class);

// Route::get('/posts', 'PostController@index')->name('posts.index');
// phân loại thể loại
Route::get('/filter-category/{categoryId}', [CategoryController::class, 'filterByCategory']);

// Giỏ hàng
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update-quantity/{item}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::patch('/checkout/update-quantity/{item}', [CheckoutController::class, 'updateQuantity'])->name('checkout.updateQuantity');
});

Route::get('/detail/{id}', [PostController::class, 'showDetail'])->name('detail.show');






