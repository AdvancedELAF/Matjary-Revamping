<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

    $title = $locale=='en'?'Terms and Conditions Title Not Available Yet!.':'عنوان الشروط والأحكام غير متوفر بعد !.';
    $description = $locale=='en'?'Terms and Conditions Description Not Available Yet!.':'وصف الشروط والأحكام غير متوفر بعد !.';
    if($ses_lang=='en'){
        if(isset($GetTCInfo->title) && !empty($GetTCInfo->title)){
            $title = $GetTCInfo->title;
        }else{
            if(isset($GetTCInfo->title_ar) && !empty($GetTCInfo->title_ar)){
                $title = $GetTCInfo->title_ar;
            }
        } 
        if(isset($GetTCInfo->description) && !empty($GetTCInfo->description)){
            $description = $GetTCInfo->description;
        }else{
            if(isset($GetTCInfo->description_ar) && !empty($GetTCInfo->description_ar)){
                $description = $GetTCInfo->description_ar;
            }
        }
    }else{
        if(isset($GetTCInfo->title_ar) && !empty($GetTCInfo->title_ar)){
            $title = $GetTCInfo->title_ar;
        }else{
            if(isset($GetTCInfo->title) && !empty($GetTCInfo->title)){
                $title = $GetTCInfo->title;
            }
        }         
        if(isset($GetTCInfo->description_ar) && !empty($GetTCInfo->description_ar)){
            $description = $GetTCInfo->description_ar;
        }else{
            if(isset($GetTCInfo->description) && !empty($GetTCInfo->description)){
                $description = $GetTCInfo->description;
            }
        }                                               
    }                  
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
        <div class="section-title text-center mb-3">
            <h4><?php echo $title; ?></h4>
        </div>
        <div class="page-content">
            <p><?php echo $description;  ?></p>
        </div>
    </div>
</section>
<!-- ABOUT US US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>