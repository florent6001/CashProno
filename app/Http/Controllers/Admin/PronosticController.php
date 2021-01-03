<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PronosticRequest;
use App\Notifications\PronosticCreated;
use App\Pronostic;
use Illuminate\Http\Request;

class PronosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $pronostics = Pronostic::all();
        return view('admin.pronostic.index',
            [
                'pronostics' => $pronostics
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pronostic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PronosticRequest $request)
    {
            $request->validate([
                'date' => 'required',
                'sport' => 'required',
                'description' => 'required',
                'short_description' => 'required',
                'logo_1' => 'required',
            ]);

        $pronostic = Pronostic::create([
            'date' => $request->get('date'),
            'sport' => $request->get('sport'),
            'description' => $request->get('description'),
            'short_description' => $request->get('short_description'),
            'logo_1' => $request->file('logo_1')->store('logo_1'),
            'logo_2' => (!empty($request->file('logo_2')) ? $request->file('logo_2')->store('logo_2') : '' ),
            'free_access' => (!empty($request->get('free_access')) ? 1 : 0 )
        ]);

        $pronostic->notify(new PronosticCreated($pronostic));
        $request->session()->flash('success', 'Votre pronostic a été enregistré avec succès !');

        return redirect()->route('admin.pronostic.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $pronostic = Pronostic::find($id);

        return view('admin.pronostic.edit', [
            'pronostic' => $pronostic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $pronostic = Pronostic::find($id);
        $pronostic->fill($request->all())->save();

        $request->session()->flash('success', 'Votre pronostic a été mis à jour avec succès !');

        return redirect()->route('admin.pronostic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id, Request $request)
    {
        Pronostic::destroy($id);

        $request->session()->flash('success', 'Le pronostic a bien été supprimé.');
        return redirect()->route('admin.pronostic.index');
    }
}
