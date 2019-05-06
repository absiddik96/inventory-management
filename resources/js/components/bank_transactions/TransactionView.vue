<template>
    <div>
        <button @click.prevent="transactionView(data.id)" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></button>
        <div class="modal fade" :id="viewModal(data.id)" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Transaction Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for>Bank :</label>
                                    {{ data.bank_account.bank.name }}
                                </div>

                                <div class="form-group">
                                    <label for>Bank Account :</label>
                                    {{ data.bank_account.account_number+' ['+data.bank_account.account_holder+']' }}
                                </div>

                                <div class="form-group">
                                    <h1 class="text-danger">Amount : <span style="font-size: 20px">৳{{ data.amount }}</span></h1>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for>Bank Branch :</label>
                                    {{ data.bank_account.branch.name }}
                                </div>

                                <div class="form-group">
                                    <label for>Transaction Type :</label>
                                    {{ data.transaction_type?'Credit':'Debit' }}
                                </div>

                                <div class="form-group">
                                    <label for>Transaction Date :</label>
                                    {{ data.transaction_date }}
                                </div>
                            </div>
                            <div v-if="data.note" class="col-md-12">
                                <div class="form-group">
                                    <label for>Note :</label>
                                    {{ data.note }}
                                </div>
                            </div>
                            <div v-if="data.transactionable_type != 'App\\User'" class="col-md-12 mt-3">
                                <h3 class="text-info">Transaction Purpose</h3>
                                <hr>
                                <div class="row" v-if="data.transactionable_type == 'App\\Models\\Supplier'">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for>Supplier Name :</label>
                                            {{ data.transactionable.name }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for>Company Name :</label>
                                            {{ data.transactionable.company_name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-if="data.transactionable_type == 'App\\Models\\Dealer'">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for>Dealer Name :</label>
                                            {{ data.transactionable.name }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for>Shop Name :</label>
                                            {{ data.transactionable.shop_name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['data'],
    methods: {
        transactionView(id){
            $('#viewModal-'+id).modal('show');
        },
        viewModal(id){
            return 'viewModal-'+id
        }
    }
}
</script>
