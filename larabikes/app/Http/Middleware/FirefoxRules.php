<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirefoxRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        
        if(!str_contains($request->header('user-agent'), 'Firefox'))
            abort(403, 'Solamente se puede usar Firefox :D');
        
        return $next($request);
    }
}
