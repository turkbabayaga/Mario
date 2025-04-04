<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsStaffAuthenticated
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!session()->has('staff_id')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

