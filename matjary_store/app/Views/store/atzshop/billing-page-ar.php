<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-3 text-right">
            <h4>Billing</h4>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="billing-form text-right">
                    <div class="wrapper-title mb-3">
                        <h5>Billing address</h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-2">Email Address <span class="required-mark">*</span></label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">First Name <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Last Name <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Address <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Country <span class="required-mark">*</span></label>
                                <select class="custom-select">
                                    <option selected="">Select Country</option>
                                    <option>Saudi Arabia</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">State <span class="required-mark">*</span></label>
                                <select class="custom-select">
                                    <option selected="">Select State</option>
                                    <option>Riyadh</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">City <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Zip Code <span class="required-mark">*</span></label>
                        <input type="zip" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Phone <span class="required-mark">*</span></label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Mobile <span class="required-mark">*</span></label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Fax <span class="required-mark">*</span></label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="shipping-form text-right">
                    <div class="wrapper-title mb-3">
                        <h5>Shipping address</h5>
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox shipping-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shippingCheck">
                            <label class="custom-control-label" for="shippingCheck">Same as billing address</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">First Name <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Last Name <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Address <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Country <span class="required-mark">*</span></label>
                                <select class="custom-select">
                                    <option selected="">Select Country</option>
                                    <option>Saudi Arabia</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">State <span class="required-mark">*</span></label>
                                <select class="custom-select">
                                    <option selected="">Select State</option>
                                    <option>Riyadh</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">City <span class="required-mark">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Zip Code <span class="required-mark">*</span></label>
                        <input type="zip" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Phone <span class="required-mark">*</span></label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label class="form-label mb-2">Mobile <span class="required-mark">*</span></label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Fax <span class="required-mark">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Shipping Method <span class="required-mark">*</span></label>
                        <select class="custom-select">
                            <option selected="">Select Shipping Method</option>
                            <option>Aramex</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button class="brand-btn mx-auto d-block btn-lg mt-3">Checkout</button>
    </div>
</section>

<?php
include("footer-ar.php")
?>