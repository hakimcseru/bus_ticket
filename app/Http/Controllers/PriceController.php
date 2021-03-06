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
use App\Price;
use Illuminate\Support\Facades\Auth;


class PriceController  extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        $prices= Price::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $prices=Price::where('route_name','like','%'.$search.'%')
                          ->orWhere('vehicle_type','like','%'.$search.'%')
                          ->orWhere('price','like','%'.$search.'%')
                          ->orderBy('id','DESC')->paginate(5);
        }

        return view('price.index',compact('prices'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        $route_ides = Route::pluck('name','id');
       

        return view('price.create',compact('route_ides'));


        
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
            'route_id' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();

        $user = new Price();
        $user->route_id=$input['route_id'];
        $user->route_name=Route::find($input['route_id'])->name;
        $user->vehicle_type=$input['vehicle_type'];
        $user->price=$input['price'];
        $user->groups_per_person=$input['groups_per_person'];
        $user->group_members=$input['group_members'];
        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;

        $user->save();

        return redirect()->route('price.index')
            ->with('success','Price created successfully');
            
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



       $locations = Location::pluck('name','id');

       
        $route = Route::find($id);
        return view('route.edit',compact('route','locations'));
        
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
           'name' => 'required'
        ]);

        $input = $request->all();


        $stoped_point=explode(',', $input['stoppage_points']);
        $stoped_points=json_encode($stoped_point);

        $user = Route::find($id);


        $user->name=$input['name'];
        $user->start_point=$input['start_point'];
        $user->start_point_name=Location::find($input['start_point'])->name;
        $user->end_point=$input['end_point'];
        $user->end_point_name=Location::find($input['end_point'])->name;
        $user->stoppage_points=$stoped_points;
       
        $user->distance=$input['distance'];
        $user->approximate_time=$input['approximate_time'];
        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;
        $user->save();



       




        return redirect()->route('route.index')
            ->with('success','Route updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Route::find($id);

        $user->delete();
        return redirect()->route('route.index')
            ->with('success','Route deleted successfully');
    }
}
