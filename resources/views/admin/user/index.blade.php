@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>All User</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> Add new</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count())
                                    @foreach ($users as $key => $user)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ phone($user->phone) }}</td>
                                        <td>
                                            {{ isAdmin($user->is_admin) }}
                                            @if ($user->id != auth()->user()->id)
                                                <a href="{{ route('admin.users.type', $user->id) }}" class="ml-2 badge {{ $user->is_admin?'text-white badge-info':'badge-success' }}">{{ isAdmin(!$user->is_admin) }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ status($user->status) }}
                                            @if ($user->id != auth()->user()->id)
                                                <a href="{{ route('admin.users.status', $user->id) }}" class="ml-2 badge {{ $user->status?'text-white badge-danger':'badge-success' }}">{{ status(!$user->status) }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @if ($user->id != auth()->user()->id)
                                                @include('includes._confirm_delete',[
                                                    'action' => route('admin.users.destroy', $user->id),
                                                    'id' => $user->id
                                                ])
                                            @endif
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
