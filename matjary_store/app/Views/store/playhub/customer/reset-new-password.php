<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->

<section <?php if($locale=='ar'){echo 'text-right';} ?>>
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['Set new Password']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- SET NEW PASSWORD SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid"> 
        <div class="brand-wrap">      
            <div class="row">           
                <div class="col-md-6 offset-md-3">
                    <div class="rp-wrapper">  
                    <?php if(isset($errorMsg) && !empty($errorMsg)){ ?>
                        <p class="text-center">Sorry!</p>
                        <p><?php echo $errorMsg; ?></p>
                        <?php }else{ ?>
                        <?php 
                            $attributes = ['name' => 'customer_set_new_password_form', 'id' => 'customer_set_new_password_form', 'autocomplete' => 'off']; 
                            echo form_open_multipart('customer/save-reset-password',$attributes); 
                        ?>   
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo isset($customer_id)?$customer_id:''; ?>" />
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label class="brand-label text-orange" ><?php echo $language['Set new Password']; ?><span class="required-mark">*</span></label>
                                
                                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language['Set new Password']; ?>*">
                            </div>
                            <div class="col-md-6">
                                <label class="brand-label text-orange" ><?php echo $language['Confirm New Password']; ?><span class="required-mark">*</span></label>
                                <input type="password" name="cnf_password" id="cnf_password" class="form-control" placeholder="<?php echo $language['Confirm New Password']; ?>*">
                       
                            </div>
                        </div>
                        <div class="text-center mt-2">                       
                         <button class="brand-btn-orange"><?php echo $language['Update']; ?></button>
                        </div>
                        <?php echo form_close(); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- SET NEW PASSWORD SECTION ENDS -->
<?php $this->endSection(); ?>