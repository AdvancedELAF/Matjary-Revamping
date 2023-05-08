<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section >
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="trans-page-title">
                <h1><?php echo $language['Gift cards']; ?></h1>
            </div>
    </div>
</section>

<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
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
                <div class="prod-wrapper text-center">
                    <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                    </a>
                    <div class="prod-title mb-4">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                            <h5><?php echo isset($name)?$name:'NA'; ?></h5>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="brand-btn-add-cart"><?php echo $language['Details']; ?></a>
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