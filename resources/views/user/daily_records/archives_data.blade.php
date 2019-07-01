@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card border-secondary">
        <div class="card-header text-center">
            <h2>Masud Seed Company</h2>
            <h5>{{ $date }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6" style="max-width: 49%">
                    <h5 class="text-center">Credit</h5>
                    <hr>
                    <table class="table table-borderless">
                        <tr class="pre_amount">
                            <th width="49%">Previous Amount</th>
                            <td width="1%">:</td>
                            <td>৳{{ $previous_amount[0]->previous_amount }}</td>
                        </tr>
                        @if($credits->count())
                            @foreach ($credits as $credit)
                                <tr>
                                    <th width="49%">{{ $credit->purpose }}</th>
                                    <td width="1%">:</td>
                                    <td>{{ $credit->amount }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <div style="border-left: 1px solid gray;"></div>
                <div class="col-md-6">
                    <h5 class="text-center">Debit</h5>
                    <hr>
                    <table class="table table-borderless">
                        @if($debits->count())
                            @foreach ($debits as $debit)
                                <tr>
                                    <th width="49%">{{ $debit->purpose }}</th>
                                    <td width="1%">:</td>
                                    <td>{{ $debit->amount }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>Total: {{ $credits->sum('amount') - $debits->sum('amount') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection