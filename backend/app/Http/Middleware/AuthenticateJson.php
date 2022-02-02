<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class AuthenticateJson extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return new JsonResponse([
                "status" => 401,
                "message" => 'Not authorized',
                "data" => [],
                "errors" => [],
            ], 401);
        }
        return $next($request);
    }
}
