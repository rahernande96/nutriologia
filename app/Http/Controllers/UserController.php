<?php

namespace App\Http\Controllers;
use App\Event;
use App\Http\Requests\PictureRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Patient;
use App\User;
use Auth;
use Carbon\Carbon;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function Dashboard(){

    	$user = Auth::user();

        $countPatients = Patient::where('user_id',$user->id)->count();

        $patients = Patient::where('user_id',$user->id)->latest()->paginate(6); 

        $dateNow = Carbon::now();

        $eventCount = Event::where('user_id',$user->id)->where('start_date',">=",$dateNow)->orWhere('end_date',">=",$dateNow)->where('user_id',$user->id)->count();

    	return view('admin.dashboard', compact(['user','countPatients','patients','dateNow','eventCount']));
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
                $path = $request->file('picture')->store('public/images/pictures');
                $user->picture = $path;
                $user->save();
                return back()->with('success', 'Imágen actualizada correctamente');
            }else
            {
                $path = asset($user->picture);
                 if (File::exists($path)); 
                {
                    unlink($user->picture);
                    $path = $request->file('picture')->store('public/images/pictures');
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
