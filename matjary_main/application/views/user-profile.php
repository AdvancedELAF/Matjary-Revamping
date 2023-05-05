
<section class="">
    <div class="custom-container">
        <div class="user-sec-title">
            <h4><?php echo $this->lang->line('user-acc-txt-2'); ?></h4>
        </div>
        <div class="dash-wrap blue-bg">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active tab-active" id="nav-acc-tab" data-toggle="tab" href="#acc-details" role="tab" aria-controls="acc-details" aria-selected="true"><?php echo $this->lang->line('user-acc-txt-10'); ?></a>
                    <a class="nav-link" id="nav-pass-tab" data-toggle="tab" href="#nav-pass" role="tab" aria-controls="nav-pass" aria-selected="false"><?php echo $this->lang->line('user-acc-txt-26'); ?></a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="acc-details" role="tabpanel" aria-labelledby="nav-acc-tab">
                    <form method="POST" action="<?php echo base_url('update-user-profile-form'); ?>" name="update_user_profile_form" id="update_user_profile_form" enctype="multipart/form-data">

                        <h5 class="tab-title mt-3 mb-4"><?php echo $this->lang->line('user-acc-txt-11'); ?></h5>
                        <div class="form-section-title mt-3 mb-3">
                            <h4><?php echo $this->lang->line('user-acc-txt-12'); ?></h4>
                        </div>
                        <div class="form-row">

                            <div class="col-md-4 col-lg-4">
                                <!--<label class="control-label">First Name:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="text" name="fname" class="form-control" value="<?php echo isset($user_profile_details['fname'])?$user_profile_details['fname']:''; ?>" placeholder="<?php echo $this->lang->line('user-acc-txt-13'); ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <!--<label class="control-label">Last Name:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="text" name="lname" class="form-control" value="<?php echo isset($user_profile_details['lname'])?$user_profile_details['lname']:''; ?>" placeholder="<?php echo $this->lang->line('user-acc-txt-14'); ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <!--<label class="control-label">Email Id:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="email" name="email" class="form-control" value="<?php echo isset($user_profile_details['email'])?$user_profile_details['email']:''; ?>" placeholder="<?php echo $this->lang->line('user-acc-txt-15'); ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-6">
                                <div class="tab-form form-wrapper mb-3 d-none">
                                    <input type="text" class="form-control" value="Username" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 d-none">
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="email" class="form-control" placeholder="Invoice Email Address*">
                                </div>
                            </div>
                        </div>

                        <div class="form-section-title mt-3 mb-3">
                            <h4><?php echo $this->lang->line('user-acc-txt-16'); ?></h4>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-lg-3">
                                <!--<label class="control-label">Address:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="address" name="address" value="<?php echo $user_profile_details['address'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-17'); ?>">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <!--<label class="control-label">Country:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <select name="country" id="country_id" data-actionurl="<?php echo base_url(); ?>get-country-states" class="form-control valid">
                                        <option value=""><?php echo $this->lang->line('user-acc-txt-34'); ?></option>
                                        <?php foreach ($countries as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == '191') { ?> selected <?php } ?> ><?php echo $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <!--<label class="control-label">State:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <select name="state" id="state_id" data-actionurl="<?php echo base_url(); ?>get-state-cities" class="form-control">
                                        <option value=""><?php echo $this->lang->line('user-acc-txt-35'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg">
                                <!--<label class="control-label">City:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <select name="city" id="city_id" class="form-control">
                                        <option value=""><?php echo $this->lang->line('user-acc-txt-36'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg">
                                <!--<label class="control-label">Zipcode:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="text" minlength="5" maxlength="6" class="form-control numberonly" name="zipcode" value="<?php echo $user_profile_details['zipcode'] ?>" placeholder="<?php echo $this->lang->line('user-acc-txt-21'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-section-title mt-3 mb-3">
                            <h4><?php echo $this->lang->line('user-acc-txt-22'); ?></h4>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-lg-4">
                                <!--<label class="control-label">Contact:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="text" name="phone_no" minlength="9" maxlength="10" value="<?php echo $user_profile_details['phone_no'] ?>" class="form-control numberonly" placeholder="<?php echo $this->lang->line('user-acc-txt-23'); ?> *">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <!--<label class="control-label">Fax:</label>-->
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="text" name="fax_no" minlength="5" maxlength="6" value="<?php echo $user_profile_details['fax_no'] ?>" class="form-control numberonly" placeholder="<?php echo $this->lang->line('user-acc-txt-24'); ?>">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary brand-btn-pink mx-auto d-block"><?php echo $this->lang->line('user-acc-txt-25'); ?></button>
                    </form>
                </div>

                <div class="tab-pane fade" id="nav-pass" role="tabpanel" aria-labelledby="nav-pass-tab">
                    <form method="POST" action="<?php echo base_url('update-usr-pro-pass-frm'); ?>" name="update_usr_pro_pass_frm" id="update_usr_pro_pass_frm" enctype="multipart/form-data">
                        <h5 class="tab-title mt-3 mb-4"><?php echo $this->lang->line('user-acc-txt-27'); ?></h5>
                        <div class="form-row">
                            <div class="col-md-4 col-lg-4">
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="password" name="old_pass" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-28'); ?>">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="password" name="new_pass" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-29'); ?>">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <div class="tab-form form-wrapper mb-3">
                                    <input type="password" name="cnf_pass" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-30'); ?>">
                                </div>
                            </div>
                            <button class="btn btn-primary brand-btn-pink mx-auto d-block"><?php echo $this->lang->line('user-acc-txt-25'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
