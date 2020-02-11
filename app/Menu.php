<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'patient_id',
        'name',
        'days',
        'food_times'
    ];

    public function details()
    {
        return $this->hasMany('App\MenuDetail', 'menu_id', 'id');
    }

    public function patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }
}
