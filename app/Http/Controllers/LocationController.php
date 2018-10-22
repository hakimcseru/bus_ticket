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
use Illuminate\Support\Facades\Auth;


class LocationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        $locations= Location::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $locations=Location::where('name','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->orderBy('id','DESC')->paginate(5);
        }

        return view('location.index',compact('locations'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
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
            'name' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();

      


        $user = new Location();
        $user->name=$input['name'];
        $user->description=$input['description'];
        $user->status=$input['status'];
        $user->admin_id=Auth::user()->id;
        if($request->file('location_photo')) {
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
            ->with('success','Location created successfully');
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

        $location = Location::find($id);
        return view('location.edit',compact('location'));
        
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::find($id);


        $user->name=$input['name'];
        $user->email=$input['email'];
        if(!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
        }
        $user->contact_number=$input['contact_number'];
        $user->address=$input['address'];



        if($request->file('avatar')) {
            if($user->avatar!=""){
                $upload_file="uploads/profile/".$user->avatar;
                //unlink($upload_file);
            }
            $profile_image = $request->file('avatar');
            $upload = 'uploads/profile';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = time() . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $input['avatar'] = $profile_image_name;
            $user->avatar=$input['avatar'];
        }

        $user->save();



        DB::table('role_user')->where('user_id',$id)->delete();

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }




        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);

        if($user->delete()){
            //$user_other_info=User::where('id',$user->id)->first();
            if($user->avatar!=""){
                $upload_file="uploads/profile/".$user->avatar;
                unlink($upload_file);
            }
           // $user_check_info=Employee::find($user_other_info->id);
           // $user->delete();
        }
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
