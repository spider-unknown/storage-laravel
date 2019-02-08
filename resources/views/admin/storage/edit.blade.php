@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card card-default">
        <div class="card-header">
            Update storage {{$storage->name}}
        </div>
        <div class="card-body">
            <form action="{{ route('storage.update', ['id' => $storage->id]) }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' value="{{$storage->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Address</label>
                    <input type="text" name='address' value="{{$storage->address}}" class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Update storage
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
