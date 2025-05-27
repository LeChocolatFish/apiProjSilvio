<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = 'partidas';

    protected $fillable = [
        'data_partida',
        'time_casa',
        'time_visitante',
    ];

    public $timestamps = true;

    protected $casts = [
        'data_partida' => 'date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}