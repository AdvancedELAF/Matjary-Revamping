<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $email_title; ?></title>
    </head>
    <body style="list-style: none; text-decoration: none; padding: 1.5rem; margin: 0; background-color: #FFFFFF;  border-top: 5px solid #E63A7B; border-bottom: 5px solid #E63A7B;">
        <div class="logo_dis">
            <img src="https://ds3jdc9r5jgje.cloudfront.net/matjary/matjary-logo.png" style="width: auto; height: 80px; object-fit: contain; margin-bottom: 1rem;">
        </div>
        <div style="font-family: sans-serif;">
            <div class="mail_content">
                <h4 style="margin-bottom: 10px; color: #8D4FDE">Dear <?php echo $username; ?>,</h4> 
                <p>Congratulations! You have successfully registered for our service.</p>
                <p>For security reasons, you will need to set a password in order to login into your account. Please click on the link below to set a new password.</p>
                <a href="<?php echo $pass_reset; ?>" target="_blank" style="text-decoration: none; color: #5294F7;">[click here to set new password]</a>
                <p>In case you have any questions or need help with setting up your account, don't hesitate to reach out and we will be more than happy to assist you.</p>
                <p>We look forward to having you onboard!</p>
            </div>

            <div class="mail_disclaimer">
                <p>Best regards,</p>
                <p>Team Matjary</p>
                <small>This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email.</small>
            </div>
            <div class="site_social_links">
                <div style="text-align: center; margin-top: 1rem; border-top: 5px solid #f5f5f5">   
                    <p style="margin-bottom: 5px;">Powered by <a href="www.advancedelaf.com" target="_blank" style="text-decoration: none; color: #5294F7;">Advanced Elaf</a></p>
                    <small>Address: Ath Thumamah Road, Riyadh, Kingdom of Saudi Arabia | <a href="mailto:' . AE_CONTACT . '" style="text-decoration: none; color: #5294F7;"><?php echo AE_CONTACT; ?></a></small>
                    <div style="display: block; margin-left: auto; margin-right: auto; padding-top: 0.5rem;">
                        <a href="<?php echo MATJARY_FB_LINK; ?>" target="_blank"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="https://ds3jdc9r5jgje.cloudfront.net/matjary/facebook-icon.png"></a>
                        <a href="<?php echo MATJARY_TWITTER_LINK; ?>" target="_blank"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="https://ds3jdc9r5jgje.cloudfront.net/matjary/twitter-icon.png"></a>
                        <a href="<?php echo MATJARY_LINKEDIN_LINK; ?>" target="_blank"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="https://ds3jdc9r5jgje.cloudfront.net/matjary/linkedin-icon.png"></a>
                        <a href="<?php echo MATJARY_INSTA_LINK; ?>" target="_blank"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="https://ds3jdc9r5jgje.cloudfront.net/matjary/instagram-icon.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>