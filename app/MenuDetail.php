<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    protected $fillable = [
        'menu_id',
        'day',
        'food_time_id',
        'dish_id'
    ];

    public function dish()
    {
        return $this->hasOne('App\Dish', 'id', 'dish_id');
    }
}
