<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Dear <?php echo $username; ?>,</h4>
    <h4 style="color: #E63A7B;">Congratulations!</h4>
    <p style="line-height: 1.8; color: #000000">We appreciate you for your interest shown in MATJARY!</p>
    <p style="line-height: 1.8; color: #000000">The following is the invoice details, not receipt. Regarding the purchase with MATJARY.</p>
    <h4 style="color: #8D4FDE;">Invoice to <span style="color: #E63A7B;"><?php echo $username; ?></span></h4>
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; display: block; overflow-x: auto;"> 
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Transaction No.</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;">#<?php echo $tranRef; ?></td>
        </tr>
        <?php if(!empty($plan_tmpl_buy_status) && $plan_tmpl_buy_status==1 || $plan_tmpl_buy_status==2){ ?>
            <tr>    
                <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Plan Name</th>
                <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $plan_name; ?></td>
            </tr>
            <tr>    
                <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Plan Cost</th>
                <td style="border: 1px solid #DDDDDD; padding: 8px;">SAR <?php echo number_format((float)$plan_cost, 2, '.', ''); ?></td>
            </tr>
            <tr>    
                <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Plan Validity</th>
                <td style="border: 1px solid #DDDDDD; padding: 8px;">
                    <?php 
                        if(isset($subscription_type) && $subscription_type==1){
                            echo $validity_in_months.' Days'; 
                        }else{
                            echo $validity_in_months.' Months'; 
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>

        <?php if(!empty($plan_tmpl_buy_status) && $plan_tmpl_buy_status==2){ ?>
            <tr>    
                <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Billing Type</th>
                <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $billing_type; ?></td>
            </tr>
        <?php } ?>

        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Template Name</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $template_name; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Template Cost</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;">SAR <?php echo number_format((float)$template_cost, 2, '.', ''); ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Discount</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;">SAR <?php echo $discount; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Total</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;">SAR <?php echo $total; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Payment Status</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $payment_status; ?></td>
        </tr>
    </table>
    <p style="line-height: 1.8; color: #000000">Billing Address</p>
    <p>
        <?php 
        if(isset($bill_info_address) && !empty($bill_info_address)){
            $billAddressData = unserialize($bill_info_address);
            
            $customer_name =  isset($billAddressData['b_fname'])?$billAddressData['b_fname'].' ':'';
            $customer_name .=  isset($billAddressData['b_lname'])?$billAddressData['b_lname'].', ':'';
            echo 'Customer Name : '.$customer_name.' </br>';
            $customer_email = isset($billAddressData['b_email'])?$billAddressData['b_email'].', ':'';
            echo 'Customer Email : '.$customer_email.' </br>';
            echo 'Customer Address : </br>';
            echo isset($billAddressData['b_tel'])?$billAddressData['b_tel'].', ':'';
            echo isset($billAddressData['b_address'])?$billAddressData['b_address'].', ':'';
            echo isset($billAddressData['b_zipcode'])?$billAddressData['b_zipcode'].'.':'';
        }else{
            echo 'No Billing Information Available.';
        }
        ?>
    </p>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>