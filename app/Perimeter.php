<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perimeter extends Model
{
    protected $fillable = [
        'body_measure_id',
        'muneca',
        'cintura',
        'cadera',
        'brazo_relajado',
        'brazo_contraido',
        'pantorrilla',
        'antebrazo',
        'cabeza',
        'cuello',
        'torax',
        'muslo',
        'muslo_medial',
        'tobilo',
    ];
}
