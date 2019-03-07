<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bank', 'Bank: ') !!} 
            {!! Form::select('bank', $banks, isset($bankAccount) ? $bankAccount->bank_id : '', ['class' => 'form-control '.($errors->has('bank') ? 'is-invalid' : ''), 'placeholder' => 'Pick a bank...']) !!}
            @if ($errors->has('bank'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('bank') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('account_holder', 'Account Holder: ') !!} 
            {!! Form::text('account_holder', null, ['class' => 'form-control '.($errors->has('account_holder') ? 'is-invalid' : ''), 'placeholder'=>'Enter a account holder']) !!}
            @if ($errors->has('account_holder'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('account_holder') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('branch', 'Branch: ') !!} 
            {!! Form::select('branch', $branchs, isset($bankAccount) ? $bankAccount->branch_id : '', ['class' => 'form-control '.($errors->has('branch') ? 'is-invalid' : ''), 'placeholder' => 'Pick a branch...']) !!}
            @if ($errors->has('branch'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('branch') }}</strong></span>
            @endif
        </div>
        
        <div class="form-group">
            {!! Form::label('account_number', 'Account Number: ') !!} 
            {!! Form::text('account_number', null, ['class' => 'form-control '.($errors->has('account_number') ? 'is-invalid' : ''), 'placeholder'=>'Enter a account number']) !!}
            @if ($errors->has('account_number'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('account_number') }}</strong></span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('details', 'Details: ') !!} 
    {!! Form::textarea('details', null, ['class' => 'form-control', 'placeholder'=>'Write some details', 'rows' => '5']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status: ') !!} 
    <input value="1" type="checkbox" name="status" id="" {{ (isset($bankAccount) && $bankAccount->status) ? 'checked' : '' }}> Active
    <p><b>Note: </b><span style="color: #4F4F4F">Only active bank shown</span></p>
</div>