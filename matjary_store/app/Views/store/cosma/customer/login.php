<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<div class="page-bar">
    <div class="container">
        <div class="section-title">
            <h4><?php echo $language['Log in']; ?></h4>
        </div>
    </div>
</div>
<!-- PAGE BAR ENDS -->
<!-- LOGIN SECTION STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') {
                                    echo 'text-right';
                                } ?>">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h4><?php echo $language['Already a User? Log in']; ?>!</h4>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="checkout-login-wrapper">
                    <?php
                    $attributes = ['name' => 'customer_login_form', 'id' => 'customer_login_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('customer/customer-login', $attributes);
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo $language['Email']; ?>*">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language['Password']; ?>*">
                    </div>

                    <div class="d-grid gap-2 d-md-block <?php if ($locale == 'ar') {
                                                            echo 'text-right';
                                                        } ?>">
                        <button type="reset" class="btn btn-primary brand-btn-black-outline"><?php echo $language['Reset']; ?></button>
                        <button type="submit" class="btn btn-primary brand-btn-black"><?php echo $language['Login']; ?></button>
                    </div>
                    <div class="loginSignupLink">
                        <a href="<?php echo base_url('customer/forgot-password'); ?>">
                            <h5><?php echo $language['Forgot Password']; ?>?</h5>
                        </a>
                        <a href="<?php echo base_url('customer/register'); ?>">
                            <h5><?php echo $language['New User? Register']; ?></h5>
                        </a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- LOGIN SECTION ENDS -->
<?php $this->endSection(); ?>