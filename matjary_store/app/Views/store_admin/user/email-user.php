 <?php $server_site_path = base_url(); ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Matjary">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matjary Mail</title>
</head>
<body>
    <div class="mail-template-box" style="margin: 0;padding: 0;display: grid;place-content: center;in-height: 100vh;border:1px solid #333;">
        <div class="mail-template-body" style="background-color: #FFF;box-shadow: 3px 4px 15px #44464778;padding: 2rem;border-radius: 10px;margin: 10px;">
            <div class="mail-template-logo">
                <img class="img-fluid" style="width: 400px !important;margin-left: auto;margin-right: auto;display: block;" src="'.$server_site_path.'/store/assets/images/logo.png">
            </div>
            <hr>
            <div class="mail-template-content text-center" style="padding: 1rem 0;text-align: center;">
                <h3>Customer Register</h3>
                <h4>We are happy to help you.</h4>
                <h5>congratulations !
                    Your Account has been successfully created..
                </h5>

            </div>
            <hr>
            <div class="mail-template-footer" style="text-align: center;">
                <h4 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Follow us</h4>
                <ul class="mail-template-icons-list" style="display: inline-flex;padding-left: 0;list-style: none;">
                    <li style="margin: 0.5rem;"><a href="#"><img src="'.$server_site_path.'/store/assets/image/facebook.png" style="width: 40px;height: 40px;"></a></li>
                    <li style="margin: 0.5rem;"><a href="#"><img src="'.$server_site_path.'/store/assets/image/instagram.png" style="width: 40px;height: 40px;"></a></li>
                    <li style="margin: 0.5rem;"><a href="#"><img src="'.$server_site_path.'/store/assets/image/twitter.png" style="width: 40px;height: 40px;"></a></li>
                </ul>
                <h6 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;margin-top: 0;">Visit us on <a href="'.$server_site_path.'" target="blank"><?php echo $server_site_path; ?></a></h6>
                <h4 class="mt-3" style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Download App</h4>
                <a href="#"><img class="mail-template-app-logo" src="'.$server_site_path.'/store/assets/images/google-play-store-transparent.png" style="width: 150px;height: auto;"></a>
                <a href="#"><img class="mail-template-app-logo" src="'.$server_site_path.'/store/assets/images/appl-store-transparent.png" style="width: 150px;height: auto;"></a>
            </div>
        </div>
    </div>
</body>
</html>