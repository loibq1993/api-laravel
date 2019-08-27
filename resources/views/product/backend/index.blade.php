@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Miêu tả</th>
                        <th>Số lượng</th>
                        <th><a href="{{route('product.create')}}" class="btn-primary"><i class="fas fa-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->name}}</td>
                            <td><img src="{{ asset('images').'/'.$product->image }}" alt="{{$product->image}}" height="100" width="100"></td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
