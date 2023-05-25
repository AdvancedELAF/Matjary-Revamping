<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/sweetalert.css" />
  <!-- Animate CSS & JS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/animate.css" />
  <!-- Loader CSS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/loader.css" />
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/style.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('site-admin/'); ?>">Set New Password</a>
  </div>  
  <!-- /.login-logo -->
  <div class="card" style="width: 149%;margin-left: -108px;">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="POST" action="<?php echo base_url('set-admin-reset-password'); ?>" name="set_admin_reset_password" id="set_admin_reset_password" enctype="multipart/form-data">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />                              
        <div class="card-body">                  
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-md-4 col-form-label">Password</label>
                    <div class="col-md-8">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-md-4 col-form-label">Confirm Password</label>
                    <div class="col-md-8">
                      <input type="password" class="form-control" name="conf_password" id="conf_password" placeholder="Confirm Password">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <!--button type="submit" class="btn btn-default float-right">Cancel</button-->
                </div>
                <!-- /.card-footer -->
        </form>      
      </div>
      <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/js/adminlte.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/js/wow.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/js/sweetalert.min.js"></script>
<!-- form validate js -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/js/jquery-validate.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/js/form-validation.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/js/ajax-call.js"></script>
<!-- Bootstrap JS -->
<!-- Popper Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>
</html>
