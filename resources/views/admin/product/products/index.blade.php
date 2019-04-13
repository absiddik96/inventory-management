@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>All Product</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if ($products->count())
                                    @foreach ($products as $key => $product)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ status($product->status) }}</td>
                                        <td>
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.products.destroy', $product->id),
                                                'id' => $product->id
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