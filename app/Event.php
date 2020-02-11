<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = ['user_id', 'patient_id', 'title', 'slug', 'description', 'start_date', 'end_date'];
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
