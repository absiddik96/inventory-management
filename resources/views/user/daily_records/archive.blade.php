@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Daily Records Archive</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th width="9%">SI No.</th>
                                    <th width="15%">Date</th>
                                    <th width="13%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($dates->count())
                                    @foreach ($dates as $key => $date)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $date = date('d-m-Y', strtotime($date->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('daily-records.archive-data', ['date'=>$date]) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
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