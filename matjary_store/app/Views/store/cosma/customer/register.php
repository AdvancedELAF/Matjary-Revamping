<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<div class="page-bar">
    <div class="container">
        <div class="section-title">
            <h4><?php echo $language['Register']; ?></h4>
        </div>
    </div>
</div>
<!-- PAGE BAR ENDS -->
<!-- SIGN UP SECTION STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') {
                                    echo 'text-right';
                                } ?>">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h4><?php echo $language['New User? Register']; ?></h4>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="checkout-login-wrapper">
                    <?php
                    $attributes = ['name' => 'save_customer_register_form', 'id' => 'save_customer_register_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('customer/save-customer-register', $attributes);
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="<?php echo $language['Enter Full Name']; ?>*">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="contact_no" id="contact_no" minlength="9" maxlength="10" class="form-control numberonly" placeholder="<?php echo $language['Enter Contact No']; ?>*" minlength="9" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo $language['Email Address']; ?>*">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language['Password']; ?>*">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="cnf_password" id="cnf_password" class="form-control" placeholder="<?php echo $language['Confirm Password']; ?>*">
                    </div>
                    <!-- <div class="custom-control custom-checkbox newsletter-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="newsletterCheck">
                        <label class="custom-control-label" for="newsletterCheck">Subscribe Newsletter</label>
                    </div> -->
                    <div class="d-grid gap-2 d-md-block <?php if ($locale == 'ar') {
                                                            echo 'text-right';
                                                        } ?>">
                        <button type="reset" class="btn btn-primary brand-btn-black-outline"><?php echo $language['Reset']; ?></button>
                        <button type="submit" class="btn btn-primary brand-btn-black"><?php echo $language['Register']; ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- SIGN UP SECTION ENDS -->
<?php $this->endSection(); ?>