
<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<div class="page-bar">
    <div class="container">
        <div class="section-title">
            <h4><?php echo $language['FAQ']; ?></h4>
        </div>
    </div>
</div>
<!-- PAGE BAR ENDS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h4><?php echo $language['Frequently Asked Questions']; ?></h4>
        </div>
        <?php
        if(isset($faqList) && !empty($faqList)) {
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
            <div class="faq-ques">
                <h4><?php echo $question; ?></h4>
            </div>
            <div class="faq-ans">
                <p><?php echo $answear; ?></p>
            </div>
        <?php
            }
        }
        ?>
    </div>
</section>
<?php $this->endSection(); ?>