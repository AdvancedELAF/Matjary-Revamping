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
                    <h4><?php echo $language['Edit Product Category']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Products']; ?></a></li>                        
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Edit Product Category']; ?></li>
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
                        $attributes = ['name' => 'update_product_category_form', 'id' => 'update_product_category_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-product-category',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="cat_id" value="<?php echo isset($prodCatDetails['id'])?$prodCatDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Category Type']; ?></label>
                                <select class="form-control" name="parent_cat_id" id="parent_cat_id">
                                    <option value="0"><?php echo $language['Root Category']; ?></option>
                                    <?php
                                    if(isset($allProductCategoryList) && !empty($allProductCategoryList)){
                                        foreach($allProductCategoryList as $values){
                                    ?>
                                    <option value="<?php echo $values->id; ?>" <?php if($prodCatDetails['parent_cat_id']==$values->id){echo'selected';} ?>><?php echo $values->category_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Category Name']; ?></label>
                                <input type="text" <?php echo $ses_lang=='en'?'name="category_name" id="category_name"':'name="category_name_ar" id="category_name_ar"'; ?> value="<?php echo $ses_lang=='en'?$prodCatDetails['category_name']:$prodCatDetails['category_name_ar']; ?>" class="form-control" placeholder="<?php echo $language['Category Name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label><?php echo $language['Category Description']; ?></label>
                                <textarea <?php echo $ses_lang=='en'?'name="category_desc" id="category_desc"':'name="category_desc_ar" id="category_desc_ar"'; ?> rows="2" class="form-control" placeholder="<?php echo $language['Category Description']; ?>"><?php echo $ses_lang=='en'?$prodCatDetails['category_desc']:$prodCatDetails['category_desc_ar']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Category Image']; ?></label>
                                <input type="file" name="category_img" id="category_img" class="form-control">
                                <a href="<?php echo base_url('uploads/product_category/').'/'.$prodCatDetails['category_img']; ?>" target="_blank"><?php echo isset($prodCatDetails['category_img'])?$prodCatDetails['category_img']:''; ?></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(isset($prodCatDetails['category_img']) && !empty($prodCatDetails['category_img'])){ ?>
                                <img src="<?php echo base_url('uploads/product_category/'); ?>/<?php echo isset($prodCatDetails['category_img'])?$prodCatDetails['category_img']:''; ?>" alt="Product brand image | <?php echo isset($prodCatDetails['category_name'])?$prodCatDetails['category_name']:''; ?>" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                <a href="<?php echo base_url('uploads/product_category/'); ?>/<?php echo isset($prodCatDetails['category_img'])?$prodCatDetails['category_img']:''; ?>" target="_blank">click to view</a> 
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($prodCatDetails['category_img'])?$prodCatDetails['category_img']:''; ?>" data-id="<?php echo $prodCatDetails['id']; ?>" data-tablename="productcategories" data-tablecolumn="category_img"><i class="dw dw-delete-3"></i></a>
                            <?php }else{ ?>
                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-product-categories'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>