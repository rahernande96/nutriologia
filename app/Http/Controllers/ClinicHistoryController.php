<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Brief_clinical_history;
use App\heredfamily_background;
use App\Toxic_habit;
use DB;
use Auth;

class ClinicHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClinicalHistoryPatient($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.menu_option_clinic_history', compact('user', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function BriefClinicalHistory($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.ClinicHistory.create', compact('user', 'patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function BriefClinicHistoryStore(Request $request, $slug)
    {
        
        $patient = Patient::where('slug', $slug)->first();

        DB::beginTransaction();

        try{

            Brief_clinical_history::create([
                'patient_id' => $patient->id,
                'symptom' => $request->symptom,
                'current_pathology' => $request->current_pathology,
                'medicines' => $request->medicines,
                'treatment_frequency' => $request->treatment_frequency,
                'treatment_quantity' => $request->treatment_quantity,
                'treatment_results' => $request->treatment_results,
                'pregnancy' => $request->pregnancy,
                'contraceptive' => $request->contraceptive,
                'surgery' => $request->surgery,
                'allergy' => $request->allergy
            ]);

            heredfamily_background::create([
                'patient_id' => $patient->id,
                'DM1' => $request->DM1,
                'DM2' => $request->DM2,
                'HAS' => $request->HAS,
                'Cardiopatías' => $request->Cardiopatías,
                'Aterosclerosis' => $request->Aterosclerosis,
                'Osteopenia' => $request->Osteopenia,
                'Obesidad' => $request->Obesidad,
                'Hipotiroidismo' => $request->Hipotiroidismo,
                'Hipertiroidismo' => $request->Hipertiroidismo,
                'Gota' => $request->Gota,
                'Hepatitis' => $request->Hepatitis,
                'Cáncer' => $request->Cáncer,
                'Estreñimiento_Crónico' => $request->Estreñimiento,
                'Gastritis_Crónica' => $request->Gastritis,
                'Colitis' => $request->Colitis
            ]);

            Toxic_habit::create([
                'patient_id' => $patient->id,
                'tabaquism_frequency' => $request->tabaquism_frequency,
                'tabaquism_quantity' => $request->tabaquism_quantity,
                'alcoholism_frequency' => $request->alcoholism_frequency,
                'alcoholism_quantity' => $request->alcoholism_quantity,
                'drug_frequency' => $request->drug_frequency,
                'drug_quantity' => $request->drug_quantity,
                'coffe_frequency' => $request->coffe_frequency,
                'coffe_quantity' => $request->coffe_quantity
            ]);

            DB::commit();

            //return redirect()->route('ClinicHistoryPatient',$patient->slug)->with('success', 'Datos guardados correctamente');
            if(isset($request->clinic)){
                return redirect()->route('ClinicHistoryPatient',$patient->slug)->with('success', 'Datos guardados correctamente');
            }
            

            return redirect()->route('BriefClinicalHistory.edit', $patient->slug)->with('success', 'Datos guardados correctamente');
        }catch(\Exception $exception){
            $fail = $exception->getMessage();
            DB::rollBack();
            return redirect()->back()->with('info', $fail);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function BriefClinicHistoryEdit($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.ClinicHistory.edit', compact('patient', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function BriefClinicHistoryUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        DB::beginTransaction();

        try{

            Brief_clinical_history::where('patient_id', $patient->id)->update([
                'patient_id' => $patient->id,
                'symptom' => $request->symptom,
                'current_pathology' => $request->current_pathology,
                'medicines' => $request->medicines,
                'treatment_frequency' => $request->treatment_frequency,
                'treatment_quantity' => $request->treatment_quantity,
                'treatment_results' => $request->treatment_results,
                'pregnancy' => $request->pregnancy,
                'contraceptive' => $request->contraceptive,
                'surgery' => $request->surgery,
                'allergy' => $request->allergy
            ]);

            heredfamily_background::where('patient_id', $patient->id)->update([
                'patient_id' => $patient->id,
                'DM1' => $request->DM1,
                'DM2' => $request->DM2,
                'HAS' => $request->HAS,
                'Cardiopatías' => $request->Cardiopatías,
                'Aterosclerosis' => $request->Aterosclerosis,
                'Osteopenia' => $request->Osteopenia,
                'Obesidad' => $request->Obesidad,
                'Hipotiroidismo' => $request->Hipotiroidismo,
                'Hipertiroidismo' => $request->Hipertiroidismo,
                'Gota' => $request->Gota,
                'Hepatitis' => $request->Hepatitis,
                'Cáncer' => $request->Cáncer,
                'Estreñimiento_Crónico' => $request->Estreñimiento,
                'Gastritis_Crónica' => $request->Gastritis,
                'Colitis' => $request->Colitis
            ]);

            Toxic_habit::where('patient_id', $patient->id)->update([
                'patient_id' => $patient->id,
                'tabaquism_frequency' => $request->tabaquism_frequency,
                'tabaquism_quantity' => $request->tabaquism_quantity,
                'alcoholism_frequency' => $request->alcoholism_frequency,
                'alcoholism_quantity' => $request->alcoholism_quantity,
                'drug_frequency' => $request->drug_frequency,
                'drug_quantity' => $request->drug_quantity,
                'coffe_frequency' => $request->coffe_frequency,
                'coffe_quantity' => $request->coffe_quantity
            ]);

            DB::commit();

            //return redirect()->route('ClinicHistoryPatient',$patient->slug)->with('success', 'Datos actualizados correctamente');
            return redirect()->route('BriefClinicalHistory.edit', $patient->slug)->with('success', 'Datos guardados correctamente');
        }catch(\Exception $exception){
            $fail = $exception->getMessage();
            DB::rollBack();
            return redirect()->back()->with('info', $fail);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
