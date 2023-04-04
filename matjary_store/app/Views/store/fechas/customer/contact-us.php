<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
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
        <div class="col-lg-6">
            <div class="contact-map mb-3">
            <iframe width="100%" height="700" style="border:0;"  src="https://maps.google.com/maps?q=<?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?>&output=embed"></iframe> 
            </div>
        </div>

        <div class="col-lg-6">
            <div class="contact-wrapper mb-3">
                <h3 class="contact-title"><?php echo $language['Contact Us']; ?></h3>

            <?php 
                $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
                echo form_open_multipart('customer/save-contact-us',$attributes); 
            ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="mb-3">
                <input type="text" class="brand-input" placeholder="<?php echo $language['Name']; ?>" id="name" name="name">
            </div>
            <div class="mb-3">
                 <input type="email" class="brand-input" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email">
            </div>
            <div class="mb-3">
                <input type="text" class="brand-input numberonly" placeholder="<?php echo $language['Contact No.']; ?>*" minlength="9" maxlength="10" id="contact_no" name="contact_no" minlength="9" maxlength="10">
            </div>
            <div class="mb-3">
                <textarea type="text" class="brand-input" placeholder="<?php echo $language['Your Message']; ?>" rows="5" id="massage" maxlength = "500" name="massage"></textarea></br>
            </div>
                 <button class="g-brand-btn btn-block"><?php echo $language['Submit']; ?></button>
            <?php echo form_close(); ?>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="cont-box text-center mb-2">
                        <i class="icofont-envelope"></i>
                        <a href="mailto:webmaster@example.com"><h6><?php echo isset($GetGeneralSettingInfo->support_email)?$GetGeneralSettingInfo->support_email:''; ?><h6></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cont-box text-center mb-2">
                        <i class="icofont-telephone"></i>
                        <a href="tel:+9661123456789">
                            <h6><?php echo isset($GetGeneralSettingInfo->contact_no)?$GetGeneralSettingInfo->contact_no:''; ?></h6>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="cont-box text-center mb-2">
                        <i class="icofont-map"></i>
                        <a href="#">
                            <h6><?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?></h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>       
    </div>
</section>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>