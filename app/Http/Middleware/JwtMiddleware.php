<?php

namespace App\Http\Middleware;

use Closure;
use http\Exception;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e){
            return response()->json(['error' => 'Token is Expired'], 401);
        } catch (TokenInvalidException $e ){
            return response()->json(['error' => 'Token is Invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is absent'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMesagge()], 500);
        }    

        return $next($request);
    }
}
