<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalEnergyExpenditure extends Model
{
    protected $fillable = [
        'energy_requirement_id', 
        'kcal', 
        'percentage_carbohydrates', 
        'percentage_lipids', 
        'percentage_protein',
        'gr_kg_proteins', 
        'gr_kg_lipids',
        'gr_kg_carbohydrates',
        'get', 
        'supplement', 
        'supplement_value', 
        'method_water_requirement',
        'water_requirement_ml_kcal',
        'water_requirement_manual', 
        'water_requirement',
        'weight_type',
        'weight',
        'formula',
        'thermic_effect',
        'stress_factor',
        'fisic_activity',
        'met_id',
        'activity_time',
        'met'
    ];

    public function Met(){
        return $this->hasOne('App\Met', 'id', 'met_id');
    }
}
