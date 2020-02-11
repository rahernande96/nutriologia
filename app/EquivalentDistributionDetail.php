<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquivalentDistributionDetail extends Model
{
    protected $fillable = ['equivalent_dist_id',
    'food_group_id',
    'fields'];
}
