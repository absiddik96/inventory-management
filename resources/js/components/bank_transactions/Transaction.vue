<template>
    <div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ confirm?'Confirm':'Create' }} Bank Transaction</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form @submit.prevent="create">
                    <!-- Modal body -->
                    <div v-show="!confirm" class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    <select @change="getBankAccounts()" name="bank" id="" class="form-control " v-model="form.bank" :class="{ 'is-invalid': form.errors.has('bank')}">
                                        <option value="">Choose bank</option>
                                        <option v-for="(bank,index) in banks" :key="index" :value="bank.id">{{ bank.name }}</option>
                                    </select>
                                    <has-error :form="form" field="bank"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Bank Account</label>
                                    <!-- <input v-if="form.bank == '' && form.branch == ''" type="text" class="form-control"> -->
                                    <select name="bank_account" class="form-control " v-model="form.bank_account" :class="{ 'is-invalid': form.errors.has('bank_account')}">
                                        <option value="">Choose bank account</option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Bank Branch</label>
                                    <select @change="getBankAccounts()" name="branch" id="" class="form-control " v-model="form.branch" :class="{ 'is-invalid': form.errors.has('branch')}">
                                        <option value="">Choose branch</option>
                                        <option v-for="(branch,index) in branches" :key="index" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <has-error :form="form" field="branch"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Transaction Type</label>
                                    <select name="transaction_type" id="" class="form-control " v-model="form.transaction_type" :class="{ 'is-invalid': form.errors.has('transaction_type')}">
                                        <option value="">Choose transaction type</option>
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
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Note</label>
                                    <textarea name="note" id="" cols="30" rows="5" class="form-control" v-model="form.note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="confirm" class="modal-body">
                        <show-data :data="formData"></show-data>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" @click.prevent="close">Close</button>
                        <button v-if="!confirm" class="btn btn-sm btn-outline-primary" type="submit">Next</button>
                        <div v-else>
                            <button class="btn btn-sm btn-outline-primary" type="button" @click.prevent="backForm">Previous</button>
                            <button class="btn btn-sm btn-outline-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import showData from './ShowData.vue'
export default {
    components:{
        showData
    },
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
                note: '',
                confirm: false,
            }),
            formData: {
                bank: '',
                branch: '',
                bank_account: '',
                transaction_type: '',
                amount: '',
                transaction_date: '',
                note: '',
            }
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
                this.getFormData();
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
            this.form.confirm = false
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
                    transaction_date: data.transaction_date,
                    note: data.note
                });
            }
        },
        backForm(){
            this.confirm = false
            this.form.confirm = false
        },
        getFormData(){
            this.formData.bank = this.banks.find(({id}) => id === this.form.bank).name;
            this.formData.branch = this.branches.find(({id}) => id === this.form.branch).name;
            this.formData.transaction_type = this.form.transaction_type == '1'?'Credit':'Debit';
            this.formData.bank_account = this.bank_accounts.find(({id}) => id === this.form.bank_account);
            this.formData.transaction_date = this.form.transaction_date;
            this.formData.amount = this.form.amount;
            this.formData.note = this.form.note;

            return this.formData
        }
    },
    computed: {
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
