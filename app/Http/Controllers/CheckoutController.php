<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all(); // Hoặc lấy từ session, database tùy vào cách lưu trữ giỏ hàng
        return view('checkout.index', compact('cartItems'));
    }
    public function checkout()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        // Validate thông tin người dùng
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        // Lấy thông tin giỏ hàng
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get();

        // Kiểm tra nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => auth()->id(),
            'gia' => $cartItems->sum(function ($item) {
                return $item->quantity * $item->post->gia;
            }),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
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

        // Chuyển hướng đến trang thanh toán thành công
        return redirect()->route('admin.orders.success')->with('success', 'Đặt hàng thành công!');
    }
    public function updateQuantity(Request $request, $itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $action = $request->input('action');
            if ($action == 'increase') {
                $item->quantity += 1;
            } elseif ($action == 'decrease' && $item->quantity > 1) {
                $item->quantity -= 1;
            }
            $item->save();
        }
        return redirect()->back();
    }

}
