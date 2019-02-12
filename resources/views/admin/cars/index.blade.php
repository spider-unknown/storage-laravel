@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Cars
            <a href="{{ route('car.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus fa"></span>
            </a>


        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Model</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($cars->count()>0)
                    @foreach($cars as $car)
                        <tr>
                            <td>
                                {{$car->model}}
                            </td>
                            <td>
                                {{$car->status}}
                            </td>
                            <td>
                                <a href="{{route('car.edit' , ['id' => $car->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fa fa-pen"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('car.delete', ['id' => $car->id])}}" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No cars yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
