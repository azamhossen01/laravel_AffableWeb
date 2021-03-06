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
        $payment = Payment::where(['month_year'=>$month_year,'student_id'=>$request->student_id])->get();
        // return count($payment);
        if(count($payment)>0){
            Alert::error('Error Title', 'Payment created already for this month');
            return redirect()->back();
        }
        
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

        // code for sending sms 
        $student = Student::find($request->student_id);
        $to = $student->cell;
        // $to = "017xxxxxxx,+88016xxxxxxx";
        $token = "967c5bf770a47eb1731dec1e5690a7c4";
        $message = "Thank You $student->name. Paid $request->total_paid successfully!";

        $url = "http://api.greenweb.com.bd/api.php";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        //Result
        echo $smsresult;

        //Error Display
        echo curl_error($ch);


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
        $payment=Payment::find($id);
        $payment_details = $payment->payment_details;
        return view('backend.payments.show',compact('payment','payment_details'));
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
