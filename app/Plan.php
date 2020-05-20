<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'plan_id',
        'payment_method_id',
        'currency_code',
        'value',
    ];


    public function SubscriptionPaymentMethod()
    {
        return $this->belongsTo('App\SubscriptionPaymentMethod','payment_method_id');
    }
}
