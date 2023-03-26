<script setup>
    import Layout from "../../Frontend/Shared/Layout.vue";
    const props = defineProps({
        order:Object|null,
    })
</script>
<template>
    <Layout>
        <div class="row my-5">
            <div class="col-12 col-lg-8 text-center mb-3 mx-auto">
                <h4 class="mt-2">Thank You! 😇</h4>
                <p>For you ordering. we will response you as soon as possible for conform your order.</p>
                <a :href="$page.props.auth.MAIN_URL+'/dashboard'" class="btn round btn-outline-primary">My Dashboard</a>
            </div>
        </div>
    </Layout>
</template>


<style scoped>

</style>
