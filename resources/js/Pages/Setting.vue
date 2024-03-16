<template>
    <Head title="Dashboard" />
    <Layout>
    <section class="app-dashboard">
        <div class="card">
            <div class="card-body border-bottom">
                <div class="card card-statistics">
                    <div class="card-header">
                        <vue-notification-list></vue-notification-list>
                        <h4 class="card-title">Settings</h4>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills me-3 border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <Link class="nav-link active"
                                          id="v-pills-home-tab"
                                          data-bs-toggle="pill"
                                          data-bs-target="#v-pills-home"
                                          type="button" role="tab"
                                          aria-controls="v-pills-home"
                                          aria-selected="true">Frontend Setting</Link>

                                    <button class="nav-link" id="v-pills-profile-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile"
                                            type="button" role="tab"
                                            aria-controls="v-pills-profile"
                                            aria-selected="false">Profile</button>
                               <!--     <button class="nav-link" id="v-pills-socials-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-socials"
                                            type="button" role="tab"
                                            aria-controls="v-pills-socials"
                                            aria-selected="false">Social Links</button>
-->
                                    <!--           <button class="nav-link"
                                            id="v-pills-sms_api-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-sms_api"
                                            type="button" role="tab"
                                            aria-controls="v-pills-sms_api"
                                            aria-selected="false">API Setup</button>
                                    <Link class="nav-link" :href="`${this.$page.props.ADMIN_URL}/admin-profile`">Profile Settings</Link>
-->
                                    <button class="nav-link"
                                            id="v-pills-messages-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-messages"
                                            type="button" role="tab"
                                            aria-controls="v-pills-messages"
                                            aria-selected="false">Apprience</button>


                                    <button class="nav-link"
                                            id="v-pills-shipping_api-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-shipping"
                                            type="button" role="tab"
                                            aria-controls="v-pills-shipping"
                                            aria-selected="false">Shipping Setup</button>



                                    <button class="nav-link"
                                            id="v-pills-home_cats-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home_cats"
                                            type="button" role="tab"
                                            aria-controls="v-pills-home_cats"
                                            aria-selected="false">Home Categories</button>

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="card">
                                            <h2>Frontend Setup</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input class="form-control mb-1" type="text" v-model="createForm.name" label="App Name" placeholder="App Name" />
                                                        </div>
                                                        <div class="col-12">
                                                            <textarea class="form-control mb-1" v-model="createForm.app_details" placeholder="e.g Discribe some details about your application..."></textarea>
                                                        </div>


                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>


                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="card">
                                            <h2>App Profile</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input  type="text" class="form-control mb-1" v-model="createForm.address" label="App Address" placeholder="Address" />
                                                        </div>

                                                        <div class="col-12">
                                                            <input type="email" class="form-control mb-1" v-model="createForm.email" label="App Email" placeholder="example@yourdomain.com" />
                                                        </div>

                                                        <div class="col-12">
                                                            <input type="text" class="form-control mb-1" v-model="createForm.phone" label="App Number" placeholder="+8801*-******" />
                                                        </div>

                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>


                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <!--    <div class="tab-pane fade" id="v-pills-socials" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <div class="card">
                                            <h2>App Profile</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.facebook_profile" label="Facebook" placeholder="fb.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.google_drive" label="Google Drive" placeholder="drive.google.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.youtube" label="Youtube" placeholder="chanel.youtube.com/my-changel" />
                                                        </div>


                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.linkedin_profile" label="Linkedin" placeholder="linkedin.com/me" />
                                                        </div>


                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.twitter_profile" label="Twitter" placeholder="twitter.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <input type="text" v-model="createForm.instagram_profile" label="Instagram" placeholder="instagram.com/me" />
                                                        </div>


                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">

                                                            &lt;!&ndash;                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">&ndash;&gt;
                                                            &lt;!&ndash;                                                                <div class="spinner-border text-white me-1"  role="status"></div>&ndash;&gt;
                                                            &lt;!&ndash;                                                                <span>Submit</span>&ndash;&gt;
                                                            &lt;!&ndash;                                                            </button>&ndash;&gt;


                                                            <button class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!--      <div class="tab-pane fade" id="v-pills-sms_api" role="tabpanel" aria-labelledby="v-pills-sms_api-tab">
                                              <div class="card">
                                                  <h2>SMS API Credentials</h2>
                                                  <div class="card-body">
                                                      <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                          <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="row">
                                                                      <div class="col-12">
                                                                          <input type="text" v-model="createForm.api_url" label="API URL" placeholder="http://66.45.237.70/api.php" />
                                                                      </div>

                                                                      <div class="col-12">
                                                                          <input type="text" v-model="createForm.api_user_name" label="API User Name" placeholder="e.g user name" />
                                                                      </div>

                                                                      <div class="col-12">
                                                                          <input type="text" v-model="createForm.api_user_pass" label="Api User Password" placeholder="e.g password" />
                                                                      </div>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <table class="table table-bordered table-striped">
                                                                      <tbody>
                                                                          <tr>
                                                                              <th>Status</th>
                                                                              <th>Message</th>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1101</td>
                                                                              <td>Success</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1000</td>
                                                                              <td>Invalid user or Password</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1002</td>
                                                                              <td>Empty Number</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1003</td>
                                                                              <td>Invalid message or empty message</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1004</td>
                                                                              <td>Invalid number</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1005</td>
                                                                              <td>All Number is Invalid</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1006</td>
                                                                              <td>insufficient Balance</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1009</td>
                                                                              <td> Inactive Account</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>1010</td>
                                                                              <td>Max number limit exceeded</td>
                                                                          </tr>
                                                                      </tbody>
                                                                  </table>
                                                              </div>


                                                              <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                                  <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                      <div class="spinner-border text-white me-1"  role="status"></div>
                                                                      <span>Submit</span>
                                                                  </button>
                                                                  <button class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                      Submit
                                                                  </button>
                                                                  <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                              </div>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
      -->
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="card">
                                            <h2>Frontend Setup</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateLogo()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.header_logo" :showFile="props.bSettings.header_logo" label="Header Logo"/>
                                                        </div>
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.footer_logo" :showFile="props.bSettings.footer_logo" label="Footer Logo"/>
                                                        </div>
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.fevicon_logo" :showFile="props.bSettings.fevicon_logo" label="Favicon"/>
                                                        </div>

<!--                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Text Color</label> <small class="text-info">(Must Be HEXA Color. like #fefefe)</small>
                                                                 <Text type="color" v-model="logoForm.textColor" class="form-control form-control-color"/>
                                                            </div>
                                                            <div class="col">
                                                                <label>Main Color</label> <small class="text-info">(This is rgb color code rgb(255,255,255))</small>
                                                                <Text type="color" v-model="logoForm.mainColor" class="form-control form-control-color"/>
                                                            </div>
                                                            <div class="col">
                                                                <label>Light Color</label> <small class="text-info">(This is rgb color code rgb(255,255,255))</small>
                                                                <Text type="color" v-model="logoForm.lightColor"  class="form-control form-control-color"/>
                                                            </div>
                                                        </div>-->

                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping_api-tab">
                                        <div class="card">
                                            <h2>Shipping Setting</h2>
                                            <div class="card-body d-flex justify-content-around">
                                                <div class="row">
                                                    <div class="col">
                                                        <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                            <div class="row">
                                                                <div class="">
                                                                    <label class="label card-text">Shipping Config</label>
                                                                    <select v-model="createForm.shippingType" @change="shiConfig" class="form-control form-select">
                                                                        <option value="null" disabled>Select Sipping Type</option>
                                                                        <option value="f">Free Shipping</option>
                                                                        <option value="p">Product Wish</option>
<!--                                                                        <option value="c">City Wise</option>-->
                                                                    </select>
                                                                </div>

                                                                <div class="d-flex align-items-center mt-1" v-if="shippingStatus === 'p'">
                                                                    <input type="text" class="form-control" v-model="createForm.inSizeDhaka" placeholder="Inside Dhaka" style="border-radius: 5px 0 0 5px;">
                                                                    <input type="text" class="form-control" v-model="createForm.outSizeDhaka" placeholder="Outside Dhaka" style="border-left: 0;border-radius: 0 5px 5px 0;">
                                                                </div>


                                                                <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                                    <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                        <div class="spinner-border text-white me-1"  role="status"></div>
                                                                        <span>Submit</span>
                                                                    </button>
                                                                    <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                        Submit
                                                                    </button>

                                                                    <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <label>Options Work</label>
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                1. Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost.
                                                            </li>
                                                            <li class="list-group-item">
                                                                2. Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn't matter. Shipping cost is fixed.
                                                            </li>
                                                            <li class="list-group-item">
                                                                3. Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost.
                                                            </li>
                                                            <li class="list-group-item">
                                                                4. Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to Shipping Cities.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-home_cats" role="tabpanel" aria-labelledby="v-pills-home_cats">
                                        <div class="card">
                                            <h2>Add Some Categories</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="">
                                                        <label class="label card-text">Shipping Config</label>
                                                        <vSelect :options="formattedParentCategories"
                                                                 multiple
                                                                 v-model="createForm.categoryId" label="label"
                                                                 :reduce="item =>item.value.id"
                                                                 placeholder="e.g Select Category">
                                                            <template v-slot:option="option">
                                                                <li class="d-flex align-items-start py-1">
                                                                    <div class="d-flex align-items-center justify-content-between w-100">
                                                                        <div class="me-1 d-flex flex-column">
                                                                            <h6 class="mb-25">{{ option.label }}</h6>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </template>
                                                        </vSelect>
                                                    </div>
                                                    <button class="btn btn-primary mt-1">Submit Settings</button>
                                                </form>
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
    </section>

    <Modal id="addShipCost" title="Add Area Wise Shipping Cost" size="sm" v-vb-is:modal>
        <div class="modal-body">
            <div class="">
                <label class="label">Inside Dhaka</label>
                <input type="text" v-model="formData.inSideDhaka" class="form-control" placeholder="e.g Inside Dhaka 100.00 ৳">
            </div>

            <div class="mt-1">
                <label class="label">Outside Dhaka</label>
                <input type="text" v-model="formData.outSideDhaka" class="form-control" placeholder="e.g Outside Dhaka 120.00 ৳">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
        </div>
    </Modal>

</Layout>

</template>

<script setup>
import Image from '../components/ImageUploader.vue'
import Modal from '../components/Modal.vue'
import Layout from "../Shared/Layout.vue";

import { usePage, useForm } from '@inertiajs/inertia-vue3'
import {computed, ref} from "vue"
import timezone from "../Store/timezone";

const APP_URL = usePage().props.value.ADMIN_URL;

let props = defineProps({
    option:[],
    countries:"",
    errors:"",
    bSettings:"",
    main_url:String|null,
    categories:[]|null,
})

let countries = props.countries;
let options = timezone.timesones;

const shippingStatus = ref(null)
const shiConfig = (event) => shippingStatus.value = event.target.value;
const formData = useForm({
    inSideDhaka:null,
    outSideDhaka:null,
    shippingType:null,
})

let createForm = useForm({
    name        : props.bSettings.name ?? '',
    header_logo : '',
    footer_logo : '',
    app_details : props.bSettings.details ?? '',
    timezone    : props.bSettings.timezone?.tz ?? '',
    country     : props.bSettings.country?.name ?? '',

    address     : props.bSettings.address ?? '',
    email       : props.bSettings.email ?? '',
    phone       : props.bSettings.phone ?? '',

    facebook_profile  : props.bSettings.facebook_profile ?? '',
    youtube           : props.bSettings.youtube ?? '',
    google_drive      : props.bSettings.google_drive ?? '',
    linkedin_profile  : props.bSettings.linkedin_profile ?? '',
    twitter_profile   : props.bSettings.twitter_profile ?? '',
    instagram_profile : props.bSettings.instagram_profile ?? '',

    api_url           : props.bSettings.api_url ?? '',
    api_user_name     : props.bSettings.api_user_name ?? '',
    api_user_pass     : props.bSettings.api_user_pass ?? '',

    inSizeDhaka:null,
    outSizeDhaka:null,
    shippingType:null,

    categoryId:[],

})

let logoForm = useForm({
    header_logo     :   '',
    footer_logo     :   '',
    fevicon_logo    :   '',
    lightColor      : null,
    mainColor       : null,
    textColor       : null

})


let isLoding = ref({});

let updateBuisnessSetting = () =>{
    // isLoding.value = false
    createForm.post(props.main_url, {
        onSuccess: (res)=>{
            // isLoding.value = true
            $sToast.fire({
               icon: "success",
               text: "Business Settings Update Successfully Done.:)",
            });
        },
        onError: (res) =>{
            $sToast.fire({
                icon: "error",
                text: "Business Settings Not Update (:",
            });
        }
    });
}
let updateLogo = () =>{
    isLoding.value = false
    logoForm.post(props.main_url, {
        onSuccess: (res)=>{
            isLoding.value = true
            $sToast.fire({
               icon: "success",
               text: "Business Settings Update Successfully Done.:)",
            });
        },
        onError: (res) =>{
            $sToast.fire({
                icon: "error",
                text: "Business Settings Not Update (:",
            });
        }
    });
}

const renderOptionGroup = (categories, prefix = '') => {
    return categories.map((category) => {

        let cValue = '';
        for (let i = 0; i < category.order_level; i++) {
            cValue += '--';
        }
        const label = `${cValue}${category.title}`;
        if (category.children && category.children.length > 0) {
            const childPrefix = `${prefix}\xa0\xa0\xa0`;
            return {
                label,
                options: renderOptionGroup(category.children, childPrefix),
            };
        } else {
            const value = {...category};
            return {
                label,
                value,
            };
        }
    });
};
const formattedParentCategories = computed(() => {
    return renderOptionGroup(props.categories);
});
</script>

<style scoped>
.spinner-border{
    --bs-spinner-width: 1.2rem !important;
    --bs-spinner-height: 1.2rem !important;
}
</style>
