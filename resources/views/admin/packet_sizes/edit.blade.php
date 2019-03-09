@extends('layouts.app')
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Edit Packet Size</h5>
        </div>
        <div class="card-body">
            {!! Form::model($packetSize, ['method'=>'post', 'route'=>['admin.packet-sizes.update', $packetSize->id]]) !!} 
            @method('PATCH')
            @include('admin.packet_sizes.fields')

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
