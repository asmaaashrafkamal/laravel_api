<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTraits;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssignGuard extends BaseMiddleware
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            $token = $request->header('auth-token');
            // return response() -> json( ['msg' => $token]);

            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
               $user = $this->auth->authenticate($request);  //check authenticted user
                // $user = JWTAuth::parseToken()->authenticate();
            }  catch (JWTException $e) {

                return  $this -> returnError('', 'token_invalid '.$e->getMessage());
            }catch (TokenExpiredException $e) {
                return  $this -> returnError('401','Unauthenticated user');
            }

        }
         return $next($request);
    }
}
