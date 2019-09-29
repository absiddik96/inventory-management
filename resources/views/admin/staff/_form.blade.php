<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('password', 'Name: ') !!} 
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'placeholder'=>'Enter a name']) !!}
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($buttonValue, ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
</div>