<?php

namespace App\Http\Controllers;

use App\Car;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orders.index')->with('orders',Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $cars = Car::all();

        if($products->count() == 0 || $cars->count() == 0){
            Session::flash('info' , 'You must have some product and car!');
            return redirect()->back();
        }
        return view('admin.orders.create', compact('products', 'cars'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'car_id' => 'required',
            'location' => 'required',
            'way_long' => 'required',
        ]);

        $order = Order::create([
            'location' => $request->location,
            'way_long' => $request->way_long,
            'car_id' => $request->car_id,

        ]);

        $order->products() ->attach($request->products);

        Session::flash('success','Order created successfully!');
        return redirect()->route('orders.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
