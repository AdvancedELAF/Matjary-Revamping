<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Hello Matjary-Admin,</h4>
    <p style="line-height: 1.8; color: #000000">There is an enquiry from below contact</p>
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; display: block; overflow-x: auto;"> 
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Name</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $cont_name; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Email</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $cont_email; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Contact</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $con_phone_no; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Subject</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $cont_subject; ?></td>
        </tr>
        <tr>
            <th style="color: #8D4FDE; border: 1px solid #DDDDDD; padding: 8px;">Message</th>
            <td style="border: 1px solid #DDDDDD; padding: 8px;"><?php echo $cont_message; ?></td>
        </tr>
    </table>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>