<?php

namespace App\Http\Controllers;

use App\Options;
use Illuminate\Http\Request;
use App\Employee;
use App\User;


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



    }

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
