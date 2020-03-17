<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    protected $table = 'feedings';

    protected $fillable = ['patient_id', 'preferred_foods', 'food_not_prefer', 'alimentary_habits', 'food_belief'];

    public function Patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
