<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (auth()->check()) {
                $role = auth()->user()->role;

                if ($role === 'admin') {
                    return route('admin.home'); // Đường dẫn trang admin
                } elseif ($role === 'user') {
                    return route('/'); // Đường dẫn trang đọc truyện
                }
            }
            return route('login');
        }
    }
}
