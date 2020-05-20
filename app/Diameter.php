<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diameter extends Model
{
    protected $fillable = [
        'body_measure_id',
        'biepicondilar_humero',
        'biepicondilar_femur',
        'biacromial',
        'biliocrestideo',
        'longitud_pie',
        'transverso_torax',
        'profundidad_anteroposterior_torax'
    ];
}
