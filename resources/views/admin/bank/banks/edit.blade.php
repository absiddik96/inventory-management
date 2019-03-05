@extends('layouts.app') 
@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Edit Bank</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banks.update', $bank->id) }}" method="post">
                @csrf @method('PATCH')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter a bank name" value="{{ $bank->name }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-outline-primary btn-sm" value="Update">
                </div>
            </form>
        </div>
    </div>

    @if ($errors->count())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection