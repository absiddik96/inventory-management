<template>
    <div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ title }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form @submit.prevent="action">
                    <!-- Modal body -->
                    <div v-show="!confirm" class="modal-body">
                        <div class="row">
                            <dir class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    <select @change="getBankAccounts()" name="bank" id="" class="form-control " v-model="form.bank" :class="{ 'is-invalid': form.errors.has('bank')}">
                                        <option value="">Choose Bank</option>
                                        <option v-for="(bank,index) in banks" :key="index" :value="bank.id">{{ bank.name }}</option>
                                    </select>
                                    <has-error :form="form" field="bank"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Bank Account</label>
                                    <!-- <input v-if="form.bank == '' && form.branch == ''" type="text" class="form-control"> -->
                                    <select name="bank_account" class="form-control " v-model="form.bank_account" :class="{ 'is-invalid': form.errors.has('bank_account')}">
                                        <option value="">Choose Bank Account</option>
                                        <option v-for="(bank_account,index) in bank_accounts" :key="index" :value="bank_account.id">{{ bank_account.account_number+' ('+bank_account.account_holder+')' }}</option>
                                    </select>
                                    <has-error :form="form" field="bank_account"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <div class="input-group">
                                        <input name="amount" type="number" class="form-control" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount')}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">৳</span>
                                        </div>
                                        <has-error :form="form" field="amount"></has-error>
                                        </div>
                                </div>
                            </dir>
                            <dir class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank Branch</label>
                                    <select @change="getBankAccounts()" name="branch" id="" class="form-control " v-model="form.branch" :class="{ 'is-invalid': form.errors.has('branch')}">
                                        <option value="">Choose Branch</option>
                                        <option v-for="(branch,index) in branches" :key="index" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <has-error :form="form" field="branch"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Transaction Type</label>
                                    <select name="transaction_type" id="" class="form-control " v-model="form.transaction_type" :class="{ 'is-invalid': form.errors.has('transaction_type')}">
                                        <option value="">Choose Branch</option>
                                        <option value="0">Debit</option>
                                        <option value="1">Credit</option>
                                        
                                    </select>
                                    <has-error :form="form" field="transaction_type"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Transaction Date</label>
                                    <input name="transaction_date" type="date" class="form-control" v-model="form.transaction_date" :class="{ 'is-invalid': form.errors.has('transaction_date')}">
                                    <has-error :form="form" field="transaction_date"></has-error>
                                </div>
                            </dir>
                        </div>
                    </div>

                    <div v-show="confirm" class="modal-body">
                        <div class="row">
                            <dir class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    {{ form.bank }}
                                </div>

                                <div class="form-group">
                                    <label for="">Bank Account</label>
                                    <!-- <input v-if="form.bank == '' && form.branch == ''" type="text" class="form-control"> -->
                                    <select name="bank_account" class="form-control " v-model="form.bank_account" :class="{ 'is-invalid': form.errors.has('bank_account')}">
                                        <option value="">Choose Bank Account</option>
                                        <option v-for="(bank_account,index) in bank_accounts" :key="index" :value="bank_account.id">{{ bank_account.account_number+' ('+bank_account.account_holder+')' }}</option>
                                    </select>
                                    <has-error :form="form" field="bank_account"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <div class="input-group">
                                        <input name="amount" type="number" class="form-control" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount')}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">৳</span>
                                        </div>
                                        <has-error :form="form" field="amount"></has-error>
                                        </div>
                                </div>
                            </dir>
                            <dir class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank Branch</label>
                                    <select @change="getBankAccounts()" name="branch" id="" class="form-control " v-model="form.branch" :class="{ 'is-invalid': form.errors.has('branch')}">
                                        <option value="">Choose Branch</option>
                                        <option v-for="(branch,index) in branches" :key="index" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <has-error :form="form" field="branch"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Transaction Type</label>
                                    <select name="transaction_type" id="" class="form-control " v-model="form.transaction_type" :class="{ 'is-invalid': form.errors.has('transaction_type')}">
                                        <option value="">Choose Branch</option>
                                        <option value="0">Debit</option>
                                        <option value="1">Credit</option>
                                        
                                    </select>
                                    <has-error :form="form" field="transaction_type"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Transaction Date</label>
                                    <input name="transaction_date" type="date" class="form-control" v-model="form.transaction_date" :class="{ 'is-invalid': form.errors.has('transaction_date')}">
                                    <has-error :form="form" field="transaction_date"></has-error>
                                </div>
                            </dir>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click.prevent="close">Close</button>
                        <!-- <a v-if="!confirm" type="submit" href="" @click.prevent="submitConfirm" class="btn btn-sm btn-outline-primary">Next</a> -->
                        <button class="btn btn-sm btn-outline-primary" type="submit">Submit</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            updateable: true,
            confirm: false,
            banks: {},
            branches: {},
            bank_accounts: {},
            form: new Form({
                id: '',
                bank: '',
                branch: '',
                bank_account: '',
                transaction_type: '',
                amount: '',
                transaction_date: '',
                confirm: false,
            })
        }
    },
    methods: {
        create(){
            this.form.post(this.endPoint)
            .catch((res) => {
                $('#myModal').modal('show');
            })
            .then(({data}) => {
                this.form.confirm = true;
                this.confirm = true;
                if(data.message){
                    $('#myModal').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: data.message
                    })
                    this.form.reset();
                    this.$emit('created')
                    this.confirm = false
                }   
            });
        },
        getBankAccounts(){  
            if(this.form.bank != '' && this.form.branch != ''){
                this.bankAccounts(this.form.bank,this.form.branch)
            }
        },
        bankAccounts(bank_id,branch_id){
            axios.get(`/admin/bank-account/${bank_id}/branch/${branch_id}`)
                .then(res=>{
                    this.bank_accounts = res.data.bank_accounts
                })
        },
        update(){
            this.form.put(this.endPoint+'/'+this.form.id)
            .catch((res) => {
                $('#myModal').modal('show');
            })
            .then(({data}) => {
                if(data.message){
                    this.updateable = true;
                    $('#myModal').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: data.message
                    })
                    this.form.reset();
                    this.$emit('created')
                }   
            });
        },
        close(){
            this.$parent.editable = false;
            $('#myModal').modal('hide');
            this.form.reset();
            this.updateable = true;
            this.confirm = false
        },
        editData(){
            if(this.$parent.editable){
                this.updateable = false;
                var data = this.$parent.transaction;
                this.bankAccounts(data.bank_id,data.branch_id)
                this.form.fill({
                    id: data.id,
                    bank: data.bank_id,
                    branch: data.branch_id,
                    bank_account: data.bank_account_id,
                    transaction_type: data.transaction_type,
                    amount: data.amount,
                    transaction_date: data.transaction_date
                });
            }
        },
        action(){
            return this.$parent.editable?this.update():this.create();
        },
    },
    updated(){
        if(this.updateable){
            this.editData()
        }
        console.log('updated')
    },
    computed: {
        title(){
            return this.$parent.editable?'Update Bank Transaction':'Create Bank Transaction';
        },
        endPoint() {
			return `/admin/bank-transactions`;
        },
        getBanks(){
            axios.get(`/admin/banks`)
            .then(res=>{
                this.banks = res.data.data
            })
        },
        getBranches(){
            axios.get(`/admin/bankbranchs`)
            .then(res=>{
                this.branches = res.data.data
            })
        },
        submitDisable(){
            return this.form.busy
        }
    },
    created(){
        this.getBanks;
        this.getBranches;
    }
}
</script>
