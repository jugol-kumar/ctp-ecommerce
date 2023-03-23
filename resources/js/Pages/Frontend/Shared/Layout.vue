<script setup>
import TopHeader from "../../Frontend/Shared/TopHeader.vue"
import Header from "../../Frontend/Shared/Header.vue"
import HeaderMenu from "../../Frontend/Shared/HeaderMenu.vue"
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import {ref} from 'vue'
import CardCarosel from "../../../components/CardCarousel.vue";
import ProductCarousel from "../Modules/ProductCarousel.vue";
import AdsSection from "../Modules/AdsSection.vue";
import MainFooter from "./MainFooter.vue";


const props = defineProps({
    parentCategories:[]|null,
    featuredCategories:[]|null,
    topCategories:[]|null,
    featuredBrands:[]|null,
})

const sliders = ref({pagination:false, navigation:false,})


</script>
<template>

    <TopHeader/>
    <Header/>
    <HeaderMenu :categories="props.parentCategories"/>


    <!-- BEGIN: Content-->
    <div class="container">
        <div class="content-wrapper container-fluid p-0">
            <div class="content-body">
                <slot/>
            </div>
        </div>
    </div>


    <main-footer/>

    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>


    <button class="btn btn-primary btn-icon scroll-top" type="button">
        <vue-feather type="arrow-up"/>
    </button>
    <!-- END: Footer-->

</template>
<style scoped>
</style>
