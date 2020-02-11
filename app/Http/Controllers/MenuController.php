<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Dish;
use App\Sem;
use App\Menu;
use App\MenuDetail;
use App\FoodGroup;
use App\FoodTime;
use Alert;
use Auth;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index($slug){
        $patient = Patient::Where('slug', '=', $slug)->first();
        $doctor_id = Auth::user()->id;
        $food_groups = FoodGroup::all();
        $food_times = FoodTime::all();

        $menus = Menu::With(['patient'])->whereHas('patient', function($query) use ($doctor_id){
            $query->whereHas('user', function($query) use ($doctor_id){
                $query->where('user_id', '=', $doctor_id);
            });
        })
        ->get();
        
        $menu = Menu::With(['details.dish'])->where('patient_id', '=', $patient->id)->first();

        if($menu)
        {
            $menu['days'] = json_decode($menu->days);
            $menu['food_times'] = json_decode($menu->food_times);
          
            return View('patients.dietetic.menu.edit', compact('patient', 'menu', 'food_groups', 'food_times'));
        }
        else
        {
            return View('patients.dietetic.menu.create', compact('patient', 'food_groups', 'food_times', 'menus'));
        }
    }

    public function copy(Request $request)
    {
        $patient = Patient::findOrfail($request->patient_id);
        $menu = Menu::findOrfail($request->menu_id);

        $new_menu = new Menu;

        $new_menu->name = $menu->name;
        $new_menu->days = $menu->days;
        $new_menu->food_times = $menu->food_times;
        $new_menu->patient_id = $patient->id;

        if($new_menu->save())
        {
            $menu_id = Menu::all()->last()->id;
            $details = MenuDetail::Where('menu_id', '=', $menu->id)->get();

            foreach($details as $detail)
            {
                MenuDetail::create([
                    'menu_id'       => $menu_id,
                    'day'           => $detail->day,
                    'food_time_id'  => $detail->food_time_id,
                    'dish_id'       => $detail->dish_id
                ]);
            }
            return redirect()->route('dietetic.menu', $patient->slug)->with('success', 'Menu Copiado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', $patient->slug)->with('error', 'El menu no pudo ser copiado');
        }


    }

    public function store(Request $request)
    {
        
        $rules = [
            'days'              => 'required',
            'food_time'         => 'required',
            'name'              => 'required',
            'dishes'            => 'required'
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
        //return $request->all();
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->days = json_encode($request->days);
        $menu->food_times = json_encode($request->food_time);
        $menu->patient_id = $request->patient_id;

        if($menu->save())
        {
            $menu_id = Menu::all()->last()->id;

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

            return redirect()->route('dietetic.menu', $patient->slug)->with('success', 'Menu Creado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', $patient->slug)->with('error', 'El menu no pudo ser creado');
        }
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $rules = [
            'days'              => 'required',
            'food_time'         => 'required',
            'name'              => 'required',
            'dishes'            => 'required'
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

        $menu = Menu::findOrfail($id);
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

            return redirect()->route('dietetic.menu', $patient->slug)->with('success', 'Menu Creado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', $patient->slug)->with('error', 'El menu no pudo ser creado');
        }
    }

    public function searchSemAjax(Request $request)
    {
        $foods = Sem::where('food', 'LIKE', '%'.$request->search.'%')->get();
        return \response()->json($foods);
    }

    public function search(Request $request, $slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        if($request->get('search'))
        {
            $search = $request->get('search');
           

            $dishes = Dish::With(['ingredients'])->Where('patient_id', '=', $patient->id)->Where('name', 'LIKE', '%'.$search.'%')
                            ->orWhereHas('ingredients', function($query) use ($search){
                                $query->where('food', 'like', '%'.$search.'%');
                            })
                            ->get();
                            
         
            $costs = Dish::With(['cost'])->where('patient_id', '=', $patient->id)->groupBy('cost_id')->get();
            $types = Dish::With(['type'])->where('patient_id', '=', $patient->id)->groupBy('type_id')->get();
            $temperatures = Dish::With(['temperature'])->where('patient_id', '=', $patient->id)->groupBy('temperature_id')->get();
            $styles = Dish::With(['style'])->where('patient_id', '=', $patient->id)->groupBy('style_id')->get();
           
            return \View('patients.dietetic.menu.search', compact('patient', 'dishes', 'costs', 'types', 'temperatures', 'styles', 'search'));
        }
        else
        {
            return \View('patients.dietetic.menu.search', compact('patient'));
        }
    }

    public function delete($id)
    {
        $menu = Menu::findOrfail($id);
        $patient = Patient::findOrfail($menu->patient_id);
        
        $details = MenuDetail::Where('menu_id', '=', $id)->get();
        if($menu->delete())
        {

            foreach($details as $detail)
            {
                $detail->delete();
            }

            return redirect()->route('dietetic.menu', $patient->slug)->with('success', 'Menu Eliminado satisfactoriamente');
        }
        else
        {
            return redirect()->route('dietetic.menu', $patient->slug)->with('error', 'Menu no pudo ser Eliminado');
        }
    }
   
}
