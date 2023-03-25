<script setup>
import layout from "../../Shared/Layout.vue";
import {ref} from 'vue'
import Pagination from "../../components/Pagination.vue";

const props = defineProps({
    products:[]|null,
})

const listView = ref(false)
const showList = (e) => {
    listView.value = true;
    var $gridCont = document.getElementById('productView');
    $gridCont.classList.add('list-view');
}
const gridList = (e) => {
    listView.value = false;
    var $gridCont = document.getElementById('productView');
    $gridCont.classList.remove('list-view');
}
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
            <div class="row">
                <div class="col-md-3">
                    <h2>Filters</h2>
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span>{{ products.total }} results found</span>

                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button class="btn btn-outline-primary" @click="gridList">
                                <vue-feather type="grid" size="10"/>
                            </button>
                            <button  class="btn btn-outline-primary" @click="showList">
                                <vue-feather type="list" size="10"/>
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body p-0 position-relative d-flex align-items-center">
                            <input type="text" class="form-control p-1 border-0" placeholder="what your looking for ...">
                            <span class="position-absolute" style="right: 20px;top: 16px;color: #c7c7cf;">
                                <vue-feather type="search" size="18"/>
                            </span>
                        </div>
                    </div>
                    <div class="container grid-container" id="productView">
                        <div class="row match-height">
                            <div class="col-12 col-md-6 col-lg-4 product-card-hover" v-for="item in products.data" :key="'item-'+item.id">
                                <div class="card ecommerce-card position-relative">
                                    <div class="item-img text-center">
                                        <a href="#">
                                            <img class="img-fluid card-img-top p-2" style="max-height: 250px" :src="item.thumbnail" alt="img-placeholder"></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group dropstart position-absolute" style="border: none; background: inherit;top: 9px !important;right: 4px !important;">
                                            <button class="border-0 bg-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <vue-feather type="more-vertical" />
                                            </button>

                                            <div class="dropdown-menu p-0 dropstart" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item d-flex align-items-center text-info w-100" type="button">
                                                    <vue-feather type="edit" size="15"/>
                                                    <span class="ms-1">Edit</span>
                                                </button>
                                                <button class="dropdown-item d-flex align-items-center text-danger w-100" type="button" @click="deleteItem(item.id)">
                                                    <vue-feather type="trash" size="15"/>
                                                    <span class="ms-1">Delete</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="item-wrapper d-flex align-items-center justify-content-between">
                                            <div class="item-rating">
                                                <ul class="unstyled-list list-inline">
                                                    <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                    <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                    <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                    <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                    <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star unfilled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h6 class="item-price">$339.99</h6>
                                            </div>
                                        </div>

                                        <h6 class="item-name">
                                            <a class="text-body text-capitalize pb-1 d-block" href="app-ecommerce-details.html">{{ item.title.slice(0, 25)+"..." }}</a>
                                            <span class="card-text item-company d-block" v-if="listView">
                                                By
                                                <a href="#" class="company-name">{{ item.category.title }}</a>
                                            </span>
                                        </h6>
                                        <p class="card-text item-description" v-html="`${item.description.slice(0, 50)}...`"></p>
                                    </div>
<!--                                    <div class="card-footer p-0 d-flex">
                                        <a href="" class="btn btn-primary waves-effect waves-float waves-light flex-grow-1" style="border-radius: 0 0 5px 5px">Details</a>
                                    </div>-->
                                </div>
                            </div>
                            <Pagination :links="products.links" :from="products.from" :to="products.to" :total="products.total" notShowNumber/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </layout>
</template>

<style lang="scss">
.card {
    margin-bottom: 1rem;
}

.list-view {
    .row {
        > [class*='col-'] {
            max-width: 100%;
            flex: 0 0 100%;
        }
    }
    .card {
        @media (max-width: 575.98px) {
            flex-direction: column;
        }
        flex-direction: row;
        > .card-img-top {
            width: auto;
        }

        .card-body {
            display: inline-block;
        }
    }
}

.ecommerce-application .grid-view .ecommerce-card .item-img {
    padding-top: 0.5rem;
    min-height: 15.85rem;
    display: flex;
    align-items: center;
}

.product-card-hover{
    transition: 0.1s all ease;
}
.product-card-hover:hover {
    scale: 1.02;
}
.product-card-hover:hover .card{
    box-shadow: 0 4px 15px 0 rgb(57 57 70 / 53%);
}

</style>
