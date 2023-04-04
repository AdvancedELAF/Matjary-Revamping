<?php
include("functions.php");
include("header.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Billing <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="billing-form-title mb-4">
                    <h4>Billing address <i class="icofont-star-alt-1"></i></h4>
                </div>

                <div class="billing-form">
                    <div class="mb-2">
                        <input class="form-control" placeholder="Email Address*">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="First Name*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Address*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <select class="custom-select">
                                <option selected="">Country*</option>
                                <option>Saudi Arabia</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <select class="custom-select">
                                <option selected="">States*</option>
                                <option>Riyadh</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="City*">
                        </div>
                    </div>

                    <div class="mb-2">
                        <input class="form-control" placeholder="Zip Code*">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Phone*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Mobile">
                        </div>
                    </div>

                    <div class="mb-2">
                        <input class="form-control" placeholder="Fax">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="billing-form-title mb-4">
                    <h4>Shipping address <i class="icofont-star-alt-1"></i></h4>

                    <div class="custom-control custom-checkbox shipping-checkbox">
                        <input type="checkbox" class="custom-control-input" id="shippingCheck">
                        <label class="custom-control-label" for="shippingCheck">Same as billing address</label>
                    </div>
                </div>

                <div class="shipping-form">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="First Name*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Address*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <select class="custom-select">
                                <option selected="">Country*</option>
                                <option>Saudi Arabia</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <select class="custom-select">
                                <option selected="">States*</option>
                                <option>Riyadh</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="City*">
                        </div>
                    </div>

                    <div class="mb-2">
                        <input class="form-control" placeholder="Zip Code*">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Phone*">
                        </div>

                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Mobile">
                        </div>
                    </div>

                    <div class="mb-2">
                        <input class="form-control" placeholder="Fax">
                    </div>

                    <div class="mb-2">
                        <select class="custom-select">
                            <option selected="">Shipping Method</option>
                            <option>Aramex</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary brand-btn mx-auto d-block btn-lg mt-3">Checkout</button>
    </div>
</section>

<?php
include("footer.php")
?>