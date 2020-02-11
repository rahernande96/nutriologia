<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fold extends Model
{
    protected $fillable = [
        'body_measure_id',
        'bicep',
        'tricep',
        'subescapular',
        'suprailiaco',
        'supraespinal',
        'abdominal',
        'muslo_frontal',
        'pantorrilla_medial',
        'axilar_medial',
        'pectoral'
    ];
}
