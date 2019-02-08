<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Category;
use App\Storage;
use App\Type;
use Session;

use Illuminate\Http\Request;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cells.index')->with('cells',Cell::all());
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

        if($categories->count() == 0 || $type->count() == 0){
            Session::flash('info' , 'You must have some categories or types');
            return redirect()->back();
        }

        return view('admin.cells.create')
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
           'name' => 'required',
            'storage_id' => 'required',
        ]);

        $cell = Cell::create([
            'name' => $request->name,
            'storage_id' => $request->storage_id,
            ]);

        $cell->types() ->attach($request->types);
        $cell->categories() ->attach($request->categories);
        Session::flash('success','Successfully added');
        return redirect()->route('cells.index');
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
        $cell = Cell::findOrFail($id);

        return view('admin.cells.edit')
            ->with([
                'cell' => $cell,
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
        $cell = Cell::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|max:255',
            'storage_id' => 'required',
            ]);

        $cell->name=$request->name;
        $cell->storage_id=$request->storage_id;
        $cell->types()->sync($request->types);
        $cell->categories()->sync($request->categories);
        $cell->save();

        Session::flash('success','Updated cell');
        return redirect()->route('cells.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cell::destroy($id);
        Session::flash('success','You successfully delete cell!');
        return redirect()->route('cells.index');
    }
}
