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

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        //$members = User::orderBy('id','DESC')->paginate(5);

         $members = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'agent');
         })->paginate(5);
       


        if(isset($search)){

            //$members=User::where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%')->orWhere('contact_number','like','%'.$search.'%')->orWhere('address','like','%'.$search.'%')->orderBy('id','DESC')->paginate(5);
       
            $members=User::whereHas('roles', function ($query) {
              $query->where('name', '!=', 'agent');
            })->where('name','like','%'.$search.'%')->orderBy('id','DESC')->paginate(5);

        }

        return view('users.index',compact('members'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $roles = Role::pluck('display_name','id');


        return view('users.create',compact('roles'));
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        print_r($input);


        $user = new User();
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->password=Hash::make($input['password']);
        $user->contact_number=$input['contact_number'];
        $user->address=$input['address'];


        if($request->file('avatar')) {
            $profile_image = $request->file('avatar');
            $upload = 'uploads/profile';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = time() . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $input['avatar'] = $profile_image_name;
            $user->avatar=$input['avatar'];
        }






        if($user->save()) {
            foreach ($request->input('roles') as $key => $value) {
                $user->attachRole($value);
            }

        }

        return redirect()->route('users.index')
            ->with('success','User created successfully');
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

        $member = User::find($id);

        $roles = Role::pluck('display_name','id');
        $userRole = $member->roles->pluck('id','id')->toArray();

        return view('users.edit',compact('member','roles','userRole'));
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
