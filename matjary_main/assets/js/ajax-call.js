let base_url = window.location.origin;
if (base_url == "http://localhost") {
	base_url = "/Matjary-Revamping/matjary_main";
} else {
	base_url;
}

$(document).ready(function () {
	let loader_cir = base_url + "/assets/images/loader/matjary-loader-circle.gif";

	let current_lang = $("html")[0].lang;
	let SAR = "";
	let processing = "";
	let conf_proceed = "";
	let conf_creat_store = "";
	let try_new_domain = "";
	let swalCancel = "";
	let info_msg1 = "";
	let info_msg2 = "";
	let info_msg3 = "";
	let info_msg4 = "";
	let coupon_msg1 = "";
	let coupon_msg2 = "";

	if (current_lang == "en") {
		SAR = "SAR";
		processing = "Processing...";
		conf_proceed = "Confirm To Proceed";
		conf_creat_store = "Confirm To Create Store";
		try_new_domain = "Domain Not Avilable, Please Try Changing Store Name";
		swalCancel = "Cancel";
		info_msg1 = "Kindly Hold While We Process Your Request...";
		info_msg2 = "We are setting up your store...";
		info_msg3 = "Making Final Touchups to store... kindly hold...";
		info_msg4 = "Store Created Succesfully";
		coupon_msg1 = "Coupon Code Required";
		coupon_msg2 = "Coupon Applied Successfully";
	} else {
		SAR = "ر. س";
		processing = "يعالج...";
		conf_proceed = "أكد للمتابعة";
		conf_creat_store = "أكد لإنشاء متجر";
		try_new_domain = "المجال غير متوفر ، يرجى محاولة تغيير اسم المتجر";
		swalCancel = "إلغاء";
		info_msg1 = "يرجى الانتظار بينما يتم معالجة طلبك...";
		info_msg2 = "أنشأنا متجرك ...";
		info_msg3 = "قم بعمل اللمسات الأخيرة على المحل";
		info_msg4 = "تم إنشاء المتجر بنجاح";
		coupon_msg1 = "كود الكوبون مطلوب";
		coupon_msg2 = "تم تطبيق القسيمة بنجاح";
	}

	/* main js file code moved here /+/*/
	$(window).scroll(function () {
		var sticky = $(".navbar");
		scroll = $(window).scrollTop();
		if (scroll >= 10) {
			sticky.addClass("nav-scroll-spacing");
		} else {
			sticky.removeClass("nav-scroll-spacing");
		}
	});

	$(".switcher").click(function () {
		if (this.checked) {
			$("#plan_months").val(12);
			$("#pricing_div_1").removeClass("d-none");
			$("#pricing_div_2").removeClass("d-none");
			$("#pricing_div_3").removeClass("d-none");
			$("#pricing_div_4").addClass("d-none");
			$("#pricing_div_5").addClass("d-none");
			$("#pricing_div_6").addClass("d-none");
		} else {
			$("#plan_months").val(1);
			$("#pricing_div_1").addClass("d-none");
			$("#pricing_div_2").addClass("d-none");
			$("#pricing_div_3").addClass("d-none");
			$("#pricing_div_4").removeClass("d-none");
			$("#pricing_div_5").removeClass("d-none");
			$("#pricing_div_6").removeClass("d-none");
		}
	});
	/* main js file code moved here /-/*/

	$(".numberonly").keypress(function (e) {
		var charCode = e.which ? e.which : event.keyCode;
		if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
	});

	$(".language_switch_btn").click(function (e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: base_url + "/lang_switch",
			data: "requestedLanguage=" + current_lang,
			cache: false,
			context: document.body,
			success: function () {
				var language = 'ar';
				if (current_lang == 'ar') {
					language = 'en';
				} else if (current_lang == 'en') {
					language = 'ar';
				}
				
				/* setting cookie for 1 month, after one month it'll be expired automatically */
				document.cookie = "site_lang="+language+"; max-age="+60*60*24*30;
				if(document.cookie){ /* if cookie is set */
				  	/* alert('cookie is set'); */
				}else{ /* if cookie not set then alert an error */
				  alert((current_lang == "en") ?"لا يمكن تعيين ملف تعريف الارتباط! يرجى إلغاء حظر هذا الموقع من إعداد ملفات تعريف الارتباط في متصفحك.":"Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
				}
				location.reload();
			},
			error: function (exception) {
				alert("Exeption:" + exception);
			},
		});
	});

	/*//submit save user form*/
	$("#save_user_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#save_user_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			$("#preloader").show();
			var form = $("#save_user_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#save_user_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#preloader").hide();
						swal(
							{ title: "Success", text: resp.responseMessage, type: "success" },
							function () {
								window.location.href = resp.redirectUrl;
							}
						);
					} else {
						$("#preloader").hide();
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	/* //submit user login form */
	$("#user_login_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#user_login_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			$("#preloader").show();
			var form = $("#user_login_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#user_login_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#preloader").hide();
						setTimeout(function () {
							$("#loginSuccessModal").modal("hide");
							window.location.href = resp.redirectUrl;
						}, 4000);
						$("#loginSuccessModal").modal("show");
					} else {
						$("#preloader").hide();
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	$(document).on("click", ".tplBtn", function () {
		let tplid = $(this).data("tplid");
		let tplprice = $(this).data("tplprice");
		$("#chooseDomainModal").find("#template_id").val(tplid);
		$("#chooseDomainModal").find("#template_price").val(tplprice);

		const sub_domain_name = document.getElementById("sub_domain_name");
		if (sub_domain_name !== null) {
			sub_domain_name.onpaste = (e) => e.preventDefault();
		}
	});

	$(".nospecialchars").on("keypress", function (event) {
		var regex = new RegExp("^[a-zA-Z0-9]+$");
		var key = String.fromCharCode(
			!event.charCode ? event.which : event.charCode
		);
		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	});

	/* //check domain availablity  */
	$("#isThisSubdomainAvailable").click(function () {
		let sub_domain_name = $("#sub_domain_name").val();
		var action_page = $(this).data("actionurl");
		let requestData = "sub_domain_name=" + sub_domain_name;
		$.ajax({
			url: action_page,
			type: "POST",
			data: requestData,
			success: function (resp) {
				resp = JSON.parse(resp);
				if (resp.responseCode == 200) {
					$("#isThisSubdomainAvailableMessage").html(
						'<span style="color:green;">' + resp.responseMessage + "</span>"
					);
					$("#subDomainAvailSbtBtn").attr("disabled", false);
				} else {
					$("#isThisSubdomainAvailableMessage").html(
						'<span style="color:red;">' + resp.responseMessage + "</span>"
					);
					$("#subDomainAvailSbtBtn").attr("disabled", true);
				}
			},
		});
	});

	$("#subDomainAvailSbtBtn").click(function () {
		let sub_domain_name = $("#sub_domain_name").val();
		let action_page = $(this).data("action");
		let requestData = "sub_domain_name=" + sub_domain_name;
		$("#isThisSubdomainAvailableMessage").html("");
		$.ajax({
			url: action_page,
			type: "POST",
			data: requestData,
			beforeSend: function () {
				$(`<img src='${loader_cir}'>`).appendTo(
					"#isThisSubdomainAvailableMessage"
				);
			},
			success: function (resp) {
				resp = JSON.parse(resp);
				if (resp.responseCode == 200) {
					$("#subDomainAvailSbtBtn").text(processing);
					$("#subDomainAvailSbtBtn").attr("disabled", true);
					$("#isThisSubdomainAvailableMessage").html("");
					swal(
						{
							title: "",
							text:
								"<strong>" +
								sub_domain_name +
								'</strong> <br/><br/> <span style="color:green;">' +
								resp.responseMessage +
								"</span>",
							type: "info",
							showCancelButton: true,
							confirmButtonColor: "#cc3f44",
							confirmButtonText: conf_proceed,
							cancelButtonText: swalCancel,
							closeOnConfirm: false,
							html: true,
						},
						function (isConfirm) {
							if (isConfirm) {
								$("#save_user_plan_form").submit();
							}
							return false;
						}
					);
					$("#subDomainAvailSbtBtn").text("Proceed");
					$("#subDomainAvailSbtBtn").attr("disabled", false);
				} else {
					$("#isThisSubdomainAvailableMessage").html(
						'<span style="color:red;">' + resp.responseMessage + "</span>"
					);
					return false;
				}
			},
		});
	});

	/* submit save user form*/
	$("#update_user_profile_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#update_user_profile_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			$("#preloader").show();
			var form = $("#update_user_profile_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#update_user_profile_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#preloader").hide();
						swal(
							{ title: "Success", text: resp.responseMessage, type: "success" },
							function () {
								window.location.reload();
							}
						);
					} else {
						$("#preloader").hide();
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	/* change password from user profile */
	$("#update_usr_pro_pass_frm").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#update_usr_pro_pass_frm").valid();
		if (!isvalidate) {
			return false;
		} else {
			$("#preloader").show();
			var form = $("#update_usr_pro_pass_frm")[0];
			var requestData = new FormData(form);
			var action_page = $("#update_usr_pro_pass_frm").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#preloader").hide();
						swal(
							{ title: "Success", text: resp.responseMessage, type: "success" },
							function () {
								window.location.reload();
							}
						);
					} else {
						$("#preloader").hide();
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	/* //submit proceed payment form */
	$("#proceed_payment_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#proceed_payment_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			/*$("#preloader").show();*/
			var form = $("#proceed_payment_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#proceed_payment_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					$("#proceedToPaymentBtn").prop("disabled", true);
					swal({
						title: "",
						text: info_msg1,
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
						timer: 3000,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						/*$("#preloader").hide();*/
						window.location.href = resp.redirectUrl;
					} else {
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	/* create store api ajax call */
	$("#create_store_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#create_store_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			var form = $("#create_store_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#create_store_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					$(".matjary_loader_div").removeClass("d-none");
					$(".progess_txt").text(info_msg2);
				},
				success: function (resp) {
					var resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$(".progess_txt").html(info_msg3);
						setTimeout(function () {
							$("#payment_info_h4").html(info_msg4);
							$("#payment_info_div").html("");
							$(".matjary_loader_div").addClass("d-none");
							$(".matjary_store_result_div").removeClass("d-none");
							$(".success-checkmark").addClass("d-none");
							$(".store-icon").removeClass("d-none");
						}, 10000);
					} else {
						swal(
							{
								title: "Fail",
								closeOnClickOutside: false,
								text: resp.responseMessage,
								type: "error",
							},
							function () {
								alert(
									"Please Try different Domain/Sub-Domain Name for Your Store"
								);
								window.location.href = base_url;
							}
						);
						$(".matjary_loader_div").addClass("d-none");
					}
				},
			});
			//$("#payment_response").val('');
		}
	});

	/* contact form */
	$("#submit_contact_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#submit_contact_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			var form = $("#submit_contact_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#submit_contact_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					swal({
						title: "",
						text: processing,
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
						timer: 3000,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						swal({
							title: "Success",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "success",
						});
					} else {
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
					$("#submit_contact_form")[0].reset();
				},
			});
		}
	});

	/* free trail form validation start */
	$("#free_trial_form").on("submit", function (e) {
		e.preventDefault();
		var free_trial_1_0 = $("#free_trial_domain").data("token");
		var sub_domain_name = $("#free_trial_domain").val();

		var isvalidate = $("#free_trial_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			$("#preloader").show();
			var form = $("#free_trial_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#free_trial_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					swal({
						title: "",
						text: processing,
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#preloader").hide();
						if (!free_trial_1_0) {
							setTimeout(function () {
								swal(
									{ title: "", text: resp.responseMessage, type: "success" },
									function () {
										window.location.href = resp.redirectUrl;
									}
								);
							}, 2000);
						} else {
							/* free trial form submit start */
							swal(
								{
									title: "",
									text:
										"<strong>" +
										sub_domain_name +
										'</strong> <br/><br/> <span style="color:green;">' +
										resp.responseMessage +
										"</span>",
									type: "info",
									showCancelButton: true,
									confirmButtonColor: "#cc3f44",
									confirmButtonText: conf_proceed,
									cancelButtonText: swalCancel,
									closeOnConfirm: false,
									html: true,
								},
								function (isConfirm) {
									if (isConfirm) {
										$.ajax({
											url: base_url + "/create-free-store",
											type: "POST",
											data: {
												sub_domain_name: sub_domain_name,
											},
											beforeSend: function () {
												swal({
													title: "",
													text: processing,
													imageUrl:
														base_url +
														"/assets/images/loader/matjary-loader.gif",
													buttons: false,
													closeOnClickOutside: false,
													timer: 3000,
													showConfirmButton: false,
												});
											},
											success: function (resp_temp) {
												setTimeout(function () {
													swal.close();
													resp_temp_1 = JSON.parse(resp_temp);
													if (resp_temp_1.responseCode == 200) {
														window.location.href = resp_temp_1.redirectUrl;
													}
												}, 2000);
											},
										});
									} else {
										return false;
									}
								}
							);
							/* free trial form submit start */
						}
					} else {
						$("#preloader").hide();
						swal({ title: "", text: resp.responseMessage, type: "error" });
					}
				},
			});
		}
	});
	/* free trail form validation end */

	/* reset password request form start */
	$("#send_reset_password_link").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#send_reset_password_link").valid();
		if (!isvalidate) {
			return false;
		} else {
			var form = $("#send_reset_password_link")[0];
			var requestData = new FormData(form);
			var action_page = $("#send_reset_password_link").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					swal({
						title: "",
						text: processing,
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					setTimeout(function () {
						if (resp.responseCode == 200) {
							$("#reset-pwd-btn").attr("disabled", "disabled");
							swal({ title: "", text: resp.responseMessage, type: "success" });
							$("#send_reset_password_link")[0].reset();
						} else {
							swal({ title: "", text: resp.responseMessage, type: "error" });
						}
					}, 1000);
				},
			});
		}
	});
	/* reset password request form end */

	/* set password form start */
	$("#set_usr_reset_password").on("submit", function (e) {
		$("#Reset_Pwd_Message").html("");
		let pwd_tkn = $("#cnf_new_rst_pwd").data("tnk");
		e.preventDefault();
		var isvalidate = $("#set_usr_reset_password").valid();
		if (!isvalidate) {
			return false;
		} else {
			var form = $("#set_usr_reset_password")[0];

			var requestData = new FormData(form);
			requestData.append("pwd_tkn", pwd_tkn);

			var action_page = $("#set_usr_reset_password").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					$(`<img src='${loader_cir}'>`).appendTo("#Reset_Pwd_Message");
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					setTimeout(function () {
						if (resp.responseCode == 200) {
							$("#forgot-pwd-btn").attr("disabled", "disabled");
							$("#Reset_Pwd_Message").html(
								'<div class="alert alert-success text-center" role="alert">' +
									resp.responseMessage +
									"</div>"
							);
							$("#set_usr_reset_password")[0].reset();
						} else {
							$("#Reset_Pwd_Message").html(
								'<div class="alert alert-danger text-center" role="alert">' +
									resp.responseMessage +
									"</div>"
							);
						}
					}, 2000);
				},
			});
		}
	});
	/* set password form start */

	/* //get invoice info  */
	$(".userPurchaseInvoice").click(function (event) {
		event.preventDefault();
		let invoiceid = $(this).data("invoiceid");
		let action_page = $(this).data("actionurl");
		let requestData = { invoiceid: invoiceid };
		$.ajax({
			type: "post",
			url: action_page,
			data: requestData,
			success: function (resp) {
				resp = JSON.parse(resp);
				console.log(resp);
				if (resp.responseCode == 200) {
					$("#invoiceInfoModal").modal("show");
					let user_name =
						resp.responseData.bill_info_address.b_fname +
						" " +
						resp.responseData.bill_info_address.b_lname;
					let total_price = resp.responseData.total_price;
					let tran_ref = resp.responseData.tranRef;
					let created_at = resp.responseData.created_at;
					let client_address =
						resp.responseData.bill_info_address.b_address + ", <br>";
					client_address +=
						resp.responseData.bill_info_address.b_city_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_state_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_country_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_zipcode + ". <br>";
					client_address +=
						resp.responseData.bill_info_address.b_tel + ", <br>";
					client_address +=
						'<a href="javascript:void(0);">' +
						resp.responseData.bill_info_address.b_email +
						"</a>";
					let plan_id = resp.responseData.plan_id;
					let months_days_validity = "Months";
					if (plan_id == 7) {
						months_days_validity = "Days";
					}
					let plan_cost = resp.responseData.plan_cost;
					let plan_name = resp.responseData.plan_name;
					let validity_in_months = resp.responseData.validity_in_months;
					let template_name = resp.responseData.template_name;
					let template_cost = resp.responseData.template_cost;
					let store_name = resp.responseData.store_sub_domain;
					let store_link = resp.responseData.store_link;
					let store_admin_link = resp.responseData.store_admin_link;

					$("#invoiceInfoModal").find("#user_name").text(user_name);
					$("#invoiceInfoModal").find("#invoice_amount").text(total_price);
					$("#invoiceInfoModal").find("#tran_ref").text(tran_ref);
					$("#invoiceInfoModal").find("#created_at").text(created_at);
					$("#invoiceInfoModal").find("#client_name").text(user_name);
					$("#invoiceInfoModal").find("#client_address").html(client_address);
					$("#invoiceInfoModal")
						.find("#months_days_validity")
						.text(months_days_validity);
					$("#invoiceInfoModal").find("#plan_name").text(plan_name);
					$("#invoiceInfoModal")
						.find("#validity_in_months")
						.text(validity_in_months);
					$("#invoiceInfoModal")
						.find("#plan_cost")
						.text(SAR + " " + plan_cost);
					$("#invoiceInfoModal").find("#template_name").text(template_name);
					$("#invoiceInfoModal")
						.find("#template_cost")
						.text(SAR + " " + template_cost);

					let subtotal = parseFloat(plan_cost) + parseFloat(template_cost);
					$("#invoiceInfoModal")
						.find("#subtotal")
						.text(SAR + " " + subtotal);
					if (resp.responseData.is_coupon_applied == 1) {
						$("#invoiceInfoModal").find("#coupon_code_div").show();
						$("#invoiceInfoModal")
							.find("#coupon_code")
							.text(resp.responseData.coupon_code);
						$("#invoiceInfoModal").find("#coupon_discount_div").show();
						$("#invoiceInfoModal")
							.find("#coupon_discount")
							.text(resp.responseData.coupon_discount_percent);
						$("#invoiceInfoModal").find("#coupon_amount_div").show();
						$("#invoiceInfoModal")
							.find("#coupon_amount")
							.text(SAR + " " + resp.responseData.coupon_amount);
						total_price =
							parseFloat(subtotal) -
							parseFloat(resp.responseData.coupon_amount);
					} else {
						$("#invoiceInfoModal").find("#coupon_code").text("");
						$("#invoiceInfoModal").find("#coupon_code_div").hide();
						$("#invoiceInfoModal").find("#coupon_discount").text("0");
						$("#invoiceInfoModal").find("#coupon_discount_div").hide();
						$("#invoiceInfoModal").find("#coupon_amount").text("0.00");
						$("#invoiceInfoModal").find("#coupon_amount_div").hide();
						total_price =
							parseFloat(subtotal) -
							parseFloat(resp.responseData.coupon_amount);
					}
					$("#invoiceInfoModal")
						.find("#grand_total")
						.text(SAR + " " + total_price);

					$("#invoiceInfoModal").find("#store_name").text(store_name);
					$("#invoiceInfoModal")
						.find("#store_link")
						.html(
							'<a href="' +
								store_link +
								'" targate="_blank">' +
								store_link +
								"</a>"
						);
					$("#invoiceInfoModal")
						.find("#store_admin_link")
						.html(
							'<a href="' +
								store_admin_link +
								'" targate="_blank">' +
								store_admin_link +
								"</a>"
						);
				} else {
					alert(resp.responseMessage);
				}
			},
		});
	});

	$(".userPurchasedTemplateInvoice").click(function (event) {
		event.preventDefault();
		let invoiceid = $(this).data("invoiceid");
		let action_page = $(this).data("actionurl");
		let requestData = { invoiceid: invoiceid };
		$.ajax({
			type: "post",
			url: action_page,
			data: requestData,
			success: function (resp) {
				resp = JSON.parse(resp);
				console.log(resp);
				if (resp.responseCode == 200) {
					$("#userPurchasedTemplateInvoiceInfoModal").modal("show");
					let user_name =
						resp.responseData.bill_info_address.b_fname +
						" " +
						resp.responseData.bill_info_address.b_lname;
					let template_cost = resp.responseData.template_cost;
					let subtotal = resp.responseData.template_cost;
					let total_price = resp.responseData.total_price;
					let tran_ref = resp.responseData.tranRef;
					let created_at = resp.responseData.created_at;
					let client_address =
						resp.responseData.bill_info_address.b_address + ", <br>";
					client_address +=
						resp.responseData.bill_info_address.b_city_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_state_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_country_name + ", ";
					client_address +=
						resp.responseData.bill_info_address.b_zipcode + ". <br>";
					client_address +=
						resp.responseData.bill_info_address.b_tel + ", <br>";
					client_address +=
						'<a href="javascript:void(0);">' +
						resp.responseData.bill_info_address.b_email +
						"</a>";
					let template_name = resp.responseData.template_name;

					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#user_name")
						.text(user_name);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#invoice_amount")
						.text(total_price);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#tran_ref")
						.text(tran_ref);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#created_at")
						.text(created_at);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#client_name")
						.text(user_name);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#client_address")
						.html(client_address);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#theme_name")
						.html(template_name);
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#subtotal")
						.text(SAR + " " + subtotal);

					if (resp.responseData.is_coupon_applied == 1) {
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find(".coupon_div")
							.show();
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_code")
							.text(resp.responseData.coupon_code);
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_discount")
							.text(resp.responseData.coupon_discount_percent);
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_amount")
							.text(SAR + " " + resp.responseData.coupon_amount);
						total_price =
							parseFloat(subtotal) -
							parseFloat(resp.responseData.coupon_amount);
					} else {
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find(".coupon_div")
							.hide();
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_code")
							.text("");
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_discount")
							.text("0%");
						$("#userPurchasedTemplateInvoiceInfoModal")
							.find("#coupon_amount")
							.text("0.00");
						total_price =
							parseFloat(subtotal) -
							parseFloat(resp.responseData.coupon_amount);
					}
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#grand_total")
						.text(SAR + " " + total_price);
					/*
					$("#userPurchasedTemplateInvoiceInfoModal")
						.find("#grand_total")
						.text(SAR + " " + template_cost);
                        */
				} else {
					alert(resp.responseMessage);
				}
			},
		});
	});
	/* //get invoice info  */

	/* save newsletter email form start */
	$("#save_newsletter_email_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#save_newsletter_email_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			var form = $("#save_newsletter_email_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#save_newsletter_email_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				enctype: "multipart/form-data",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					$(`<img src='${loader_cir}'>`).appendTo("#newsletter_msgs");
				},
				success: function (resp) {
					$("#newsletter_msgs").fadeIn();
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						$("#newsletter_msgs").html(
							'<div class="alert alert-success text-center" role="alert">' +
								resp.responseMessage +
								"</div>"
						);
						$("#save_newsletter_email_form")[0].reset();
					} else {
						$("#newsletter_msgs").html(
							'<div class="alert alert-danger text-center" role="alert">' +
								resp.responseMessage +
								"</div>"
						);
					}
					$("#newsletter_msgs").fadeOut(8000);
				},
			});
		}
	});

	/* Payment form for themepurchse */
	$("#proceed_template_payment_form").on("submit", function (e) {
		e.preventDefault();
		var isvalidate = $("#proceed_template_payment_form").valid();
		if (!isvalidate) {
			return false;
		} else {
			/*$("#preloader").show();*/
			var form = $("#proceed_template_payment_form")[0];
			var requestData = new FormData(form);
			var action_page = $("#proceed_template_payment_form").attr("action");
			$.ajax({
				url: action_page,
				type: "POST",
				data: requestData,
				contentType: false,
				cache: false,
				processData: false,
				timeout: 600000,
				beforeSend: function () {
					swal({
						title: "",
						text: info_msg1,
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
						timer: 3000,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						/*$("#preloader").hide();*/
						window.location.href = resp.redirectUrl;
						/*
                         swal({title: "Info", text: resp.responseMessage, type: "info", timer: 3000},
                         function () {
                         window.location.href = resp.redirectUrl;
                         }
                         );
                         */
					} else {
						swal({
							title: "Fail",
							closeOnClickOutside: false,
							text: resp.responseMessage,
							type: "error",
						});
					}
				},
			});
		}
	});

	$("#check_template_purchased").click(function (event) {
		event.preventDefault();
		let template_id = $(this).data("tmplid");
		let user_id = $(this).data("userid");
		$.ajax({
			url: base_url + "/check-template-purchased",
			type: "POST",
			data: {
				template_id: template_id,
				user_id: user_id,
			},
			beforeSend: function () {
				swal({
					title: "",
					imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
					buttons: false,
					closeOnClickOutside: false,
					showConfirmButton: false,
				});
			},
			success: function (resp) {
				resp = JSON.parse(resp);
				if (resp.responseCode == 404) {
					var actionurl = $(this).attr("href");
					window.location = $("#check_template_purchased").attr("href");
				} else {
					swal({
						title: "",
						html: true,
						closeOnClickOutside: false,
						text: resp.responseMessage,
						type: "info",
					});
					return false;
				}
			},
		});
	});

	$("#removeCouponCodeBtn").click(function (event) {
		event.preventDefault();
		$("#is_coupon_applied").val(0);
		$("#coupon_id").val(0);
		$("#coupon_amount").val("0.00");
		$("#discount_span").text("0.00");
		var plan_total_price = $("#plan_subtotal").text();
		$("#plan_total_price").val(plan_total_price);
		$("#plan_total_price_span").text(plan_total_price);
		$("#coupon_code").val("");
		$("#couponMsg").text("");

		$("#proceedToPaymentBtn").prop("disabled", false);
	});

	$("#applyCouponCodeBtn").click(function (event) {
		event.preventDefault();
		let user_id = $(this).data("userid");
		let coupon_code = $("#coupon_code").val();
		if (coupon_code.length == 0 && coupon_code == "") {
			$("#couponMsg").text(coupon_msg1);
			$("#couponMsg").css("color", "red");
			return false;
		} else {
			$.ajax({
				url: base_url + "/check-coupon-valid",
				type: "POST",
				data: {
					user_id: user_id,
					coupon_code: coupon_code,
				},
				beforeSend: function () {
					swal({
						title: "",
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
						showConfirmButton: false,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						swal.close();

						var couponData = resp.responseData;

						var is_coupon_applied = $("#is_coupon_applied").val();
						if (is_coupon_applied == 0) {
							$("#is_coupon_applied").val(1);
							$("#coupon_id").val(couponData.id);

							var plan_total_price = $("#plan_total_price").val();
							var coupon_amount =
								(parseFloat(plan_total_price) *
									parseInt(couponData.discount_in_percent)) /
								100;

							$("#coupon_amount").val(coupon_amount);
							$("#discount_span").text(coupon_amount);

							var updated_plan_total_price =
								parseFloat(plan_total_price) - parseFloat(coupon_amount);
							$("#plan_total_price").val(updated_plan_total_price);
							$("#plan_total_price_span").text(updated_plan_total_price);

							$("#couponMsg").text(coupon_msg2);
							$("#couponMsg").css("color", "green");
						}

						$("#proceedToPaymentBtn").prop("disabled", false);
					} else {
						swal.close();
						$("#is_coupon_applied").val(0);
						$("#coupon_id").val(0);
						$("#coupon_amount").val("0.00");
						$("#discount_span").text("0.00");
						var plan_total_price = $("#plan_subtotal").text();
						$("#plan_total_price").val(plan_total_price);
						$("#plan_total_price_span").text(plan_total_price);

						$("#couponMsg").text(resp.responseMessage);
						$("#couponMsg").css("color", "red");

						/* disable payment proceed button till coupon code is not valid or keep empty*/
						$("#proceedToPaymentBtn").prop("disabled", true);

						return false;
					}
				},
			});
		}
	});

	$("#coupon_code").focusout(function (event) {
		event.preventDefault();
		let user_id = $(this).data("userid");
		let coupon_code = $(this).val();
		if (coupon_code.length > 0 && coupon_code != "") {
			$.ajax({
				url: base_url + "/check-coupon-valid",
				type: "POST",
				data: {
					user_id: user_id,
					coupon_code: coupon_code,
				},
				beforeSend: function () {
					swal({
						title: "",
						imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
						buttons: false,
						closeOnClickOutside: false,
						showConfirmButton: false,
					});
				},
				success: function (resp) {
					resp = JSON.parse(resp);
					if (resp.responseCode == 200) {
						swal.close();

						var couponData = resp.responseData;

						var is_coupon_applied = $("#is_coupon_applied").val();
						if (is_coupon_applied == 0) {
							$("#is_coupon_applied").val(1);
							$("#coupon_id").val(couponData.id);

							var plan_total_price = $("#plan_total_price").val();
							var coupon_amount =
								(parseFloat(plan_total_price) *
									parseInt(couponData.discount_in_percent)) /
								100;

							$("#coupon_amount").val(coupon_amount);
							$("#discount_span").text(coupon_amount);

							var updated_plan_total_price =
								parseFloat(plan_total_price) - parseFloat(coupon_amount);
							$("#plan_total_price").val(updated_plan_total_price);
							$("#plan_total_price_span").text(updated_plan_total_price);

							$("#couponMsg").text(coupon_msg2);
							$("#couponMsg").css("color", "green");
						}
						$("#proceedToPaymentBtn").prop("disabled", false);
					} else {
						swal.close();
						$("#is_coupon_applied").val(0);
						$("#coupon_id").val(0);
						$("#coupon_amount").val("0.00");
						$("#discount_span").text("0.00");
						var plan_total_price = $("#plan_subtotal").text();
						$("#plan_total_price").val(plan_total_price);
						$("#plan_total_price_span").text(plan_total_price);

						$("#couponMsg").text(resp.responseMessage);
						$("#couponMsg").css("color", "red");

						/* disable payment proceed button till coupon code is not valid or keep empty*/
						$("#proceedToPaymentBtn").prop("disabled", true);
						return false;
					}
				},
			});
		} else if (coupon_code.length == 0 && coupon_code == "") {
			$("#is_coupon_applied").val(0);
			$("#coupon_id").val(0);
			$("#coupon_amount").val("0.00");
			$("#discount_span").text("0.00");
			var plan_total_price = $("#plan_subtotal").text();
			$("#plan_total_price").val(plan_total_price);
			$("#plan_total_price_span").text(plan_total_price);
			$("#coupon_code").val("");
			$("#couponMsg").text("");
			$("#proceedToPaymentBtn").prop("disabled", false);
		}
	});
});

/* print perticular area */
function printPageArea(areaID) {
	var printContent = document.getElementById(areaID).innerHTML;
	var originalContent = document.body.innerHTML;
	document.body.innerHTML = printContent;
	window.print();
	document.body.innerHTML = originalContent;
}
/* print perticular area */

/* inline jquery funtions calls */
function show_template_details(
	template_id,
	template_price,
	free_paid_flag,
	tmp_purchase_status,
	view_demo,
	lang_var
) {
	$.ajax({
		url: base_url + "/get_template_full_banner",
		type: "POST",
		data: {
			template_id: template_id,
			lang_var: lang_var,
		},
		beforeSend: function () {
			swal({
				title: "",
				imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
				buttons: false,
				closeOnClickOutside: false,
				timer: 3000,
				showConfirmButton: false,
			});
		},
		success: function (resp) {
			swal.close();
			resp = JSON.parse(resp);
			let template_full_banner = resp.responseData.template_full_banner;
			if (resp.responseCode == 200) {
				if (view_demo == "read") {
					if (template_full_banner == null || template_full_banner == "") {
						$(".tempDetailsImg_tag").attr(
							"src",
							base_url +
								"/uploads/template_half_banners/matjary-default-banner.png"
						);
					} else {
						$(".tempDetailsImg_tag").attr(
							"src",
							base_url +
								"/uploads/template_half_banners/" +
								resp.responseData.template_half_banner
						);
					}
					$(".tempDetailsTitle").text(resp.responseData.name);
					$(".tempDetailsDesc").text(resp.responseData.description);
					$("#templateDetailsModal").modal();
				} else if (view_demo == "view") {
					if (template_full_banner == null || template_full_banner == "") {
						$(".templateFullBannerModalIMG").attr(
							"src",
							base_url +
								"/uploads/template_full_banners/matjary-default-banner.png"
						);
					} else {
						$(".templateFullBannerModalIMG").attr(
							"src",
							base_url +
								"/uploads/template_full_banners/" +
								resp.responseData.template_full_banner
						);
					}
					$(".templateFullBannerModalTITLE").text(resp.responseData.name);
					$("#templateFullBannerModal").modal();
				}

				$("#templateDetailsModalSelectBuyBtn").attr("data-tplid", template_id);
				$("#templateDetailsModalSelectBuyBtn").attr(
					"data-tplprice",
					template_price
				);
				//console.log('free_paid_flag = '+free_paid_flag+' purchase status = '+tmp_purchase_status);
				if (free_paid_flag == 2) {
					if (tmp_purchase_status == false) {
						$("#templateDetailsModalSelectBuyBtn").text("Buy");
					} else {
						$("#templateDetailsModalSelectBuyBtn").text("Select Template");
					}
				} else {
					$("#templateDetailsModalSelectBuyBtn").text("Select Template");
				}
			} else {
				return false;
			}
		},
	});
}

$("#submit_customer_enquiry_form").on("submit", function (e) {
	e.preventDefault();
	var isvalidate = $("#submit_customer_enquiry_form").valid();
	if (!isvalidate) {
		return false;
	} else {
		var form = $("#submit_customer_enquiry_form")[0];
		var requestData = new FormData(form);
		var action_page = $("#submit_customer_enquiry_form").attr("action");
		$.ajax({
			url: action_page,
			type: "POST",
			enctype: "multipart/form-data",
			data: requestData,
			contentType: false,
			cache: false,
			processData: false,
			timeout: 600000,
			success: function (resp) {
				console.log(resp);
				resp = JSON.parse(resp);
				if (resp.responseCode == 200) {
					swal(
						{ title: "", text: resp.responseMessage, type: "success" },
						function () {
							window.location.reload();
						}
					);
				} else {
					swal({
						title: "Fail",
						closeOnClickOutside: false,
						text: resp.responseMessage,
						type: "error",
					});
				}
			},
		});
	}
});

// $("#submit_customer_enquiry_form").on('submit', (function (e) {
//     e.preventDefault();
//     var isvalidate = $("#submit_customer_enquiry_form").valid();
//     if (!isvalidate) {
//         return false;
//     } else {
//         var form = $('#submit_customer_enquiry_form')[0];
//         var requestData = new FormData(form);
//         var action_page = $("#submit_customer_enquiry_form").attr('action');
//         $.ajax({
//             url: action_page,
//             type: "POST",
//             enctype: 'multipart/form-data',
//             data: requestData,
//             contentType: false,
//             cache: false,
//             processData: false,
//             timeout: 600000,
//             beforeSend: function () {
//                 swal({
//                     title: "",
//                     text: processing,
//                     imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
//                     buttons: false,
//                     closeOnClickOutside: false,
//                     timer: 3000
//                 });
//             },
//             success: function (resp) {
//                 resp = JSON.parse(resp);
//                 if (resp.responseCode == 200) {
//                     swal({title: "", text: resp.responseMessage, type: "success"},
//                     function(){
//                         window.location.reload();
//                     }
//                    );
//                 } else {
//                     swal({title: "Fail", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
//                 }
//                 $('#submit_customer_enquiry_form')[0].reset();
//             }
//         });
//     }
// }));

/* theme filter function start */
