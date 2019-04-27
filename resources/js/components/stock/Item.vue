<template>
    <tr>
        <td>{{ sr }}</td>
        <td v-if="!editable">{{ item.packet_size.packet_size }}</td>
        <td v-if="editable">
            <select @click.prevent="totalQuantityCount()" v-model="form.packet_size" class="form-control" required>
                <option value="">Choose</option>
                <option v-for="(packet_size,index) in packet_sizes" :key="index" :value="packet_size">{{ packet_size.packet_size }}</option>
            </select>
        </td>

        <td v-if="!editable">{{ item.packet_quantity }}</td>
        <td v-if="editable">
            <input @keyup="totalQuantityCount()" type="number" class="form-control" v-model="form.packet_quantity" required>
        </td>

        <td v-if="!editable">{{ ((item.packet_quantity*item.packet_size.packet_size)/1000) }}</td>
        <td v-if="editable">
            <input readonly type="text" :value="form.sub_quantity+'/'+(totalBulkStockQuantity = parseFloat(item.sub_quantity)+parseFloat(quantity_details.quantity))" class="form-control bg-white" :class="{'is-invalid': form.sub_quantity>totalBulkStockQuantity}">
        </td>

        
        <td>{{ item.created_at | formatDate }}</td>

        <td v-if="!editable">
            <button class="btn btn-sm btn-outline-primary" @click.prevent="editItem()">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger" @click.prevent="deleteItem()">
                <i class="fa fa-trash"></i>
            </button>
        </td>
        <td v-if="editable" class="text-right">
            <button class="btn btn-sm btn-outline-primary" @click.prevent="updateItem()">
                Update
            </button>
        </td>
    </tr>
</template>
<script>
export default {
    props: ['item','sr','packet_sizes'],
    data(){
        return {
            itemData: this.item,
            editable: false,
            totalBulkStockQuantity: 0,
            quantity_details: [],
            form: new Form({
                id: this.item.id,
                packet_size: this.item.packet_size,
                packet_quantity: this.item.packet_quantity,
                sub_quantity: this.item.sub_quantity,
            }),
        }
    },
    methods: {
        editItem(){
            this.editable = true;
            axios.post(`/admin/stock/${this.$parent.product_id}/quantity-details`)
            .then(res => {
                this.quantity_details = res.data.data[0];
            })
        },
        updateItem(){
            this.form.put(`/admin/stock-item/${this.form.id}`)
            .then(res => {
                this.editable = false;
                this.$emit('getStockItems')
                toast.fire({
                    type: 'success',
                    title: 'Item has been updated successfully'
                })
            })
        },
        totalQuantityCount(){
            this.form.sub_quantity = (this.form.packet_size.packet_size*this.form.packet_quantity)/1000;
        },
        deleteItem(){
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
                    axios.delete(`/admin/stock-item/${this.item.id}/delete`)
                    .then(res => {
                        this.editable = false;
                        this.$emit('getStockItems')
                        toast.fire({
                            type: 'success',
                            title: 'Item has been deleted successfully'
                        })
                    })
                }
            })
        }
    },
    created(){
        this.totalQuantityCount();
    }
}
</script>
