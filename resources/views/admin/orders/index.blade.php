@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Orders
            <a href="{{ route('order.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Location</th>
                <th>Way Long</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$order->location}}
                        </td>
                        <td>
                            {{$order->way_long}}
                        </td>
                        <td>
                            {{--<a href="{{route('order.edit' , ['id' => $order->id]) }}" class="btn btn-xs btn-info">--}}
                                {{--<span class="fa fa-pen"></span>--}}
                            {{--</a>--}}
                        </td>
                        <td>
                            {{--<a href="{{route('order.delete', ['id' => $order->id])}}" class="btn btn-xs btn-danger">--}}
                                {{--<span class="fa fa-trash"></span>--}}
                            {{--</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });
    </script>
@endsection
