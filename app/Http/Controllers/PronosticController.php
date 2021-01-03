<?php

namespace App\Http\Controllers;

use App\Pronostic;
use Illuminate\Support\Facades\Auth;

class PronosticController extends Controller
{
    public function index()
    {
        $pronostic = new Pronostic;
        $data['pronostics'] = $pronostic->all_by_date();
        return view('pronostic.index')->with($data);
    }

    public function find_by_date(string $date)
    {
        $pronostic = new Pronostic;
        $data['date'] = $date;
        $data['pronostics'] = $pronostic->find_by_date($date);

        return view('pronostic.date')->with($data);
    }

    public function show(Pronostic $id)
    {
        if (!Auth::user()->subscribed('football')) {
            if (substr($id, -1) !== 0 || substr($id, -1) !== 5)
            {
                return redirect()->route('subscription_index');
            }
        }

        return view('pronostic.show', [
            'pronostic' => $id
        ]);
    }
}
