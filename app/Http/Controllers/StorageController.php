<?php

namespace App\Http\Controllers;

use App\Storage;
use Illuminate\Http\Request;
use Session;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.storage.index')->with('storages',Storage::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.storage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required',
            'address' => 'required',
        ]);

        $storage = new Storage;
        $storage->name = $request->name;
        $storage->address = $request->address;
        $storage->save();
        Session::flash('success' , 'You successfully created storage!');
        return redirect()->route('storage.index');
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
        return view('admin.storage.edit')->with('storage', Storage::findOrFail($id));
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
        //        if(Auth::user()->admin){
        $storage = Storage::findOrFail($id);
        $storage->name = $request->name;
        $storage->address = $request->address;
        $storage->save();
        Session::flash('success','You successfully updated!');
//        }
//        else{
//            Session::flash('error','You do not have enough permission!');
//        }
        return redirect()->route('storage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::destroy($id);
        return redirect()->route('storage.index');

    }
}
