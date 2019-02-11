@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Cells
            <a href="{{ route('cell.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus fa-lg"></span>
            </a>
        </div>
        <div class="card-body">
            <table class=" table table-hover">
                <thead>
                <th>Cell name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($cells->count()>0)
                    @foreach($cells as $cell)
                        <tr>
                            <td>
                                {{$cell->name}}
                            </td>
                            <td>
                                <a href="{{route('cell.edit' , ['id' => $cell->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fa fa-pencil"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('cell.delete', ['id' => $cell->id])}}" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No cells yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
