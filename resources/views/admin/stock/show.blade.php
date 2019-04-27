@extends('layouts.app')
@section('content')
<bulk-stock-show :stock="{{ $stock }}" :packet_sizes="{{ $packet_sizes }}"></bulk-stock-show>
@endsection