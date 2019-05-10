<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-outline-primary float-right btn-sm"
      data-toggle="modal"
      data-target="#myModal"
    >
      <i class="fa fa-plus"></i> Add New
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="myModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Daily Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="storeData()">
            <div class="modal-body">
              <div class="form-group">
                <label for>Transaction Type:</label>
                <select
                  class="form-control"
                  v-model="form.transaction_type"
                  required
                  :class="{ 'is-invalid': form.errors.has('transaction_type')}"
                >
                  <option value>Pick a transaction type</option>
                  <option value="1">Credit</option>
                  <option value="0">Debit</option>
                </select>
                <has-error :form="form" field="transaction_type"></has-error>
              </div>
              <div class="form-group">
                <label for>Note:</label>
                <input
                  class="form-control"
                  type="text"
                  v-model="form.note"
                  required
                  :class="{ 'is-invalid': form.errors.has('note')}"
                >
                <has-error :form="form" field="note"></has-error>
              </div>
              <div class="form-group">
                <label for>Amount:</label>
                <input
                  class="form-control"
                  type="text"
                  v-model="form.amount"
                  required
                  :class="{ 'is-invalid': form.errors.has('amount')}"
                >
                <has-error :form="form" field="amount"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        note: "",
        amount: "",
        transaction_type: ""
      })
    };
  },
  methods: {
    storeData() {
      this.form.post(`/daily-records`).then(res => {
        this.$emit('storeData');
        toast.fire({
          type: "success",
          title: "Record added successfully"
        });
        this.form.reset();
        $("#myModal").modal("hide");
      });
    }
  }
};
</script>
