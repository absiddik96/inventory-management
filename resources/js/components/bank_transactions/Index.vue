<template>
    <div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>All Bank Transaction</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="" class="btn btn-sm btn-outline-info" @click.prevent="createTransaction()"> <i class="fa fa-plus"></i> Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped" :class="{dataTable: transactions.length}" role="grid">
                            <thead>
                                <tr role="row">
                                    <th width="7%">SI No.</th>
                                    <th width="7%">Bank</th>
                                    <th width="6%">Branch</th>
                                    <th width="15%">Account Holder</th>
                                    <th width="15%">Account Number</th>
                                    <th width="10%">Amount</th>
                                    <th width="10%">Transaction Type</th>
                                    <th width="10%">Transaction Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd" v-for="(transaction,index) in transactions" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ transaction.bank_account.bank.name }}</td>
                                    <td>{{ transaction.bank_account.branch.name }}</td>
                                    <td>{{ transaction.bank_account.account_holder }}</td>
                                    <td>{{ transaction.bank_account.account_number }}</td>
                                    <td>{{ transaction.amount }}</td>
                                    <td>{{ transaction.transaction_type?'Credit':'Debit' }}</td>
                                    <td>{{ transaction.transaction_date }}</td>
                                    <td>
                                        <transaction-view :data="transaction"></transaction-view>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <bank-transaction-add @created="loadTransaction"></bank-transaction-add>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import transactionView from './TransactionView.vue'
export default {
    components:{
        transactionView
    },
    props: ['transactionsData'],
    data(){
        return{
            transactions: this.transactionsData,
            editable: false,
            transaction: {}
        }
    },
    methods: {
        loadTransaction(){
            axios.get('/admin/bank-transactions').then(({ data }) => {
                this.transactions = {};
                this.transactions = data.data;
            });
            this.editable = false;
        },
        createTransaction(){
            this.editable = false;
            $('#myModal').modal('show');
        },
        editTransaction(transaction){
            this.editable = true;
            $('#myModal').modal('show');
            this.transaction = transaction;
        },
        deleteTransaction(index,id){
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/admin/bank-transactions/'+id)
                    .then(()=>{
                        swal.fire(
                            'Deleted!',
                            'Transaction has been deleted successfully.',
                            'success'
                        );
                        this.transactions.splice(index, 1);
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                    })
                    .catch(()=>{})
                }
            })
        }
    },
    
}
</script>
