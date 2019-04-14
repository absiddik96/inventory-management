@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Create Dealer</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.dealers.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>'admin.dealers.store']) !!} 
            @csrf

            @include('admin.dealers.fields')
            
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
