<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Patient;
use App\VitalSign;

class VitalSignsController extends Controller
{
    public function create($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.VitalSigns.create', compact('user', 'patient'));
    }

    public function store(Request $request, $slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();
        
        if($request->PAD == null && $request->PAS == null && $request->breathing_frequency == null && $request->body_temperature == null && $request->beats_per_minute == null )
        {
            alert()->error('Debe ingresar al menos un dato.', 'Error!');
            return redirect()->back();
        }
        

        VitalSign::create([
            'patient_id' => $patient->id,
            'PAS' => $request->PAS,
            'PAD' => $request->PAD,
            'breathing_frequency' => $request->breathing_frequency,
            'body_temperature' => $request->body_temperature,
            'beats_per_minute' => $request->beats_per_minute
        ]);
        //return redirect()->route('ClinicHistoryPatient', $patient->slug)->with('success', 'Datos guardados correctamente');
        return redirect()->route('VitalSigns.edit', $patient->slug)->with('success', 'Datos guardados correctamente');
    }

    public function edit($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.VitalSigns.edit', compact('user', 'patient'));
    }

    public function update(Request $request, $slug)
    {
        
        if($request->PAD == null && $request->PAS == null && $request->breathing_frequency == null && $request->body_temperature == null && $request->beats_per_minute == null )
        {
            alert()->error('Debe ingresar al menos un dato.', 'Error!');
            return redirect()->back();
        }

        $patient = Patient::where('slug', $slug)->first();

        VitalSign::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'PAS' => $request->PAS,
            'PAD' => $request->PAD,
            'breathing_frequency' => $request->breathing_frequency,
            'body_temperature' => $request->body_temperature,
            'beats_per_minute' => $request->beats_per_minute
        ]);
        //return redirect()->route('ClinicHistoryPatient', $patient->slug)->with('success', 'Datos guardados correctamente');
        return redirect()->route('VitalSigns.edit', $patient->slug)->with('success', 'Datos guardados correctamente');
    }
}
