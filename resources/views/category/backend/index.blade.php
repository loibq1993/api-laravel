@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-success float-right" href="{{route('category.create')}}">
                <i class="fa fa-plus-circle"></i>
            </a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $key }}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('category.edit', $category->id)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{route('category.destroy', $category->id)}}" method="post" class="btn-delete">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" >
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
