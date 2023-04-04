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
                    <h4><?php echo $language['Add Product']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Products']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Add Product']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">

                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ">
                    <?php
                    $attributes = ['name' => 'save_product_form', 'id' => 'save_product_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('admin/save-product', $attributes);
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <h5 class="h4 text-blue"><?php echo $language['Product Details']; ?></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Image']; ?></label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?> class="form-control" placeholder="<?php echo $language['Enter product title name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="mb-2">
                                <label><?php echo $language['Product Category']; ?></label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value=""><?php echo $language['Select Product Category']; ?></option>
                                    <?php
                                    if (isset($productCategories) && !empty($productCategories)) {
                                        foreach ($productCategories as $categoryData) {
                                            $category_name = '';
                                            if ($ses_lang == 'en') {
                                                if (isset($categoryData->category_name) && !empty($categoryData->category_name)) {
                                                    $category_name = $categoryData->category_name;
                                                } else {
                                                    if (isset($categoryData->category_name_ar) && !empty($categoryData->category_name_ar)) {
                                                        $category_name = $categoryData->category_name_ar;
                                                    }
                                                }
                                            } else {
                                                if (isset($categoryData->category_name_ar) && !empty($categoryData->category_name_ar)) {
                                                    $category_name = $categoryData->category_name_ar;
                                                } else {
                                                    if (isset($categoryData->category_name) && !empty($categoryData->category_name)) {
                                                        $category_name = $categoryData->category_name;
                                                    }
                                                }
                                            }
                                    ?>
                                            <option value="<?php echo isset($categoryData->id) ? $categoryData->id : ''; ?>"><?php echo $category_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="mb-2">
                                <label><?php echo $language['Brand']; ?></label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value=""><?php echo $language['Select Product Brand']; ?></option>
                                    <?php
                                    if (isset($productBrands) && !empty($productBrands)) {
                                        foreach ($productBrands as $brandData) {
                                            $brand_name = '';
                                            if ($ses_lang == 'en') {
                                                if (isset($brandData->brand_name) && !empty($brandData->brand_name)) {
                                                    $brand_name = $brandData->brand_name;
                                                } else {
                                                    if (isset($brandData->brand_name_ar) && !empty($brandData->brand_name_ar)) {
                                                        $brand_name = $brandData->brand_name_ar;
                                                    }
                                                }
                                            } else {
                                                if (isset($brandData->brand_name_ar) && !empty($brandData->brand_name_ar)) {
                                                    $brand_name = $brandData->brand_name_ar;
                                                } else {
                                                    if (isset($brandData->brand_name) && !empty($brandData->brand_name)) {
                                                        $brand_name = $brandData->brand_name;
                                                    }
                                                }
                                            }
                                    ?>
                                            <option value="<?php echo isset($brandData->id) ? $brandData->id : ''; ?>"><?php echo $brand_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="mb-2">
                                <label><?php echo $language['Color']; ?></label>
                                <select name="color_id" id="color_id" class="form-control">
                                    <option value=""><?php echo $language['Select Product Color']; ?></option>
                                    <?php
                                    if (isset($productColors) && !empty($productColors)) {
                                        foreach ($productColors as $colorData) {
                                    ?>
                                            <option value="<?php echo isset($colorData->id) ? $colorData->id : ''; ?>"><?php echo isset($colorData->color_name) ? $colorData->color_name : ''; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="mb-2">
                                <label><?php echo $language['Size']; ?></label>
                                <select name="size_id" id="size_id" class="form-control">
                                    <option value=""><?php echo $language['Select Product Size']; ?></option>
                                    <?php
                                    if (isset($productSizes) && !empty($productSizes)) {
                                        foreach ($productSizes as $sizeData) {
                                    ?>
                                            <option value="<?php echo isset($sizeData->id) ? $sizeData->id : ''; ?>"><?php echo isset($sizeData->size) ? $sizeData->size : ''; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label><?php echo $language['Short Description']; ?></label>
                                <textarea <?php echo $ses_lang == 'en' ? 'name="short_desc" id="short_desc"' : 'name="short_desc_ar" id="short_desc_ar"'; ?> rows="3" class="form-control" placeholder="<?php echo $language['Short Description']; ?>"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label><?php echo $language['Long Description']; ?></label>
                                <textarea <?php echo $ses_lang == 'en' ? 'name="long_desc" id="long_desc"' : 'name="long_desc_ar" id="long_desc_ar"'; ?> rows="4" class="form-control" placeholder="<?php echo $language['Long Description']; ?>"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Is This Product in Promotion ?']; ?></label><br>
                                <input type="radio" name="promotion_status" value="1" data-error=".error1"> <?php echo $language['Yes']; ?>
                                <input type="radio" name="promotion_status" value="2" data-error=".error1" checked="checked"> <?php echo $language['No']; ?>
                                </br><span class="error1"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Is This Feature Product ?']; ?></label><br>
                                <input type="radio" name="feature" value="1" data-error=".error2"> <?php echo $language['Yes']; ?>
                                <input type="radio" name="feature" value="2" data-error=".error2" checked="checked"> <?php echo $language['No']; ?>
                                </br><span class="error2"></span>
                            </div>
                        </div>
                    </div>

                    <h5 class="h4 text-blue mt-3 mb-3"><?php echo $language['Pricing Details']; ?></h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Retail Price']; ?></label>
                                <input type="text" name="retail_price" id="retail_price" class="form-control floatNumberOnly" maxlength="8" placeholder="<?php echo $language['Enter retail price']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Wholesale Price']; ?></label>
                                <input type="text" name="wholesale_price" id="wholesale_price" class="form-control floatNumberOnly" maxlength="8" placeholder="<?php echo $language['Enter wholesale price']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Discount in %']; ?></label>
                                <input type="text" name="discount_per" id="discount_per" class="form-control numberonly" maxlength="2" placeholder="<?php echo $language['Enter discount percent on this product']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Sales Tax in Flat Price']; ?></label>
                                <input type="text" name="sales_tax" id="sales_tax" class="form-control numberonly" maxlength="3" placeholder="<?php echo $language['Enter sale tax amount']; ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="h4 text-blue mt-3 mb-3"><?php echo $language['Inventory Details']; ?></h5>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-2">
                                <label><?php echo $language['Stock Quantity']; ?></label>
                                <input type="text" name="stock_quantity" id="stock_quantity" class="form-control numberonly" maxlength="4" placeholder="<?php echo $language['Enter product stock quantity']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-2">
                                <label><?php echo $language['Per Order Quantity Limit']; ?></label>
                                <input type="text" name="order_limit_quantity" id="order_limit_quantity" class="form-control numberonly" maxlength="4" placeholder="<?php echo $language['Enter product per order quantity limit']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-2">
                                <label><?php echo $language['Threshold Quantity To Show Remaining Stock']; ?></label>
                                <input type="text" name="threshold_quantity" id="threshold_quantity" class="form-control numberonly" maxlength="2" placeholder="<?php echo $language['Enter Threshold Quantity To Show Remaining Stock']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-2">
                                <label><?php echo $language['Weight (in KG)']; ?></label>
                                <input type="text" name="weight" id="weight" class="form-control" maxlength="5" placeholder="<?php echo $language['Enter product weight in KG (e.g. 1.5,2,etc.)']; ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="h4 text-blue mt-3 mb-3"><?php echo $language['Product SEO']; ?></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Keywords']; ?></label>
                                <textarea <?php echo $ses_lang == 'en' ? 'name="keywords" id="keywords"' : 'name="keywords_ar" id="keywords_ar"'; ?> rows="2" class="form-control" placeholder="<?php echo $language['Enter Product Keywords separated by comma ,']; ?> "></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Tags']; ?></label>
                                <textarea <?php echo $ses_lang == 'en' ? 'name="tags" id="tags"' : 'name="tags_ar" id="tags_ar"'; ?> rows="2" class="form-control" placeholder="<?php echo $language['Enter Product Tags separated by comma ,']; ?> "></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <a href="<?php echo base_url('admin/all-products'); ?>" class="btn btn-secondary"><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>