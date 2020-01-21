<?php

namespace App\Http\Controllers;

use App\News;
use App\Team;
use App\Payment;
use App\Student;
use App\PaymentDetail;
use Illuminate\Http\Request;

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
        return view('backend.home',compact('students','news','teams','incomes','due'));
    }
}
