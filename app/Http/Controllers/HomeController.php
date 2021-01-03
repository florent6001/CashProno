<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Pronostic;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $pronostic = new Pronostic();
        $data['daily_pronostics'] = $pronostic->daily_pronostics();
        $data['winning_pronostics'] = $pronostic->winning_pronostics();

        if (Auth::user() && Auth::user()->subscribed('football')) {
            $data['subscription']['football'] = true;
        } else {
            $data['subscription']['football'] = false;
        }

        return view('home')->with($data);
    }
}
