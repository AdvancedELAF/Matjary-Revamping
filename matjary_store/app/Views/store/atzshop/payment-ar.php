<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Payment</h4>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="payment-wrapper text-right">
                    <div class="text-center wrapper-title mb-4">
                        <h5>Select a Payment Option</h5>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total to pay</label>
                        <div class="col-sm-9">
                            <p>20196.00</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total shipping cost</label>
                        <div class="col-sm-9">
                            <p>10.00</p>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Grand total</label>
                        <div class="col-sm-9">
                            <p>20206.00</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Balance credits</label>
                        <div class="col-sm-9">
                            <p>0.00</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Use Gift Card</label>
                        <div class="col-sm-9">
                            <input class="form-control mb-2" placeholder="Enter Gift Card Code">
                            <button class="brand-btn">Pay using giftcard</button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pay using paytabs</label>
                        <div class="col-sm-9">
                            <a href="#">
                                <img class="img-fluid" src="assets/images/paytabs.png">
                            </a>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pay Offline</label>
                        <div class="col-sm-9">
                            <button class="brand-btn">Cash on Delivery</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<?php
include("footer-ar.php")
?>