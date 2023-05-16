<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- SIGN UP SECTION STARTS -->
<section class="section-spacing signup-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-signup-panel">
                    <div class="ui-title text-white">
                        <h4 class="mb-3"><?php echo $language['New User? Register']; ?>!</h4>
                    </div>
                    <div class="login-signup-wrap">
                    <?php 
                        $attributes = ['name' => 'save_customer_register_form', 'id' => 'save_customer_register_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/save-customer-register',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="brand-label text-orange"><?php echo $language['Full Name']; ?> <span class="required-mark">*</span></label>
                                    <input type="text" name="name" id="name" class="brand-input " placeholder="<?php echo $language['Full Name']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="brand-label text-orange"><?php echo $language['Contact Number']; ?> <span class="required-mark">*</span></label>                                    
                                    <input type="text" name="contact_no" id="contact_no" minlength="9" maxlength="10" class="brand-input numberonly" placeholder="<?php echo $language['Enter Contact No']; ?>" minlength="9" maxlength="10">
                                </div>
                            </div>
                        </div>

                       <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Email Address']; ?> <span class="required-mark">*</span></label>
                            <input type="email" name="email" id="email" class="brand-input" placeholder="<?php echo $language['Email Address']; ?>">
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="brand-label text-orange"><?php echo $language['Password']; ?> <span class="required-mark">*</span></label>                                    
                                    <input type="password" name="password" id="password" class="brand-input" placeholder="<?php echo $language['Password']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="brand-label text-orange"><?php echo $language['Confirm Password']; ?><span class="required-mark">*</span></label>                                    
                                    <input type="password" name="cnf_password" id="cnf_password" class="brand-input" placeholder="<?php echo $language['Confirm Password']; ?>"><br>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="loginSignupLink text-left mt-3">
                                    <a href="#">
                                        <h6><?php echo $language['Already a User? Login']; ?></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right mt-3">
                                    <button type="submit" class="brand-btn-orange"><?php echo $language['Sign Up']; ?></button>
                                    <button type="reset"  class="brand-btn-white"><?php echo $language['Reset']; ?></button>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- SIGN UP SECTION ENDS -->
<?php $this->endSection(); ?>