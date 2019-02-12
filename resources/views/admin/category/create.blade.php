@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card card-default">
        <div class="card-header">
            Create new category
        </div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Price</label>
                    <input type="text" name='price' class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Store category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
