@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Sell Product</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('user.sell-products.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table no-border">
                        <tr>
                            <th width="100px">Invoice No</th>
                            <td width="1px">:</td>
                            <td class="text-uppercase">{{ $sell_product->invoice_no }}</td>
                        </tr>
                        <tr>
                            <th>Dealer</th>
                            <td>:</td>
                            <td>{{ $sell_product->dealer->name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td>{{ $sell_product->date }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no-border">
                        <tr>
                            <th width="100px">Memo No</th>
                            <td width="1px">:</td>
                            <td>{{ $sell_product->memo_no }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <td width="5%">Serial No</td>
                                <td width="15%">Product Name</td>
                                <td width="15%">Packet Size (gm)</td>
                                <td width="15%">Packet Quantity</td>
                                <td width="15%">Quantity (Kg)</td>
                                <td width="15%">Unit Price / Kg (৳)</td>
                                <td width="10%">Total (৳)</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sell_product->sellProductItems->count())
                                @foreach ($sell_product->sellProductItems as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->packetSize->packet_size }}</td>
                                        <td>{{ $item->packet_quantity }}</td>
                                        <td>{{ $item->sub_quantity }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table no-border">
                        <tr>
                            <th width="120px">Grand Total</th>
                            <td width="1px">:</td>
                            <td>৳ {{ $sell_product->grand_total }}</td>
                        </tr>
                        <tr>
                            <th>Amount Due</th>
                            <td>:</td>
                            <td>৳ {{ $sell_product->amount_due }}</td>
                        </tr>
                        <tr>
                            <th>Total Due</th>
                            <td>:</td>
                            <td>৳ {{ ($dealer_previous_due->total_amount - $dealer_previous_due->total_amount_pay) }}</td>
                        </tr>
                        <tr>
                            <th>Amount Pay</th>
                            <td>:</td>
                            <td>৳ {{ $sell_product->amount_pay }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
