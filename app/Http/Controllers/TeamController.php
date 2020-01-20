<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('backend.teams.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.teams.create');
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
            'name' => 'required',
            'cell' => 'required',
            'email' => 'required|unique:teams,email',
            'position' => 'required',
            'degree' => 'required',
            'fb' => 'required'
        ]);
        
        $team = new Team;
        $team->name = $request->name;
        $team->cell = $request->cell;
        $team->email = $request->email;
        $team->position = $request->position;
        $team->degree = $request->degree;
        $team->fb = $request->fb;
        if($request->member_image){
            $imageName = time().'.'.request()->member_image->getClientOriginalExtension();
            request()->member_image->move(public_path('images'), $imageName);
        $team->image = $imageName;
        }
        $team->save();
        Alert::success('Success Title', 'Team Member created successfully');
        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        return view('backend.teams.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('backend.teams.edit',compact('team'));
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
        // return $request;
        $this->validate($request,[
            'name' => 'required',
            'cell' => 'required',
            
            'position' => 'required',
            'degree' => 'required',
            'fb' => 'required'
        ]);
        $team = Team::find($id);
        $team->name = $request->name;
        $team->cell = $request->cell;
        $team->email = $request->email;
        $team->position = $request->position;
        $team->degree = $request->degree;
        $team->fb = $request->fb;
        $team->mode = $request->mode;
        if($request->member_image){
            if(!empty($team->image)){
                $file_path = 'images/'.$team->image;
                // return $file_path;

                unlink($file_path);
            }
            $imageName = time().'.'.request()->member_image->getClientOriginalExtension();
            request()->member_image->move(public_path('images'), $imageName);
            $team->image = $imageName;
        }else{
        }
        $team->update();
        Alert::success('Success Title', 'Team Member updated successfully');
        return redirect()->route('teams.index');
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
