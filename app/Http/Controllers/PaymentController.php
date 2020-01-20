<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Student;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('backend.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        // return $students;
        return view('backend.payments.create',compact('students'));
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
            'student_id' => 'required',
            'course_fee' => 'required',
            'total_paid' => 'required',
            'date' => 'required'
        ]);
        $month_year = date('mY',strtotime($request->date));
        // return $month_year;
        $payment = new Payment;
        $payment->student_id = $request->student_id;
        $payment->course_fee = $request->course_fee;
        $payment->total_paid = $request->total_paid;
        $payment->date = $request->date;
        $payment->month_year = $month_year;
        $payment->created_by = Auth::id();
        $payment->save();
        if($payment->id){
            $payment_detail = new PaymentDetail;
            $payment_detail->payment_id = $payment->id;
            $payment_detail->amount = $request->total_paid;
            $payment_detail->date = $request->date;
            $payment_detail->month_year = $month_year;
            $payment_detail->created_by = Auth::id();
            $payment_detail->save();
        }
        Alert::success('Success Title', 'Payment created successfully');
        return redirect()->route('payments.index');
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
