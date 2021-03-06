<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnergyRequirement extends Model
{
    protected $fillable = [
        'history_id', 
        'patient_id', 
        'period', 
        'type_get', 
        'trismetry', 
        'semestry'
    ];
}
