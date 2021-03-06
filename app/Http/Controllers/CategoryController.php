<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')->with('categories' , Category::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');

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
            'name' =>'required',
            'price' =>'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->price = $request->price;
        $category->save();
        Session::flash('success' , 'You successfully created category!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')->with('category',$category);
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

        $this->validate($request,[
            'name'=>'required',
            'price' => 'required',
        ]);
//        if(Auth::user()->admin){
            $category = Category::find($id);
            $category->name = $request->name;
            $category->price = $request->price;
            $category->save();
            Session::flash('success','You successfully edited category!');
//        }
//        else{
//            Session::flash('error','You do not have enough permission!');
//        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if(Auth::user()->admin){
            Category::destroy($id);

            Session::flash('success' , 'You successfully deleted category!');
//        }else{
//            Session::flash('error' , 'You do not have enough permisison!');
//        }
        return redirect()->route('category.index');

    }
}
