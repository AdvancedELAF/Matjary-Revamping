<?php
include("functions.php");
include("header.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Signup <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title mb-3">
                    <h3>New User? Signup <i class="icofont-star-alt-1"></i></h3>
                </div>
                <div class="ls-wrapper">
                    <input type="text" class="form-control" placeholder="Username*">
                    <input type="email" class="form-control" placeholder="Email Address*">
                    <input type="password" class="form-control" placeholder="Password*">
                    <input type="password" class="form-control" placeholder="Confirm Password*">
                    <div class="custom-control custom-checkbox newsletter-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="newsletterCheck">
                        <label class="custom-control-label" for="newsletterCheck">Subscribe Newsletter</label>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Reset</button>
                        <button class="btn btn-primary brand-btn">Sign up</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ls-banner">
                    <img src="assets/images/signup-banner.jpg">
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer.php")
?>