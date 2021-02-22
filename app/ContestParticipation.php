<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContestParticipation extends Model
{
    protected $table = 'contest_participations';

    public function check_if_user_played($user_id)
    {
        $giveaway = DB::table('contests_participations')
            ->select('*')
            ->where('user_id', $user_id)
            ->limit(1)
            ->first();

        if(empty($giveaway))
        {
            return null;
        }
        else
        {
            return $giveaway;
        }
    }

    public function addMatch($user_id, $contest_id, $match_id, $prognostic)
    {
        return DB::table('contests_participations')->insert([
            'user_id' => $user_id,
            'contest_id' => $contest_id,
            'match_id' => $match_id,
            'prognostic' => $prognostic,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
