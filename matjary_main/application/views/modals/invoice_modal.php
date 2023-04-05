<!-- STORE INVOICE MODAL STARTS -->
<div class="modal fade" id="invoiceInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content invoice-modal-content">
            <div class="modal-header invoice-modal-header">
                <h5 class="modal-title invoice-modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Invoice'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body invoice-modal-body">
                <div class="receipt-content">
                    <div class="container bootstrap snippets bootdey">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-wrapper">
                                    <div class="intro">
                                    <?php echo $this->lang->line('Hi'); ?> <strong id="user_name"></strong>,
                                        <br> 
                                        <?php echo $this->lang->line('This is the receipt for a payment of'); ?> <strong id="invoice_amount">00.00</strong> (<?php echo $this->lang->line('SAR'); ?>) <?php echo $this->lang->line('for your Purchase'); ?>
                                    </div>
                                    <div class="payment-info">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span><?php echo $this->lang->line('Transaction Reference NO.'); ?></span>
                                                <strong id="tran_ref"></strong>
                                            </div>
                                            <div class="col-sm-6 arabic-right">
                                                <span><?php echo $this->lang->line('Payment Date'); ?></span>
                                                <strong id="created_at"></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-details">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span><?php echo $this->lang->line('Client'); ?></span>
                                                <strong id="client_name"></strong>
                                                <p id="client_address"></p>
                                            </div>
                                            <div class="col-sm-6 arabic-right">
                                                <span><?php echo $this->lang->line('Payment To'); ?></span>
                                                <strong>AdvancedElaf Information Technology Company</strong>
                                                <p> 7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض <br>
                                                    13315-3599 <br>
                                                    Saudi Arabia <br>
                                                    <a href="#">support@matjary.in</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-items">
                                        <div class="headers mt-3 clearfix">
                                            <div class="row">
                                                <div class="col-12 invoice-title"><strong><?php echo $this->lang->line('Subscription Information'); ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="headers clearfix">
                                            <div class="row">
                                                <div class="col-4 invoice-title"><?php echo $this->lang->line('Plan'); ?></div>
                                                <div class="col-3 invoice-title"><?php echo $this->lang->line('Validity in'); ?> <span id="months_days_validity"><?php echo $this->lang->line('Months'); ?></span></div>
                                                <div class="col-5 arabic-right invoice-title"><?php echo $this->lang->line('Amount'); ?></div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row item">
                                                <div class="col-4 desc" id="plan_name">Basic</div>
                                                <div class="col-3 qty" id="validity_in_months">3</div>
                                                <div class="col-5 amount arabic-right" id="plan_cost">SAR 60.00</div>
                                            </div>
                                        </div>
                                        <div class="headers mt-3 clearfix">
                                            <div class="row">
                                                <div class="col-12 invoice-title"><strong><?php echo $this->lang->line('Template Information'); ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="headers clearfix">
                                            <div class="row">
                                                <div class="col-3 invoice-title"><?php echo $this->lang->line('Template Name'); ?></div>
                                                <div class="col-4 invoice-title"><?php echo $this->lang->line('Validity'); ?></div>
                                                <div class="col-5 invoice-title"><?php echo $this->lang->line('Cost'); ?></div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row item">
                                                <div class="col-3 desc" id="template_name">Template Name</div>
                                                <div class="col-4 desc" ><?php echo $this->lang->line('Lifetime'); ?></div>
                                                <div class="col-5 desc" id="template_cost">0.00</div>
                                            </div>
                                        </div>
                                        <div class="headers mt-3 clearfix">
                                            <div class="row">
                                                <div class="col-12 invoice-title"><strong><?php echo $this->lang->line('Store Information'); ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="headers clearfix">
                                            <div class="row">
                                                <div class="col-3 invoice-title"><?php echo $this->lang->line('Store Name'); ?></div>
                                                <div class="col-4 invoice-title"><?php echo $this->lang->line('Store Link'); ?></div>
                                                <div class="col-5 invoice-title"><?php echo $this->lang->line('Store Admin Link'); ?></div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row item">
                                                <div class="col-3 desc" id="store_name"></div>
                                                <div class="col-4 desc" id="store_link"></div>
                                                <div class="col-5 desc" id="store_admin_link"></div>
                                            </div>
                                        </div>
                                        <div class="total arabic-right">
                                            <p class="extra-notes">
                                                <strong><?php echo $this->lang->line('Extra Notes'); ?></strong>
                                                <?php echo $this->lang->line('Please send all items at the same time to shipping address by next week, Thanks a lot.'); ?>
                                            </p>

                                            <div class="total-table">
                                                <div class="field">
                                                <?php echo $this->lang->line('Subtotal'); ?> <span id="subtotal"></span>
                                                </div>
                                                <!-- 
                                                <div class="field">
                                                    Shipping <span>$0.00</span>
                                                </div> 
                                                -->
                                                <div class="field" id="coupon_code_div">
                                                    Coupon Code <span id="coupon_code">APLRIL2023</span>
                                                </div> 
                                                <div class="field" id="coupon_discount_div">
                                                    Coupon Discount <span id="coupon_discount">0</span>%
                                                </div> 
                                                <div class="field" id="coupon_amount_div">
                                                    Coupon Amount <span id="coupon_amount">0.00</span>
                                                </div>
                                                <div class="field grand-total">
                                                    <?php echo $this->lang->line('Total'); ?> <span id="grand_total"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="javascript:void(0);" onclick="printPageArea('invoiceInfoModal');" class="btn btn-primary brand-btn-purple">
                                            <i class="fa fa-print"></i><?php echo $this->lang->line('Print this receipt'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- STORE INVOICE MODAL ENDS -->

<!-- STORE TEMPLATE INVOICE MODAL STARTS -->
<div class="modal fade" id="userPurchasedTemplateInvoiceInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content invoice-modal-content">
            <div class="modal-header invoice-modal-header">
                <h5 class="modal-title invoice-modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Invoice'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body invoice-modal-body">
                <div class="receipt-content">
                    <div class="container bootstrap snippets bootdey">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-wrapper">
                                    <div class="intro">
                                        <?php echo $this->lang->line('Hi'); ?> <strong id="user_name">John McClane</strong>,
                                        <br>
                                        <?php echo $this->lang->line('This is the receipt for a payment of'); ?> <strong id="invoice_amount">00.00</strong> (<?php echo $this->lang->line('SAR'); ?>) <?php echo $this->lang->line('for your Purchase'); ?>
                                    </div>
                                    <div class="payment-info">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span><?php echo $this->lang->line('Transaction Reference NO.'); ?></span>
                                                <strong id="tran_ref"></strong>
                                            </div>
                                            <div class="col-sm-6 arabic-right">
                                                <span><?php echo $this->lang->line('Payment Date'); ?></span>
                                                <strong id="created_at"></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-details">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span><?php echo $this->lang->line('Client'); ?></span>
                                                <strong id="client_name"></strong>
                                                <p id="client_address"></p>
                                            </div>
                                            <div class="col-sm-6 arabic-right">
                                                <span><?php echo $this->lang->line('Payment To'); ?></span>
                                                <strong>AdvancedElaf Information Technology Company</strong>
                                                <p> 7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض <br>
                                                    13315-3599 <br>
                                                    Saudi Arabia <br>
                                                    <a href="#">support@matjary.in</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-items">
                                        <div class="headers mt-3 clearfix">
                                            <div class="row">
                                                <div class="col-12 invoice-title"><strong><?php echo $this->lang->line('Template/Theme Information'); ?></strong></div>
                                            </div>
                                        </div>
                                        <div class="headers clearfix">
                                            <div class="row">
                                                <div class="col-3 invoice-title"><?php echo $this->lang->line('Theme Name'); ?></div>
                                                <div class="col-4 invoice-title"><?php echo $this->lang->line('Sub Total'); ?></div>
                                                <div class="col-5 invoice-title"><?php echo $this->lang->line('Grand Total'); ?></div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row item">
                                                <div class="col-3 desc" id="theme_name">Theme Name</div>
                                                <div class="col-4 desc" id="subtotal">Sub Total</div>
                                                <div class="col-5 desc" id="grand_total">Grand Total</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="javascript:void(0);" onclick="printPageArea('userPurchasedTemplateInvoiceInfoModal');" class="btn btn-primary brand-btn-purple">
                                            <i class="fa fa-print"></i><?php echo $this->lang->line('Print this receipt'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- STORE TEMPLATE INVOICE MODAL ENDS -->