<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReminderItem extends Model
{
    protected $fillable = [
        'reminder_id',
        'food_time_id',
        'group_id',
        'food_id',
        'food_hour',
        'food_site',
        'food_who',
        'quantity',
        'unity'
    ];

    public function reminderFood(){
        return $this->hasMany('App\ReminderFood', 'reminder_item_id', 'id');
    }

    public function foodTime(){
        return $this->hasOne('App\FoodTime', 'id', 'food_time_id');
    }
}
