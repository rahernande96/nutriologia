<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_nutriologist'=>['required','string','max:255'],
            'email'=>['required','email','max:255','confirmed','unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'identification_card' => ['required'],
            'birthdate' => ['required','date'],
            'sex' => ['required','boolean'],
            'city' => ['required','string','max:255'],
            'country' => ['required','string','max:2'],
            'state' => ['required','string','max:255'],
            'line1' => ['required','string','max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name_nutriologist'],
            'slug' => str_slug(Str::random(40)),
            'picture' => 'default.png',
            'sex' => $data['sex'],
            'date_birth' => $data['birthdate'],
            'identification_card' => $data['identification_card'],
            'email' => $data['email'],
            'city' => $data['city'],
            'country' => $data['country'],
            'state' => $data['state'],
            'line1' => $data['line1'],
            'confirmation_code' => Str::random(25),
            'password' => Hash::make($data['password']),
            'role_id' => \App\Rol::DOCTOR,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        //Mandamos el correo de confirmación de pago
        //Mail::to($user->email)->send(new PaymentSuccess($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('billing')->with('info','Registrado con Exito');
    }
}
