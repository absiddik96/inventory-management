@extends('layouts.app')
@section('content')
<bulk-stock-add :suppliers="{{ $suppliers }}" :categories="{{ $categories }}"></bulk-stock-add>
@endsection