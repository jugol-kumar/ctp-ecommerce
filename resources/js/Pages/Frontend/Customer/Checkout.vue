<script setup>
    import Layout from "../../Frontend/Shared/Layout.vue";
    import {useCartStore} from "../../../Store/useCartStore";
    import {computed, ref} from 'vue'
    import {onMounted} from 'vue'
    import CartItemCard from '../Modules/CartItemCard.vue'
    import QuantityButton from '../../../components/QuantityButton.vue'
    import {useForm} from "@inertiajs/inertia-vue3";
    import {Inertia} from "@inertiajs/inertia";

    const props = defineProps({
        main_url:String|null,
        cities:[]|null,
        shippingType:String|null,
        shippingPrice:[]|null,
        checkOutData:Object|null,
    })

    const store = useCartStore();
    onMounted(()=>{
        store.initCart();
    })

    const deliveryPrice = ref(0);
    const deliveryCharge = (event) =>{
        if (props.shippingType === 'p'){


            console.log(event)
            if(event.name === 'Dhaka'){
                deliveryPrice.value = props.shippingPrice['inDhaka']
            }else {
                deliveryPrice.value = props.shippingPrice['outDhaka']
            }
        }else{
            deliveryPrice.value = 0;
        }
    }
    const totalPrice = computed(() =>{
        return parseInt(store.getCartTotalPrice) + parseInt(deliveryPrice.value);
    })

    const formData = useForm({
        name:null, email:null, phone:null, city:null, address:null,
    })
    const isLoading = ref(false);
    const isPaymentPage = ref(true);
    const saveCheckoutInfo = () => {

        Inertia.post(props.main_url, {
            formData:formData,
            cartItems:store.getCartItems,
            totalItems:store.getCartLength,
            deliveryCharge:deliveryPrice.value,
            cartTotalPrice:store.getCartTotalPrice
        },{
            preserveState: true,
            replace: true,
            onStart: res => {
                isLoading.value = true;
            },

            onSuccess: page => {
                isLoading.value = false;
                isPaymentPage.value = true;

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
        });
    }


</script>

<template>
    <Layout>
        <div class="container mt-5">

        <!-- Address -->
            <div class="row">
                <!-- Address left -->
                <div class="col-xl-9 mb-3 mb-xl-0" v-if="checkOutData !== undefined">
                    <!-- Select address -->
                    <p>Provide Your Shipping Detail's</p>
                    <div class="row mb-3">
                        <div class="col-md mb-md-0 mb-2">
                            <div class="card">
                                <div class="card-body">
<!--                                    <div class="form-check custom-option custom-option-basic checked">
                                        <label class="form-check-label custom-option-content" for="customRadioAddress1">
                                            <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioAddress1" checked="">
                                            <span class="custom-option-body d-flex flex-column">
                                              <div class="mb-1">
                                                  <span class="fw-semibold me-1">John Doe (Default)</span>
                                                  <span class="badge bg-light-primary">Home</span>
                                              </div>
                                              <small>4135 Parkway Street, Los Angeles, CA, 90017.<br> Mobile : 1234567890 Cash / Card on delivery available</small>
                                              <hr>
                                              <span class="d-flex">
                                                <a class="me-2" href="javascript:void(0)">Edit</a> <a href="javascript:void(0)">Remove</a>
                                              </span>
                                            </span>
                                        </label>
                                    </div>-->
                                    <div class="row mb-1">
                                        <div class="col">
                                            <label>Your Full Name ?</label>
                                            <input v-model="formData.name" type="text" class="form-control" placeholder="e.g john doh">
                                        </div>
                                        <div class="col">
                                            <label>Your Email Address</label>
                                            <input v-model="formData.email"  type="text" class="form-control" placeholder="e.g john doh">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <label>Phone Number ?</label>
                                            <input v-model="formData.phone" type="text" class="form-control" placeholder="e.g 01***-******">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <label>Select City ?</label>
                                            <vSelect :options="props.cities"
                                                     v-model="formData.city"
                                                     @update:modelValue="deliveryCharge($event)"
                                                     label="name"
                                                     :reduce="item => item.id"
                                                     placeholder="e.g Select City">
                                                <template v-slot:option="option">
                                                    <li class="d-flex align-items-start py-1">
                                                        <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="me-1 d-flex flex-column">
                                                                <h6 class="mb-25">{{ option.name +"/"+ option.bn_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </template>
                                            </vSelect>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col">
                                            <label>Address ?</label>
                                            <textarea v-model="formData.address"  type="text" class="form-control" placeholder="e.g your delivery address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!--                    <button type="button" class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewAddress">Add new address</button>-->
                </div>

                <div class="col-xl-6 mb-3 mb-xl-0 mx-auto" v-else>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Select your payment method</h4>
                        </div>
                        <div class="card-body">
                            <div class="row custom-options-checkable g-1 match-height">
                                <div class="col-md">
                                    <input class="custom-option-item-check" type="radio" name="customOptionsCheckableRadiosWithIcon" id="customOptionsCheckableRadiosWithIcon1" checked="">
                                    <label class="custom-option-item text-center p-1" for="customOptionsCheckableRadiosWithIcon1">
                                        <img src="../../../../images/ssl.png" width="200" class="p-1"/>
                                        <span class="custom-option-item-title h4 d-block">SSl Commerz</span>
                                        <small>I want to pay by SSl Commerz</small>
                                    </label>
                                </div>

                                <div class="col-md">
                                    <input class="custom-option-item-check" type="radio" name="customOptionsCheckableRadiosWithIcon" id="customOptionsCheckableRadiosWithIcon2" value="">
                                    <label class="custom-option-item text-center text-center p-1" for="customOptionsCheckableRadiosWithIcon2">
                                        <img src="../../../../images/cod.png" width="75" class="p-1"/>
                                        <span class="custom-option-item-title h4 d-block">Cash On Delivery</span>
                                        <small>I am happy with cash on delivery</small>
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="login">
                            <label class="form-check-label" for="login">I agree to the
                                <a href="">Terms and Conditions</a> ,
                                <a href="">Return Policy</a>&
                                <a href="">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Address right -->
                <div class="col-xl-3" v-if="!isPaymentPage">
                    <div class="border rounded p-3 mb-3">
                        <span class="text-end">
                            {{ `${store.getCartLength} Items In Your Bag`  }}
                        </span>

                        {{ deliveryPrice }}
                        <h6>Price Details</h6>
                        <dl class="row mb-0">
                            <dt class="col-6 fw-normal">Order Total</dt>
                            <dd class="col-6 text-end">{{ props.checkOutData?.data?.cart_total_price }}</dd>

                            <dt class="col-6 fw-normal">Delivery Charges</dt>
                            <dd class="col-6 text-end" v-if="props.shippingType === 'p'">
                                <span> ৳ {{ props.checkOutData?.data?.delivery_charge }}</span>
                            </dd>
                            <hr>

                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-semibold text-end mb-0">৳ {{ props.checkOutData?.data?.cart_total_price + props.checkOutData?.data?.delivery_charge }}</dd>
                        </dl>
                    </div>
                    <div class="d-grid">
                        <button @click="saveCheckoutInfo" :disabled="isLoading" class="btn btn-primary btn-next">Place Order</button>
                    </div>
                </div>



                <div class="col-xl-3" v-else>
                    <div class="border rounded p-3 mb-3">
                        <span class="text-end">
                            {{ `${store.getCartLength} Items In Your Bag`  }}
                        </span>

                        <h6>Price Details</h6>
                        <dl class="row mb-0">
                            <dt class="col-6 fw-normal">Bag Total</dt>
                            <dd class="col-6 text-end">{{ store.getCartTotalPrice }} ৳</dd>

<!--
                            <dt class="col-6 fw-normal">Coupon Discount</dt>
                            <dd class="col-6 text-success text-end"> -$98.00</dd>
-->

                            <dt class="col-6 fw-normal">Vat</dt>
                            <dd class="col-6 text-end">৳ 5.00 </dd>

                            <dt class="col-6 fw-normal">Tax</dt>
                            <dd class="col-6 text-end">৳ 5.00 </dd>

                            <dt class="col-6 fw-normal">Delivery Charge</dt>
                            <dd class="col-6 text-end">{{ deliveryPrice }}</dd>


                            <hr>

                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-semibold text-end mb-0">{{ totalPrice }} ৳</dd>
                        </dl>
                    </div>
                    <div class="d-grid">
                        <button @click="saveCheckoutInfo" :disabled="isLoading" class="btn btn-primary btn-next">Place Order</button>
                    </div>
                </div>
            </div>





<!--

        &lt;!&ndash; Payment &ndash;&gt;
        <div id="checkout-payment" class="content fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row">
                &lt;!&ndash; Payment left &ndash;&gt;
                <div class="col-xl-9 mb-3 mb-xl-0">
                    &lt;!&ndash; Offer alert &ndash;&gt;
                    <div class="alert alert-success" role="alert">
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
              <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2">
                <i class="bx bx-sm bx-purchase-tag fs-4"></i>
              </span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold">Bank Offers</div>
                                <ul class="list-unstyled mb-0">
                                    <li> - 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</li>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    &lt;!&ndash; Payment Tabs &ndash;&gt;
                    <div class="col-xxl-6 col-lg-8">
                        <ul class="nav nav-pills mb-3" id="paymentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-cc-tab" data-bs-toggle="pill" data-bs-target="#pills-cc" type="button" role="tab" aria-controls="pills-cc" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-cod-tab" data-bs-toggle="pill" data-bs-target="#pills-cod" type="button" role="tab" aria-controls="pills-cod" aria-selected="false" tabindex="-1">Cash On Delivery</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-gift-card-tab" data-bs-toggle="pill" data-bs-target="#pills-gift-card" type="button" role="tab" aria-controls="pills-gift-card" aria-selected="false" tabindex="-1">Gift Card</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="paymentTabsContent">
                            &lt;!&ndash; Credit card &ndash;&gt;
                            <div class="tab-pane fade show active" id="pills-cc" role="tabpanel" aria-labelledby="pills-cc-tab">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label w-100" for="paymentCard">Card Number</label>
                                        <div class="input-group input-group-merge">
                                            <input id="paymentCard" name="paymentCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="paymentCard2">
                                            <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="paymentCardName">Name</label>
                                        <input type="text" id="paymentCardName" class="form-control" placeholder="John Doe">
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label" for="paymentCardExpiryDate">Exp. Date</label>
                                        <input type="text" id="paymentCardExpiryDate" class="form-control expiry-date-mask" placeholder="MM/YY">
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label" for="paymentCardCvv">CVV Code</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="paymentCardCvv" class="form-control cvv-code-mask" maxlength="3" placeholder="654">
                                            <span class="input-group-text cursor-pointer" id="paymentCardCvv2"><i class="bx bx-help-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Card Verification Value" data-bs-original-title="Card Verification Value"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="switch">
                                            <input type="checkbox" class="switch-input">
                                            <span class="switch-toggle-slider">
                      <span class="switch-on"></span>
                      <span class="switch-off"></span>
                    </span>
                                            <span class="switch-label">Save card for future billing?</span>
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary btn-next me-sm-3 me-1">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            &lt;!&ndash; COD &ndash;&gt;
                            <div class="tab-pane fade" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                                <p>Cash on Delivery is a type of payment method where the recipient make payment for the order at the time of delivery rather than in advance.</p>
                                <button type="button" class="btn btn-primary btn-next">Pay On Delivery</button>
                            </div>

                            &lt;!&ndash; Gift card &ndash;&gt;
                            <div class="tab-pane fade" id="pills-gift-card" role="tabpanel" aria-labelledby="pills-gift-card-tab">
                                <h6>Enter Gift Card Details</h6>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="giftCardNumber" class="form-label">Gift card number</label>
                                        <input type="number" class="form-control" id="giftCardNumber" placeholder="Gift card number">
                                    </div>
                                    <div class="col-12">
                                        <label for="giftCardPin" class="form-label">Gift card pin</label>
                                        <input type="number" class="form-control" id="giftCardPin" placeholder="Gift card pin">
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary btn-next">Redeem Gift Card</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                &lt;!&ndash; Address right &ndash;&gt;
                <div class="col-xl-3">
                    <div class="border rounded p-3">

                        &lt;!&ndash; Price Details &ndash;&gt;
                        <h6>Price Details</h6>
                        <dl class="row">

                            <dt class="col-6 fw-normal">Order Total</dt>
                            <dd class="col-6 text-end">$1100.00</dd>

                            <dt class="col-6 fw-normal">Delivery Charges</dt>
                            <dd class="col-6 text-end"><s>$5.00</s> <span class="badge bg-label-success">Free</span></dd>

                            <hr>

                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-semibold text-end mb-0">$1100.00</dd>

                            <dt class="col-6">Deliver to:</dt>
                            <dd class="col-6 fw-semibold text-end mb-0"><span class="badge bg-label-primary">Home</span></dd>
                        </dl>
                        &lt;!&ndash; Address Details &ndash;&gt;
                        <address>
                            <span class="fw-semibold"> John Doe (Default),</span><br>
                            4135 Parkway Street, <br>
                            Los Angeles, CA, 90017. <br>
                            Mobile : +1 906 568 2332
                        </address>
                        <a href="javascript:void(0)">Change address</a>
                    </div>
                </div>
            </div>
        </div>

        &lt;!&ndash; Confirmation &ndash;&gt;
        <div id="checkout-confirmation" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block">
                            <div class="row mb-3">
                                <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
                                    <h4 class="mt-2">Thank You! 😇</h4>
                                    <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                                    <p>We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your order confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam folder to see if the email was routed there.</p>
                                    <p><span class="fw-semibold"><i class="bx bx-time-five"></i> Time placed:</span> 25/05/2020 13:35pm</p>
                                </div>
                                &lt;!&ndash; Confirmation details &ndash;&gt;
                                <div class="col-12">
                                    <ul class="list-group list-group-horizontal-md">
                                        <li class="list-group-item flex-fill">
                                            <h6><i class="bx bx-map"></i> Shipping</h6>
                                            <address>
                                                John Doe <br>
                                                4135 Parkway Street,<br>
                                                Los Angeles, CA 90017,<br>
                                                USA <br>
                                                +123456789
                                            </address>
                                        </li>
                                        <li class="list-group-item flex-fill">
                                            <h6><i class="bx bx-credit-card"></i> Billing Address</h6>
                                            <address>
                                                John Doe <br>
                                                4135 Parkway Street,<br>
                                                Los Angeles, CA 90017,<br>
                                                USA <br>
                                                +123456789
                                            </address>
                                        </li>
                                        <li class="list-group-item flex-fill">
                                            <h6><i class="bx bx-train"></i> Shipping Method</h6>
                                            <span class="fw-semibold">Preferred Method:</span><br>
                                            Standard Delivery<br>
                                            (Normally 3-4 business days)
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                &lt;!&ndash; Confirmation items &ndash;&gt;
                                <div class="col-xl-9 mb-3 mb-xl-0">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <img src="../../assets/img/products/1.png" alt="google home" class="w-px-75">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <a href="javascript:void(0)" class="text-body">
                                                                <h6>Google - Google Home - White</h6>
                                                            </a>
                                                            <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-1">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-md-end">
                                                                <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <img src="../../assets/img/products/2.png" alt="google home" class="w-px-75">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <a href="javascript:void(0)" class="text-body">
                                                                <h6>Apple iPhone 11 (64GB, Black)</h6>
                                                            </a>
                                                            <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-1">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-md-end">
                                                                <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                &lt;!&ndash; Confirmation total &ndash;&gt;
                                <div class="col-xl-3">
                                    <div class="border rounded p-3">
                                        &lt;!&ndash; Price Details &ndash;&gt;
                                        <h6>Price Details</h6>
                                        <dl class="row mb-0">

                                            <dt class="col-6 fw-normal">Order Total</dt>
                                            <dd class="col-6 text-end">$1100.00</dd>

                                            <dt class="col-6 fw-normal">Delivery Charges</dt>
                                            <dd class="col-6 text-end"><s>$5.00</s> <span class="badge bg-label-success">Free</span></dd>

                                            <hr>

                                            <dt class="col-6">Total</dt>
                                            <dd class="col-6 fw-semibold text-end mb-0">$1100.00</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
-->

        </div>
    </Layout>
</template>



<style scoped>

</style>
