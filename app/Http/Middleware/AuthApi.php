<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       /* Looking for a user with the token that is being sent in the request. 
       Primero es realizar una busqueda por token*/
        $user = User::where('remember_token', '!=', '')->where('remember_token', $request->token)->first();
        // SELECT * FROM users WHERE remember_token != '' AND remember_token = 'xxx' LIMIT 1
        //Si en la busqueda no encontro registros la variable $user toma un valor de falso
        // ! -> es una negación
        if(!$user)
            return response()->json(['error' => 'credenciales incorrectas']);
        return $next($request);
    }
}
