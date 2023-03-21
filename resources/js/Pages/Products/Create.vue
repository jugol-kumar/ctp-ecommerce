<script setup>
import layout from "../../Shared/Layout.vue";
import AnimInput from '../../components/AnimInput.vue'
import Modal from '../../components/Modal.vue'
import {computed, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Editor from "../../components/Editor.vue";
import Switch from "../../components/Switch.vue";
import Swal from "sweetalert2";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    categories:[] | null,
    brands:[]|null,
    colors:[]|null,
})

const productId = computed(() => Math.floor(100000 + Math.random() * 900000));



const formData = useForm({
    productId: productId,
    productTitle:null,
    categoryId:null,
    brandId:null,
    productPrice:null,
    discountAmount:null,
    discountType:null,
    unit:null,
    qty:null,
    description:"",
    thumbnel:null,
    images:[],
    colorId:null,
    sizes:[],
    specification:"<p><strong>this si default spesifications this is edited here </strong></p>"
});

const renderOptionGroup = (categories, prefix = '') => {
    return categories.map((category) => {

        let cValue = '';
        for (let i = 0; i < category.order_level; i++){
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
            const value = { ...category };
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

const addDescriptions = () => document.getElementById('addDescriptions').$vb.modal.show();

const seoDetailsModal = () => document.getElementById('seoDetailsModal').$vb.modal.show();
const vatAndTax = () => document.getElementById('vatAndTax').$vb.modal.show();
const actionModal = () => document.getElementById('actionModal').$vb.modal.show();
const shiConfig = (event) =>{
    console.log(event.target.value);
    if (event.target.value === 'p'){
        document.getElementById('addShipCost').$vb.modal.show();
    }
}
const cancelProducts = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to cancel this product creation's",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2915cf',
        cancelButtonColor: '#15cfbf',
        confirmButtonText: 'Yes, Cancel It',
        cancelButtonText: 'Stay Here'
    }).then((result) => {
        if (result.isConfirmed) {
            formData.reset();
            document.getElementById('actionModal').$vb.modal.hide();
        }
    })
}
const fullPageSpecification = ref(false)
const fullPageSpec = () => {
    fullPageSpecification.value = true;
}
const defultPageSpec = () => {
    fullPageSpecification.value = false;
}


const isLoading = ref(false);
const saveProduct= () =>{
    console.log("call here");
    alert("ok it")
}

const isLoading = ref(false);
const saveProduct= () =>{
    console.log("call here");
    alert("ok it")
}

</script>

<template>
    <layout>

<!--        <div class="content-header row mb-1">
            <div class="col-12 d-flex align-items-center justify-content-between text-right">
                <a class="btn btn-sm btn-gradient-danger d-flex align-items-center"
                   :href="`${this.$page.props.auth.ADMIN_URL}/products`"
                   type="button">
                    <vue-feather type="corner-down-left" size="15"/>
                    <span class="ms-1">Back To List</span>
                </a>
            </div>
        </div>-->


        <div class="content-body">
            <div class="row match-height">
                <div :class=" fullPageSpecification ? 'd-none' : 'col-md-4'">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="fw-bolder">
                                #{{ $page.props.auth.APP_NAME+"_"+productId }}
                            </h1>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <AnimInput label="Product Title" v-model="formData.productTitle"/>
                            <div class="form-group mt-1">
                                <label>Category</label>
                                <vSelect :options="formattedParentCategories" v-model="formData.categoryId" label="label" placeholder="e.g Select Category">
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
                            <div class="form-group mt-1">
                                <label>Brand</label>
                                <vSelect :options="brands" v-model="formData.brandId" label="name" placeholder="e.g Select Brand">
                                    <template v-slot:option="option" v-c-tooltip="option.slogan ?? ''">
                                        <li class="d-flex align-items-start py-1">
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="me-1 d-flex flex-column" >
                                                    <h6 class="mb-25">{{ option.name }}</h6>
                                                    <img :src="option.icon" alt="" width="50" height="50">
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </vSelect>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-1">
                                <label>Price</label> <info title="Average Price"/>
                                <input class="form-control" v-model="formData.productPrice" type="text" placeholder="e.g Amount 00.0 ৳">
                            </div>

                            <fieldset class="mt-1">
                                <label>Discount</label> <info title="Apply Also Variant Price." />
                                <div class="input-group">
                                    <input type="number" class="form-control"
                                           v-model="formData.discountAmount"
                                           placeholder="e.g Amount..." aria-label="Amount">
                                    <select name="experience_type"
                                            v-model="formData.discountType"
                                            class="form-control selectpicker">
                                        <option disabled selected value="null"> e.g Select Type</option>
                                        <option value="percentage">%</option>
                                        <option value="flat">৳</option>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="mt-1">
                                <label>Unit And Quantity</label> <info title="Apply Also Variant Price." />
                                <div class="input-group">
                                    <input class="form-control" v-model="formData.unit" type="text" placeholder="e.g Unit(pc, kg, lt, etc)">
                                    <input class="form-control" v-model="formData.qty" type="text" placeholder="Available quantity e.g 500 pc">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <strong class="mb-md-25">Short Description</strong>
                                <p class="border-bottom p-1 bg-light cursor-pointer" @click="addDescriptions"> {{ formData.description != "" ? formData.description.slice(0, 70)+"..." : 'e.g what you want to write about your product.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div :class="fullPageSpecification ? 'col-md-12' : 'col-md-6'">
                    <div :class="fullPageSpecification ? 'd-none' : 'card'">
                        <div class="card-body">
                            <h4 class="card-title">Variant</h4>
                            <div class="row d-flex align-items-center">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-1">
                                                <label>Product Thumbnail</label>
                                                <input type="text" v-model="formData.thumbnel"  class="form-control" v-c-tooltip="'Click here for choose file. It\'s Single File'"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label>Product Image's</label>
                                                <input type="text" v-model="formData.images" class="form-control" multiple v-c-tooltip="'Click here for choose file. If you want to chos multiple image then hold press ctrl and select images or select multiple image with mouse cursor.'"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Product Color</label>
                                            <vSelect :options="colors" label="name" v-model="formData.colorId" placeholder="e.g Select Product Color">
                                                <template v-slot:option="option">
                                                    <li class="d-flex align-items-start py-1">
                                                        <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="me-1 d-flex flex-column">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="showColor" :style="`background:${option.code} `"></span>
                                                                    <h6 class="mb-25 ms-1">{{ option.name }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </template>
                                            </vSelect>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label>Product Sizes</label>
                                                <v-select
                                                    multiple
                                                    taggable
                                                    v-model="formData.sizes"
                                                    placeholder="Product Sizes"></v-select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3>Full Specification's</h3>
                                <button v-if="!fullPageSpecification" class="btn-icon btn" @click="fullPageSpec" v-c-tooltip="'Enter Full page'" >
                                    <vue-feather type="external-link"/>
                                </button>
                                <button v-else class="btn-icon btn" @click="defultPageSpec" v-c-tooltip="'Exit full page'" >
                                    <vue-feather type="external-link" style="rotate: 180deg;"/>
                                </button>
                            </div>
                            <div class="">
                                <Editor v-model="formData.specification" :isMultiline="fullPageSpecification" :height=" fullPageSpecification ? '600px' : '400px'"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div :class="fullPageSpecification ? 'd-none' : 'col-md-2'">
<!--                    <div class="card">
                        <div class="card-body text-center" v-c-tooltip="'If you want to make this product for featured then enable this switch'">
                            <Switch class="mb-1" label="Featured Product"/>
                            <span class="label">Featured Status</span>
                        </div>
                    </div>-->

                    <div class="card">
                        <div class="card-body" v-c-tooltip="'This product quantity available or not this notification'">
                            <label class="label card-text">Low Stoke Quantity</label>
                            <input type="text" class="form-control" placeholder="e.g 100 pc">
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label class="label card-text">Shipping Config</label>
                            <select @change="shiConfig" class="form-control form-select">
                                <option value="f">Free Shipping</option>
                                <option value="p">Product Wish</option>
                                <option value="c">City Wise</option>
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body text-center" v-c-tooltip="'Cash On Delivery Enable Or Disabled'">
                            <Switch class="mb-1"/>
                            <span class="label">COD</span>
                        </div>
                    </div>
                    <div class="card">
                        <a @click="vatAndTax">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h4 class="py-2 mb-0 text-info card-title">Vat</h4>
                                <span class="mx-1">/</span>
                                <h4 class="py-2 mb-0 text-primary card-title">Tax</h4>
                            </div>
                        </a>
                    </div>

                    <div class="card">
                        <a @click="seoDetailsModal">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h4 class="py-2 mb-0 text-info card-title">Seo Details</h4>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a @click="actionModal">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h4 class="py-2 mb-0 text-success">Actions</h4>
                            </div>
                        </a>
                    </div>
<!--                    <div class="card">
                        <a>
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h4 class="py-2 mb-0 text-warning">Cancel</h4>
                            </div>
                        </a>
                    </div>-->
                </div>
            </div>
        </div>


        <Modal id="addDescriptions" title="Full Description About This Product"  v-vb-is:modal>
            <div class="modal-body">
                <textarea class="form-control" rows="10" v-model="formData.description" placeholder="e.g what you want to write about your product."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </Modal>

        <Modal id="addSpecification" title="Full Description About This Product" size="xl" v-vb-is:modal>
            <div class="modal-body">
                <div>
                    <Editor v-model="formData.specification" isMultiline height="600px"/>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </Modal>

        <Modal id="addShipCost" title="Add Area Wise Shipping Cost" size="sm" v-vb-is:modal>
            <div class="modal-body">
                <div class="">
                    <label class="label">Inside Dhaka</label>
                    <input type="text" class="form-control" placeholder="e.g Inside Dhaka 100.00 ৳">
                </div>

                <div class="mt-1">
                    <label class="label">Outside Dhaka</label>
                    <input type="text" class="form-control" placeholder="e.g Outside Dhaka 120.00 ৳">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </Modal>

        <Modal id="seoDetailsModal" title="Add SEO Details here" size="md" v-vb-is:modal>
            <div class="modal-body">
                <div class="mb-1">
                    <label class="label">Title</label>
                    <input class="form-control" type="text" placeholder="e.g seo title / default product title">
                </div>
                <div class="mb-1">
                    <label class="label">Keywords</label>
                    <v-select
                        multiple
                        taggable
                        placeholder="Product Sizes"></v-select>
                </div>

                <div class="mb-1">
                    <label class="label">Image</label>
                    <input type="file" class="form-control" v-c-tooltip="'Click here for choose file'"/>
                </div>

                <div class="mt-1">
                    <label class="label">Description's</label>
                    <textarea class="form-control" name="" id="" rows="8" placeholder="e.g seo full descriptions"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </Modal>

        <Modal id="vatAndTax" title="Vat / Tax" size="sm" v-vb-is:modal>
            <div class="modal-body">
                <fieldset class="mt-1">
                    <label>Vat</label>
                    <div class="input-group">
                        <input type="number" class="form-control"
                               name="min_experience"
                               placeholder="e.g Vat Amount..." aria-label="Amount">
                        <select name="experience_type"
                                class="form-control selectpicker">
                            <option disabled selected> e.g Select Type</option>
                            <option value="percentage">%</option>
                            <option value="flat">৳</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset class="mt-1">
                    <label>Tax</label>
                    <div class="input-group">
                        <input type="number" class="form-control"
                               name="min_experience"
                               placeholder="e.g Tax Amount..." aria-label="Amount">
                        <select name="experience_type"
                                class="form-control selectpicker">
                            <option disabled selected> e.g Select Type</option>
                            <option value="percentage">%</option>
                            <option value="flat">৳</option>
                        </select>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </Modal>
        <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"  v-vb-is:modal>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-5">
                    <div v-if="isLoading" class="d-flex align-items-center justify-content-center">
                        <img src="../../../iamges/loading2.svg" alt="">
                    </div>
                    <div v-if="!isLoading" class="d-flex align-items-center justify-content-center flex-column">
                        <form @submit.prevent="saveProduct" >
                            <button class="card bg-light-success" type="submit">
                                <div class="card-body">
                                    <h2 class="text-success">Save Product</h2>
                                </div>
                            </button>
                        </form>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card me-2 cursor-pointer" data-bs-dismiss="modal">
                                <div class="card-body bg-light-info">
                                    <h2 class="text-info">Need Change</h2>
                                </div>
                            </div>
                            <div class="card ms-2 cursor-pointer" @click="cancelProducts">
                                <div class="card-body bg-light-warning">
                                    <h2 class="text-warning">Cancel Product</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <a :href="`${this.$page.props.auth.ADMIN_URL}/products`">
                                <div class="card-body bg-light-danger">
                                    <h2 class="text-danger">Back To Home</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </layout>
</template>

<style>

        <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"  v-vb-is:modal>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-5">
                    <div v-if="isLoading" class="d-flex align-items-center justify-content-center">
                        <img src="../../../iamges/loading2.svg" alt="">
                    </div>
                    <div v-if="!isLoading" class="d-flex align-items-center justify-content-center flex-column">
                        <form @submit.prevent="saveProduct" >
                            <button class="card bg-light-success" type="submit">
                                <div class="card-body">
                                    <h2 class="text-success">Save Product</h2>
                                </div>
                            </button>
                        </form>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card me-2 cursor-pointer" data-bs-dismiss="modal">
                                <div class="card-body bg-light-info">
                                    <h2 class="text-info">Need Change</h2>
                                </div>
                            </div>
                            <div class="card ms-2 cursor-pointer" @click="cancelProducts">
                                <div class="card-body bg-light-warning">
                                    <h2 class="text-warning">Cancel Product</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <a :href="`${this.$page.props.auth.ADMIN_URL}/products`">
                                <div class="card-body bg-light-danger">
                                    <h2 class="text-danger">Back To Home</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </layout>
</template>

<style>
</style>
