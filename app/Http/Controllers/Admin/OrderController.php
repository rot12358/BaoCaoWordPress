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
    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->status = ($order->status == 'pending') ? 'finished' : 'pending';
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated!');
    }
    public function placeOrder(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get(); // Lấy thông tin sản phẩm từ cart

        // Tính tổng giá trị đơn hàng
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->post->gia); // Tính tổng từ giỏ hàng

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => auth()->id(),
            'gia' => $total, // Gán tổng giá trị vào order
        ]);

        // Thêm các sản phẩm vào đơn hàng
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'post_id' => $item->post_id,
                'quantity' => $item->quantity,
                'gia' => $item->post->gia,
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng
        CartItem::where('user_id', auth()->id())->delete();

        // Chuyển hướng người dùng đến trang thành công
        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }

    public function success()
    {
        return view('order.success');
    }
}
