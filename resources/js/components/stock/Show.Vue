<template>
    <div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2">
                    <h5>Stock: <small>{{ stock.product.name }}</small></h5>
                </div>
                <div class="ml-auto p-2">
                    <a @click.prevent="backIndex()" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table no-border" role="grid">
                            <tr>
                                <td width="150px">Product Name</td>
                                <td width="1px">:</td>
                                <td>{{ stock.product.name }}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>:</td>
                                <td>{{ stock.category.name }}</td>
                            </tr>
                            <tr>
                                <td>Unit Selling Price</td>
                                <td>:</td>
                                <td>
                                    <div v-if="!priceForm.editable" action="" class="form-inline">
                                        <input readonly type="number" class="form-control mr-2 bg-white" v-model="priceForm.price" style="width: 70%">
                                        <button @click.prevent="priceForm.editable = true" class="btn btn-sm btn-outline-primary p-2 pl-3 pr-3">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <form v-if="priceForm.editable" @submit.prevent="priceUpdate()" action="" class="form-inline">
                                        <input required type="number" class="form-control mr-2" v-model="priceForm.price" style="width: 70%">
                                        <button type="submit" class="btn btn-sm btn-outline-primary p-2 pl-3 pr-3">Update</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-end">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <td width="10%">Serial No</td>
                                <td width="20%">Packet Size (gm)</td>
                                <td width="20%">Number of Packet</td>
                                <td width="10%">Sub Quantity (KG)</td>
                                <td width="10%">Date</td>
                                <td width="10%">Action</td>
                            </tr>
                        </thead>
                        <tbody v-for="(item,index) in stock_items" :key="index">
                            <stock-item :item="item" :sr="++index" :packet_sizes="packet_sizes" @getStockItems="getStockItems"></stock-item>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <stock-item-create :packet_sizes="packet_sizes" @getStockItems="getStockItems"></stock-item-create>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import stockItem from "./Item.vue";
import stockItemCreate from "./ItemCreate.vue";
export default {
    props: ['stock','packet_sizes'],
    components: {
        stockItem,
        stockItemCreate,
    },
    data(){
        return {
            stock_id: this.stock.id,
            stock_items: [],
            product_id: this.stock.product_id,
            priceForm: new Form({
                price: this.stock.unit_sell_price,
                editable: false,
            })
        }
    },
    methods: {
        priceUpdate(){
            this.priceForm.put(`/admin/stocks/${this.stock_id}`)
            .then(res => {
                this.priceForm.editable = false;
                toast.fire({
                    type: 'success',
                    title: 'Price has been updated successfully'
                })
            });
        },
        getStockItems(){
            axios.get(`/admin/stock-items/${this.stock_id}`)
            .then(res => {
                this.stock_items = res.data.data.stock_items;
            })
        },
        backIndex(){
            window.location.href = '/admin/stocks';
        }
    },
    created(){
        this.getStockItems();
    }
}
</script>
