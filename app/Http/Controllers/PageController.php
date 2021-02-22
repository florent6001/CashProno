<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function conditions_generales() 
    {
        return view('pages.conditions-generales');
    }

    public function conditions_vente()
    {
        return view('pages.conditions-vente');
    }

    public function mentions_legales() 
    {
        return view('pages.mentions_legales');
    }

    public function politique_confidentialite_donnees()
    {
        return view('pages.politique-confidentialite-donnees');
    }
}
