<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- RESET PASSWORD FORM STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-3">
            <h4><?php echo $language['Change Password']; ?></h4>
        </div>
        <div class="row">           
            <div class="col-md-12">
                <div class="rp-wrapper">  
                    <?php                     
                    $attributes = ['name' => 'update_change_password_form', 'id' => 'update_change_password_form', 'autocomplete' => 'off',]; 
                    echo form_open_multipart('customer/save-change-password',$attributes);                     
                    ?>    
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="customer_id" value="<?php echo isset($getCurId)?$getCurId:''; ?>" />              
                    <div class="row">
                            <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label><?php echo $language['Old Password']; ?></label>                                
                            </div>
                                <input type="password" class="form-control form-label mb-2" id="oldpassword" name="oldpassword">
                            </div>
                    </div>
                    <div class="row ">
                            <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label><?php echo $language['New Password']; ?></label>                                
                            </div>
                                <input type="password" class="form-control form-label mb-2 " id="password" name="password">
                            </div>
                            <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <label><?php echo $language['Confirm Password']; ?></label>                                
                            </div>
                                <input type="password" class="form-control form-label mb-2" id="cnf_password" name="cnf_password">
                            </div>
                    </div>                        
                    <button class="btn btn-primary brand-btn mx-auto m-3 d-block"><?php echo $language['Update']; ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- RESET PASSWORD FORM ENDS -->
<?php $this->endSection(); ?>