<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
$title ="";
$description ="";
if($ses_lang == 'en'){
    if(isset($GetTermsconditonInfo->title) && !empty($GetTermsconditonInfo->title)){
        $title = $GetTermsconditonInfo->title;
    }else{
        $title = isset($GetTermsconditonInfo->title_ar) ? $GetTermsconditonInfo->title_ar : '' ;
    }

    if(isset($GetTermsconditonInfo->description) && !empty($GetTermsconditonInfo->description)){
        $description = $GetTermsconditonInfo->description;
    }else{
        $description = isset($GetTermsconditonInfo->description_ar) ? $GetTermsconditonInfo->description_ar : '' ;
    }   
    
}else{
    if(isset($GetTermsconditonInfo->title_ar) && !empty($GetTermsconditonInfo->title_ar)){
        $title = $GetTermsconditonInfo->title_ar;
    }else{
        $title = isset($GetTermsconditonInfo->title) ? $GetTermsconditonInfo->title : '' ;
    }

    if(isset($GetTermsconditonInfo->description_ar) && !empty($GetTermsconditonInfo->description_ar)){
        $description = $GetTermsconditonInfo->description_ar;
    }else{
        $description = isset($GetTermsconditonInfo->description) ? $GetTermsconditonInfo->description : '' ;
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
                    <h4><?php echo $language['Terms & Conditions']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">CMS</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Terms & Conditions']; ?></li>
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
                  
                    if(!empty($GetTermsconditonInfo)){
                        $attributes = ['name' => 'update_terms_conditions_form', 'id' => 'update_terms_conditions_form', 'autocomplete' => 'off',]; 
                        echo form_open_multipart('admin/update-terms-conditions',$attributes); 
                    }else{
                        $attributes = ['name' => 'save_terms_conditions_form', 'id' => 'save_terms_conditions_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-terms-conditions',$attributes); 
                    }
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="tc_id" value="<?php echo isset($GetTermsconditonInfo->id)?$GetTermsconditonInfo->id:''; ?>" />                         
                    <div class="row">
                    <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Title']; ?> </label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?> class="form-control" placeholder="<?php echo $language['Title']; ?>" value="<?php echo $title; ?>">
                            </div>
                    </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">                        
                            <div class="mt-3">
                            <label><?php echo $language['Description']; ?> </label>
                                <textarea cols="80" class="form-control" <?php echo $ses_lang == 'en' ? 'name="description" id="description"' : 'name="description_ar" id="description_ar"'; ?>  rows="10" data-error=".error2"><?php echo $description; ?> </textarea>        
                            </div>
                        </div>                                                   
                    </div>
                    </br><span class="error2"></span>
                    <div class="d-grid gap-2 d-md-block text-right mt-4">
                        <?php if(!empty($GetTermsconditonInfo)){ ?>
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'description_ar' );
    CKEditor.config.autograph = false;
</script>
<?php $this->endSection(); ?>