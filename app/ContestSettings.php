<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContestSettings extends Model
{
    protected $table = 'contests_settings';
    protected $fillable = ['image_src', 'date'];
    protected $dates = ['date'];

    public function contests_settings_exist()
    {
        $giveaway = DB::table('contests_settings')
            ->select('*')
            ->orderBy('date', 'DESC')
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

    public function createContest($date, $image)
    {
        DB::table('contests_settings')->insert([
            'date' => $date,
            'image_src' => $image,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $settings = DB::table('contests_settings')
            ->select('*')
            ->whereDate('date', '=', $date)
            ->orderBy('date', 'DESC')
            ->limit('1')
            ->get();

        return $settings[0];
    }
}
