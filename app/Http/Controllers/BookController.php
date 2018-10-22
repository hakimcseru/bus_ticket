<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request){

        $search = trim($request->input('search'));

        $items = Book::orderBy('id','DESC')->paginate(10);


        if(isset($search)){
            $items=Book::where('title','like','%'.$search.'%')->orWhere('abstraction','like','%'.$search.'%')->orderBy('id','DESC')->paginate(10);
        }
        return view('book.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 10);

    }

    public function create(){

        $category = Category::pluck('name','id');

        return view('book.create',compact('category'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',

        ]);
        $data = $request->all();


        $copy = $data['copy'];
        if(!isset($copy)){
            $copy = 1;
        }


        for ($x = 0; $x < $copy; $x++) {
            $y = $x+1;
            $qr[] = 'c-'.$y.'-'.time();
        }




        $data['qr_string_unique'] = time();
        $data['qr_string'] = json_encode($qr);
        $data['admin_id'] = Auth::user()->id;
        $data['category'] = json_encode($data['category']);
        if(isset($data['taggles'])){
            $data['taggles'] = json_encode($data['taggles']);
        }


        if($request->file('cover_photo')) {
            $cover_photo = $request->file('cover_photo');
            $upload = 'uploads/books';

            $extension = $cover_photo->getClientOriginalExtension();
            $cover_photo_name = md5(time()) . "." . $extension;
            $success = $cover_photo->move($upload, $cover_photo_name);

            $data['cover_photo'] = $cover_photo_name;

        }

        if($request->file('e_book')) {
            $e_book = $request->file('e_book');
            $upload = 'uploads/books';

            $extension = $e_book->getClientOriginalExtension();
            $e_book_name = time() . "." . $extension;
            $success = $e_book->move($upload, $e_book_name);

            $data['file'] = $e_book_name;

        }



        $RetData = Book::create($data);

        $returnData = [];

        if( $data['type'] == 'book'){
            $message = 'Book created successfully!';
        }

        if( $data['type'] == 'journal'){
            $message = 'Journal created successfully!';
        }

        if( $data['type'] == 'seminar'){
            $message = 'Seminar created successfully!';
        }

        $returnData =[
            'message'=> $message,
            'Qr_DD_PRINT'=>$RetData->qr_string,
        ];


        return redirect()->route('book.index')->with('success',$returnData);
    }


    public function show($id){

        $data['item'] = Book::find($id);

        return view('book.show',$data);
    }

    public function edit($id)
    {
        $data['category'] = Category::pluck('name','id');
        $data['book']  = Book::find($id);



        if($data['book']->type == 'book'){
            return view('book.edit',$data);
        }
        if($data['book']->type == 'journal'){
            return view('book.journal_edit',$data);
        }
        if($data['book']->type == 'seminar'){
            return view('book.seminar_edit',$data);
        }


    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',

        ]);

        $data = $request->all();

        $data['admin_id'] = Auth::user()->id;
        $data['category'] = json_encode($data['category']);

        $book = Book::find($id);

        if($request->file('cover_photo')) {
            if($book->cover_photo!=""){
                $upload_file="uploads/books/".$book->cover_photo;
                //unlink($upload_file);
            }
            $profile_image = $request->file('cover_photo');
            $upload = 'uploads/books';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = md5(time()) . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $data['cover_photo'] = $profile_image_name;

        }

        if($request->file('e_book')) {
            if($book->e_book!=""){
                $upload_file="uploads/books/".$book->e_book;
                //unlink($upload_file);
            }
            $profile_image = $request->file('e_book');
            $upload = 'uploads/books';

            $extension = $profile_image->getClientOriginalExtension();
            $profile_image_name = time() . "." . $extension;
            $success = $profile_image->move($upload, $profile_image_name);

            $data['file'] = $profile_image_name;

        }


        $book->update($data);

        return redirect()->route('book.index')->with('update_success','updated successfully');
    }


    public function destroy($id)
    {
        $book=Book::find($id);


        if($book->delete()){

            if($book->cover_photo!=""){
                $upload_file="uploads/books/".$book->cover_photo;
                unlink($upload_file);
            }
            if($book->file!=""){
                $upload_file="uploads/books/".$book->file;
                unlink($upload_file);
            }

        }

        return redirect()->route('book.index')->with('success','Book deleted successfully');
    }





}
