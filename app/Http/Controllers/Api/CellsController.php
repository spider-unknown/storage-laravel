<?php

namespace App\Http\Controllers\api;

use App\Cell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class CellsController extends Controller
{
    public function index(){
        $cells = Cell::all();
        return response()->json($cells);
    }

    public function store(Request $request){
        //        if(!Auth::user()->admin){
//            return response()->json(['success' =>false] );
//        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'storage_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $request->categories = $this->strToArray($request->categories);


        $cell = Cell::create([
            'name' => $request->name,
            'storage_id' => $request->storage_id,
        ]);
        $cell->categories()->attach($request->categories);
        return response()->json(['success' => true]);

    }

    private function strToArray($str){
        $str = substr($str, 1, strlen($str) - 2);
        return explode(",", $str);
    }

    public function delete($id){
        //        if(Auth::user()->admin){
        $cell = Cell::findOrFail($id);
        if($cell){
            $cell->delete();
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
        $cell = Cell::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'storage_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>!$validator->errors()], 401);
        }

        $request->categories = $this->strToArray($request->categories);

        $cell->name = $request->name;
        $cell->storage_id = $request->storage_id;
        $cell->categories()->sync($request->categories);
        $cell->save();
        return response()->json(['success' => true]);


        //        }else{
//            return response()->json(['success' =>false] );
//        }
    }
}
