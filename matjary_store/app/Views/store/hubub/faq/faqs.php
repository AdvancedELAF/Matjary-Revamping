
<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['FAQ']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->

<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">       
        <?php
        $checkfaqData = $locale=='en'?'FAQ Content/Information Not Available Yet!.':'الأسئلة الشائعة المحتوى / المعلومات غير متوفرة بعد !.';
        if (isset($faqList) && !empty($faqList)) {
            foreach ($faqList as $i => $faqData) {
                $question = '';
                $answear = '';
                if($ses_lang=='en'){
                    if(isset($faqData->question) && !empty($faqData->question)){
                        $question = $faqData->question;
                    }else{
                        if(isset($faqData->question_ar) && !empty($faqData->question_ar)){
                            $question = $faqData->question_ar;
                        }
                    } 
                    if(isset($faqData->answear) && !empty($faqData->answear)){
                        $answear = $faqData->answear;
                    }else{
                        if(isset($faqData->answear_ar) && !empty($faqData->answear_ar)){
                            $answear = $faqData->answear_ar;
                        }
                    }
                }else{
                    if(isset($faqData->question_ar) && !empty($faqData->question_ar)){
                        $question = $faqData->question_ar;
                    }else{
                        if(isset($faqData->question) && !empty($faqData->question)){
                            $question = $faqData->question;
                        }
                    }         
                    if(isset($faqData->answear_ar) && !empty($faqData->answear_ar)){
                        $answear = $faqData->answear_ar;
                    }else{
                        if(isset($faqData->answear) && !empty($faqData->answear)){
                            $answear = $faqData->answear;
                        }
                    }                                               
                }
        ?>
            <div class="page-content">
                <h4><?php echo $question; ?></h4>
            </div>
            <div class="page-content">
                <p><?php echo $answear; ?></p>
            </div>
        <?php
            }
        }else{ ?>
            <div class="page-content">
                <?php echo $checkfaqData; ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php $this->endSection(); ?>