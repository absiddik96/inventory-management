@extends('layouts.app')
@section('content')
<div class="col-md-12">
  <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Product</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table no-border">
                <tr>
                    <td width="60px">Name</td>
                    <td width="1px">:</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>:</td>
                    <td>{{ $product->category->name }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>:</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ status($product->status) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection