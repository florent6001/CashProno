<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::check())
        {
            if(Auth::user()->admin == 1)
            {            
                return $next($request);
            }
            else 
            {
                $request->session()->flash('danger', 'Vous devez être administrateur afin d\'accéder à cette page.');
            }
        }
        else 
        {
            $request->session()->flash('danger', 'Vous devez être connecté afin d\'accéder à cette page.');
        }

        return redirect()->route('homepage');
    }
}
