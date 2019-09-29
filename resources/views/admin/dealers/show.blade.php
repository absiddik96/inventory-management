@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Dealer Details</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.dealers.index') }}" class="btn btn-sm btn-outline-primary"> <i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table no-border">
                <tr>
                    <td width="160px">Name</td>
                    <td width="1px">:</td>
                    <td>{{ $dealer->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $dealer->email }}</td>
                </tr>
                <tr>
                    <td>Dealer Code</td>
                    <td>:</td>
                    <td>{{ $dealer->dealer_code }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td>{{ $dealer->phone }}</td>
                </tr>
                <tr>
                    <td>Shop Name</td>
                    <td>:</td>
                    <td>{{ $dealer->shop_name }}</td>
                </tr>
                <tr>
                    <td>NID</td>
                    <td>:</td>
                    <td>{{ $dealer->nid }}</td>
                </tr>
                <tr>
                    <td>Trade License</td>
                    <td>:</td>
                    <td>{{ $dealer->trad_license }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td class="text-justify">{{ $dealer->address }}</td>
                </tr>
                <tr>
                    <td>Previous Due</td>
                    <td>:</td>
                    <td class="text-justify text-danger">
                        <h3>
                            ৳{{ $dealer_due->total_amount_due }} 
                            <small>
                                <a href="{{ route('admin.dealers.previous-due', $dealer->id) }}" class="ml-5 btn btn-sm btn-outline-primary">Add Previous Due</a>
                            </small>
                        </h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Purchase History</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.dealers.laser',$dealer->id) }}" class="btn btn-sm btn-outline-primary"> <i
                            class="fa fa-download"></i> This Year Laser</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered dataTable">
                <thead>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Total Amount</th>
                    <th>Payment Amount</th>
                    <th>Due Amount</th>
                </thead>
                <tbody>
                    @if ($purchase_history->count())
                        @foreach ($purchase_history as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-uppercase">
                                    <a href="{{ route('user.sell-products.show', $item->id) }}">{{ $item->invoice_no }}</a>
                                </td>
                                <td>{{ $item->grand_total }}</td>
                                <td>{{ $item->amount_pay }}</td>
                                <td>{{ $item->amount_due }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




{{-- <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#dealer-{{ $dealer->id }}">
<i class="fa fa-eye"></i>
</button>
<div class="modal fade" id="dealer-{{ $dealer->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Dealer Info - {{ $dealer->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div> --}}
