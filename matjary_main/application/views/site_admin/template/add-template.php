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
                        <h1 class="m-0">Add Template</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Template</li>
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
                <h3 class="card-title">Add Template</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="<?php echo base_url('save-template'); ?>" name="save_template" id="save_template" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="name">Template Name (English)</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Template Name in English">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="name_ar">Template Name (Arabic)</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="Enter Template Name in Arabic">
                            </div>
                        </div>                        
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="HalfBanner">Half Banner</label>
                                <div class="input-group">
                                    <div class="custom-file">                                       
                                        <input type="file" class="form-control"  name="template_half_banner" id="template_half_banner" >
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="FullBanner">Full Banner</label>
                                <div class="input-group">
                                    <div class="custom-file">                                        
                                        <input type="file" class="form-control"  name="template_full_banner" id="template_full_banner">
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="category_id">Template Category</label>
                                <select class="form-control"  name="category_id" id="category_id">
                                    <option disabled selected >Template Category</option>                                             
                                    <?php if (isset($getCategoryList) && !empty($getCategoryList)) {
                                        foreach ($getCategoryList as $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->theme_cat_name;?></option>
                                    <?php } }?>    
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label>Paid / Free Status</label><br>
                                <input type="radio" name="free_paid_flag" value="1" data-error=".error1"> Free  &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="free_paid_flag" value="2" data-error=".error1"> Paid
                                </br><span class="error1"></span>
                            </div>  
                        </div>
                        <div class="col-md-6 cost" id="cost" style="display:none;">
                            <div class="form-group">
                                <label for="template_cost">Cost</label>
                                <input type="text" class="form-control numberonly" id="template_cost" name="template_cost" placeholder="Enter Cost">
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="demo_link">Demo Link</label>
                                <input type="url" class="form-control" id="demo_link" name="demo_link" placeholder="Enter Demo Link">
                            </div>  
                        </div>                                             
                        <div class="col-md-6 ">                                   
                            <div class="form-group">
                                <label for="description">Description (English) </label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter Description..."></textarea>
                            </div>  
                        </div>
                        <div class="col-md-6 ">                                   
                            <div class="form-group">
                                <label for="description_ar">Description (Arabic)</label>
                                <textarea id="description_ar" name="description_ar" class="form-control" rows="3" placeholder="Enter Description..."></textarea>
                            </div>  
                        </div>      
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="is_active">Is Active</label>
                                <select class="form-control"  name="is_active" id="is_active">
                                    <option disabled selected >Select</option>
                                    <option value="1" >Active</option> 
                                    <option value="2" >Deactivate</option>    
                                </select>
                            </div>
                        </div>                                                    
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
