<script setup>
    import Layout from "../Shared/Layout.vue";
    const props = defineProps({
        orders:[]|null,
    })


</script>

<template>
    <Layout>

        <div class="container my-5">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <div class="card col-md-3 me-1">
                        <div class="card-body">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                        aria-selected="true">Home</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-profile" type="button" role="tab"
                                        aria-controls="v-pills-profile" aria-selected="false">Orders</button>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-messages" type="button" role="tab"
                                        aria-controls="v-pills-messages" aria-selected="false">Watch List</button>
                                <a :href="$page.props.auth.MAIN_URL+'/logout'" class="nav-link">Logout</a>
                            </div>
                        </div>
                    </div>

                    <div class="card col-md-8 ms-1">
                        <div class="card-body">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <h2>All Orders</h2>

                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <th class="p-1">OrderId</th>
                                            <th class="p-1">Total Price</th>
                                            <th class="p-1">Payment Method</th>
                                            <th class="p-1">Payment Status</th>
                                            <th class="p-1">Order Status</th>
                                        </thead>

                                        <tbody>
                                            <tr v-for="item in props.orders.orders" :key="item.id">
                                                <td>#laravel_{{ item.id }}</td>
                                                <td>{{ item.cart_total_price }} ৳</td>
                                                <td>{{ item.payment_method }}</td>
                                                <td>
                                                    <span class="badge bg-light-primary">
                                                        {{ item.payment_status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-primary">
                                                        {{ item.order_status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </Layout>
</template>



<style scoped>

</style>
