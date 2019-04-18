<template>
    <div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Create Bulk Stock</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="" class="btn btn-sm btn-outline-primary" @click.prevent="backIndex"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lc_number">L/C Number </label>
                            <input type="text" name="lc_number" id="lc_number" class="form-control"  placeholder="Enter L/c Number" v-model="form.lc_number" :class="{ 'is-invalid': form.errors.has('lc_number')}">
                            <has-error :form="form" field="lc_number"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="supplier">Supplier </label>
                            <select name="supplier" id="supplier" class="form-control" v-model="form.supplier" :class="{ 'is-invalid': form.errors.has('supplier')}">
                                <option value="">Choose supplier</option>
                                <option v-for="(supplier,index) in suppliers" :key="index" :value="supplier.id">{{ supplier.name }}</option>
                            </select>
                            <has-error :form="form" field="supplier"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="date">Date </label>
                            <input type="date" name="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date')}">
                            <has-error :form="form" field="date"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Product Category </label>
                            <select @change="getProducts()" name="category" id="category" class="form-control" v-model="category_id">
                                <option value="">Choose category</option>
                                <option v-for="(category,index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product </label>
                            <select @change="purchaseItems($event)" name="product" id="product" class="form-control" v-model="product_id">
                                <option value="">Choose product</option>
                                <option v-for="(product,index) in products" :key="index" :value="product.id">{{ product.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <td width="10%">Serial No</td>
                                    <td width="30%">Product Name</td>
                                    <td width="20%">Quantity (Kg)</td>
                                    <td width="20%">Unit Price / Kg (৳)</td>
                                    <td width="10%">Total (৳)</td>
                                    <td width="10%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(p_item,index) in form.purchase_items" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ p_item.name }}</td>
                                    <td>
                                        <input @keyup="grandTotal" type="number" class="form-control" v-model="p_item.quantity" required>
                                    </td>
                                    <td>
                                        <input @keyup="grandTotal" type="number" class="form-control" v-model="p_item.unit_price" required>
                                    </td>
                                    <td>{{ p_item.total = parseFloat((p_item.quantity*p_item.unit_price).toFixed(2)) }}</td>
                                    <td>
                                        <button @click.prevent="removeItem(index)" class="btn btn-sm btn-outline-danger">x</button>
                                    </td>
                                </tr>
                                <tr v-if="!form.purchase_items.length">
                                    <td colspan="6" class="text-center">No product Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Grand Total : </label>
                            <div class="col-md-9">
                                <input type="text" readonly class="bg-white form-control" name="grand_total" :value="form.grand_total" :class="{ 'is-invalid': form.errors.has('grand_total')}">
                                <has-error :form="form" field="grand_total"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Amount Pay : </label>
                            <div class="col-md-9">
                                <input @keyup="amountDueCount" name="amount_pay" type="number" min="0" :max="form.grand_total" class="bg-white form-control" v-model="form.amount_pay" :class="{ 'is-invalid': form.errors.has('amount_pay')}">
                                <has-error :form="form" field="amount_pay"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Amount Due : </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="amount_due" class="bg-white form-control" :value="form.amount_due" :class="{ 'is-invalid': form.errors.has('amount_due')}">
                                <has-error :form="form" field="amount_due"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Is Verified : </label>
                            <div class="col-md-9 pt-1">
                                <input @change="getBankBranch" type="checkbox" name="is_verified" value="1" v-model="form.is_verified"> Verified
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Payment Type : </label>
                            <div class="col-md-9">
                                <select @change="getBankBranch" name="payment_type" id="" v-model="form.payment_type" class="form-control" :class="{ 'is-invalid': form.errors.has('payment_type')}">
                                    <option value="">Choose Payment Type</option>
                                    <option value="0">Cash</option>
                                    <option value="1">Bank</option>
                                </select>
                                <has-error :form="form" field="payment_type"></has-error>
                            </div>
                        </div>
                        <div v-if="form.payment_type == 1 && !form.is_verified">
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-3">Bank : </label>
                                <div class="col-md-9">
                                    <select @change="getBankAccounts" name="bank" id="" class="form-control" v-model="form.bank" :class="{ 'is-invalid': form.errors.has('bank')}">
                                        <option value="">Choose Bank</option>
                                        <option v-for="(bank,index) in banks" :key="index" :value="bank.id">{{ bank.name }}</option>
                                    </select>
                                    <has-error :form="form" field="bank"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-3">Branch : </label>
                                <div class="col-md-9">
                                    <select @change="getBankAccounts" name="branch" id="" class="form-control" v-model="form.branch" :class="{ 'is-invalid': form.errors.has('branch')}">
                                        <option value="">Choose Branch</option>
                                        <option v-for="(branch,index) in branchs" :key="index" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <has-error :form="form" field="branch"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-3">A/C Number : </label>
                                <div class="col-md-9">
                                    <select name="account_number" id="" class="form-control" v-model="form.account_number" :class="{ 'is-invalid': form.errors.has('account_number')}">
                                        <option value="">Choose A/c Number</option>
                                        <option v-for="(bank_account,index) in bank_accounts" :key="index" :value="bank_account.id">{{ bank_account.account_number }} - ({{ bank_account.account_holder }})</option>
                                    </select>
                                    <has-error :form="form" field="account_number"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <button :disabled="submitDisable" type="submit" @click.prevent="storeData" class="btn btn-sm btn-outline-primary float-right"> Submit</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['suppliers','categories'],
    data(){
        return {
            products: {},
            product_id: '',
            category_id: '',
            banks: [],
            branchs: [],
            bank_accounts: [],
            form: new Form({
                id: '',
                lc_number: '',
                supplier: '',
                date: '',
                purchase_items: [],
                grand_total: 0,
                amount_pay: 0,
                amount_due: 0,
                payment_type: '',
                bank: '',
                branch: '',
                account_number: '',
                is_verified: false,
            }),
        }
    },
    methods: {
        getProducts(){
            axios.get(`/admin/category/${this.category_id}/products`)
                .then(res => {
                    this.products = res.data.data;
                })
        },
        getBankBranch(){
            if(!this.form.is_verified){
                this.getBanks();
                this.getBranchs();
            }
        },
        getBanks(){
            if(this.form.payment_type == 1 && this.banks == ''){
                axios.get(`/admin/banks`)
                    .then(res => {
                        this.banks = res.data.data;
                    })
            }
        },
        getBranchs(){
            if(this.form.payment_type == 1 && this.branchs == ''){
                axios.get(`/admin/bankbranchs`)
                    .then(res => {
                        this.branchs = res.data.data;
                    })
            }
        },
        getBankAccounts(){
            if(this.form.bank != '' && this.form.branch != ''){
                axios.get(`/admin/bank-account/${this.form.bank}/branch/${this.form.branch}`)
                .then(res => {
                    this.bank_accounts = res.data.bank_accounts;
                })
            }
        },
        purchaseItems(event){
            let item = this.products.find(({id}) => id == event.target.value);
            
            var temp_item = {
                product_id: '',
                category_id: '',
                name: '',
                quantity: 0,
                unit_price: 0,
                total: 0,
            };

            temp_item.product_id = item.id;
            temp_item.category_id = item.product_category_id;
            temp_item.name = item.name;

            this.form.purchase_items.push(temp_item)

            this.product_id = '';
        },
        grandTotal(){
            this.form.amount_due = this.form.grand_total = this.form.purchase_items.reduce(function(total, item){
                return total + item.total; 
            },0);
            this.amountDueCount()
        },
        amountDueCount(){
            this.form.amount_due = this.form.grand_total - this.form.amount_pay;
        },
        removeItem(index){
            Swal.fire({
                    title: 'Are you sure?',
                    text: "Want to remove this item",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    this.form.purchase_items.splice(--index,1);
                    this.grandTotal();
                    this.amountDueCount();
                    Swal.fire(
                        'Removed!',
                        'Item has been removed.',
                        'success'
                    )
                }
            })
        },
        storeData(){
            if(this.form.purchase_items.length){
                this.form.post(`/admin/bulk-stock`)
                .then(res => {
                    toast.fire({
                        type: 'success',
                        title: 'Bulk Stock has been added successfully'
                    })
                    this.form.reset();
                    this.category_id = '';
                })
            }else{
                toast.fire({
                    type: 'info',
                    title: 'Product not found'
                })
            }
        },
        backIndex(){
            window.location.href = '/admin/bulk-stock';
        }
    },
    computed: {
        submitDisable(){
            return this.form.busy
        }
    }
}
</script>
