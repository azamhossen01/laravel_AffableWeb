<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('backend.students.index',compact('students'));
    }

    public function get_student($id){
        $student = Student::find($id);
        return $student;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:students,email',
        ]);

        $student = new Student;
        $student->name = $request->name;
        $student->fathers_name = $request->fathers_name;
        $student->mothers_name = $request->mothers_name;
        $student->cell = $request->cell;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->institution = $request->institution;
        $student->course_name = $request->course_name;
        $student->course_code = $request->course_code;
        $student->batch_no = $request->batch_no;
        $student->password = bcrypt($request->password);
        $student->save();
        Alert::success('Success Title', 'Student created successfully');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('backend.students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        
        return view('backend.students.edit',compact('student'));
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
        $student = Student::find($id);
        $student->name = $request->name;
        $student->fathers_name = $request->fathers_name;
        $student->mothers_name = $request->mothers_name;
        $student->cell = $request->cell;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->institution = $request->institution;
        $student->course_name = $request->course_name;
        $student->course_code = $request->course_code;
        $student->batch_no = $request->batch_no;
        if($request->password){
            $student->password = bcrypt($request->password);
        }
        
        $student->update();
        Alert::success('Success Title', 'Student updated successfully');
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id)->delete();
        Alert::success('Success Title', 'Student deleted successfully');
        return redirect()->route('students.index');
    }
}
