@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Add Previous Due: ( {{ $dealer->name }} )</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.dealers.show',$dealer->id) }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>['admin.dealers.previous-due.store',$dealer->id]]) !!} 
            @csrf

            <div class="form-group">
                    {!! Form::label('previous_due', 'Previous Due ( ৳ ) *') !!} 
                    {!! Form::text('previous_due', null, ['class' => 'form-control '.($errors->has('previous_due') ? 'is-invalid' : ''), 'placeholder'=>'Enter Previous Due']) !!}
                    @if ($errors->has('previous_due'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('previous_due') }}</strong></span>
                    @endif
                </div>
            
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
