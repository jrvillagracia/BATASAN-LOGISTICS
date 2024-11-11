<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTTokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $token = $request->bearerToken();

        // if(!$token){
        //     abort(403);
        // }

        // try{
        //     $userClaims = JWTAuth::setToken($token)->getPayload();

        //     $request->attributes->set('userClaims', $userClaims);

        // } catch (JWTException $e) {
        //     abort(500);
        // }

        return $next($request);

    }
}
