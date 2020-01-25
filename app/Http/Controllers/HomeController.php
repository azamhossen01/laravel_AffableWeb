<?php

namespace App\Http\Controllers;

use App\News;
use App\Team;
use App\User;
use App\Payment;
use App\Student;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = count(Student::where('mode',1)->get());
        $news = count(News::where('mode',1)->get());
        $teams = count(Team::where('mode',1)->get());
        $incomes = PaymentDetail::all()->sum('amount');
        $due = (Payment::all()->sum('course_fee') - $incomes);
        $recent_payments = PaymentDetail::orderBy('created_at','desc')->take(5)->get();
        // return $recent_payments;
        return view('backend.home',compact('students','news','teams','incomes','due','recent_payments'));
    }

    public function profile($id){
        $user = User::find($id);
        return view('backend.profile.profile',compact('user'));
    }

    public function update_user(Request $request,$id){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'cell' => 'required',
            'password' => 'min:6'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cell = $request->cell;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->update();
        Alert::success('Success Title', 'Please login again');
        Auth::logout();
        return redirect()->back();
    }

    public function messages(){
        $students = Student::where('mode',1)->get();
        return view('backend.message.messages',compact('students'));
    }

    public function send_message(Request $request){
        $message = $request->message;
        // return $request->student_id;
        foreach($request->student_id as $id){
            $student = Student::find($id);
            // code for sending sms 
        // $student = Student::find($request->student_id);
        $to = $student->cell;
        // $to = "017xxxxxxx,+88016xxxxxxx";
        $token = "967c5bf770a47eb1731dec1e5690a7c4";
        $message = "Hello $student->name $message";

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


        
        }

        Alert::success('Success Title', 'Message Sent Successfully');
        return redirect()->route('payments.index');
    }
}
