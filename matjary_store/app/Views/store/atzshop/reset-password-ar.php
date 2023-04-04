<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>Reset Password</h4>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="rp-wrapper text-right">
                    <div class="mb-3">
                        <label class="form-label mb-2">Password <span class="required-mark">*</span></label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-2">Confirm Password <span class="required-mark">*</span></label>
                        <input type="password" class="form-control">
                    </div>

                    <button class=" brand-btn mx-auto d-block">Update</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<?php
include("footer-ar.php")
?>