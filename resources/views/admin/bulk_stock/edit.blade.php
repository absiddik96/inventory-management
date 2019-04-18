@extends('layouts.app')
@section('content')
<bulk-stock-edit :suppliers="{{ $suppliers }}" 
                    :categories="{{ $categories }}" 
                    :bulk_stock="{{ $bulk_stock }}"
                    :banks="{{ $banks }}"
                    :branchs="{{ $branchs }}">
</bulk-stock-edit>
@endsection