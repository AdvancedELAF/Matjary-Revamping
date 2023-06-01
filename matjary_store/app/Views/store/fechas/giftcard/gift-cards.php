<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Gift cards']; ?></h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <?php 
            $giftCard = $locale=='en'?'Data Not Available Yet!.':'البيانات غير متوفرة بعد!'; 
            if(isset($GiftCardList) && !empty($GiftCardList)){
                foreach($GiftCardList as $GiftCardData){
                    $giftCardDefaultMsg = false;
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
                        $giftCardDefaultMsg = True;
                        ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="gc-wrapper">
                                <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                                    <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                                </a>
                                <div class="prod-detail text-center">
                                    <a href="#">
                                        <h4><?php echo $name; ?></h4>
                                    </a>
                                    
                                </div>
                                <div class="prod-btn">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="g-brand-btn" type="button"><?php echo $language['Details']; ?></a>
                                </div>
                            </div>
                        </div>  
                        <?php
                    }
                } ?>
                <div class="page-content">       
                    <p><?php if($giftCardDefaultMsg == false ){echo $giftCard; } ?></p>                   
                </div>
            <?php }else{ ?>
                <div class="page-content">       
                    <p><?php echo $giftCard; ?></p>                   
                </div>
            <?php }
            ?>          
        </div>
    </div>
</section>
<!-- GIFT CARD LISTING SECTION ENDS -->
<!-- Footer section  -->
<?php $this->endSection(); ?>