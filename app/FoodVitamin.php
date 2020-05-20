<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodVitamin extends Model
{
    protected $fillable = ['food_id', 'vitamina_A', 'acido_ascorbico', 'acido_folico'];

}
