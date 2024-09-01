<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InactivityLogout
{
    public function handle($request, Closure $next)
    {
        $timeout = 5 * 60; // 5分 = 300秒

        if (Auth::check() && (time() - session('last_activity_time') > $timeout)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home.index')->with('message', '5分間操作がなかったため、自動的にログアウトされました。');
        }

        session(['last_activity_time' => time()]);

        return $next($request);
    }
}