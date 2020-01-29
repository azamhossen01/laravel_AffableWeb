<?php

namespace App\Http\Controllers;

use App\Student;
use App\Certificate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = Student::where('mode',1)->get();
        $certificates = Certificate::all();
        return view('backend.certificate.index',compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $students = Student::where('mode',1)->get();
        return view('backend.certificate.create',compact('students'));
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
        $certificate = new Certificate;
        $certificate->serial_number = $request->serial_number;
        $certificate->student_id = $request->student_id;
        
        if($request->certificate_image){
            $imageName = time().'.'.request()->certificate_image->getClientOriginalExtension();
            request()->certificate_image->move(public_path('images/certificate'), $imageName);
        $certificate->certificate_image = $imageName;
        }
        $certificate->save();
        Alert::success('Success Title', 'Certificate created successfully');
        return redirect()->route('certificates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = Certificate::find($id);
        return view('backend.certificate.show',compact('certificate'));
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
        $certificate = Certificate::find($id)->delete();
        Alert::success('Success Title', 'Certificate deleted successfully');
        return redirect()->route('certificates.index');
    }

    public function change_status(){
        $status = $_GET['status']?'0':'1';
        $certificate_id = $_GET['certificate_id'];
        $certificate = Certificate::find($certificate_id);
        $certificate->status = $status;
        $certificate->update();
        Alert::success('Success Title', 'Certificate status updated successfully');
        return 1;

    }
}
