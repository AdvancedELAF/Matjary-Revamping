<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Dear <?php echo $username; ?>,</h4>
    <h4 style="color: #E63A7B;">Congratulations! You Have just got a free store for 14 days to explore whole world of ecommerce.</h4>
    <p style="line-height: 1.8; color: #000000">We appreciate your interest in MATJARY! We give you the best e-commerce solutions. Build your e-store by following your profile. Now, you'll always be in the know about the latest domain and templates you'll be the first to know about exclusive promotions and offers.</p>
    <p style="line-height: 1.8; color: #000000">The following is the Store details. In regard to the purchase with MATJARY.</p>
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; display: block; overflow-x: auto;"> 
        <tr>    
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Store URL</th>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Admin URL</th>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Username</th>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Password</th>
        </tr>
        <tr>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><a href="<?php echo $store_link; ?>" target="_blank" style="text-decoration: none; color: #5294F7; font-size: 12px;"><?php echo $store_link; ?></a></td>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><a href="<?php echo $store_admin_link; ?>" target="_blank" style="text-decoration: none; color: #5294F7; font-size: 12px;"><?php echo $store_admin_link; ?></a></td>
            <td style="border: 1px solid #DDDDDD; padding: 8px;">Your Registered Email</td>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><a href="<?php echo isset($set_pass)?$set_pass:'javascript:void(0);'; ?>" target="_blank" style="text-decoration: none; color: #5294F7; font-size: 12px;">click to set store admin password</a> (Ignore if already set.)</td>
        </tr>
    </table>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>