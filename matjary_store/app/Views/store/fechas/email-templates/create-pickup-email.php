<?php $server_site_path = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Response Mail</title>
</head>
<style>
    .mail-wrap {
        width: 400px;
        padding: 1.5rem;
        background-color: #FFFFFF;
    }

    @media (max-width: 400px) {
        .mail-wrap {
            width: 200px;
        }
    }
</style>
<body style="list-style: none; text-decoration: none; padding: 0; margin: 0; background-color: #FAFAFA; display: grid; place-content: center; min-height: 100vh;">
 <div class="mail-wrap" style="width: 50%; margin:0% 24%; padding: 1.5rem;background-color: #FFFFFF;">
        <div>
            <img src="<?php echo isset($storeLogo)?$storeLogo:''; ?>" style="width: auto; height: 100px; object-fit: contain; margin-bottom: 1rem; margin-left: auto; margin-right: auto; display: block;">
        </div>
        <div style="font-family: sans-serif;">
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 10px; color: #4BB543; border-bottom: 1px solid #dfdfdf; padding-bottom: 1rem;">Pickup Created Sucessfully</h2>
            <h3 style="margin-bottom: 10px;">Dear <?php echo 'Customer'; ?> ,</h3>
            <p style="line-height: 1.8; color: #000000; margin-bottom: 5px;">We are happy to help you!</p>
            <p style="line-height: 1.8; color: #000000; margin-bottom: 5px;">Your order is ready to dispatch, you can track your order status by tracking details:</p> 
            <hr>
            <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; overflow-x: auto;">
                <tr>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Tracking ID</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Tracking Link</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;"><?php echo isset($shipping_id)?$shipping_id:'NA'; ?></td>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;"><a href="https://trackcourier.io/track-and-trace/aramex-courier/<?php echo isset($shipping_id)?$shipping_id:'NA'; ?>" target="_blank">Click here to track</a></td>
                </tr>
            </table>           
            <p>Regards,</p>
            <p>Team <?php echo $storeName; ?></p>
            <div style="text-align: center; margin-top: 1rem; border-top: 5px solid #f5f5f5">
                <p style="margin-bottom: 5px;">Powered by <a href="<?php echo base_url('home'); ?>" target="_blank" style="text-decoration: none; color: #5294F7;"><?php echo $storeName; ?></a></p>
                <small>Address: <?php echo $address; ?> <a href="mailto:<?php echo $supportEmail;?>" style="text-decoration: none; color: #5294F7;"><?php echo $supportEmail;?></a></small>
                <div style="display: block; margin-left: auto; margin-right: auto; padding-top: 0.5rem;">
                    <a href="<?php echo $sociaFB; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store_admin/assets/images/facebook.png"></a>
                    <a href="<?php echo $socialInstagram; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store_admin/assets/images/instagram.png"></a>
                    <a href="<?php echo $socialTwitter; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;"  src="<?php echo $server_site_path; ?>/store_admin/assets/images/twitter.png"></a>
                    <a href="<?php echo $socialYoutube; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;"  src="<?php echo $server_site_path; ?>/store_admin/assets/images/youtube.png"></a>
                    <a href="<?php echo $socialLinkedin; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;"  src="<?php echo $server_site_path; ?>/store_admin/assets/images/linkedin.png"></a>
                </div>
                <small>Disclaimer: This email was sent from an email address that can't receive emails. Please don't reply to this email. </small>
            </div>
        </div>
    </div>
</body>
</html>