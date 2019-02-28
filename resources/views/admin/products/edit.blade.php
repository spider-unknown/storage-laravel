@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Update product
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control" value="{{$product->name}}">
                </div>
                <div class="form-group">
                    <label for="featured">Featured image</label>
                    <input type="file" name='image' class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select id="category" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            @if( $category->id == $product->category_id )
                                <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cell">Select a cell</label>
                    <select id="cell" name="cell_id" class="form-control">
                        @foreach($cells as $cell)
                            @if( $cell->id == $product->cell_id )
                                <option selected value="{{$cell->id}}">{{$cell->name}}</option>
                            @else
                                <option value="{{$cell->id}}">{{$cell->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" name='code' class="form-control" value="{{$product->code}}">
                </div>

                <div class="form-group">
                    <label for="width">Width</label>
                    <input type="number" name='width' class="form-control" value="{{$product->width}}">
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="number" name='height' class="form-control" value="{{$product->height}}">
                </div>

                <div class="form-group">
                    <label for="depth">Depth</label>
                    <input type="number" name='depth' class="form-control" value="{{$product->depth}}">
                </div>

                {{--<div class="form-group">--}}
                {{--<label for="featured">Featured image</label>--}}
                {{--<input type="file" name='featured' class="form-control">--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                {{--<label for="content">Content</label>--}}
                {{--<textarea name='content' id='content' cols='5' rows='5' class="form-control-file"></textarea>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Update product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection