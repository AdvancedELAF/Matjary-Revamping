<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

$title ="";
$short_description ="";
$long_description = "";
if($ses_lang == 'en'){
    if(isset($GetAboutUsInfo->title) && !empty($GetAboutUsInfo->title)){
        $title = $GetAboutUsInfo->title;
    }else{
        $title = isset($GetAboutUsInfo->title_ar) ? $GetAboutUsInfo->title_ar : '' ;
    }

    if(isset($GetAboutUsInfo->short_description) && !empty($GetAboutUsInfo->short_description)){
        $short_description = $GetAboutUsInfo->short_description;
    }else{
        $short_description = isset($GetAboutUsInfo->short_description_ar) ? $GetAboutUsInfo->short_description_ar : '' ;
    }
    
    if(isset($GetAboutUsInfo->long_description) && !empty($GetAboutUsInfo->long_description)){
        $long_description = $GetAboutUsInfo->long_description;
    }else{
        $long_description = isset($GetAboutUsInfo->long_description_ar) ? $GetAboutUsInfo->long_description_ar : '' ;
    }
    
}else{
    if(isset($GetAboutUsInfo->title_ar) && !empty($GetAboutUsInfo->title_ar)){
        $title = $GetAboutUsInfo->title_ar;
    }else{
        $title = isset($GetAboutUsInfo->title) ? $GetAboutUsInfo->title : '' ;
    }

    if(isset($GetAboutUsInfo->short_description_ar) && !empty($GetAboutUsInfo->short_description_ar)){
        $short_description = $GetAboutUsInfo->short_description_ar;
    }else{
        $short_description = isset($GetAboutUsInfo->short_description) ? $GetAboutUsInfo->short_description : '' ;
    }

    if(isset($GetAboutUsInfo->long_description_ar) && !empty($GetAboutUsInfo->long_description_ar)){
        $long_description = $GetAboutUsInfo->long_description_ar;
    }else{
        $long_description = isset($GetAboutUsInfo->long_description) ? $GetAboutUsInfo->long_description : '' ;
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
                    <h4><?php echo $language['About Us']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">CMS</a></li>                       
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['About Us']; ?></li>
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
                 
                    if(!empty($GetAboutUsInfo)){
                        $attributes = ['name' => 'update_about_us_form', 'id' => 'update_about_us_form', 'autocomplete' => 'off',]; 
                        echo form_open_multipart('admin/update-about-us',$attributes); 
                    }else{
                        $attributes = ['name' => 'save_about_us_form', 'id' => 'save_about_us_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-about-us',$attributes); 
                    }
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="id" value="<?php echo isset($GetAboutUsInfo->id)?$GetAboutUsInfo->id:''; ?>" />                         
                    <div class="row">
                        <div class="col-md-12">
                                <div class="mb-2">
                                    <label><?php echo $language['Title']; ?> </label>                                    
                                    <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?> class="form-control" placeholder="<?php echo $language['Title']; ?>" value="<?php echo $title; ?>">
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Image']; ?></label>
                                    <input type="file" name="image" id="image" class="form-control" >
                                </div>
                        </div>
                        
                        <div class="col-md-6">
                                <?php if(isset($GetAboutUsInfo->image) && !empty($GetAboutUsInfo->image)){ ?>
                                    <img src="<?php echo base_url('uploads/aboutus/'); ?>/<?php echo isset($GetAboutUsInfo->image)?$GetAboutUsInfo->image:''; ?>" alt="Abou Us image | <?php echo isset($GetAboutUsInfo->title)?$GetAboutUsInfo->title:''; ?>" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                   
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($GetAboutUsInfo->image)?$GetAboutUsInfo->image:''; ?>" data-id="<?php echo $GetAboutUsInfo->id; ?>" data-tablename="aboutus" data-tablecolumn="image"><i class="dw dw-delete-3"></i></a>
                                <?php }else{ ?>
                                    <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Banner image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                <?php } ?> 
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">                        
                            <div class="mt-3">
                            <label><?php echo $language['Short Description']; ?> </label>
                                <textarea cols="80" class="form-control" <?php echo $ses_lang == 'en' ? 'name="short_description" id="short_description"' : 'name="short_description_ar" id="short_description_ar"'; ?>  rows="10" data-error=".error1"><?php echo $short_description; ?> </textarea>        
                            </div>
                        </div>                                               
                    </div>
                    </br><span class="error1"></span> 
                    <div class="row">                        
                        <div class="col-md-12">                        
                            <div class="mt-3">
                            <label><?php echo $language['Long Description']; ?> </label>
                                <textarea cols="80" class="form-control" <?php echo $ses_lang == 'en' ? 'name="long_description" id="long_description"' : 'name="long_description_ar" id="long_description_ar"'; ?> rows="10" data-error=".error2"> <?php echo $long_description; ?></textarea>        
                            </div>
                        </div>                                               
                    </div>
                    </br><span class="error2"></span> 
                    <div class="d-grid gap-2 d-md-block text-right mt-4">
                        <?php if(!empty($GetAboutUsInfo)){ ?>
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
    CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'long_description' );
    CKEDITOR.replace( 'short_description_ar' );
    CKEDITOR.replace( 'long_description_ar' );
    CKEDITOR.config.autoParagraph = false;
</script>
<?php $this->endSection(); ?>