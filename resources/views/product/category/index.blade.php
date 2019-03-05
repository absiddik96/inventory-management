@extends('layouts.app')
@section('content')
<div class="col-md-6">
  <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Create Product Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                @include('product.category._form',['buttonValue'=>'Submit'])
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">All Product Category</h5>
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
                                @if ($categories->count())
                                    @foreach ($categories as $key => $cat)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ ++$key }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                            @include('includes._confirm_delete',[
                                                'action' => route('categories.destroy', $cat->id),
                                                'id' => $cat->id
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