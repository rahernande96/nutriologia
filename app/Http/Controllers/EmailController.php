<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify($confirmation_code){
    	$user = User::where('confirmation_code', $confirmation_code)->first();
    	if (! $user) {
    		return redirect()->route('home');
    	}
    	$user->confirmed = true;
    	$user->confirmation_code = null;
    	$user->save();

    	return redirect()->route('login')->with('success', 'Correo Electrónico confirmado');
    }
}
