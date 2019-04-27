<template>
    <div>
        <button type="button" class="btn btn-sm btn-outline-primary float-right" @click.prevent="createItem()">
            <i class="fa fa-plus"></i> Add New
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Packet</h4>
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="formReset()">&times;</button>
                    </div>
                    
                    <form @submit.prevent="storeItem()" action="">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Packet Size</label>
                                <select @click.prevent="totalQuantityCount()" v-model="form.packet_size" class="form-control" required>
                                    <option value="">Choose</option>
                                    <option v-for="(packet_size,index) in packet_sizes" :key="index" :value="packet_size">{{ packet_size.packet_size }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Packet Quantity</label>
                                <input @keyup="totalQuantityCount()" type="number" class="form-control" v-model="form.packet_quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="">Sub Quantity (KG)</label>
                                <input readonly type="text" class="form-control bg-white" :value="form.sub_quantity+'/'+quantity_details.quantity" required :class="{'is-invalid': form.sub_quantity>quantity_details.quantity}">
                            </div>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" @click.prevent="formReset()">Close</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" @click.prevent="formReset()">Reset</button>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Sumbit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['packet_sizes'],
    data(){
        return {
            quantity_details: [],
            form: new Form({
                id: '',
                stock_id: this.$parent.stock_id,
                packet_size: '',
                packet_quantity: 0,
                sub_quantity: 0,
            }),
        }
    },
    methods: {
        createItem(){
            this.getQuantityDetails();
            $('#myModal').modal('show');
        },
        getQuantityDetails(){
            axios.post(`/admin/stock/${this.$parent.product_id}/quantity-details`)
            .then(res => {
                this.quantity_details = res.data.data[0];
            })
        },
        storeItem(){
            if(this.form.sub_quantity>this.quantity_details.quantity){
                toast.fire({
                    type: 'info',
                    title: 'Sub Quantity less than or equal to '+ this.quantity_details.quantity 
                })
                return '';
            }
            this.form.post(`/admin/stock-item`)
            .then(res => {
                this.form.reset();
                this.getQuantityDetails();
                this.$emit('getStockItems')
                toast.fire({
                    type: 'success',
                    title: 'Item has been added successfully'
                })
            })
        },
        totalQuantityCount(){
            this.form.sub_quantity = (this.form.packet_size.packet_size*this.form.packet_quantity)/1000;
        },
        formReset(){
            this.form.reset();
        }
    }
}
</script>
