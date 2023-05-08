<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h4><?php echo $language['Gift cards']; ?></h4>
        </div>
        <div class="row">
                    
            <?php //echo '<pre>'; print_r($GiftCardList);
            $giftCard = $locale=='en'?'Data Not Available Yet!.':'البيانات غير متوفرة بعد!';  
            if(isset($GiftCardList) && !empty($GiftCardList)){
                foreach($GiftCardList as $GiftCardData){
                    $today = date("Y-m-d");
                    $name = '';
                    if($ses_lang=='en'){
                        if(isset($GiftCardData->name) && !empty($GiftCardData->name)){
                            $name = $GiftCardData->name;
                        }else{
                            if(isset($GiftCardData->name_ar) && !empty($GiftCardData->name_ar)){
                                $name = $GiftCardData->name_ar;
                            }
                        } 
                    }else{
                        if(isset($GiftCardData->name_ar) && !empty($GiftCardData->name_ar)){
                            $name = $GiftCardData->name_ar;
                        }else{
                            if(isset($GiftCardData->name) && !empty($GiftCardData->name)){
                                $name = $GiftCardData->name;
                            }
                        }                                                        
                    }
                    $today = date("Y-m-d");
                    if(date("Y-m-d",strtotime($GiftCardData->expiry_date)) >= $today){
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="gc-wrapper">
                    <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                    </a>
                    <div class="gc-detail">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                            <h4><?php echo $name; ?></h4>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="btn btn-primary brand-btn"><?php echo $language['Details']; ?></a>
                    </div>
                </div>    
            </div>
            <?php
                    }
                }
            }else{ ?>
                <div class="gc-detail">                    
                    <h4><?php echo $giftCard; ?></h4>                   
                </div>
            <?php }
            ?>          
        </div>
    </div>
</section>

<!-- GIFT CARD LISTING SECTION ENDS -->

<!-- Footer section  -->
<?php $this->endSection(); ?>