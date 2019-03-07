@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <h5 class="p-2">View Bank Account</h5>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table no-border">
                <tr>
                    <td width="15%">Bank</td>
                    <td width="1%">:</td>
                    <td width="84">{{ $bankAccount->bank->name }}</td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td>:</td>
                    <td>{{ $bankAccount->branch->name }}</td>
                </tr>
                <tr>
                    <td>Account Holder</td>
                    <td>:</td>
                    <td>{{ $bankAccount->account_holder }}</td>
                </tr>
                <tr>
                    <td>Account Number</td>
                    <td>:</td>
                    <td>{{ $bankAccount->account_number }}</td>
                </tr>
                <tr>
                    <td>Details</td>
                    <td>:</td>
                    <td class="text-justify">{{ $bankAccount->details }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ $bankAccount->status ? 'Active' : 'Deactive' }}</td>
                </tr>
            </table>
            <div class="float-right">
                @include('includes._confirm_delete',[
                    'action' => route('admin.bank-accounts.destroy', $bankAccount->id),
                    'id' => $bankAccount->id
                ])
            </div>
        </div>
    </div>
</div>
@endsection
