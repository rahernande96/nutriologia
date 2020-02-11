<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    const RAPID = 1;
    const DETAIL = 2;
    
    protected $fillable = [
    'type',
    'patient_id',
    'food_time',
    'food_hour',
    'food_site',
    'foods',
    'quantity',
    'unity'];

    public function reminderItem(){
        return $this->hasMany('App\ReminderItem');
    }
}
