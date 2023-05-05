<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Customer Help']; ?></h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="help-tab">
            <div class="row">             
                <div class="col-12">
                    <div class="tab-content help-content" id="v-pills-tabContent">
                        <div class="tab-pane help-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">                         
                            <p><?php echo $ses_lang=='en' ? $CusHelpData->customer_help : $CusHelpData->customer_help_ar; ?></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>
