@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>All Bank Account</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th width="15%">Bank</th>
                                    <th width="15%">Branch</th>
                                    <th width="17%">Account Holder</th>
                                    <th width="15%">Account Number</th>
                                    <th width="16%">Status</th>
                                    <th width="13%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bankAccounts->count())
                                    @foreach ($bankAccounts as $key => $bankAccount)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $bankAccount->bank->name }}</td>
                                        <td>{{ $bankAccount->branch->name }}</td>
                                        <td>{{ $bankAccount->account_holder }}</td>
                                        <td>{{ $bankAccount->account_number }}</td>
                                        <td>{{ $bankAccount->status ? 'Active' : 'Deactive' }} | 
                                            <a class="badge {{ $bankAccount->status ? 'badge-danger' : 'badge-success' }}" href="{{ route('admin.bank-accounts.active', $bankAccount->id) }}">{{ !$bankAccount->status ? 'Active' : 'Deactive' }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bank-accounts.show', $bankAccount->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.bank-accounts.edit', $bankAccount->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.bank-accounts.destroy', $bankAccount->id),
                                                'id' => $bankAccount->id
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
