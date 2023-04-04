<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Add Product Brand']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>"><?php echo $language['Products']; ?></a></li>                       
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Add Product Brand']; ?></li>
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
                        $attributes = ['name' => 'save_product_brand_form', 'id' => 'save_product_brand_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-product-brand',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Brand Name']; ?></label>
                                <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="<?php echo $language['Brand Name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Brand Image']; ?></label>
                                <input type="file" name="brand_image" id="brand_image" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <a href="<?php echo base_url('admin/all-product-brands'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>