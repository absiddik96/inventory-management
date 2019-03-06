@extends('layouts.app')
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Create Bank Branch</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['method'=>'post', 'route'=>'admin.bankbranchs.store']) !!} 
            @csrf

            @include('admin.bank.bank_branchs.field')

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
            <h5 class="m-0">All Bank Branch</h5>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 170px;">SI No.</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                                        style="width: 219px;">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 194px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bankBranchs->count())
                                    @foreach ($bankBranchs as $key => $bankBranch)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $bankBranch->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.bankbranchs.edit', $bankBranch->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.bankbranchs.destroy', $bankBranch->id),
                                                'id' => $bankBranch->id
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
