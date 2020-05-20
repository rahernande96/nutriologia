<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['group_id', 'name', 'energy',
    'protein',
    'lipids',
    'carbohydrates',
    'fiber', 'icon'];

    public function FoodGroup()
    {
    	return $this->belongsTo('App\FoodGroup', 'group_id');
    }

    public function Frequency()
    {
    	return $this->belongsTo('App\FrequencyConsumption');
    }

    public function FoodVitamin()
    {
    	return $this->hasOne('App\FoodVitamin');
    }

    public function FoodMineral()
    {
    	return $this->hasOne('App\FoodMineral');
    }
}
