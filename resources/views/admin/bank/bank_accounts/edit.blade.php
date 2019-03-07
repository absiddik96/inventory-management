@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Edit Bank Account</h5>
        </div>
        <div class="card-body">
            {!! Form::model($bankAccount, ['method'=>'PATCH', 'route'=>['admin.bank-accounts.update', $bankAccount->id]]) !!} 
            
            @include('admin.bank.bank_accounts.field')
            
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
