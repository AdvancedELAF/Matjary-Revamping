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
                    <h4><?php echo $language['Update Product Brand']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>"><?php echo $language['Products']; ?></a></li>                        
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Product Brand']; ?></li>
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
                        $attributes = ['name' => 'update_product_brand_form', 'id' => 'update_product_brand_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-product-brand',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="brand_id" value="<?php echo isset($prodBrandDetails['id'])?$prodBrandDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label><?php echo $language['Brand Name']; ?></label>
                                <input type="text" name="brand_name" id="brand_name" value="<?php echo isset($prodBrandDetails['brand_name'])?$prodBrandDetails['brand_name']:''; ?>" class="form-control" placeholder="<?php echo $language['Brand Name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Brand Image']; ?></label>
                                <input type="file" name="brand_image" id="brand_image" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(isset($prodBrandDetails['brand_image']) && !empty($prodBrandDetails['brand_image'])){ ?>
                                <img src="<?php echo base_url('uploads/product_brands/'); ?>/<?php echo isset($prodBrandDetails['brand_image'])?$prodBrandDetails['brand_image']:''; ?>" alt="Product brand image | <?php echo isset($prodBrandDetails['brand_name'])?$prodBrandDetails['brand_name']:''; ?>" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                <a href="<?php echo base_url('uploads/product_brands/'); ?>/<?php echo isset($prodBrandDetails['brand_image'])?$prodBrandDetails['brand_image']:''; ?>" target="_blank"><?php echo $language['click to view']; ?></a> 
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($prodBrandDetails['brand_image'])?$prodBrandDetails['brand_image']:''; ?>" data-id="<?php echo $prodBrandDetails['id']; ?>" data-tablename="Brands" data-tablecolumn="brand_image"><i class="dw dw-delete-3"></i></a>
                            <?php }else{ ?>
                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-product-brands'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>