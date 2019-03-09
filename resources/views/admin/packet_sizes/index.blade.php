@extends('layouts.app')
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Create Packet Size</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>'admin.packet-sizes.store']) !!} 
            @csrf

            @include('admin.packet_sizes.fields')

            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-sm float-right']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">All Packet Size</h5>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th>SI No.</th>
                                    <th>Packet Size (gm)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($packetSizes->count())
                                    @foreach ($packetSizes as $key => $packetSize)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $packetSize->packet_size }}</td>
                                        <td>
                                            <a href="{{ route('admin.packet-sizes.edit', $packetSize->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.packet-sizes.destroy', $packetSize->id),
                                                'id' => $packetSize->id
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
