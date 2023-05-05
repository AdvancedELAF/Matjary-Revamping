<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="section-spacing">
<div class="section-title text-center mb-5"><h4><?php echo $language['Customer Help']; ?></h4></div>
    <div class="container">    
        <div class="help-tab">
            <div class="row">
                <div class="col-9">
                    <div class="tab-content help-content" id="v-pills-tabContent">
                        <div class="tab-pane help-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">                            
                            <p><?php echo $locale=='en' ? $CusHelpData->customer_help : $CusHelpData->customer_help_ar; ?></p>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>
