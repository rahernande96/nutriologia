<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificDiet extends Model
{
    protected $table = 'specific_diets';

    protected $fillable = ['patient_id', 'diet_salad', 'diet_vegan', 'diet_crudiverian', 'diet_ovogetarian', 'diet_ovolactovegetarian', 'diet_mediterranean', 'other', 'water', 'vitamins', 'protein', 'aminoacids', 'none'];

    public function patient()
    {
    	return $this->hasOne('App\Patient');
    }
}
