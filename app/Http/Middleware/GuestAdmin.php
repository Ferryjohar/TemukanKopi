<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestAdmin
{
    public function handle(Request $request, Closure $next): Response
{
    // UNTUK TES: Hapus tanda // di bawah ini.
    // Jika akses /admin/login muncul layar hitam "GUEST JALAN", berarti middleware OK.
    // dd('GUEST JALAN'); 

    if (session()->has('login')) {
        return redirect()->route('admin.dashboard');
    }

    return $next($request);
}
}