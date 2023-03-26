<script setup>

    import {useDataStore} from "../../../Store/useDataStore";
    import {onMounted} from "vue";

    defineProps({
        categories:Array
    })

    const store = useDataStore();

    onMounted(() =>{
        store.initTopCategories();
        store.initFeaturedCategories();
    })



</script>


<template>
    <nav class="header-navbar navbar align-items-center navbar-light border-top zindex-1 header-shadow">
        <div class="container">
            <div class="navbar-container d-flex content">
                <a href="" class="btn btn-primary d-flex align-items-center" data-bs-toggle="dropdown">
                    <vue-feather type="menu"/>
                    <span class="ms-1">Categories menu change</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-start zindex-1 py-0">
<!--                    :style="{ backgroundImage: 'url(' + category.banner + ')' }" for backdrop filter background style -->
                    <li class="scrollable-container media-list"  v-for="category in store.getTopCategories" :key="`item-${category.id}`">
                        <a class="d-flex" href="#">
                            <div class="list-item border-bottom d-flex align-items-start">
                                <div class="me-1">
                                    <img :src="category.icon" alt="avatar" width="32" height="32">
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading">
                                        <span class="fw-bolder text-capitalize">{{ category.title }}</span>
                                    </p>
                                </div>
                                <span v-if="category.childrens.length > 0">
                                    <vue-feather type="chevron-right"/>
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item" v-for="item in store.getTopCategories">
                                    <a class="nav-link text-capitalize fw-bolder fs-3 text-black mx-2" href="#">{{ item.title }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </nav>
</template>
<style scoped>
    .header-shadow{
        box-shadow: 0px -2px 31px -1px #8080806e;
    }
</style>
