<?php

namespace App\Http\Controllers\api;

use App\Product;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request){

        //        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }

            $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'code' => 'required',
            'category_id' => 'required',
            'width' => 'required',
            'height' => 'required',
            'depth' => 'required',
            'cell_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

             Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'category_id' => $request->category_id,
            'cell_id' => $request->cell_id,
            'image' => '/uploads/products/1549953923rotveyler_2.jpg'

        ]);

        return response()->json(['success' => true]);
    }

    public function delete($id){
        //        if(Auth::user()->admin){
        $product = Product::findOrFail($id);
        if($product){
            $product->delete();
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
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'code' => 'required',
            'category_id' => 'required',
            'width' => 'required',
            'height' => 'required',
            'depth' => 'required',
            'cell_id' => 'required',
        ]);

        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads/products/',$image_new_name);
        $product->image = '/uploads/products/'.$image_new_name;

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $product->name=$request->name;
        $product->code=$request->code;
        $product->width=$request->width;
        $product->height=$request->height;
        $product->depth=$request->depth;
        $product->category_id=$request->category_id;
        $product->cell_id=$request->cell_id;
        $product->save();

        return response()->json(['success' => true]);

    }
}
