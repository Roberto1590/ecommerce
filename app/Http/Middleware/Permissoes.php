<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permissoes
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
        // if (auth()->user()->email == 'guilherme@gmail.com') {
        //     return redirect()->route('welcome');
        // }
        return $next($request);
    }
}
