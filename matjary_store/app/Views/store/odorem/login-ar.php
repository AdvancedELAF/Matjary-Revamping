<?php
include("functions.php");
include("header-ar.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Login <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title mb-3 text-right">
                    <h3><i class="icofont-star-alt-1"></i> Already a User? Login</h3>
                </div>
                <div class="ls-wrapper">
                    <input type="text" class="form-control" placeholder="Username*">
                    <input type="password" class="form-control" placeholder="Password*">
                    <div class="d-grid gap-2 d-md-block text-right">
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
            <div class="col-md-6">
                <div class="ls-banner">
                    <img src="assets/images/login-banner.jpg">
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer-ar.php")
?>