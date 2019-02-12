@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card card-default">
        <div class="card-header">
            Update type {{$type->name}}
        </div>
        <div class="card-body">
            <form action="{{ route('type.update', ['id' => $type->id]) }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' value="{{$type->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Price</label>
                    <input type="text" name='price' value="{{$type->price}}" class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Update type
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
