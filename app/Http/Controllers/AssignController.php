<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Employee;

use App\Country;
use App\Role;
use DB;
use Hash;
use App\BookIssue;
use App\Location;
use App\Route;
use App\Assign;
use App\Bus;
use Illuminate\Support\Facades\Auth;


class AssignController  extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        $assignes= Assign::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $assignes=Assign::where('route_name','like','%'.$search.'%')
                          ->orWhere('driver_name','like','%'.$search.'%')
                          ->orderBy('id','DESC')->paginate(5);
        }

        return view('assign.index',compact('assignes'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $drivers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'driver');
         })->pluck('name','id');


        $assistants = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'assistants');
         })->pluck('name','id');
      
      

        $fleet_registration_noes = Bus::pluck('registration_no','registration_no');
        $route_ides = Route::pluck('name','id');

        return view('assign.create',compact('fleet_registration_noes','route_ides','assistants','drivers'));


        
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
            'fleet_registration_no' => 'required'
        ]);

        $input = $request->all();

        $user = new Assign();
        $user->fleet_registration_no=$input['fleet_registration_no'];
        $user->route_id=$input['route_id'];
        $user->route_name=Route::find($input['route_id'])->name;

        $user->start_point_name=Route::find($input['route_id'])->start_point_name;
        $user->end_point_name=Route::find($input['route_id'])->end_point_name;
        
        $user->start_date=$input['start_date'];
        $user->end_date=$input['end_date'];

        $user->start_time=$input['start_time'];
        $user->end_time=$input['end_time'];

        $user->driver_name=$input['driver_name'];
        $user->assistants=json_encode($input['assistants']);
       

        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;

        $user->save();

        return redirect()->route('assign.index')
            ->with('success','Assign created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::find($id);
        return view('route.show',compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drivers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'driver');
         })->pluck('name','id');


        $assistants = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'assistants');
         })->pluck('name','id');
      
      

        $fleet_registration_noes = Bus::pluck('registration_no','registration_no');
        $route_ides = Route::pluck('name','id');


        $assign = Assign::find($id);
        return view('assign.edit',compact('fleet_registration_noes','route_ides','assistants','drivers','assign'));
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
        $this->validate($request, [
            'fleet_registration_no' => 'required'
        ]);

        $input = $request->all();
        $user=Assign::find($id);
        $user->fleet_registration_no=$input['fleet_registration_no'];
        $user->route_id=$input['route_id'];
        $user->route_name=Route::find($input['route_id'])->name;

        $user->start_point_name=Route::find($input['route_id'])->start_point_name;
        $user->end_point_name=Route::find($input['route_id'])->end_point_name;
        
        $user->start_date=$input['start_date'];
        $user->end_date=$input['end_date'];

        $user->start_time=$input['start_time'];
        $user->end_time=$input['end_time'];

        $user->driver_name=$input['driver_name'];
        $user->assistants=json_encode($input['assistants']);
       

        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;
        $user->save();

        return redirect()->route('assign.index')
            ->with('success','Assign updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Assign::find($id);

        $user->delete();
        return redirect()->route('assign.index')
            ->with('success','Assign deleted successfully');
    }
}
