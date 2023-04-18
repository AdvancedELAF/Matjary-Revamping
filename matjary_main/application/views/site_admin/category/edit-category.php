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
                        <h1 class="m-0">Edit Template Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Template Category</li>
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
            <?php  //echo '<pre>'; print_r($GetSingleCatDetails); die; ?>
                <form method="POST" action="<?php echo base_url('save-category'); ?>" name="save_category" id="save_category" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($GetSingleCatDetails->id)?$GetSingleCatDetails->id:''; ?>" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Template Category Name (English)</label>
                                    <input type="text" class="form-control" id="theme_cat_name" name="theme_cat_name" value="<?php echo isset($GetSingleCatDetails->theme_cat_name)?$GetSingleCatDetails->theme_cat_name:''; ?>" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="theme_cat_name_ar">Template Category Name (Arabic)</label>
                                    <input type="text" class="form-control" id="theme_cat_name_ar" name="theme_cat_name_ar" value="<?php echo isset($GetSingleCatDetails->theme_cat_name_ar)?$GetSingleCatDetails->theme_cat_name_ar:''; ?>" placeholder="Enter Last Name">
                                </div>
                            </div>
                            
                            <div class="col-md-6"> 
                                <label for="usr_role">Is Active</label>
                                <select class="form-control" name="is_active" id="is_active">
                                    <option <?php if($GetSingleCatDetails->is_active == '1'){ echo ' selected="selected"'; } ?>  value="1" <?php echo $selected; ?>>Activate</option>
                                    <option <?php if($GetSingleCatDetails->is_active == '2'){ echo ' selected="selected"'; } ?>  value="2" <?php echo $selected; ?>>Deactivate</option>   
                                </select>
                            </div>                            
                                                              
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url('site-admin/all-categorys'); ?>" class="btn btn-secondary" >Cancel</a>
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
