
<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
$customer_help ="";
if($ses_lang == 'en'){
    if(isset($CustomerHelp[0]['customer_help']) && !empty($CustomerHelp[0]['customer_help'])){
        $customer_help = $CustomerHelp[0]['customer_help'];
    }else{
        $customer_help = isset($CustomerHelp[0]['customer_help_ar']) ? $CustomerHelp[0]['customer_help_ar'] : '' ;
    }    
    
}else{
    if(isset($CustomerHelp[0]['customer_help_ar']) && !empty($CustomerHelp[0]['customer_help_ar'])){
        $customer_help = $CustomerHelp[0]['customer_help_ar'];
    }else{
        $customer_help = isset($CustomerHelp[0]['customer_help']) ? $CustomerHelp[0]['customer_help'] : '' ;
    }  
}
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Customer Help']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Help']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Customer Help']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">                 
                    <?php 
                    if(!empty($CustomerHelp[0]['customer_help'])){
                        $attributes = ['name' => 'update_customer_help_form', 'id' => 'update_customer_help_form', 'autocomplete' => 'off',]; 
                        echo form_open_multipart('admin/update-customer-help',$attributes); 
                    }else{
                        $attributes = ['name' => 'save_customer_help_form', 'id' => 'save_customer_help_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-customer-help',$attributes); 
                    }
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="cushelp_id" value="<?php echo isset($CustomerHelp[0]['id'])?$CustomerHelp[0]['id']:''; ?>" />                         
                    <div class="row">
                        <div class="col-md-12">                        
                            <div class="mt-3">
                            <label><?php echo $language['Customer Help']; ?></label>
                                <textarea cols="80" <?php echo $ses_lang == 'en' ? 'name="customer_help" id="customer_help"' : 'name="customer_help_ar" id="customer_help_ar"'; ?> rows="10" data-error=".error1" ><?php echo $customer_help; ?></textarea>        
                            </div>
                        </div>                        
                    </div>
                    </br><span class="error1"></span>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <?php if(!empty($CustomerHelp[0]['customer_help'])){ ?>
                            <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <?php }else { ?>
                            <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <?php } ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('customer_help');
    CKEDITOR.replace('customer_help_ar');
    CKEDITOR.config.autoParagraph = false;
</script>
<?php $this->endSection(); ?>