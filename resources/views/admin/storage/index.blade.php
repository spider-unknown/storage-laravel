@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Storages
            <a href="{{ route('storage.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Name</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
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
                                    <span class="fa fa-pen"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('storage.delete', ['id' => $storage->id])}}" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
