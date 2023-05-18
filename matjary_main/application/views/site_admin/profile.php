<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
} 
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">                
                <h3 class="profile-username text-center"><?php echo $getAdminUserData->fname .' '.$getAdminUserData->lname; ?></h3>
                <p class="text-muted text-center"><?php if($getAdminUserData->usr_role == '1'){ echo 'Site Admin'; } ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Role</strong>
                <p class="text-muted">
                    <?php 
                        if($getAdminUserData->usr_role == 1){
                            echo 'Super Admin';
                        }elseif($getAdminUserData->usr_role == 2){
                          echo 'Admin';
                        }elseif($getAdminUserData->usr_role == 3){
                          echo 'User';
                        }elseif($getAdminUserData->usr_role == 4){
                          echo 'Manager';
                        }elseif($getAdminUserData->usr_role == 5){
                          echo 'Customer Support Executive';
                        }
                    ?>
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted"><?php echo $getAdminUserData->address; ?></p>
                            
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Bio</strong>
                <p class="text-muted">Not Available</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" method="POST" action="<?php echo base_url('save-profile'); ?>" name="save_profile" id="save_profile" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo isset($getAdminUserData->id)?$getAdminUserData->id:''; ?>" />
                      <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo isset($getAdminUserData->fname)?$getAdminUserData->fname:''; ?>" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo isset($getAdminUserData->lname)?$getAdminUserData->lname:''; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input disabled ="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($getAdminUserData->email)?$getAdminUserData->email:''; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone_no" class="col-sm-2 col-form-label">Contact No.</label>
                        <div class="col-sm-10">
                          <input type="phone_no" class="form-control numberonly" id="phone_no" name="phone_no" placeholder="Enter a Contect No." minlength="9" maxlength="10" value="<?php echo isset($getAdminUserData->phone_no)?$getAdminUserData->phone_no:''; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone_no" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select name="country_id" id="country_id" data-actionurl="<?php echo base_url(); ?>get-country-states" class="form-control" >
                                <option value="">Select Country</option>
                                <?php
                                    if (isset($countryList) && !empty($countryList)) {
                                        foreach ($countryList as $countryData) {
                                            $selected = "";
                                            if (isset($getAdminUserData->country_id) && !empty($getAdminUserData->country_id)) {
                                                if ($countryData['id'] == $getAdminUserData->country_id) {
                                                    $selected = "selected";
                                                }
                                            }
                                    ?>
                                        <option value="<?php echo isset($countryData['id']) ? $countryData['id'] : ''; ?>" <?php echo $selected; ?>><?php echo isset($countryData['name']) ? $countryData['name'] : ''; ?></option>
                                    <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone_no" class="col-sm-2 col-form-label">State</label>
                        <div class="col-sm-10">
                        <select name="state_id" id="state_id" data-actionurl="<?php echo base_url(); ?>get-state-cities" class="form-control">
                              <option value="">Select State</option>
                              <?php 
                                if(isset($stateList) && !empty($stateList)){
                                  
                                  foreach($stateList as $stateData){
                                    $selected = "";
                                    if(isset($getAdminUserData->state_id) && !empty($getAdminUserData->state_id)){
                                      if($stateData->id==$getAdminUserData->state_id){
                                        $selected = 'selected';
                                      }
                                    }
                                  ?>
                                  <option value="<?php echo isset($stateData->id)?$stateData->id:''; ?>" <?php echo $selected; ?>><?php echo isset($stateData->name)?$stateData->name:''; ?></option>
                                  <?php
                                    }
                                  }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone_no" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                        <select name="city_id" id="city_id" class="form-control">
                            <option value="">Select City</option>
                            <?php
                                if (isset($cityList) && !empty($cityList)) {
                                    foreach ($cityList as $cityData) {
                                        $selected = "";
                                        if (isset($getAdminUserData->city_id) && !empty($getAdminUserData->city_id)) {
                                            if ($cityData->id == $getAdminUserData->city_id) {
                                                $selected = "selected";
                                            }
                                        }
                                ?>
                                <option value="<?php echo isset($cityData->id) ? $cityData->id : ''; ?>" <?php echo $selected; ?>><?php echo isset($cityData->name) ? $cityData->name : ''; ?></option>
                                <?php
                                    }
                                }
                            ?>
                        </select>
                        </div>
                      </div>

                      <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Zip Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control numberonly" id="zipcode" name="zipcode" value="<?php echo isset($getAdminUserData->zipcode)?$getAdminUserData->zipcode:''; ?>" placeholder="Enter Zipcode" minlength="5" maxlength="6">
                            </div>
                      </div>

                      <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Fax No.</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control numberonly" id="fax_no" name="fax_no" value="<?php echo isset($getAdminUserData->fax_no)?$getAdminUserData->fax_no:''; ?>" placeholder="Enter Fax Number" maxlength="15">
                            </div>
                      </div>
                      <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address..."><?php echo isset($getAdminUserData->address)?$getAdminUserData->address:''; ?></textarea>
                            </div>
                      </div>
                                        
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-5">
                          <button type="submit" class="btn btn-primary ">Submit</button>
                          <a class="btn btn-secondary" href="<?php echo base_url('site-admin/change-password'); ?>"><i class="dw dw-help"></i> Change Password</a>
                            
                        </div>                        
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('site_admin/layout/footer.php'); ?>
