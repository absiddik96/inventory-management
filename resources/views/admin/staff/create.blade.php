@extends('layouts.app') 
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Create Staff</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.staffs.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>'admin.staffs.store']) !!}
                @include('admin.staff._form',['buttonValue' => 'Submit'])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection