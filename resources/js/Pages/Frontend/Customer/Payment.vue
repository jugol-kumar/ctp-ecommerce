<script setup>
    import Layout from "../../Frontend/Shared/Layout.vue";
    import {Inertia} from "@inertiajs/inertia";
    const props = defineProps({
        make_payment:null,
    })

    const makePayment = (type)=>{
        Inertia.post(props.make_payment)
    }



</script>

<template>
    <Layout>
        <div class="container mt-5">
            <!-- Payment -->
            <div id="checkout-payment" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="row">
                    <!-- Payment left -->
                    <div class="col-xl-9 mb-3 mb-xl-0">
                        <!-- Offer alert -->
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

                        <!-- Payment Tabs -->
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
                                <!-- Credit card -->
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
                                            <button type="button" @click="makePayment" class="btn btn-primary btn-next me-sm-3 me-1">Submit</button>
                                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- COD -->
                                <div class="tab-pane fade" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                                    <p>Cash on Delivery is a type of payment method where the recipient make payment for the order at the time of delivery rather than in advance.</p>
                                    <button type="button" @click="makePayment" class="btn btn-primary btn-next">Pay On Delivery</button>
                                </div>

                                <!-- Gift card -->
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
                                            <button type="button" @click="makePayment" class="btn btn-primary btn-next">Redeem Gift Card</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Address right -->
                    <div class="col-xl-3">
                        <div class="border rounded p-3">

                            <!-- Price Details -->
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
                            <!-- Address Details -->
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
        </div>
    </Layout>
</template>



<style scoped>

</style>
