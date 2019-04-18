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
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bulk-stock.index') }}"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-12 ml-md-2">
                        <div class="form-group">
                                <label for="supplier">L/C Number : </label> {{ $bulk_stock->lc_number }}
                                
                        </div>
                        <div class="form-group">
                            <label for="supplier">Supplier : </label> {{ $bulk_stock->supplier->name }}
                            
                        </div>
                        <div class="form-group">
                            <label for="date">Date :  </label> {{ $bulk_stock->date }}
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <td width="10%">Serial No</td>
                                    <td width="25%">Product Name</td>
                                    <td width="20%">Category</td>
                                    <td width="15%">Quantity (Kg)</td>
                                    <td width="15%">Unit Price / Kg (৳)</td>
                                    <td width="15%">Total (৳)</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bulk_stock->purchaseItems as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->category->name }}</td>
                                    <td>
                                        {{ $item->quantity }}
                                    </td>
                                    <td>
                                        {{ $item->unit_price }}
                                    </td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-6 text-md-right pt-2">Grand Total : </label>
                            <div class="col-md-6">
                                <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->grand_total }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-6 text-md-right pt-2">Amount Pay : </label>
                            <div class="col-md-6">
                                <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->amount_pay }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-6 text-md-right pt-2">Amount Due : </label>
                            <div class="col-md-6">
                                <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->amount_due }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-6 text-md-right pt-2">Is Verified : </label>
                            <div class="col-md-6 pt-1">
                                <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->is_verified?'Verified':'Unverified' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-6 text-md-right pt-2">Payment Type : </label>
                            <div class="col-md-6">
                                <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->payment_type?'Bank':'Cash' }}">
                            </div>
                        </div>
                        @if($bulk_stock->transaction)
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-6 text-md-right pt-2">Bank : </label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->transaction->bankAccount->bank->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-6 text-md-right pt-2">Branch : </label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->transaction->bankAccount->branch->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-6 text-md-right pt-2">A/C Number : </label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="bg-white form-control" value="{{ $bulk_stock->transaction->bankAccount->account_number }}">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection