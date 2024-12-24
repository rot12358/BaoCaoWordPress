<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Middleware kiểm tra quyền admin
    }

    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        // Lấy đơn hàng cùng với các order_items
        $order = Order::with('orderItems.post')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái từ request
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    public function placeOrder(Request $request)
    {
        // Lấy giỏ hàng của người dùng
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get();

        // Kiểm tra nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính tổng giá trị đơn hàng
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->post->gia;
        });

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => auth()->id(),
            'gia' => $total, // Gán tổng giá trị vào order
            'status' => 'đang xử lý', // Đặt trạng thái là 'đang xử lý'
        ]);

        // Thêm các sản phẩm vào đơn hàng
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'post_id' => $item->post_id,  // ID sản phẩm
                'quantity' => $item->quantity, // Số lượng
                'gia' => $item->post->gia, // Giá mỗi sản phẩm
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng
        CartItem::where('user_id', auth()->id())->delete();

        // Chuyển hướng người dùng đến trang thành công với thông báo
        return redirect()->route('admin.orders.success')->with('success', 'Đặt hàng thành công!');
    }
    public function success()
    {
        return view('order.success');
    }
}
