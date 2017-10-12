<?php

namespace App\Http\Middleware;

use Closure;

class RejectEmptyValues
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 过滤空值，并且trim
        $params = collect($request)->map(function ($item) {
            if (is_string($item)) {

                $item = empty(trim($item)) ? null : trim($item);


            }
            return $item;
        });
        $request->replace($params->all());

        return $next($request);
    }
}
