<?php
include("functions.php");
include("header.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Payment Method <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h3>Select a Payment Option</h3>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="payment-wrapper">
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

                    
                    <label class="col-form-label" id="giftCardOption">
                        Use Gift Card
                    </label>

                    <div class="form-group giftCardInput w-50">
                        <input class="form-control" placeholder="Enter Gift Card Code">
                        <button class="btn btn-primary brand-btn">Pay using giftcard</button>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pay using paytabs</label>
                        <div class="col-sm-9">
                            <a href="#">
                                <img class="img-fluid" src="assets/images/paytabs.png">
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<?php
include("footer.php")
?>