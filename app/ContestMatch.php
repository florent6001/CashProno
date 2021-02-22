<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContestMatch extends Model
{

    protected $table = 'contests_matchs';

    public function createMatch($home, $opponent, $contest_id)
    {
        return DB::table('contests_matchs')->insert([
            'home' => $home,
            'opponent' => $opponent,
            'contest_id' => $contest_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}