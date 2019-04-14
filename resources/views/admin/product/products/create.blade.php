@extends('layouts.app')
@section('content')
<div class="col-md-12">
  <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Create Product</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="post">
                @csrf
                @include('admin.product.products._form',['buttonValue'=>'Submit'])
            </form>
        </div>
    </div>
</div>
@endsection