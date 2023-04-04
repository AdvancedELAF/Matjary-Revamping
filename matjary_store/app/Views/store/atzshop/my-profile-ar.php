<?php
include("functions.php");
include("header-ar.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4>My Profile</h4>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="my-profile-wrapper text-right">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" readonly="" class="form-control-plaintext remove-border" value="sultansiddiqui">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-2">Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-2">Current Password</label>
                                <input type="password" class="form-control">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-2">New Password</label>
                                <input type="password" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-2">Confirm New Password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn">Cancel</button>
                        <button class="btn btn-primary brand-btn">Save</button>
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