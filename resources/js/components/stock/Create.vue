<template>
<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Create Stock</h5>
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
                            <label for="category">Product Category </label>
                            <select @change="getProducts()" name="category" id="category" class="form-control" v-model="form.category" :class="{ 'is-invalid': form.errors.has('category')}">
                                <option value="">Choose category</option>
                                <option v-for="(category,index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                            </select>
                            <has-error :form="form" field="category"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="product">Product </label>
                            <select @change.prevent="setProduct()" name="product" id="product" class="form-control" v-model="form.product" :class="{ 'is-invalid': form.errors.has('product')}">
                                <option value="">Choose product</option>
                                <option v-for="(item,index) in products" :key="index" :value="item.product_id">{{ item.product_name }}</option>
                            </select>
                            <has-error :form="form" field="product"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Quantity (KG) </label>
                            <input type="text" name="" id="" :value="form.product?totalQuantityCounter()+'/'+form.bulk_quantity:0" class="form-control bg-white" :class="{'is-invalid': form.totalQuantity>form.bulk_quantity}" readonly>
                            <small class="text-danger" v-if="form.totalQuantity>form.bulk_quantity">The Quantity less than or equal to {{ form.bulk_quantity }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Unit Selling Price </label>
                            <input required type="number" name="unit_sell_price" id="" v-model="form.unit_sell_price" class="form-control" :class="{ 'is-invalid': form.errors.has('unit_sell_price')}">
                            <has-error :form="form" field="unit_sell_price"></has-error>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <td width="10%">Serial No</td>
                                    <td width="20%">Packet Size (gm)</td>
                                    <td width="20%">Number of Packet</td>
                                    <td width="10%">Sub Quantity (KG)</td>
                                    <td width="10%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(packet,index) in form.packets" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>
                                        <select @click.prevent="totalQuantityCount()" v-model="packet.packet_size" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option v-for="(packet_size,index) in packet_sizes" :key="index" :value="packet_size">{{ packet_size.packet_size }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input @keyup="totalQuantityCount()" type="number" class="form-control" v-model="packet.packet_quantity" required>
                                    </td>
                                    <td>
                                        {{ packet.sub_quantity = isNaN(parseFloat(((packet.packet_size.packet_size*packet.packet_quantity)/1000).toFixed(2))) ? 0 : parseFloat(((packet.packet_size.packet_size*packet.packet_quantity)/1000).toFixed(2)) }}

                                    </td>
                                    <td>
                                        <button @click.prevent="removeItem(index)" class="btn btn-sm btn-outline-danger">x</button>
                                    </td>
                                </tr>
                                <tr v-if="!form.packets.length">
                                    <td colspan="6" class="text-center">No product Found</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button class="btn btn-sm btn-outline-primary" @click.prevent="addNewPacket()"><i class="fa fa-plus"></i> Add New</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <button :disabled="submitDisable" type="submit" class="btn btn-sm btn-outline-primary float-right"> Submit</button>
            </form>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props: ['categories','packet_sizes'],
    data(){
        return {
            products: [],
            get_quantity: '',
            form: new Form({
                totalQuantity: 0,
                category: '',
                product: '',
                unit_sell_price: '',
                bulk_quantity: '',
                packets: []
            })
        }
    },
    methods: {
        getProducts(){
            this.products = [];
            this.form.product = '';
            this.form.packets = [];
            axios.get(`/admin/category/${this.form.category}/purchase-item`)
            .then(res => {
                this.products = res.data.data;
            })
        },
        setProduct(){
            this.form.packets = [];
            this.form.bulk_quantity = this.products.length?this.products.find(({product_id})=>product_id === this.form.product).quantity:0;
            this.setQuantity();
        },
        setQuantity(){
            this.get_quantity = this.form.totalQuantity+'/'+this.form.bulk_quantity;
        },
        addNewPacket(){
            if(!this.form.product){
                toast.fire({
                    type: 'info',
                    title: 'Please choose a product first'
                })
                return '';
            }
            if(this.form.bulk_quantity == 0 ){
                toast.fire({
                    type: 'info',
                    title: 'This product is out of stock'
                })
                return '';
            }
            var temp_item = {
                packet_size: '',
                packet_quantity: 0,
                sub_quantity: '',
            };

            this.form.packets.push(temp_item);
            
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
                    this.form.packets.splice(--index,1);
                    this.totalQuantityCount();
                    Swal.fire(
                        'Removed!',
                        'Item has been removed.',
                        'success'
                    )
                }
            })
        },
        totalQuantityCount(){
            this.form.totalQuantity = this.totalQuantityCounter();
            this.get_quantity = this.form.totalQuantity+'/'+this.form.bulk_quantity;
        },
        totalQuantityCounter(){
            return this.form.totalQuantity = this.form.packets.reduce(function(total, item){
                return total + item.sub_quantity; 
            },0);
        },
        storeData(){
            if(this.form.totalQuantity>this.form.bulk_quantity){
                toast.fire({
                    type: 'info',
                    title: `The Quantity less than or equal to ${ this.form.bulk_quantity }`
                })
                return '';
            }
            if(this.form.packets.length){
                this.form.post(`/admin/stocks`)
                .then(res => {
                    toast.fire({
                        type: 'success',
                        title: 'Stock has been added successfully'
                    })
                    this.form.reset();
                    this.form.category = '';
                })
            }else{
                toast.fire({
                    type: 'info',
                    title: 'Packet not found'
                })
            }
        },
        backIndex(){
            window.location.href = '/admin/stocks';
        }
    },
    computed: {
        submitDisable(){
            return this.form.busy
        }
    }
}
</script>
