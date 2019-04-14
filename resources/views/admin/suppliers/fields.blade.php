<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name *') !!} 
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'placeholder'=>'Enter name']) !!}
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Phone *') !!} 
            {!! Form::text('phone', null, ['class' => 'form-control '.($errors->has('phone') ? 'is-invalid' : ''), 'placeholder'=>'Enter phone number']) !!}
            @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!} 
            {!! Form::email('email', null, ['class' => 'form-control '.($errors->has('email') ? 'is-invalid' : ''), 'placeholder'=>'Enter email']) !!}
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('company_name', 'Company Name') !!} 
            {!! Form::text('company_name', null, ['class' => 'form-control '.($errors->has('company_name') ? 'is-invalid' : ''), 'placeholder'=>'Enter company name']) !!}
            @if ($errors->has('company_name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('company_name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('company_address', 'Company Address') !!} 
            {!! Form::text('company_address', null, ['class' => 'form-control '.($errors->has('company_address') ? 'is-invalid' : ''), 'placeholder'=>'Enter company address']) !!}
            @if ($errors->has('company_address'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('company_address') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('registration_no', 'Registration No.') !!} 
            {!! Form::text('registration_no', null, ['class' => 'form-control '.($errors->has('registration_no') ? 'is-invalid' : ''), 'placeholder'=>'Enter registration no']) !!}
            @if ($errors->has('registration_no'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('registration_no') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('details', 'Details') !!} 
            {!! Form::textarea('details', null, ['class' => 'form-control '.($errors->has('details') ? 'is-invalid' : ''), 'placeholder'=>'Write something']) !!}
            @if ($errors->has('details'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('details') }}</strong></span>
            @endif
        </div>
    </div>
</div>