@extends('layouts.app')
@section('content')
    <stock-add :categories="{{ $categories }}" :packet_sizes="{{ $packet_sizes }}"></stock-add>
@endsection