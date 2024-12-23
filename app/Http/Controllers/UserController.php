<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users')); // Tạo file view 'admin.home'
    }
    public function create()
    {
        return view('admin.users.create'); // Tạo file view 'admin.users.create'
    }

    // Lưu tài khoản mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Tạo tài khoản mới
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công!');
    }


}

