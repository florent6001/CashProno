<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pronostic extends Model
{
    protected $fillable = ['date', 'sport', 'description', 'short_description', 'logo_1', 'logo_2', 'free_access', 'state'];

    protected $attributes = [
        'free_access' => 0,
        'state' => 'En attente'
    ];

    protected $dates = ['date'];
}
