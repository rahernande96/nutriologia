<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'paypal_id',
        'paypal_status',
        'paypal_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
    ];
}
