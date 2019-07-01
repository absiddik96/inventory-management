<template>
    <div class="col-md-12">
        <div class="card border-secondary">
            <div class="card-header text-center">
                <h2>Masud Seed Company</h2>
                <h5>{{ getHumanDate() }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <daily-record-create @storeData="getData()"></daily-record-create>
                    </div>
                    <div class="col-md-6" style="max-width: 49%">
                        <h5 class="text-center">Credit</h5>
                        <hr>
                        <table class="table table-borderless">
                            <tr class="pre_amount">
                                <th width="49%">Previous Amount</th>
                                <td width="1%">:</td>
                                <td>৳{{ previous_amount }}</td>
                            </tr>
                            <tr v-for="(cData, index) in creditData" :key="index">
                                <th width="49%">{{ cData.purpose }}</th>
                                <td width="1%">:</td>
                                <td>{{ cData.amount }}</td>
                            </tr>
                        </table>
                    </div>
                    <div style="border-left: 1px solid gray;"></div>
                    <div class="col-md-6">
                        <h5 class="text-center">Debit</h5>
                        <hr>
                        <table class="table table-borderless">
                            <tr v-for="(dData, index) in debitData" :key="index">
                                <th width="49%">{{ dData.purpose }}</th>
                                <td width="1%">:</td>
                                <td>{{ dData.amount }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h3>Total: {{ todayTotal() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    export default {
        data() {
            return {
                creditData: [],
                debitData: [],
                creditTotal: null,
                debitTotal: null,
                previous_amount: ''
            }
        },
        methods: {
            getHumanDate: function () {
                var date = new Date().toISOString().slice(0, 10);
                return moment(date, "YYYY-MM-DD").format("DD-MMMM-YYYY");
            },
            getCreditData() {
                axios.post(`/daily-records/credit-data`)
                    .then(res => {
                        this.creditData = res.data.data
                        this.creditTotal = res.data.total
                    })
            },
            getDebitData() {
                axios.post(`/daily-records/debit-data`)
                    .then(res => {
                        this.debitData = res.data.data
                        this.debitTotal = res.data.total
                    })
            },
            getPreviousAmount() {
                axios.post(`/daily-records/previous-amount`)
                    .then(res => {
                        this.previous_amount = res.data.data
                    })
            },
            getData() {
                this.getCreditData();
                this.getDebitData();
            },
            todayTotal(){
                return this.creditTotal - this.debitTotal;
            }
        },
        created() {
            this.getCreditData();
            this.getDebitData();
            this.getPreviousAmount();
        }
    };

</script>
