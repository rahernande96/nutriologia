<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PaymentMethod extends Model
{

	protected $fillable = [
        'image', 'title', 'instructions','processor_link'
    ];

    public function details()
    {
    	return $this->hasOne('App\PaymentMethodDetail')->where('user_id',Auth::user()->id);
    }
    
}
