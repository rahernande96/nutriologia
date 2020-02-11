<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderFood extends Model
{
    protected $fillable = [
        'reminder_item_id',
        'group_id',
        'food_id',
        'quantity',
        'unity'
    ];

    public function food(){
        return $this->hasOne('App\Food', 'id', 'food_id');
    }

    public function foodGroup(){
        return $this->hasOne('App\FoodGroup', 'id', 'group_id');
    }
}
