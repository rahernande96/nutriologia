<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThyroidProfile extends Model
{
    protected $table = 'thyroid_profiles';

    protected $fillable = ['patient_id', 'T4', 'T4_free', 'T3_total', 'TSH'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
