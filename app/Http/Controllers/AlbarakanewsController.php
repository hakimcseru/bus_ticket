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
use App\Albarakanews;
use Illuminate\Support\Facades\Auth;


class AlbarakanewsController  extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //dd("jjjj");
        //exit();

        $search=trim($request->input('search'));
        $abnews= Albarakanews::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $routes=Albarakanews::where('title','like','%'.$search.'%')
                          ->orWhere('description','like','%'.$search.'%')
                          ->orderBy('id','DESC')->paginate(5);
        }

        return view('albarakanews.index',compact('abnews'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $locations = Location::pluck('name','id');

        return view('albarakanews.create');


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



// dd($request);
// exit();

        $this->validate($request, [
            'title' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();

      
         // $stoped_point=explode(',', $input['stoppage_points']);
         // $stoped_points=json_encode($stoped_point);

         
       

      


        $user               = new Albarakanews();
        $user->admin_id     = Auth::user()->id;
        $user->title        = $input['title'];
        $user->description  = $input['description'];
        $user->status       = $input['status'];
        $user->save();

        return redirect()->route('albarakanews.index')
            ->with('success','News created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abnews = Route::find($id);


        return view('albarakanews.show',compact('abnews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



       // $locations = Location::pluck('name','id');

       
        $abnews = Albarakanews::find($id);
        return view('albarakanews.edit',compact('abnews'));
        
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
           'title' => 'required',
           'status' => 'required'
        ]);

        $input = $request->all();


        

        $user = Albarakanews::find($id);

        $user->admin_id=Auth::user()->id;
        $user->title=$input['title'];
        $user->description=$input['description'];
        $user->status=$input['status'];
        
        $user->save();



       




        return redirect()->route('albarakanews.index')
            ->with('success','News updated successfully');
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

