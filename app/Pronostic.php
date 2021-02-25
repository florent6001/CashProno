<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class Pronostic extends Model
{

    use Notifiable;

    protected $fillable = ['date', 'sport', 'description', 'short_description', 'logo_1', 'logo_2', 'free_access', 'state'];

    protected $attributes = [
        'free_access' => 0,
        'state' => 'En attente'
    ];

    protected $dates = ['date'];

    public function all_by_date()
    {
        return DB::table('pronostics')
            ->select('*')
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function daily_pronostics()
    {
        $last_day = DB::table('pronostics')
                        ->select('date')
                        ->orderBy('date', 'DESC')
                        ->limit('1')
                        ->get();

        if(empty($last_day[0]))
        {
            return null;
        } else
        {
            return DB::table('pronostics')
                    ->select('*')
                    ->where('date', '=', $last_day[0]->date)
                    ->get();
        }
    }

    public function winning_pronostics()
    {
        return DB::table('pronostics')
                ->select('*')
                ->where('state', '=', 'Gagnant')
                ->limit('3')
                ->orderBy('date', 'DESC')
                ->get();
    }

    public function find_by_date(string $date)
    {
        $date = date('Y-m-d', strtotime($date));
        return DB::table('pronostics')
            ->select('*')
            ->whereDate('date', '=', $date)
            ->orderBy('date', 'DESC')
            ->get();
    }
}
