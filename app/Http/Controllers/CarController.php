<?php

namespace App\Http\Controllers;

use App\Car;
use App\Storage;
use App\Category;
use App\Type;
use Session;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cars.index')->with('cars',Car::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $type = Type::all();
        $storage = Storage::all();

        if($categories->count() == 0 || $type->count() == 0 || $storage->count() == 0){
            Session::flash('info' , 'You must have some categories,types or cars');
            return redirect()->back();
        }

        return view('admin.cars.create')
            ->with('categories',$categories)
            ->with('types' , $type)
            ->with('storages',$storage);
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
            'status' => 'required',
            'model' => 'required',
            'storage_id' => 'required',
        ]);

        $car = Car::create([
            'status' => $request->status,
            'model' => $request->model,
            'storage_id' => $request->storage_id,
        ]);

        $car->types() ->attach($request->types);
        $car->categories() ->attach($request->categories);
        Session::flash('success','Successfully added');
        return redirect()->route('cars.index');

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
        $car = Car::findOrFail($id);

        return view('admin.cars.edit')
            ->with([
                'car' => $car,
                'categories' => Category::all(),
                'types' => Type::all(),
                'storages' => Storage::all(),
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
        $car = Car::findOrFail($id);
        $this->validate($request,[
            'status' => 'required',
            'model' => 'required',
            'storage_id' => 'required',
        ]);

        $car->status=$request->status;
        $car->model=$request->model;
        $car->storage_id=$request->storage_id;
        $car->types()->sync($request->types);
        $car->categories()->sync($request->categories);
        $car->save();

        Session::flash('success','Updated car');
        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::destroy($id);
        Session::flash('success','You successfully delete car!');
        return redirect()->route('cars.index');
    }
}
