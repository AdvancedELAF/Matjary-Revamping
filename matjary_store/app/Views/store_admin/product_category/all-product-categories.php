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
                    <h4><?php echo $language['All Product Categories']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Products']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Product Categories']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="<?php echo base_url('admin/add-product-category'); ?>" class="btn btn-primary pull-<?php echo $ses_lang == 'en'?'right':'left'; ?>"><?php echo $language['Add New Category']; ?></a>
        </div>

        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllProductCategoryList">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th class="table-plus datatable-nosort"><?php echo $language['Category Image']; ?></th>
                        <th scope="col"><?php echo $language['Category Name']; ?></th>
                        <th scope="col"><?php echo $language['Parent Category']; ?></th>
                        <th scope="col"><?php echo $language['Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($productCategoryList) && !empty($productCategoryList)) {
                        $i = 1;
                        foreach ($productCategoryList as $value) {
                            $category_name = '';
                            if ($ses_lang == 'en') {
                                if (isset($value->category_name) && !empty($value->category_name)) {
                                    $category_name = $value->category_name;
                                } else {
                                    if (isset($value->category_name_ar) && !empty($value->category_name_ar)) {
                                        $category_name = $value->category_name_ar;
                                    }
                                }
                            } else {
                                if (isset($value->category_name_ar) && !empty($value->category_name_ar)) {
                                    $category_name = $value->category_name_ar;
                                } else {
                                    if (isset($value->category_name) && !empty($value->category_name)) {
                                        $category_name = $value->category_name;
                                    }
                                }
                            }
                    ?>
                            <tr>
                                <td>
                                    <h5 class="font-16"><?php echo $i; ?></h5>
                                </td>
                                <td class="table-plus">
                                    <img src="<?php echo base_url('uploads/product_category/'); ?>/<?php echo isset($value->category_img) ? $value->category_img : ''; ?>" width="70" height="70" alt="">
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo $category_name; ?></h5>
                                </td>
                                <td><?php echo isset($value->parent_cat_name) ? $value->parent_cat_name : 'Root'; ?></td>
                                <td><?php if ($value->is_active == 1) {
                                        echo 'Active';
                                    } else {
                                        echo 'Deactivated';
                                    } ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <?php if ($value->is_active == 1) { ?>
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/deactivate-product-category'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> <?php echo $language['Deactivate']; ?></a>
                                            <?php } else { ?>
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/activate-product-category'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> <?php echo $language['Activate']; ?></a>
                                            <?php } ?>
                                            <a class="dropdown-item" href="<?php echo base_url('admin/edit-product-category/' . $value->id); ?>"><i class="dw dw-edit2"></i> <?php echo $language['Edit']; ?></a>
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-product-category'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6"><?php echo $language['No record found.']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>