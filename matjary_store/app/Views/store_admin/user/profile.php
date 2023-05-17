<?php
$session = \Config\Services::session();
$ses_user_logged_in = $session->get('ses_user_logged_in');
$ses_user_name = $session->get('ses_user_name');
$ses_user_id = $session->get('ses_user_id');
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="title">
						<h4><?php echo $language['Profile']; ?></h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['navHome']; ?></a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $language['Profile']; ?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
				<div class="pd-20 card-box">
					<?php
					$attributes = ['name' => 'user_profile_picture', 'id' => 'user_profile_picture', 'autocomplete' => 'off',];
					echo form_open_multipart('admin/user-profile-picture', $attributes);
					?>
					<input type="hidden" name="user_id" value="<?php echo isset($loggedInUserData->user_id) ? $loggedInUserData->user_id : ''; ?>" />
					<div class="profile-photo">
						<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
						<?php if (isset($loggedInUserData->profile_image) && !empty($loggedInUserData->profile_image)) { ?>
							<a class="actionBtn text-danger profile-delete" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-user-profile-pic'); ?>" data-id="<?php echo $loggedInUserData->user_id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i></a>
						<?php } ?>
						<?php if (isset($loggedInUserData->profile_image) && !empty($loggedInUserData->profile_image)) { ?>
							<img src="<?php echo base_url('uploads/user_profile_picture/'); ?>/<?php echo isset($loggedInUserData->profile_image) ? $loggedInUserData->profile_image : ''; ?>" alt="Profile image" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
						<?php } else { ?>
							<img src="<?php echo base_url('store_admin/assets/images/profile_default_image.png'); ?>" alt="Profile image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
						<?php } ?>
						<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body pd-5">
										<div class="mb-2">
											<label><?php echo $language['Profile Picture']; ?></label>
											<input type="file" name="profile_image" id="profile_image" class="form-control">
										</div>
										<div class="col-md-6">

										</div>
									</div>
									<div class="modal-footer">
										<input type="submit" value="<?php echo $language['Update']; ?>" class="btn btn-primary">
										<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language['Close']; ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
					<h5 class="text-center h5 mb-0"><?php echo $ses_user_name; ?></h5>
					<p class="text-center text-muted font-14"><?php echo isset($loggedInUserData->role_name) ? $loggedInUserData->role_name : ''; ?></p>
					<div class="profile-info">
						<h5 class="mb-20 h5 text-blue"><?php echo $language['Contact Information']; ?></h5>
						<ul>
							<li>
								<span><?php echo $language['Email Address']; ?>:</span>
								<?php echo isset($loggedInUserData->email) ? $loggedInUserData->email : ''; ?>
							</li>
							<li>
								<span><?php echo $language['Phone Number']; ?>:</span>
								<?php echo isset($loggedInUserData->contact_no) ? $loggedInUserData->contact_no : ''; ?>
							</li>
							<li>
								<span><?php echo $language['Address']; ?>:</span>
								<?php echo isset($loggedInUserData->addr_permanent) ? $loggedInUserData->addr_permanent : ''; ?>
							</li>
						</ul>
					</div>
					<div class="profile-social">
						<h5 class="mb-20 h5 text-blue"><?php echo $language['Social Links']; ?></h5>
						<ul class="clearfix">
							<li><a <?php if(isset($loggedInUserData->social_fb_link) && !empty($loggedInUserData->social_fb_link)) { echo ' href="' . $loggedInUserData->social_fb_link . '" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"'; } else { 'href="#" '; } ?> class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
							<li><a <?php if(isset($loggedInUserData->social_twitter_link) && !empty($loggedInUserData->social_twitter_link)) { echo ' href="' . $loggedInUserData->social_twitter_link . '" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"'; } else { 'href="#" '; } ?> class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
							<li><a <?php if(isset($loggedInUserData->social_linkedin_link) && !empty($loggedInUserData->social_linkedin_link)) { echo ' href="' . $loggedInUserData->social_linkedin_link . '" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"'; } else { 'href="#" '; } ?> class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
							<li><a <?php if(isset($loggedInUserData->social_skype_link) && !empty($loggedInUserData->social_skype_link)) { echo ' href="' . $loggedInUserData->social_skype_link . '" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"'; } else { 'href="#" '; } ?> class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a></li>
						</ul>
					</div>
					<div class="profile-skills">
						<h5 class="mb-20 h5 text-blue"><?php echo $language['Role']; ?></h5>
						<h6 class="mb-5 font-14"><?php echo isset($loggedInUserData->role_name) ? $loggedInUserData->role_name : ''; ?></h6>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
				<div class="card-box overflow-hidden">
					<div class="profile-tab">
						<div class="tab">
							<ul class="nav nav-tabs customtab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#setting" role="tab"><?php echo $language['Basic Information']; ?></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#socialMediaLinks" role="tab"><?php echo $language['Social Media Links']; ?></a>
								</li>
							</ul>
							<?php
								$attributes = ['name' => 'update_user_profile_form', 'id' => 'update_user_profile_form',  'autocomplete' => 'off'];
								echo form_open_multipart('admin/update-user-profile-form', $attributes);
								?>
								<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
								<input type="hidden" name="user_id" value="<?php echo isset($ses_user_id) ? $ses_user_id : ''; ?>">
							<div class="tab-content">
								<!-- Setting Tab start -->								
								<div class="tab-pane fade show active" id="setting" role="tabpanel">									
									<div class="profile-setting">										
										<ul class="profile-edit-list">
											<li class="weight-500">
												<h4 class="text-blue h5 mb-20"><?php echo $language['Edit Your Personal Setting']; ?></h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Full Name']; ?></label>
															<p><?php echo isset($loggedInUserData->name) ? $loggedInUserData->name : ''; ?></p>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Role Name']; ?></label>
															<select class="form-control" name="role_id" id="role_id" disabled>
																<option value=""><?php echo $language['User Type']; ?></option>
																<?php
																if (isset($UserroleList) && !empty($UserroleList)) {
																	foreach ($UserroleList as $values) {
																		$selected = '';
																		if ($loggedInUserData->role_id == $values->id) {
																			$selected = 'selected';
																		}
																?>
																		<option value="<?= $values->id; ?>" <?php echo $selected; ?>><?= $values->role_name; ?></option>
																<?php
																	}
																}
																?>
															</select>
															
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Email']; ?></label>
															<p><?php echo isset($loggedInUserData->email) ? $loggedInUserData->email : ''; ?></p>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Date of birth']; ?></label>
															<input class="form-control" type="date" id="date_of_birth" name="date_of_birth" value="<?php echo isset($loggedInUserData->date_of_birth) ? $loggedInUserData->date_of_birth : ''; ?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label><?php echo $language['Gender']; ?></label>
															<div class="d-flex">
																<div class="mr-2">
																	<input type="radio" name="gender" value="1" data-error=".error2" <?php if ($loggedInUserData->gender == 1) {echo 'checked';} ?>> <?php echo $language['Male']; ?>
																</div>
																<div class="mr-2">
																	<input type="radio" name="gender" value="2" data-error=".error2" <?php if ($loggedInUserData->gender == 2) { } ?>> <?php echo $language['Female']; ?>
																</div>

																</br><span class="error2"></span>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Country']; ?></label>
															<select name="country_id" id="country_id" data-actionurl="<?php echo base_url('get-country-states'); ?>" class="form-control">
																<option value=""><?php echo $language['Select Country']; ?></option>
																<?php
																if (isset($countryList) && !empty($countryList)) {
																	foreach ($countryList as $countryData) {
																		$selected = "";
																		if (isset($loggedInUserData->country_id) && !empty($loggedInUserData->country_id)) {
																			if ($countryData->id == $loggedInUserData->country_id) {
																				$selected = "selected";
																			}
																		}
																?>
																		<option value="<?php echo isset($countryData->id) ? $countryData->id : ''; ?>" <?php echo $selected; ?>><?php echo isset($countryData->name) ? $countryData->name : ''; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['State']; ?></label>
															<select name="state_id" id="state_id" data-actionurl="<?php echo base_url('get-state-cities'); ?>" class="form-control">
																<option value=""><?php echo $language['Select State']; ?></option>
																<?php
																if (isset($stateList) && !empty($stateList)) {
																	foreach ($stateList as $stateData) {
																		$selected = "";
																		if (isset($loggedInUserData->state_id) && !empty($loggedInUserData->state_id)) {
																			if ($stateData->id == $loggedInUserData->state_id) {
																				$selected = "selected";
																			}
																		}
																?>
																		<option value="<?php echo isset($stateData->id) ? $stateData->id : ''; ?>" <?php echo $selected; ?>><?php echo isset($stateData->name) ? $stateData->name : ''; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['City']; ?></label>
															<select name="city_id" id="city_id" class="form-control">
																<option value=""><?php echo $language['Select City']; ?></option>
																<?php
																if (isset($cityList) && !empty($cityList)) {
																	foreach ($cityList as $cityData) {
																		$selected = "";
																		if (isset($loggedInUserData->city_id) && !empty($loggedInUserData->city_id)) {
																			if ($cityData->id == $loggedInUserData->city_id) {
																				$selected = "selected";
																			}
																		}
																?>
																		<option value="<?php echo isset($cityData->id) ? $cityData->id : ''; ?>" <?php echo $selected; ?>><?php echo isset($cityData->name) ? $cityData->name : ''; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Postal Code']; ?></label>
															<input class="form-control numberonly" type="text" id="zipcode" name="zipcode" value="<?php echo isset($loggedInUserData->zipcode) ? $loggedInUserData->zipcode : ''; ?>" minlength="5" maxlength="6">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Phone Number']; ?></label>
															<input class="form-control numberonly" type="text" id="contact_no" name="contact_no" value="<?php echo isset($loggedInUserData->contact_no) ? $loggedInUserData->contact_no : ''; ?>" minlength="9" maxlength="10">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?php echo $language['Address']; ?></label>
															<textarea class="form-control" id="addr_permanent" maxlength="52" name="addr_permanent"><?php echo isset($loggedInUserData->addr_permanent) ? $loggedInUserData->addr_permanent : ''; ?></textarea>
														</div>
													</div>
												</div>
											</li>
											<div class="form-group mb-0" style="text-align: center !important;">
												<button class="btn btn-primary" type="submit"><?php echo $language['Save & Update']; ?></button>
											</div>
										</ul>

										
									</div>
								</div>
								<!-- Setting Tab End -->
								<!-- SOCIAL MEDIA TAB STARTS -->
								<div class="tab-pane fade show" id="socialMediaLinks" role="tabpanel">
									<div class="profile-setting">
										<ul class="profile-edit-list">
											<li class="weight-500">
												<h4 class="text-blue h5 mb-20"><?php echo $language['Edit Social Media links']; ?></h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Facebook URL:</label>
															<input class="form-control form-control-lg" type="url" placeholder="<?php echo $language['Paste your link here']; ?>" id="social_fb_link" name="social_fb_link" value="<?php echo isset($loggedInUserData->social_fb_link) ? $loggedInUserData->social_fb_link : ''; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Twitter URL:</label>
															<input class="form-control form-control-lg" type="url" placeholder="<?php echo $language['Paste your link here']; ?>" id="social_twitter_link" name="social_twitter_link" value="<?php echo isset($loggedInUserData->social_twitter_link) ? $loggedInUserData->social_twitter_link : ''; ?>">
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Linkedin URL:</label>
															<input class="form-control form-control-lg" type="url" placeholder="<?php echo $language['Paste your link here']; ?>" id="social_linkedin_link" name="social_linkedin_link" value="<?php echo isset($loggedInUserData->social_linkedin_link) ? $loggedInUserData->social_linkedin_link : ''; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Skype URL:</label>
															<input class="form-control form-control-lg" type="url" placeholder="<?php echo $language['Paste your link here']; ?>" id="social_skype_link" name="social_skype_link" value="<?php echo isset($loggedInUserData->social_skype_link) ? $loggedInUserData->social_skype_link : ''; ?>">
														</div>
													</div>
												</div>
											</li>
											<div class="form-group mb-0" style="text-align: center !important">
												<button class="btn btn-primary" type="submit"><?php echo $language['Save & Update']; ?></button>
											</div>
										</ul>
									<?php echo form_close(); ?>
									</div>
								</div>
								<!-- SOCIAL MEDIA TAB ENDS -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endSection(); ?>