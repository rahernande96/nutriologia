<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrequencyConsumption extends Model
{
    protected $table = 'frequency_consumptions';

    protected $fillable = ['patient_id', 'food_name', 'food_id', 'food_group', 'frecuency'];

    public function patient()
    {
    	return $this->hasOne('App\Patient');
    }

    public function FoodGroup()
    {
    	return $this->hasOne('App\FoodGroup', 'id', 'food_group');
    }

    public function Food()
    {
    	return $this->hasOne('App\Food', 'id', 'food_id');
    }
}
