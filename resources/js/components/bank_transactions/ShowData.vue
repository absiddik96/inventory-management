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
    </div>
</template>
<script>
export default {
    props: ['data']
}
</script>

