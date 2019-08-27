@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="btn btn-success float-right" href="{{route('supplier.create')}}">
                <i class="fa fa-plus-circle"></i>
            </a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('supplier.company')}}</th>
                        <th>{{__('supplier.short_name')}}</th>
                        <th>{{__('supplier.address')}}</th>
                        <th>{{__('supplier.created_at')}}</th>
                        <th>{{__('supplier.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $key => $supplier)
                    <tr>
                        <td>{{ $suppliers->firstItem() + $key }}</td>
                        <td>{{$supplier->company_name}}</td>
                        <td>{{$supplier->short_name}}</td>
                        <td>{{$supplier->address}}</td>
                        <td>{{$supplier->created_at}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('supplier.edit', $supplier->id)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{route('supplier.destroy', $supplier->id)}}" method="post" class="btn-delete">
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
        {{ $suppliers->links() }}
    </div>
</div>
@endsection
