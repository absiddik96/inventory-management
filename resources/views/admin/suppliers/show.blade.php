<button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#supplier-{{ $supplier->id }}">
    <i class="fa fa-eye"></i>
</button>
<div class="modal fade" id="supplier-{{ $supplier->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Supplier Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table no-border">
                    <tr>
                        <td width="160px">Name</td>
                        <td width="1px">:</td>
                        <td>{{ $supplier->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $supplier->phone }}</td>
                    </tr>
                    <tr>
                        <td>Company Name</td>
                        <td>:</td>
                        <td>{{ $supplier->company_name }}</td>
                    </tr>
                    <tr>
                        <td>Company Address</td>
                        <td>:</td>
                        <td>{{ $supplier->company_address }}</td>
                    </tr>
                    <tr>
                        <td>Registration Number</td>
                        <td>:</td>
                        <td>{{ $supplier->registration_no }}</td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td>:</td>
                        <td>{{ $supplier->details }}</td>
                    </tr>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>