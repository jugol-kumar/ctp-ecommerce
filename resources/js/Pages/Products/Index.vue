<script setup>
import layout from "../../Shared/Layout.vue";
const props = defineProps({
    products:[]|null,
})

</script>

<template>
    <layout>

        <div class="content-header row mb-1">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <h2 class="float-start mb-0">Product List</h2>
                <a class="btn btn-sm btn-gradient-primary d-flex align-items-center"
                   :href="`${this.$page.props.auth.ADMIN_URL}/product/create`"
                   target="_blank"
                   type="button">
                    <vue-feather type="plus" size="15"/>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>
        <section class="app-user-list">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <div class="d-flex justify-content-between align-items-center header-actions mx-0 row mt-75">
                        <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                            <div class="select-search-area">
                                <label>Show <select class="form-select" v-model="perPage">
                                    <option :value="undefined">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                            <div
                                class="d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                <div class="select-search-area">
                                    <input v-model="search"
                                        type="search"
                                        class="form-control"
                                        placeholder="Search..."
                                        aria-controls="DataTables_Table_0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="user-list-table table">
                        <thead class="table-light">
                        <tr class="">
                            <th class="sorting">Name</th>
                            <th class="sorting">Role</th>
                            <th class="sorting">Active on</th>
                            <th class="sorting">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, key) in products" :key="`item-${key}`">
                                <td>{{ item.user.name }}</td>
                                <td>{{ item.category.title }}</td>
                                <td>{{ item.brand.name }}</td>
                                <td>{{ item.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </layout>
</template>
