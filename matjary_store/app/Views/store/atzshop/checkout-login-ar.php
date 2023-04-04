<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Checkout Login</h4>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="checkout-login-wrapper text-right">
                    <div class="wrapper-title">
                        <h5>Already have an account?</h5>
                    </div>
                    <div class="section-title">
                        <h4>Log in</h4>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Username <span class="required-mark">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Password <span class="required-mark">*</span></label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="d-grid gap-2 d-md-block mb-2">
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
                <div class="option-tag mt-3 mb-3 text-center">
                    <h3>OR</h3>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-login-wrapper text-right">
                    <div class="wrapper-title">
                        <h5>Checkout as a guest</h5>
                    </div>
                    <div class="section-title mb-3">
                        <h4>Guest Log in</h4>
                    </div>

                    <ul class="guest-feature-list">
                        <li class="d-flex">
                            <i class="icofont-block-left"></i>
                            <h6>Make a One Time Payment</h6>
                        </li>

                        <li class="d-flex">
                            <i class="icofont-block-left"></i>
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
include("footer-ar.php")
?>