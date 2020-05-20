<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BioelectricImpedance extends Model
{
    protected $fillable = [
        'body_measure_id',
        'body_weight',
        'total_fat_kg',
        'total_fat_porcent',
        'upper_fat_kg',
        'upper_fat_porcent',
        'lower_fat_kg',
        'lower_fat_porcent',
        'visceral_mass_kg',
        'visceral_mass_porcent',
        'fat_free_dough_kg',
        'fat_free_dough_porcent',
        'muscle_mass_kg',
        'muscle_mass_porcent',
        'bone_weight_kg',
        'bone_weight_porcent',
        'body_water_l',
        'body_water_porcent',
        'metabolic_age'
    ];
}
