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
                        <h1 class="m-0">Add Template Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Template Category</li>
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
                <form method="POST" action="<?php echo base_url('save-template-category'); ?>" name="save_template_category" id="save_template_category" enctype="multipart/form-data">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="theme_cat_name">Template Category Name (English)</label>
                                        <input type="text" class="form-control" id="theme_cat_name" name="theme_cat_name" placeholder="Enter Category Name in English">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="theme_cat_name_ar">Template Category Name (Arabic)</label>
                                        <input type="text" class="form-control" id="theme_cat_name_ar" name="theme_cat_name_ar" placeholder="Enter Category Name in Arabic">
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
<?php $this->load->view('site_admin/layout/footer.php'); ?>
