<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Patient;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $patients = Patient::where('user_id', $user->id)->get();

        return view('patients.index', compact('user', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('patients.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {

        $user = Auth::user();

        // Calculamos la edad y damos formato a la fecha de nacimiento
        $birthdate = $request->birthdate;
        $birthdate_format = Str::replaceArray('/', ['-', '-'], $birthdate);
        $ages = Carbon::parse($birthdate_format)->age;
        $date = Carbon::parse($birthdate_format)->format('Y-m-d');

        if ($request->gender == "Masculino") {

            $request->trimester = "";
            $request->semester = "";
            $request->sdg = "";
            $request->pregnancy = false;
        }


        Patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'slug' => str_slug($request->name. '-' .Str::uuid()),
            'picture' => 'default.png',
            'address' => $request->address,
            'city' => $request->city,
            'birthdate' => $date,
            'age' => $ages,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'email' => $request->email,
            'gender' => $request->gender,
            'trimester' => $request->trimester,
            'semester' => $request->semester,
            'sdg' => $request->sdg,
            //'weight' => $request->weight,
            //'size' => $request->size,
            'notes' => $request->notes,
            'pregnancy' => $request->pregnancy,
        ]);

        return redirect()->route('patients.index')->with('success', 'Paciente registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        $date = Carbon::parse($patient->birthdate)->format('d-m-Y');

        return view('patients.show', compact('patient', 'user', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        $date = Carbon::parse($patient->birthdate)->format('d-m-Y');
        
        return view('patients.edit', compact('user','patient', 'date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        $messages = [
            'name.required' => 'Ingrese el nombre del paciente',
            'address.required' => 'Ingrese la dirección del paciente',
            'city.required' => 'Ingrese la ciudad del paciente',
            'birthdate.required' => 'Ingrese una fecha de nacimiento del paciente',
            'phone_1.required' => 'Ingrese el número de teléfono del paciente',
            'email.required' => 'Ingrese el correo electrónico del paciente',
           // 'weight.required' => 'Ingrese el peso del paciente',
            //'size.required' => 'Ingrese la talla del paciente'
        ];

        $rules = [
            'name' => ['required'],
         //'address' => ['required', Rule::unique('patients')->ignore($patient->id)],
         'address'  => ['required'],
            'city' => ['required'],
            'birthdate' => ['required'],
            'phone_1' => ['required'],
            'email' => ['required', Rule::unique('patients')->ignore($patient->id)],
            //'weight' => ['required'],
            'gender' => ['required'],
            //'size' => ['required']
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

         if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Calculamos la edad y damos formato a la fecha de nacimiento
        $birthdate = $request->birthdate;
        $birthdate_format = Str::replaceArray('/', ['-', '-'], $birthdate);
        $ages = Carbon::parse($birthdate_format)->age;
        $date = Carbon::parse($birthdate_format)->format('Y-m-d');

        if ($request->gender == "Masculino") {

            $request->trimester = "";
            $request->semester = "";
            $request->sdg = "";
            $request->pregnancy = false;
        }

        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->city= $request->city;
        $patient->birthdate = $date;
        $patient->age = $ages;
        $patient->phone_1 = $request->phone_1;
        $patient->phone_2 = $request->phone_2;
        $patient->email = $request->email;
        //$patient->weight = $request->weight;
        $patient->gender = $request->gender;
        $patient->trimester = $request->trimester;
        $patient->sdg = $request->sdg;
        $patient->semester = $request->semester;
        //$patient->size = $request->size;
        $patient->notes = $request->notes;
        $patient->pregnancy = $request->pregnancy;

        $patient->save();

        return redirect()->route('patients.index')->with('success', 'Datos del paciente actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Patient::where('slug',$slug)->delete();

        return back()->with('success', 'Paciente eliminado correctamente');
    }
}
