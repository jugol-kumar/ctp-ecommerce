<script setup>
    import TopHeader from "../Frontend/Shared/TopHeader.vue"
    import Header from "../Frontend/Shared/Header.vue"
    import HeaderMenu from "../Frontend/Shared/HeaderMenu.vue"

    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
    import {ref} from 'vue'
    import CardCarosel from "../../components/CardCarousel.vue";
    import ProductCarousel from "./Modules/ProductCarousel.vue";
    import AdsSection from "./Modules/AdsSection.vue";
    import Layout from "./Shared/Layout.vue";
    const props = defineProps({

        featuredCategories:[]|null,
        featuredBrands:[]|null,
        homeCategory:[]|null,
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

                <a :href="`${$page.props.auth.MAIN_URL}/products?brand=${brand.slug}`">
                    <div class="card brand-card" v-c-tooltip="brand.name">
                        <div class="card-body">
                            <img :src="brand.icon" class="card-img-top" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row match-height my-5" v-for="(category, index) in  props.homeCategory" :key="category.id">
            <h2 class="text-capitalize" v-if="category.products.length > 0" v-text="category.title"></h2>
            <product-carousel v-if="category.products.length > 0" :products="category.products"/>
        </div>
    </section>
    </Layout>
</template>

</style>
