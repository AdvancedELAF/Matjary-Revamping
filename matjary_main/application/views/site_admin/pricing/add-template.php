<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<?php //include('./layout/admin-layout.php');
include(APPPATH.'views/site_admin/layout/admin-layout.php'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="content-wrapper">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Template</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="fname">Template Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="exampleInputFile">Half Banner</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="exampleInputFile">Full Banner</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>
                        </div>                       
                        
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="category">category</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Enter Email category">
                            </div>
                        </div>                       
                        <div class="col-md-6 ">                                   
                            <div class="form-group">
                                <label for="address">Short Description</label>
                                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address..."></textarea>
                            </div>  
                        </div>
                        <div class="col-md-6 ">                                   
                            <div class="form-group">
                                <label for="address">Long Description</label>
                                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter Address..."></textarea>
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
