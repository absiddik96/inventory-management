<template>
    <div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Sell Product Update</h5>
                </div>
                <div class="ml-auto p-2">
                    <a href="" class="btn btn-sm btn-outline-primary" @click.prevent="backIndex"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form @submit.prevent="storeData()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_no">Invoice No: </label>
                            <input readonly required type="text" name="invoice_no" id="invoice_no" class="form-control text-uppercase bg-white"  placeholder="Enter Invoice No" :value="form.invoice_no" :class="{ 'is-invalid': form.errors.has('invoice_no')}">
                            <has-error :form="form" field="invoice_no"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="dealer">Dealer </label>
                            <select required @change.prevent="setDealer()" name="dealer" id="dealer" class="form-control" v-model="form.dealer" :class="{ 'is-invalid': form.errors.has('dealer')}">
                                <option value="">Choose dealer</option>
                                <option v-for="(dealer,index) in dealers" :key="index" :value="dealer">{{ dealer.name }}</option>
                            </select>
                            <has-error :form="form" field="dealer"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="date">Date </label>
                            <input required type="date" name="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date')}">
                            <has-error :form="form" field="date"></has-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memo_no">Memo No: </label>
                            <input type="text" name="memo_no" id="memo_no" class="form-control"  placeholder="Enter Memo No" v-model="form.memo_no" :class="{ 'is-invalid': form.errors.has('memo_no')}">
                            <has-error :form="form" field="memo_no"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="category">Product Category </label>
                            <select @change="getProducts()" name="category" id="category" class="form-control" v-model="category_id">
                                <option value="">Choose category</option>
                                <option v-for="(category,index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product </label>
                            <select @change="sellItems($event)" name="product" id="product" class="form-control" v-model="product_id">
                                <option value="">Choose product</option>
                                <option v-for="(product,index) in products" :key="index" :value="product.product_id">{{ product.product_name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <td width="5%">Serial No</td>
                                    <td width="15%">Product Name</td>
                                    <td width="20%">Packet Size (gm)</td>
                                    <td width="25%">Packet Quantity</td>
                                    <td width="10%">Quantity (Kg)</td>
                                    <td width="10%">Unit Price / Kg (৳)</td>
                                    <td width="10%">Total (৳)</td>
                                    <td width="10%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(p_item,index) in form.sell_items" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ p_item.name }}</td>
                                    <td>
                                        <select required @change="grandTotal()" class="form-control" v-model="p_item.packet_size">
                                            <option value="">Choose Packet Size</option>
                                            <option v-for="(packet_size, index) in p_item.packet_sizes" :value="packet_size" :key="index">{{ packet_size.packet_size }}</option>
                                        </select>
                                    </td>
                                    <td style="display: flex">
                                        <input required style="padding-right:30%" @keyup.prevent="grandTotal()" type="number" class="form-control" :class="{'is-invalid':parseInt(p_item.quantity)>(parseInt(p_item.packet_size.packet_quantity)+parseInt(p_item.packet_quantity))}" v-model="p_item.quantity">  <p style="margin: 7px 0 -7px -50%">/ {{ p_item.packet_size.packet_quantity?(parseInt(p_item.packet_size.packet_quantity)+parseInt(p_item.packet_quantity)):0 }}</p>
                                    </td>
                                    <td>{{ p_item.total_quantity = isNaN(parseFloat(((p_item.quantity*p_item.packet_size.packet_size)/1000)))?0:parseFloat(((p_item.quantity*p_item.packet_size.packet_size)/1000)) }}</td>
                                    <td>
                                        {{ p_item.unit_price }}
                                    </td>
                                    <td>{{ p_item.total = parseFloat((p_item.total_quantity*p_item.unit_price).toFixed(2)) }}</td>
                                    <td>
                                        <button @click.prevent="removeItem(index)" class="btn btn-sm btn-outline-danger">x</button>
                                    </td>
                                </tr>
                                <tr v-if="!form.sell_items.length">
                                    <td colspan="8" class="text-center">No product Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Grand Total : </label>
                            <div class="col-md-9">
                                <input type="text" readonly class="bg-white form-control" name="grand_total" :value="parseFloat(form.grand_total).toFixed(2)" :class="{ 'is-invalid': form.errors.has('grand_total')}">
                                <has-error :form="form" field="grand_total"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Amount Due : </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="amount_due" class="bg-white form-control" :value="parseFloat(form.amount_due<0?0:form.amount_due).toFixed(2)" :class="{ 'is-invalid': form.errors.has('amount_due')}">
                                <has-error :form="form" field="amount_due"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="previous_due" class="col-md-3">Previous Due : </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="previous_due" class="bg-white form-control" :value="previousDueCount()" :class="{ 'is-invalid': form.errors.has('previous_due')}">
                                <has-error :form="form" field="previous_due"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Total Due : </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="total_due" class="bg-white form-control" :value="parseFloat(form.total_due).toFixed(2)" :class="{ 'is-invalid': form.errors.has('total_due')}">
                                <has-error :form="form" field="total_due"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Total Amount : </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="total_due" class="bg-white form-control" :value="parseFloat(form.grand_total+form.previous_due).toFixed(2)" :class="{ 'is-invalid': form.errors.has('total_due')}">
                                <has-error :form="form" field="total_due"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grand_total" class="col-md-3">Amount Pay : </label>
                            <div class="col-md-9">
                                <input @keyup="amountDueCount" name="amount_pay" type="text" class="bg-white form-control" v-model="form.amount_pay" :class="{ 'is-invalid': form.errors.has('amount_pay')}">
                                <has-error :form="form" field="amount_pay"></has-error>
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
                                <select required @change="getBankBranch" name="payment_type" id="" v-model="form.payment_type" class="form-control" :class="{ 'is-invalid': form.errors.has('payment_type')}">
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
                                    <select required @change="getBankAccounts" name="bank" id="" class="form-control" v-model="form.bank" :class="{ 'is-invalid': form.errors.has('bank')}">
                                        <option value="">Choose Bank</option>
                                        <option v-for="(bank,index) in banks" :key="index" :value="bank.id">{{ bank.name }}</option>
                                    </select>
                                    <has-error :form="form" field="bank"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-3">Branch : </label>
                                <div class="col-md-9">
                                    <select required @change="getBankAccounts" name="branch" id="" class="form-control" v-model="form.branch" :class="{ 'is-invalid': form.errors.has('branch')}">
                                        <option value="">Choose Branch</option>
                                        <option v-for="(branch,index) in branchs" :key="index" :value="branch.id">{{ branch.name }}</option>
                                    </select>
                                    <has-error :form="form" field="branch"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-md-3">A/C Number : </label>
                                <div class="col-md-9">
                                    <select required name="account_number" id="" class="form-control" v-model="form.account_number" :class="{ 'is-invalid': form.errors.has('account_number')}">
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
                <button :disabled="submitDisable" type="submit" class="btn btn-sm btn-outline-primary float-right">Submit</button>
            </form>
            <!-- hidden -->
            <p hidden>{{ grandTotal() }}</p>
        </div>
    </div>
</div>
</template>
<script>
import sellProductMixin from '../../mixin/SellProduct'
export default {
    props: ['categories','sell_product','banks','branchs'],
    mixins: [sellProductMixin],
    data(){
        return {
            dealers: [],
            product_id: '',
            category_id: '',
            products: '',
            items: '',
            item: '',
            bank_accounts: this.sell_product.transaction != null?[this.sell_product.transaction.bank_account]:[],
            sell_packet_sizes: [],
            form: new Form({
                id: this.sell_product.id,
                dealer: '',
                invoice_no: this.sell_product.invoice_no,
                memo_no: this.sell_product.memo_no,
                date: this.sell_product.date,
                sell_items: [],
                grand_total: 0,
                amount_pay: this.sell_product.amount_pay,
                amount_due: 0,
                previous_due: 0,
                total_due: 0,
                payment_type: this.sell_product.payment_type,
                bank: this.sell_product.transaction != null?this.sell_product.transaction.bank_id:'',
                branch: this.sell_product.transaction != null?this.sell_product.transaction.branch_id:'',
                account_number: this.sell_product.transaction != null?this.sell_product.transaction.bank_account_id:'',
                is_verified: this.sell_product.is_verified,
            })
        }
    },
    methods: {
        getDealers(){
            axios.get(`/dealers`)
            .then(res => {
                this.dealers = res.data.data
                this.form.dealer = this.dealers.find(({id}) => id == this.sell_product.dealer_id)
            })
        },
        storeData(){
            if(this.form.sell_items.length){
                this.form.put(`/sell-products/${this.form.id}`)
                .then(res => {
                    toast.fire({
                        type: 'success',
                        title: 'Sell has been completed successfully'
                    })
                    this.category_id = '';
                })
            }else{
                toast.fire({
                    type: 'info',
                    title: 'Sell Items not found'
                })
            }
        },
        setDealer(){
            this.totalDueCount();
        },
        setCurrentSellItem(item, packet_sizes){
            var temp_item = {
                    stock_id: item.stock_id,
                    category_id: item.category_id,
                    product_id: item.product_id,
                    packet_sizes: packet_sizes,
                    packet_size: packet_sizes.find(({packet_size_id})=> packet_size_id == item.packet_size_id),
                    name: item.product.name,
                    quantity: item.packet_quantity,
                    packet_quantity: item.packet_quantity,
                    total_quantity: item.sub_quantity,
                    unit_price: item.unit_price,
                    total: item.total,
                };
                this.form.sell_items.push(temp_item)
        },
        previousDueCount(){
            return parseFloat(this.form.previous_due = (this.form.dealer.total_amount_due - this.sell_product.amount_due)).toFixed(2)
        },
        setSellItems(){
            this.sell_product.sell_product_items.map((item) => {
                axios.get(`/stock-packet-sizes/${item.stock_id}/stock`)
                .then(res => {
                    let sell_packet_sizes = res.data.data;
                    this.setCurrentSellItem(item, sell_packet_sizes);
                    this.grandTotal();
                })
            });
        },
    },
    created(){
        this.getDealers();
        this.getInvoiceNo();
        this.setSellItems();
        this.getBankAccounts();
    }
}
</script>
