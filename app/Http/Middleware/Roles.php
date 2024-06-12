<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if(in_array($request->user()->roles_id, $role)){
            return $next($request);
        }else {
            Alert::error('error', 'Anda Tidak Dapat Izin Akses Halaman Tersebut!');
            return redirect()->back();
        }
       
    }
}
