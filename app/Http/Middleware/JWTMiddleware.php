<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JWTMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        
        if(!$token) {
            // Unauthorized response if token not there
            return [
                'code' => 401,
                'error' => 'Token not provided.'
            ];
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return [
                'code' => 400,
                'error' => 'Provided token is expired.'
            ];
        } catch(\Exception $e) {
            return [
                'code' => 400,
                'error' => 'An error while decoding token.'
            ];
        }
        
        $request->request->add(['auth' => ['user'=>$credentials->data, 'desc'=>$credentials->desc]]);
        return $next($request);
    }
}