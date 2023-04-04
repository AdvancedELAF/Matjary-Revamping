<?php include 'email_head_foot/email_head.php'; ?>
<div class="mail_content">
    <h4 style="margin-bottom: 10px; color: #8D4FDE">Hello <?php echo $username; ?>,</h4>
    <p style="line-height: 1.8; color: #000000">We've received a request to reset the password for the Matjary associated with <strong><?php echo $useremail; ?></strong>, No changes have been made to your account yet.</p>
    <p>You can reset your password by clicking the link below:</p>
    <div style="text-align: center;">
        <a href="<?php echo $rst_pwd_request_link; ?>" target="_blank" style="text-decoration: none; color: #FFFFFF; background-color: #E63A7B; padding: 10px; border-radius: 5px; text-align: center; display: block;" type="button">
            Reset your password
        </a>
    </div>
    <p style="line-height: 1.8; color: #000000">If you did not request a new password, please let us know immediately by replying to this email.</p>
    <p style="line-height: 1.8; color: #000000">You can find answers to most questions and get in touch with us at <a href="mailto:<?php echo AE_SUPPORT; ?>?subject=Feedback&body=Message" style="text-decoration: none; color: #5294F7;"><?php echo AE_SUPPORT; ?></a>. We're here to help you at any step along the way.</p>
</div>
<?php include 'email_head_foot/email_foot.php'; ?>