@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Types
            <a href="{{ route('type.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus fa-lg"></span>
            </a>
        </div>
        <div class="card-body">
            <table class=" table table-hover">
                <thead>
                <th>Type name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($types->count()>0)
                    @foreach($types as $type)
                        <tr>
                            <td>
                                {{$type->name}}
                            </td>
                            <td>
                            <a href="{{route('type.edit' , ['id' => $type->id]) }}" class="btn btn-xs btn-info">
                            <span class="fa fa-pencil"></span>
                            </a>
                            </td>
                            <td>
                            <a href="{{route('type.delete', ['id' => $type->id])}}" class="btn btn-xs btn-danger">
                            <span class="fa fa-trash"></span>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No types yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
