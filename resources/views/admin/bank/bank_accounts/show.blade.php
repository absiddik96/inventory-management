@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <h5 class="p-2">View Bank Account</h5>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-sm btn-outline-primary"> <i
                            class="fa fa-plus"></i> Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table no-border">
                        <tr>
                            <td width="25%">Bank</td>
                            <td width="1%">:</td>
                            <td width="74%">{{ $bankAccount->bank->name }}</td>
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
                </div>
                <div class="col-md-4">
                    <h3 class="total-amount">Total Amount: <span style="font-size: 25px">৳{{ $bankAccount->totalAmount() }}</span></h3>
                </div>
            </div>
            <div class="float-right">
                @include('includes._confirm_delete',[
                    'action' => route('admin.bank-accounts.destroy', $bankAccount->id),
                    'id' => $bankAccount->id
                ])
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="p-2">Transaction History</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped dataTable" role="grid">
                        <thead>
                            <tr role="row">
                                <th width="7%">SI No.</th>
                                <th width="7%">Bank</th>
                                <th width="6%">Branch</th>
                                <th width="15%">Account Holder</th>
                                <th width="15%">Account Number</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Transaction Type</th>
                                <th width="10%">Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($bankAccount->bankTransactions->count())
                                @foreach ($bankAccount->bankTransactions as $key => $transaction)
                                    <tr role="row" class="odd">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $transaction->bankAccount->bank->name }}</td>
                                        <td>{{ $transaction->bankAccount->branch->name }}</td>
                                        <td>{{ $transaction->bankAccount->account_holder }}</td>
                                        <td>{{ $transaction->bankAccount->account_number }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->transaction_type?'Credit':'Debit' }}</td>
                                        <td>{{ $transaction->transaction_date }}</td>
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
@endsection
