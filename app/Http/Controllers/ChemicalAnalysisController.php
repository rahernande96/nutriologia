<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Patient;
use App\BloodChemistry;
use App\HematicBiometry;
use App\VitaminMineral;
use App\LipidProfile;
use App\ThyroidProfile;
use App\Urine;
use App\UrineTest;

class ChemicalAnalysisController extends Controller
{
    public function create($slug)
    {
        $user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();

        return view('patients.ChemicalAnalysis.create', compact('user', 'patient'));
    }

    public function bloodChemistryStore(Request $request, $slug)
    {

        $patient = Patient::where('slug', $slug)->first();

        BloodChemistry::create([
            'patient_id' => $patient->id,
            'glucose' => $request->glucose,
            'proteins' => $request->proteins,
            'albumin' => $request->albumin,
            'transferrin' => $request->transferrin,
            'prealbumin' => $request->prealbumin,
            'globulin' => $request->globulin,
            'reason_alb' => $request->reason_alb,
            'BUN' => $request->BUN,
            'creatinine' => $request->creatinine,
            'uric_acid' => $request->uric_acid,
            'total_ammonium' => $request->total_ammonium,
            'Ca' => $request->Ca,
            'Na' => $request->Na,
            'Ka' => $request->Ka,
            'P' => $request->P,
            'Cl' => $request->Cl,
            'Mg' => $request->Mg,
            'CO2' => $request->CO2,
        ]);

        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function bloodChemistryUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        BloodChemistry::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'glucose' => $request->glucose,
            'proteins' => $request->proteins,
            'albumin' => $request->albumin,
            'transferrin' => $request->transferrin,
            'prealbumin' => $request->prealbumin,
            'globulin' => $request->globulin,
            'reason_alb' => $request->reason_alb,
            'BUN' => $request->BUN,
            'creatinine' => $request->creatinine,
            'uric_acid' => $request->uric_acid,
            'total_ammonium' => $request->total_ammonium,
            'Ca' => $request->Ca,
            'Na' => $request->Na,
            'Ka' => $request->Ka,
            'P' => $request->P,
            'Cl' => $request->Cl,
            'Mg' => $request->Mg,
            'CO2' => $request->CO2,
        ]);
        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function hematicBiometryStore(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        HematicBiometry::create([
            'patient_id' => $patient->id,
            'WBC' => $request->WBC,
            'RBC' => $request->RBC,
            'HGB' => $request->HGB,
            'HCT' => $request->HCT,
            'VCM' => $request->VCM,
            'HCM' => $request->HCM,
            'HCM_promedy' => $request->HCM_promedy,
            'neutrophils' => $request->neutrophils,
            'lymphocytes' => $request->lymphocytes,
            'monocytes' => $request->monocytes,
            'eosinophils' => $request->eosinophils,
            'basophils' => $request->basophils,
            'PLT' => $request->PLT,
        ]);

        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function hematicBiometryUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        HematicBiometry::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'WBC' => $request->WBC,
            'RBC' => $request->RBC,
            'HGB' => $request->HGB,
            'HCT' => $request->HCT,
            'VCM' => $request->VCM,
            'HCM' => $request->HCM,
            'HCM_promedy' => $request->HCM_promedy,
            'neutrophils' => $request->neutrophils,
            'lymphocytes' => $request->lymphocytes,
            'monocytes' => $request->monocytes,
            'eosinophils' => $request->eosinophils,
            'basophils' => $request->basophils,
            'PLT' => $request->PLT,
        ]);
        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function vitaminMineralStore(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        VitaminMineral::create([
            'patient_id' => $patient->id,
            'thiamin' => $request->thiamin,
            'pyridoxine' => $request->pyridoxine,
            'cobalamin' => $request->cobalamin,
            'B12' => $request->B12,
            'folate' => $request->folate,
            'iron' => $request->iron,
            'ferritin' => $request->ferritin,
            'vitamin_a' => $request->vitamin_a,
            'OH' => $request->OH,
            'vitamin_e' => $request->vitamin_e,
            'vitamin_k' => $request->vitamin_k,
            'zinc' => $request->zinc,
            'selenium' => $request->selenium,
        ]);

        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function vitaminMineralUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        VitaminMineral::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'thiamin' => $request->thiamin,
            'pyridoxine' => $request->pyridoxine,
            'cobalamin' => $request->cobalamin,
            'B12' => $request->B12,
            'folate' => $request->folate,
            'iron' => $request->iron,
            'ferritin' => $request->ferritin,
            'vitamin_a' => $request->vitamin_a,
            'OH' => $request->OH,
            'vitamin_e' => $request->vitamin_e,
            'vitamin_k' => $request->vitamin_k,
            'zinc' => $request->zinc,
            'selenium' => $request->selenium,
        ]);

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function lipidProfileStore(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        LipidProfile::create([
            'patient_id' => $patient->id,
            'total_cholesterol' => $request->total_cholesterol,
            'HDL_cholesterol' => $request->HDL_cholesterol,
            'LDL_cholesterol' => $request->LDL_cholesterol,
            'triglycerides' => $request->triglycerides,
        ]);
        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function lipidProfileUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        LipidProfile::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'total_cholesterol' => $request->total_cholesterol,
            'HDL_cholesterol' => $request->HDL_cholesterol,
            'LDL_cholesterol' => $request->LDL_cholesterol,
            'triglycerides' => $request->triglycerides,
        ]);

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function thyroidProfileStore(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        ThyroidProfile::create([
            'patient_id' => $patient->id,
            'T4' => $request->T4,
            'T4_free' => $request->T4_free,
            'T3_total' => $request->T3_total,
            'TSH' => $request->TSH,
        ]);
        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function thyroidProfileUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        ThyroidProfile::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'T4' => $request->T4,
            'T4_free' => $request->T4_free,
            'T3_total' => $request->T3_total,
            'TSH' => $request->TSH,
        ]);

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function urineStore(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        Urine::create([
            'patient_id' => $patient->id,
            'amylase' => $request->amylase,
            'creatinine' => $request->creatinine,
            'urea' => $request->urea,
            'Ca' => $request->Ca,
            'Na' => $request->Na,
            'K' => $request->K,
        ]);
        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function urineUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        Urine::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'amylase' => $request->amylase,
            'creatinine' => $request->creatinine,
            'urea' => $request->urea,
            'Ca' => $request->Ca,
            'Na' => $request->Na,
            'K' => $request->K,
        ]);
        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function urineTestStore(Request $request, $slug)
    {

        $patient = Patient::where('slug', $slug)->first();

        UrineTest::create([
            'patient_id' => $patient->id,
            'pH' => $request->pH,
            'protein' => $request->protein,
            'specific_gravity' => $request->specific_gravity,
            'glucose' => $request->glucose,
            'whites_cells' => $request->whites_cells,
            'erythrocytes' => $request->erythrocytes,
        ]);
        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function urineTestUpdate(Request $request, $slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        UrineTest::where('patient_id', $patient->id)->update([
            'patient_id' => $patient->id,
            'pH' => $request->pH,
            'protein' => $request->protein,
            'specific_gravity' => $request->specific_gravity,
            'glucose' => $request->glucose,
            'whites_cells' => $request->whites_cells,
            'erythrocytes' => $request->erythrocytes,
        ]);
        return back()->with('success', 'Datos actualizados correctamente.');
    }
}
