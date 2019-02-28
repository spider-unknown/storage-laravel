@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Update cell
        </div>
        <div class="card-body">
            <form action="{{ route('cell.update', ['id' => $cell->id]) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name='name' class="form-control" value="{{$cell->name}}">
                </div>
                <div class="form-group">
                    <label for="category">Select a storage</label>
                    <select id="storage" name="storage_id" class="form-control">
                        @foreach($storages as $storage)
                            @if( $storage->id == $cell->storage_id )
                                <option selected value="{{$storage->id}}">{{$storage->name}}</option>
                            @else
                                <option value="{{$storage->id}}">{{$storage->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <label for="types" >Select categories</label>
                    @foreach($categories as $category)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="categories[]" class="form-check-input" value="{{$category->id}}"
                                       @foreach($cell->categories as $innerType)
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
                            Update cell
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection