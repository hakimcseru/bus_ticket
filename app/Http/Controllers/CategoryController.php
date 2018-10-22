<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{


    public function index(Request $request){

        $search=trim($request->input('search'));
        $items = Category::orderBy('id','DESC')->paginate(5);

        if(isset($search)){
            $items=Category::where('name','like','%'.$search.'%')->orWhere('details','like','%'.$search.'%')->orderBy('id','DESC')->paginate(10);
        }

        return view('category.index',compact('items'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required'

        ]);

        $data = $request->all();

        Category::create($data);

        return redirect()->route('category.index')->with('success','Category created successfully');
    }


    public function show($id){

        $data['item'] = Category::find($id);

        return view('category.show',$data);
    }

    public function edit($id)
    {

        $data['item']  = Category::find($id);

        return view('category.edit',$data);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required'

        ]);

        $data = $request->all();

        Category::find($id)->update($data);

        return redirect()->route('category.index')->with('success','Category updated successfully');
    }


    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('category.index')->with('success','Category deleted successfully');
    }





}
