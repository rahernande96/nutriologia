<?php

namespace App\Http\Controllers;

use App\Patient;
use App\DietaryHistory;
use Illuminate\Http\Request;

class DieteticHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $records = DietaryHistory::where('patient_id',$patient->id)
                    ->where('user_id',\Auth::user()->id)
                    ->latest()
                    ->get();
        
        return View('patients.dietetic.history.index', compact('patient','records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $patient = Patient::Where('slug', '=', $slug)->first();

        $history = DietaryHistory::create([
            'patient_id'=>$patient->id,
            'user_id'=>\Auth::user()->id,
        ]);

        return redirect()->route('dietetic.index',['slug'=>$slug,'history_id'=>$history->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
