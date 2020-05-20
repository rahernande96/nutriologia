<?php

namespace App\Http\Controllers;

use DB;
use App\Reminder;
use App\ReminderFood;
use App\ReminderItem;
use App\Patient;
use App\FoodTime;
use App\FoodGroup;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::where('id', '=', $request->patient_id)->first();
             
        Reminder::create([
            'type'  => $request->type,
            'patient_id'    => $request->patient_id
        ]);

        $reminder_id = Reminder::all()->last()->id;
        
        //Si es guardado rapido
        if($request->type == \App\Reminder::RAPID)
        {
            for($i = 0; $i < count($request->food_time); $i++)
            {
                ReminderItem::create([
                    'reminder_id'   => $reminder_id,
                    'food_time_id'  => $request->food_time[$i],
                    'food_hour'     => $request->food_hour[$i],
                    'food_site'     => $request->food_site[$i],
                    'food_who'      => $request->food_who[$i]
                ]);

                $reminder_item_id = ReminderItem::all()->last()->id;

                
                for($c=0; $c<count($request->group_id); $c++)
                {
                    $quantity = $request->field[$request->food_time[$i]][$request->group_id[$c]]['quantity'][0];
                    $group_id = $request->group_id[$c];

                    if($quantity != null)
                    {
                        ReminderFood::create([
                            'reminder_item_id'   => $reminder_item_id,
                            'group_id'       => $group_id,
                            'quantity'      => $quantity
                        ]);
                    }
                }
            
            }

            return redirect()->route('reminder.show', $patient->slug)->with('success', 'Recordatorio Creado');
        }

        //si es guardado detallado
        if($request->type == \App\Reminder::DETAIL)
        {
            for($i = 0; $i < count($request->food_time); $i++)
            {
                ReminderItem::create([
                    'reminder_id'   => $reminder_id,
                    'food_time_id'  => $request->food_time[$i],
                    'food_hour'     => $request->food_hour[$i],
                    'food_site'     => $request->food_site[$i],
                    'food_who'      => $request->food_who[$i]
                ]);

                $reminder_item_id = ReminderItem::all()->last()->id;

                for($b=0; $b<count($request->field[$request->food_time[$i]]['food']);$b++)
                {
                    
                    $food_id = $request->field[$request->food_time[$i]]['food'][$b];
                    $quantity = $request->field[$request->food_time[$i]]['cantidad'][$b];
                    $unity = $request->field[$request->food_time[$i]][$food_id]['unity'][0];

                    ReminderFood::create([
                        'reminder_item_id'   => $reminder_item_id,
                        'food_id'       => $food_id,
                        'quantity'      => $quantity,
                        'unity'         => $unity
                    ]);
                }
            }

            return redirect()->route('reminder.show', $patient->slug)->with('success', 'Recordatorio Creado');
        }



    }

    public function change($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();
        $reminder = Reminder::Where('patient_id', '=', $patient->id)->first();

        $reminder_items = ReminderItem::Where('reminder_id', '=', $reminder->id)->get();

        if($reminder->delete())
        {
            foreach($reminder_items as $item)
            {
                $item->delete();
            }

            return redirect()->route('reminder.show', $slug)->with('success', 'Puede seleccionar el tipo de recordatorio');
        }
        else
        {
            return redirect()->route('reminder.show', $slug)->with('error', 'No se pudo cambiar el tipo de recordatorio, intente más tarde');
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
        $patient = Patient::Where('slug', '=', $id)->first();
        $food_group = FoodGroup::all();
        $food_times = FoodTime::all();
        $reminder = Reminder::With(['reminderItem.reminderFood'])->where('patient_id', '=', $patient['id'])->first();

        if($reminder)
        {            
            $reminder_item = ReminderItem::With(['reminderFood.foodGroup.equivalency', 'foodTime'])->where('reminder_id', '=', $reminder['id'])->first();

            if($reminder->type == 1)
            {
                $suma_protein = 0;
                $suma_lipids = 0;
                $suma_carbohydrates = 0;

                foreach($reminder_item->reminderFood as $rF)
                {
                    $suma_protein = $suma_protein + ($rF->quantity * $rF->foodGroup['equivalency']['protein']);
                    $suma_lipids = $suma_lipids + ($rF->quantity * $rF->foodGroup['equivalency']['lipids']);
                    $suma_carbohydrates = $suma_carbohydrates + ($rF->quantity * $rF->foodGroup['equivalency']['carbohydrates']);

                }

                //multiplicamos por las constantes
                $one_gr_PT = 4; //4 Kcal Proteinas
                $one_gr_LP = 9; //9 Kcal Lipidos
                $one_gr_HC = 4; //$Kcal Hidrato de Carbono

                $total_protein = $suma_protein * $one_gr_PT;
                $total_lipids = $suma_lipids * $one_gr_LP;
                $total_carbohydrates = $suma_carbohydrates * $one_gr_HC;

                $Kcal_total = $total_protein + $total_lipids + $total_carbohydrates;

                $table_chart = array();
            
                $array_lipids = ['name' => 'lipidos', 'kcal' => $total_lipids, 'gramos' => $suma_lipids];
                $array_proteins = ['name' => 'proteinas', 'kcal' => $total_protein, 'gramos' => $suma_protein];
                $array_carbohydrates = ['name' => 'carbohidratos', 'kcal' => $total_carbohydrates, 'gramos' => $suma_carbohydrates];
                
                array_push($table_chart, $array_lipids);
                array_push($table_chart, $array_proteins);
                array_push($table_chart, $array_carbohydrates);

                $reminder_macro = array();
    
                //obtenemos los macronutrientes
                array_push($reminder_macro, ['Macronutriente', 'Valor']);
                array_push($reminder_macro, ['Proteinas', $total_protein]);
                array_push($reminder_macro, ['Lipidos', $total_lipids]);
                array_push($reminder_macro, ['Hidratos de Carbono', $total_carbohydrates]);

                return view('patients.Reminder.edit')->with('patient', $patient)
                                                ->with('reminder', $reminder)
                                                ->with('reminder_item', $reminder_item)
                                                ->with('food_group', $food_group)
                                                ->with('food_times', $food_times)
                                                ->with('table_chart', $table_chart)
                                                ->with('Kcal_total', $Kcal_total)
                                                ->with('reminder_macro', json_encode($reminder_macro, JSON_UNESCAPED_UNICODE));
            }
            else
            {
                return view('patients.Reminder.edit')->with('patient', $patient)
                                                ->with('reminder', $reminder)
                                                ->with('reminder_item', $reminder_item)
                                                ->with('food_group', $food_group)
                                                ->with('food_times', $food_times);
            }//fin de if
        }
        else
        {
            return view('patients.Reminder.create', compact('patient', 'food_group', 'food_times'));
        }
        
    }

    public function chartFoodGroupAjax(Request $request)
    {
        if(!isset($request->dataJson))
        {
            return response()->json(['status' => 0, 'error' => 'Falta el parámetro "dataJson" para la solicitud ']);
        }

        $dataJson = json_decode($request->dataJson);
        
        $food_time_id = $dataJson->food_time_id;
        $patient_id = $dataJson->patient_id;
        $reminder_id = $dataJson->reminder_id;

        $patient = Patient::findOrfail($patient_id);

        $reminder = Reminder::findOrfail($reminder_id);

        $suma_protein = 0;
        $suma_lipids = 0;
        $suma_carbohydrates = 0;

        if($food_time_id == 0)
        {
            $reminder_item = ReminderItem::Select(DB::raw('SUM(reminder_foods.quantity) as quantity, 
                                                            food_group_equivalents.energy as energy,
                                                            food_group_equivalents.protein as protein,
                                                            food_group_equivalents.lipids as lipids,
                                                            food_group_equivalents.carbohydrates as carbohydrates'
                                                        ), 'reminder_foods.group_id')
                                            ->with(['reminderFood.foodGroup.equivalency', 'foodTime'])
                                            ->join('reminder_foods', 'reminder_foods.reminder_item_id', 'reminder_items.id')
                                            ->join('food_group_equivalents', 'food_group_equivalents.group_id', 'reminder_foods.group_id')
                                            ->where('reminder_id', '=', $reminder_id)
                                            ->where('reminder_foods.group_id', '<>', null)
                                            ->groupBy('reminder_foods.group_id')
                                            ->get();
                                            
            foreach($reminder_item as $rI)
            {
                $suma_protein = $suma_protein + ($rI->quantity * $rI->protein);
                $suma_lipids = $suma_lipids + ($rI->quantity * $rI->lipids);
                $suma_carbohydrates = $suma_carbohydrates + ($rI->quantity * $rI->carbohydrates);
            }
        }
        else
        {
            $reminder_item = ReminderItem::With(['reminderFood.foodGroup.equivalency', 'foodTime'])->where('reminder_id', '=', $reminder_id)->where('food_time_id', '=', $food_time_id)->first();

            foreach($reminder_item->reminderFood as $rF)
            {
                $suma_protein = $suma_protein + ($rF->quantity * $rF->foodGroup['equivalency']['protein']);
                $suma_lipids = $suma_lipids + ($rF->quantity * $rF->foodGroup['equivalency']['lipids']);
                $suma_carbohydrates = $suma_carbohydrates + ($rF->quantity * $rF->foodGroup['equivalency']['carbohydrates']);

            }
        }

        //multiplicamos por las constantes
        $one_gr_PT = 4; //4 Kcal Proteinas
        $one_gr_LP = 9; //9 Kcal Lipidos
        $one_gr_HC = 4; //$Kcal Hidrato de Carbono

        $total_protein = $suma_protein * $one_gr_PT;
        $total_lipids = $suma_lipids * $one_gr_LP;
        $total_carbohydrates = $suma_carbohydrates * $one_gr_HC;

        $Kcal_total = $total_protein + $total_lipids + $total_carbohydrates;

        $table_chart = array();
       
        $array_lipids = ['name' => 'lipidos', 'kcal' => $total_lipids, 'gramos' => $suma_lipids];
        $array_proteins = ['name' => 'proteinas', 'kcal' => $total_protein, 'gramos' => $suma_protein];
        $array_carbohydrates = ['name' => 'carbohidratos', 'kcal' => $total_carbohydrates, 'gramos' => $suma_carbohydrates];
        
        array_push($table_chart, $array_lipids);
        array_push($table_chart, $array_proteins);
        array_push($table_chart, $array_carbohydrates);

        $reminder_macro = array();

        //obtenemos los macronutrientes
        array_push($reminder_macro, ['Macronutriente', 'Valor']);
        array_push($reminder_macro, ['Proteinas', $total_protein]);
        array_push($reminder_macro, ['Lipidos', $total_lipids]);
        array_push($reminder_macro, ['Hidratos de Carbono', $total_carbohydrates]);

        //$view = \View::Make('ajax.FoodGroup', compact('food_groups', 'food_time'));

        $view = \View::Make('ajax.ReminderChart')->with('patient', $patient)
                                            ->with('food_time_id', $food_time_id)
                                            ->with('reminder', $reminder)
                                            ->with('reminder_item', $reminder_item)
                                            ->with('table_chart', $table_chart)
                                            ->with('Kcal_total', $Kcal_total)
                                            ->with('reminder_macro', json_encode($reminder_macro, JSON_UNESCAPED_UNICODE));

        return response($view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $reminder = Reminder::findOrfail($id);

        $patient = Patient::where('id', '=', $reminder->patient_id)->first();

        $reminder_items = ReminderItem::Where('reminder_id', '=', $id)->get();
        
        foreach($reminder_items as $rI)
        {
            foreach(ReminderFood::Where('reminder_item_id', '=', $rI->id)->get() as $rF)
            {
                $rF->delete();
            }

            $rI->delete();
        }

        //Si es guardado rapido
        if($request->type == \App\Reminder::RAPID)
        {
            for($i = 0; $i < count($request->food_time); $i++)
            {
                ReminderItem::create([
                    'reminder_id'   => $id,
                    'food_time_id'  => $request->food_time[$i],
                    'food_hour'     => $request->food_hour[$i],
                    'food_site'     => $request->food_site[$i],
                    'food_who'      => $request->food_who[$i]
                ]);

                $reminder_item_id = ReminderItem::all()->last()->id;

                
                for($c=0; $c<count($request->group_id); $c++)
                {
                    $quantity = $request->field[$request->food_time[$i]][$request->group_id[$c]]['quantity'][0];
                    $group_id = $request->group_id[$c];

                    if($quantity != null)
                    {
                        ReminderFood::create([
                            'reminder_item_id'   => $reminder_item_id,
                            'group_id'       => $group_id,
                            'quantity'      => $quantity
                        ]);
                    }
                }
            
            }

            return redirect()->route('reminder.show', $patient->slug)->with('success', 'Recordatorio Creado');
        }

        if($request->type == \App\Reminder::DETAIL)
        {
            for($i = 0; $i < count($request->food_time); $i++)
            {
                ReminderItem::create([
                    'reminder_id'   => $id,
                    'food_time_id'  => $request->food_time[$i],
                    'food_hour'     => $request->food_hour[$i],
                    'food_site'     => $request->food_site[$i],
                    'food_who'      => $request->food_who[$i]
                ]);

                $reminder_item_id = ReminderItem::all()->last()->id;

                for($b=0; $b<count($request->field[$request->food_time[$i]]['food']);$b++)
                {
                    //echo $request->field[$request->food_time[$i]]['product'][$b]; //product_id
                    //echo $request->field[$request->food_time[$i]]['cantidad'][$b]; //cantidad
                    //echo $request->field[$request->food_time[$i]][$request->field[$request->food_time[$i]]['product'][$b]]['unity'][0]; //unidad

                    $food_id = $request->field[$request->food_time[$i]]['food'][$b];
                    $quantity = $request->field[$request->food_time[$i]]['cantidad'][$b];
                    $unity = $request->field[$request->food_time[$i]][$food_id]['unity'][0];

                    ReminderFood::create([
                        'reminder_item_id'   => $reminder_item_id,
                        'food_id'       => $food_id,
                        'quantity'      => $quantity,
                        'unity'         => $unity
                    ]);
                }
            }


            return redirect()->route('reminder.show', $patient->slug)->with('success', 'Recordatorio Creado');
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
