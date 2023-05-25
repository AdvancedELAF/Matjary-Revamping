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
                        <h1 class="m-0">All Matjary Templates</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">All Matjary Templates</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="row"><!-- /.row -->
                <div class="col-12">
                    <div class="card">                     
                    <!-- /.card-header -->
                            <div class="card-body" id="listingWrapper">
                                <table class="table table-bordered table-striped" id="viewAllTemplateList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Template Name (English)</th>
                                            <th>Template Name (Arabic)</th>
                                            <th>Half Banner</th>
                                            <th>Full Banner</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (isset($getTemplateList) && !empty($getTemplateList)) {
                                                $i = 1;
                                                foreach ($getTemplateList as $value) {
                                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo isset($value->name) ? $value->name : 'NA'; ?></td>
                                            <td><?php echo isset($value->name_ar) ? $value->name_ar : 'NA'; ?></td>
                                            <td><?php
                                             if (isset($value->template_half_banner) && !empty($value->template_half_banner)) { ?>
                                                <img src="<?php echo base_url('/uploads/template_half_banners'); ?>/<?php echo isset($value->template_half_banner) ? $value->template_half_banner : ''; ?>" class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:70px;max-height:70px;">
                                            <?php } else { ?>
                                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Banner image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                            <?php } ?>
                                            </td>  
                                            <td>
                                            <?php 
                                             if (isset($value->template_full_banner) && !empty($value->template_full_banner)) { ?>
                                                <img src="<?php echo base_url('/uploads/template_full_banners'); ?>/<?php echo isset($value->template_full_banner) ? $value->template_full_banner : ''; ?>" class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:70px;max-height:70px;">
                                            <?php } else { ?>
                                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Banner image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                            <?php } ?></td>                               
                                            </td>
                                            <td><?php if ($value->is_active == 1) {
                                                    echo 'Active';
                                                } else {
                                                    echo 'Deactivated';
                                                } ?></td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-align-justify" aria-hidden="true"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <?php if ($value->is_active == 1) { ?>
                                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/deactivate-template'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> Deactivate</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/activate-template'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i>Activate</a>
                                                    <?php } ?>
                                                    <a class="dropdown-item" href="<?php echo base_url('site-admin/edit-template/' . $value->id); ?>"><i class="dw dw-edit2"></i>Edit</a>
                                                    <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/delete-template'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> Delete</a>
                                                </div>
                                            </div>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6"><?php echo $language['No record found']; ?>.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->                
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>