<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrineTest extends Model
{
    protected $table = 'urine_tests';

    protected $fillable = ['patient_id', 'pH', 'protein', 'specific_gravity', 'glucose', 'whites_cells', 'erythrocytes'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
