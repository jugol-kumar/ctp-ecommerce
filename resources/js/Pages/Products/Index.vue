<script setup>
import layout from "../../Shared/Layout.vue";


</script>

<template>
    <layout>
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="float-start mb-0">Admin List</h2>
                    </div>
                </div>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </layout>
</template>
