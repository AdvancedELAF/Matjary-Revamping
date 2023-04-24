<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Hello <?php echo $name; ?>,</h4>
    <p>Case Id :  <?php echo $ticket_id; ?> </p>
    <p>Subject :  <?php echo $emailSubject; ?></p>    
    <hr>
    <p>Support Team: <?php echo $adminReply; ?> </p>

    <!-- <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; display: block; overflow-x: auto;"> 
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Name</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $name; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Your Message</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $massage; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Admin Meassage</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $adminReply; ?></td>
        </tr>
    </table> -->
</div>
<?php include 'email_head_foot/email_foot.php'; ?>