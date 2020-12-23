<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pronostic;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $daily_pronostic = Pronostic::take(5);
        $winning_pronostic = Pronostic::take(5);
        return view('home', [
            'daily_pronostics' => $daily_pronostic,
            'winning_pronostic' => $winning_pronostic
        ]);
    }
}
