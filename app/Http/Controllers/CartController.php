<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all(); // Hoặc lấy từ session, database tùy vào cách lưu trữ giỏ hàng
        return view('checkout.index', compact('cartItems'));
    }

    // Xử lý đặt hàng
    public function placeOrder(Request $request)
    {
        // Logic để xử lý thanh toán và đặt hàng
        return redirect()->route('checkout.success'); // Redirect đến trang thành công hoặc trang khác
    }
    public function add(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'post_id' => $request->post_id,
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $request->quantity),
            ]
        );

        return redirect()->route('cart.view')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('post')->get();
        return view('cart.view', compact('cartItems'));
    }

    public function remove($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->delete();
        }
        return redirect()->back();
    }

    // Cập nhật số lượng sản phẩm
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

