<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyMeasure extends Model
{
    protected $fillable = [
        'patient_id'
    ];

    public function BioelectricImpedance()
    {
        return $this->hasOne('App\BioelectricImpedance', 'body_measure_id', 'id');
    }

    public function Diameter()
    {
        return $this->hasOne('App\Diameter');
    }

    public function Fold()
    {
        return $this->hasOne('App\Fold');
    }

    public function Perimeter()
    {
        return $this->hasOne('App\Perimeter');
    }
}
