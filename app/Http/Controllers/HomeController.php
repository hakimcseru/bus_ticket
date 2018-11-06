<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Employee;
use App\User;
use App\Book;
use App\BookIssue;
use App\BookReturn;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       /* $data['doctorInfo'] = Doctorinfo::orderBy('id', 'DESC')->get();*/
        //$data['employeeInfo'] = Employee::orderBy('id', 'DESC')->get();
       /* $data['callInfo'] = WorkPlan::where('type','call')->orderBy('id', 'DESC')->get();
        $data['visitInfo'] = WorkPlan::where('type','visit')->orderBy('id', 'DESC')->get();
        $data['lastFiveCallInfo'] = WorkPlan::where('type','call')->orderBy('id', 'DESC')->limit(5)->get();
        $data['lastFiveVisitInfo'] = WorkPlan::where('type','visit')->orderBy('id', 'DESC')->limit(5)->get();*/


        $allbooks=Book::where('type','book')->get();
        $totalbookcopy=[];
        foreach ($allbooks as $key=>$value){
           $single_copy_list = json_decode($value->qr_string);
            $totalbookcopy=array_merge($totalbookcopy,$single_copy_list);
        }

        $alljournals=Book::where('type','journal')->get();
        $totaljournalcopy=[];
        foreach ($alljournals as $key=>$value){
            $single_copy_list1 = json_decode($value->qr_string);
            $totaljournalcopy=array_merge($totaljournalcopy,$single_copy_list1);
        }

        $allseminars=Book::where('type','seminar')->get();
        $totalseminarcopy=[];
        foreach ($allseminars as $key=>$value){
            $single_copy_list2 = json_decode($value->qr_string);
            $totalseminarcopy=array_merge($totalseminarcopy,$single_copy_list2);
        }


        $allbooksIssue=BookIssue::where('is_returned',0)->get();
        $IssuebooksCount=0;
        $IssueJournalCount=0;
        $IssueSeminarCount=0;

        foreach ($allbooksIssue as $key=>$value){
            $findbook=Book::where('id', $value->book_id)->first();
            if($findbook->type=='book'){
                $IssuebooksCount++;
            }elseif ($findbook->type=='journal'){
                $IssueJournalCount++;
            }else{
                $IssueSeminarCount++;
            }
        }

        $today = date('Y-m-d');
        $totalExpireIssue = BookIssue::whereDate('end_date','<',$today)->where('is_returned',0)->get();



        $data['chartinfo']=[
            'booksinfo'=>[
                'totalbookcopy'=>count($totalbookcopy),
                'IssuebooksCount'=>$IssuebooksCount
            ],
            'seminarinfo'=>[
                'totalseminarcopy'=>count($totalseminarcopy),
                'IssueSeminarCount'=>$IssueSeminarCount
            ],
            'journalsinfo'=>[
                'totaljournalcopy'=>count($totaljournalcopy),
                'IssueJournalCount'=>$IssueJournalCount
            ],
            'issueExpireInfo'=>[
                'totalCountIssue'=>count($allbooksIssue),
                'totalCountExpire'=>count($totalExpireIssue)
            ]
        ];







        $search=trim($request->input('search'));
        //$members = User::orderBy('id','DESC')->paginate(5);

        if(isset($search) & !empty($search)){

        /*    $data['members']=User::where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%')->orWhere('contact_number','like','%'.$search.'%')->orWhere('address','like','%'.$search.'%')->orderBy('id','DESC')->get();

            $data['books']=Book::where('title','like','%'.$search.'%')->orWhere('abstraction','like','%'.$search.'%')->orderBy('id','DESC')->get();

            $data['total_search_result'] = $data['members']->merge($data['books']);


            $perPage = 10;
            $input = Input::all();
            if (isset($input['page']) && !empty($input['page'])) { $currentPage = $input['page']; } else { $currentPage = 1; }

            $arr = $data['total_search_result']->toArray();
            $offset = ($currentPage * $perPage) - $perPage;
            $arr_splice = array_slice($arr, $offset, $perPage, true);
            $data['paginator_data'] = new Paginator($arr_splice, count($arr), $perPage, $currentPage);*/



            $membersres=User::where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%')->orWhere('contact_number','like','%'.$search.'%')->orWhere('address','like','%'.$search.'%')->orderBy('id','DESC')->get();

            $bookresult=Book::where('title','like','%'.$search.'%')->orWhere('abstraction','like','%'.$search.'%')->orderBy('id','DESC')->get();




            $memberandbook =$membersres->merge($bookresult);


            $collectiteam=collect($memberandbook);

           // $currentPage=\Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();

           // $searchresult=new Paginator($collectiteam, count($collectiteam->toArray()), 5, $currentPage);








            //return view('home',compact('searchresult', 'search'));

            $perPage = 10;
            $input = Input::all();
            if (isset($input['page']) && !empty($input['page'])) { $currentPage = $input['page']; } else { $currentPage = 1; }

            $arr = $collectiteam->toArray();
            $offset = ($currentPage * $perPage) - $perPage;
            $arr_splice = array_slice($arr, $offset, $perPage, true);
            $data['searchresult'] = new Paginator($arr_splice, count($arr), $perPage, $currentPage);
            $data['search'] = $search;

            //return view('home',compact('searchresult', 'search'));
            //return view('home',$data);


        }





        $today = date('Y-m-d');




        $data['return_expired'] = BookIssue::where('is_returned','0')->whereDate('end_date','<',$today)->take(5)->get();


        $data['return_of_week'] = BookReturn::where('created_at', '>=', Carbon::now()->startOfWeek())->take(5)->get();



        

        $user = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('users.id', Auth::user()->id)
                ->first();

        if($user -> role_id == 5 || $user -> role_id == 3)
        {
            
            return view('errors.404');
        }





         return view('home',$data);

       // return view('home',$data)->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
