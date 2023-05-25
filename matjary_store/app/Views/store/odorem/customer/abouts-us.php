<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['About Us']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- ABOUT US US SECTION SPACING STARTS -->
<section class="section-spacing">
    <div class="container">
    <?php 
        $checkshortDesc = $locale=='en'?'Short Description Not Available For Now Store About Us Content/Information Not Available Yet!.':'الوصف المختصر غير متوفر حاليًا قم بتخزين معلومات عنا المحتوى / المعلومات غير متوفرة بعد !.';
        $checkLongDesc = $locale=='en'?'Long Description Not Available For Now Store About Us Content/Information Not Available Yet!.':'الوصف الطويل غير متوفر حاليًا قم بتخزين معلومات عنا المحتوى / المعلومات غير متوفرة بعد !.';
        if($locale=='en'){
            if(isset($GetAboutUsInfo->short_description) && !empty($GetAboutUsInfo->short_description)){
                $checkshortDesc = substr($GetAboutUsInfo->short_description, 0, 500);
            }else{
                if(isset($GetAboutUsInfo->short_description_ar) && !empty($GetAboutUsInfo->short_description_ar)){
                    $checkshortDesc = substr($GetAboutUsInfo->short_description_ar, 0, 500);
                }
            }
            if(isset($GetAboutUsInfo->long_description) && !empty($GetAboutUsInfo->long_description)){
                $checkLongDesc = substr($GetAboutUsInfo->long_description, 0, 500);
            }else{
                if(isset($GetAboutUsInfo->long_description_ar) && !empty($GetAboutUsInfo->long_description_ar)){
                    $checkLongDesc = substr($GetAboutUsInfo->long_description_ar, 0, 500);
                }
            }
        }else{
            if(isset($GetAboutUsInfo->short_description_ar) && !empty($GetAboutUsInfo->short_description_ar)){
                $checkshortDesc = substr($GetAboutUsInfo->short_description_ar, 0, 500);
            }else{
                if(isset($GetAboutUsInfo->short_description) && !empty($GetAboutUsInfo->short_description)){
                    $checkshortDesc = substr($GetAboutUsInfo->short_description, 0, 500);
                }
            }
            if(isset($GetAboutUsInfo->long_description_ar) && !empty($GetAboutUsInfo->long_description_ar)){
                $checkLongDesc = substr($GetAboutUsInfo->long_description_ar, 0, 500);
            }else{
                if(isset($GetAboutUsInfo->long_description) && !empty($GetAboutUsInfo->long_description)){
                    $checkLongDesc = substr($GetAboutUsInfo->long_description, 0, 500);
                }
            }
        }                    
    ?>
        <div class="section-title text-center mb-3">
            <h4><?php echo $checkshortDesc; ?></h4>
        </div>
        <div class="page-content">
            <p><?php echo $checkLongDesc; ?></p>
        </div>
    </div>
</section>
<!-- ABOUT US US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>