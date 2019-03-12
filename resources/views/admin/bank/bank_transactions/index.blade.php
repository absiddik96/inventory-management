@extends('layouts.app')
@section('content')
    <bank-transaction :transactions-data="{{ $transactions }}"></bank-transaction>
@endsection
