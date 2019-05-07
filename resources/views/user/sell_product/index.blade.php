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
                    <a href="{{ route('user.sell-products.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th width="10%">SI No.</th>
                                    <th width="10%">Invoice No</th>
                                    <th width="20%">Dealer Name</th>
                                    <th width="10%">Memo No</th>
                                    <th width="10%">Date</th>
                                    <th width="15%">Download</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if (count($sell_details))
                                    @foreach ($sell_details as $key => $sell_detail)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td class="text-uppercase">{{ $sell_detail->invoice_no }}</td>
                                        <td>{{ $sell_detail->dealer->name }}</td>
                                        <td>{{ $sell_detail->memo_no }}</td>
                                        <td>{{ $sell_detail->date }}</td>
                                        <td>
                                            <a href="{{ route('sell-product.dealer.pdf', $sell_detail->id) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-download"></i> Dealer
                                            </a>
                                            <a href="{{ route('sell-product.own.pdf', $sell_detail->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-download"></i> Own
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('sell-product.dealer.show', $sell_detail->id) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i> Dealer
                                            </a>
                                            <a href="{{ route('user.sell-products.show', $sell_detail->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-eye"></i> Own
                                            </a>
                                            <a href="{{ route('user.sell-products.edit', $sell_detail->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('user.sell-products.destroy', $sell_detail->id),
                                                'id' => $sell_detail->id
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