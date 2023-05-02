<?php $this->load->view("modals/invoice_modal"); ?>
<section class="">
    <div class="custom-container">
        <div class="user-sec-title">
            <h4><?php echo $this->lang->line('user-acc-txt-3'); ?></h4>
        </div>

        <div class="dash-wrap blue-bg mb-4">

            <!-- STORE & PAID TEMPLATE TAB STARTS -->
            <nav>
                <div class="nav nav-tabs mb-5" id="nav-tab" role="tablist">
                    <a class="nav-link active tab-active" id="nav-sd-tab" data-toggle="tab" href="#store-details" role="tab" aria-controls="store-details" aria-selected="true"><?php echo $this->lang->line('Store Details'); ?></a>
                    <a class="nav-link" id="nav-pt-tab" data-toggle="tab" href="#nav-pt" role="tab" aria-controls="nav-pt" aria-selected="false"><?php echo $this->lang->line('Paid Templates'); ?></a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="store-details" role="tabpanel" aria-labelledby="nav-sd-tab">
                    <div class="billing-table">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="user_order_table_sites">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-37'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('footer-txt-21'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-38'); ?></th>                                   
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-39'); ?></th>
                                        <th scope="col">Discount</th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-40'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-41'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-42'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-43'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-44'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($user_payment_history['user_stores_purchased_history']) && !empty($user_payment_history['user_stores_purchased_history'])){
                                        $j = 1;
                                        foreach ($user_payment_history['user_stores_purchased_history'] as $orderData) {
                                            //echo '<pre>'; print_r($orderData); 
                                            $invoice_no = isset($orderData['id'])?$orderData['id']:'';
                                            
                                            $plan_cost = isset($orderData['plan_cost'])?$orderData['plan_cost']:'';
                                            $template_cost = isset($orderData['template_cost'])?$orderData['template_cost']:'';
                                            $subtotal = number_format((float)$plan_cost, 2, '.', '') + number_format((float)$template_cost, 2, '.', '');
                                            $coupon_amount = isset($orderData['coupon_amount'])?number_format((float)$orderData['coupon_amount'], 2, '.', ''):'0.00';
                                            $total_cost = number_format((float)$subtotal, 2, '.', '') - number_format((float)$coupon_amount, 2, '.', '');
                                            $store_link = isset($orderData['store_link'])?$orderData['store_link']:'';
                                            $plan_start_dt = isset($orderData['plan_start_dt'])?$orderData['plan_start_dt']:'';
                                            $plan_expiry_dt = isset($orderData['plan_expiry_dt'])?$orderData['plan_expiry_dt']:'';
                                            $created_at = isset($orderData['created_at'])?$orderData['created_at']:'';
                                            $plan_desc = isset($orderData['plan_desc'])?$orderData['plan_desc']:'';
                                            $validity_in_months = isset($orderData['validity_in_months'])?$orderData['validity_in_months']:'';
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $j++; ?></th>
                                            <td><a href="javascript:void(0);" class="userPurchaseInvoice" data-actionurl="<?php echo base_url('get-user-purchased-store-payment-info-api/') . $invoice_no; ?>" data-invoiceid="<?php echo $invoice_no; ?>">MATPL<?php echo $invoice_no; ?></a></td>
                                            <td><?php echo $plan_desc . " " . $validity_in_months . " <br/>" . $store_link; ?></td>
                                            <td><a target="_blank" href="https://<?php echo $store_link; ?>"><?php echo $store_link; ?></a></td>
                                            <td><?php echo $this->lang->line('SAR'); ?> <?php echo $subtotal; ?></td>
                                            <td><?php echo $this->lang->line('SAR').' '.$coupon_amount; ?></td>
                                            <td><?php echo $this->lang->line('SAR'); ?> <?php echo $total_cost; ?></td>
                                            <td><?php echo $plan_start_dt; ?></td>
                                            <td>
                                                <?php
                                                $diffDt = (strtotime($plan_expiry_dt) - strtotime(date('Y-m-d'))) / 60 / 60 / 24;
                                                if ($diffDt <= DOMAIN_EXP_TRESHOLD) {
                                                    if ($diffDt > 0) {
                                                ?>
                                                    <span class="badge badge-warning"><?php echo $plan_expiry_dt; ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger"><?php echo $plan_expiry_dt; ?></span>
                                                <?php
                                                    }
                                                } else {
                                                ?>
                                                    <span class="badge badge-danger"><?php echo $plan_expiry_dt; ?></span>
                                                <?php }  ?>
                                            </td>
                                            <td><?php echo $this->lang->line('paid'); ?></td>
                                            <td><?php echo $plan_start_dt; ?></td>
                                        </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                        <tr class="text-center">
                                            <td colspan="10"><?php echo $this->lang->line('no_data_found'); ?></td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-pt" role="tabpanel" aria-labelledby="nav-pt-tab">
                    <div class="billing-table arabic-right">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="user_order_table_templates">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo $this->lang->line('Invoice Number'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Template Name'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Amount'); ?></th>
                                        <th scope="col">Discount</th>
                                        <th scope="col"><?php echo $this->lang->line('Total'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Status'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Payment Date'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($user_payment_history['user_templates_purchased_history']) && !empty($user_payment_history['user_templates_purchased_history'])){
                                        $k = 1;
                                        foreach ($user_payment_history['user_templates_purchased_history'] as $value) {
                                            //echo '<pre>'; print_r($value); exit;
                                            $coupon_amount = isset($value['coupon_amount'])?number_format((float)$value['coupon_amount'], 2, '.', ''):0.00;
                                            $total_cost = number_format((float)$value['template_cost'], 2, '.', '') - number_format((float)$value['coupon_amount'], 2, '.', '');
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $k; ?></th>
                                                <td><a href="javascript:void(0);" class="userPurchasedTemplateInvoice" data-actionurl="<?php echo base_url('get-user-purchased-template-payment-info-api/') . $value['id']; ?>" data-invoiceid="<?php echo $value['id']; ?>">MATPL<?php echo $value['id']; ?></a></td>
                                                <td><?php echo $value['template_name']; ?></td>
                                                <td><?php echo $this->lang->line('SAR'); ?> <?php echo $value['template_cost']; ?></td>
                                                <td><?php echo $this->lang->line('SAR').' '.$coupon_amount; ?></td>
                                                <td><?php echo $this->lang->line('SAR'); ?> <?php echo $total_cost; ?></td>
                                                <td><?php echo $this->lang->line('paid'); ?></td>
                                                <td><?php echo isset($value['created_at'])?date("Y-m-d",strtotime($value['created_at'])):'NA'; ?></td>
                                            </tr>
                                    <?php
                                        $k++;
                                        }
                                    } else {
                                    ?>
                                        <tr class="text-center">
                                            <td colspan="10"><?php echo $this->lang->line('no_data_found'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STORE & PAID TEMPLATE TAB ENDS -->
        </div>
    </div>
</section>