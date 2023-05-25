<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<?php  
    $this->load->view('site_admin/layout/header.php');
    $this->load->view('site_admin/layout/sidebar.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> 
    <section class="content">
      <div class="container-fluid">
			<div class="row ">
			<form method="POST" action="<?php echo base_url('change-admin-password'); ?>" name="change_admin_password" id="change_admin_password" enctype="multipart/form-data">
				<div class="card-body">
					<div class="row ">
						<div class="col-md-12 mb-3">
								<label class="brand-label " >Old Password<span class="required-mark"> *</span></label>
								<input type="password" class="form-control" id="old_pass" name="old_pass">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="brand-label " >New Password<span class="required-mark"> *</span></label>
								<input type="password" class="form-control" id="new_pass" name="new_pass">
							</div>
							<div class="col-md-6">
								<label class="brand-label " >Confirm Password<span class="required-mark"> *</span></label>
								<input type="password" class="form-control" id="cnf_pass" name="cnf_pass">
							</div>
						</div>
						<div class="mt-2">                       
							<button class="btn btn-primary">Update</button>
					</div>
				</div>
			</form>			
		</div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('site_admin/layout/footer.php'); ?>
