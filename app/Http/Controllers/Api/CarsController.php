<?php

namespace App\Http\Controllers\api;

use App\Car;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarsController extends Controller
{
    public function index(){
        $cars = Car::all();
        return response()->json($cars);
    }

    public function store(Request $request){

//        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }

        $validator = Validator::make($request->all(),[
            'model' => 'required',
            'status' => 'required',
            'storage_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $request->categories = $this->strToArray($request->categories);


        $car = Car::create([
            'model' => $request->model,
            'status' => $request->status,
            'storage_id' => $request->storage_id,
            ]);
        $car->categories()->attach($request->categories);
        return response()->json(['success' => true]);

    }

    private function strToArray($str){
        $str = substr($str, 1, strlen($str) - 2);
        return explode(",", $str);
    }

    public function delete($id){
        //        if(Auth::user()->admin){
        $car = Car::findOrFail($id);
        if($car){
            $car->delete();
            return response()->json(['success' =>true]);
        }else{
            return response()->json(['success' =>false] );
        }
//        }else{
//            return response()->json(['success' =>false] );
//        }
    }

    public function update($id, Request $request){
        //        if(Auth::user()->admin){
        $car = Car::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'model' => 'required',
            'status' => 'required',
            'storage_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $request->categories = $this->strToArray($request->categories);

        $car->model = $request->model;
        $car->status = $request->status;
        $car->storage_id = $request->storage_id;
        $car->categories()->sync($request->categories);
        $car->save();
        return response()->json(['success' => true]);


        //        }else{
//            return response()->json(['success' =>false] );
//        }
    }
}
