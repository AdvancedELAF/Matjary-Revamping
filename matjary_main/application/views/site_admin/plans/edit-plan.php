<?php
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Plan</h3>
                    </div> <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="<?php echo base_url('update-plan'); ?>" name="update_plan" id="update_plan" enctype="multipart/form-data">
                        <input type="hidden" name="plan_id" value="<?php echo isset($GetSinglePlanDetails->id)?$GetSinglePlanDetails->id:''; ?>" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label for="plan_name">Plan Name </label>
                                        <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Enter Plan Name." value="<?php echo isset($GetSinglePlanDetails->plan_name)?$GetSinglePlanDetails->plan_name:''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label for="plan_desc">Plan Description</label>
                                        <textarea id="plan_desc" name="plan_desc" class="form-control" rows="3" placeholder="Enter Plan  Description..."><?php echo isset($GetSinglePlanDetails->plan_desc)?$GetSinglePlanDetails->plan_desc:''; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validity_in_months">Plan Periods</label>
                                    <select class="form-control"  name="plan_periods" id="plan_periods">
                                        <option disabled selected >Select</option>
                                        <option value="1" <?php if($GetSinglePlanDetails->validity_in_months == 1){ echo 'selected'; } ?>>Monthly</option> 
                                        <option value="12" <?php if($GetSinglePlanDetails->validity_in_months == 12){ echo 'selected'; } ?>>Yearly</option>    
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Plan Price</label>
                                        <input type="text" class="form-control numberonly" id="price" name="price" placeholder="Enter Plan Price" value="<?php echo isset($GetSinglePlanDetails->price)?$GetSinglePlanDetails->price:''; ?>" minlength="1" maxlength="4">
                                    </div>  
                                </div>
                                <div class="col-md-12"> 
                                    <label for="is_active">Features</label>
                                    <div id="planFeaturesWrapper">
                                        <?php 
                                            if(isset($getPlanFetauresList) && !empty($getPlanFetauresList)){
                                        ?>
                                                <div class="featureItem">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label" for="feature_name_en">List In English:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label" for="feature_name_ar">List In Arabic:</label>
                                                            </div>   
                                                        </div>
                                                    </div> 
                                                </div> 
                                        <?php
                                                foreach($getPlanFetauresList as $featureData){
                                        ?>
                                                    <div class="featureItem">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input type="text" value="<?php echo isset($featureData->feature_name_en)?$featureData->feature_name_en:$featureData->feature_name_en; ?>" class="form-control" id="feature_name_en" placeholder="Enter Feature In English" name="feature_name_en[]" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input type="text" value="<?php echo isset($featureData->feature_name_ar)?$featureData->feature_name_ar:$featureData->feature_name_ar; ?>" class="form-control" id="feature_name_ar" placeholder="Enter Feature In Arabic" name="feature_name_ar[]" autocomplete="off">
                                                                </div>   
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" class="btn btn-danger removePlanFeature">X</a>
                                                            </div>
                                                        </div> 
                                                    </div> 
                                        <?php
                                                }
                                            }else{
                                        ?>
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
                                        <?php } ?>                             
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
                                        <option <?php if($GetSinglePlanDetails->is_active == '1'){ echo ' selected="selected"'; } ?>  value="1" >Active</option> 
                                        <option <?php if($GetSinglePlanDetails->is_active == '2'){ echo ' selected="selected"'; } ?>  value="2" >Deactivate</option>    
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
                </div> <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
