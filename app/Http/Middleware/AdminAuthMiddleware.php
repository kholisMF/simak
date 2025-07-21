<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Admin;

class AdminAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('token') || !Session::has('admin_id')) {
            return redirect()->route('login');
        }

        $admin = \App\Models\Admin::find(Session::get('admin_id'));

        if (!$admin || $admin->token !== Session::get('token')) {
            Session::flush();
            return redirect()->route('login');
        }

        $last = Session::get('last_activity');
        if ($last && now()->diffInMinutes($last) >= 57) {
            $admin->update(['token' => null]);
            Session::flush();
            return redirect()->route('login')->withErrors(['session' => 'Sesi habis, silakan login kembali.']);
        }

        // Update aktivitas terakhir
        Session::put('last_activity', now());

        return $next($request);
    }

}
