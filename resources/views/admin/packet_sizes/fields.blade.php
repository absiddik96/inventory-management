<div class="form-group">
    {!! Form::label('packet_size', 'Packet Size: ') !!} 
    {!! Form::text('packet_size', null, ['class' => 'form-control '.($errors->has('packet_size') ? 'is-invalid' : ''), 'placeholder'=>'Enter packet size']) !!}
    @if ($errors->has('packet_size'))
        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('packet_size') }}</strong></span>
    @endif
</div>