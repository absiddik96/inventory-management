@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Salary List</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.salaries.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th>SI No.</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($salaries->count())
                                    @foreach ($salaries as $key => $salary)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $salary->staff->name }}</td>
                                        <td>{{ $salary->status?'Credit':'Debit' }}</td>
                                        <td>{{ $salary->amount }}</td>
                                        <td>{{ $salary->date }}</td>
                                        <td>{{ $salary->note }}</td>
                                        {{-- <td>
                                            <a href="{{ route('admin.salaries.edit', $salary->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('admin.salaries.destroy', $salary->id),
                                                'id' => $salary->id
                                            ])
                                        </td> --}}
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
