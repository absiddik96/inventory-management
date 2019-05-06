@extends('layouts.app')
@section('content')
    <sell-product-edit 
        :categories="{{ $categories }}" 
        :sell_product="{{ $sell_product }}"
        :banks="{{ $banks }}"
        :branchs="{{ $branchs }}">
    </sell-product-edit>
@endsection