@extends('layouts.app')
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Edit Bank Branch</h5>
        </div>
        <div class="card-body">
            {!! Form::model($bankbranch, ['method'=>'post', 'route'=>['admin.bankbranchs.update', $bankbranch->id]]) !!} 
            @csrf @method('PATCH')

            @include('admin.bank.bank_branchs.field')
            
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'form-control btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
