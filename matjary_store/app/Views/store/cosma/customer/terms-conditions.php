<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

$title = isset($GetTCInfo->title)?$GetTCInfo->title:'';
$title_ar = isset($GetTCInfo->title_ar)?$GetTCInfo->title_ar:'';
$description = isset($GetTCInfo->description)?$GetTCInfo->description:'';
$description_ar = isset($GetTCInfo->description_ar)?$GetTCInfo->description_ar:'';
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<div class="page-bar">
    <div class="container">
        <div class="section-title">
            <h4><?php echo $language['Terms & Conditions']; ?></h4>
        </div>
    </div>
</div>
<!-- PAGE BAR ENDS -->
<!-- ABOUT US US SECTION SPACING STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <?php //echo '<pre>'; print_r($GetTCInfo);?>
        <div class="section-title text-center mb-3">
            <h4><?php echo $ses_lang=='en' ? $title : $title_ar; ?></h4>
        </div>

        <div class="page-content">
            <p><?php echo $ses_lang=='en' ? $description : $description_ar;  ?></p>
        </div>
    </div>
</section>
<!-- ABOUT US US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>