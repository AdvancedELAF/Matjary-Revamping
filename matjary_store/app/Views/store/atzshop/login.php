<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Login</h4>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-signup-wrapper">
                    <div class="text-center wrapper-title">
                        <h5>Already a user ? Login</h5>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Username <span class="required-mark">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Password <span class="required-mark">*</span></label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Cancel</button>
                        <button class="btn btn-primary brand-btn">Login</button>
                    </div>

                    <div class="loginSignupLink mt-3">
                        <a href="forgot-password.php">
                            <h5>Forgot Password?</h5>
                        </a>

                        <a href="signup.php">
                            <h5>New User? Signup</h5>
                        </a>
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