<script setup>
    import Layout from "../Shared/Layout.vue";
    import {useForm} from "@inertiajs/inertia-vue3";
    import {ref} from 'vue'
    import ProductCard from "../Modules/ProductCard.vue";
    import {useWishListStore} from "../../../Store/useWishListStore";
    import {useCartStore} from "../../../Store/useCartStore";

    const store = useWishListStore();
    const cartStore = useCartStore();
    const props = defineProps({
        orders:[]|null,
        success:String|null,
    })

    const formData = useForm({
        name:null,
        email:null,
        phone:null,
    })

    const authData = useForm({
        current:null,
        new:null,
        confirmed:null,
    })
    const isLoading = ref(false)
    const updateCustomerProfile = () => {
        formData.post('/update-user-profile', {
            preserveState: true,
            replace: true,
            onStart: res => {
                isLoading.value = true;
            },
            onSuccess: page => {
                isLoading.value = false;
                formData.reset();
                $sToast.fire({
                    icon: 'success',
                    title: page.props.info.message,
                })
            },
            onError: errors => {
                document.getElementById('actionModal').$vb.modal.hide()
                isLoading.value = false;
                $toast.error("Validation Errors...")
            }
        })
    }

    const passIsLoad = ref(false);
    const updateCustomerPassword = () =>{
        authData.post('/update-user-credentials', {
            preserveState: true, replace: true,
            onStart: res => passIsLoad.value = true,
            onSuccess: page => {
                passIsLoad.value = false;
                formData.reset();
            },
            onError: errors => $toast.error(errors)
        })
    }

    const wishListToCart= (item) =>{
        cartStore.addToCart(item);
        // store.removeFromWishList(item);
        // $toast.success("Moved Wishlist To Cart...")
    }


</script>

<template>
    <Layout>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-body">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                        aria-selected="true">Home</button>
                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-profile" type="button" role="tab"
                                        aria-controls="v-pills-profile" aria-selected="false">Orders</button>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-messages" type="button" role="tab"
                                        aria-controls="v-pills-messages" aria-selected="false">Watch List</button>
                                <a :href="$page.props.auth.MAIN_URL+'/logout'" class="nav-link">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 ms-1">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="text-center">
                                <div class="avatar">
                                    <img src="../../../../images/logo.png" alt="" width="60">
                                </div>
                                <h2>{{ $page.props.auth.user.name }}</h2>
                                <small>{{ $page.props.auth.user.email }}</small>
                                <p>{{ $page.props.auth.user.phone }}</p>
                            </div>

                            <div class="row">
                                <div class="card shadow-sm col-md-6">
                                    <div class="card-body">
                                        <form @submit.prevent="updateCustomerProfile">
                                            <div>
                                                <label>Name</label>
                                                <input class="form-control" type="text" v-model="formData.name" placeholder="e.g jhon doh">
                                            </div>
                                            <div>
                                                <label>Email</label>
                                                <input class="form-control" type="text" v-model="formData.email" placeholder="e.g jhon.doh@ctpbd.com">
                                            </div>
                                            <div>
                                                <label>Phone</label>
                                                <input class="form-control" type="text" v-model="formData.phone" placeholder="e.g +8801*** - ********">
                                            </div>
                                            <button type="submit" :disabled="isLoading" class="btn btn-sm btn-primary mt-1">Update Profile</button>
                                        </form>
                                    </div>
                                </div>


                                <div class="card shadow-sm col-md-6">
                                    <div class="card-body">
                                        <form @submit.prevent="updateCustomerPassword">
                                            <div>
                                                <label>Current Password</label>
                                                <input class="form-control" type="password" v-model="authData.current" placeholder="This Password I'm Use Now">
                                            </div>
                                            <div>
                                                <label>New Password</label>
                                                <input class="form-control" type="password" v-model="authData.new" placeholder="This Is My New Password">
                                            </div>
                                            <div>
                                                <label>Confirmed Password</label>
                                                <input class="form-control" type="password" v-model="authData.confirmed"  placeholder="I'm Confirmed. It's Current  Password">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary mt-1">Update Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h2>All Orders</h2>

                            <table class="table table-striped table-borderless">
                                <thead>
                                    <th class="p-1">OrderId</th>
                                    <th class="p-1">Total Price</th>
                                    <th class="p-1">Payment Method</th>
                                    <th class="p-1">Payment Status</th>
                                    <th class="p-1">Order Status</th>
                                </thead>

                                <tbody>
                                    <tr v-for="item in props.orders.orders" :key="item.id">
                                        <td>#laravel_{{ item.id }}</td>
                                        <td>{{ item.cart_total_price }} ৳</td>
                                        <td>{{ item.payment_method }}</td>
                                        <td>
                                            <span class="badge bg-light-primary">
                                                {{ item.payment_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-primary">
                                                {{ item.order_status }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h2>Wish List Product's</h2>
                            <div class="row">
                                <div class="col-md-4" v-for="item in store.getWishListItems" :key="item.id">
                                    <div class="card">
                                        <div class="card-body">
                                            <button class="btn btn-icon rounded-circle btn-outline-primary waves-effect d-flex align-items-center justify-content-center float-end" @click="wishListToCart(item)">
                                                <vue-feather type="shopping-cart" size="15"/>
                                            </button>
                                            <div class="item-img overflow-hidden">
                                                <img class="img-fluid card-img-top p-2" style="max-height: 250px" :src="item.thumbnail" alt="img-placeholder">
                                            </div>
                                            <div class="text-start p-1 zindex-1 match-height">
                                                <h2>
                                                    <a class="text-primary" :href="`${$page.props.auth.MAIN_URL}/product/single-product/${item.slug}`">{{ item.title.slice(0, 28) }}</a>
                                                </h2>
                                                <h6 class="item-price">{{ item.price}} ৳</h6>
                                                <p class="card-text  item-description" v-html="`${item.description.slice(0, 50)}...`"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </Layout>
</template>



<style scoped>

</style>
