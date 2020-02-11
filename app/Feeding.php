<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    protected $table = 'feedings';

    protected $fillable = ['patient_id', 'salad', 'red_meat', 'soup', 'pasta', 'vegetable', 'vegetarian', 'vegan', 'bird', 'pork', 'mexican', 'shellfish', 'food_not_prefer', 'alimentary_habits', 'food_belief'];

    public function Patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
