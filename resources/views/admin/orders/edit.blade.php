@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Update cell
        </div>
        <div class="card-body">
            <form action="{{ route('order.update', ['id' => $order->id]) }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name='location' class="form-control" value="{{$order->location}}">
                </div>
                <div class="form-group">
                    <label for="car">Select a car</label>
                    <select id="car" name="car_id" class="form-control">
                        @foreach($cars as $car)
                            @if( $car->id == $order->car_id )
                                <option selected value="{{$car->id}}">{{$car->model}}</option>
                            @else
                                <option value="{{$car->id}}">{{$car->model}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <label for="types" >Select product</label>
                    @foreach($products as $product)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="products[]" class="form-check-input" value="{{$product->id}}"
                                       @foreach($order->products as $innerType)
                                       @if($innerType->id == $product->id)
                                       checked
                                        @endif
                                        @endforeach
                                >
                                {{$product->name}}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="wayLong">Way Long</label>
                    <input type="number" name='way_long' class="form-control" value="{{$order->way_long}}">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Update order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection