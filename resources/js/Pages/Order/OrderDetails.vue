<script setup>

import { computed } from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import Layout from "../../Shared/Layout.vue";
import Swal from "sweetalert2";

const props = defineProps({
    order:Object|null,
    url:[]|null,
})

const updateStatus = useForm({
    orderStatus:null,
    paymentStatus:null

})


const changeOrderStatus = (event) =>{
    Inertia.get(props.url.oSChange+`?status=${event.target.value}`,{status:event.target.value},{
        preserveState: true,
        replace: true,
        onSuccess: page => {
            console.log(page);
            $sToast.fire({
                icon: 'success',
                title: 'Order Status Updated...'
            })
        },
        onError: errors => {
            $toast.error("Validation Errors...")
        }
    })

    console.log(event.target.value);
}

const changePaymentStatus = (event) =>{
    Inertia.get(props.url.pSChange+`?status=${event.target.value}`,{status:event.target.value},{
        preserveState: true,
        replace: true,
        onSuccess: page => {
            console.log(page);
            $sToast.fire({
                icon: 'success',
                title: 'Payment Status Updated...'
            })
        },
        onError: errors => {
            $toast.error("Validation Errors...")
        }
    })

}


</script>

<template>
    <Layout>
        <section class="app-user-list">
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="card invoice-preview-card">
                        <div class="card-body invoice-padding pb-0">
                            <!-- Header starts -->
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div>
                                    <div class="logo-wrapper">
                                        <img src="../../../images/logo.png" alt="" height="60">
                                        <h3 class="text-primary invoice-logo" v-html="$page.props.auth.APP_NAME"></h3>
                                    </div>

                                    <h3 class="card-text">AMBLE TRADING</h3>
                                    <p class="card-text">Muskan Tower, 5th Floor, 56 Gulshan Avenue, Road-132, Gulshan-1, Dhaka-1212 </p>
                                    <p class="card-text mb-0 pb-0">Phone: +8801758-577795</p>
                                    <p class="card-text">Email: alimubarakk@gmail.com</p>

                                </div>
                                <div class="mt-md-0 mt-2">
                                    <h4 class="invoice-title">
                                        Invoice
                                        <span class="invoice-number">#{{ order.id }}</span>
                                    </h4>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title">Order Date: {{ order.order_date }}</p>
                                    </div>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title text-capitalize">Order Status: <span class="badge bg-light-primary ms-1">{{ order.order_status }}</span></p>
                                    </div>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title text-capitalize">Payment Status: <span class="badge bg-light-primary ms-1">{{ order.payment_status }}</span></p>
                                    </div>


                                </div>

                            </div>

                            <!-- Header ends -->
                        </div>

                        <hr class="invoice-spacing" />
                        <!-- Address and Contact starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row invoice-spacing">
                                <div class="col-xl-8">
                                    <h6 class="mb-2">Invoice To:</h6>
                                    <h6 class="card-text mb-25" v-if="order.customer">{{order.customer.name}}</h6>
                                    <p class="mb-25" v-if="order.address">{{ order.address.address }}</p>
                                    <p class="mb-25" v-if="order.customer.phone">{{ order.customer.phone }}</p>
                                    <p class="mb-25" v-if="order.customer.email">{{ order.customer.email }}</p>
                                </div>
                                <div class="col">
                                        <select v-model="updateStatus.orderStatus" @change="changeOrderStatus" class="form-control mb-1">
                                            <option value="null" disabled selected>Change Order Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="received">Received</option>
                                            <option value="process">Process</option>
                                            <option value="shipped">Shipped</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="cancel">Cancel</option>
                                        </select>

                                        <select v-model="updateStatus.paymentStatus" @change="changePaymentStatus" class="form-control">
                                            <option value="null" disabled selected>Change Payment Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="paid">Paid</option>
                                            <option value="cancel">Cancel</option>
                                        </select>
                                </div>

                                <!--

                                                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                                                            <h6 class="mb-2">Payment Details:</h6>
                                                                            <table>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td class="pe-1">Total Due:</td>
                                                                                    <td><span class="fw-bold">{{ info.invoice.due }} Tk</span></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pe-1">Bank name:</td>
                                                                                    <td>American Bank</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pe-1">Country:</td>
                                                                                    <td>United States</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pe-1">IBAN:</td>
                                                                                    <td>ETD95476213874685</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pe-1">SWIFT code:</td>
                                                                                    <td>BR91905</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                -->

                            </div>
                        </div>


                        <!-- Address and Contact ends -->

                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="py-1" width="40%">Product Name</th>
                                    <th class="py-1">Price</th>
                                    <th class="py-1">size & Qty</th>
                                    <th class="py-1">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in  order.order_details">
                                    <td class="py-1">
                                        <a href="#">
                                            {{ item.product.title }}
                                        </a>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold"> {{  item.product.price }} ৳ </span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{ item.buy_size }}</span> * <span>{{ item.quantity }}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{ item.product.price * item.quantity }} ৳</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-8 order-md-1 order-2 mt-md-0 mt-3">

                                </div>
                                <div class="col-md-4 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper w-100">
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title">Subtotal:</p>
                                            <p class="invoice-total-amount">{{ order.cart_total_price }} ৳</p>
                                        </div>
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title">Delivery Charge:</p>
                                            <p class="invoice-total-amount">{{ order.delivery_charge }} ৳</p>
                                        </div>

                                        <hr class="my-50" />
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title text-black fw-bolder">Total:</p>
                                            <p class="invoice-total-amount text-black fw-bolder">{{ order.cart_total_price + order.delivery_charge }} ৳</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing" />

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <span class="fw-bold me-1">Thank you sir:</span>
                                    <span>Welcome</span>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<style lang="sass">

</style>
