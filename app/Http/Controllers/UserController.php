<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests\PictureRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use File;
use Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Dashboard(){

    	$user = Auth::user();

    	return view('admin.dashboard', compact('user'));
    }

    public function config(){

    	$user = Auth::user();

    	return view('configuration', compact('user'));
    }

    public function change_picture(PictureRequest $request, $slug){

    	$user = User::where('slug', $slug)->first();

        if($request->file('picture'))
        {

            if($user->picture == 'default.png')
            {
                $path = Storage::disk('public')->put('images/pictures', $request->file('picture'));
                $user->picture = $path;
                $user->save();
                return back()->with('success', 'Imágen actualizada correctamente');
            }else
            {
                $path = asset($user->picture);
                 if (File::exists($path)); 
                {
                    unlink($user->picture);
                    $path = Storage::disk('public')->put('images/pictures', $request->file('picture'));
                    $user->picture = $path;
                    $user->save();
                    return back()->with('success', 'Imágen actualizada correctamente');
                }   
            }
        }
    }

    public function change_password(UpdatePasswordRequest $request, $slug)
    {
        $user = User::where('slug', $slug)->first();

        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', 'Contraseña actualizada correctamente');
        }else
        {
            return back()->with('info', 'Tu contraseña actual no coincide');
        }
    }
}
