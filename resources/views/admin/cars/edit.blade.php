@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Update car
        </div>
        <div class="card-body">
            <form action="{{ route('car.update', ['id' => $car->id]) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Model</label>
                    <input type="text" name='model' class="form-control" value="{{$car->model}}">
                </div>
                <div class="form-group">
                    <label for="title">Status</label>
                    <input type="text" name='status' class="form-control" value="{{$car->status}}">
                </div>
                <div class="form-group">
                    <label for="category">Select a storage</label>
                    <select id="storage" name="storage_id" class="form-control">
                        @foreach($storages as $storage)
                            @if( $storage->id == $car->storage_id )
                                <option selected value="{{$storage->id}}">{{$storage->name}}</option>
                            @else
                                <option value="{{$storage->id}}">{{$storage->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <label for="types" >Select types</label>
                    @foreach($types as $type)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="types[]" class="form-check-input" value="{{$type->id}}"
                                       @foreach($car->types as $innerType)
                                       @if($innerType->id == $type->id)
                                       checked
                                        @endif
                                        @endforeach
                                >
                                {{$type->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-check">
                    <label for="types" >Select categories</label>
                    @foreach($categories as $category)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="categories[]" class="form-check-input" value="{{$category->id}}"
                                       @foreach($car->categories as $innerType)
                                       @if($innerType->id == $category->id)
                                       checked
                                        @endif
                                        @endforeach
                                >
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Update car
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