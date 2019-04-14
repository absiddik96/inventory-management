@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Create Supplier</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>'admin.suppliers.store']) !!} 
            @csrf

            @include('admin.suppliers.fields')
            
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
