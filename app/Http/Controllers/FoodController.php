<?php

namespace App\Http\Controllers;

use App\Food;
use App\FoodTime;
use App\FoodMineral;
use App\FoodVitamin;
use App\FoodGroup;
use Auth;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $foods = Food::all();

        $food_group = FoodGroup::all();

        return view('admin.food.index', compact('user', 'foods', 'food_group'));
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
    public function storeFoodGroup(Request $request)
    {
        FoodGroup::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Grupo de alimento creado correctamente.');
    }

    public function storeFood(Request $request)
    {
        if($request->ajax())
        {
            $params = array();
            parse_str($request->dataJson, $params);
            
            if(Food::create([
                'name'          => $params['name'],
                'group_id'      => $params['group_id'],
                'energy'        => $params['energy'],
                'protein'       => $params['protein'],
                'lipids'        => $params['lipids'],
                'carbohydrates' => $params['carbohydrates'],
                'fiber'         => $params['fiber']
            ]))
            {
                $food_id = Food::all()->last()->id;

                FoodMineral::create([
                    'food_id'   => $food_id,
                    'hierro_NO' => $params['hierro_NO'],
                    'potasio'   => $params['potasio'],
                    'hierro'    => $params['hierro'],
                    'sodio'     => $params['sodio'],
                    'calcio'    => $params['calcio'],
                    'fosforo'   => $params['fosforo'],
                    'selenio'   => $params['selenio']
                ]);

                FoodVitamin::create([
                    'food_id'   => $food_id,
                    'vitamina_A' => $params['vitamina_A'],
                    'acido_folico' => $params['acido_folico'],
                ]);

                return response()->json(['status' => 1]);
            }
            else{
                return response()->json(['status' => 0, 'message' => 'El producto no se pudo crear']);
            }
        }//end.ajax

        Food::create([
            'group_id' => $request->id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Alimento creado correctamente.');
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
    public function edit($id)
    {
        //
    }

    public function searchAjax(Request $request)
    {
        $foods = Food::where('name', 'LIKE', '%'.$request->search.'%')->get();
        return \response()->json($foods);
    }

    public function foodGroupAjax(Request $request)
    {
        if(!isset($request->dataJson))
        {
            return response()->json(['status' => 0, 'error' => 'Falta el parámetro "dataJson" para la solicitud ']);
        }

        $dataJson = json_decode($request->dataJson);

        $food_time = FoodTime::findOrfail($dataJson->id);
        $food_groups = FoodGroup::all();

        $view = \View::Make('ajax.FoodGroup', compact('food_groups', 'food_time'));
        return response($view);
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
        //
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
