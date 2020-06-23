<?php

namespace App\Http\Controllers;

use Alert;
use App\Fold;
use App\Patient;
use App\Diameter;
use App\Perimeter;
use App\BodyMeasure;
use App\BasicMeasure;
use App\GctDurninCol;
use Illuminate\Http\Request;
use App\BioelectricImpedance;
use App\Traits\MeasurementConverterTrait;
use Illuminate\Support\Facades\Validator;

class AnthropometryController extends Controller
{
    use MeasurementConverterTrait;

    public function index($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        return View('patients.anthropometry.index', compact('patient'));
    }

    public function basicMeasureIndex($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        $records = BasicMeasure::where('patient_id', '=', $patient->id)->latest()->get();

        return view('patients.anthropometry.basicMeasure.history', compact('patient', 'records'));
    }

    public function basicMeasure($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        $basicMeasure = BasicMeasure::where('patient_id', '=', $patient->id)->latest()->first();

        if($basicMeasure)
        {
            return view('patients.anthropometry.basicMeasure.edit', compact('patient', 'basicMeasure'));
        }
        else
        {
            return view('patients.anthropometry.basicMeasure.create', compact('patient'));
        }
    }

    public function basicMeasureCreate($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        
        return view('patients.anthropometry.basicMeasure.create', compact('patient'));
        
    }

    public function basicMeasureEdit($slug,$id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $basicMeasure = BasicMeasure::where('patient_id', '=', $patient->id)->where('id', $id)->first();
        
        return view('patients.anthropometry.basicMeasure.edit', compact('patient', 'basicMeasure'));
        
    }

    public function basicMeasurePost(Request $request)
    {
        
        if($request->pregnancy == 1)
        {
            $messages = [
                'size.required' => 'La talla es requerida',
                'weight.required' => 'El peso es requerido',
                'imc.required' => 'El IMC es requerido',
                'pregnancy.required' => 'Debe seleccionar si existe embarazo',
                'gestation_week.required' => 'Las semanas de gestación es requerida',
                'pregestational_weight.required' => 'El peso pregestacional es requerido',
                'PeIMCpgEG.required' => 'El peso estimado segun el imc es requerido',
                '%PeIMCpgEg.required' => 'El % del peso estimado segun el imc es requerido'
            ];
    
            $rules = [
                'size'                   => 'required',
                'weight'                 => 'required',
                'imc'                    => 'required',
                'pregnancy'              => 'required',
                'gestation_week'         => 'required',
                'pregestational_weight'  => 'required',
                'PeIMCpgEG'              => 'required',
                '%PeIMCpgEg'             => 'required'
            ];
            
        }
        else
        {
            $rules = [
                'size'      => 'required',
                'weight'    => 'required',
                'imc'       => 'required',
                'pregnancy' => 'required'
            ];

            $messages = [
                'size.required' => 'La talla es requerida',
                'weight.required' => 'El peso es requerido',
                'imc.required' => 'El IMC es requerido',
                'pregnancy.required' => 'Debe seleccionar si existe embarazo'
            ];
    
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->all();

        
            if(basicMeasure::create($input))
            {
                return back()->with('success', 'Datos guardados correctamente.');
            }
            else
            {
                return back()->with('error', 'Los datos no fueron guardados.');
            }
        
    }

    public function basicMeasureUpdate(Request $request, $id)
    {
        if($request->pregnancy == 1)
        {
            $messages = [
                'size.required' => 'La talla es requerida',
                'weight.required' => 'El peso es requerido',
                'imc.required' => 'El IMC es requerido',
                'pregnancy.required' => 'Debe seleccionar si existe embarazo',
                'gestation_week.required' => 'Las semanas de gestación es requerida',
                'pregestational_weight.required' => 'El peso pregestacional es requerido',
                'PeIMCpgEG.required' => 'El peso estimado segun el imc es requerido',
                '%PeIMCpgEg.required' => 'El % del peso estimado segun el imc es requerido'
            ];
    
            $rules = [
                'size'                   => 'required',
                'weight'                 => 'required',
                'imc'                    => 'required',
                'pregnancy'              => 'required',
                'gestation_week'         => 'required',
                'pregestational_weight'  => 'required',
                'PeIMCpgEG'              => 'required',
                '%PeIMCpgEg'             => 'required'
            ];
            
        }
        else
        {
            $rules = [
                'size'      => 'required',
                'weight'    => 'required',
                'imc'       => 'required',
                'pregnancy' => 'required'
            ];

            $messages = [
                'size.required' => 'La talla es requerida',
                'weight.required' => 'El peso es requerido',
                'imc.required' => 'El IMC es requerido',
                'pregnancy.required' => 'Debe seleccionar si existe embarazo'
            ];
    
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //return $request->all();

        $input = $request->all();

        $basicMeasure = BasicMeasure::findOrfail($id);
        
        if($request->pregnancy == 0)
        {
            $input['gestation_week'] = null;
            $input['pregestational_weight'] = null;
            $input['PeIMCpgEG'] = null;
            $input['%PeIMCpgEg'] = null;
        }
        

        if($basicMeasure->update($input))
        {
            return back()->with('success', 'Datos guardados correctamente.');
        }
        else
        {
            return back()->with('error', 'Los datos no fueron guardados.');
        }
    }

    public function pregestationalWeightAjax(Request $request)
    {
        if(!isset($request->dataJson))
        {
            return response()->json(['status' => 0, 'error' => 'Falta el parámetro "dataJson" para la solicitud ']);
        }

        $dataJson = json_decode($request->dataJson);

       $pregestational_weight = $dataJson->pregestational_weight;
       $gestation_week = $dataJson->gestation_week;
       $imc = $dataJson->imc;
       $peso = $dataJson->weight;

        if($dataJson->imc < 18.5)
        {
            $const = 0.322;
        }
        elseif($dataJson->imc >= 18.5 && $dataJson->imc <= 24.9)
        {
            $const = 0.267;
        }
        elseif($dataJson->imc >= 25 && $dataJson->imc <= 29.9)
        {
            $const = 0.237;
        }
        elseif($dataJson->imc >= 25 && $dataJson->imc <= 29.9)
        {
            $const = 0.183;
        }

        $PeIMCpgEG = number_format($pregestational_weight + ($const * $gestation_week), 2, '.', ',');
        $PeIMCpgEg_porcent = number_format(($peso/$PeIMCpgEG) * 100, 2, '.', ',');

        return response()->json(['PeIMCpgEG' => $PeIMCpgEG, 'PeIMCpgEg_porcent' => $PeIMCpgEg_porcent]);
    }

    //BodyMeasures Functions
    public function bodyMeasure($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $basicMeasure = BasicMeasure::Where('patient_id', '=', $patient->id)->latest()->first();

        if(!$basicMeasure)
        {
            Alert::error('Debe tomar las medidas basicas del paciente.', 'Error en Medidas Básicas')->autoclose(3500);
            return redirect()->back();
            //return redirect()->back()->with('error', 'Debe tomar las medidas basicas del paciente.');
        }

        $bodyMeasure = BodyMeasure::Where('patient_id', '=', $patient->id)->first();

        if($bodyMeasure)
        {
            $BioelectricImpedance = BioelectricImpedance::Where('body_measure_id', '=', $bodyMeasure->id)->first();
            $Diameter = Diameter::Where('body_measure_id', '=', $bodyMeasure->id)->first();
            $Fold = Fold::Where('body_measure_id', '=', $bodyMeasure->id)->first();
            $Perimeter = Perimeter::Where('body_measure_id', '=', $bodyMeasure->id)->first();

            return view('patients.anthropometry.bodyMeasure.edit', compact('patient', 'bodyMeasure', 'basicMeasure', 'BioelectricImpedance', 'Diameter', 'Fold', 'Perimeter'));
        }
        else
        {
            return view('patients.anthropometry.bodyMeasure.create', compact('patient', 'basicMeasure'));
        }
    }

    public function bodyMeasurePost(Request $request)
    {
        //return $request->all();
        $input = $request->all();

        if(BodyMeasure::create($input))
        {
            $bodyMeasure_id = BodyMeasure::all()->last()->id;
            $input['body_measure_id'] = $bodyMeasure_id;
        }
        else
        {
            return back()->with('error', 'Los datos no fueron guardados.');
        }

        BioelectricImpedance::create($input);
        Diameter::create($input);
        Fold::create($input);

        Perimeter::create($input);

        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function bodyMeasureUpdate(Request $request, $id)
    {
        //return $request->all();
        $tab = $request->tab;
        $input = $request->all();
        $BioelectricImpedance = BioelectricImpedance::Where('body_measure_id', '=', $id)->first();
        $BioelectricImpedance->update($input);

        $Diameter = Diameter::Where('body_measure_id', '=', $id)->first();
        $Diameter->update($input);

        $Fold = Fold::Where('body_measure_id', '=', $id)->first();
        $Fold->update($input);

        $Perimeter = Perimeter::Where('body_measure_id', '=', $id)->first();
        $Perimeter->update($input);

        if(session()->has('tab'))
        {
            session()->forget('tab');
            session(['tab' => $tab]);
        }
        else
        {
            session(['tab' => $tab]);
        }

        return back()->with('success', 'Datos guardados correctamente.')->with('tab', $tab);
    }

    //Composicion Corporal
    public function bodyComposition($slug)
    {
        $patient = Patient::With(['BasicMeasure', 'BodyMeasure.Perimeter'])->where('slug', '=', $slug)->first();

        if($patient->age < 19)
        {
            Alert::error('El paciente debe ser mayor de 18 años para el calculo de medidas Antropometricas.', 'Error en Medidas Básicas')->autoclose(5000);
            return redirect()->back();
        }

        if(!$patient->BasicMeasure)
        {
            Alert::error('Debe tomar las medidas basicas del paciente.', 'Error en Medidas Básicas')->autoclose(3500);
            return redirect()->back();
        }
        
        if(!$patient->BodyMeasure)
        {
            Alert::error('Debe tomar las medidas corporales del paciente.', 'Error en Medidas Corporales')->autoclose(3500);
            return redirect()->back();
        }


        if($patient->BodyMeasure->Fold->tricep == null || $patient->BodyMeasure->Fold->bicep == null || $patient->BodyMeasure->Fold->subescapular == null || $patient->BodyMeasure->Fold->supraespinal == null)
        {
            Alert::error('Debe tomar las medidas de todos los pliegues del paciente.', 'Error en Medidas Corporales')->autoclose(4500);
            return redirect()->back();
        } 

        //calculo de la complexion
        if($patient->BodyMeasure->Perimeter->muneca != 0 || $patient->BodyMeasure->Perimeter->muneca != null)
        {
            $complex = number_format(($patient->BasicMeasure->size * 100)/$patient->BodyMeasure->Perimeter->muneca, 2, '.', '');
        }
        else
        {
            $complex = 0;
        }
        
        //Calculo de ICC (Indice de cintura cadera)
        if($patient->BodyMeasure->Perimeter->cadera != 0 || $patient->BodyMeasure->Perimeter->cadera != null)
        {
            $ICC = number_format($patient->BodyMeasure->Perimeter->cintura/$patient->BodyMeasure->Perimeter->cadera, 2, '.', '');
        }
        else
        {
            $ICC = '';
        }

        //calculo 2 pliegues
        $dos_pliegues = $patient->BodyMeasure->Fold->tricep + $patient->BodyMeasure->Fold->subescapular;
        
        //calculo de densidad corporal Siri (bicep + tricep)
        if($patient->gender == 'Masculino')
        {
            if($patient->age == 19)
            {
                $c = 1.1423;
                $m = 0.0687;
            }
            elseif($patient->age > 19 && $patient->age <= 29)
            {
                $c = 1.1307;
                $m = 0.0603;
            }
            elseif($patient->age > 29 && $patient->age <= 39)
            {
                $c = 1.0995;
                $m = 0.0431;
            }
            elseif($patient->age > 39 && $patient->age <= 49)
            {
                $c = 1.1174;
                $m = 0.0614;
            }
            elseif($patient->age >= 50)
            {
                $c = 1.1185;
                $m = 0.0683;
            }
        }
        elseif($patient->gender == 'Femenino')
        {
            if($patient->age == 19)
            {
                $c = 1.129;
                $m = 0.0657;
            }
            elseif($patient->age > 19 && $patient->age <= 29)
            {
                $c = 1.1398;
                $m = 0.0738;
            }
            elseif($patient->age > 29 && $patient->age <= 39)
            {
                $c = 1.1243;
                $m = 0.0646;
            }
            elseif($patient->age > 39 && $patient->age <= 49)
            {
                $c = 1.123;
                $m = 0.0672;
            }
            elseif($patient->age >= 50)
            {
                $c = 1.1226;
                $m = 0.071;
            }
        }

        $constA = 4.95;
        $constB = 4.5;
        
        $bic_tric = $patient->BodyMeasure->Fold->bicep + $patient->BodyMeasure->Fold->tricep;
        
        if($bic_tric != 0)
        {
            $densidad = $c - ($m * log10($bic_tric));
          
            $siri = number_format((($constA/$densidad) - $constB) * 100, 2, '.', '');

            
        }
        else
        {
            //$siri = 'No hay medicion';
            $siri = 0;
        }

        // Calculo de Durnin y Womersley
        if($bic_tric != 0)
        {
            $DW = number_format((($constA/$densidad) - $constB) * 100, 2, '.','');
        }
        else
        {
            //$DW = 'No hay medicion';
            $DW = 0;
        }

        //%GCT a 4 pliegues Durnin y colaboradores (1974) 
        //Bicep - Tricep -Subescapular - Supraespinal
        //funcion para redondear a multilo de 5
        function roundUpToAny($n,$x=5) { return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x; }
         
        $sum_folds = roundUpToAny($patient->BodyMeasure->Fold->bicep + $patient->BodyMeasure->Fold->tricep + $patient->BodyMeasure->Fold->subescapular + $patient->BodyMeasure->Fold->supraespinal);

        //consultamos la tabla de %GCT de la sumatoria de 4 pliegues de Durnin y Colaboradores
        if($patient->gender == 'Masculino')
        { 
            $gender = \App\GctDurninCol::MALE;
        }
        else {
            $gender = \App\GctDurninCol::FEMALE;
        }

        $DurninCol = GctDurninCol::Where('gender', '=', $gender)->where('sum_folds', '=', $sum_folds)->first();
        
        if($patient->age >= 17 && $patient->age <= 29)
        {
            $pliegues_4 = $DurninCol['age_17_29'];
        }
        elseif($patient->age >= 30 && $patient->age <= 39)
        {
            $pliegues_4 = $DurninCol['age_30_39'];
        }
        elseif($patient->age >= 40 && $patient->age <= 49)
        {
            $pliegues_4 = $DurninCol['age_40_49'];
        }
        elseif($patient->age >= 50)
        {
            $pliegues_4 = $DurninCol['age_more_50'];
        }
  
        //Calculo Deurenberg y Colaboradores
        $constA_Douremberg = 1.2;
        $constB_Douremberg = 0.23;
        $constD_Douremberg = 5.4;

        if($patient->gender == 'Masculino')
        { 
            $constC_Douremberg = 10.8;
        }
        else {
            $constC_Douremberg = 0;
        }
        
        $DeurenbergCol = number_format(($constA_Douremberg * $patient->BasicMeasure->imc) + ($constB_Douremberg * $patient->age) - $constC_Douremberg - $constD_Douremberg, 2, '.', '');
        
        //calculamos Faulkner
        if($patient->gender == 'Masculino')
        { 
            $constA_Faulkner = 5.783;
            $constB_Faulkner = 0.153;
        }
        else {
            $constA_Faulkner = 7.9;
            $constB_Faulkner = 0.213;
        }

        $Faulkner = $constA_Faulkner + (($patient->BodyMeasure->Fold->tricep + $patient->BodyMeasure->Fold->subescapular + $patient->BodyMeasure->Fold->abdominal + $patient->BodyMeasure->Fold->suprailiaco) * $constB_Faulkner);

        //% DE GRASA YUHASZ (6 PLIEGUES)
        if($patient->gender == 'Masculino')
        { 
            $constA_Yuhasz = 3.64;
            $constB_Yuhasz = 0.97;
        }
        else {
            $constA_Yuhasz = 0.456;
            $constB_Yuhasz = 0.153;
        }

        $Yuhastz = $constA_Yuhasz + (($patient->BodyMeasure->Fold->tricep + $patient->BodyMeasure->Fold->subescapular + $patient->BodyMeasure->Fold->suprailiaco + $patient->BodyMeasure->Fold->abdominal + $patient->BodyMeasure->Fold->muslo_frontal + $patient->BodyMeasure->Fold->pantorrilla_medial) * $constB_Yuhasz);
        
        //Impdancia magnetica
        $magnetic_impedance = $patient->BodyMeasure->BioelectricImpedance->total_fat_porcent;

        //promedio
        $prom = number_format(($dos_pliegues + $siri + $DW + $pliegues_4 + $DeurenbergCol + $Faulkner + $Yuhastz + $magnetic_impedance)/8, 2, '.', '');

        //Área Muscular Braquial
        $constA_AMB = 3.1416;
        $constB_AMB = 2;
        $constC_AMB = 12.5654;

        $brazo = $patient->BodyMeasure->Perimeter->brazo_contraido;
        $AMB = number_format((($brazo - ($constA_AMB * $patient->BodyMeasure->Fold->tricep)) * ($brazo - ($constA_AMB * $patient->BodyMeasure->Fold->tricep)))/$constC_AMB, 2, ',', '');

        //Área Muscular Braquial
        //primero calculamos el Area Grasa Muscular Braquial (AMBd)
        $constC_AMBd = 4;
        $pi = 3.1416;
        if($patient->gender == 'Masculino')
        { 
            $constB_AMBd = 10;
        }
        else {
            $constB_AMBd = 6.5;
        }
        $AMBd_result1 = $patient->BodyMeasure->Perimeter->brazo_relajado - ($pi * $this->mmToCm($patient->BodyMeasure->Fold->tricep)) ;
        
        $AMBd_result1 = pow($AMBd_result1,$constB_AMB);
        
        $AMBd_result1 = $AMBd_result1 - $constB_AMB;

        $AMBd = $AMBd_result1/($constC_AMBd * $pi);
        
        if($patient->BodyMeasure->Perimeter->brazo_relajado == 0)
        {
            Alert::error('El perimetro del brazo debe ser diferente de cero.', 'Error en Medidas Básicas')->autoclose(3500);
            return redirect()->back();
        }

        $constB_AB = 12.5654;
        $AB = ($patient->BodyMeasure->Perimeter->brazo_relajado * $patient->BodyMeasure->Perimeter->brazo_relajado)/$constB_AB;

        $AGB = number_format($AB - $AMBd, 2, '.', '');

        //Calculamos el Indice de Area Grasa (IAG)
        $IAG = number_format(($AGB/$AB) * 100, 2, '.', '');

        //Agua Corporal Total
        if($patient->gender == 'Masculino')
        { 
            $constA_ACT = 0.09516;
            $constB_ACT = 10.74;
            $constC_ACT = 0.3362;
            $constD_ACT = 2.447;

            $ACT = number_format(($constA_ACT * $patient->age) + ($constB_ACT * ($patient->BasicMeasure->size * 100)) + ($constC_ACT * $patient->BasicMeasure->weight) + $constD_ACT, 2, '.', '');
        }
        else {
            $constA_ACT = 0.1069;
            $constB_ACT = 0.2466;
            $constC_ACT = 2.097;

            $ACT = number_format(($constA_ACT * ($patient->BasicMeasure->size * 100)) + ($constB_ACT * $patient->BasicMeasure->weight) - $constC_ACT, 2, '.', '');
        }

        //Masa Osea Rocha
        $constA_MOR = 3.02;
        $constB_MOR = 400;
        $constC_MOR = 0.712;
        $talla_MOR = pow($patient->BasicMeasure->size,2);
        $MOR = number_format($constA_MOR * pow(($talla_MOR * $this->cmToMeters($patient->BodyMeasure->Perimeter->muneca) * $this->cmToMeters($patient->BodyMeasure->Diameter->biepicondilar_femur) * $constB_MOR), $constC_MOR), 2, '.', '');
        // dd($patient->BodyMeasure->Perimeter->muneca);
        //Calculamos la Masa Grasa
        $const_MG = 100;
        $MG = number_format(($patient->BasicMeasure->weight * $DeurenbergCol)/$const_MG, 2, '.', '');
        
        //Calculamos la Masa Muscular Total
        $constA_MMT = 0.0264;
        $constB_MMT = 0.0029;

        $MMT = number_format($this->metersToCm($patient->BasicMeasure->size) * ($constA_MMT + ($constB_MMT * $AMBd)), 2, '.', '');
        
        //calculo de Masa Residual. Wurch
        if($patient->gender == 'Masculino')
        { 
            $constA_MR = 24.1;
        }
        else {
            $constA_MR = 20.1;            
        }

        $constB_MR = 100;

        $MR = number_format(($patient->BasicMeasure->weight * $constA_MR)/$constB_MR, 2, '.', '');
        
        //SumatoriaTotal de Masas
        $Sum_Mass = $MOR + $MG + $MMT + $MR;
        
        return View('patients.anthropometry.bodyComposition.index', compact('patient', 'complex', 'ICC', 'dos_pliegues', 'siri', 'DW', 'pliegues_4', 'DeurenbergCol', 'Faulkner', 'Yuhastz', 'magnetic_impedance', 'prom', 'AMB', 'AGB', 'IAG', 'ACT', 'MOR', 'MG', 'MMT', 'MR', 'Sum_Mass'));
    }

    //Somatocarta
    public function Somatocard($slug){
        $patient = Patient::With(['BasicMeasure', 'BodyMeasure.Perimeter'])->where('slug', '=', $slug)->first();
        
        if(!$patient->BasicMeasure)
        {
            Alert::error('Debe tomar las medidas basicas del paciente.', 'Error en Medidas Básicas')->autoclose(3500);
            return redirect()->back();
        }
        
        if(!$patient->BodyMeasure)
        {
            Alert::error('Debe tomar las medidas corporales del paciente.', 'Error en Medidas Corporales')->autoclose(3500);
            return redirect()->back();
        }

        //Calculo de Endomorfia
        $constA_Endomorph = 0.7182;
        $constB_Endomorph = 0.1451;
        $constC_Endomorph = 0.00068;
        $constD_Endomorph = 0.0000014;
        $pliegues_3 = $patient->BodyMeasure->Fold->tricep + $patient->BodyMeasure->Fold->subescapular + $patient->BodyMeasure->Fold->suprailiaco;
        
        $Endomorph = number_format((-$constA_Endomorph) + ($constB_Endomorph * $pliegues_3) - ($constC_Endomorph * pow($pliegues_3, 2)) + ($constD_Endomorph * pow($pliegues_3, 3)), 2, '.', '');
        
        //Calculo de Mesomorfia
        $constA_Mesomorph = 0.858;
        $constB_Mesomorph = 0.601;
        $constC_Mesomorph = 0.188;
        $constD_Mesomorph = 0.161;
        $constE_Mesomorph = 0.131;
        $constF_Mesomorph = 4.5;

        $brazo_corregido = $patient->BodyMeasure->Perimeter->brazo_contraido - $this->mmToCm($patient->BodyMeasure->Fold->tricep);
        
        $pierna_corregido = $patient->BodyMeasure->Perimeter->pantorrilla - $this->mmToCm($patient->BodyMeasure->Fold->pantorrilla_medial);

        $Mesomorph = number_format((($constA_Mesomorph * $patient->BodyMeasure->Diameter->biepicondilar_humero) + ($constB_Mesomorph *$patient->BodyMeasure->Diameter->biepicondilar_femur) + ($constC_Mesomorph * $brazo_corregido) + ($constD_Mesomorph * $pierna_corregido)) - ($constE_Mesomorph * ($patient->BasicMeasure->size * 100)) + $constF_Mesomorph, 2, '.', '');

        //Calculo de Ectoomorfia
        //calculamos el indice ponderal
        $IP = number_format(($patient->BasicMeasure->size * 100)/pow($patient->BasicMeasure->weight, 1/3), 2, '.', '');
        
        if($IP <= 38.25)
        {
            $Ectomorph = 0.1;

        }elseif($IP > 38.25 && $IP < 40.75)
        {
            $constA_Ectomorph = 0.463;
            $constB_Ectomorph = 17.63;

            $Ectomorph = ($constA_Ectomorph * $IP) - $constB_Ectomorph;
        }elseif($IP >= 40.75)
        {
            $constA_Ectomorph = 0.732;
            $constB_Ectomorph = 28.58;

            $Ectomorph = number_format(($constA_Ectomorph * $IP) - $constB_Ectomorph, 2, '.', '');
        }

        //calculamos X
        $EjeX = number_format($Ectomorph - $Endomorph, 2, '.', '');

        //Calculamos Y
        $EjeY = number_format(($Mesomorph * 2) - ($Endomorph + $Ectomorph), 2, '.', '');

        $chart_somatocard = array();

        array_push($chart_somatocard, ['X', 'Y']);
        array_push($chart_somatocard, [(float)$EjeX, (float)$EjeY]);
        //return $chart_somatocard;
        return view('patients.anthropometry.somatocard.index')->with('patient', $patient)
                                                            ->with('chart_somatocard', json_encode($chart_somatocard, JSON_UNESCAPED_UNICODE))
                                                            ->with('Ectomorph', $Ectomorph)
                                                            ->with('Mesomorph', $Mesomorph)
                                                            ->with('Endomorph', $Endomorph)
                                                            ->with('EjeX', $EjeX)
                                                            ->with('EjeY', $EjeY);
    }

    public function evolutionCard($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $records = BasicMeasure::where('patient_id', '=', $patient->id)->get();
        
        return \View('patients.anthropometry.evolutionCard.index', compact('patient','records'));
    }
}
