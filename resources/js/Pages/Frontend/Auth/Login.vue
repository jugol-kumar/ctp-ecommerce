<script setup>
    import {ref} from 'vue'
    import Layout from "../Shared/Layout.vue";
    import {useForm} from "@inertiajs/inertia-vue3";

    const props = defineProps({
        login_url:null,
        reg_url: null,
        errors:Object|null,
    })


    const changeViewRef = ref(true);
    const changeForm = (status) =>{
        changeViewRef.value = status;
        console.log("call here")
    }

    const isLoading = ref(false);
    const regFormData = useForm({
        username:null,
        phone:null,
        password:null,
        remember:null,
    });
    const loginFormData = useForm({
        email:"cm@cm.com",
        password:"12345678",
        remember:null,
    });




    const validUser = (type) =>{
        if (type === 'login') {
            loginFormData.post(props.login_url, {
                preserveState: true,
                replace: true,
                onStart: res => {
                    console.log("res " + res)
                    isLoading.value = true;
                },
                onSuccess: page => {
                    document.getElementById('addItemModal').$vb.modal.hide()
                    isLoading.value = false;
                    loginFormData.reset();
                    $sToast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                },
                onError: errors => {
                    console.log(errors)
                    isLoading.value = false;
                    $toast.error(errors.message)
                }
            });
        }
    }




</script>

<template>
    <Layout>
        <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white shadow rounded">
                        <div class="row mt-5">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form @submit.prevent="validUser('login')" class="row g-1" v-if="changeViewRef">

                                        <span class="text-danger">{{ props.errors.message }}</span>
                                        <h2 class="bg-white p-2 border-start-primary border-start-3" style="border-left-width: 5px !important;">Login Here...</h2>
                                        <div class="col-12">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <vue-feather type="phone"/>
                                                </div>
                                                <input type="email" v-model="loginFormData.email" class="form-control" placeholder="Enter Phone Number">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <vue-feather type="user"/>
                                                </div>
                                                <input type="password" class="form-control" v-model="loginFormData.password" placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" v-model="loginFormData.remember" type="checkbox" id="login">
                                                <label class="form-check-label" for="login">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            Don't Have Account?
                                            <strong @click="changeForm(false)" class="text-primary cursor-pointer">Click Here</strong>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4" :disabled="isLoading">login</button>
                                        </div>
                                    </form>


                                    <form @submit.prevent="registration" class="row g-1" v-if="!changeViewRef">
                                        <h2 class="bg-white p-2 border-start-primary border-start-3" style="border-left-width: 5px !important;">Register Here...</h2>
                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <vue-feather type="user"/>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter Username">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Phone Number<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <vue-feather type="phone"/>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter Phone Number">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <vue-feather type="user"/>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            Already Have An Account?
                                            <strong @click="changeForm(true)" class="text-primary cursor-pointer">Click Here</strong>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="bi bi-bootstrap"></i>
                                    <h2 class="fs-1">Welcome Back!!!</h2>
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
