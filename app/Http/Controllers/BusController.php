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
use App\Bus;
use Illuminate\Support\Facades\Auth;


class BusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        $buses= Bus::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $buses=Bus::where('registration_no','like','%'.$search.'%')->orWhere('engine_no','like','%'.$search.'%')->orderBy('id','DESC')->paginate(5);
        }

        return view('bus.index',compact('buses'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bus.create');
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
            'registration_no' => 'required'
        ]);





        $input = $request->all();



         $seat_number=explode(',', $input['seat_number']);
         $seat_number=json_encode($seat_number);

         

        $user = new Bus();
        $user->registration_no=$input['registration_no'];
        $user->fleet_type=$input['fleet_type'];
        $user->engine_no=$input['engine_no'];
        $user->model_no=$input['model_no'];
        $user->total_seat=$input['total_seat'];
        $user->seat_number=$seat_number;
        $user->admin_id=Auth::user()->id;

        if($request->file('bus_photo')) {

            $profile_image = $request->file('bus_photo');
            $upload = 'uploads/bus';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = time() . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $input['bus_photo'] = $profile_image_name;
            $user->bus_photo=$input['bus_photo'];
        }

        $user->save();

        return redirect()->route('bus.index')
            ->with('success','Bus created successfully');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::find($id);


        return view('users.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bus = Bus::find($id);
        return view('bus.edit',compact('bus'));
        
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

        $user = Location::find($id);


        $user->name=$input['name'];
        $user->description=$input['description'];
        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;


        if($request->file('location_photo')) {
            if($user->location_photo!=""){
                $upload_file="uploads/location/".$user->location_photo;
                unlink($upload_file);
            }
            $profile_image = $request->file('location_photo');
            $upload = 'uploads/location';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = time() . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $input['location_photo'] = $profile_image_name;
            $user->location_photo=$input['location_photo'];
        }

        $user->save();



       




        return redirect()->route('location.index')
            ->with('success','location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Bus::find($id);

        if($user->delete()){
            if($user->bus_photo!=""){
                $upload_file="uploads/bus/".$user->bus_photo;
                if(file_exists($upload_file))
                unlink($upload_file);
            }
        }
        return redirect()->route('bus.index')
            ->with('success','Bus deleted successfully');
    }
}
