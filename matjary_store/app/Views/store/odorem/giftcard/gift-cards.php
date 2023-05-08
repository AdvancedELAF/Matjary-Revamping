<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Gift cards']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <?php 
            $giftCard = $locale=='en'?'Data Not Available Yet!.':'البيانات غير متوفرة بعد!';          
            //echo '<pre>'; print_r($GiftCardList); die;  
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
                  
                    if(date("Y-m-d",strtotime($GiftCardData->expiry_date)) >= $today){
                        $giftCardDefaultMsg = True;
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="prod-card">
                    <div class="prod-wrapper">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                            <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                        </a>
                    </div>
                    <div class="prod-details">
                        <h4><?php echo $name; ?></h4>                       
                        <div class="prod-btn d-grid">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="btn btn-primary brand-btn"><?php echo $language['Details']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                        }
                    }?>
                    <div class="page-content">       
                        <p><?php if($giftCardDefaultMsg == false ){echo $giftCard; } ?></p>                   
                    </div>
                <?php
            }else{ ?>
                <div class="prod-detail text-center">                    
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