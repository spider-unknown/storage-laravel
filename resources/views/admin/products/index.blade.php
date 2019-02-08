@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Products
        </div>
        <div class="card-body">
            <table class=" table table-hover">
                <thead>
                <th>Image</th>
                <th>Product name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($products->count()>0)
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
                            <span class="fa fa-pencil"></span>
                            </a>
                            </td>
                            <td>
                            <a href="{{route('product.delete', ['id' => $product->id])}}" class="btn btn-xs btn-danger">
                            <span class="fa fa-trash"></span>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No products yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
