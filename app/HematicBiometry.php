<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HematicBiometry extends Model
{
    protected $table = 'hematic_biometries';

    protected $fillable = ['patient_id', 'WBC', 'RBC', 'HGB', 'HCT', 'VCM', 'HCM', 'HCM_promedy', 'neutrophils', 'lymphocytes', 'monocytes', 'eosinophils', 'basophils', 'PLT'];

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
