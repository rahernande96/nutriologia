<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    protected $table = 'vital_signs';

    protected $fillable = ['patient_id', 'PAS', 'PAD', 'breathing_frequency', 'body_temperature', 'beats_per_minute'];

    public function patient()
    {
        return $this->hasOne('App\Patient');
    }
}
