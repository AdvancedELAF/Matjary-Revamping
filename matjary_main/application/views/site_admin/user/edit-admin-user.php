<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
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
                        <h1 class="m-0">Edit User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                <form method="POST" action="<?php echo base_url('save-edit-admin-user'); ?>" name="save_edit_admin_user" id="save_edit_admin_user" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo isset($singleUserData[0]->id)?$singleUserData[0]->id:''; ?>" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo isset($singleUserData[0]->fname)?$singleUserData[0]->fname:''; ?>" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo isset($singleUserData[0]->lname)?$singleUserData[0]->lname:''; ?>" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($singleUserData[0]->email)?$singleUserData[0]->email:''; ?>" disabled placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_no">Contact No.</label>
                                    <input type="text" class="form-control numberonly" id="phone_no" name="phone_no" value="<?php echo isset($singleUserData[0]->phone_no)?$singleUserData[0]->phone_no:''; ?>" minlength="9" maxlength="10" placeholder="Enter Contact No.">
                                </div>     
                            </div>                                                      
                            <div class="col-md-6">                                   
                                <div class="form-group">
                                    <label for="country_id">Country</label>
                                    <select name="country_id" id="country_id" data-actionurl="<?php echo base_url(); ?>get-country-states" class="form-control select2" >
                                        <option value="">Select Country</option>
                                        <?php
                                            if (isset($countryList) && !empty($countryList)) {
                                                foreach ($countryList as $countryData) {
                                                    $selected = "";
                                                    if (isset($singleUserData[0]->country_id) && !empty($singleUserData[0]->country_id)) {
                                                        if ($countryData['id'] == $singleUserData[0]->country_id) {
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
                            <div class="col-md-6">                                   
                                <div class="form-group">
									<label>State </label>
									<select name="state_id" id="state_id" data-actionurl="<?php echo base_url(); ?>get-state-cities" class="form-control select2">
										<option value="">Select State</option>
										<?php 
											if(isset($stateList) && !empty($stateList)){
												
												foreach($stateList as $stateData){
													$selected = "";
													if(isset($singleUserData[0]->state_id) && !empty($singleUserData[0]->state_id)){
														if($stateData->id==$singleUserData[0]->state_id){
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
                            <div class="col-md-6">                                   
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select name="city_id" id="city_id" class="form-control select2">
                                        <option value="">Select City</option>
                                        <?php
                                            if (isset($cityList) && !empty($cityList)) {
                                                foreach ($cityList as $cityData) {
                                                    $selected = "";
                                                    if (isset($singleUserData[0]->city_id) && !empty($singleUserData[0]->city_id)) {
                                                        if ($cityData->id == $singleUserData[0]->city_id) {
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input type="text" class="form-control numberonly" id="zipcode" name="zipcode" value="<?php echo isset($singleUserData[0]->zipcode)?$singleUserData[0]->zipcode:''; ?>" placeholder="Enter Zipcode" minlength="5" maxlength="6">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fax_no">Fax No.</label>
                                    <input type="text" class="form-control numberonly" id="fax_no" name="fax_no" value="<?php echo isset($singleUserData[0]->fax_no)?$singleUserData[0]->fax_no:''; ?>" placeholder="Enter Fax Number" maxlength="15">
                                </div>
                            </div> 
                            <div class="col-md-12">                                   
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address..." maxlength="31"><?php echo isset($singleUserData[0]->address)?$singleUserData[0]->address:''; ?></textarea>
                                </div>  
                            </div>                                    
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url('site-admin/all-users'); ?>" class="btn btn-secondary">Cancel</a>
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
<?php $this->load->view('site_admin/layout/footer.php');  ?>

