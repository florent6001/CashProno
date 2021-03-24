<?php

namespace App\Http\Controllers;

use App\Pronostic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PronosticController extends Controller
{
    /**
     * Display all pronostics
     * @return Application|Factory|View
     */
    public function index()
    {
        $pronostic = new Pronostic;
        $data['pronostics'] = $pronostic->all_by_date();
        return view('pronostic.index')->with($data);
    }

    /**
     * Display all pronostic where date = $date
     * @param string $date
     * @return Application|Factory|View
     */
    public function find_by_date(string $date)
    {
        $pronostic = new Pronostic;
        $data['date'] = $date;
        $data['pronostics'] = $pronostic->find_by_date($date);

        return view('pronostic.date')->with($data);
    }

    /**
     * Show specific pronostic via $id
     * @param Pronostic $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(Pronostic $id)
    {
        if($id->free_access !== 1)
        {
            if(Auth::check())
            {
                if(!Auth::user()->subscribed('football') && Auth::user()->admin == '0') {
                    if (substr($id, -1) !== 0 || substr($id, -1) !== 5)
                    {
                        return redirect()->route('subscription_index');
                    }                    
                }
            }
        }

        return view('pronostic.show', [
            'pronostic' => $id
        ]);
    }
}
