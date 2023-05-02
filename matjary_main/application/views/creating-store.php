<?php $this->load->view("common/header.php"); ?>
<section>
    <div class="custom-container">
        <?php if ($pg_respMessage == "Authorised") { ?>
            <div class="pay-wrap blue-bg">
                <form action="<?php echo base_url('create-store'); ?>" name="create_store_form" id="create_store_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="create_store_tkn" id="create_store_tkn" value="<?php echo isset($form_token) ? $form_token : ''; ?>">
                    <input type="hidden" value="<?php echo $store_link; ?>" name="store_link" id="store_link">
                    <input type="hidden" value="<?php echo $template_id; ?>" name="template_id" id="template_id">
                    <input type="hidden" value="<?php echo $pg_respMessage; ?>" name="payment_response" id="payment_response">
                </form>
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                        <div class="icon-circle"></div>
                        <div class="icon-fix"></div>
                    </div>
                </div>
                <div class="store-icon d-none">
                    <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/store-icon.png">
                </div>
                <div class="payment-msg text-center">
                    <h4 id="payment_info_h4"><?php echo $this->lang->line('pay_success'); ?></h4>
                    <p id="payment_info_div"><?php echo $this->lang->line('process_req'); ?></p>
                </div>
                <div class="row matjary_loader_div text-center d-none">
                    <div class="col-md-12 ">
                        <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/loader/matjary-loader.gif"/>
                        <p class="progess_txt"><?php echo $this->lang->line('processing'); ?></p>
                    </div>
                </div>
                <div class="row matjary_store_result_div d-none">
                    <div class="col-md-6">
                        <div class="payment-wrapper">
                            <div class="payment-col-title">
                                <h4><?php echo $this->lang->line('pay_details'); ?></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><?php echo $this->lang->line('order_id'); ?></td>
                                            <td></td>
                                            <td>#<a href="#"><?php echo $order_id; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('trans_id'); ?></td>
                                            <td></td>
                                            <td>#<a href="#"><?php echo $tranRef; ?></a></td>
                                        </tr>
                                        <tr class="total-row">
                                            <td><?php echo $this->lang->line('user-acc-txt-40'); ?></td>
                                            <td></td>
                                            <td><?php echo $this->lang->line('SAR') . " " . $total_price; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-wrapper">
                            <div class="payment-col-title">
                                <h4><?php echo $this->lang->line('store_details'); ?></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><?php echo $this->lang->line('store_url'); ?></td>
                                            <td></td>
                                            <td><a target="_blank" href="<?php echo "https://" . $store_link; ?>"><?php echo $store_link; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('store_admin_url'); ?></td>
                                            <td></td>
                                            <td><a target="_blank" href="<?php echo "https://" . $store_admin_link; ?>"> <?php echo $store_admin_link; ?></a></td>
                                        </tr>
                                        <tr class="table-row-highlight">
                                            <td><?php echo $this->lang->line('store_un'); ?></td>
                                            <td></td>
                                            <td> <?php echo $email; ?></td>
                                        </tr>
                                        <tr class="table-row-highlight">
                                            <td><?php echo $this->lang->line('password'); ?></td>
                                            <td></td>
                                            <td><a target="_blank" href="<?php echo "https://" . $store_admin_link; ?>/user-reset-new-password/1"><?php echo $this->lang->line('set_admin_pass'); ?></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary brand-btn-pink d-none"><?php echo $this->lang->line('go_home_page'); ?></button>
                </div>
            </div>
        <?php }else{ ?>
            <div class="p-error-wrapper text-center">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/payment-error.png">
                <h2><?php echo $this->lang->line('pay_fail'); ?></h2>
                <h5><?php echo $this->lang->line('trans_id'); ?>: <?php echo isset($tranRef)?$tranRef:''; ?></h5>
                <h4><?php echo $info_msg; ?></h4>
                <h4><?php echo $this->lang->line('try_later'); ?></h4>
                <div class="d-flex justify-content-center mt-3">
                    <a href="<?php echo base_url(); ?>">
                        <button class="btn btn-primary brand-btn-pink"><?php echo $this->lang->line('go_home_page'); ?></button>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- Footer section  -->
<?php $this->load->view("common/footer.php"); ?>
<script>
    $(document).ready(function () {
        let store_link = $('#store_link').val();
        let template_id = $('#template_id').val();
        let payment_response = $('#payment_response').val();
        if (store_link != '' && template_id != '') {
            if (payment_response == 'Authorised') {
                $("#create_store_form").submit();
            } else {
                return false;
            }
        } else {
            swal({title: "Fail", text: 'Something went wrong, please do click below link to proceed!', type: "error"});
        }
    });
</script>