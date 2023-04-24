<?php $this->load->view("common/header.php"); ?>
<section>
    <form action="<?php echo base_url('proceed-template-payment'); ?>" name="proceed_template_payment_form" id="proceed_template_payment_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="plan_id" value="0">
        <input type="hidden" name="user_id" value="<?php echo isset($template_data['user_id']) ? $template_data['user_id'] : ''; ?>">
        <input type="hidden" name="template_cost" value="<?php echo isset($template_data['template_cost']) ? $template_data['template_cost'] : ''; ?>">
        <input type="hidden" name="template_id" value="<?php echo isset($template_data['template_id']) ? $template_data['template_id'] : ''; ?>">
        <input type="hidden" name="is_coupon_applied" id="is_coupon_applied" value="0">
        <input type="hidden" name="coupon_id" id="coupon_id" value="0">
        <input type="hidden" name="coupon_amount" id="coupon_amount" value="0">
        <div class="custom-container">
            <div class="billing-form-wrapper blue-bg">
                <h3><?php echo $this->lang->line('user-bill-txt-1'); ?></h3>
                <div class="form-wrapper">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="text" name="b_fname" id="b_fname" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-13'); ?>" value="<?php echo isset($loggedInUsrData['fname']) ? $loggedInUsrData['fname'] : ''; ?>">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="b_lname" id="b_lname" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-14'); ?>" value="<?php echo isset($loggedInUsrData['lname']) ? $loggedInUsrData['lname'] : ''; ?>">
                        </div>
                        <div class="col-md-4">
                            <input type="email" name="b_email" id="b_email" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-15'); ?>" value="<?php echo isset($loggedInUsrData['email']) ? $loggedInUsrData['email'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <input type="text" name="b_tel" id="b_tel" minlength="9" maxlength="10" class="form-control numberonly" placeholder="<?php echo $this->lang->line('user-acc-txt-22'); ?>" value="<?php echo $user_profile_details['phone_no'] ?>">
                        </div>

                        <div class="col-md-9 col-lg">
                            <input type="text" name="b_address" id="b_address" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-17'); ?>" value="<?php echo $user_profile_details['address'] ?>"z>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 col-lg">
                            <select name="b_country" id="country_id" data-actionurl="<?php echo base_url(); ?>get-country-states" class="form-control valid">
                                <option value=""><?php echo $this->lang->line('user-acc-txt-34'); ?></option>
                                <?php foreach ($countries as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == '191') { ?> selected <?php } ?> ><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg">
                            <select name="b_state" id="state_id" data-actionurl="<?php echo base_url(); ?>get-state-cities" class="form-control">
                                <option value=""><?php echo $this->lang->line('user-acc-txt-35'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 col-lg">
                            <select name="b_city" id="city_id" class="form-control">
                                <option value=""><?php echo $this->lang->line('user-acc-txt-36'); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg">
                            <input type="text" name="b_zipcode" id="b_zipcode" min="5" maxlength="6" class="form-control numberonly" placeholder="<?php echo $this->lang->line('user-acc-txt-21'); ?> *" value="<?php echo $user_profile_details['zipcode'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="billing-table-wrapper">
                        <div class="table-title">
                            <h4><?php echo $this->lang->line('user-bill-txt-2'); ?></h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead billing-thead">
                                    <tr>
                                        <th scope="col">Template Name</th>
                                        <th scope="col"></th>
                                        <th scope="col"><?php echo $this->lang->line('user-acc-txt-39'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php 
                                                $template_name = '';
                                                if($site_lang=='en'){
                                                    if(isset($template_data['name']) && !empty($template_data['name'])){
                                                        $template_name = $template_data['name'];
                                                    }else{
                                                        $template_name = $template_data['name_ar'];
                                                    }
                                                }else{
                                                    if(isset($template_data['name_ar']) && !empty($template_data['name_ar'])){
                                                        $template_name = $template_data['name_ar'];
                                                    }else{
                                                        $template_name = $template_data['name'];
                                                    }
                                                }
                                                echo $template_name; 
                                            ?> 
                                                (<a target="_blank" href="<?php echo $template_data['demo_link']; ?>" >Demo Link</a>)
                                        </td>
                                        <td><?php echo $this->lang->line('SAR'); ?> <?php echo isset($template_data['template_cost']) ? number_format((float)$template_data['template_cost'], 2, '.', '') : ''; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('subtotal'); ?></td>
                                        <td><?php echo $this->lang->line('SAR'); ?> <span id="plan_subtotal"><?php echo isset($template_data['template_cost']) ? number_format((float)$template_data['template_cost'], 2, '.', '') : ''; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('discount'); ?></td>
                                        <td><?php echo $this->lang->line('SAR'); ?> <span id="discount_span">0.00</span></td>
                                    </tr>
                                    <tr class="total-row">
                                        <td><?php echo $this->lang->line('user-acc-txt-40'); ?></td>
                                        <td>
                                            <?php echo $this->lang->line('SAR'); ?> <span id="plan_total_price_span"> <?php echo isset($template_data['template_cost']) ? number_format((float)$template_data['template_cost'], 2, '.', '') : ''; ?></span>
                                            <input type="hidden" name="plan_total_price" id="plan_total_price" value="<?php echo isset($template_data['template_cost']) ? number_format((float)$template_data['template_cost'], 2, '.', '') : ''; ?>">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- <div class="form-wrapper d-none">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <input type="text" name="coupon_code" class="form-control mb-2 coupon-field" placeholder="<?php echo $this->lang->line('user-bill-txt-5'); ?>">
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary brand-btn-pink pl-4 pr-4 align-mid"><?php echo $this->lang->line('apply'); ?></button>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary brand-btn-purple pl-4 pr-4 align-mid"><?php echo $this->lang->line('remove'); ?></button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="billing-table-wrapper">
                        <div class="payment-title">
                            <h4>Apply Coupon</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="coupon_code" id="coupon_code" minlength="1" maxlength="10" data-userid="<?php echo isset($template_data['user_id']) ? $template_data['user_id'] : ''; ?>" class="form-control mb-2 coupon-field nospecialchars" placeholder="<?php echo $this->lang->line('user-bill-txt-5'); ?>">
                                <span id="couponMsg"></span>
                            </div>
                            <div class="col-lg-3">
                                <a href="javascript:void(0);" id="applyCouponCodeBtn" data-userid="<?php echo isset($template_data['user_id']) ? $template_data['user_id'] : ''; ?>" class="btn btn-primary brand-btn-pink pl-4 pr-4 align-mid"><?php echo $this->lang->line('apply'); ?></a>
                            </div>
                            <div class="col-lg-3">
                                <a  href="javascript:void(0);" id="removeCouponCodeBtn" class="btn btn-primary brand-btn-purple pl-4 pr-4 align-mid"><?php echo $this->lang->line('remove'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary brand-btn-pink pl-4 pr-4 align-mid" type="submit" name="proceed"><?php echo $this->lang->line('user-bill-txt-6'); ?></button>
                </div>
            </div>
        </div>
    </form>
</section>

<!-- Footer section  -->
<?php $this->load->view("common/footer.php"); ?>
<script>
    $(document).ready(function () {
        $("#country_id").trigger('change');
    });
</script>