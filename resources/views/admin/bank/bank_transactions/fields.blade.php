<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bank_account', 'Bank Account: ') !!} 
            {!! Form::select('bank_account', $bank_account, isset($bankTransaction) ? $bankTransaction->bank_account_id : '', ['class' => 'form-control '.($errors->has('bank_account') ? 'is-invalid' : ''), 'placeholder' => 'Pick a bank account number...']) !!}
            @if ($errors->has('bank'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('bank_account') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('transaction_type', 'Transaction Type: ') !!} 
            {!! Form::select('transaction_type', ['0'=>'Debit', '1'=>'Credit'], null, ['class' => 'form-control '.($errors->has('transaction_type') ? 'is-invalid' : ''), 'placeholder' => 'Pick a transaction type...']) !!}
            @if ($errors->has('transaction_type'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('transaction_type') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('supervisor', 'Supervisor: ') !!} 
            {!! Form::select('supervisor', $supervisor, isset($bankTransaction) ? $bankTransaction->supervisor_id : '', ['class' => 'form-control '.($errors->has('branch') ? 'is-invalid' : ''), 'placeholder' => 'Pick a supervisor name...']) !!}
            @if ($errors->has('supervisor'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('supervisor') }}</strong></span>
            @endif
        </div>
        
        {{-- <div class="form-group">
            {!! Form::label('account_number', 'Account Number: ') !!} 
            {!! Form::text('account_number', null, ['class' => 'form-control '.($errors->has('account_number') ? 'is-invalid' : ''), 'placeholder'=>'Enter a account number']) !!}
            @if ($errors->has('account_number'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('account_number') }}</strong></span>
            @endif
        </div> --}}
    </div>
</div>

{{-- <div class="form-group">
    {!! Form::label('details', 'Details: ') !!} 
    {!! Form::textarea('details', null, ['class' => 'form-control', 'placeholder'=>'Write some details', 'rows' => '5']) !!}
</div> --}}

{{-- <div class="form-group">
    {!! Form::label('status', 'Status: ') !!} 
    <input value="1" type="checkbox" name="status" id="" {{ (isset($bankAccount) && $bankAccount->status) ? 'checked' : '' }}> Active
    <p><b>Note: </b><span style="color: #4F4F4F">Only active bank shown</span></p>
</div> --}}