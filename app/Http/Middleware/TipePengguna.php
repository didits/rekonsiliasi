<?php

namespace App\Http\Middleware;

use Closure;

class TipePengguna
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipe)
    {
//        dd($tipe);
        if ($request->user()->tipe_organisasi != $tipe) {
            return response('Forbidden', '403');
        }
        else
            return $next($request);
    }
}
