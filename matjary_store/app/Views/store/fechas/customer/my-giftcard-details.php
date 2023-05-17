<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Gift cards']; ?></h1>
        </div>
    </div>
</section>
<!-- PRODUCT DETAIL STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="prod-detail-image">
                    <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($mySnglGCDetails->image) ? $mySnglGCDetails->image : ''; ?>">
                </div>
            </div>            
            <div class="col-lg-8">
                <div class="prod-main-detail mb-3">
                    <div class="prod-detail-title">
                        <h3><?php echo $ses_lang == 'en' ? $mySnglGCDetails->name : $mySnglGCDetails->name_ar; ?></h3>
                    </div>
                    <div class="prod-detail-desc">
                        <p><?php echo isset($mySnglGCDetails->short_desc) ? $mySnglGCDetails->short_desc : 'Short Description Not Available.'; ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['E-Code']; ?> :</p>
                                <h4><?php echo isset($mySnglGCDetails->egift_code) ? $mySnglGCDetails->egift_code : ''; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['Value']; ?> :</p>
                                <h4><?php echo isset($mySnglGCDetails->gc_amount) ? $mySnglGCDetails->gc_amount : ''; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['Current Balance']; ?> :</p>
                                <h4><?php echo isset($mySnglGCDetails->gc_balance) ? $mySnglGCDetails->gc_balance : ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['Valid From']; ?> :</p>
                                <h4><?php echo isset($mySnglGCDetails->start_date) ? date("d M Y", strtotime($mySnglGCDetails->start_date)) : ''; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['Valid Till']; ?> :</p>
                                <h4><?php echo isset($mySnglGCDetails->expiry_date) ? date("d M Y", strtotime($mySnglGCDetails->expiry_date)) : ''; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gift-detail-wrap">
                                <p><?php echo $language['Acitive / Expired']; ?> :</p>
                                <?php
                                $today = date("Y-m-d");
                                $expiry_date = date("Y-m-d", strtotime($mySnglGCDetails->expiry_date));
                                if ($expiry_date >= $today) {
                                    if ($mySnglGCDetails->gc_status == 1) {
                                        echo '<h4 class="text-success">' . $language['Active'] . '</h4>';
                                    } elseif ($mySnglGCDetails->gc_status == 2) {
                                        echo '<h4 class="text-warning">' . $language['Utilized'] . '</h4>';
                                    } else {
                                        echo '<h4 class="text-default">' . $language['NA'] . '</h4>';
                                    }
                                } else {
                                    echo '<h4 class="text-danger">' . $language['Expired'] . '</h4>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <strong><?php echo $language['Warning']; ?>!</strong> <?php echo $language['Gift Card Uses Terms & Conditions.']; ?>
                            <ul>
                                <li><?php echo $language['Valid till a specified date range']; ?> </li>
                                <li><?php echo $language['The amount will be void if not used']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="back-btn">
                            <a href="<?php echo base_url('customer/my-gift-cards'); ?>" class="g-brand-btn"><?php echo $language['Back']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="prod-main-tab" style="width:100% !important;">
                <ul class="nav nav-pills prod-main-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link active" id="pills-history-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-history" aria-selected="true"><?php echo $language['Gift Card Transaction History']; ?></a>
                    </li>
                </ul>
                <div class="tab-content prod-main-content" id="pills-tabContent">
                    <div class="tab-pane prod-main-pane fade show active" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">
                        <table class="table table-striped" id="viewAllGiftOrderHistortyList">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><?php echo $language['Transaction ID']; ?></th>
                                    <th scope="col"><?php echo $language['Order Date']; ?></th>
                                    <th scope="col"><?php echo $language['Payment Status']; ?></th>
                                    <th scope="col"><?php echo $language['Amount']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($giftCardHistory) && !empty($giftCardHistory)) {
                                    $i = 1;
                                    foreach ($giftCardHistory as $value) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td>
                                                <h6><?php echo isset($value->transaction_id) ? $value->transaction_id : ''; ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo isset($value->created_at) ? date("d M Y", strtotime($value->created_at)) : ''; ?></h6>
                                            </td>
                                            <td>
                                                <h6>
                                                    <?php 
                                                        if ($value->payment_status == '1') {
                                                            echo $language['Complete'];
                                                        }
                                                        if ($value->payment_status == '2') {
                                                            echo $language['Pending'];
                                                        }
                                                        if ($value->payment_status == '3') {
                                                            echo $language['Cancel'];
                                                        } 
                                                    ?>
                                                </h6>
                                            </td>
                                            <td>
                                                <h6><?php echo isset($value->giftcard_amount) ? $value->giftcard_amount : ''; ?></h6>
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
        </div>
    </div>
</section>
<!-- PRODUCT DETAIL ENDS -->
<?php $this->endSection(); ?>