<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipidProfile extends Model
{
    protected $table = 'lipid_profiles';

    protected $fillable = ['patient_id', 'total_cholesterol', 'HDL_cholesterol', 'LDL_cholesterol', 'triglycerides'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
