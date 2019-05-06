export default {
    methods:{
        getProducts(){
            axios.get(`/stock-products/${this.category_id}/category`)
                .then(res => {
                    this.products = res.data.data;
                })
        },
        sellItems(event){
            this.item = this.products.find(({product_id}) => product_id == event.target.value);
            this.getStockPacketSize(this.item.id);
            
        },
        setSellItem(item){
            var temp_item = {
                stock_id: item.id,
                category_id: '',
                product_id: '',
                packet_sizes: [],
                packet_size: '',
                name: '',
                quantity: 0,
                packet_quantity: 0,
                total_quantity: 0,
                unit_price: 0,
                total: 0,
            };

            temp_item.product_id = item.product_id;
            temp_item.category_id = item.category_id;
            temp_item.name = item.product_name;
            temp_item.unit_price = item.unit_sell_price;

            temp_item.packet_sizes = this.sell_packet_sizes;

            this.form.sell_items.push(temp_item)

            this.product_id = '';
        },
        getStockPacketSize(stock_id){
            axios.get(`/stock-packet-sizes/${stock_id}/stock`)
            .then(res => {
                this.sell_packet_sizes = res.data.data;
                this.setSellItem(this.item);
            })
        },
        getBanks(){
            if(this.form.payment_type == 1 && this.banks == ''){
                axios.get(`/banks`)
                    .then(res => {
                        this.banks = res.data.data;
                    })
            }
        },
        getBranchs(){
            if(this.form.payment_type == 1 && this.branchs == ''){
                axios.get(`/bank-branchs`)
                    .then(res => {
                        this.branchs = res.data.data;
                    })
            }
        },
        getBankAccounts(){
            if(this.form.bank != '' && this.form.branch != ''){
                axios.get(`/bank-account/${this.form.bank}/branch/${this.form.branch}`)
                .then(res => {
                    this.bank_accounts = res.data.bank_accounts;
                })
            }
        },
        getBankBranch(){
            if(!this.form.is_verified){
                this.getBanks();
                this.getBranchs();
            }
        },
        getInvoiceNo(){
            return Math.random().toString(35).substring(2,15);
        },
        grandTotal(){
            this.form.grand_total = this.grandTotalCounter();
            this.amountDueCount();
        },
        amountDueCount(){
            this.form.amount_due = parseFloat(this.form.grand_total).toFixed(2) - this.form.amount_pay;
            this.totalDueCount();
        },
        grandTotalCounter(){
            return this.form.grand_total = this.form.sell_items.reduce(function(total, item){
                return total + item.total; 
            },0);
        },
        totalDueCount(){
            this.form.total_due = this.form.previous_due + this.form.amount_due;
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
                    this.form.sell_items.splice(--index,1);
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
        backIndex(){
            window.location.href = '/sell-products';
        }
    },
    computed: {
        submitDisable(){
            return this.form.busy
        }
    }
}