<?php
include("functions.php");
include("header-ar.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> My Profile <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<div class="section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="my-profile-wrapper">
                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" readonly="" class="form-control-plaintext remove-border" value="sultansiddiqui">
                    </div>

                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Current Password</label>
                                <input type="password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>New Password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-block text-right">
                        <button class="btn btn-primary brand-btn">Cancel</button>
                        <button class="btn btn-primary brand-btn">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

<?php
include("footer-ar.php")
?>