<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng không phải là Admin, redirect về trang chủ
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        return $next($request);
    }
}
