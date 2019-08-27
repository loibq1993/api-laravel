@extends('layouts.backend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">{{__('supplier.create_new_supplier')}}</div>
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
                    <form action="{{route('supplier.store')}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="company_name">{{__('supplier.company')}}</label>
                            <div class="input-group">
                                <input type="text" id="company_name" placeholder="{{__('supplier.placeholder.company')}}" class="form-control" name="company_name" value="{{old('company_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_name">{{__('supplier.short_name')}}</label>
                            <div class="input-group">
                                <input type="text" id="short_name" class="form-control" name="short_name" placeholder="{{__('supplier.placeholder.short_name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label" for="logo">{{__('supplier.logo')}}</label>
                                <div class="input-group">
                                    <input onchange="readURL(this);" type="file" id="logo" class="form-control" name="logo" value="{{old('logo')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img id="preview" src="#" alt="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address">{{__('supplier.address')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="address" placeholder="{{__('supplier.placeholder.address')}}" name="address" value="{{old('address')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone">{{__('supplier.phone')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="phone" placeholder="{{__('supplier.placeholder.phone')}}" name="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="fax">{{__('supplier.fax')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="fax" placeholder="{{__('supplier.placeholder.fax')}}" name="fax" value="{{old('fax')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="website">{{__('supplier.website')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="addrwebsiteess" placeholder="{{__('supplier.placeholder.website')}}" name="website" value="{{old('website')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">{{__('supplier.submit')}}</button>
                            <button class="btn btn-primary">{{__('supplier.cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
