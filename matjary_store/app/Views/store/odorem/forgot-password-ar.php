<?php
include("functions.php");
include("header-ar.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Forgot Password <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h3>Forgot Password?</h3>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="forgot-pass-wrapper">
                    <div class="section-tagline">
                        <h6> <i class="icofont-star-alt-1"></i> Request for a new Password</h6>
                    </div>
                    <input type="text" class="form-control" placeholder="Username*">
                    <input type="password" class="form-control" placeholder="Email*">

                    <div class="d-grid gap-2 d-md-block text-right">
                        <button class="btn btn-primary brand-btn">Cancel</button>
                        <button class="btn btn-primary brand-btn">Submit</button>
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