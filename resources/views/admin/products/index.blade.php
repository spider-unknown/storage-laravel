@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Products
            <a href="{{ route('product.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Image</th>
                <th>Product name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <img class="img-fluid" src="{{ $product->image }}" alt="{{$product->name}}" width="50px" height="50px">
                            </td>
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                            <a href="{{route('product.edit' , ['id' => $product->id]) }}" class="btn btn-xs btn-info">
                            <span class="fa fa-pen"></span>
                            </a>
                            </td>
                            <td>
                            <a href="{{route('product.delete', ['id' => $product->id])}}" class="btn btn-xs btn-danger">
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
@section('scripts')
    <script>
    $(document).ready(function(){
        $('#dataTable').DataTable();
    });
    </script>
@endsection
