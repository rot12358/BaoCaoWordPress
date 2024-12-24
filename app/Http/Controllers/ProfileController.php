<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Đảm bảo người dùng phải đăng nhập
    }
    public function showProfile()
    {
        // Lấy thông tin người dùng và các đơn hàng của họ
        $user = auth()->user();  // Lấy người dùng hiện tại
        $orders = $user->orders;  // Lấy tất cả đơn hàng của người dùng

        // Trả về view với thông tin đơn hàng
        return view('profile.profile', compact('user', 'orders'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Xác thực dữ liệu nhập vào
        $request->validate([
            'phone' => 'nullable|numeric', // Kiểm tra số điện thoại
            'address' => 'nullable|string|max:255', // Kiểm tra địa chỉ
        ]);

        // Cập nhật thông tin
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.show')->with('success', 'Thông tin đã được cập nhật!');
    }
    public function showOrders()
    {
        $user = auth()->user();

        // Lấy danh sách đơn hàng kèm trạng thái
        $orders = $user->orders()->with('orderItems.post')->get();

        return view('profile.orders', compact('user', 'orders'));
    }

    public function orderDetails($id)
    {
        $user = auth()->user();

        // Lấy chi tiết đơn hàng
        $order = $user->orders()->with('orderItems.post')->findOrFail($id);

        return view('profile.orderDetails', compact('order'));
    }
}

