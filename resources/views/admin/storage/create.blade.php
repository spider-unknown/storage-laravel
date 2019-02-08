@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card card-default">
        <div class="card-header">
            Create new storage
        </div>
        <div class="card-body">
            <form action="{{ route('storage.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Address</label>
                    <input type="text" name='address' class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Store storage
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
