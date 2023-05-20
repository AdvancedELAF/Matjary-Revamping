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
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Plan Details</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $plan_details; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Billing Type</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $billing_type; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Discount</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $discount; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Total</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $total; ?></td>
        </tr>
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Payment Status</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $payment_status; ?></td>
        </tr>
    </table>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>