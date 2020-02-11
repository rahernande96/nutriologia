<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishDetail extends Model
{
    protected $fillable = [
        'dish_id',
        'sem_id',
        'quantity',
        'eq',
        'gr',
        'unity'
    ];

    public function ingredient()
    {
        return $this->hasOne('App\Sem', 'id', 'sem_id');
    }
}
