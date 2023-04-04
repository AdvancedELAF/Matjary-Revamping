<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Change Password']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- RESET PASSWORD FORM STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">        
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
                                    <input type="password" class="brand-input form-label mb-2" placeholder="<?php echo $language['Old Password']; ?>" id="oldpassword" name="oldpassword">                                                             
                                </div>                                
                            </div>
                    </div>
                    <div class="row ">
                            <div class="col-md-6 mb-2">
                                <div class="mb-3">
                                    <input type="password" class="brand-input form-label mb-2 " placeholder="<?php echo $language['New Password']; ?>" id="password" name="password">                              
                                </div>                                
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="mb-3">
                                    <input type="password" class="brand-input form-label mb-2" placeholder="<?php echo $language['Confirm Password']; ?>" id="cnf_password" name="cnf_password">                                                               
                                </div>                                
                            </div>
                    </div>                          
                    <button class="g-brand-btn"><?php echo $language['Update']; ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESET PASSWORD FORM ENDS -->
<?php $this->endSection(); ?>