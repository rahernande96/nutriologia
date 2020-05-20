<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicMeasure extends Model
{
    protected $fillable = [
    'patient_id',
    'size',
    'weight',
    'imc',
    'pregnancy',
    'gestation_week',
    'pregestational_weight',
    'PeIMCpgEG',
    '%PeIMCpgEg'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
