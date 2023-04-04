<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Sign up</h4>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-signup-wrapper">
                    <div class="text-center wrapper-title">
                        <h5>New user? sign up</h5>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Username <span class="required-mark">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Email Address <span class="required-mark">*</span></label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Password <span class="required-mark">*</span></label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="custom-control custom-checkbox newsletter-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="newsletterCheck">
                        <label class="custom-control-label" for="newsletterCheck">Subscribe Newsletter</label>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Reset</button>
                        <button class="btn btn-primary brand-btn">Signup</button>
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