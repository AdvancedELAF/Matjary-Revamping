<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Login']; ?></h1>
        </div>
    </div>
</section>
<!-- LOGIN SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php 
                    $attributes = ['name' => 'customer_login_form', 'id' => 'customer_login_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/customer-login',$attributes); 
                ?>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="login-signup-wrapper">
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="brand-input mb-3"  placeholder="<?php echo $language['Username']; ?>*" <?php echo $language['Email']; ?>*>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" class="brand-input mb-3" placeholder="<?php echo $language['Password']; ?>*">
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button  type="reset" class="btn btn-primary brand-btn"><?php echo $language['Reset']; ?></button>
                        <button  type="submit" class="btn btn-primary g-brand-btn"><?php echo $language['Login']; ?></button>
                    </div>
                    <div class="loginSignupLink text-center mt-3">
                        <a href="<?php echo base_url('customer/forgot-password'); ?>">
                            <h5><?php echo $language['Forgot Password']; ?>?</h5>
                        </a>
                        <a href="<?php echo base_url('customer/register'); ?>">
                            <h5><?php echo $language['New User? Register']; ?></h5>
                        </a>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- LOGIN SECTION ENDS -->
<?php $this->endSection(); ?>