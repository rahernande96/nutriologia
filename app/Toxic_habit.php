<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toxic_habit extends Model
{
    protected $table = 'toxic_habits';

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
