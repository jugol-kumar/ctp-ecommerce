<script setup>
import layout from "../../Shared/Layout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import debounce from "lodash/debounce";
import {computed, onMounted, ref, watch} from 'vue';
import Offcanvas from "../../components/Offcanvas.vue";
import {Inertia} from "@inertiajs/inertia";
import {useSlug} from '../../Composables/useSlug.js'
import {Tooltip} from 'bootstrap'
import ImageUploader from "../../components/ImageUploader.vue";
const slugTitle = useSlug();

const props = defineProps({
    categories:[] | null,
    main_url:String | null,
});

const createForm = useForm({
    title: null,
    parent_id:null,
    order_level:null,
    icon:null,
    banner:null,
});

const isLoading = ref(false);

createForm.post(props.main_url,{

});


const slug = computed(() =>{
    const a = 'àáäâèéëêìíïîòóöôùúüûñçßÿỳýœæŕśńṕẃǵǹḿǘẍźḧ'
    const b = 'aaaaeeeeiiiioooouuuuncsyyyoarsnpwgnmuxzh'
    const p = new RegExp(a.split('').join('|'), 'g')
    const ampersand = 'and'
    if (createForm.title != null){
        return createForm.title.toString().toLowerCase()
            .replace(/[\s_]+/g, '-')
            .replace(p, c =>
                b.charAt(a.indexOf(c)))
            .replace(/&/g, `-${ampersand}-`)
            .replace(/[^\w-]+/g, '')
            .replace(/--+/g, '-')
            .replace(/^-+|-+$/g, '')
    }
})







const search = ref(null);
const perPage = ref(null);

watch([search, perPage], debounce(function ([val, val2]) {
    Inertia.get(props.main_url, { search: val, perPage: val2 }, { preserveState: true, replace: true });
}, 300));

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
                    <label class="form-label">Title</label>
                    <input class="form-control"
                            v-model="createForm.title"
                           type="text" placeholder="e.g latest faction"/>
                </div>
<!--
                <div class="mb-1">
                    <label>Slug</label>
                    <input v-model="createForm.slug" type="text" class="form-control" disabled>
                </div>
-->

                <div class="mb-1">
                    <div class="d-flex align-baseline">
                        <label>Parent Category</label> <info title="If you want to add this category as a child then select an parent category"/>
                    </div>
                    <vSelect :options="props.categories" v-model="createForm.parent_id" label="title" :redius="category => category.id" placeholder="Select Me As Parent"/>
                </div>

                <div class="mb-1">
                    <label>Slug</label>
                    <select class="form-control form-select">
                        <option disabled selected>Select Category Type</option>
                        <option value="physical">Physical</option>
                        <option value="digital">Digital</option>
                    </select>
                </div>

                <div class="mb-1">
                    <label>Order Number</label> <info title="Low number order level coming first"/>
                    <input type="number" v-model="createForm.order_level" class="form-control" placeholder="Low Number Height Priority">
                </div>

                <div class="mb-1">
                    <label>Icon Image</label> <info title="Low number order level coming first"/>
                    <ImageUploader v-model="createForm.icon" />
                </div>

                <div class="mb-1">
                    <label>Banner Image</label> <info title="Low number order level coming first"/>
                    <ImageUploader v-model="createForm.banner" />
                </div>

                <div class="d-flex flex-wrap mb-0">
                    <button v-if="!isLoading" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    <button v-else class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <button type="reset" class="btn btn-outline-secondary ms-1">Cancel</button>
                </div>
            </form>
        </Offcanvas>
    </layout>
</template>
