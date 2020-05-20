<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodChemistry extends Model
{
    protected $table = 'blood_chemistries';

    protected $fillable = ['patient_id', 'glucose', 'proteins', 'albumin', 'transferrin', 'prealbumin', 'globulin', 'reason_alb', 'BUN', 'creatinine', 'uric_acid', 'total_ammonium', 'Ca', 'Na', 'Ka', 'P', 'Cl', 'Mg', 'CO2'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
