@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">Thêm sản phẩm</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('product.store')}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name"></label>
                            <input type="text" id="name" placeholder="Tên sản phẩm" class="form-control" name="name" value={{old('name')}}>
                        </div>
                        <div class="form-group">
                            <label for="image"></label>
                            <input type="file" id="image" class="form-control" name="image" value={{old('file')}}>
                        </div>
                        <div class="form-group">
                            <label for="description"></label>
                            <textarea class="form-control" id="description" placeholder="Miêu tả" name="description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity"></label>
                            <input type="number" id="quantity" class="form-control" name="quantity" value={{old('quantity')}}>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Xác nhận</button>
                            <button class="btn btn-primary">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
