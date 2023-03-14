<script setup>
import layout from "../../Shared/Layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import debounce from "lodash/debounce";
import {computed, ref, watch} from 'vue';
import Offcanvas from "../../components/Offcanvas.vue";

const props = defineProps({
    info: Object,
    filters:Object,
});
const createForm = useForm({
    title: "",
    payment_id:null,
    pay_amount:null,
    discount:null,
    payment_note:null,
})
const search = ref(null);
const perPage = ref(null);

watch([search, perPage], debounce(function ([val, val2]) {
    Inertia.get(props.main_url, { search: val, perPage: val2 }, { preserveState: true, replace: true });
}, 300));



const slug = computed(() =>{
    const a = 'àáäâèéëêìíïîòóöôùúüûñçßÿỳýœæŕśńṕẃǵǹḿǘẍźḧ'
    const b = 'aaaaeeeeiiiioooouuuuncsyyyoarsnpwgnmuxzh'
    const p = new RegExp(a.split('').join('|'), 'g')
    const ampersand = 'and'
    return createForm.title.toString().toLowerCase()
        .replace(/[\s_]+/g, '-')
        .replace(p, c =>
            b.charAt(a.indexOf(c)))
        .replace(/&/g, `-${ampersand}-`)
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-')
        .replace(/^-+|-+$/g, '')
})




</script>

<template>
    <layout>
        <div class="content-header row mb-1">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <h2 class="float-start mb-0">Category List</h2>
                <button class="btn btn-sm btn-gradient-primary d-flex align-items-center"
                        type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#categoryCanvas"
                        aria-controls="categoryCanvas">
                    <vue-feather type="plus" size="15"/>
                    <span>Add New Category</span>
                </button>
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

        <Offcanvas title="Add Category" id="categoryCanvas">
            <form @submit.prevent="addPayment">
                <div class="mb-1">
                    <label class="form-label" for="amount">Title</label>
                    <input class="form-control"
                           v-model="createForm.title"
                           type="text" placeholder="e.g latest faction"/>
                </div>
                <div class="mb-1">
                    <label>Slug:</label>
                    <input :value="slug" type="text" class="form-control" disabled>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="amount">Payment Amount</label>
                    <input id="amount" class="form-control"
                           v-model="createForm.pay_amount"
                           type="number" placeholder="Enter Payment Amount"/>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="payment-note">Internal Payment Note</label>
                    <textarea class="form-control" id="payment-note"
                              v-model="createForm.payment_note" rows="5"
                              placeholder="Internal Payment Note"></textarea>
                </div>

                <div class="d-flex flex-wrap mb-0">
                    <button type="submit" class="btn btn-primary me-1" data-bs-dismiss="modal">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </form>
        </Offcanvas>


    </layout>
</template>
