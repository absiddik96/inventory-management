@extends('layouts.app')
@section('content')
<div class="col-md-6">
  <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Update Product Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf @method('put')
                @include('product.category._form',['buttonValue'=>'Update'])
            </form>
        </div>
    </div>
</div>
@endsection