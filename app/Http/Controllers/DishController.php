<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
use App\Sem;
use App\Dish;
use App\Patient;
use App\DishCost;
use App\DishType;
use App\DishStyle;
use App\DishDetail;
use App\DietaryHistory;
use App\DishTemperature;
use Illuminate\Http\Request;
use App\Http\Request\CreateDishesRequest;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug,$history_id)
    {
        $patient = Patient::where('slug', '=', $slug)->first();

        $history = $this->getHistoryById($history_id);

        $dishes = Dish::With(['details.ingredient'])->where('history_id',$history->id)->where('user_id', '=', Auth::user()->id)->where('patient_id', '=', $patient->id)->get();

        return \View('patients.dietetic.dishes.index', compact('dishes', 'patient', 'history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug,$history_id)
    {
        $types = DishType::all();
        $temperatures = DishTemperature::all();
        $costs = DishCost::all();
        $styles = DishStyle::all();
        $patient = Patient::Where('slug', '=', $slug)->first();
        $history = $this->getHistoryById($history_id);

        return \View('patients.dietetic.dishes.create', compact('patient', 'history','types', 'costs', 'temperatures', 'styles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        if($request->ajax())
        {
            $foods = $request->dataJson['foods'];
            $name = $request->dataJson['name'];
            $note = $request->dataJson['note'];
            $grs = $request->dataJson['grs'];
            $patient_id = $request->dataJson['patient_id'];
            $history_id = $request->dataJson['history_id'];

            $dish = new Dish;

            $dish->name = $name;
            $dish->patient_id = $patient_id;
            $dish->history_id = $history_id;
            $dish->user_id = Auth::user()->id;

            $kcal = 0;
            foreach($request->dataJson['foods'] as $food)
            {
                $sem = Sem::findOrfail($food);
                $kcal += $sem->energy;
            }

            $dish->kcal = $kcal;
            $dish->notes = $note;
     
            if($dish->save())
            {
                $dish_id = $dish->id;//Dish::all()->last()->id;

                for ($i=0; $i < count($request->dataJson['foods']); $i++) 
                { 
                    DishDetail::create([
                        'dish_id'   => $dish_id,
                        'sem_id'    => $request->dataJson['foods'][$i],
                        'gr'        => $request->dataJson['grs'][$i],
                        'quantity'  => $request->dataJson['quantitys'][$i],
                        'eq'        => $request->dataJson['eqs'][$i]
                    ]);
                }

                return response()->json(['status' => 1, 'message' => 'Platillo Creado Satisfactoiamente']);
            }
            else
            {
                return response()->json(['status' => 2, 'message' => 'Platillo no pudo ser creado']);
            }
        }

        $rules = [
            'name'              => 'required',
            'food_id'           => 'required',
            'note'              => 'required',
            'style_id'          => 'required',
            'temperature_id'    => 'required',
            'cost_id'           => 'required',
            'type_id'           => 'required',
            'patient_id'        => ['required','numeric','exists:patients,id'],
            'history_id'        => ['required','numeric','exists:dietary_histories,id'],
        ];

        $messages = [
            'name.required'              => 'El nombre es requerida',
            'food_id.required'           => 'Debe agregar al menos un ingrediente',
            'note.required'              => 'La preparacion o notas son requeridas',
            'style_id.required'          => 'El estilo es requerido',
            'temperature_id.required'    => 'La temperatura es requerida',
            'cost_id.required'           => 'El costo es requerido',
            'type_id.required'           => 'El tipo es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $patient = Patient::findOrfail($request->patient_id);
        $history = $this->getHistoryById($request->history_id);
        $dish = new Dish;

        $dish->patient_id = $request->patient_id;
        $dish->history_id = $request->history_id;
        $dish->name = $request->name;
        $dish->user_id = Auth::user()->id;
        $dish->cost_id = $request->cost_id;
        $dish->type_id = $request->type_id;
        $dish->temperature_id = $request->temperature_id;
        $dish->style_id = $request->style_id;

        $kcal = array_sum($request->eq);
        $dish->kcal = $kcal;
        $dish->notes = $request->note;

        $proteins = 0;
        $lipids = 0;
        $carbohydrates = 0;
        foreach($request->food_id as $food)
        {
            $sem = Sem::findOrfail($food);
            $proteins += $sem->proteins;
            $lipids += $sem->lipds;
            $carbohydrates += $sem->carbohydrates;
        }

        $dish->carbohydrates = $carbohydrates;
        $dish->lipids = $lipids;
        $dish->proteins = $proteins;

        if($request->hasFile('image'))
        {
            $namefile = time().'.'.$request->image->getClientOriginalName();

            $path = 'public/dishes/';

            \Storage::disk('local')->put($path.'/'.$namefile,  \File::get($request->image));
            $dish->image = $namefile;
        }

        

        if($dish->save())
            {
                $dish_id =  $dish->id; //Dish::all()->last()->id;

                for ($i=0; $i < count($request->food_id); $i++) { 
                    
                    DishDetail::create([
                        'dish_id'           => $dish_id,
                        'sem_id'            => $request->food_id[$i],
                        'quantity'          => $request->quantity[$i],
                        'eq'                => $request->eq[$i],
                        'gr'                => $request->gr[$i]
                        ]);
                }

                return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Platillo Creado satisfactoriamente');
        }
            else
            {
                return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'Platillo no pudo ser creado');
            }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$history_id)
    {
        $history = $this->getHistoryById($history_id);
        
        $dish = Dish::with(['details.ingredient'])->where('history_id',$history->id)->findOrfail($id);
        
        $patient = Patient::findOrfail($dish->patient_id);

        $kcal = 0;
        $protein = 0;
        $lipid = 0;
        $carbohydrate = 0;
        foreach($dish->details as $detail)
        {
            $kcal += $detail->ingredient->energy;
            $protein += $detail->ingredient->protein;
            $lipid += $detail->ingredient->lipids;
            $carbohydrate += $detail->ingredient->carbohydrates;
        }

       //calculamos las Kcal
        $kcal_proteins = $protein * 4;
        $kcal_lipids = $lipid * 9;
        $kcal_carbohydrates = $carbohydrate * 4;

        //Calculamos el porcentaje
        $porcent_protein = round(($kcal_proteins*100)/($kcal_proteins + $kcal_lipids + $kcal_carbohydrates));
        $porcent_lipid = round(($kcal_lipids*100)/($kcal_proteins + $kcal_lipids + $kcal_carbohydrates));
        $porcent_carbohydrate = round(($kcal_carbohydrates*100)/($kcal_proteins + $kcal_lipids + $kcal_carbohydrates));
       
       
        return \View('patients.dietetic.dishes.show', compact('dish', 'patient', 'history','kcal', 'lipid', 'protein', 'carbohydrate', 'porcent_lipid', 'porcent_protein', 'porcent_carbohydrate', 'kcal_proteins', 'kcal_lipids', 'kcal_carbohydrates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$history_id)
    {
        $history = $this->getHistoryById($history_id);

        $dish = Dish::where('history_id',$history->id)->findOrfail($id);
        
        $types = DishType::all();
        
        $temperatures = DishTemperature::all();
        
        $costs = DishCost::all();
        
        $styles = DishStyle::all();
        
        $patient = Patient::findOrfail($dish->patient_id);

        return \View('patients.dietetic.dishes.edit', compact('dish', 'patient', 'history','types', 'costs', 'temperatures', 'styles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $rules = [
            'name'              => 'required',
            'food_id'           => 'required',
            'note'              => 'required',
            'patient_id'        => ['required','numeric','exists:patients,id'],
            'history_id'        => ['required','numeric','exists:dietary_histories,id'],
        ];

        $messages = [
            'name.required' => 'El nombre es requerida',
            'food_id.required' => 'Debe agregar al menos un ingrediente',
            'note.required' => 'La preparacion o notas son requeridas'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $patient = Patient::findOrfail($request->patient_id);
        $history = $this->getHistoryById($request->history_id);

        $dish = Dish::where('history_id',$history->id)->findOrfail($id);

        $dish->patient_id = $request->patient_id;
        $dish->name = $request->name;
        $dish->user_id = Auth::user()->id;
        $dish->cost_id = $request->cost_id;
        $dish->type_id = $request->type_id;
        $dish->temperature_id = $request->temperature_id;
        $dish->style_id = $request->style_id;
        
        $kcal = array_sum($request->eq);
        $dish->kcal = $kcal;
        $dish->notes = $request->note;

        $proteins = 0;
        $lipids = 0;
        $carbohydrates = 0;
        foreach($request->food_id as $food)
        {
            $sem = Sem::findOrfail($food);
            $proteins += $sem->proteins;
            $lipids += $sem->lipds;
            $carbohydrates += $sem->carbohydrates;
        }

        $dish->carbohydrates = $carbohydrates;
        $dish->lipids = $lipids;
        $dish->proteins = $proteins;

        if($request->hasFile('image'))
        {
            $namefile = time().'.'.$request->image->getClientOriginalName();

            $path = 'public/dishes/';

            \Storage::disk('local')->put($path.'/'.$namefile,  \File::get($request->image));
            $dish->image = $namefile;
        }

        if($dish->update())
        {
            $details = DishDetail::where('dish_id', '=', $id)->get();

            foreach($details as $detail)
            {
                $detail->delete();
            }

            $dish_id = $id;

            for ($i=0; $i < count($request->food_id); $i++) { 
                    
                DishDetail::create([
                    'dish_id'           => $dish_id,
                    'sem_id'            => $request->food_id[$i],
                    'quantity'          => $request->quantity[$i],
                    'eq'                => $request->eq[$i],
                    'gr'                => $request->gr[$i]
                ]);
            }
            

            return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Platillo Editado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'Platillo no pudo ser Editado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$history_id)
    {
        $history = $this->getHistoryById($history_id);

        $dish = Dish::where('history_id',$history->id)->findOrfail($id);

        $patient = Patient::findOrfail($dish->patient_id);
        
        $image = $dish->image;

        if($dish->delete())
        {
            \Storage::delete($image);
            $details = DishDetail::where('dish_id', '=', $id)->get();

            foreach($details as $detail)
            {
                $detail->delete();
            }

            return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Platillo Eliminado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dishes.index', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'Platillo no pudo ser Eliminado');
        }
    }

    public function searchDishAjax(Request $request)
    {
        $search = $request->search;

        $history = $this->getHistoryById($request->history);
        
        $dishes = Dish::where('history_id',$history->id)->where('name', 'LIKE', '%'.$request->search.'%')
        ->orWhereHas('details.ingredient', function ($query) use ($search) {
            $query->where('food', 'LIKE', '%'.$search.'%');
        })->get();
        
        return \response()->json($dishes);
    }

    public function getHistoryById($id)
    {
        return DietaryHistory::where('user_id',\Auth::user()->id)->find($id);
    }
}
