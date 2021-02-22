<?php

namespace App\Http\Controllers\Admin;

use App\ContestSettings;
use App\ContestMatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiveawayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $contest = new ContestSettings();
        $contest = $contest->contests_settings_exist();
        
        if(empty($contest))
        {
            return redirect()->route('admin.giveaway.create');
        }

        $matchs = ContestMatch::where('contest_id', $contest->id)->get();
        return view('admin.giveaway.index',
        [
            'contest' => $contest,
            'matchs' => $matchs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.giveaway.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $contest = new ContestSettings();
        $contest = $contest->createContest($request->post('date'), $request->file('prize')->store('giveaway'));

        $request->session()->flash('success', 'Votre concours a été enregistré avec succès !');

        for ($i = 0; $i < count($request->post('home')); $i++)
        {
            $match = new ContestMatch();
            $match = $match->createMatch($request->post('home')[$i], $request->post('opponent')[$i], $contest->id);
        }

        return redirect()->route('admin.giveaway.index');
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
    //  */
    // public function edit(int $id)
    // {
    //     $pronostic = Pronostic::find($id);

    //     return view('admin.pronostic.edit', [
    //         'pronostic' => $pronostic
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $contest_id = new ContestSettings();
        $contest_id = $contest_id->contests_settings_exist();

        $update = ContestSettings::where('id', $contest_id->id)
            ->update(['image_src' => $request->file('prize')->store('giveaway')]);

        $request->session()->flash('success', 'L\'image a été mis à jour avec succès !');

        return redirect()->route('admin.giveaway.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id, Request $request)
    {
        $contest_settings = ContestSettings::find($id)->delete();
        // $contest_settings = ContestSettings::find($id)->delete();
        $contest_match = ContestMatch::destroy($id);

        $request->session()->flash('success', 'Le concours a bien été supprimé.');
        return redirect()->route('admin.giveaway.index');
    }
}
