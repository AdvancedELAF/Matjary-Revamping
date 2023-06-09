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
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Privacy Policy']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- ABOUT US US SECTION SPACING STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-content">
            <p><?php echo $ses_lang=='en' ? $title : $title_ar; ?></p>
        </div>
        <div class="page-content">
            <p><?php echo $ses_lang=='en' ? $description : $description_ar;  ?></p>
        </div>
    </div>
</section>
<!-- ABOUT US US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>