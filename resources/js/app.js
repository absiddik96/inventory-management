/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'

import ScrollLoader from 'vue-scroll-loader'
Vue.use(ScrollLoader)

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')
    }
});

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

var $ = require("jquery");
require("datatables.net-bs4");

import swal from "sweetalert2";
const toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

window.Fire = new Vue();
window.swal = swal;
window.toast = toast;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component("bank-transaction",require("./components/bank_transactions/Index.vue"));
Vue.component("bank-transaction-add", require("./components/bank_transactions/Transaction.vue"));

Vue.component("bulk-stock-add",require("./components/bulk_stock/Create.vue"));
Vue.component("bulk-stock-edit",require("./components/bulk_stock/Edit.vue"));

Vue.component("stock-add",require("./components/stock/Create.vue"));
Vue.component("stock-show", require("./components/stock/Show.vue"));

Vue.component("sell-product-add",require("./components/sell_product/Create.vue"));
Vue.component("sell-product-edit",require("./components/sell_product/Edit.vue"));

const app = new Vue({
    el: "#app"
});
