@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Stock</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.stocks.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th>SI No.</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    {{-- <th>Stock Quantity (KG)</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if (count($stocks))
                                    @foreach ($stocks as $key => $stock)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $stock->product_name }}</td>
                                        <td>{{ $stock->category->name }}</td>
                                        {{-- <td>{{ $stock->quantity }}</td> --}}
                                        <td>
                                            <a href="{{ route('admin.stocks.show', $stock->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.stocks.destroy', $stock->id),
                                                'id' => $stock->id
                                            ])
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection