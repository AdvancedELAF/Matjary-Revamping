<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['All Faqs']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">CMS</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Faqs']; ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Faqs']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <a href="<?php echo base_url('admin/add-faq'); ?>" class="btn btn-primary pull-<?php echo $ses_lang == 'ar'?'left':'right'; ?>"><?php echo $language['Add New Faqs']; ?></a>
        </div>
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllFaqList">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Question']; ?></th>
                        <th scope="col"><?php echo $language['Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($FaqList) && !empty($FaqList)){
                        $i = 1;
                        foreach ($FaqList as $value) {
                            $question = '';
                            if($ses_lang=='en'){
                                if(isset($value->question) && !empty($value->question)){
                                    $question = $value->question;
                                }else{
                                    if(isset($value->question_ar) && !empty($value->question_ar)){
                                        $question = $value->question_ar;
                                    }
                                }                              
                            }else{
                                if(isset($value->question_ar) && !empty($value->question_ar)){
                                    $question = $value->question_ar;
                                }else{
                                    if(isset($value->question) && !empty($value->question)){
                                        $question = $value->question;
                                    }
                                }                                
                            }
                    ?>
                        <tr>
                            <td><h5 class="font-16"><?php echo $i; ?></h5></td>
                            <td><h5 class="font-16"><?php echo $question; ?></h5></td>
                            <!--<td><h5 class="font-16"><?php //echo isset($value->answear)?$value->answear:'NA'; ?></h5></td>                            -->
                            <td><?php if($value->is_active==1){ echo $language['Active'];}else{echo $language['Deactivated'];} ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> 
                                        <?php if($value->is_active==1){ ?> 
                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/deactivate-faq'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> <?php echo $language['Deactivate']; ?></a>
                                        <?php }else{ ?> 
                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/activate-faq'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i> <?php echo $language['Activate']; ?></a>
                                        <?php } ?>
                                        <a class="dropdown-item" href="<?php echo base_url('admin/edit-faq/'.$value->id); ?>"><i class="dw dw-edit2"></i> <?php echo $language['Edit']; ?></a>
                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-faq'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
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
                            <td colspan="5"><?php echo $language['No record found']; ?>.</td>
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