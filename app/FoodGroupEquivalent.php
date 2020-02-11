<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodGroupEquivalent extends Model
{
    protected $fillable = ['group_id',
    'energy',
    'protein',
    'lipids',
    'carbohydrates'];

}
