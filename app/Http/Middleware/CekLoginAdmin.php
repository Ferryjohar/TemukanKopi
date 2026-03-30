<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLoginAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // UNTUK TES: Hapus tanda // di bawah ini. 
        // Jika saat akses dashboard muncul layar hitam tulisan "SATURPAM JALAN", berarti middleware OK.
        //dd('SATPAM JALAN'); 

        if (!session()->has('login')) {
            return redirect()->route('admin.login')->with('error', 'Login dulu bos!');
        }

        return $next($request);
    }
}