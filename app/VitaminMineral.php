<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VitaminMineral extends Model
{
    protected $table = 'vitamin_minerals';

    protected $fillable = ['patient_id', 'thiamin', 'pyridoxine', 'cobalamin', 'B12', 'folate', 'iron', 'ferritin', 'vitamin_a', 'OH', 'vitamin_e', 'vitamin_k', 'zinc', 'selenium'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
