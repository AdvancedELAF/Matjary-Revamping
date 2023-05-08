<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
$customer_help = $locale=='en'?'Data Not Available Yet!.':'البيانات غير متوفرة بعد!';   
    if($ses_lang=='en'){
        if(isset($CusHelpData->customer_help) && !empty($CusHelpData->customer_help)){
            $customer_help = $CusHelpData->customer_help;
        }else{
            if(isset($CusHelpData->customer_help_ar) && !empty($CusHelpData->customer_help_ar)){
                $customer_help = $CusHelpData->customer_help_ar;
            }
        } 
      
    }else{
        if(isset($CusHelpData->customer_help_ar) && !empty($CusHelpData->customer_help_ar)){
            $customer_help = $CusHelpData->customer_help_ar;
        }else{
            if(isset($CusHelpData->customer_help) && !empty($CusHelpData->customer_help)){
                $customer_help = $CusHelpData->customer_help;
            }
        }         
                                                 
    } 
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner-bg <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Help Menu']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">    
        <div class="help-tab">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content help-content" id="v-pills-tabContent">
                        <div class="tab-pane help-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">                            
                            <p><?php echo $customer_help; ?></p>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>
