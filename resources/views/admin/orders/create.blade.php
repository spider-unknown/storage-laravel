@extends('layouts.app')

@section('content')
    @include('admin.includes.errors')
    <div class="card card-default">
        <div class="card-header">
            Create new order
        </div>
        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name='location' class="form-control">
                </div>
                <div class="form-group">
                    <label for="storage">Select a storage</label>
                    <select id="storage" name="storage_id" class="form-control">
                        <option></option>
                        @foreach($storages as $storage)
                            <option value="{{$storage->id}}">{{$storage->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="cellDiv">
                    <label for="cell">Select a cell</label>
                    <select id="cell" name="cell_id" class="form-control">

                    </select>
                </div>
                <div class="form-group" id="carDiv">
                    <label for="car">Select a car</label>
                    <select id="car" name="car_id" class="form-control">
                    </select>
                </div>

                <div class="form-check" id="productDiv">
                    <label for="products">Select products</label>
                    <div class="checkbox" id="productsCheckBox">

                    </div>
                </div>


                <div class="form-group">
                    <label for="width">Way Long</label>
                    <input type="number" name='way_long' class="form-control" id="wayLong">
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
@section("scripts")
    <script>
        function hideAll() {
            $('#cellDiv').hide();
            $('#carDiv').hide();
            $('#productDiv').hide();
        }

        hideAll();

        $(document).ready(function () {
            $('#storage').on('change', function () {
                if (this.value) {
                    $.ajax(
                        {
                            url: '/api/cells/by/storage/' + this.value,
                            type: 'GET',
                            success: function (res) {
                                $('#cell').empty();
                                if (res.length > 0) {
                                    $('#cellDiv').show();
                                    var option = document.createElement("option");
                                    $('#cell').append(option);
                                    for (var i = 0; i < res.length; i++) {
                                        var option = document.createElement("option");
                                        option.value = res[i].id;
                                        option.innerText = res[i].name;
                                        $('#cell').append(option);
                                    }
                                } else {
                                    toastr.warning('Attention!', 'There is no cells in this storage!');
                                }
                            },
                            error: function (error) {
                                toastr.error('Error!', 'Information not fetched!');
                                hideAll();
                            }
                        }
                    );
                    $.ajax(
                        {
                            url: '/api/cars/by/storage/' + this.value,
                            type: 'GET',
                            success: function (res) {
                                $('#car').empty();
                                if (res.length > 0) {
                                    $('#carDiv').show();
                                    var option = document.createElement("option");
                                    $('#car').append(option);
                                    for (var i = 0; i < res.length; i++) {
                                        var option = document.createElement("option");
                                        option.value = res[i].id;
                                        option.innerText = res[i].model;
                                        $('#car').append(option);
                                    }
                                } else {
                                    toastr.warning('Attention!', 'There is no cars in this storage!');
                                }
                            },
                            error: function (error) {
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
                            $('#productDiv').empty();
                            if (res.products.length > 0) {
                                $('#productDiv').show();
                                var title = "Select Products";
                                $('#productDiv').append(title);
                                for (var i = 0; i < res.products.length; i++) {
                                    var div = document.createElement("div");
                                    div.className = "checkbox";
                                    $('#productDiv').append(div);
                                    var checkbox = document.createElement('input');
                                    checkbox.name = "products[]";
                                    checkbox.id = "checkss";
                                    checkbox.type = "checkbox";
                                    checkbox.value = res.products[i].id;
                                    var text = res.products[i].name;
                                    $('#productDiv').append(checkbox);
                                    $('#productDiv').append(text);

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

            $('#checkss').change (function () {
                if ($(this).is(':checked')) {
                    console.log($(this).val() + ' is now checked');
                } else {
                    console.log($(this).val() + ' is now unchecked');
                }
            });
        });
    </script>
@endsection
