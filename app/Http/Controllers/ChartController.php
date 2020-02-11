<?php

namespace App\Http\Controllers;

use App\FrequencyConsumption;
use App\Patient;
use App\FoodGroup;
use App\FoodMineral;
use App\FoodVitamin;
use Auth;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function show($slug)
    {
    	$user = Auth::user();

        $patient = Patient::where('slug', $slug)->first();
        
        $frequency = FrequencyConsumption::With(['FoodGroup', 'Food'])->where('patient_id', $patient->id)->get();
        
        //obtenemos los minerales
        $minerals = FrequencyConsumption::select(DB::raw('
                                                            SUM(food_minerals.hierro_NO) as HierroNO, 
                                                            SUM(food_minerals.hierro) as Hierro,
                                                            SUM(food_minerals.potasio) as Potasio,
                                                            SUM(food_minerals.sodio) as Sodio,
                                                            SUM(food_minerals.Calcio) as Calcio,
                                                            SUM(food_minerals.fosforo) as Fosforo,
                                                            SUM(food_minerals.selenio) as Selenio
                                                        '))
                                            ->where('patient_id', $patient->id)
                                            ->join('foods', 'foods.id', 'frequency_consumptions.food_id')
                                            ->join('food_minerals', 'food_minerals.food_id', 'foods.id')
                                            ->get();
        //obtnemos las vitaminas
        $vitamins = FrequencyConsumption::select(DB::raw('
                                                            SUM(food_vitamins.vitamina_A) as VitaminaA, 
                                                            SUM(food_vitamins.acido_ascorbico) as AcidoAscorbico,
                                                            SUM(food_vitamins.acido_folico) as AcidoFolico
                                                        '))
                                            ->where('patient_id', $patient->id)
                                            ->join('foods', 'foods.id', 'frequency_consumptions.food_id')
                                            ->join('food_vitamins', 'food_vitamins.food_id', 'foods.id')
                                            ->get();
      
        //obtenemos los grupos de alimentos
        $foods_groups = FoodGroup::all();

        //obtenemos las vitaminas
        $food_vitamins = FoodVitamin::all();

        //obtenemos los minerales
        $food_minerals = FoodMineral::all();

        $frequency_foodsGroup = array();
        $frequency_macros = array();
        $fequency_minerals = array();
        $frequency_vitamins = array();

        //obtenemos la frecuencia de consumo del paciente por grupo de alimentos
        foreach($foods_groups as $key => $value)
        {
            $total = 0;

            foreach($frequency as $f)
            {
                if($f->food_group == $value['id'])
                {
    
                    switch ($f->frecuency) {
                        case '1 véz al día':
                            $factor = 30;
                            break;
                        case '2 - 3 veces al día':
                            $factor = 75;
                            break;
                        case '1 véz por semana':
                            $factor = 4.5;
                            break;
                        case '2 - 3 veces por semana':
                            $factor = 11.3;
                            break;
                        case '4 - 6 veces por semana':
                            $factor = 22.5;
                            break;
                        case 'cada 15 días':
                            $factor = 2.25;
                            break;
                        case '1 véz al mes':
                            $factor = 1;
                            break;
                        case 'Nunca':
                            $factor = 0;
                            break;
                    }

                    $total = $total + $factor;
                }
            }

            $result[] = array(
                'food_group'    => $value->name,
                'total'        => $total
               );
        }

        //obtenemos la fecuencia de consumo del paciente por macronutrientes
        $totalProtein = 0;
        $totalLipids = 0;
        $totalCarboHydrates = 0;

        foreach($frequency as $key => $value)
        {
            
            $totalProtein = $totalProtein + $value['Food']['protein'];
            $totalLipids = $totalLipids + $value['Food']['lipids'];
            $totalCarboHydrates = $totalCarboHydrates + $value['Food']['carbohydrates'];

        }

        //obtenemos los macronutrientes
        array_push($frequency_macros, ['Macronutriente', 'Valor']);
        array_push($frequency_macros, ['Proteinas', $totalProtein]);
        array_push($frequency_macros, ['Lipidos', $totalLipids]);
        array_push($frequency_macros, ['Hidratos de Carbono', $totalCarboHydrates]);

       
        $frequency_foodsGroup[] = ['Ingesta mensual','Dias'];

        foreach($result as $key => $value)
        {
            $frequency_foodsGroup[++$key] = [$value['food_group'], (float)$value['total']];
        }

        
        //ordenamos los minerales
        foreach($minerals as $mineral)
        {
            $total_minerals[] = array(
                'mineral'    => 'Hierro NO',
                'valor'        => $mineral->HierroNO
               );

               $total_minerals[] = array(
                'mineral'    => 'Hierro',
                'valor'        => $mineral->Hierro
               );

               $total_minerals[] = array(
                'mineral'    => 'Potasio',
                'valor'        => $mineral->Potasio
               );

               $total_minerals[] = array(
                'mineral'    => 'Sodio',
                'valor'        => $mineral->Sodio
               );

               $total_minerals[] = array(
                'mineral'    => 'Calcio',
                'valor'        => $mineral->Calcio
               );

               $total_minerals[] = array(
                'mineral'    => 'Fosforo',
                'valor'        => $mineral->Fosforo
               );

               $total_minerals[] = array(
                'mineral'    => 'Selenio',
                'valor'        => $mineral->Selenio
               );
        }

        //ordenamos las vitaminas
        foreach($vitamins as $vitamin)
        {
         
            $total_vitamins[] = array(
                'vitamina'    => 'Vitamina A (µg RE)',
                'valor'        => $vitamin->VitaminaA
               );

               $total_vitamins[] = array(
                'vitamina'    => 'Acido Ascorbico (mg)',
                'valor'        => $vitamin->AcidoAscorbico
               );

               $total_vitamins[] = array(
                'vitamina'    => 'Acido Folico (µg)',
                'valor'        => $vitamin->AcidoFolico
               );
        }

        $frequency_minerals[] = ['Mineral','Mg'];
        $frequency_vitamins[] = ['Vitamina','Cantidad'];

        foreach($total_minerals as $key => $value)
        {
            $frequency_minerals[++$key] = [$value['mineral'], (float)$value['valor']];
        }

        foreach($total_vitamins as $key => $value)
        {
            $frequency_vitamins[++$key] = [$value['vitamina'], (float)$value['valor']];
        }

     
        //return view('patients.Charts.show', compact('user', 'patient'));
        return view('patients.Charts.show')->with('user', $user)
                                           ->with('patient', $patient)
                                           ->with('frequency_foodsGroup', json_encode($frequency_foodsGroup, JSON_UNESCAPED_UNICODE))
                                           ->with('frequency_macros', json_encode($frequency_macros, JSON_UNESCAPED_UNICODE))
                                           ->with('frequency_minerals', json_encode($frequency_minerals, JSON_UNESCAPED_UNICODE))
                                           ->with('frequency_vitamins', json_encode($frequency_vitamins, JSON_UNESCAPED_UNICODE));
    }
}
