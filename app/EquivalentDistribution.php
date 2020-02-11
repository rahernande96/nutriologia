<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquivalentDistribution extends Model
{
    protected $fillable = ['patient_id',
    'days',
    'food_groups',
    'food_times',
    'start_date',
    'end_date'];

    public function details()
    {
        return $this->hasOne('\App\EquivalentDistributionDetail', 'equivalent_dist_id', 'id');
    }
}
