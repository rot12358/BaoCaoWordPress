<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {

        return view('admin.home');
    }
    public function makeAdmin(User $user)
    {
        // Kiểm tra nếu người dùng đã là admin rồi không làm gì
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin!');
        }

        $user->role = 'admin';
        $user->save();

        return redirect()->back()->with('success', 'Thành công!');
    }

    // Hạ cấp người dùng thành User
    public function makeUser(User $user)
    {
        // Kiểm tra nếu người dùng đã là user rồi không làm gì
        if ($user->role === 'user') {
            return redirect()->back()->with('error', 'Người dùng đã là User!');
        }

        $user->role = 'user';
        $user->save();

        return redirect()->back()->with('success', 'Thành công!');
    }
    public function changeRole($userId, $role)
    {
        $user = User::find($userId);

        if ($user) {
            // Kiểm tra nếu role hợp lệ
            if (in_array($role, ['admin', 'user'])) {
                $user->role = $role;
                $user->save();

                return response()->json(['message' => 'Role updated successfully!']);
            }

            return response()->json(['message' => 'Invalid role'], 400);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
}

