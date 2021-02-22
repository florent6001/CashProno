<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Vip
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
        if(!empty(Auth::user()))
        {
            if (Auth::user()->subscribed('football'))
            {            
                return $next($request);
            }
            else 
            {
                $request->session()->flash('danger', 'Vous devez être VIP afin d\'accéder à cette page.');
            }
    
            return redirect()->route('subscription_index');
        }
        else
        {
            return redirect()->route('register');
        }
    }
}
