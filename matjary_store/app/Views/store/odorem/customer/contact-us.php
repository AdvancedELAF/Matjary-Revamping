<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Contact Us']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- CONTACT US SECTION SPACING STARTS -->
<div class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">                
                <div class="section-title">
                    <h2><?php echo $language['Send Message']; ?> <i class="icofont-star-alt-1"></i></h2>
                </div>                
                <div class="contact-form-wrapper">
                    <?php 
                    $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/save-contact-us',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="text" class="form-control mb-0" placeholder="<?php echo $language['Name']; ?>*" id="name" name="name">                    
                    <input type="email" class="form-control mb-0 mt-3 " placeholder="<?php echo $language['Email Address']; ?>*" id="email" name="email">
                    <input type="text" class="form-control mb-0 mt-3 numberonly" placeholder="<?php echo $language['Contact No.']; ?>*" id="contact_no" name="contact_no" minlength="9" maxlength="10">
                    <textarea class="form-control mb-0 mt-3" rows="3" placeholder="<?php echo $language['Your Message']; ?>*" id="massage" maxlength = "500" name="massage"></textarea>
                    <button class="btn btn-primary brand-btn mt-3 float-<?php echo $locale=='ar'?'left':'right'; ?>"><?php echo $language['Send Message']; ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-banner">
                    <img src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/contact-banner.jpg'); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact-map">
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?>&output=embed"></iframe> 
</div>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>