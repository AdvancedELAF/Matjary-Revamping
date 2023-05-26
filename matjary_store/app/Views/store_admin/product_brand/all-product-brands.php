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
                    <h4><?php echo $language['All Product Brands']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Products']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Product Brands']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">                    
            <a href="<?php echo base_url('admin/add-product-brand'); ?>" class="btn btn-primary pull-<?php echo $ses_lang == 'en'?'right':'left'; ?>"><?php echo $language['Add New Brand']; ?></a>
        </div>
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllProductBrandList">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="checkAll"></th>
                        <th scope="col">#</th>
                        <th class="table-plus datatable-nosort"><?php echo $language['Brand Image']; ?></th>
                        <th scope="col"><?php echo $language['Brand Name']; ?></th>
                        <th scope="col"><?php echo $language['Status']; ?></th>
                        <!-- <th scope="col"><?php //echo $language['Action']; ?></th> -->
                        <th scope="col">
                            <select name="activeBtn" class="form-control" id="multiActionOption" data-table="brands" data-actionurl="<?php echo base_url('multi-action-option'); ?>">
                                <option value=""><?php echo $language['Choose Action'];?></option>
                                <option value="1"><?php echo $language['Activate'];?></option>
                                <option value="2"><?php echo $language['Deactivate'];?></option>
                                <option value="3"><?php echo $language['Delete'];?></option>
                            </select>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($productBrandList) && !empty($productBrandList)) {
                        $i = 1;
                        foreach ($productBrandList as $value) {
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="itemId[]"  class="itemId" value="<?php echo isset($value->id) ? $value->id : 'NA'; ?>" />
                            </td>     
                            <td>
                                <h5 class="font-16"><?php echo $i; ?></h5>
                            </td>
                            <td class="table-plus">
                                <img src="<?php echo base_url('uploads/product_brands/'); ?>/<?php echo isset($value->brand_image) ? $value->brand_image : ''; ?>" width="70" height="70" alt="">
                            </td>
                            <td>
                                <h5 class="font-16"><?php echo isset($value->brand_name) ? $value->brand_name : 'NA'; ?></h5>
                            </td>
                            <td><?php if ($value->is_active == 1) { echo $language['Active']; } else { echo $language['Deactivated']; } ?></td>
                            <td>
                                <div class="dropdown text-center">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <?php if ($value->is_active == 1) { ?>
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/deactivate-product-brand'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> <?php echo $language['Deactivate']; ?></a>
                                        <?php } else { ?>
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/activate-product-brand'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> <?php echo $language['Activate']; ?></a>
                                        <?php } ?>
                                        <a class="dropdown-item" href="<?php echo base_url('admin/edit-product-brand/' . $value->id); ?>"><i class="dw dw-edit2"></i> <?php echo $language['Edit']; ?></a>
                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-product-brand'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
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
                            <td colspan="5"><?php echo $language['No record found']; ?>.</td>
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