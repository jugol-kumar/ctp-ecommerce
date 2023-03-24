<script setup>
    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
    import {ref} from 'vue'
    import CardCarosel from "../../components/CardCarousel.vue";
    import ProductCarousel from "./Modules/ProductCarousel.vue";
    import AdsSection from "./Modules/AdsSection.vue";
    import Layout from "./Shared/Layout.vue";
    const props = defineProps({
        parentCategories:[]|null,
        featuredCategories:[]|null,
        topCategories:[]|null,
        featuredBrands:[]|null,
    })

    const sliders = ref({pagination:false, navigation:false,})
</script>

<template>
    <Head title="Home Page">

    </Head>
    <Layout>
        <section id="dashboard-ecommerce">
        <div class="row match-height my-2">
            <div class="col-xl-12 col-md-12 col-12">
                <Carousel>
                    <Slide v-for="slide in 10" :key="slide">
                        <div class="carousel__item">
                            <img src="../../../images/banner-6.jpg" alt="">
                        </div>
                    </Slide>
                    <template #addons>
                        <Navigation v-if="sliders.navigation"/>
                        <Pagination v-if="sliders.pagination"/>
                    </template>
                </Carousel>
            </div>
        </div>


        <div class="row match-height mb-2">
            <div class="col-12">
                <h2>Featured Categories</h2>
                <CardCarosel :categories="props.featuredCategories"/>
            </div>
        </div>

        <AdsSection/>

        <div class="row match-height mb-2">
            <div class="col-md-2" v-for="brand in props.featuredBrands">
                <div class="card brand-card" v-c-tooltip="brand.name">
                    <div class="card-body">
                        <img :src="brand.icon" class="card-img-top" alt="">
                    </div>
                </div>
            </div>
        </div>


        <div class="row match-height my-5" v-for="(category, index) in  props.topCategories" :key="category.id">
            <AdsSection v-if="index % 2 !== 0"/>

            <h2 class="text-capitalize" v-if="category.products.length > 0" v-text="category.title"></h2>
            <product-carousel v-if="category.products.length > 0" :products="category.products"/>
        </div>
    </section>
    </Layout>
</template>

<style scoped>

/*.carousel__item {*/
/*    min-height: 400px;*/
/*    width: 100%;*/
/*    background-color: var(--vc-clr-primary);*/
/*    color: var(--vc-clr-white);*/
/*    font-size: 20px;*/
/*    border-radius: 8px;*/
/*}*/

/*.carousel__item img{*/
/*    width: 100%;*/
/*    height: 100%;*/
/*}*/

</style>
