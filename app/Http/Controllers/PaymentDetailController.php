<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentDetailController extends Controller
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
        // return $request;
        
        
        $this->validate($request,[
            'payment_id' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        $payment_details = PaymentDetail::where('payment_id',$request->payment_id)->get();
        $payment = Payment::find($request->payment_id);
        $total = $request->amount + $payment_details->sum('amount');
        if($total > $payment->course_fee){
            Alert::error('Error Title', 'Can\'t pay more than course fee');
            return redirect()->back();
        }
        if($total == $payment->course_fee){
            $payment = Payment::find($request->payment_id);
            $payment->status = 1;
            $payment->update();
        }

        $payment->total_paid = $total;
        $payment->update();

        $month_year = date('mY',strtotime($request->date));
        $payment_detail = new PaymentDetail;
        $payment_detail->payment_id = $request->payment_id;
        $payment_detail->date = $request->date;
        $payment_detail->month_year = $month_year;
        $payment_detail->amount = $request->amount;
        $payment_detail->created_by = Auth::id();
        $payment_detail->save();
        Alert::success('Success Title', 'Payment created successfully');
        return redirect()->back();
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
