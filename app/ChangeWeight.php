<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeWeight extends Model
{
    protected $table = 'change_weights';

    protected $fillable = ['patient_id', 'max_weight', 'min_weight', 'usual_weight', 'lastMonth', 'lastThreeMonths', 'lastSixMonths'];

    public function Patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
