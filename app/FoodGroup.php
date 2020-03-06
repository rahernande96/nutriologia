<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodGroup extends Model
{
    protected $table = 'foods_groups';

    protected $fillable = ['name'];

    public function Food()
    {
    	return $this->hasMany('App\Food','group_id');
    }

    public function FrequencyConsumption()
    {
    	return $this->hasMany('App\FrequencyConsumption');
    }

    public function equivalency()
    {
    	return $this->hasOne('App\FoodGroupEquivalent', 'group_id', 'id');
    }
}
