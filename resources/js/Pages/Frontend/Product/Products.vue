<script setup>
import layout from "../Shared/Layout.vue";
import Pagination from "../../../components/Pagination.vue";
import TreeView from "../../../components/TreeView.vue";
import {ref} from 'vue'

const props = defineProps({
    products:[]|null,
    categories:[]|null,
    brands:[]|null,
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

        <section class="app-user-list my-5">
            <div class="row">
                <div class="col-md-3 mt-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>Filters</h2>
                        <a class="border-bottom" href="/products">clear filters</a>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h3>Categories</h3>
                            <TreeView :nodes="categories"/>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h3>Brand</h3>

                            <ul class="list-group py-0">
                                <li class="list-group-item scrollable-container media-list border-0 border-bottom cursor-pointer"
                                    v-for="brand in brands" :key="brand.id">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <img :src="brand.icon" alt="avatar" width="32" height="32">
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <a :href="`${$page.props.auth.MAIN_URL}/products?brand=${brand.slug}`"
                                               class="fw-bolder text-capitalize">{{ brand.name }}</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
                            <div class="col-md-9 position-relative">
                                <input type="text" class="form-control p-1 border-0" placeholder="what your looking for ...">
                                <span class="position-absolute" style="right: 20px;top: 16px;color: #c7c7cf;">
                                    <vue-feather type="search" size="18"/>
                                </span>
                            </div>

                            <div class="col-md-3">
                                <select name="" id="" class="form-control border-0 shadow-none">
                                    <option value="">Order by oldest</option>
                                    <option value="">Order by oldest</option>
                                    <option value="">Order by oldest</option>
                                    <option value="">Order by oldest</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="container grid-container" id="productView">
                        <div class="row match-height">
                            <div class="col-12 col-md-6 col-lg-4 product-card-hover" v-for="item in products.data" :key="'item-'+item.id">
                                <div class="card ecommerce-card position-relative">
                                    <div class="item-img overflow-hidden">
                                        <img class="img-fluid card-img-top p-2" style="max-height: 250px" :src="item.product.thumbnail" alt="img-placeholder">
                                    </div>
                                    <div class="text-start p-1 zindex-1 match-height">
                                        <h2>
                                            <a class="text-primary" :href="`${$page.props.auth.MAIN_URL}/product/single-product/${item.product.slug}`">{{ item.product.title.slice(0, 28) }}</a>
                                        </h2>
                                        <h6 class="item-price">{{ item.product.price }} ৳</h6>
                                        <p class="card-text  item-description" v-html="`${item.product.description.slice(0, 50)}...`"></p>
                                    </div>
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

.ecommerce-card{
    box-shadow: 0 0px 14px -1px rgb(34 41 47 / 32%) !important;
    margin-top: 18px !important;
    transition: 0.3s all ease;
    flex: 1 1 auto;
    overflow: hidden;
}

.ecommerce-card img{
    transition: 0.3s all ease;
}
.ecommerce-card:hover{
    box-shadow: 0 0px 14px 2px rgb(34 41 47 / 54%) !important;
    transform: scale(1.04);
}

.ecommerce-card:hover .item-name a{
    color: var(--bs-primary);
}
.ecommerce-card:hover img{
    transform: scale(1.4);
}

</style>
