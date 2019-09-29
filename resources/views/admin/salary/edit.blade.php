@extends('layouts.app') 
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Update Salary</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.salaries.index') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($salary, ['method'=>'put', 'route'=>['admin.salaries.update', $salary->id]]) !!}
                @include('admin.salary._form',['buttonValue' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection