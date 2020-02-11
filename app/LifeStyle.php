<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LifeStyle extends Model
{
	protected $table = 'life_styles';

    protected $fillable = ['patient_id', 'details', 'stress'];

    public function patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
