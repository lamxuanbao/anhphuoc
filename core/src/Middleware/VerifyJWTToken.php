<?php

namespace Kizi\Core\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kizi\Core\CoreManager;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
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
        try {
            $guards = config('auth.guards');
            $check = false;
            foreach ($guards as $key => $value) {
                if ($check == false) {
                    $check = auth($key)->check();
                    if ($check) {
                        request()->headers->set('App-Role', $key);
                    }
                }
            }
            if ($check == false) {
                return response_api('token_time_expired', Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            if ($e instanceof TokenExpiredException) {
//                try {
//                    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
//                    $user = JWTAuth::setToken($refreshed)
//                                   ->toUser();
//                    header('Authorization: Bearer '.$refreshed);
//                    Auth::login($user, false);
//                } catch (TokenExpiredException $e) {
//                    return response_api('token_time_out',Response::HTTP_UNAUTHORIZED);
//                } catch (JWTException $e) {
                return response_api('token_time_expired', Response::HTTP_UNAUTHORIZED);
//                }
            } else {
                if ($e instanceof TokenInvalidException) {
                    return response_api('token_invalid', Response::HTTP_UNAUTHORIZED);
                } else {
                    return response_api('token_required', Response::HTTP_UNAUTHORIZED);
                }
            }
        }
        return $next($request);
    }
}
