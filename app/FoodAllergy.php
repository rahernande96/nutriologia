<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodAllergy extends Model
{
    protected $table = 'food_allergies';

    protected $fillable = ['patient_id', 'oilseed_allergy', 'fruit_allergy', 'vegetable_allergy', 'intolerance'];

    public function Patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
