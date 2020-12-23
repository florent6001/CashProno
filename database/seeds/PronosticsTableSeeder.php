<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Pronostic;

class PronosticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pronostic::create([
            'date' => Carbon::now(),
            'sport' => 'Football',
            'description' => 'Description du pronostic football',
            'short_description' => 'Petite description visible sur page accueil foot',
            'logo_1' => 'football.png',
            'logo_2' => '',
            'free_access' => 0
        ]);

        Pronostic::create([
            'date' => Carbon::now(),
            'sport' => 'Tennis',
            'description' => 'Description du pronostic tennis',
            'short_description' => 'Petite description visible sur page accueil tennis',
            'logo_1' => 'tennis.png',
            'logo_2' => '',
            'free_access' => 1
        ]);

        Pronostic::create([
            'date' => Carbon::now(),
            'sport' => 'Basket-Ball',
            'description' => 'Description du pronostic basket',
            'short_description' => 'Petite description visible sur page accueil basket',
            'logo_1' => 'basket.png',
            'logo_2' => 'logo2basket.png',
            'free_access' => 0
        ]);
    }
}
