<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Storage;
use App\Cell;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getCellByStorageId($id){
        $cells = array();

        $storage = Storage::has('cells')->where('id', $id)->with('cells')->first();
        if($storage && $storage->cells()){
            $cells = $storage->cells()->get();
        }
        return response()->json($cells);
    }

    public function getProductByCellId($id){
        $products = array();
        $category = array();
//        $categories = array();

        $cell = Cell::has('products')->where('id', $id)->with('products')->first();
        if($cell && $cell->products()){
            $products = $cell->products()->get();
            $category = $cell->categories()->get();
        }
//        if($cell && $cell->products()->category()){
//            $categories = $cell->products()->category()->get();
//
//        }

        return response()->json(array("products" => $products, "category" => $category));
    }


    public function getCarByStorageId($id){
        $cars = array();

        $storage = Storage::has('cars')->where('id', $id)->with('cars')->first();
        if($storage && $storage->cars()){
            $cars = $storage->cars()->get();
        }
        return response()->json($cars);
    }

    public function index(){
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request){
        //        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }

        $validator = Validator::make($request->all(), [
            'car_id' => 'required',
            'location' => 'required',
            'way_long' => 'required',
        ]);

        $request->products = $this->strToArray($request->products);

        $order = Order::create([
            'location' => $request->location,
            'way_long' => $request->way_long,
            'car_id' => $request->car_id,

        ]);

        $order->products()->attach($request->products);
        return response()->json(['success' => true]);

    }

    private function strToArray($str){
        $str = substr($str, 1, strlen($str) - 2);
        return explode(",", $str);
    }

    public function delete($id){
        //        if(Auth::user()->admin){
        $order = Order::findOrFail($id);
        if($order){
            $order->delete();
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
        $order = Order::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'car_id' => 'required',
            'location' => 'required',
            'way_long' => 'required',
        ]);

        $request->products = $this->strToArray($request->products);

        $order->location = $request->location;
        $order->way_long = $request->way_long;
        $order->car_id = $request->car_id;
        $order->products()->sync($request->products);
        $order->save();
        return response()->json(['success' => true]);


    }
}
