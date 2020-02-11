<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GctDurninCol extends Model
{
    const MALE = 1;
    const FEMALE = 2;
    protected $fillable = [
        'gender',
        'sum_folds',
        'age_17_29',
        'age_30_39',
        'age_40_49',
        'age_more_50'
    ];
}
