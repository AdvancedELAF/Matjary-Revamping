<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<?php  
    $this->load->view('site_admin/layout/header.php');
    $this->load->view('site_admin/layout/sidebar.php');
?>
<section class="content">
    <div class="container-fluid">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Employee</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Employee</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="<?php echo base_url('save-employee'); ?>" name="save_employee" id="save_employee" enctype="multipart/form-data">
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <label for="role">Role</label>
                                <select class="form-control"  name="role" id="role">
                                    <option disabled selected >Employee Role</option>                                             
                                    <?php if (isset($UserroleList) && !empty($UserroleList)) {
                                        foreach ($UserroleList as $hostel) { ?>
                                        <option value="<?php echo $hostel->role_id; ?>"><?php echo $hostel->role_name;?></option>
                                    <?php } }?>    
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_no">Contact No.</label>
                                    <input type="text" class="form-control numberonly" id="phone_no" name="phone_no" minlength="9" maxlength="10" placeholder="Enter Contact No.">
                                </div>     
                            </div>                                                      
                            <div class="col-md-6">                                   
                                <div class="form-group">
                                    <label for="country_id">Country</label>
                                    <select class="form-control select2" name="country_id" id="country_id" data-actionurl="<?php echo base_url(); ?>get-country-states">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                            </div> 
                            <div class="col-md-6">                                   
                                <div class="form-group">
                                    <label for="state_id">State</label>
                                    <select name="state_id" id="state_id" data-actionurl="<?php echo base_url(); ?>get-state-cities" class="form-control">
                                        <option value="">State</option>
                                    </select>
                                </div>  
                            </div> 
                            <div class="col-md-6">                                   
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value="">Select City</option>
                                    </select>
                                </div>  
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input type="text" class="form-control numberonly" id="zipcode" name="zipcode" placeholder="Enter Zipcode" minlength="5" maxlength="6">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fax_no">Fax No.</label>
                                    <input type="text" class="form-control numberonly" id="fax_no" name="fax_no" placeholder="Enter Fax Number" maxlength="15">
                                </div>
                            </div> 
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address..." maxlength="31"></textarea>
                                </div>  
                            </div>                                    
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url('site-admin/all-employees'); ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            <!-- general form elements -->
          </div>
          <!--/.col (left) -->
          </div>
    </div>
</section>
<?php $this->load->view('site_admin/layout/footer.php'); ?>

