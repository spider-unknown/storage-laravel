<?php

namespace App\Http\Controllers\api;

use App\Category;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request){

        //        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->price = $request->price;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function delete($id){
        //        if(Auth::user()->admin){
        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
            return response()->json(['success' =>true]);
        }else{
            return response()->json(['success' =>false] );
        }
//        }else{
//            return response()->json(['success' =>false] );
//        }
    }

    public function update($id, Request $request){

        //        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $category->name = $request->name;
        $category->price = $request->price;
        $category->save();
        return response()->json(['success' => true]);
    }

}
