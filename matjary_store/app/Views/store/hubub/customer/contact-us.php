<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Contact Us']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- CONTACT US SECTION SPACING STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title mb-4">
                    <h4><?php echo $language['Message Us']; ?></h4>
                </div>
                <?php 
                    $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/save-contact-us',$attributes); 
                ?>    
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="contact-form mb-3">
                    <div class="mb-3">
                        <input type="text" class="brand-input" placeholder="<?php echo $language['Name']; ?>*" id="name" name="name">   
                    </div>

                    <div class="mb-3">
                        <input type="email" class="brand-input" placeholder="<?php echo $language['Email Address']; ?>*" id="email" name="email">                        
                    </div>
                    <div class="mb-3">
                        <input type="text" class="brand-input numberonly" placeholder="<?php echo $language['Contact No.']; ?>*" id="contact_no" name="contact_no" minlength="9" maxlength="10" >                    
                    </div>
                   
                    <div class="mb-3">
                        <textarea rows="4" class="brand-textarea" placeholder="<?php echo $language['Your Message']; ?>*" id="massage" maxlength = "500" name="massage"></textarea>
                    </div>
                    <div class="text-right">
                        <button class="brand-btn"><?php echo $language['Submit']; ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-6">
            <div class="contact-map mb-3">
            <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?>&output=embed"></iframe> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>