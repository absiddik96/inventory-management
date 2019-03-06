@extends('layouts.app') 
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Create Bank</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banks.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter a bank name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span> 
                    @endif
                </div>
                <div class="form-group float-right">
                    <input type="submit" class="btn btn-outline-primary btn-sm" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">All Bank</h5>
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
                                @if ($banks->count())
                                    @foreach ($banks as $key => $bank)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $bank->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.banks.edit', $bank->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.banks.destroy', $bank->id),
                                                'id' => $bank->id
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

{{--  <div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">All Bank</h5>
        </div>
        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4 dataTable">
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
                                @php 
                                    $i=1; 
                                @endphp 
                                @if ($banks->count())
                                    @foreach ($banks as $bank)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i++ }}</td>
                                            <td>{{ $bank->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.banks.edit', $bank->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                                @include('includes._confirm_delete',[
                                                    'action' => route('admin.banks.destroy', $bank->id),
                                                    'id' => $bank->id
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
</div>  --}}
@endsection