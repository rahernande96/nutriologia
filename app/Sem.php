<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sem extends Model
{
    protected $fillable = [
        'food',
        'food_group_id',
        'quantity',
        'unity',
        'gross_weight',
        'net_weight',
        'energy',
        'proteins',
        'lipids',
        'carbohydrates',
        'fiber',
        'vitamin_A',
        'ascorbic_acid',
        'folic_acid',
        'airon_NO',
        'potassium',
        'glycemic_iex',
        'glycemic_charge',
        'sugar_equivalent'
    ];

    public function group()
    {
        return $this->hasOne('App\FoodGroup', 'id', 'food_group_id');
    }

}
