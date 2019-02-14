<?php

namespace App\Http\Controllers\Api;

use App\Storage;
use App\Cell;
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

        $cell = Cell::has('products')->where('id', $id)->with('products')->first();
        if($cell && $cell->products()){
            $products = $cell->products()->get();
        }
        return response()->json($products);
    }


    public function getCarByStorageId($id){
        $cars = array();

        $storage = Storage::has('cars')->where('id', $id)->with('cars')->first();
        if($storage && $storage->cars()){
            $cars = $storage->cars()->get();
        }
        return response()->json($cars);
    }
}
