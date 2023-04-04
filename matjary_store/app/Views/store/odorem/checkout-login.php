<?php
include("functions.php");
include("header.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Checkout Login <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="checkout-login-wrapper">
                    <div class="section-tagline">
                        <h6>Already have an account?</h6>
                    </div>
                    <div class="checkout-login-title">
                        <h4>Log in <i class="icofont-star-alt-1"></i></h4>
                    </div>

                    <input type="text" class="form-control" placeholder="Username*">
                    <input type="password" class="form-control" placeholder="Password*">

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Cancel</button>
                        <button class="btn btn-primary brand-btn">Login</button>
                    </div>

                    <div class="loginSignupLink">
                        <a href="forgot-password.php">
                            <h5>Forgot Password?</h5>
                        </a>

                        <a href="signup.php">
                            <h5>New User? Signup</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="option-tag mt-3">
                    <h3>OR</h3>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-login-wrapper">
                    <div class="section-tagline">
                        <h6>Checkout as a guest</h6>
                    </div>
                    <div class="checkout-login-title mb-3">
                        <h4>Guest Log in <i class="icofont-star-alt-1"></i></h4>
                    </div>

                    <ul class="guest-feature-list">
                        <li class="d-flex">
                            <i class="icofont-block-right"></i>
                            <h6>Make a One Time Payment</h6>
                        </li>

                        <li class="d-flex">
                            <i class="icofont-block-right"></i>
                            <h6>Fast Safe and Secure</h6>
                        </li>
                    </ul>

                    <button class="btn btn-primary brand-btn">Checkout as guest</button>
                </div>
            </div>

           
        </div>
    </div>
</section>      



<?php
include("footer.php")
?>