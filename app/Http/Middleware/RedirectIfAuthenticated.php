<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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

        if (Auth::check()){
            $rol = Auth::user()->roles_id;

            if ($rol == 1){
                //Panel administrativo
                return redirect('/panel-administrativo');
            }else if ($rol == 2){
                //Página de usuario estándar
                return redirect('/panel-estandar');
            }
        }

        return $next($request);
    }
}
