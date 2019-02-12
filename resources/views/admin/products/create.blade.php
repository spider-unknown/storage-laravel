@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Create new product
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="form-group">
                    <label for="featured">Featured image</label>
                    <input type="file" name='image' class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select id="category" name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">Select a cell</label>
                    <select id="category" name="cell_id" class="form-control">
                        @foreach($cells as $cell)
                            <option value="{{$cell->id}}">{{$cell->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check">
                    <label for="types" >Select types</label>
                    @foreach($types as $type)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="types[]" class="form-check-input" value="{{$type->id}}">
                                {{$type->name}}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" name='code' class="form-control">
                </div>

                <div class="form-group">
                    <label for="width">Width</label>
                    <input type="number" name='width' class="form-control">
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="number" name='height' class="form-control">
                </div>

                <div class="form-group">
                    <label for="depth">Depth</label>
                    <input type="number" name='depth' class="form-control">
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
                            Store product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#content').summernote();
        });
    </script>
@endsection