<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IsBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    protected $allowed = ['contacto', 'contacto.email', 'user.blocked', 'logout'];
    
    
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $ruta = Route::currentRouteName();
        
        if($user && $user->hasRole('bloqueado') && !in_array($ruta, $this->allowed))
            return redirect()->route('user.blocked');       
        
        return $next($request);
    }
}
