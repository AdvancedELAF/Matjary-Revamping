<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="section-title text-center mb-5"><h4><?php echo $language['Customer Help']; ?></h4></div>
    <div class="container">    
        <div class="help-tab">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content help-content" id="v-pills-tabContent">
                        <div class="tab-pane help-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">                            
                            <p><?php echo $ses_lang=='en' ? $CusHelpData->customer_help : $CusHelpData->customer_help_ar; ?></p>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>
