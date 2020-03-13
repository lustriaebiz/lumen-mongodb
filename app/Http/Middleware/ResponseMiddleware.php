<?php

namespace App\Http\Middleware;

use Closure;

class ResponseMiddleware
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
        // Pre-Middleware Action

        $response = $next($request);
        
        /** untuk modif data response */
        // $response->original['data'];

        return $response;
    }
}
