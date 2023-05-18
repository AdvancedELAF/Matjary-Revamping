<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Hello <?php echo $name; ?>,</h4>
    <p>Case Id :  <?php echo $ticket_id; ?> </p>
    <p>Subject :  <?php echo $emailSubject; ?></p>    
    <hr>
    <p>Support Team: <?php echo $adminReply; ?> </p>
    <br/><br/>
    <p><strong>Ticket Details</strong><a href="<?php echo $ticket_link;?>">You can check ticket status here</a> </p>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>