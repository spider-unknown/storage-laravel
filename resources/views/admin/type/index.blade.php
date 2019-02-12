@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Types
            <a href="{{ route('type.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Type name</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>
                                {{$type->name}}
                            </td>
                            <td>
                                {{$type->price}}
                            </td>
                            <td>
                            <a href="{{route('type.edit' , ['id' => $type->id]) }}" class="btn btn-xs btn-info">
                            <span class="fa fa-pen"></span>
                            </a>
                            </td>
                            <td>
                            <a href="{{route('type.delete', ['id' => $type->id])}}" class="btn btn-xs btn-danger">
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
