<?php

namespace App\Http\Controllers\api;

use App\Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoragesController extends Controller
{
    public function index(){
        $storages = Storage::all();
        return response()->json($storages);
    }

    public function store(Request $request)
    {
//        if(Auth::user()->admin){
//            return response()->json(['success' => false]);
//        }
//        $validator = Validator::make($request->all(),[
//            'name' => 'required',
//    ]);
//        if($validator->fails()){
//            return response()->json(['success' => !$validator->errors()], 401);
//        }

        $storage = new Storage();
        $storage->name = $request->name;
        $storage->address = $request->address;
        $storage->save();

        return response()->json(['success' => true]);
    }

    public function delete($id){
//        if(Auth::user()->admin){
            $storage = Storage::find($id);
            if($storage){
                $storage->delete();
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
        $storage = Storage::findOrFail($id);
        if($storage){
            $storage->name = $request->name;
            $storage->address = $request->address;
            $storage->save();
            return response()->json(['success' => true]);
        } else{
            return response()->json(['success' => false]);
        }
        //        }else{
//            return response()->json(['success' =>false] );
//        }
    }
}
