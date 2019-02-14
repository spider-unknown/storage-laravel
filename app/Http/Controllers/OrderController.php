<?php

namespace App\Http\Controllers;

use App\Car;
use App\Cell;
use App\Storage;
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
    public function create(Request $request)
    {
        $storages = Storage::all();
        $cells = Cell::all();
        $products = Product::all();
        $cars = Car::all();

        if($products->count() == 0 || $cars->count() == 0){
            Session::flash('info' , 'You must have some product and car!');
            return redirect()->back();
        }
        return view('admin.orders.create', compact('products', 'cars', 'storages','cells'));

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
        $order = Order::findOrFail($id);

        return view('admin.orders.edit')
            ->with([
                'order' => $order,
                'storages' => Storage::all(),
                'cars' => Car::all(),
                'products' => Product::all(),
            ]);

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
        $order = Order::findOrFail($id);
        $this->validate($request,[
            'location' => 'required|max:255',
            'way_long' => 'required',
            'car_id' => 'required',
        ]);

        $order->location = $request->location;
        $order->way_long = $request->way_long;
        $order->car_id = $request->car_id;
        $order->products()->sync($request->products);
        $order->save();
        Session::flash('success', 'You successfully edited your order');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->back();
    }
}
