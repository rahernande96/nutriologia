<?php

namespace App\Http\Controllers;

use App\ChangeWeight;
use App\Feeding;
use App\Food;
use App\FoodAllergy;
use App\FoodGroup;
use App\FrequencyConsumption;
use App\LifeStyle;
use App\Patient;
use App\SpecificDiet;
use Auth;
use DB;
use Illuminate\Http\Request;

class NutritionalClinicalHistoryController extends Controller
{
    public function create($slug)
    {
    	$patient = Patient::where('slug', $slug)->first();

    	$user = Auth::user();

    	return view('patients.NutritionalClinicalHistory.create', compact('patient', 'user'));
    }

    public function edit($slug)
    {
    	$patient = Patient::where('slug', $slug)->first();

    	$user = Auth::user();

    	return view('patients.NutritionalClinicalHistory.edit', compact('patient', 'user'));
    }

    public function update(Request $request, $slug)
    {
    	$patient = Patient::where('slug', $slug)->first();

    	try{
    		DB::beginTransaction();

    		//Estilo de Vida
    		$patient->LifeStyle->details = $request->physical_activities;
    		$patient->LifeStyle->stress = $request->stress;
    		$patient->LifeStyle->save();
    		//Alimentación
    	
    		$patient->Feeding->preferred_foods = $request->preferred_foods;
    		$patient->Feeding->food_not_prefer = $request->food_not_prefer;
    		$patient->Feeding->alimentary_habits = $request->alimentary_habits;
    		$patient->Feeding->food_belief = $request->food_belief;
    		$patient->Feeding->save();

    		//Dieta específica
    		$patient->SpecificDiet->diet_salad = $request->diet_salad;
    		$patient->SpecificDiet->diet_vegan = $request->diet_vegan;
    		$patient->SpecificDiet->diet_crudiverian = $request->diet_crudiverian;
    		$patient->SpecificDiet->diet_ovegetarian = $request->diet_ovegetarian;
    		$patient->SpecificDiet->diet_ovolactovegetarian = $request->diet_ovolactovegetarian;
    		$patient->SpecificDiet->diet_mediterranean = $request->diet_mediterranean;
    		$patient->SpecificDiet->diet_ovnivoro = $request->diet_ovnivoro;
    		$patient->SpecificDiet->other = $request->other;
    		$patient->SpecificDiet->vitamins = $request->vitamins;
    		$patient->SpecificDiet->proteins = $request->proteins;
    		$patient->SpecificDiet->aminoacids = $request->aminoacids;
    		$patient->SpecificDiet->none = $request->none;
    		$patient->SpecificDiet->save();

    		//Alergias alimentarias

    		$patient->FoodAllergy->oilseed_allergy = $request->oilseed_allergy;
    		$patient->FoodAllergy->fruit_allergy = $request->fruit_allergy;
    		$patient->FoodAllergy->vegetable_allergy = $request->vegetable_allergy;
    		$patient->FoodAllergy->intolerance = $request->intolerance;
    		$patient->FoodAllergy->save();

    		//Cambios de peso

    		$patient->ChangeWeight->max_weight = $request->max_weight;
    		$patient->ChangeWeight->min_weight = $request->min_weight;
    		$patient->ChangeWeight->usual_weight = $request->usual_weight;
    		$patient->ChangeWeight->lastMonth = $request->lastMonth;
    		$patient->ChangeWeight->lastThreeMonths = $request->lastThreeMonths;
    		$patient->ChangeWeight->lastSixMonths = $request->lastSixMonths;
    		$patient->ChangeWeight->save();

    		DB::commit();

			//return redirect()->route('ClinicHistoryPatient', $patient->slug)->with('success', 'Datos actualizados correctamente.');
			return redirect()->route('NutritionalClinicalHistory.edit', $patient->slug)->with('success', 'Datos actualizados correctamente.');

    	}catch(\Exception $e){ 
    			return back()->with('info', $e->getmessage());
    		}
    }

    public function store(Request $request, $slug)
    {
    	$patient = Patient::where('slug', $slug)->first();

    	try{ DB::beginTransaction(); 

    		//Estilo de vida
    		LifeStyle::create([
    			'patient_id' => $patient->id,
    			'details' => $request->physical_activities,
    			'stress' => $request->stress
    		]);

    		//Alimentación
    		Feeding::create([
    			'patient_id' => $patient->id,
    			'preferred_foods' => $request->preferred_foods,
    			'food_not_prefer' => $request->food_not_prefer,
    			'alimentary_habits' => $request->alimentary_habits,
    			'food_belief' => $request->food_belief,
    		]);

    		//Dieta especifica
    		SpecificDiet::create([
    			'patient_id' => $patient->id,
    			'diet_salad' => $request->diet_salad,
    			'diet_vegan' => $request->diet_vegan,
    			'diet_crudiverian' => $request->diet_crudiverian,
    			'diet_ovegetarian' => $request->diet_ovegetarian,
    			'diet_ovolactovegetarian' => $request->diet_ovolactovegetarian,
    			'diet_ovnivoro' => $request->diet_ovnivoro,
    			'diet_mediterranean' => $request->diet_mediterranean,
    			'other' => $request->other,
    			'water' => $request->water,
    			'vitamins' => $request->vitamins,
    			'proteins' => $request->proteins,
    			'aminoacids' => $request->aminoacids,
    			'none' => $request->none
    		]);

    		FoodAllergy::create([
    			'patient_id' => $patient->id,
    			'oilseed_allergy' => $request->oilseed_allergy,
    			'fruit_allergy' => $request->fruit_allergy,
    			'vegetable_allergy' => $request->vegetable_allergy,
    			'intolerance' => $request->intolerance
    		]);

    		ChangeWeight::create([
    			'patient_id' => $patient->id,
    			'max_weight' => $request->max_weight,
    			'min_weight' => $request->min_weight,
    			'usual_weight' => $request->usual_weight,
    			'lastMonth' => $request->lastMonth,
    			'lastThreeMonths' => $request->lastThreeMonths,
    			'lastSixMonths' => $request->lastSixMonths
    		]);

    		DB::commit();

    		//return redirect()->route('NutritionalClinicalHistory.frequency', $patient->slug)->with('success', 'Registros guardado correctamente, ahora ingrese su frecuencia de consumo');
				return redirect()->route('frequencyConsumption.create', $patient->slug)->with('success', 'Registros guardado correctamente, ahora ingrese su frecuencia de consumo');
    		}catch(\Exception $e){ 
    			return back()->with('info', $e->getmessage());
    		}
    }

    public function frequencyConsumptionCreate($slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        $user = Auth::user();

        $foodsGroup = FoodGroup::orderBy('name', 'ASC')
        ->get();

        $foods = Food::orderBy('name', 'ASC')
        ->get();
        
        $frequency = FrequencyConsumption::where('patient_id', $patient->id)->get();

        return view('patients.NutritionalClinicalHistory.FrequencyConsumption.create', compact('patient', 'user', 'foodsGroup', 'foods','frequency'));
    } 

    public function frequencyConsumptionEdit($slug)
    {
        $patient = Patient::where('slug', $slug)->first();

        $user = Auth::user();

        //$foods = Food::all();
        $foodsGroup = FoodGroup::orderBy('name', 'ASC')
        ->get();

		$foods = Food::orderBy('name', 'ASC')->get();

        $frequency = FrequencyConsumption::where('patient_id', $patient->id)->get();

        return view('patients.NutritionalClinicalHistory.FrequencyConsumption.edit', compact('patient', 'user', 'foods', 'foodsGroup','frequency'));
    }

    public function frequencyConsumptionAdd(Request $request)
    {
		 $one_day = $request->one_day;
		 $twoOrTreeForDay = $request->twoOrTreeForDay;
		 $oneForWeek = $request->oneForWeek;
		 $twoOrTreeForWeek = $request->twoOrTreeForWeek;
		 $fourOrSixForWeek = $request->fourOrSixForWeek;
		 $fifteenDays = $request->fifteenDays;
		 $oneMonth = $request->oneMonth;
		 $never = $request->never;

		 $patient_id = $request->patient_id;

		 $patient = Patient::findOrfail($patient_id);

		$x = 0;

		if(count($one_day) > 0)
		{
			for ($i=0; $i < count($one_day); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $one_day[$i]['name'],
					'food_id'		=> $one_day[$i]['id'],
					'food_group'	=> $one_day[$i]['group_id'],
                    'frecuency'		=> '1 véz al día'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}
		 
		if(count($twoOrTreeForDay) > 0)
		{
			for ($i=0; $i < count($twoOrTreeForDay); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $twoOrTreeForDay[$i]['name'],
					'food_id'		=> $twoOrTreeForDay[$i]['id'],
					'food_group'	=> $twoOrTreeForDay[$i]['group_id'],
                    'frecuency'		=> '2 - 3 veces al día'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($oneForWeek) > 0)
		{
			for ($i=0; $i < count($oneForWeek); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $oneForWeek[$i]['name'],
					'food_id'		=> $oneForWeek[$i]['id'],
					'food_group'	=> $oneForWeek[$i]['group_id'],
                    'frecuency'		=> '1 véz por semana'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($twoOrTreeForWeek) > 0)
		{
			for ($i=0; $i < count($twoOrTreeForWeek); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $twoOrTreeForWeek[$i]['name'],
					'food_id'		=> $twoOrTreeForWeek[$i]['id'],
					'food_group'	=> $twoOrTreeForWeek[$i]['group_id'],
                    'frecuency'		=> '2 - 3 veces por semana'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($fourOrSixForWeek) > 0)
		{
			for ($i=0; $i < count($fourOrSixForWeek); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $fourOrSixForWeek[$i]['name'],
					'food_id'		=> $fourOrSixForWeek[$i]['id'],
					'food_group'	=> $fourOrSixForWeek[$i]['group_id'],
                    'frecuency'		=> '4 - 6 veces por semana'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($fifteenDays) > 0)
		{
			for ($i=0; $i < count($fifteenDays); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $fifteenDays[$i]['name'],
					'food_id'		=> $fifteenDays[$i]['id'],
					'food_group'	=> $fifteenDays[$i]['group_id'],
                    'frecuency'		=> 'cada 15 días'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($oneMonth) > 0)
		{
			for ($i=0; $i < count($oneMonth); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $oneMonth[$i]['name'],
					'food_id'		=> $oneMonth[$i]['id'],
					'food_group'	=> $oneMonth[$i]['group_id'],
                    'frecuency'		=> '1 véz al mes'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}

		if(count($never) > 0)
		{
			for ($i=0; $i < count($never); $i++) {
				if(FrequencyConsumption::create([
					'patient_id'	=> $patient_id,
					'food_name'		=> $never[$i]['name'],
					'food_id'		=> $never[$i]['id'],
					'food_group'	=> $never[$i]['group_id'],
                    'frecuency'		=> 'Nunca'
				]))
				{
					$x = 1;
				}
				else
				{
					$x = 0;
				}
				
			}
		}
	
		if($x == 1)
		{
			return response()->json(['code'	=> 1, 'patient_slug' => $patient->slug]);
		}
		else
		{
			return response()->json(['code'	=> 0, 'patient_slug' => $patient->slug]);
		}
	

     	//return redirect()->route('ClinicHistoryPatient', $patient->slug)->with('success', 'Frecuencia de consumo creada');
    }

    public function frequencyConsumptionDelete($id)
    {
        $frequency = FrequencyConsumption::where('id', $id)->first();

        $frequency->delete();

        return back()->with('success', 'Alimento eliminado');
    }
}
