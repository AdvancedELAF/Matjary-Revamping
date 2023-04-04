<?php
$session = \Config\Services::session();
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
//echo '<pre>'; print_r($ses_lang); exit;
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Add Product Color']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Products</a></li>                        
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Add Product Color']; ?></li>
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
                        $attributes = ['name' => 'save_product_color_form', 'id' => 'save_product_color_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-product-color',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Color Name']; ?></label>
                                <input type="text" <?php echo $ses_lang=='en' ? 'name="color_name" id="color_name"' : 'name="color_name_ar" id="color_name_ar"'; ?> class="form-control" placeholder="<?php echo $language['Color Name']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <a href="<?php echo base_url('admin/all-product-colors'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>