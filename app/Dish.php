<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id',
        'history_id',
        'name',
        'kcal',
        'lipids',
        'proteins',
        'carbohydrates',
        'notes',
        'cost_id',
        'style_id',
        'temperature_id',
        'type_id',
        'image'
    ];

    public function details()
    {
        return $this->hasMany('App\DishDetail', 'dish_id', 'id');
    }

    public function patient()
    {
        return $this->hasOne('App\Patient', 'patient_id', 'id');
    }

    public function ingredients()
    {
            return $this->hasManyThrough('App\Sem', 'App\DishDetail', 'dish_id', 'id', 'id', 'sem_id');
    }

    public function cost()
    {
        return $this->hasOne('App\DishCost', 'id', 'cost_id');
    }

    public function style()
    {
        return $this->hasOne('App\DishStyle', 'id', 'style_id');
    }

    public function temperature()
    {
        return $this->hasOne('App\DishTemperature', 'id', 'temperature_id');
    }

    public function type()
    {
        return $this->hasOne('App\DishType', 'id', 'type_id');
    }
}
