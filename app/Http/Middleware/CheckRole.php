<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có vai trò đúng hay không
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Nếu không đủ quyền, chuyển hướng đến trang đăng nhập
        return redirect()->route('login')->withErrors(['message' => 'You do not have permission to access this page.']);
    }
}
