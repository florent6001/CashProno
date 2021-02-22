<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContestSettings;
use App\ContestMatch;
use App\ContestParticipation;
use Illuminate\Support\Facades\Auth;

class GiveawayController extends Controller
{
    public function index()
    {
        $contest = new ContestSettings();
        $contest = $contest->contests_settings_exist();

        if(!empty($contest))
        {
            $contest_participation = new ContestParticipation();
            $user_played = $contest_participation->check_if_user_played(Auth::user()->id);

            if(!empty($user_played))
            {
                return view('giveaway.index');
            }
            else
            {
                $contest = new ContestSettings();
                $contest = $contest->contests_settings_exist();
                $matchs = ContestMatch::where('contest_id', $contest->id)->get();
        
                return view('giveaway.create',
                [
                    'contest' => $contest,
                    'matchs' => $matchs
                ]);
            }
        } 
        else 
        {
            return view('giveaway.empty');
        }
    }

    public function store(Request $request)
    {
        $contest = new ContestSettings();
        $contest = $contest->contests_settings_exist();
        $contest_participation = new ContestParticipation();
        $inputs = $request->all();

        foreach($inputs['parameters'] as $input)
        {
            $contest_participation->addMatch(Auth::id(), $contest->id, $input['id'], $input['result']);
        }

        return 'ok';
    }
}
