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
            {!! Form::label('shop_name', 'Shop Name *') !!} 
            {!! Form::text('shop_name', null, ['class' => 'form-control '.($errors->has('shop_name') ? 'is-invalid' : ''), 'placeholder'=>'Enter shop name']) !!}
            @if ($errors->has('shop_name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('shop_name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('nid', 'NID *') !!} 
            {!! Form::text('nid', null, ['class' => 'form-control '.($errors->has('nid') ? 'is-invalid' : ''), 'placeholder'=>'Enter national id card']) !!}
            @if ($errors->has('nid'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('nid') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('trad_license', 'Trade License') !!} 
            {!! Form::text('trad_license', null, ['class' => 'form-control '.($errors->has('trad_license') ? 'is-invalid' : ''), 'placeholder'=>'Enter trade license']) !!}
            @if ($errors->has('trad_license'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('trad_license') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('address', 'Address *') !!} 
            {!! Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? 'is-invalid' : ''), 'placeholder'=>'Enter address']) !!}
            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
            @endif
        </div>
    </div>
</div>