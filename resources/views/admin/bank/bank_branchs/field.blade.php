<div class="form-group">
    {!! Form::label('name', 'Name: ') !!} 
    {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'placeholder'=>'Enter a bank branch name']) !!}
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
    @endif
</div>