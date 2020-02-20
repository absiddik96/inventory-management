<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!} 
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'placeholder'=>'Enter a name']) !!}
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email: ') !!} 
            {!! Form::email('email', null, ['class' => 'form-control '.($errors->has('email')?'is-invalid':''), 'placeholder'=>'Enter a email']) !!}
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('mobile', 'Mobile: ') !!} 
            {!! Form::text('mobile', null, ['class' => 'form-control '.($errors->has('mobile') ? 'is-invalid' : ''), 'placeholder'=>'Enter Mobile Number']) !!}
            @if ($errors->has('mobile'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mobile') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('address', 'Address: ') !!} 
            {!! Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? 'is-invalid' : ''), 'placeholder'=>'Enter Address']) !!}
            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span> 
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($buttonValue, ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
</div>