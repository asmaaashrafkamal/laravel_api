<?php

namespace App\Http\Middleware;
use Exception;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GeneralTraits;
class CheckAdminToken
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
                //throw an exception

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response() -> json(['success' => false, 'msg' => 'INVALID _TOKEN']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response() -> json(['success' =>false, 'msg'=>'EXPIRED_TOKEN']);
            } else{
                return response() -> json(['success' => false, 'msg' => 'Error']);
            }
        }
        if(!$user){
          $this -> returnError("",trans("unauthenticated"));
          return $next($request);
        }
    }
}
