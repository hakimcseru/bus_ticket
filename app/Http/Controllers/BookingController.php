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
use App\Booking;
use App\Assign;
use App\Bus;
use Illuminate\Support\Facades\Auth;


class BookingController  extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search=trim($request->input('search'));
        $bookings= Booking::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $bookings=Booking::where('route_name','like','%'.$search.'%')
                          ->orWhere('pickup_location','like','%'.$search.'%')
                          ->orWhere('drop_location','like','%'.$search.'%')
                          ->orderBy('id','DESC')->paginate(5);
        }

        return view('booking.index',compact('bookings'))->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $route_ides = Assign::pluck('route_name','id');

        return view('booking.create',compact('route_ides'));


        
    }



/*    public function mychangecopyAjax($id)
    {

        $bookinfo=DB::table("books")->where('id', $id)->first();

        $bookscopy = json_decode($bookinfo->qr_string);

        $bookIssueCopyNumer = BookIssue::where('is_returned',0)->where('book_id',$id)->get();

        if(count($bookIssueCopyNumer)>0){
            foreach ($bookIssueCopyNumer as $singlekey){
                unset( $bookscopy[array_search( $singlekey->copy_number, $bookscopy )] );
            }
        }

        $data['bookscopy'] = $bookscopy;



       /* $data['cities'] = DB::table("book_issue")
            ->where("book_issue_code",$id)
            ->first();*/
       // $bookinfo=DB::table("books")->where('id', $id)->first();

       // $data['bookscopy'] = json_decode($bookinfo->qr_string);




      //  return json_encode($data['bookscopy']);
   // }*/


    public function chancestopes($id)
    {
        $assign=Assign::where('id',$id)->first();
        $route=Route::where('id',$assign->route_id)->first();
        $stoppes_points=$route->stoppage_points;
        $stoppes_points=json_decode($stoppes_points);

        return json_encode($stoppes_points);
    } 

    public function bookingseat($id)
    {
        $assign=Assign::where('id',$id)->first();
        $bus=Bus::where('registration_no',$assign->fleet_registration_no)->first();

        $bus_info=[];
        $bus_info['bus_info']= $bus;
        $bus_info['seat_number']=json_decode($bus->seat_number);
       

        return json_encode($bus_info);
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

      
         $stoped_point=explode(',', $input['stoppage_points']);
         $stoped_points=json_encode($stoped_point);

         
       

      


        $user = new Route();
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
            ->with('success','Route created successfully');
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
