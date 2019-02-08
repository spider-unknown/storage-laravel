@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card card-default">
        <div class="card-header">
            Create new cell
        </div>
        <div class="card-body">
            <form action="{{ route('cell.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="form-group">
                    <label for="storage">Select a storage</label>
                    <select id="storage" name="storage_id" class="form-control">
                        @foreach($storages as $storage)
                            <option value="{{$storage->id}}">{{$storage->name}}</option>
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
                <div class="form-check">
                    <label for="types" >Select categories</label>
                    @foreach($categories as $category)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="categories[]" class="form-check-input" value="{{$category->id}}">
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Store cell
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
