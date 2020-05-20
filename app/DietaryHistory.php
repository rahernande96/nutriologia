<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DietaryHistory extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id'
    ];
}
