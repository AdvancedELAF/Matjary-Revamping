<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Matjary Admin</title>
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/img/logo.png"> 
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/css/adminlte.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/sweetalert.css" />
  <!-- Animate CSS & JS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/animate.css" />
  <!-- Loader CSS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/loader.css" />
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/css/style.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>      
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>     
    </ul>
  </nav>
  <!-- /.navbar -->
 </head>