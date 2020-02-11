<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMineral extends Model
{
    protected $fillable = ['food_id', 'hierro_NO', 'potasio', 'hierro', 'sodio', 'calcio', 'fosforo', 'selenio'];

}
