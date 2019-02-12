<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Product;
use App\Type;
use App\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\URL;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index')->with('products', Product::all());
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

        if($categories->count() == 0 || $type->count() == 0){
            Session::flash('info' , 'You must have some categories or types');
            return redirect()->back();
        }

        return view('admin.products.create')
            ->with('categories',$categories)
            ->with('types' , Type::all())
            ->with('cells', Cell::all());
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
            'name' => 'required|max:255',
            'code' => 'required',
            'category_id' => 'required',
            'types' =>'required',
            'image' => 'required|image',
            'width' => 'required',
            'height' => 'required',
            'depth' => 'required',
            'cell_id' => 'required',
        ]);

        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads/products/',$image_new_name);

        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'category_id' => $request->category_id,
            'cell_id' => $request->cell_id,
            'image' => 'uploads/products/' . $image_new_name

        ]);

        $product->types() ->attach($request->types);

        Session::flash('success','Product created successfully!');
        return redirect()->route('products.index');
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
        $categories = Category::all();

        $product = null;
        if(URL::previous() == route('products.trashed')){
            $product = Product::withTrashed()->where('id' , $id)->first();
        }else{
            $product = Product::findOrFail($id);
        }

        return view('admin.products.edit')
            ->with([
                'product' => $product,
                'categories' => $categories,
                'types' => Type::all(),
                'cells' => Cell::all(),
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
        $product = Product::withTrashed()->where('id',$id)->first();

        $this->validate($request,[
            'name' => 'required|max:255',
            'code' => 'required',
            'category_id' => 'required',
            'cell_id' => 'required',
            'types' =>'required',
            'image' => 'required|image',
            'width' => 'required',
            'height' => 'required',
            'depth' => 'required',

        ]);

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads/products/',$image_new_name);
            $product->image = '/uploads/products/'.$image_new_name;
        }

        $product->name=$request->name;
        $product->code=$request->code;
        $product->width=$request->width;
        $product->height=$request->height;
        $product->depth=$request->depth;
        $product->category_id=$request->category_id;
        $product->cell_id=$request->cell_id;
        $product->types()->sync($request->types);
        $product->save();

        Session::flash('success', 'You successfully updated post');

        if(!$product->deleted_at){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.trashed');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::find($id);
        $product->delete();
        Session::flash('success','You successfully delete product!');
        return redirect()->route('products.index');
    }

    public function kill($id){

        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
        Session::flash('success', 'You successfully deleted permanently!');
        return redirect()->back();
    }

    public function trashed(){

        $product = Product::onlyTrashed()->get();
        return view('admin.products.trashed')->with('products',$product);
    }

    public function restore($id){

        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();
        Session::flash('success', 'You successfully restored product');
        return redirect()->route('products.index');
    }
}
