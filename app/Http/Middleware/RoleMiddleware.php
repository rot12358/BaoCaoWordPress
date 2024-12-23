<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Không đủ quyền truy cập
        return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
