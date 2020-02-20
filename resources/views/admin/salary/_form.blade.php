<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('staff', 'Staff: ') !!} 
            {!! Form::select('staff', ['' => 'choose Staff'] + $staffs, null, ['class' => 'form-control '.($errors->has('staff') ? 'is-invalid' : '')]) !!}
            @if ($errors->has('staff'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('staff') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status: ') !!} 
            {!! Form::select('status', ['' => 'choose Status','1' => 'Credit', '0' => 'Debit'], null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : '')]) !!}
            @if ($errors->has('status'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('status') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('amount', 'Amount: ') !!} 
            {!! Form::text('amount', null, ['class' => 'form-control '.($errors->has('amount') ? 'is-invalid' : ''), 'placeholder'=>'Enter Amount']) !!}
            @if ($errors->has('amount'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('amount') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('date', 'Date: ') !!} 
            {!! Form::date('date', null, ['class' => 'form-control '.($errors->has('date') ? 'is-invalid' : '')]) !!}
            @if ($errors->has('date'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('note', 'Note: ') !!} 
            {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($buttonValue, ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
</div>