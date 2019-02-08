@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Storages
        </div>
        <div class="card-body">
            <table class=" table table-hover">
                <thead>
                <th>Name</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($storages->count()>0)
                    @foreach($storages as $storage)
                        <tr>
                            <td>
                                {{$storage->name}}
                            </td>

                            <td>
                                {{$storage->address}}
                            </td>
                            <td>
                                <a href="{{route('storage.edit' , ['id' => $storage->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fa fa-pencil"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('storage.delete', ['id' => $storage->id])}}" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No storages yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
