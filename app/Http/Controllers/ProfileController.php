<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Đảm bảo người dùng phải đăng nhập
    }

    public function showProfile()
    {
        $user = auth()->user(); // Lấy thông tin người dùng hiện tại
        return view('profile', compact('user')); // Truyền dữ liệu vào view
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

}

