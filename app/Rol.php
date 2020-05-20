<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    const ADMIN = 1;
    const DOCTOR = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol', 'description',
    ];
}
