@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Categories
            <a href="{{ route('category.create') }}" class="btn btn-xs btn-success" style="float:right">
                <span class="fa fa-plus"></span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>Category name</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @if($categories->count()>0)
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                {{$category->price}}
                            </td>
                            <td>
                                <a href="{{route('category.edit' , ['id' => $category->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fa fa-pen"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('category.delete', ['id' => $category->id])}}" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3">No categories yet!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
