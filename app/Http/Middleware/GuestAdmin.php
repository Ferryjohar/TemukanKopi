<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestAdmin
{
    public function handle(Request $request, Closure $next): Response
{
    if (session()->has('login')) {
        return redirect()->route('admin.dashboard');
    }

    return $next($request);
}
}