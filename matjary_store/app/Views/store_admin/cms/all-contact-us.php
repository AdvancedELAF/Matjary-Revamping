<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['All Contact Us']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">CMS</a></li>                    
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Contact Us']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" id="multiActionOption" data-table="<?php echo isset($table) ? $table : 'NA'; ?>" data-actionurl="<?php echo base_url('multi-action-option'); ?>">
                        <option value=""><?php echo $language['Choose Action'];?></option>                    
                        <option value="3"><?php echo $language['Delete'];?></option>
                    </select>            
                </div>      
                <div class="col-md-6">            
                </div>
                <div class="col-md-3">
                </div>                
            </div>   
        </div>
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllContactUsList">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="checkAll"></th>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Name']; ?></th>
                        <th scope="col"><?php echo $language['Email']; ?></th>
                        <th scope="col"><?php echo $language['Contact No.']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php                
                    if(isset($ContactUsList) && !empty($ContactUsList)){
                        $i = 1;
                        foreach ($ContactUsList as $value) {                        
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="itemId[]"  class="itemId" value="<?php echo isset($value->id) ? $value->id : 'NA'; ?>" />
                            </td>
                            <td><h5 class="font-16"><?php echo $i; ?></h5></td>
                            <td><h5 class="font-16"><?php echo isset($value->name)?$value->name:'NA'; ?></h5></td>                        
                            <td><h5 class="font-16"><?php echo isset($value->email)?$value->email:'NA'; ?></h5></td>
                            <td><h5 class="font-16"><?php echo isset($value->contact_no )?$value->contact_no :'NA'; ?></h5></td>                          
                            
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">                                       
                                        <a class="dropdown-item" href="<?php echo base_url('admin/view-contact-us/'.$value->id); ?>"><i class="fa fa-eye"></i> <?php echo $language['View']; ?> </a>
                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-contact-us'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                        }
                    }else{
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
    </div>
</div>
<?php $this->endSection(); ?>