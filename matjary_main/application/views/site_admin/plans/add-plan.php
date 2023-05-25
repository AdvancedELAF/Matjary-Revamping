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
                        <h1 class="m-0">Add Plan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Plan</li>
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
              <form method="POST" action="<?php echo base_url('save-plan'); ?>" name="save_plan" id="save_plan" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="plan_name">Name </label>
                                <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter Plan Name.">
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="plan_desc">Description</label>
                                <textarea id="plan_desc" name="plan_desc" class="form-control" rows="3" placeholder="Enter Plan  Description..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                                <label for="plan_periods">Periods</label>
                                <select class="form-control"  name="plan_periods" id="plan_periods">
                                    <option disabled selected >Select</option>
                                    <option value="1" >Monthly</option> 
                                    <option value="12" >Yearly</option>    
                                </select>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control numberonly" id="price" name="price" placeholder="Enter Plan Price" minlength="1" maxlength="4">
                            </div>  
                        </div>

                        <div class="col-md-12"> 
                            <label for="Features">Features</label>
                            <div id="planFeaturesWrapper">
                                <div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label" for="feature_name_en">List In English:</label>
                                                <input type="text" class="form-control" id="feature_name_en" placeholder="Enter Feature In English" name="feature_name_en[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label" for="feature_name_ar">List In Arabic:</label>
                                                <input type="text" class="form-control" id="feature_name_ar" placeholder="Enter Feature In Arabic" name="feature_name_ar[]" autocomplete="off">
                                            </div>   
                                        </div>
                                    </div> 
                                </div>                               
                            </div>  
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                    <button type="button" id="addMoreFeaturesBtn" class="btn btn-success">Add More Features</button>
                                </div>
                            </div>                   
                        </div>                        
                        <div class="col-md-6"> 
                            <label for="is_active">Is Active</label>
                            <select class="form-control"  name="is_active" id="is_active">
                                <option disabled selected >Select</option>
                                <option value="1" >Active</option> 
                                <option value="2" >Deactivate</option>    
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?php echo base_url('site-admin/all-plans'); ?>" class="btn btn-secondary">Cancel</a>
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
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
