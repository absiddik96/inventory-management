<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password', 'Name: ') !!} 
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'placeholder'=>'Enter a name']) !!}
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password: ') !!} 
            {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid' : ''), 'placeholder'=>'Enter a password']) !!}
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span> 
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', 'Email: ') !!} 
            {!! Form::email('email', null, ['class' => 'form-control '.($errors->has('email')?'is-invalid':''), 'placeholder'=>'Enter a email']) !!}
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span> 
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password: ') !!} 
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder'=>'Enter password again']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Status:
                <input value="1" type="checkbox" name="status" id=""  {{ (isset($user) && $user->status) ? 'checked': '' }}> Active
                {{-- {!! Form::checkbox('status', 1, [ ]) !!} Active --}}
            </label>
        </div>
        <div class="form-group">
            <label for="">Is Admin: 
                <input value="1" type="checkbox" name="is_admin" id=""  {{ (isset($user) && $user->is_admin) ? 'checked': '' }}> admin
            </label> 
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($buttonValue, ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
</div>