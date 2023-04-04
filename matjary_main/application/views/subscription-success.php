<?php
include("common/header.php");

$session_data = $this->session->userdata('loggedInUsrData');
print_r($session_data);
?>
<section>
    <div class="custom-container">
        <div class="login-wrapper wow fadeIn" data-wow-delay="200ms">
            <div class="login-box wow slideInDown" data-wow-delay="400ms">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo-2.png">

                <p><?php echo $info_msg; ?></p>
                <p><storng>Store Url: </storng> <?php echo $store_link; ?> </p>
                <p><storng>Admin Url: </storng> <?php echo $store_admin_link; ?> </p>

            </div>
        </div>
    </div>

</section>

<!-- Footer section  -->
<?php include("common/footer.php"); ?>