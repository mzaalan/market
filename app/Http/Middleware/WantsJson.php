<?php

namespace MetroMarket\MobilePanel\Http\Middleware;

use Closure;

class WantsJson
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
        if (!$request->wantsJson()) {
            return response('Invalid Header, Add Accept application/json to header.', 400);
        }

        return $next($request);
    }
}
