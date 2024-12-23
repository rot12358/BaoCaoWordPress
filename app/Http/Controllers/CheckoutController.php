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
        // Lấy giỏ hàng của người dùng
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get(); // Lấy thông tin sản phẩm từ cart

        // Tính tổng giá trị đơn hàng
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->post->gia);

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => auth()->id(),
            'gia' => $total, // Gán tổng giá trị vào order
        ]);

        // Thêm các sản phẩm vào đơn hàng
        foreach ($cartItems as $item) {
            // Lưu từng sản phẩm vào order_items
            $order->orderItems()->create([
                'post_id' => $item->post_id,  // ID sản phẩm
                'quantity' => $item->quantity, // Số lượng
                'gia' => $item->post->gia, // Giá mỗi sản phẩm
            ]);
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng
        CartItem::where('user_id', auth()->id())->delete();

        // Chuyển hướng người dùng đến trang thành công
        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
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
