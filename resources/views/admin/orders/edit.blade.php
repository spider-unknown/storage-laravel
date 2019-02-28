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
@section("scripts")
    <script>
        function hideAll(){
            $('#cellDiv').hide();
            $('#carDiv').hide();
            $('#productDiv').hide();
        }

        hideAll();

        $(document).ready(function(){
            $('#storage').on('change', function(){
                if(this.value){
                    $.ajax(
                        {
                            url: '/api/cells/by/storage/' + this.value,
                            type: 'GET',
                            success: function(res) {
                                $('#cell').empty();
                                if(res.length > 0){
                                    $('#cellDiv').show();
                                    var option = document.createElement("option");
                                    option.value =
                                    $('#cell').append(option);
                                    for(var i = 0 ; i < res.length; i++){
                                        var option = document.createElement("option");
                                        option.value = res[i].id;
                                        option.innerText = res[i].name;
                                        $('#cell').append(option);
                                    }
                                }else{
                                    toastr.warning('Attention!' ,'There is no cells in this storage!');
                                }
                            },
                            error : function(error){
                                toastr.error('Error!', 'Information not fetched!');
                                hideAll();
                            }
                        }
                    );
                    $.ajax(
                        {
                            url: '/api/cars/by/storage/' + this.value,
                            type: 'GET',
                            success: function(res) {
                                $('#car').empty();
                                if(res.length > 0){
                                    $('#carDiv').show();
                                    var option = document.createElement("option");
                                    $('#car').append(option);
                                    for(var i = 0 ; i < res.length; i++){
                                        var option = document.createElement("option");
                                        option.value = res[i].id;
                                        option.innerText = res[i].model;
                                        $('#car').append(option);
                                    }
                                }else{
                                    toastr.warning('Attention!' ,'There is no cars in this storage!');
                                }
                            },
                            error : function(error){
                                toastr.error('Error!', 'Information not fetched!');
                                hideAll();
                            }
                        }
                    )

                }
            });

            $('#cell').on('change', function () {
                if (this.value) {
                    $.ajax({
                        url: '/api/products/by/cell/' + this.value,
                        type: 'GET',
                        success: function (res) {
                            $('#product').empty();
                            if (res.length > 0) {
                                $('#productDiv').show();
                                var checkbox = document.createElement("checkbox");
                                $('#product').append(checkbox);
                                for (var i = 0; i < res.length; i++) {
                                    var checkbox = document.createElement("checkbox");
                                    checkbox.value = res[i].id;
                                    checkbox.innerText = res[i].name;
                                    $('#product').append(checkbox);
                                }
                            }
                            else {
                                toastr.warning('Attention!', 'There is no products in this cells!');
                            }
                        },
                        error: function (error) {
                            toastr.error('Error!', 'Info not fetched');
                            hide.all()
                        }
                    })
                }
            });
        });

    </script>
@endsection