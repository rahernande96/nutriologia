<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use App\PaymentMethodDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentsMethods = PaymentMethod::get();

        return view('paymentMethod.index',[
            'paymentsMethods'=>$paymentsMethods,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (!$paymentsMethod = PaymentMethod::with('details')->find($id)) {
            return abort(404);
        }

        return view('paymentMethod.details',[
            'paymentsMethod'=>$paymentsMethod,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code_button'=>['required','string'],
            'title'=>['required','string','max:255'],
        ]);

        $user = Auth::user();

        if (!$paymentsMethod = PaymentMethod::find($id)) {
            return abort(404);
        }

        $paymentDetails = PaymentMethodDetail::where('user_id',$user->id)->where('payment_method_id',$paymentsMethod->id)->first();

        if ($paymentDetails) {
            
            $paymentDetails->update([
                'title'=>$request->input('title'),
                'html'=>$request->input('code_button'),
            ]);

        }else{

            $code = $this->generateRandomString(30);

            $details = PaymentMethodDetail::where('code_link',$code)->first();
            
            //si codigo unico existe en base de datos generar uno nuevo
            while ($details) {
                
                $code = $this->generateRandomString(30);

                $details = PaymentMethodDetail::where('code_link',$code)->first();

            }

            PaymentMethodDetail::create([
                'user_id'=>$user->id,
                'payment_method_id'=>$paymentsMethod->id,
                'title'=>$request->input('title'),
                'html'=>$request->input('code_button'),
                'code_link'=>$code,
            ]);

        }


        return back()->with('success','Guardado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }


    private function generateRandomString($length = 15) {
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,$length));
        $unique = $today . $rand;

        return $unique;
    } 

    public function paymentGuest($code)
    {
        $details = PaymentMethodDetail::where('code_link',$code)->first();

        if(!$details)
        {
            return abort(404);
        }

        return view('paymentGuest',[
            'details'=>$details,
        ]);
    }
}
