<template>

    <!-- Confirmation -->
    <div id="checkout-confirmation" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block">
        <div class="row mb-3">
            <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
                <h4 class="mt-2">Thank You! 😇</h4>
                <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                <p>We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your order confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam folder to see if the email was routed there.</p>
                <p><span class="fw-semibold"><i class="bx bx-time-five"></i> Time placed:</span> 25/05/2020 13:35pm</p>
            </div>
            <!-- Confirmation details -->
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
            <!-- Confirmation items -->
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
            <!-- Confirmation total -->
            <div class="col-xl-3">
                <div class="border rounded p-3">
                    <!-- Price Details -->
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
</template>

<script>
    export default {
        name: "Conformation"
    }
</script>

<style scoped>

</style>
