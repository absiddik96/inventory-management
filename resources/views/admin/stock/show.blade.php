@extends('layouts.app')
@section('content')
<stock-show :stock="{{ $stock }}" :packet_sizes="{{ $packet_sizes }}"></stock-show>
@endsection