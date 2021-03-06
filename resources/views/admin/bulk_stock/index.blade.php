@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Bulk Stock</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.bulk-stock.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th width="15%">L/C Number</th>
                                    <th width="15%">Supplier Name</th>
                                    <th width="16%">Phone</th>
                                    <th width="16%">Company Name</th>
                                    <th width="13%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bulk_stocks->count())
                                    @foreach ($bulk_stocks as $key => $bulk_stock)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $bulk_stock->lc_number }}</td>
                                        <td>{{ $bulk_stock->supplier->name }}</td>
                                        <td>{{ $bulk_stock->supplier->phone }}</td>
                                        <td>{{ $bulk_stock->supplier->company_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.bulk-stock.show', $bulk_stock->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.bulk-stock.edit', $bulk_stock->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.bulk-stock.destroy', $bulk_stock->id),
                                                'id' => $bulk_stock->id
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