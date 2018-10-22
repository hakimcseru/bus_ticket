<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use App\BookIssue;
use Illuminate\Support\Facades\Auth;
use DB;

class BookIssueController extends Controller
{
    public function index(Request $request){

        $search=trim($request->input('search'));

        $items = BookIssue::where('is_returned',0)->orderBy('id','DESC')->paginate(10);


        return view('book_issue.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create($idd = null){


        //dd($idd);
        //exit();

        if($idd!=null){
            $insertData['selectedbook'] = Book::where('id',$idd)->first();
        }

        $insertData['member'] = User::pluck('name','id');




        //will be return not issue book need query change

        $insertData['book'] = Book::pluck('title','id');






        /*$insertData['book'] = DB::table('books')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('book_issue')
                ->whereRaw('book_issue.book_id = books.id')
                ->whereRaw('book_issue.is_returned = 0');
                //->whereIn('book_issue.copy_number', '!=', 'book.qr_string');
                //->whereRaw("jsonb_exists_any('book_issue.copy_number', '!=', 'book.qr_string')");
        })
        ->pluck('title','id');*/





        //kanan bhai karache


      /*  $allBooks = Book::all();

        $bookIssueInfo = BookIssue::where('is_returned',0)->get();

       if(count($bookIssueInfo)>0){
           $allbookQrCopy = [];
           foreach ($allBooks as $single){
               foreach ($bookIssueInfo as $single_issue){
                   if(in_array($single_issue->copy_number,json_decode($single->qr_string))){
                       $allbookQrCopy[] = [
                           'book_id'=>$single->id,
                           'book_title'=>$single->title
                       ];
                   }
               }
           }
       }else{
           $allbookQrCopy = [];
           foreach ($allBooks as $single){
               $allbookQrCopy[] = [
                   'book_id'=>$single->id,
                   'book_title'=>$single->title
               ];
           }
       }





        $insertData['book']=$allbookQrCopy;



        dd($insertData['book']);
        exit();*/



        //kanan bhai karache


        $allBooks = Book::all();

        $bookIssueInfo = BookIssue::where('is_returned',0)->get();


        $issueCopy = [];
        foreach ($bookIssueInfo as $issueIn){
            $issueCopy[] = $issueIn->copy_number;
        }


        $bookQrCopy = [];
        foreach ($allBooks as $tBook){
            $bookQrCopy[] = [
                'book_id'=>$tBook->id,
                'book_title'=>$tBook->title,
                'copy'=>json_decode($tBook->qr_string)
            ];

        }
        foreach ($bookQrCopy as $hBook){

            foreach ($hBook['copy'] as $lCopy){

                if (!in_array($lCopy, $issueCopy)) {
                    $finalArr[$hBook['book_id']] = [
                        'book_id'=>$hBook['book_id'],
                        'book_title'=>$hBook['book_title'],
                    ];
                }
            }

        }

        $finalArr = array_map("unserialize", array_unique(array_map("serialize", $finalArr)));

        $insertData['book'] = $finalArr;


        /*dd($insertData['book']);
        exit();*/


        return view('book_issue.create',compact('insertData'));
    }


    public function store(Request $request){
       $this->validate($request, [
            'book_id' => 'required',
            'user_id' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        $data = $request->all();




        $admin_id = Auth::user()->id;


        $book_id = $data['book_id'];
        $bookInfo = Book::where('id',$book_id)->first();
        if(count($bookInfo)>0){
            $book_title = $bookInfo->title;
        } else {
            $book_title = 'empty';
        }
        $user_id = $data['user_id'];
        $userInfo = User::where('id',$user_id)->first();
        if(count($userInfo)>0){
            $user_name = $userInfo->name;
        } else {
            $user_name = 'empty';
        }

        //$book_issue_code = $user_name.'_'.$book_title.'_'.md5(time());




        $bookIssues = new BookIssue();
        $bookIssues->book_issue_code = $book_title.'_'.$data['copy_number'].'_'.$user_name;
        $bookIssues->book_id = $data['book_id'];
        $bookIssues->book_title = $book_title;
        $bookIssues->copy_number = $data['copy_number'];
        $bookIssues->user_id = $data['user_id'];
        $bookIssues->user_name = $user_name;
        $bookIssues->admin_id = $admin_id;
        $bookIssues->type = $data['type'];
        $bookIssues->start_date = $data['start_date'];
        $bookIssues->end_date = $data['end_date'];
        $bookIssues->status = 1;
        $bookIssues->is_returned = 0;
        $saved = $bookIssues->save();
        if($saved){

            $bookInfo = Book::where('id',$data['book_id'])->first();
            $finalIssueCount = $bookInfo->issue_count +1;
            $update = Book::where('id',$bookInfo->id)->update(['issue_count'=>$finalIssueCount]);


            return redirect()->route('book_issue.index')->with('success','Book issued successfully');
        }
        return redirect()->route('book_issue.index')->with('error','Something went wrong!!!');




    }

    public function edit($id){
        $data['member'] = User::pluck('name','id');


        $data['book'] = Book::pluck('title','id');

        $data['item']  = BookIssue::find($id);

        return view('book_issue.edit',$data);
    }

    public function update(Request $request, $id){

        $data = $request->all();
        $admin_id = Auth::user()->id;


        $book_id = $data['book_id'];
        $bookInfo = Book::where('id',$book_id)->first();
        if(count($bookInfo)>0){
            $book_title = $bookInfo->title;
        } else {
            $book_title = 'empty';
        }
        $user_id = $data['user_id'];
        $userInfo = User::where('id',$user_id)->first();
        if(count($userInfo)>0){
            $user_name = $userInfo->name;
        } else {
            $user_name = 'empty';
        }
        $data['user_name'] = $user_name;
        $data['book_title'] = $book_title;

        BookIssue::find($id)->update($data);

        return redirect()->route('book_issue.index')->with('success','Re-issue Done!!!');
    }

    //new

    public function expiredIndex(Request $request){

        $today = date('Y-m-d');

        $items = BookIssue::where('is_returned','0')->whereDate('end_date','<',$today)->paginate(10);


        return view('book_issue.expire_index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 10);

    }



    public function mychangecopyAjax($id)
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




        return json_encode($data['bookscopy']);
    }


    public function destroy($id)
    {
        $bookIssue=BookIssue::find($id);

        $bookIssue->delete();

        return redirect()->route('book_issue.index')->with('success','Book issue deleted successfully');
    }

    public function getDataByQrString($qr_string){


        $bookinfo = Book::where('qr_string_unique',$qr_string)->first();


        $bookscopy = json_decode($bookinfo->qr_string);

        $bookIssueCopyNumer = BookIssue::where('is_returned',0)->where('book_id',$bookinfo->id)->get();

        if(count($bookIssueCopyNumer)>0){
            foreach ($bookIssueCopyNumer as $singlekey){
                unset( $bookscopy[array_search( $singlekey->copy_number, $bookscopy )] );
            }
        }

        $data['bookscopy'] = $bookscopy;
        if(count($data['bookscopy'])>0){
            $data['book_title'] = $bookinfo->title;
            $data['book_id'] = $bookinfo->id;
        } else {
            $data['book_title'] = '';
            $data['book_id'] = '';
        }


        return json_encode($data);



    }







}
