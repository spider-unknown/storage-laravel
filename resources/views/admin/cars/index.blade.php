@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Cars
        </div>
        <div class="card-body">
            <table class=" table table-hover">
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
                                    <span class="fa fa-pencil"></span>
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
