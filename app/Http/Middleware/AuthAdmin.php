<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Please login as admin.']);
        }
    
        return $next($request);
    }
}
