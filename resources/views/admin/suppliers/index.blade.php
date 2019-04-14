@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>All Suppliers</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th width="9%">SI No.</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Phone No</th>
                                    <th width="16%">Status</th>
                                    <th width="13%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($suppliers->count())
                                    @foreach ($suppliers as $key => $supplier)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ status($supplier->status) }} | 
                                            <a class="badge {{ $supplier->status ? 'badge-danger' : 'badge-success' }}" href="{{ route('admin.suppliers.change_status', $supplier->id) }}">{{ status(!$supplier->status) }}</a>
                                        </td>
                                        <td>
                                            @include('admin.suppliers.show')
                                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.suppliers.destroy', $supplier->id),
                                                'id' => $supplier->id
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
