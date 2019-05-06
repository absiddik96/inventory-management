<template>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for>Bank :</label>
                {{ data.bank }}
            </div>

            <div class="form-group">
                <label for>Bank Account :</label>
                {{ data.bank_account.account_number+' ['+data.bank_account.account_holder+']' }}
            </div>

            <div class="form-group">
                <h1 class="text-danger">Amount : <span style="font-size: 20px">৳{{ data.amount }}</span></h1>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for>Bank Branch :</label>
                {{ data.branch }}
            </div>

            <div class="form-group">
                <label for>Transaction Type :</label>
                {{ data.transaction_type }}
            </div>

            <div class="form-group">
                <label for>Transaction Date :</label>
                {{ data.transaction_date }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="payment">Payment</label>
            </div>
        </div>
        <div v-if="data.payment" class="col-md-6">
            <div class="form-group">
                <label for="">From / To : </label>
                {{ data.from_to?'Supplier':'Dealer' }}
            </div>
        </div>
        <div v-if="data.payment && data.from_to" class="col-md-6">
            <div class="form-group" v-if="data.from_to == 0">
                <label for="">Dealer : </label>
                {{ data.dealer.name }}
            </div>
            <div class="form-group" v-if="data.from_to == 1">
                <label for="">Supplier : </label>
                {{ data.dealer.name }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for>Note :</label>
                {{ data.note }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['data']
}
</script>

