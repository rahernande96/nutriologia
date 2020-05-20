<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brief_clinical_history extends Model
{
    protected $table = 'brief_clinical_history';

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
