
<script setup>
    import Layout from "../../Shared/Layout.vue";
    const props = defineProps({
        orders:[]|null,
    })
</script>


<template>
    <Head>
        <meta type="description" content="Information about my app" head-key="description">
    </Head>
    <Layout>

        <section class="app-user-list">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-datatable table-responsive pt-0 px-2">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                        <div class="select-search-area d-flex align-items-center">
                            <select class="form-select" v-model="perPage">
                                <option :value="undefined">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div
                            class="d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                            <div class="select-search-area">
                                <label>Search
                                    <input v-model="search"
                                           type="search"
                                           class="form-control"
                                           placeholder="What You Find ?"
                                           aria-controls="DataTables_Table_0">
                                </label>
                            </div>
                        </div>
                    </div>

                    <table class="order-list-table table">
                        <thead class="table-light">
                        <tr class=null>
                            <th class="sorting">Id</th>
                            <th class="sorting">price</th>
                            <th class="sorting">Order Status</th>
                            <th class="sorting">Payment Method</th>
                            <th class="sorting">Payment Status</th>
                            <th class="sorting"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders.data" :key="order.id">
                            <td>#{{$page.props.auth.APP_NAME+"_"+ order.item.id }}</td>
                            <td>
                                {{ order.item.cart_total_price }} ৳
                            </td>
                            <td>
                                <span class="badge bg-light-primary">{{ order.item.order_status }}</span>
                            </td>
                            <td>{{ order.item.payment_method }}</td>

                            <td>
                                <span class="badge bg-light-primary">{{ order.item.payment_status }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <Pagination :links="orders.links" :from="orders.from" :to="orders.to" :total="orders.total"/>
                </div>
            </div>
        </section>

    </Layout>
</template>
