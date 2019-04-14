@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Update Supplier</h5>
        </div>
        <div class="card-body">
            {!! Form::model($supplier, ['method'=>'put', 'route'=>['admin.suppliers.update', $supplier->id]]) !!} 

            @include('admin.suppliers.fields')
            
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
