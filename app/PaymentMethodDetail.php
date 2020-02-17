<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodDetail extends Model
{
    protected $fillable = [
		'title', 'html','code_link', 'user_id','payment_method_id'
    ];
}
