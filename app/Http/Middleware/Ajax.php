<?php

namespace App\Http\Middleware;

use Closure;

class Ajax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd($request);
        if ( ! $request->ajax())
            return response('Forbidden!!!.', 403);

        return $next($request);
    }
}
