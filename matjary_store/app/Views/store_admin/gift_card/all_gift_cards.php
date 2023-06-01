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
                    <h4><?php echo $language['All Gift Cards']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Gift cards']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Gift Cards']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">       
        <div class="pd-20">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" id="multiActionOption" data-table="<?php echo isset($table) ? $table : 'NA'; ?>" data-actionurl="<?php echo base_url('multi-action-option'); ?>">
                        <option value=""><?php echo $language['Choose Action'];?></option>
                        <option value="1"><?php echo $language['Activate'];?></option>
                        <option value="2"><?php echo $language['Deactivate'];?></option>
                        <option value="3"><?php echo $language['Delete'];?></option>
                    </select>            
                </div>    
                <div class="col-md-6">            
                </div>
                <div class="col-md-3">
                    <a href="<?php echo base_url('admin/add-gift-card'); ?>" class="btn btn-primary pull-<?php echo $ses_lang == 'en'?'right':'left'; ?>"><?php echo $language['Add Gift Card']; ?></a>
                </div>                
            </div>   
        </div>

        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllGiftCardsList">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="checkAll"></th>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Image']; ?></th>
                        <th scope="col"><?php echo $language['Name']; ?></th>
                        <th scope="col"><?php echo $language['Start Date']; ?></th>
                        <th scope="col"><?php echo $language['Expiry Date']; ?></th>
                        <th scope="col"><?php echo $language['Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($GiftCardList) && !empty($GiftCardList)) {
                        $i = 1;
                        foreach ($GiftCardList as $value) {
                            $name = '';
                            if ($ses_lang == 'en') {
                                if (isset($value->name) && !empty($value->name)) {
                                    $name = $value->name;
                                } else {
                                    if (isset($value->name_ar) && !empty($value->name_ar)) {
                                        $name = $value->name_ar;
                                    }
                                }
                            } else {
                                if (isset($value->name_ar) && !empty($value->name_ar)) {
                                    $name = $value->name_ar;
                                } else {
                                    if (isset($value->name) && !empty($value->name)) {
                                        $name = $value->name;
                                    }
                                }
                            }
                    ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="itemId[]"  class="itemId" value="<?php echo isset($value->id) ? $value->id : 'NA'; ?>" />
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo $i; ?></h5>
                                </td>
                                <td>
                                    <h5 class="font-16">
                                        <?php if (isset($value->image) && !empty($value->image)) { ?>
                                            <img src="<?php echo base_url('uploads/giftcards/'); ?>/<?php echo isset($value->image) ? $value->image : ''; ?>" class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:70px;max-height:70px;">
                                        <?php } else { ?>
                                            <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Banner image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                        <?php } ?>
                                    </h5>
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo $name ?></h5>
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo isset($value->start_date) ? $value->start_date : 'NA'; ?></h5>
                                </td>
                                <td>
                                    <h5 class="font-16"><?php echo isset($value->expiry_date) ? $value->expiry_date : 'NA'; ?></h5>
                                </td>
                                <td>
                                    <?php
                                    $today = date("Y-m-d");
                                    $checkExpiryDate = date("Y-m-d", strtotime($value->expiry_date));
                                    if ($checkExpiryDate >= $today) {
                                        if ($value->is_active == 1) {
                                            echo $language['Active'];
                                        } else {
                                            echo $language['Deactivated'];
                                        }
                                    } else {
                                        echo '<p class="text-danger">' . $language['Expired'] . '</p>';
                                    } ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <?php if ($value->is_active == 1) { ?>
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/deactivate-gift-card'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> <?php echo $language['Deactivate']; ?></a>
                                            <?php } else { ?>
                                                <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/activate-gift-card'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> <?php echo $language['Activate']; ?></a>
                                            <?php } ?>
                                            <a class="dropdown-item" href="<?php echo base_url('admin/edit-gift-card/' . $value->id); ?>"><i class="dw dw-edit2"></i> <?php echo $language['Edit']; ?></a>
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-gift-card'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
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
                            <td colspan="7"><?php echo $language['No record found']; ?>.</td>
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