@extends('layouts.backend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">{{__('category.edit_category')}}</div>
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
                    <form action="{{ route('category.update',  ['id' => $category->id]) }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label" for="name">{{__('category.name')}}</label>
                            <div class="input-group">
                                <input type="text" id="name" placeholder="{{__('category.placeholder.name')}}" class="form-control" name="name" value={{$category->name}}>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="slug">{{__('category.slug')}}</label>
                            <div class="input-group">
                                <input type="text" id="slug" class="form-control" name="slug" placeholder="{{__('category.placeholder.slug')}}" value={{$category->slug}}>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label" for="feature_image">{{__('category.feature_image')}}</label>
                                <div class="input-group">
                                    <input onchange="readURL(this);" type="file" id="feature_image" class="form-control" name="feature_image" value={{$category->feature_image}}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img id="preview" src="{{$category->feature_image}}" alt="{{$category->feature_image}}" class="d-block"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">{{__('category.description')}}</label>
                            <div class="input-group">
                                <textarea class="form-control" id="description" placeholder="{{__('category.description')}}" name="description">{{$category->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="status">{{__('category.status.name')}}</label>
                            <div class="input-group">
                                <select class="form-control" id="status" name="status">
                                    <option>{{__('category.placeholder.status')}}</option>
                                    @foreach(__('category.status.option') as $key => $value)
                                        <option value="{{$key}}" {{ $key === $category->status ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if(isset($categories))
                        <div class="form-group">
                            <label class="control-label" for="parent">{{__('category.parent_id')}}</label>
                            <div class="input-group">
                                <select class="form-control" id="parent" name="parent_id">
                                    <option value="">{{__('category.placeholder.parent_id')}}</option>
                                    @foreach($categories as $item)
                                        <option value="{{$item->id}}" {{ $item->id === $category->parent_id ? 'selected' : '' }}>
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
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
