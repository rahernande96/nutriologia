<?php

namespace App\Http\Controllers;

use Alert;
use App\Met;
use App\Patient;
use App\FoodTime;
use App\FoodGroup;
use Carbon\Carbon;
use App\DietaryHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\EnergyRequirement;//i
use App\TotalEnergyExpenditure;
use App\FoodGroupEquivalent;
use App\EquivalentDistribution;//i ok
use App\EquivalentDistributionDetail;
use Illuminate\Support\Facades\Validator;

class DieteticController extends Controller
{
    public function index($slug, $history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $history = $this->getHistoryById($history_id);
        
        return View('patients.dietetic.index', compact('patient','history'));
    }

    public function energyRequirement($slug,$history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $history = $this->getHistoryById($history_id);
       
        $energy_requirement = EnergyRequirement::where('patient_id', '=', $patient->id)
                                            ->where('history_id', $history->id)
                                            ->first();

        //return redirect()->route('dietetic.get', $slug);
        if($energy_requirement)
        {
            return redirect()->route('dietetic.get', [
                'slug'=>$patient->slug,
                'history_id'=>$history->id
            ]);
        }
        else {
            return View('patients.dietetic.energyRequirement.index', compact('patient','history'));
        }
    }

    public function energyRequirementEdit($slug,$history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        
        $history = $this->getHistoryById($history_id);

        $energy_requirement = EnergyRequirement::where('history_id',$history->id)->where('patient_id', '=', $patient->id)->first(); 
        return View('patients.dietetic.energyRequirement.index', compact('patient', 'history', 'energy_requirement'));
    }

    public function energyRequirementUpdate(Request $request, $id)
    {
        $messages = [
            'patient_id'    => 'El paciente es requerido',
            'history_id'    => 'El paciente es requerido',
            'type_get'      => 'El tipo de calculo de GET es necesario',
            'trimstry'      => 'El trimestre es requerido',
            'semestry'      => 'El semestre es requerido'
        ];

        if($request->has('period'))
        {
            if($request->period == 1)
            {
                $rules = [
                    'patient_id'    => 'required',
                    'history_id'    => 'required',
                    'type_get'      => 'required',
                    'semestry'      => 'required'
                ];
            }
            elseif($request->period == 2)
            {
                $rules = [
                    'patient_id'    => 'required',
                    'history_id'    => 'required',
                    'type_get'      => 'required',
                    'trimestry'      => 'required'
                ];
            }
        }
        else
        {
            $rules = [
                'patient_id'    => 'required',
                'history_id'    => 'required',
                'type_get'      => 'required'
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

        $history = $this->getHistoryById($request->input('history_id'));
        
        $energy_requirement = EnergyRequirement::where('history_id',$history->id)->findOrfail($id);
        
        $patient = Patient::findOrfail($energy_requirement->patient_id);
        
        
        if($energy_requirement->update($input))
        {   
            $total_energy_expenditure =  TotalEnergyExpenditure::Where('energy_requirement_id', '=', $id)->get();
            
            foreach($total_energy_expenditure as $t)
            {
                $t->delete();
            }

            return redirect()->route('dietetic.get', [
                'slug'=>$patient->slug,
                'history_id'=>$history->id
            ]);
        }
        else 
        {
            return back()->with('error', 'Los datos no fueron guardados.');
        }
    }

    public function energyRequirementPost(Request $request)
    {

        $messages = [
            'patient_id'    => 'El paciente es requerido',
            'history_id'    => 'El paciente es requerido',
            'type_get'      => 'El tipo de calculo de GET es necesario',
            'trimstry'      => 'El trimestre es requerido',
            'semestry'      => 'El semestre es requerido'
        ];

        if($request->has('period'))
        {
            if($request->period == 1)
            {
                $rules = [
                    'patient_id'    => 'required',
                    'history_id'    => 'required',
                    'type_get'      => 'required',
                    'semestry'      => 'required'
                ];
            }
            elseif($request->period == 2)
            {
                $rules = [
                    'patient_id'    => 'required',
                    'history_id'    => 'required',
                    'type_get'      => 'required',
                    'trimestry'      => 'required'
                ];
            }
        }
        else
        {
            $rules = [
                'patient_id'    => ['required','numeric','exists:patients,id'],
                'history_id'    => ['required','numeric','exists:dietary_histories,id'],
                'type_get'      => 'required'
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
        $patient = Patient::findOrfail($request->patient_id);
        $history = $this->getHistoryById($request->history_id);

        if(!$history OR !$patient)
        {
            return back()->with('error','Ocurrio un error vuelvelo a intentar.');
        }

        if(EnergyRequirement::create($input))
        {
            $energy_requirement = EnergyRequirement::all()->last();
            
            //return redirect()->route('dietetic.get', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Datos guardados correctamente.');
            return redirect()->route('dietetic.get', [
                'slug'=>$patient->slug,
                'history_id'=>$history->id
            ]);
        }
        else 
        {
            return back()->with('error', 'Los datos no fueron guardados.');
        }
    }

    public function get($slug,$history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        $history = $this->getHistoryById($history_id);
  
        $energy_requirement = EnergyRequirement::where('history_id',$history->id)->where('patient_id', '=', $patient->id)->first();
       
        $total_energy_expenditure = TotalEnergyExpenditure::Where('energy_requirement_id', '=', $energy_requirement->id)->first();

        if(!isset($patient->basicMeasure->weight)){
         
            alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
            return redirect()->route('dietetic.index',[$patient->slug,$history->id]);
    
    
        }


        if($total_energy_expenditure)
        {
            //Constantes
            $gr_Hc = 4;
            $gr_Lp = 9;
            $gr_Pt = 4;
            
            //calculo de Hidratos de Carbono
            $carboHidrates = ($total_energy_expenditure->percentage_carbohydrates * $total_energy_expenditure->get)/100;
            //Calculo de gramos/Kc
            $carboHidrates_gr = number_format($carboHidrates/$gr_Hc, 2, '.', '');
            //Calculo de Lipidos
            $lipids = ($total_energy_expenditure->percentage_lipids * $total_energy_expenditure->get)/100;
            //Calculo de gramos/Kc
            $lipids_gr = number_format($lipids/$gr_Lp, 2, '.', '');


            //Calculo de proteinas
            $protein = ($total_energy_expenditure->percentage_protein * $total_energy_expenditure->get)/100;
            $protein_gr = ($total_energy_expenditure->gr_kg_proteins * $patient->basicMeasure->weight)* $gr_Pt;
            

            //$protein = ($total_energy_expenditure->percentage_protein * $total_energy_expenditure->get)/100;
            //$protein_gr = number_format($protein/$gr_Pt, 2, '.', '');
            
           // $protein_gr = number_format($protein/$gr_Pt, 2, '.', '');
         
            $macro_chart = array();
            array_push($macro_chart, ['Macro', 'Valor']);
            array_push($macro_chart, ['Carbohidratos', $carboHidrates]);
            array_push($macro_chart, ['Lipidos', $lipids]);
            array_push($macro_chart, ['Proteinas', $protein]);
            //return $total_energy_expenditure;
            return view('patients.dietetic.energyRequirement.edit', compact('patient', 'history', 'energy_requirement', 'total_energy_expenditure', 'carboHidrates', 'lipids', 'protein', 'carboHidrates_gr', 'lipids_gr', 'protein_gr'))->with('macro_chart', json_encode($macro_chart, JSON_UNESCAPED_UNICODE));
        }
        else
        {
            
         
            return view('patients.dietetic.energyRequirement.create', compact('patient', 'history', 'energy_requirement'));
        
           
        }

    }

    public function getStore(Request $request)
    {
        $request->validate([
            'patient_id'            => ['required','numeric','exists:patients,id'],
            'history_id'            => ['required','numeric','exists:dietary_histories,id'],
            'energy_requirement_id' => ['required','numeric','exists:energy_requirements,id'],
        ]);

        $history = $this->getHistoryById($request->history_id);

        $energy_requirement = EnergyRequirement::where('history_id',$history->id)->findOrfail($request->energy_requirement_id);
        
        $input = $request->all();
        
        $patient = Patient::findOrfail($request->patient_id);

        if($energy_requirement->type_get == 1) //si el get es rapido
        {
            $messages = [
                'energy_requirement_id'         => 'El requerimiento energetico es necesario', 
                'kcal'                          => 'Las KilosCalorias son requeridas', 
                'supplement'                    => 'El suplemento es requerido', 
                'supplement_value'              => 'El valor del suplemento es requerido', 
                'method_water_requirement'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement'             => 'El requerimiento de agua es requerido',
                
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
    
                    'kcal'                  => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'kcal'                  => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            else {
                
                $rules = [
    
                    'kcal'                  => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
    
            if(!$patient->BasicMeasure)
            {
                alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
                return redirect()->route('anthropometry.basicMeasure', $patient->slug);
            }
            //Calculmos el GET
            //verificamos si existe embarazo
            if($energy_requirement->period != null)
            {
                //Calculo de GET en periodo de Lactancia por Semestre o Periodo de Embarazo
                
                $constA_GEB_HB = 655.1;
                $constB_GEB_HB = 9.56;
                $constC_GEB_HB = 1.85;
                $constD_GEB_HB = 4.98;
    
                //calculamos el GEB (Gasto Energetico Basal - Harris Benedict)
                $GEB = number_format($constA_GEB_HB + ($patient->BasicMeasure->weight * $constB_GEB_HB) + ($patient->BasicMeasure->size * $constC_GEB_HB) - ($patient->age * $constB_GEB_HB), 2, '.', '');
    
                $get = $GEB + $request->kcal;
            }    
            else 
            {

                
                if($request->has('supplement_value'))
                {
                    $get = ($patient->BasicMeasure->weight * $request->kcal) - $request->supplement_value;
                }
                else {
                    $get = $patient->BasicMeasure->weight * $request->kcal;
                }   
            }
            //Calculamos el requerimiento hidrico en caso de ser necesario
            if($request->has('method_water_requirement'))
            {
                if($request->method_water_requirement == 1)
                {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }
                    elseif($patient->age >= 16 && $patient->age < 20)
                    {
                        $const_water = 40;
                    }
                    elseif($patient->age >= 20 && $patient->age <= 75)
                    {
                        $const_water = 35;
                    }
                    elseif($patient->age > 75)
                    {
                        $const_water = 25;
                    }
    
                    $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                }
                elseif($request->method_water_requirement == 2)
                {
                    if(!$request->has('water_requirement_ml_kcal'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $const_water_kcal = $request->water_requirement_ml_kcal;
                    $water_requirement = number_format($get * $const_water_kcal, 2, '.', '');
                    $input['water_requirement_ml_kcal'] = $const_water_kcal;
                }
                elseif($request->method_water_requirement == 3)
                {
                    if(!$request->has('water_requirement_manual'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $water_requirement = number_format($request->water_requirement_manual, 2, '.', '');
                    $input['water_requirement_manual'] = $request->water_requirement_manual;
                }
    
                $input['water_requirement'] = $water_requirement;
            }
        
            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
    
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
    
            $input['get'] = $get;

            if(TotalEnergyExpenditure::create($input))
            {
                return back()->with('success', 'Los datos fueron guardados.');
            }
            else
            {
                return back()->with('error', 'Los datos no fueron guardados.');
            }
        }
        
        if($energy_requirement->type_get == 2) //si el get es con formula
        {
            $messages = [
                'energy_requirement_id'         => 'El requerimiento energetico es necesario', 
                'kcal'                          => 'Las KilosCalorias son requeridas', 
                'supplement'                    => 'El suplemento es requerido', 
                'supplement_value'              => 'El valor del suplemento es requerido', 
                'method_water_requirement'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement'             => 'El requerimiento de agua es requerido',
                'percentage_carbohydrates.required'      => 'El porcentaje de carbohidratos es requerido',    
                'percentage_lipids.required'             => 'El porcentaje de lipidos es requerido',  
                'percentage_protein.required'            => 'El porcentaje de proteinas es requerido'      
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
    
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            else {
                
                $rules = [
    
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
    
            if(!$patient->BasicMeasure)
            {
                alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
                return redirect()->route('anthropometry.basicMeasure', $patient->slug);
            }
            $input = $request->all();
            //verificamos que tipo de peso fue seleccionado
            if($request->weight_type == 1)//obtenemos el peso actual del paciente
            {
                if($patient->basicMeasure)
                {
                    $weight = $patient->basicMeasure->weight;
                }
                else
                {
                    alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                    return back();
                }
                
            }
            elseif($request->weight_type == 2)//obtenemos el peso ideal
            {
                if($patient->gender == 'Masculino')
                {
                    //formula para hombres (talla)^2 * 23(constante)
                    $weight = pow($patient->basicMeasure->size, 2) * 23;
                }
                elseif($patient->gender == 'Femenino')
                {
                    //formula para mujeres (talla)^2 * 22(constante)
                    $weight = pow($patient->basicMeasure->size, 2) * 22;
                }
            }
            elseif($request->weight == 3)//obtenemos el peso corregido para obesidad
            {
                if($patient->gender == 'Masculino')
                {
                    if($patient->basicMeasure)
                    {
                        $actual_weight = $patient->basicMeasure->weight;
                        $ideal_weight = pow($patient->basicMeasure->size, 2) * 23;
                    }
                    else
                    {
                        alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                        return back();
                    }
                 
                }
                elseif($patient->gender == 'Femenino')
                {
                    if($patient->basicMeasure)
                    {
                        $actual_weight = $patient->basicMeasure->weight;
                        $ideal_weight = pow($patient->basicMeasure->size, 2) * 22;
                    }
                    else
                    {
                        alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                        return back();
                    }
                }

                //formula ((peso actual - peso ideal) * 0.25) + peso ideal
                $weight = (($actual_weight - $ideal_weight) * 0.25) + $ideal_weight;
            }

            //verificamos la formula
            if($request->formula == 1)
            {
                //Fórmula GEB Gasto Energético Basal (Harris Benedict - la más común) HB
                if($patient->gender == 'Masculino')
                {
                    $constA_HB = 66.5;
                    $constB_HB = 13.75;
                    $constC_HB = 5;
                    $constD_HB = 6.78;
                }
                elseif($patient->gender == 'Femenino')
                {
                    $constA_HB = 655.1;
                    $constB_HB = 9.56;
                    $constC_HB = 1.85;
                    $constD_HB = 4.68;
                }

                //Formula: : constante A + peso KG x constante B + constante C x talla - constante D x edad
                $GEB = $constA_HB + ($weight * $constB_HB) + ($constC_HB * $patient->basicMeasure->size) - ($constD_HB * $patient->age);
            }
            elseif($request->formula == 2)
            {
                //Fórmula GEB Mifflin-St Jeor (para personas con obesidad) MF Y ST.J.

                //constante comunes a ambos sexos
                $constA_MFYSTJ = 9.99;
                $constB_MFYSTJ = 6.25;
                $constC_MFYSTJ = 4.92;

                if($patient->gender == 'Masculino')
                {
                    $constD_MFYSTJ = 5;

                    //formula: constante A x peso KG + constante B x talla CM - constante C x edad AÑOS + constante D
                    $GEB = ($constA_MFYSTJ * $patient->basicMeasure->weight) + ($constB_MFYSTJ * ($patient->basicMeasure->size * 100)) - ($constC_MFYSTJ * $patient->basicMeasure->age) + $constD_MFYSTJ;
                }
                elseif($patient->gender == 'Femenino')
                {
                    $constD_MFYSTJ = 161;

                    //formula: constante A x peso KG + constante B x talla CM - constante C x edad AÑOS - constante D
                    $GEB = ($constA_MFYSTJ * $patient->basicMeasure->weight) + ($constB_MFYSTJ * ($patient->basicMeasure->size * 100)) - ($constC_MFYSTJ * $patient->basicMeasure->age) - $constD_MFYSTJ;
                }
            }
            elseif($request->formula == 3)
            {
                //Fórmula GEB FAO/OMS

                if($patient->gender == 'Masculino')
                {
                    if($patient->basicMeasure->age >= 18 && $patient->basicMeasure->age <= 30)
                    {
                        $constA_FO = 15.3;
                        $constB_FO = 679;
                    }
                    elseif($patient->basicMeasure->age >= 31 && $patient->basicMeasure->age <= 60)
                    {
                        $constA_FO = 11.6;
                        $constB_FO = 879;
                    }
                    elseif($patient->basicMeasure->age > 60)
                    {
                        $constA_FO = 13.5;
                        $constB_FO = 987;
                    }
                }
                elseif($patient->gender == 'Femenino')
                {
                    if($patient->basicMeasure->age >= 18 && $patient->basicMeasure->age <= 30)
                    {
                        $constA_FO = 14.7;
                        $constB_FO = 496;
                    }
                    elseif($patient->basicMeasure->age >= 31 && $patient->basicMeasure->age <= 60)
                    {
                        $constA_FO = 8.7;
                        $constB_FO = 829;
                    }
                    elseif($patient->basicMeasure->age > 60)
                    {
                        $constA_FO = 10.5;
                        $constB_FO = 596;
                    }
                }

                //Formula: constante A x peso KG + constante B
                $GEB = ($constA_FO * $patient->basicMeasure->weight) + $constB_FO;
                     
            }

            if($request->has('thermic_effect'))
            {
                //Efecto Termico de los alimentos

                //Formula: 10% del GEB
                $ETA = number_format((10/100) * $GEB, 2, '.', '');
            }

            //evaluamos si existe el factor de estress
            if($request->has('stress_factor'))
            {
                if($request->stress_factor == 1)//evaluamos si es factor de estress
                {
                    if($request->stress_factor_type == 1)//evaluamos si es actividad fisica
                    {
                        $fisic_activity = $request->fisic_activity;

                        //obtenemos la constante segun la actividad fisica
                        switch ($fisic_activity) {
                            case 1:
                               $const_FA = 1;
                                break;
                            case 2:
                                $const_FA = 1.14;
                                break;
                            case 3:
                                $const_FA = 1.27;
                                break;
                            case 4:
                                $const_FA = 1.45;
                                break;
                            case 5:
                                $const_FA = 1;
                                break;
                        }

                        //tomamos la fisic_activity_value como el GET
                        if($request->has('thermic_effect'))//si existe el ETA lo sumamos
                        {
                            //$fisic_activity_value = (($GEB + $ETA) * $const_FA);
                            $get = (($GEB + $ETA) * $const_FA);
                        }
                        else//de lo contrario no
                        {
                            //$fisic_activity_value = ($GEB * $const_FA);
                            $get = ($GEB * $const_FA);
                        }
                    }
                    elseif($request->stress_factor_type == 2)//evaluamos si es estress metabolico
                    {
                        $methabolic_stress = $request->methabolic_stress;

                         //obtenemos la constante segun la actividad fisica
                         switch ($methabolic_stress) {
                            case 1:
                               $const_MS = 0.85;
                                break;
                            case 2:
                                $const_MS = 1.3;
                                break;
                            case 3:
                                $const_MS = 1.05;
                                break;
                            case 4:
                                $const_MS = 1.8;
                                break;
                            case 5:
                                $const_MS = 1.2;
                                break;
                            case 6:
                                $const_MS = 1.5;
                                break;
                            case 7:
                                $const_MS = 1.4;
                                break;
                            case 8:
                                $const_MS = 1;
                                break;
                            case 9:
                                $const_MS = 1.2;
                                break;
                            case 10:
                                $const_MS = 1.3;
                                break;
                            case 11:
                                $const_MS = 1.5;
                                break;
                            case 12:
                                $const_MS = 1;
                                break;
                            case 13:
                                $const_MS = 1;
                                break;
                        }

                        if($request->has('thermic_effect'))
                        {
                            //$methabolic_stress_value = (($GEB + $ETA) * $const_MS);
                            $get = (($GEB + $ETA) * $const_MS);
                        }
                        else
                        {
                            //$methabolic_stress_value = ($GEB * $const_MS);
                            $get = ($GEB * $const_MS);
                        }
                    }
                }
                elseif($request->stress_factor == 2)
                {
                    //GET CON METs A PARTIR DEL A PARTIR DE LA TASA METABÓLICA (O SEA, GEB)

                    //formula: ((MET X CONSTANTE x PESO) MIN) + GEB
                    $const_MET = 0.0175;

                    $get = ($request->met * $const_MET * $patient->basicMeasure->weight * $request->activity_time) + $GEB;

                }
            }

            //Calculamos el requerimiento hidrico en caso de ser necesario
            if($request->has('method_water_requirement'))
            {
                if($request->method_water_requirement == 1)
                {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }

                    if($patient->age >= 16 && $patient->age < 20)
                    {
                        $const_water = 40;
                    }
                    elseif($patient->age >= 20 && $patient->age <= 75)
                    {
                        $const_water = 35;
                    }
                    elseif($patient->age > 75)
                    {
                        $const_water = 25;
                    }
 
                    $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                }
                elseif($request->method_water_requirement == 2)
                {
                    $const_water_kcal = 1;
                    $water_requirement = number_format($get * $const_water_kcal, 2, '.', '');
                }
                elseif($request->method_water_requirement == 3)
                {
                    $water_requirement = number_format($request->water_requirement, 2, '.', '');
                }
    
                $input['water_requirement'] = $water_requirement;
            }
            
            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
    
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
            
            //validamos si existen suplementos
            if($request->has('supplement_value'))
            {
                $get = $get - $request->supplement_value;
            }
            
            $input['get'] = $get;

            if(TotalEnergyExpenditure::create($input))
            {
                return back()->with('success', 'Los datos fueron guardados.');
            }
            else
            {
                return back()->with('error', 'Los datos no fueron guardados.');
            }
        }

        if($energy_requirement->type_get == 3) //si el get es manual
        {
            $messages = [
                'energy_requirement_id.required'         => 'El requerimiento energetico es necesario', 
                'get.required'                           => 'El get es requerido',
                'kcal.required'                          => 'Las KilosCalorias son requeridas', 
                'supplement.required'                    => 'El suplemento es requerido', 
                'supplement_value.required'              => 'El valor del suplemento es requerido', 
                'method_water_requirement.required'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement.required'             => 'El requerimiento de agua es requerido',
                'percentage_carbohydrates.required'      => 'El porcentaje de carbohidratos es requerido',    
                'percentage_lipids.required'             => 'El porcentaje de lipidos es requerido',  
                'percentage_protein.required'            => 'El porcentaje de proteinas es requerido'      
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
    
                    'get'                   => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'get'                   => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            else {
                
                $rules = [
    
                    'get'                   => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
    
            if(!$patient->BasicMeasure)
            {
                alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
                return redirect()->route('anthropometry.basicMeasure', $patient->slug);
            }
            
            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
    
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
            
            //validamos si existen suplementos
            if($request->has('supplement_value'))
            {
                $get = $request->get - $request->supplement_value;
                $input['get'] = $get;
            }
            else
            {
                $get = $request->get;
            }

            //Calculamos el requerimiento hidrico en caso de ser necesario
            if($request->has('method_water_requirement'))
            {
                if($request->method_water_requirement == 1)
                {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }
                    elseif($patient->age >= 16 && $patient->age < 20)
                    {
                        $const_water = 40;
                    }
                    elseif($patient->age >= 20 && $patient->age <= 75)
                    {
                        $const_water = 35;
                    }
                    elseif($patient->age > 75)
                    {
                        $const_water = 25;
                    }
    
                    $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                }
                elseif($request->method_water_requirement == 2)
                {
                    if(!$request->has('water_requirement_ml_kcal'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $const_water_kcal = $request->water_requirement_ml_kcal;
                    $water_requirement = number_format($get * $const_water_kcal, 2, '.', '');
                    $input['water_requirement_ml_kcal'] = $const_water_kcal;
                }
                elseif($request->method_water_requirement == 3)
                {
                    if(!$request->has('water_requirement_manual'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $water_requirement = number_format($request->water_requirement_manual, 2, '.', '');
                    $input['water_requirement_manual'] = $request->water_requirement_manual;
                }
    
                $input['water_requirement'] = $water_requirement;
            }
            
            if(TotalEnergyExpenditure::create($input))
            {
                return redirect()->route('dietetic.get', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Datos guardados correctamente.');
            }
            else
            {
                return redirect()->back()->with('error', 'Los datos no fueron guardados.');
            }
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $request->validate([
            'patient_id'            => ['required','numeric','exists:patients,id'],
            'history_id'            => ['required','numeric','exists:dietary_histories,id'],
            'energy_requirement_id' => ['required','numeric','exists:energy_requirements,id'],
        ]);

        $history = $this->getHistoryById($request->history_id);

        $patient = Patient::findOrfail($request->patient_id);

        $energy_requirement = EnergyRequirement::where('history_id',$history->id)->findOrfail($request->energy_requirement_id);
        
        $total_energy_expenditure = TotalEnergyExpenditure::findOrfail($id);
      
        if($energy_requirement->type_get == 1)
        {
            $messages = [
                'energy_requirement_id.required'         => 'El requerimiento energetico es necesario', 
                'kcal.required'                          => 'Las KilosCalorias son requeridas', 
                'supplement.required'                    => 'El suplemento es requerido', 
                'supplement_value.required'              => 'El valor del suplemento es requerido', 
                'method_water_requirement.required'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement.required'             => 'El requerimiento de agua es requerido',
                'percentage_carbohydrates.required'      => 'El porcentaje de carbohidratos es requerido',    
                'percentage_lipids.required'             => 'El porcentaje de lipidos es requerido',  
                'percentage_protein.required'            => 'El porcentaje de proteinas es requerido'      
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
                    
                    'kcal'                      => 'required',
                    'supplement_value'          => 'required',
                    'method_water_requirement'  => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'      
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'kcal'                  => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'
                ];
            }
            else {
                
                $rules = [
    
                    'kcal'                  => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
    
            if(($request->percentage_carbohydrates + $request->percentage_lipids + $request->percentage_protein) != 100)
            {
                alert()->error('La suma de los porcentajes de ser igual a 100', 'Error en porcentaje')->persistent('Close');
                return back();
            }
    
            $input = $request->all();

            //Calculmos el GET
            //verificamos si existe embarazo
            if($energy_requirement->period != null)
            {
                //Calculo de GET en periodo de Lactancia por Semestre o Periodo de Embarazo
                
                $constA_GEB_HB = 655.1;
                $constB_GEB_HB = 9.56;
                $constC_GEB_HB = 1.85;
                $constD_GEB_HB = 4.98;
    
                //calculamos el GEB (Gasto Energetico Basal - Harris Benedict)
                $GEB = number_format($constA_GEB_HB + ($patient->BasicMeasure->weight * $constB_GEB_HB) + ($patient->BasicMeasure->size * $constC_GEB_HB) - ($patient->age * $constB_GEB_HB), 2, '.', '');
    
                $get = $GEB + $request->kcal;
            }    
            else 
            {
                
                if($request->has('supplement_value'))
                {
                    $get = ($patient->BasicMeasure->weight * $request->kcal) - $request->supplement_value;
                }
                else {
                    $get = $patient->BasicMeasure->weight * $request->kcal;
                }
                 
            }
           
            $input['get'] = $get;
             //Calculamos el requerimiento hidrico en caso de ser necesario
            if($request->has('method_water_requirement'))
            {
                if($request->method_water_requirement == 1)
                {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }
                    elseif($patient->age >= 16 && $patient->age < 20)
                    {
                        $const_water = 40;
                    }
                    elseif($patient->age >= 20 && $patient->age <= 75)
                    {
                        $const_water = 35;
                    }
                    elseif($patient->age > 75)
                    {
                        $const_water = 25;
                    }
    
                    $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                }
                elseif($request->method_water_requirement == 2)
                {
                    if(!$request->has('water_requirement_ml_kcal'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $const_water_kcal = $request->water_requirement_ml_kcal;
                    $water_requirement = number_format($total_energy_expenditure->get * $const_water_kcal, 2, '.', '');
                    $input['water_requirement_ml_kcal'] = $const_water_kcal;
                }
                elseif($request->method_water_requirement == 3)
                {
                    if(!$request->has('water_requirement_manual'))
                    {
                        alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                        return redirect()->back();
                    }
                    $water_requirement = number_format($request->water_requirement_manual, 2, '.', '');
                    $input['water_requirement_manual'] = $request->water_requirement_manual;
                }
 
                $input['water_requirement'] = $water_requirement;
            }
           
            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
    
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
                
            if($total_energy_expenditure->update($input))
            {
                return redirect()->route('dietetic.get', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Datos guardados correctamente.');
            }
            else
            {
                return redirect()->back()->with('error', 'Los datos no fueron guardados.');
            }
        }

        if($energy_requirement->type_get == 2) //si el get es con formula
        {
            $messages = [
                'energy_requirement_id'         => 'El requerimiento energetico es necesario', 
                'kcal'                          => 'Las KilosCalorias son requeridas', 
                'supplement'                    => 'El suplemento es requerido', 
                'supplement_value'              => 'El valor del suplemento es requerido', 
                'method_water_requirement'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement'             => 'El requerimiento de agua es requerido',
                'percentage_carbohydrates.required'      => 'El porcentaje de carbohidratos es requerido',    
                'percentage_lipids.required'             => 'El porcentaje de lipidos es requerido',  
                'percentage_protein.required'            => 'El porcentaje de proteinas es requerido'      
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
    
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            else {
                
                $rules = [
    
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
    
            if(!$patient->BasicMeasure)
            {
                alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
                return redirect()->route('anthropometry.basicMeasure', $patient->slug);
            }
            $input = $request->all();
            //verificamos que tipo de peso fue seleccionado
            if($request->weight_type == 1)//obtenemos el peso actual del paciente
            {
                if($patient->basicMeasure)
                {
                    $weight = $patient->basicMeasure->weight;
                }
                else
                {
                    alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                    return back();
                }
                
            }
            elseif($request->weight_type == 2)//obtenemos el peso ideal
            {
                if($patient->gender == 'Masculino')
                {
                    //formula para hombres (talla)^2 * 23(constante)
                    $weight = pow($patient->basicMeasure->size, 2) * 23;
                }
                elseif($patient->gender == 'Femenino')
                {
                    //formula para mujeres (talla)^2 * 22(constante)
                    $weight = pow($patient->basicMeasure->size, 2) * 22;
                }
            }
            elseif($request->weight == 3)//obtenemos el peso corregido para obesidad
            {
                if($patient->gender == 'Masculino')
                {
                    if($patient->basicMeasure)
                    {
                        $actual_weight = $patient->basicMeasure->weight;
                        $ideal_weight = pow($patient->basicMeasure->size, 2) * 23;
                    }
                    else
                    {
                        alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                        return back();
                    }
                 
                }
                elseif($patient->gender == 'Femenino')
                {
                    if($patient->basicMeasure)
                    {
                        $actual_weight = $patient->basicMeasure->weight;
                        $ideal_weight = pow($patient->basicMeasure->size, 2) * 22;
                    }
                    else
                    {
                        alert()->error('El paciente no tiene Peso, de tomar medidas basicas.', 'Error en el Peso')->persistent('Close');
                        return back();
                    }
                }

                //formula ((peso actual - peso ideal) * 0.25) + peso ideal
                $weight = (($actual_weight - $ideal_weight) * 0.25) + $ideal_weight;
            }

            //verificamos la formula
            if($request->formula == 1)
            {
                //Fórmula GEB Gasto Energético Basal (Harris Benedict - la más común) HB
                if($patient->gender == 'Masculino')
                {
                    $constA_HB = 66.5;
                    $constB_HB = 13.75;
                    $constC_HB = 5;
                    $constD_HB = 6.78;
                }
                elseif($patient->gender == 'Femenino')
                {
                    $constA_HB = 655.1;
                    $constB_HB = 9.56;
                    $constC_HB = 1.85;
                    $constD_HB = 4.68;
                }

                //Formula: : constante A + peso KG x constante B + constante C x talla - constante D x edad
                $GEB = $constA_HB + ($weight * $constB_HB) + ($constC_HB * $patient->basicMeasure->size) - ($constD_HB * $patient->age);
            }
            elseif($request->formula == 2)
            {
                //Fórmula GEB Mifflin-St Jeor (para personas con obesidad) MF Y ST.J.

                //constante comunes a ambos sexos
                $constA_MFYSTJ = 9.99;
                $constB_MFYSTJ = 6.25;
                $constC_MFYSTJ = 4.92;

                if($patient->gender == 'Masculino')
                {
                    $constD_MFYSTJ = 5;

                    //formula: constante A x peso KG + constante B x talla CM - constante C x edad AÑOS + constante D
                    $GEB = ($constA_MFYSTJ * $patient->basicMeasure->weight) + ($constB_MFYSTJ * ($patient->basicMeasure->size * 100)) - ($constC_MFYSTJ * $patient->basicMeasure->age) + $constD_MFYSTJ;
                }
                elseif($patient->gender == 'Femenino')
                {
                    $constD_MFYSTJ = 161;

                    //formula: constante A x peso KG + constante B x talla CM - constante C x edad AÑOS - constante D
                    $GEB = ($constA_MFYSTJ * $patient->basicMeasure->weight) + ($constB_MFYSTJ * ($patient->basicMeasure->size * 100)) - ($constC_MFYSTJ * $patient->basicMeasure->age) - $constD_MFYSTJ;
                }
            }
            elseif($request->formula == 3)
            {
                //Fórmula GEB FAO/OMS

                if($patient->gender == 'Masculino')
                {
                    if($patient->age >= 18 && $patient->age <= 30)
                    {
                        $constA_FO = 15.3;
                        $constB_FO = 679;
                    }
                    elseif($patient->age >= 31 && $patient->age <= 60)
                    {
                        $constA_FO = 11.6;
                        $constB_FO = 879;
                    }
                    elseif($patient->age > 60)
                    {
                        $constA_FO = 13.5;
                        $constB_FO = 987;
                    }
                }
                elseif($patient->gender == 'Femenino')
                {
                    if($patient->age >= 18 && $patient->age <= 30)
                    {
                        $constA_FO = 14.7;
                        $constB_FO = 496;
                    }
                    elseif($patient->age >= 31 && $patient->age <= 60)
                    {
                        $constA_FO = 8.7;
                        $constB_FO = 829;
                    }
                    elseif($patient->age > 60)
                    {
                        $constA_FO = 10.5;
                        $constB_FO = 596;
                    }
                }

                //Formula: constante A x peso KG + constante B
                $GEB = ($constA_FO * $patient->basicMeasure->weight) + $constB_FO;
                     
            }

            if($request->has('thermic_effect'))
            {
                //Efecto Termico de los alimentos

                //Formula: 10% del GEB
                $ETA = number_format((10/100) * $GEB, 2, '.', '');
            }

            //evaluamos si existe el factor de estress
            if($request->has('stress_factor'))
            {
                if($request->stress_factor == 1)//evaluamos si es factor de estress
                {
                    if($request->stress_factor_type == 1)//evaluamos si es actividad fisica
                    {
                        $fisic_activity = $request->fisic_activity;

                        //obtenemos la constante segun la actividad fisica
                        switch ($fisic_activity) {
                            case 1:
                               $const_FA = 1;
                                break;
                            case 2:
                                $const_FA = 1.14;
                                break;
                            case 3:
                                $const_FA = 1.27;
                                break;
                            case 4:
                                $const_FA = 1.45;
                                break;
                            case 5:
                                $const_FA = 1;
                                break;
                        }

                        //tomamos la fisic_activity_value como el GET
                        if($request->has('thermic_effect'))//si existe el ETA lo sumamos
                        {
                            //$fisic_activity_value = (($GEB + $ETA) * $const_FA);
                            $get = (($GEB + $ETA) * $const_FA);
                        }
                        else//de lo contrario no
                        {
                            //$fisic_activity_value = ($GEB * $const_FA);
                            $get = ($GEB * $const_FA);
                        }
                    }
                    elseif($request->stress_factor_type == 2)//evaluamos si es estress metabolico
                    {
                        $methabolic_stress = $request->methabolic_stress;

                         //obtenemos la constante segun la actividad fisica
                         switch ($methabolic_stress) {
                            case 1:
                               $const_MS = 0.85;
                                break;
                            case 2:
                                $const_MS = 1.3;
                                break;
                            case 3:
                                $const_MS = 1.05;
                                break;
                            case 4:
                                $const_MS = 1.8;
                                break;
                            case 5:
                                $const_MS = 1.2;
                                break;
                            case 6:
                                $const_MS = 1.5;
                                break;
                            case 7:
                                $const_MS = 1.4;
                                break;
                            case 8:
                                $const_MS = 1;
                                break;
                            case 9:
                                $const_MS = 1.2;
                                break;
                            case 10:
                                $const_MS = 1.3;
                                break;
                            case 11:
                                $const_MS = 1.5;
                                break;
                            case 12:
                                $const_MS = 1;
                                break;
                            case 13:
                                $const_MS = 1;
                                break;
                        }

                        if($request->has('thermic_effect'))
                        {
                            //$methabolic_stress_value = (($GEB + $ETA) * $const_MS);
                            $get = (($GEB + $ETA) * $const_MS);
                        }
                        else
                        {
                            //$methabolic_stress_value = ($GEB * $const_MS);
                            $get = ($GEB * $const_MS);
                        }
                    }
                }
                elseif($request->stress_factor == 2)
                {
                    //GET CON METs A PARTIR DEL A PARTIR DE LA TASA METABÓLICA (O SEA, GEB)

                    //formula: ((MET X CONSTANTE x PESO) MIN) + GEB
                    $const_MET = 0.0175;

                    $get = ($request->met * $const_MET * $patient->basicMeasure->weight * $request->activity_time) + $GEB;

                }
            }

            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
    
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
            
            //validamos si existen suplementos
            if($request->has('supplement_value'))
            {
                $get = $get - $request->supplement_value;
            }

             //Calculamos el requerimiento hidrico en caso de ser necesario
             if($request->has('method_water_requirement'))
             {
                 if($request->method_water_requirement == 1)
                 {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }
                     elseif($patient->age >= 16 && $patient->age < 20)
                     {
                         $const_water = 40;
                     }
                     elseif($patient->age >= 20 && $patient->age <= 75)
                     {
                         $const_water = 35;
                     }
                     elseif($patient->age > 75)
                     {
                         $const_water = 25;
                     }
     
                     $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                 }
                 elseif($request->method_water_requirement == 2)
                 {
                     if(!$request->has('water_requirement_ml_kcal'))
                     {
                         alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                         return redirect()->back();
                     }
                     $const_water_kcal = $request->water_requirement_ml_kcal;
                     $water_requirement = number_format($get * $const_water_kcal, 2, '.', '');
                     $input['water_requirement_ml_kcal'] = $const_water_kcal;
                 }
     
                 $input['water_requirement'] = $water_requirement;
             }
            
            
            $input['get'] = $get;

            if($total_energy_expenditure->update($input))
            {
                return redirect()->route('dietetic.get', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Datos guardados correctamente.');
            }
            else
            {
                return redirect()->back()->with('error', 'Los datos no fueron guardados.');
            }
        }

        if($energy_requirement->type_get == 3)
        {
            $messages = [
                'energy_requirement_id.required'         => 'El requerimiento energetico es necesario', 
                'get.required'                           => 'El get es requerido',
                'kcal.required'                          => 'Las KilosCalorias son requeridas', 
                'supplement.required'                    => 'El suplemento es requerido', 
                'supplement_value.required'              => 'El valor del suplemento es requerido', 
                'method_water_requirement.required'      => 'El metodo del requerimiento de agua es requerido', 
                'water_requirement.required'             => 'El requerimiento de agua es requerido',
                'percentage_carbohydrates.required'      => 'El porcentaje de carbohidratos es requerido',    
                'percentage_lipids.required'             => 'El porcentaje de lipidos es requerido',  
                'percentage_protein.required'            => 'El porcentaje de proteinas es requerido'      
            ];
    
            if($request->has('supplement') && $request->has('method_water_requirement'))
            {
                $rules = [
    
                    'get'                   => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            elseif($request->has('supplement'))
            {
                $rules = [
    
                    'get'                   => 'required',
                    'supplement_value'      => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
            }
            else {
                
                $rules = [
    
                    'get'                   => 'required',
                    'percentage_carbohydrates'  => 'required',    
                    'percentage_lipids'         => 'required',  
                    'percentage_protein'        => 'required'  
                ];
                
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            if(!$patient->BasicMeasure)
            {
                alert()->error('El paciente no tiene las medidas basicas, debe tomarlas')->persistent('Close');
                return redirect()->route('anthropometry.basicMeasure', $patient->slug);
            }

             //Calculamos el requerimiento hidrico en caso de ser necesario
             if($request->has('method_water_requirement'))
             {
                 if($request->method_water_requirement == 1)
                 {
                    if($patient->age < 16)
                    {
                        alert()->error('El paciente es menor de 16 años, no se puede calcular el requerimiento hidrico.', 'Error en el Edad')->persistent('Close');
                        return back();
                    }
                     elseif($patient->age >= 16 && $patient->age < 20)
                     {
                         $const_water = 40;
                     }
                     elseif($patient->age >= 20 && $patient->age <= 75)
                     {
                         $const_water = 35;
                     }
                     elseif($patient->age > 75)
                     {
                         $const_water = 25;
                     }
     
                     $water_requirement = number_format($patient->BasicMeasure->weight * $const_water, 2, '.', '');
                 }
                 elseif($request->method_water_requirement == 2)
                 {
                     if(!$request->has('water_requirement_ml_kcal'))
                     {
                         alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                         return redirect()->back();
                     }
                     $const_water_kcal = $request->water_requirement_ml_kcal;
                     $water_requirement = number_format($total_energy_expenditure->get * $const_water_kcal, 2, '.', '');
                     $input['water_requirement_ml_kcal'] = $const_water_kcal;
                 }
                 elseif($request->method_water_requirement == 3)
                 {
                     if(!$request->has('water_requirement_manual'))
                     {
                         alert()->error('Debe ingresar las ml/kcal para el requerimiento hidrico')->persistent('Close');
                         return redirect()->back();
                     }
                     $water_requirement = number_format($request->water_requirement_manual, 2, '.', '');
                     $input['water_requirement_manual'] = $request->water_requirement_manual;
                 }
     
                 $input['water_requirement'] = $water_requirement;
             }

            //obtenermos los porcentages de macronutientes que el doctor ingresa
            $percentage_carbohydrates = $request->percentage_carbohydrates;
            $percentage_lipids = $request->percentage_lipids;
            $percentage_protein = $request->percentage_protein;
        
            //los agregamos al input
            $input['percentage_carbohydrates'] = $percentage_carbohydrates;
            $input['percentage_lipids'] = $percentage_lipids;
            $input['percentage_protein'] = $percentage_protein;
                
            //validamos si existen suplementos
                        
            $total_energy_expenditure = TotalEnergyExpenditure::findOrfail($id);
            if($total_energy_expenditure->update($input))
            {
                return redirect()->route('dietetic.get', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Datos guardados correctamente.');
            }
            else
            {
                return redirect()->back()->with('error', 'Los datos no fueron guardados.');
            }
        }
    }

    public function equivalentDistribution($slug,$history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $history = $this->getHistoryById($history_id);

        $food_groups = FoodGroup::all();
        $food_times = FoodTime::all();

        $equivalentDistribution = EquivalentDistribution::where('history_id',$history->id)->where('patient_id', '=', $patient->id)->first();
        
        if($equivalentDistribution)
        {
            $equivalentDistribution['food_groups'] = json_decode($equivalentDistribution->food_groups);
            $equivalentDistribution['food_times'] = json_decode($equivalentDistribution->food_times);
            $equivalentDistribution['days'] = json_decode($equivalentDistribution->days);
            
            $details = EquivalentDistributionDetail::Where('equivalent_dist_id', '=', $equivalentDistribution->id)->get();
            
            foreach($details as $d)
            {
                $d['fields'] = json_decode($d->fields, true);
            }

            $food_group_equivalent = FoodGroupEquivalent::all();
            
            $total_equivalents = array();
            $proteins = array();
            $lipids = array();
            $carbohydrates = array();

           
            foreach($equivalentDistribution->food_groups as $fg)
            {
                foreach($details as $detail)
                {
                    if($detail->food_group_id == $fg)
                    {
                        
                        foreach($equivalentDistribution->food_times as $food_time)
                        {
                            $total = 0;
                            $total_protein = 0;
                            $total_lipids = 0;
                            $total_carbohydrates = 0;

                            foreach($equivalentDistribution->days as $day)
                            {
                                $total += $detail->fields[$day][$food_time]['equivalent']; //+ $total;
                            }

                            foreach($food_group_equivalent as $fg_e)
                            {
                                if($fg_e->group_id == $fg)
                                {
                                    $total_protein += ($fg_e->protein * $total);
                                    $total_lipids += ($fg_e->lipids * $total);
                                    $total_carbohydrates += ($fg_e->carbohydrates * $total);
                                }
                            }

                            $proteins[$fg][$food_time] = $total_protein;
                            $lipids[$fg][$food_time] = $total_lipids;
                            $carbohydrates[$fg][$food_time] = $total_carbohydrates;
                        }
                       
                    }
                }
                
            }

            
            $total_proteins_times = array();
            $total_lipids_times = array();
            $total_carbohydrates_times = array();

            $total_times = array();

            foreach($equivalentDistribution->food_times as $time)
            {
                $sum_proteins = 0;
                $sum_lipids = 0;
                $sum_carbohydrates = 0;

                foreach($proteins as $p)
                {
                    $sum_proteins += $p[$time];
                }

                foreach($lipids as $p)
                {
                    $sum_lipids += $p[$time];
                }

                foreach($carbohydrates as $p)
                {
                    $sum_carbohydrates += $p[$time];
                }

                $total_proteins_times[$time] = $sum_proteins;
                $total_lipids_times[$time] = $sum_lipids;
                $total_carbohydrates_times[$time] = $sum_carbohydrates;

                $total_times[$time] = $sum_carbohydrates + $sum_lipids + $sum_proteins;
            }

            $contado_proteins = array_sum($total_proteins_times); //suma de la proteinas de todos los tiempos de comidas
            $contado_lipids = array_sum($total_lipids_times); //suma de la lipidos de todos los tiempos de comidas
            $contado_carbohydrates = array_sum($total_carbohydrates_times); //suma de la lipidos de todos los tiempos de comidas

            $sum_food_times_equivalents = array_sum($total_times); //suma total de lipipdos, carbohidratos y proteinas d etodos los tiempos de comidas

            $equivalent_macro = array();
            array_push($equivalent_macro, ['Tiempo de comida', 'Equivalente']);
    
            //obtenemos los macronutrientes
            foreach($total_times as $key => $value)
            {
                foreach($food_times as $time)
                {
                    if($key == $time->id)
                    {
                        array_push($equivalent_macro, [$time->name, $value]);
                    }
                }
            }
           
            return View('patients.dietetic.equivalentDistribution.edit')
                    ->with('patient', $patient)
                    ->with('food_groups', $food_groups)
                    ->with('food_times', $food_times)
                    ->with('contado_proteins', $contado_proteins)
                    ->with('contado_lipids', $contado_lipids)
                    ->with('contado_carbohydrates', $contado_carbohydrates)
                    ->with('equivalentDistribution', $equivalentDistribution)
                    ->with('details', $details)
                    ->with('history', $history)
                    ->with('equivalent_macro', json_encode($equivalent_macro, JSON_UNESCAPED_UNICODE));
        }
        else
        {
            return View('patients.dietetic.equivalentDistribution.create', compact('patient', 'history','food_groups', 'food_times'));
        }

        
    }

    public function equivalentDistributionAjax(Request $request)
    {
        if($request->ajax())
        {
            $food_groups = FoodGroup::all();
            $food_times = FoodTime::all();
            $params = array();
            parse_str($request->dataJson, $params);
            
            if($request->has('id'))
            {
                $id = $request->id;
                $equivalentDistribution = EquivalentDistribution::findOrfail($id);
                $details = EquivalentDistributionDetail::Where('equivalent_dist_id', '=', $id)->get();
               
                $equivalentDistribution['food_groups'] = json_decode($equivalentDistribution->food_groups);
                $equivalentDistribution['food_times'] = json_decode($equivalentDistribution->food_times);
                $equivalentDistribution['days'] = json_decode($equivalentDistribution->days);

                foreach($details as $d)
                {
                    $d['fields'] = json_decode($d->fields, true);
                }

                $view = \View::Make('ajax.EquivalentDistributionEdit', compact('params', 'food_groups', 'food_times', 'equivalentDistribution', 'details'));
            }
            else
            {
                $view = \View::Make('ajax.EquivalentDistribution', compact('params', 'food_groups', 'food_times'));
            }
            

            
            return response($view);
        }
    }
    
    public function unityAjax(Request $request)
    {
        if($request->ajax())
        {
            $dataJson = json_decode($request->dataJson);
            $patient_id = $dataJson->patient_id;
            $unity = $dataJson->unity;

            $patient = Patient::findOrfail($patient_id);
            $history = $this->getHistoryById($dataJson->history_id);

            $food_groups = FoodGroup::all();
            $food_times = FoodTime::all();


            $equivalentDistribution = EquivalentDistribution::where('history_id',$history->id)->where('patient_id', '=', $patient->id)->first();
            
            if($equivalentDistribution)
            {
                $equivalentDistribution['food_groups'] = json_decode($equivalentDistribution->food_groups);
                $equivalentDistribution['food_times'] = json_decode($equivalentDistribution->food_times);
                $equivalentDistribution['days'] = json_decode($equivalentDistribution->days);
                
                $details = EquivalentDistributionDetail::Where('equivalent_dist_id', '=', $equivalentDistribution->id)->get();
                
                foreach($details as $d)
                {
                    $d['fields'] = json_decode($d->fields, true);
                }

                $food_group_equivalent = FoodGroupEquivalent::all();
                
                $total_equivalents = array();
                $proteins = array();
                $lipids = array();
                $carbohydrates = array();

            
                foreach($equivalentDistribution->food_groups as $fg)
                {
                    foreach($details as $detail)
                    {
                        if($detail->food_group_id == $fg)
                        {
                            
                            foreach($equivalentDistribution->food_times as $food_time)
                            {
                                $total = 0;
                                $total_protein = 0;
                                $total_lipids = 0;
                                $total_carbohydrates = 0;

                                foreach($equivalentDistribution->days as $day)
                                {
                                    $total += $detail->fields[$day][$food_time]['equivalent']; //+ $total;
                                }

                                foreach($food_group_equivalent as $fg_e)
                                {
                                    if($fg_e->group_id == $fg)
                                    {
                                        $total_protein += ($fg_e->protein * $total);
                                        $total_lipids += ($fg_e->lipids * $total);
                                        $total_carbohydrates += ($fg_e->carbohydrates * $total);
                                    }
                                }

                                $proteins[$fg][$food_time] = $total_protein;
                                $lipids[$fg][$food_time] = $total_lipids;
                                $carbohydrates[$fg][$food_time] = $total_carbohydrates;
                            }
                        
                        }
                    }
                    
                }

                
                $total_proteins_times = array();
                $total_lipids_times = array();
                $total_carbohydrates_times = array();

                $total_times = array();

                foreach($equivalentDistribution->food_times as $time)
                {
                    $sum_proteins = 0;
                    $sum_lipids = 0;
                    $sum_carbohydrates = 0;

                    foreach($proteins as $p)
                    {
                        $sum_proteins += $p[$time];
                    }

                    foreach($lipids as $p)
                    {
                        $sum_lipids += $p[$time];
                    }

                    foreach($carbohydrates as $p)
                    {
                        $sum_carbohydrates += $p[$time];
                    }

                    $total_proteins_times[$time] = $sum_proteins;
                    $total_lipids_times[$time] = $sum_lipids;
                    $total_carbohydrates_times[$time] = $sum_carbohydrates;

                    $total_times[$time] = $sum_carbohydrates + $sum_lipids + $sum_proteins;
                }

                //Total de Kcal
                $total_kcal = 3000;

                //calculos de kcal
                $lipds_kcal = ($dataJson->porcent_lipids * $total_kcal)/100;
                $proteins_kcal = ($dataJson->porcent_proteins * $total_kcal)/100;
                $carbohydrates_kcal = ($dataJson->porcent_carbohydrates * $total_kcal)/100;


                if($dataJson->unity == 1)
                {
                    $contado_proteins = array_sum($total_proteins_times); //suma de la proteinas de todos los tiempos de comidas
                    $contado_lipids = array_sum($total_lipids_times); //suma de la lipidos de todos los tiempos de comidas
                    $contado_carbohydrates = array_sum($total_carbohydrates_times); //suma de la lipidos de todos los tiempos de comidas

                    //calculamos meta
                    $meta_lipids = number_format($lipds_kcal/9, 2, '.', ',');
                    $meta_proteins = number_format($proteins_kcal/4, 2, '.', ',');
                    $meta_carbohydrates = number_format($carbohydrates_kcal/4, 2, '.', ',');

                    //calculamos la adecuacion
                    if($meta_proteins != 0)
                    {
                        $adecuacion_proteins = number_format($contado_proteins/$meta_proteins, 2, '.', ',');
                    }
                    else
                    {
                        $adecuacion_proteins = 0;
                    }

                    if($meta_lipids != 0)
                    {
                        $adecuacion_lipids = number_format($contado_lipids/$meta_lipids, 2, '.', ',');
                    }
                    else
                    {
                        $adecuacion_lipids = 0;
                    }

                    if($meta_carbohydrates != 0)
                    {
                        $adecuacion_carbohydrates = number_format($contado_carbohydrates/$meta_carbohydrates, 2, '.', ',');
                    }
                    else
                    {
                        $adecuacion_carbohydrates = 0;
                    }
                }
                else if($dataJson->unity = 2)
                {
                    $contado_proteins = array_sum($total_proteins_times) * 4; //suma de la proteinas de todos los tiempos de comidas
                    $contado_lipids = array_sum($total_lipids_times) * 9; //suma de la lipidos de todos los tiempos de comidas
                    $contado_carbohydrates = array_sum($total_carbohydrates_times) * 4; //suma de la lipidos de todos los tiempos de comidas

                    //calculamos meta
                    $meta_lipids = $lipds_kcal;
                    $meta_proteins = $proteins_kcal;
                    $meta_carbohydrates = $carbohydrates_kcal;

                    //calculamos adecuacion
                    $adecuacion_proteins = $contado_proteins - $meta_proteins;
                    $adecuacion_lipids = $contado_lipids - $meta_lipids;
                    $adecuacion_carbohydrates = $contado_carbohydrates - $meta_carbohydrates;
                }
                

                $sum_food_times_equivalents = array_sum($total_times); //suma total de lipipdos, carbohidratos y proteinas d etodos los tiempos de comidas

                $view = \View::Make('ajax.TableUnity')->with('contado_proteins', $contado_proteins)
                                                        ->with('contado_lipids', $contado_lipids)
                                                        ->with('contado_carbohydrates', $contado_carbohydrates)
                                                        ->with('meta_lipids', $meta_lipids)
                                                        ->with('meta_proteins', $meta_proteins)
                                                        ->with('meta_carbohydrates', $meta_carbohydrates)
                                                        ->with('porcent_lipids', $dataJson->porcent_lipids)
                                                        ->with('porcent_carbohydrates', $dataJson->porcent_carbohydrates)
                                                        ->with('porcent_proteins', $dataJson->porcent_proteins)
                                                        ->with('adecuacion_proteins', $adecuacion_proteins)
                                                        ->with('adecuacion_lipids', $adecuacion_lipids)
                                                        ->with('adecuacion_carbohydrates', $adecuacion_carbohydrates)
                                                        ->with('unity', $dataJson->unity);
                /*return View('patients.dietetic.equivalentDistribution.edit')
                                                                            ->with('patient', $patient)
                                                                            ->with('food_groups', $food_groups)
                                                                            ->with('food_times', $food_times)
                                                                            ->with('contado_proteins', $contado_proteins)
                                                                            ->with('contado_lipids', $contado_lipids)
                                                                            ->with('contado_carbohydrates', $contado_carbohydrates)
                                                                            ->with('equivalentDistribution', $equivalentDistribution)
                                                                            ->with('details', $details);*/
                return response($view);
            }
        }
    }

    public function equivalentDistributionStore(Request $request)
    {
        $request->validate([
            'patient_id'            => ['required','numeric','exists:patients,id'],
            'history_id'            => ['required','numeric','exists:dietary_histories,id'],
        ]);

        $patient = Patient::where('id', '=', $request->patient_id)->first();

        $history = $this->getHistoryById($request->history_id);

        //formato de fecha de inicio y de fin
        $start_date = Carbon::parse(Str::replaceArray('/', ['-', '-'], $request->start_date))->format('Y-m-d');
        $end_date = Carbon::parse(Str::replaceArray('/', ['-', '-'], $request->end_date))->format('Y-m-d');

        $eq_distribution = EquivalentDistribution::create([
            'patient_id'    => $request->patient_id,
            'history_id'    => $request->history_id,
            'food_groups'   => json_encode($request->food_group),
            'food_times'    => json_encode($request->food_time),
            'days'          => json_encode($request->days),
            'start_date'    => $start_date,
            'end_date'      => $end_date
        ]);

        //obtenemos el id del equivalent_distribution
       $eq_distribution_id =  $eq_distribution->id;

        for($i = 0; $i < count($request->food_group); $i++)
        {
            $food_group_id = $request->food_group[$i];
            $fields = json_encode($request->field[$request->food_group[$i]]);
            
            EquivalentDistributionDetail::create([
                'equivalent_dist_id'    => $eq_distribution_id,
                'food_group_id'         => $food_group_id,
                'fields'                => $fields
            ]);
        }
        
        return redirect()->route('dietetic.equivalentDistribution', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Distribucion Guardada');
    }

    public function equivalentDistributionUpdate(Request $request, $id)
    {
        $request->validate([
            'patient_id'            => ['required','numeric','exists:patients,id'],
            'history_id'            => ['required','numeric','exists:dietary_histories,id'],
        ]);
        //formato de fecha de inicio y de fin
        $history = $this->getHistoryById($request->history_id);

        $start_date = Carbon::parse(Str::replaceArray('/', ['-', '-'], $request->start_date))->format('Y-m-d');
        $end_date = Carbon::parse(Str::replaceArray('/', ['-', '-'], $request->end_date))->format('Y-m-d');
        $eq_distribution = EquivalentDistribution::where('history_id',$history->id)->findOrfail($id);
        $eq_distribution->update([
            'food_groups'   => json_encode($request->food_group),
            'food_times'    => json_encode($request->food_time),
            'days'          => json_encode($request->days),
            'start_date'    => $start_date,
            'end_date'      => $end_date
        ]);
        
        $patient = Patient::where('id', '=', $eq_distribution->patient_id)->first();
        $details = EquivalentDistributionDetail::Where('equivalent_dist_id', '=', $id)->get();

        foreach($details as $detail)
        {
            $detail->delete();
        }

        for($i = 0; $i < count($request->food_group); $i++)
        {
            $food_group_id = $request->food_group[$i];
            $fields = json_encode($request->field[$request->food_group[$i]]);
            
            EquivalentDistributionDetail::create([
                'equivalent_dist_id'    => $id,
                'food_group_id'         => $food_group_id,
                'fields'                => $fields
            ]);
        }
        return redirect()->route('dietetic.equivalentDistribution', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Distribucion Guardada');
    }

    public function searchMetAjax(Request $request)
    {
        $mets = Met::where('actividad', 'LIKE', '%'.$request->search.'%')->orWhere('categoria', 'LIKE', '%'.$request->search.'%')->get();
        return \response()->json($mets);
    }

    public function getHistoryById($id)
    {
        return DietaryHistory::where('user_id',\Auth::user()->id)->find($id);
    }
}
