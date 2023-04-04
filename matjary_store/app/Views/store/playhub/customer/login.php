<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>

<!-- LOGIN SECTION STARTS -->
<section class="section-spacing login-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-signup-panel">
                    <div class="ui-title text-white">
                        <h4 class="mb-3"><?php echo $language['Already a User? Log in']; ?>!</h4>
                    </div>
                    <?php 
                        $attributes = ['name' => 'customer_login_form', 'id' => 'customer_login_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/customer-login',$attributes); 
                    ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />                    
                    <div class="login-signup-wrap">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Email Address']; ?> <span class="required-mark">*</span></label>
                            <input type="email" name="email" id="email" class="form-control mb-0" placeholder="<?php echo $language['Email']; ?>*"> 
                        </div>

                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Password']; ?> <span class="required-mark">*</span></label>
                            <input class="brand-input" type="password" name="password" id="password" placeholder="<?php echo $language['Password']; ?>*">
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="loginSignupLink text-left mt-3">
                                    <a href="<?php echo base_url('customer/forgot-password'); ?>">
                                        <h6><?php echo $language['Forgot Password']; ?>?</h6>
                                    </a>
                                    <a href="<?php echo base_url('customer/register'); ?>">
                                        <h6><?php echo $language['New User? Register']; ?></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right mt-3">
                                    <button type="submit" class="brand-btn-orange"><?php echo $language['Login']; ?></button>
                                    <button type="reset" class="brand-btn-white"><?php echo $language['Reset']; ?></button>
                                </div>
                            </div>
                        </div>
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