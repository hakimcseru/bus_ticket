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
