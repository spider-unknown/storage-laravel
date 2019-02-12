@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Cells
            <a href="{{ route('cell.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus fa"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Cell name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($cells as $cell)
                        <tr>
                            <td>
                                {{$cell->name}}
                            </td>
                            <td>
                                <a href="{{route('cell.edit' , ['id' => $cell->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fa fa-pen"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('cell.delete', ['id' => $cell->id])}}" class="btn btn-xs btn-danger">
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
