<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/userguide3/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'WebCntr';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;

/* website controller */
$route['lang_switch'] = 'WebCntr/switchLang';
$route['about-us'] = 'WebCntr/about_us';
$route['privacy-policy'] = 'WebCntr/privacy_policy';
$route['terms-conditions'] = 'WebCntr/terms_services';
$route['refund-return-policy'] = 'WebCntr/refund_return_policy';
$route['services'] = 'WebCntr/services';
$route['templates'] = 'WebCntr/templates';
$route['pricing'] = 'WebCntr/pricing';
$route['contact'] = 'WebCntr/contact';
//$route['choose-usr-tpl'] = 'WebCntr/choose_usr_tpl';
$route['chk-domain-subdomain-live-status'] = 'WebCntr/chk_domain_subdomain_live_status';
$route['help'] = 'WebCntr/help';
$route['faq'] = 'WebCntr/faq';
$route['request-reset-pwd'] = 'WebCntr/request_reset_pwd';
$route['reset-pwd-form/(:any)'] = 'WebCntr/enter_reset_pwd_page';
$route['store-themes'] = 'WebCntr/paid_themes';

/* user controller */
$route['login'] = 'UsrCntr/login';
$route['register'] = 'UsrCntr/register';
$route['save-user'] = 'UsrCntr/save_user';
$route['usr-login'] = 'UsrCntr/usr_login';
$route['usr-logout'] = 'UsrCntr/usr_logout';
$route['choose-template'] = 'UsrCntr/matjary_templates';
/* $route['save-user-plan'] = 'UsrCntr/save_user_plan'; */
$route['user-billing'] = 'UsrCntr/save_user_plan';
$route['proceed-payment'] = 'UsrCntr/proceed_payment';
$route['subscription-success'] = 'UsrCntr/subscription_success';
$route['user-dashboard'] = 'UsrCntr/user_dashboard';
$route['update-user-profile-form'] = 'UsrCntr/update_user_profile_form';
$route['update-usr-pro-pass-frm'] = 'UsrCntr/update_usr_pro_pass_frm';
$route['store-details/(:any)'] = 'UsrCntr/store_details_cont';
$route['free-trail-store-details/(:any)'] = 'UsrCntr/store_details_cont';
$route['create-store'] = 'UsrCntr/create_store_con';
$route['order-status'] = 'UsrCntr/pg_response';

$route['create-free-trial-store'] = 'UsrCntr/create_free_trial_store';
$route['free-trial-store'] = 'UsrCntr/free_trial_store';
$route['free-trial-form'] = 'UsrCntr/free_trial_form';
$route['create-free-store'] = 'UsrCntr/create_free_trial_store';

$route['send-reset-password-link'] = 'UsrCntr/send_reset_password_link';
$route['set-usr-reset-password'] = 'UsrCntr/set_usr_reset_password';

$route['get-country-states'] = 'CommonCntr/get_country_states';
$route['get-state-cities'] = 'CommonCntr/get_state_cities';
$route['submit-contact-form'] = 'CommonCntr/submit_contact_form';

/* API Controller */
$route['api-token-validation'] = 'ApiCntr/api_token_validation';
$route['save-usr'] = 'ApiCntr/save_usr';
$route['chk-usr-login'] = 'ApiCntr/chk_usr_login';
$route['plan-list'] = 'ApiCntr/plan_list';
$route['template-list'] = 'ApiCntr/template_list';
$route['check-subdomain-availability'] = 'UsrCntr/check_subdomain_availability';
$route['check-subdomain-availability-api'] = 'ApiCntr/check_subdomain_availability_api';
$route['save-usr-subscription'] = 'ApiCntr/save_usr_subscription';
$route['user-domains'] = 'ApiCntr/user_domains'; 
$route['user-profile-details'] = 'ApiCntr/user_profile_details';
$route['user-order-details'] = 'ApiCntr/user_order_details';
$route['user-store-template-details'] = 'ApiCntr/user_store_template_details';
$route['update-user-profile-api'] = 'ApiCntr/update_user_profile_api';
$route['update-usr-pro-pass-api'] = 'ApiCntr/update_usr_pro_pass_api';
$route['update-pg-res-api'] = 'ApiCntr/update_pg_res_api';
$route['create-store-api'] = 'ApiCntr/create_store_api';
$route['submit-contact-form-api'] = 'ApiCntr/submit_contact_form_api';
$route['create-free-trial-store'] = 'ApiCntr/create_free_trial_store';
$route['store-info'] = 'ApiCntr/store_info';
$route['get_template_full_banner'] = 'ApiCntr/template_details_id';
$route['send-reset-password-link-api'] = 'ApiCntr/send_reset_password_link_api';
$route['set-usr-reset-password-api'] = 'ApiCntr/set_usr_reset_password_api';

$route['get-user-purchased-store-payment-info-api/(:any)'] = 'ApiCntr/get_user_purchased_store_payment_info_api/$1';
$route['get-user-purchased-template-payment-info-api/(:any)'] = 'ApiCntr/get_user_purchased_template_payment_info_api/$1';

$route['save-newsletter-email'] = 'ApiCntr/save_newsletter_email';

$route['shipping-info'] = 'ApiCntr/shipping_info';

$route['restart_apache'] = 'ApiCntr/restart_apache';

$route['create_store_test'] = 'TestController/create_store_test';

$route['buy-template'] = 'UsrCntr/buy_template';
$route['proceed-template-payment'] = 'UsrCntr/proceed_template_payment';

$route['template-order-status'] = 'UsrCntr/template_pg_response';

$route['save-template-subscription'] = 'ApiCntr/save_template_subscription';

$route['store-template-details/(:any)'] = 'UsrCntr/store_template_details';

$route['check-template-purchased'] = 'ApiCntr/check_template_purchased';
$route['check-coupon-valid'] = 'ApiCntr/check_coupon_valid';

$route['matjary-config'] = 'ApiCntr/matjary_config';

/* Admin Panel Route Start*/
$route['site-admin'] = 'AuthCntr/login';
$route['site-admin/login'] = 'AuthCntr/login';  
$route['chk-admin-login'] = 'AuthCntr/chk_admin_login'; 
$route['chk-admin-credentials'] = 'ApiCntr/chk_admin_credentials';
$route['site-admin-logout'] = 'AuthCntr/site_admin_logout';

$route['site-admin/dashboard'] = 'AdminCntr/dashboard'; 
$route['site-admin/all-users'] = 'AdminCntr/all_users';
$route['site-admin/create'] = 'AdminCntr/create'; 
$route['save-admin-user'] = 'AdminCntr/save_admin_user';

$route['site-admin/edit-admin-user/(:num)'] = 'AdminCntr/edit_admin_user/$1';
$route['save-edit-admin-user'] = 'AdminCntr/update_admin_user';
$route['site-admin/deactivate-admin-user'] = 'AdminCntr/deactivate_admin_user';
$route['site-admin/activate-admin-user'] = 'AdminCntr/activate_admin_user';
$route['site-admin/delete-admin-user'] = 'AdminCntr/delete_admin_user';

/* all-categorys */

$route['site-admin/all-categorys'] = 'AdminCntr/all_categorys';
$route['site-admin/add-category'] = 'AdminCntr/add_category';
$route['save-template-category'] = 'AdminCntr/save_template_category';
$route['site-admin/edit-category/(:num)'] = 'AdminCntr/edit_category/$1';
$route['save-category'] = 'AdminCntr/save_category';
$route['site-admin/deactivate-category'] = 'AdminCntr/deactivate_category';
$route['site-admin/activate-category'] = 'AdminCntr/activate_category';
$route['site-admin/delete-category'] = 'AdminCntr/delete_category';

/* all-categorys */

/* Subscribers */

$route['site-admin/all-subscribers'] = 'AdminCntr/all_subscribers';
$route['site-admin/deactivate-subscribers'] = 'AdminCntr/deactivate_subscribers';
$route['site-admin/activate-subscribers'] = 'AdminCntr/activate_subscribers';
$route['site-admin/delete-subscribers'] = 'AdminCntr/delete_subscribers';

/* Subscribers */

/* Templates */
$route['site-admin/all-templates'] = 'AdminCntr/all_templates';
$route['site-admin/add-template'] = 'AdminCntr/add_template';
$route['save-template'] = 'AdminCntr/save_template';
$route['site-admin/edit-template/(:num)'] = 'AdminCntr/edit_template/$1';
$route['edit-save-template'] = 'AdminCntr/edit_save_template';
$route['site-admin/deactivate-template'] = 'AdminCntr/deactivate_template';
$route['site-admin/activate-template'] = 'AdminCntr/activate_template';
$route['site-admin/delete-template'] = 'AdminCntr/delete_template';
/* Templates End */

/* Matjary Plans */
$route['site-admin/all-plans'] = 'AdminCntr/all_plans';
$route['site-admin/add-plan'] = 'AdminCntr/add_plan';
$route['save-plan'] = 'AdminCntr/save_plan';
$route['site-admin/edit-plan/(:num)'] = 'AdminCntr/edit_plan/$1';
$route['update-plan'] = 'AdminCntr/update_plan';
$route['site-admin/deactivate-plan'] = 'AdminCntr/deactivate_plan';
$route['site-admin/activate-plan'] = 'AdminCntr/activate_plan';
$route['site-admin/delete-plan'] = 'AdminCntr/delete_plan';
/* Matjary Plans End */

/* Admin Profile */
$route['site-admin/profile'] = 'AdminCntr/profile';
$route['save-profile'] = 'AdminCntr/save_profile';
$route['site-admin/change-password'] = 'AdminCntr/change_password';
$route['change-admin-password'] = 'AdminCntr/change_admin_password';
/* Admin Profile End */

/* Stores*/
$route['site-admin/all-stores'] = 'AdminCntr/all_stores';
$route['site-admin/store-details/(:num)'] = 'AdminCntr/store_details/$1';
$route['save-profile'] = 'AdminCntr/save_profile';

$route['site-admin/get-dashboard-data'] = 'AdminCntr/get_dashboard_data';
$route['site-admin/get-monthly-orders-data'] = 'AdminCntr/get_monthly_orders_data';
$route['site-admin/get-oreder-sales-data'] = 'AdminCntr/get_oreder_sales_data';
$route['site-admin/get-revenue-data'] = 'AdminCntr/get_revenue_data';

/* Stores End */

/* Matjary Coupons */

$route['site-admin/all-coupons'] = 'AdminCntr/all_coupons';
$route['site-admin/add-coupon'] = 'AdminCntr/add_coupon';
$route['save-coupon'] = 'AdminCntr/save_coupon';
$route['site-admin/view-coupon/(:num)'] = 'AdminCntr/view_coupon/$1';
//$route['update-coupon'] = 'AdminCntr/update_coupon';
$route['site-admin/deactivate-coupon'] = 'AdminCntr/deactivate_coupon';
$route['site-admin/activate-coupon'] = 'AdminCntr/activate_coupon';
$route['site-admin/delete-coupon'] = 'AdminCntr/delete_coupon';

/* Matjary Coupons End */

/**Employees */
$route['site-admin/all-employees'] = 'AdminCntr/all_employees';
$route['site-admin/add-employee'] = 'AdminCntr/add_employee'; 
$route['save-employee'] = 'AdminCntr/save_employee';
$route['site-admin/edit-employee/(:num)'] = 'AdminCntr/edit_employee/$1';
$route['update-employee'] = 'AdminCntr/update_employee';
$route['site-admin/deactivate-employee'] = 'AdminCntr/deactivate_employee';
$route['site-admin/activate-employee'] = 'AdminCntr/activate_employee';
$route['site-admin/delete-employee'] = 'AdminCntr/delete_employee';
/**Employees */

/* all-customer-enquiry */
$route['site-admin/all-customer-enquiry'] = 'AdminCntr/all_customer_enquiry';
$route['site-admin/view-coustomer-enquiry/(:num)'] = 'AdminCntr/view_coustomer_enquiry/$1';
$route['reply-customer-enquiry'] = 'AdminCntr/reply_customer_enquiry';
$route['ticket-details/(:num)'] = 'UsrCntr/view_coustomer_enquiry_details/$1';
$route['submit-customer-enquiry-form'] = 'UsrCntr/submit_customer_enquiry_form';

/* Admin Panel Route End */





