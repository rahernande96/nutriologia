<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Patient;
use Calendar;
use App\Event;
use Illuminate\Support\Str;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $patients = Patient::where('user_id', $user->id)->get();

        $events = Event::where('user_id', $user->id)->get();

        return view('appoinments.index', compact('user', 'events', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $user = Auth::user();

        $events = Event::where('user_id', $user->id)->get();

        $patient = Patient::where('slug', $slug)->first();

        return view('quotes.create', compact('patient', 'user', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $user = Auth::user();

        Event::create([
            'user_id' => $user->id,
            'patient_id' => $request->patient,
            'title' => $request->title,
            'slug' => str_slug(Str::random(40)),
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->start_date
        ]);

        return back()->with('success', 'Cita registrada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = Auth::user();

        $event = Event::where('slug', $slug)->first();

        return view('appoinments.show', compact('user','event'));
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
    public function destroy($slug)
    {
        $event = Event::where('slug', $slug)->delete();

        return redirect()->route('event.index')->with('success', 'Cita eliminada correctamente');
    }
}
