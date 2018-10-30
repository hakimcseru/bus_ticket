<?php

namespace App\Http\Controllers;

use App\Options;
use Illuminate\Http\Request;
use App\Employee;
use App\User;

use App\BookIssue;
use App\Location;
use App\Route;
use App\Booking;
use App\Assign;
use App\Bus;
use App\Price;


use App\Category;
use App\Book;





class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $start_point=trim($request->input('start_point'));
        $end_point=trim($request->input('end_point'));
        $start_date=trim($request->input('start_date'));
        $return_date=trim($request->input('return_date'));


        //dd($start_point);
       // exit();


       $data['locations']= Location::pluck('name','name');
       $data['start_date_resarve']=null;

       $data['availablebus']=Assign::where('start_point_name',$start_point)
        ->where('end_point_name',$end_point)
        ->where('start_date', '<=', $start_date)
        ->where('end_date', '>=', $start_date)
        ->get();

     /*   $data['availablebus']=Assign::where('start_date', '<=', $start_date)
        ->where('end_date', '>=', $start_date)
        ->get();*/

        //KhachHang::all()->whereBetween('CreateDate', [$start, $end])->get();where('CreateDate', '>=', $start)



      /*
        $data['books']= Book::where('type', 'book')->orderBy('created_at','DESC')->limit(20)->get();


        $data['topBooks']= Book::where('type', 'book')->orderBy('issue_count','DESC')->limit(20)->get();
        $data['topJournals']= Book::where('type', 'journal')->orderBy('issue_count','DESC')->limit(20)->get();

        $data['seminars']= Book::where('type', 'seminar')->orderBy('created_at','DESC')->limit(20)->get();


        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();*/







        if(count($data['availablebus'])>0){
             $data['start_date_resarve']=$start_date;
             return view('frontend.result',$data)->with('i', ($request->input('page', 1) - 1) * 10);
        }else{

            return view('frontend.app',$data);
        }

        //return view('book.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 5);




        //$data['books'] = Book::orderBy('id', 'DESC')->get();



    }


    public function bookingfrontfunction($id){
        $assign=Assign::where('id',$id)->first();
        $bus=Bus::where('registration_no',$assign->fleet_registration_no)->first();

        $route=Route::where('id',$assign->route_id)->first();
       
        $stoppes_pointss=json_decode($route->stoppage_points);



        $price=Price::where('route_id',$assign->route_id)->first();

        $bus_info=[];
        $bus_info['bus_info']= $bus;
        $bus_info['assign']= $assign;
        $bus_info['seat_number']=json_decode($bus->seat_number);
        $bus_info['route_info']=$route;
        $bus_info['price_info']=$price;
        $bus_info['stoppes_pointes']=$stoppes_pointss;
       

        return json_encode($bus_info);
    }


    public function bookingdatafunction(Request $request){
              
            $order_seat=explode(',', $request->order_seat);
            $order_seats=json_encode($order_seat);

              $bookinginfo=[];
              $bookinginfo['hidden_selected_assign']= $request->hidden_selected_assign;
              $bookinginfo['grand_total_price']= $request->grand_total_price;
              $bookinginfo['order_seat']= $request->order_seat;
              $bookinginfo['drop_location']= $request->drop_location;
              $bookinginfo['pickup_location']= $request->pickup_location;
              $bookinginfo['start_date_resarve']= $request->start_date_resarve;
              $bookinginfo['total_seat_reserve']= $request->total_seat_reserve;


               
             
                $user = new Booking();
                $user->assign_id=$request->hidden_selected_assign;
                $user->route_id=Assign::find($request->hidden_selected_assign)->route_id;
                $user->route_name=Assign::find($request->hidden_selected_assign)->route_name;
                $user->booking_date=$request->start_date_resarve;
                $user->total_seat=$request->total_seat_reserve;
                $user->user_id=1;
                $user->seat_number=$order_seats;
                $user->price=$request->grand_total_price;
                $user->pickup_location=$request->pickup_location;
                $user->drop_location=$request->drop_location;
                $user->discount=1;
                $user->admin_id=1;
                $user->save();


             /*    $user = new Booking();
                $user->assign_id=1;
                $user->route_id=1;
                $user->route_name=1;
                $user->booking_date='2018-10-01';
                $user->total_seat=1;
                $user->user_id=1;
                $user->seat_number=1;
                $user->price=1;
                $user->pickup_location=1;
                $user->drop_location=1;
                $user->admin_id=1;
                $user->discount=1;
                $user->save();
               */



               

               /* return redirect()->route('route.index')
                ->with('success','Route created successfully');*/


              return json_encode($bookinginfo);
    }


/*     public function indexxx(Request $request)
    {



        $search=trim($request->input('search'));
        $data['books']= Book::where('type', 'book')->orderBy('created_at','DESC')->limit(20)->get();


        $data['topBooks']= Book::where('type', 'book')->orderBy('issue_count','DESC')->limit(20)->get();
        $data['topJournals']= Book::where('type', 'journal')->orderBy('issue_count','DESC')->limit(20)->get();

        $data['seminars']= Book::where('type', 'seminar')->orderBy('created_at','DESC')->limit(20)->get();


        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();







        if(isset($search) && !empty($search)){
            $data['books'] = Book::where('title','like','%'.$search.'%')->orWhere('author','like','%'.$search.'%')->orderBy('id','DESC')->paginate(20);
            return view('frontend.search',$data)->with('i', ($request->input('page', 1) - 1) * 10);
        }else{
            return view('frontend.welcome',$data);
        }

        //return view('book.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 5);




        //$data['books'] = Book::orderBy('id', 'DESC')->get();



    }*/

    public function newBooks(Request $request)
    {

        $data['books']= Book::where('type', 'book')->orderBy('created_at','DESC')->paginate(8);

        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();

        //$data['employeeInfo'] = Employee::orderBy('id', 'DESC')->get();

        //return view('book.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 10);
        return view('frontend.newbooks',$data)->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function topBooks(Request $request)
    {



        $data['topBooks']= Book::where('type', 'book')->orderBy('issue_count','DESC')->paginate(8);
       // $data['employeeInfo'] = Employee::orderBy('id', 'DESC')->get();

        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();


        return view('frontend.topbooks',$data)->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function topJournals(Request $request)
    {

        $data['topJournals']= Book::where('type', 'journal')->orderBy('issue_count','DESC')->paginate(8);
       // $data['employeeInfo'] = Employee::orderBy('id', 'DESC')->get();

        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();


        return view('frontend.topjournals',$data)->with('i', ($request->input('page', 1) - 1) * 10);
    }


    public function topSeminars(Request $request){
        $data['topSeminars']=Book::where('type', 'seminar')->orderBy('issue_count','DESC')->paginate(8);
        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();


        return view('frontend.topseminars',$data)->with('i', ($request->input('page', 1) - 1) * 10);
    }



    public function contact()
    {


        $data['employeeInfo'] = Employee::orderBy('id', 'DESC')->get();

        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.contact',$data);
    }

    public function single($id){
       // $employee = Employee::find($id);
        $data['book'] = Book::find($id);
        $data['banners']= Options::where('name', 'banner')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.single',$data);
    }




}
