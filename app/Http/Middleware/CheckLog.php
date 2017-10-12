<?php

namespace App\Http\Middleware;

use Closure;

class CheckLog
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
        $user=session('auth');

        if(empty($user)){

        return redirect('backpage/login');
        }

        return $next($request);
    }
}