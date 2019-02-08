@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Products trashed
        </div>
        <div class="card-body">
            <table class=" table table-hover">
                <thead>
                <th>Product name</th>
                <th>Edit</th>
                <th>Restore</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <p>{{ $product->name }}</p>
                            </td>
                            <td>
                                {{--<a href="{{ route('post.edit' , ['id' => $post->id]) }}" class="btn btn-xs btn-info">--}}
                                    {{--<span class="fa fa-pencil"></span>--}}
                                {{--</a>--}}
                            </td>
                            <td>
                                <a href="{{route('product.restore', ['id' => $product->id])}}" class="btn btn-xs btn-success">
                                    <i class="fa fa-check-square" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('product.kill', ['id' => $product->id])}}" class="btn btn-xs btn-danger">
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">No trashed products yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
