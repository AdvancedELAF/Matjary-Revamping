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
                    <h4><?php echo $language['All Products']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Products']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Products']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="<?php echo  base_url('admin/add-product'); ?>" class="btn btn-primary pull-<?php echo $ses_lang == 'en'?'right':'left'; ?>"><?php echo $language['Add Product']; ?></a>
        </div>
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllProductList">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="table-plus datatable-nosort"><?php echo $language['Product Image']; ?></th>
                        <th><?php echo $language['Product Name']; ?></th>
                        <th><?php echo $language['Category']; ?></th>
                        <th><?php echo $language['Retail Price']; ?></th>
                        <th><?php echo $language['Quantity']; ?></th>
                        <th><?php echo $language['Status']; ?></th>
                        <th class="datatable-nosort"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (isset($productList) && !empty($productList)) {
                        foreach ($productList as $value) {
                            $title = '';
                            $category_name = '';
                            if ($ses_lang == 'en') {
                                if (isset($value->title) && !empty($value->title)) {
                                    $title = $value->title;
                                } else {
                                    if (isset($value->title_ar) && !empty($value->title_ar)) {
                                        $title = $value->title_ar;
                                    }
                                }
                                if (isset($value->category_name) && !empty($value->category_name)) {
                                    $category_name = $value->category_name;
                                } else {
                                    if (isset($value->category_name_ar) && !empty($value->category_name_ar)) {
                                        $category_name = $value->category_name_ar;
                                    }
                                }
                            } else {
                                if (isset($value->title_ar) && !empty($value->title_ar)) {
                                    $title = $value->title_ar;
                                } else {
                                    if (isset($value->title) && !empty($value->title)) {
                                        $title = $value->title;
                                    }
                                }
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
                                <td><?php echo $i; ?></td>
                                <td class="table-plus">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($value->image) ? $value->image : ''; ?>" width="70" height="70" alt="">
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo $title; ?></h5>
                                </td>
                                <td><?php echo $category_name; ?></td>
                                <td><?php echo $language['SAR']; ?> <?php echo isset($value->retail_price) ? $value->retail_price : 'NA'; ?></td>
                                <td><?php echo isset($value->stock_quantity) ? $value->stock_quantity : 0; ?></td>
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
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/deactivate-product'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> <?php echo $language['Deactivate']; ?></a>
                                            <?php } else { ?>
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/activate-product'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> <?php echo $language['Activate']; ?></a>
                                            <?php } ?>
                                            <a class="dropdown-item" href="<?php echo base_url('admin/edit-product/' . $value->id); ?>"><i class="dw dw-edit2"></i> <?php echo $language['Edit']; ?></a>
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-product'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
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
                            <td colspan="8"><?php echo $language['No record found.']; ?></td>
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