<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urine extends Model
{
    protected $table = 'urines';

    protected $fillable = ['patient_id', 'urine_24H', 'amylase', 'creatinine', 'urea', 'Ca', 'Na', 'K'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
