<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Sem;
use App\Dish;
use App\Menu;
use App\Patient;
use App\FoodTime;
use App\FoodGroup;
use App\MenuDetail;
use App\DietaryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index($slug, $history_id)
    {
        $history = $this->getHistoryById($history_id);

        $patient = Patient::Where('slug', '=', $slug)->first();
        $doctor_id = Auth::user()->id;
        $food_groups = FoodGroup::all();
        $food_times = FoodTime::all();

        $menus = Menu::With(['patient'])->whereHas('patient', function($query) use ($doctor_id){
            $query->whereHas('user', function($query) use ($doctor_id){
                $query->where('user_id', '=', $doctor_id);
            });
        })
        //->where('history_id',$history->id)
        ->get();
        
        $menu = Menu::With(['details.dish'])->where('history_id',$history->id)->where('patient_id', '=', $patient->id)->first();

        if($menu)
        {
            $menu['days'] = json_decode($menu->days);
            $menu['food_times'] = json_decode($menu->food_times);
          
            return View('patients.dietetic.menu.edit', compact('patient', 'history', 'menu', 'food_groups', 'food_times'));
        }
        else
        {
            return View('patients.dietetic.menu.create', compact('patient', 'history', 'food_groups', 'food_times', 'menus'));
        }
    }

    public function copy(Request $request)
    {
       
        $request->validate([
            'patient_id'        => ['required','numeric','exists:patients,id'],
            'history_id'        => ['required','numeric','exists:dietary_histories,id'],
            'menu_id'        => ['required','numeric','exists:menus,id'],

        ]);
        
        $patient = Patient::findOrfail($request->patient_id);
        
        $history = $this->getHistoryById($request->history_id);
        ;
        $menu = Menu::findOrfail($request->menu_id);
            
        //$new_menu = new Menu;

        // $new_menu->name = $menu->name;
        // $new_menu->days = $menu->days;
        // $new_menu->food_times = $menu->food_times;
        // $new_menu->patient_id = $patient->id;
        // $new_menu->history_id = $history->id;
        
        $new_menu = Menu::create([
            'name'=>$menu->name,
            'days'=>$menu->days,
            'food_times'=>$menu->food_times,
            'patient_id'=>$patient->id,
            'history_id'=>$history->id,

        ]);

        if($new_menu)
        {
            $menu_id = $new_menu->id;//Menu::all()->last()->id;
            $details = MenuDetail::Where('menu_id', '=', $menu_id)->get();

            foreach($details as $detail)
            {
                MenuDetail::create([
                    'menu_id'       => $menu_id,
                    'day'           => $detail->day,
                    'food_time_id'  => $detail->food_time_id,
                    'dish_id'       => $detail->dish_id
                ]);
            }
            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Menu Copiado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'El menu no pudo ser copiado');
        }


    }

    public function store(Request $request)
    {
        
        $rules = [
            'days'              => 'required',
            'food_time'         => 'required',
            'name'              => 'required',
            'dishes'            => 'required',
            'patient_id'        => ['required','numeric','exists:patients,id'],
            'history_id'        => ['required','numeric','exists:dietary_histories,id'],
        ];

        $messages = [
            'days.required'             => 'Debe seleccionar al menos un dia',
            'food_time.required'        => 'Debe seleccionar al menos un tiempo de comida',
            'name.required'             => 'El nombre del menu es requerido',
            'dishes.required'           => 'La debe seleccionar al menos un platillo'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $history = $this->getHistoryById($request->history_id);
        $patient = Patient::findOrfail($request->patient_id);
        //return $request->all();
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->days = json_encode($request->days);
        $menu->food_times = json_encode($request->food_time);
        $menu->patient_id = $request->patient_id;
        $menu->history_id = $request->history_id;

        if($menu->save())
        {
            $menu_id = $menu->id;//Menu::all()->last()->id;

            for ($i=0; $i < count($request->days); $i++) { 
                for ($x=0; $x < count($request->food_time); $x++) { 

                    foreach($request->dishes[$request->days[$i]][$request->food_time[$x]]['dish'] as $dish)
                    {
                        MenuDetail::create([
                            'menu_id'   => $menu_id,
                            'day'       => $request->days[$i],
                            'food_time_id'  => $request->food_time[$x],
                            'dish_id'       => $dish
                        ]);
                    }

                }
            }

            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Menu Creado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'El menu no pudo ser creado');
        }
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $rules = [
            'days'              => 'required',
            'food_time'         => 'required',
            'name'              => 'required',
            'dishes'            => 'required',
            'patient_id'        => ['required','numeric','exists:patients,id'],
            'history_id'        => ['required','numeric','exists:dietary_histories,id'],
        ];

        $messages = [
            'days.required'             => 'Debe seleccionar al menos un dia',
            'food_time.required'        => 'Debe seleccionar al menos un tiempo de comida',
            'name.required'             => 'El nombre del menu es requerido',
            'dishes.required'           => 'La debe seleccionar al menos un platillo'
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

        $menu = Menu::where('history_id',$history->id)->findOrfail($id);
        /*$menu->name = $request->name;
        $menu->days = json_encode($request->days);
        $menu->food_times = json_encode($request->food_time);
        $menu->patient_id = $request->patient_id;*/
        $name = $request->name;
        $food_times = json_encode($request->food_time);
        $days = json_encode($request->days);
        $patient_id = $request->patient_id;

        if($menu->update([
            'name'          => $name,
            'patient_id'    => $patient_id,
            'days'          => $days,
            'food_times'    => $food_times
        ]))
        {
            
            $details = MenuDetail::Where('menu_id', '=', $id)->get();

            foreach($details as $detail)
            {
                $detail->delete();
            }

            for ($i=0; $i < count($request->days); $i++) { 
                for ($x=0; $x < count($request->food_time); $x++) { 

                    foreach($request->dishes[$request->days[$i]][$request->food_time[$x]]['dish'] as $dish)
                    {
                        MenuDetail::create([
                            'menu_id'   => $id,
                            'day'       => $request->days[$i],
                            'food_time_id'  => $request->food_time[$x],
                            'dish_id'       => $dish
                        ]);
                    }
                }
            }

            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Menu Creado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'El menu no pudo ser creado');
        }
    }

    public function searchSemAjax(Request $request)
    {
        $foods = Sem::where('food', 'LIKE', '%'.$request->search.'%')->get();
        return \response()->json($foods);
    }

    public function search(Request $request, $slug, $history_id)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $history = $this->getHistoryById($history_id);

        if($request->get('search'))
        {
            $search = $request->get('search');
           

            $dishes = Dish::With(['ingredients'])->where('history_id',$history->id)->Where('patient_id', '=', $patient->id)->Where('name', 'LIKE', '%'.$search.'%')
                            ->orWhereHas('ingredients', function($query) use ($search){
                                $query->where('food', 'like', '%'.$search.'%');
                            })
                            ->get();
                            
         
            $costs = Dish::With(['cost'])->where('history_id',$history->id)->where('patient_id', '=', $patient->id)->groupBy('cost_id')->get();
            
            $types = Dish::With(['type'])->where('history_id',$history->id)->where('patient_id', '=', $patient->id)->groupBy('type_id')->get();
            
            $temperatures = Dish::With(['temperature'])->where('history_id',$history->id)->where('patient_id', '=', $patient->id)->groupBy('temperature_id')->get();
            
            $styles = Dish::With(['style'])->where('history_id',$history->id)->where('patient_id', '=', $patient->id)->groupBy('style_id')->get();
           
            return \View('patients.dietetic.menu.search', compact('patient', 'history','dishes', 'costs', 'types', 'temperatures', 'styles', 'search'));
        }
        else
        {
            return \View('patients.dietetic.menu.search', compact('patient','history'));
        }
    }

    public function delete($id,$history_id)
    {
        $history = $this->getHistoryById($history_id);

        $menu = Menu::where("history_id",$history->id)->findOrfail($id);
        $patient = Patient::findOrfail($menu->patient_id);
        
        $details = MenuDetail::Where('menu_id', '=', $id)->get();
        if($menu->delete())
        {

            foreach($details as $detail)
            {
                $detail->delete();
            }

            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('success', 'Menu Eliminado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', ['slug'=>$patient->slug,'history_id'=>$history->id])->with('error', 'Menu no pudo ser Eliminado');
        }
    }

    public function getHistoryById($id)
    {
        return DietaryHistory::where('user_id',\Auth::user()->id)->find($id);
    }
   
}
