@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')


    <div class="card card-default">
        <div class="card-header">
            Create new order
        </div>
        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name='location' class="form-control">
                </div>
                <div class="form-group">
                    <label for="car">Select a car</label>
                    <select id="car" name="car_id" class="form-control">
                        @foreach($cars as $car)
                            <option value="{{$car->id}}">{{$car->model}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check">
                    <label for="products" >Select products</label>
                    @foreach($products as $product)
                        <div class="checkbox">
                            <label class="form-check-label">
                                <input type="checkbox" name="products[]" class="form-check-input" value="{{$product->id}}">
                                {{$product->name}}
                            </label>
                        </div>
                    @endforeach
                </div>


                <div class="form-group">
                    <label for="width">Way Long</label>
                    <input type="number" name='way_long' class="form-control">
                </div>

                {{--<div class="form-group">--}}
                {{--<label for="featured">Featured image</label>--}}
                {{--<input type="file" name='featured' class="form-control">--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                {{--<label for="content">Content</label>--}}
                {{--<textarea name='content' id='content' cols='5' rows='5' class="form-control-file"></textarea>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success btn-block" type='submit'>
                            Make order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection