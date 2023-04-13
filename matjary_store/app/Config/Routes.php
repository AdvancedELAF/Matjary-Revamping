<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('WebController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->match(["get", "post"], '/', 'WebController::index');
$routes->match(["get", "post"], '/home', 'WebController::index');
$routes->match(["get", "post"], '/language', 'CommonController::language');
$routes->match(["get", "post"], '/test-sendgrid-mail', 'CommonController::test_sendgrid_mail');
$routes->match(["get", "post"], '/core-php-test-mail', 'CommonController::core_php_test_mail');
$routes->match(["get", "post"], '/get-country-states', 'CommonController::get_country_states');
$routes->match(["get", "post"], '/get-state-cities', 'CommonController::get_state_cities');
$routes->match(["get", "post"], '/save-subscribe', 'WebController::save_subscribe');
$routes->match(["get", "post"], "/single-product-details", 'WebController::single_product_details');
$routes->match(["get", "post"], '/customer-help', 'WebController::customerhelp');
$routes->match(["get", "post"], '/contact-us', 'WebController::contact_us');
$routes->match(["get", "post"], '/terms-and-conditions', 'WebController::terms_and_conditions');
$routes->match(["get", "post"], '/abouts-us', 'WebController::abouts_us');
$routes->match(["get", "post"], '/cookie-policy', 'WebController::cookie_policy');
$routes->match(["get", "post"], '/get-category-products', 'CommonController::get_category_products');
$routes->match(["get", "post"], '/privacy-policy', 'WebController::privacy_policy');
$routes->match(["get", "post"], '/refund-return', 'WebController::refund_return');
$routes->match(["get", "post"], '/search', 'WebController::search');

$routes->group("customer", function ($routes) {
    $routes->match(["get", "post"], "login", "WebController::login", ['as' => 'customer.login']);
    $routes->match(["get", "post"], "register", "WebController::register", ['as' => 'customer.register']);
    $routes->match(["get", "post"], "save-customer-register", "WebController::save_customer_register", ['as' => 'customer.save_customer_register']);
    $routes->match(["get", "post"], "customer-login", "WebController::customer_login", ['as' => 'customer.customer_login']);
    $routes->match(["get", "post"], "customer-logout", "WebController::customer_logout", ['as' => 'customer.customer_logout']);
    $routes->match(["get", "post"], "forgot-password", "WebController::forgot_password", ['as' => 'customer.forgot_password']);
    $routes->match(["get", "post"], "reset-forgoted-password", "WebController::reset_forgoted_password", ['as' => 'customer.reset_forgoted_password']);
    $routes->match(["get", "post"], "reset-new-password/(:num)", "WebController::reset_new_password/$1", ['as' => 'customer.reset_new_password']);
    $routes->match(["get", "post"], "save-reset-password", "WebController::save_reset_password", ['as' => 'customer.save_reset_password']);

    $routes->match(["get", "post"], "my-account", "WebController::my_account", ['as' => 'customer.my_account']);
    $routes->match(["get", "post"], "my-profile", "WebController::my_profile", ['as' => 'customer.my_profile']);
    $routes->match(["get", "post"], "update-my-profile", "WebController::update_my_profile", ['as' => 'customer.update_my_profile']);
    $routes->match(["get", "post"], "change-password", "WebController::change_password", ['as' => 'customer.change_password']);
    $routes->match(["get", "post"], "save-change-password", "WebController::save_change_password", ['as' => 'customer.save_change_password']);
    $routes->match(["get", "post"], "remove-profile-picture", "WebController::remove_profile_picture", ['as' => 'customer.remove_profile_picture']);

    $routes->match(["get", "post"], "empty-cart", "WebController::empty_cart", ["as" => "customer.empty_cart"]);
    $routes->match(["get", "post"], "add-product-cart", "WebController::add_product_cart", ['as' => 'customer.add_product_cart']);
    $routes->match(["get", "post"], "remove-product-cart", "WebController::remove_product_cart", ['as' => 'customer.remove_product_cart']);

    $routes->match(["get", "post"], "add-product-wishlist", "WebController::add_product_wishlist", ['as' => 'customer.add_product_wishlist']);
    $routes->match(["get", "post"], "remove-product-wishlist", "WebController::remove_product_wishlist", ['as' => 'customer.remove_product_wishlist']);
    $routes->match(["get", "post"], "buy-product", "WebController::buy_product", ["as" => "customer.buy_product"]);

    $routes->match(["get", "post"], "cart", "WebController::cart", ['as' => 'customer.cart']);
    $routes->match(["get", "post"], "proceed-cart", "WebController::proceed_cart", ['as' => 'customer.proceed_cart']);
    $routes->match(["get", "post"], "proceed-checkout", "WebController::proceed_checkout", ['as' => 'customer.proceed_checkout']);
    $routes->match(["get", "post"], "save-customer-deliver-address", "WebController::save_customer_deliver_address", ['as' => 'customer.save_customer_deliver_address']);

    $routes->match(["get", "post"], "edit-customer-deliver-address", "WebController::edit_customer_deliver_address", ['as' => 'customer.edit_customer_deliver_address']);
    $routes->match(["get", "post"], "update-customer-deliver-address", "WebController::update_customer_deliver_address", ['as' => 'customer.update_customer_deliver_address']);
    $routes->match(["get", "post"], "delete-customer-deliver-address", "WebController::delete_customer_deliver_address", ['as' => 'admin.delete_customer_deliver_address']);
    $routes->match(["get", "post"], "my-address", "WebController::my_address", ['as' => 'customer.my_address']);
    $routes->match(["get", "post"], 'my-gift-cards', 'WebController::my_gift_cards', ['as' => 'customer.my_gift_cards']);
    $routes->match(["get", "post"], "my-giftcard-details/(:num)", "WebController::my_giftcard_details/$1", ['as' => 'customer.my_giftcard_details']);
    $routes->match(["get", "post"], "apply-giftcard-code", "WebController::apply_giftcard_code", ["as" => "customer.apply_giftcard_code"]);
    $routes->match(["get", "post"], 'my-orders', 'WebController::my_orders', ['as' => 'customer.my_orders']);
    $routes->match(["get", "post"], "order-details/(:num)", "WebController::order_details/$1", ['as' => 'customer.order_details']);
    $routes->match(["get", "post"], "cancel-order-confirm/(:num)", "WebController::cancel_order_confirm/$1", ['as' => 'customer.cancel_order_confirm']);
    $routes->match(["get", "post"], "cancel-order", "WebController::cancel_order", ['as' => 'customer.cancel_order']);
    $routes->match(["get", "post"], 'my-wishlist', 'WebController::my_wishlist', ['as' => 'customer.my_wishlist']);

    $routes->match(["get", "post"], 'save-contact-us', 'WebController::save_contact_us', ['as' => 'customer.save_contact_us']);

    $routes->match(["get", "post"], "proceed-payment", "WebController::proceed_payment", ['as' => 'customer.proceed_payment']);
    $routes->match(["get", "post"], "order-success", "WebController::order_success", ['as' => 'customer.order_success']);

    $routes->match(["get", "post"], "purchase-giftcard", "WebController::purchase_giftcard", ['as' => 'customer.purchase_giftcard']);
    $routes->match(["get", "post"], "applied-coupon-code", "WebController::applied_coupon_code", ["as" => "customer.applied_coupon_code"]);

    /* My Refund Request Routes start */
    $routes->match(["get", "post"], "my-refund-request", "WebController::my_refund_request", ['as' => 'customer.my_refund_request']);
    $routes->match(["get", "post"], "single-refund-details/(:num)", "WebController::single_refund_details/$1", ['as' => 'customer.single_refund_details']);
    /* My Refund Request Routes end */
});

$routes->group("giftcard", function ($routes) {
    $routes->match(["get", "post"], 'gift-cards', 'WebController::gift_cards', ['as' => 'giftcard.gift_cards']);
    $routes->match(["get", "post"], "giftcard-details/(:num)", "WebController::giftcard_details/$1", ['as' => 'giftcard.giftcard_details']);

    //Feedback
    $routes->match(["get", "post"], "post-feedbacks/(:num)", "WebController::gift_card_post_feedback/$1", ['as' => 'giftcard.gift_card_post_feedback']);
    $routes->match(["get", "post"], "save-gift-card-feedback", "WebController::save_gift_card_feedback", ['as' => 'giftcard.save_gift_card_feedback']);
    $routes->match(["get", "post"], "view-feedbacks/(:num)", "WebController::view_gift_card_feedback/$1", ['as' => 'giftcard.view_gift_card_feedback']);
});

$routes->group("category", function ($routes) {
    $routes->match(["get", "post"], "category-details/(:num)", "WebController::category_details/$1", ['as' => 'category.category_details']);
    $routes->match(["get", "post"], "all-categories", "WebController::all_categories", ['as' => 'category.all_categories']);
    $routes->match(["get", "post"], "category-product-list/(:num)", "WebController::category_product_list/$1", ['as' => 'category.category_product_list']);
});

$routes->group("product", function ($routes) {
    $routes->match(["get", "post"], 'products', 'WebController::products', ['as' => 'product.products']);
    $routes->match(["get", "post"], "product-details/(:num)", "WebController::product_details/$1", ['as' => 'product.product_details']);

    //Feedback
    $routes->match(["get", "post"], "post-feedback/(:num)", "WebController::post_feedback/$1", ['as' => 'product.post_feedback']);
    $routes->match(["get", "post"], "save-feedback", "WebController::save_feedback", ['as' => 'product.save_feedback']);
    $routes->match(["get", "post"], "view-feedback/(:num)", "WebController::view_feedback/$1", ['as' => 'product.view_feedback']);
});

$routes->match(["get", "post"], '/admin', 'AdminController::index', ['as' => 'admin.dashboard']);
$routes->match(["get", "post"], '/admin/dashboard', 'AdminController::dashboard');
$routes->group("admin", function ($routes) {

    $routes->match(["get", "post"], 'login', 'AdminController::login', ['as' => 'admin.login']);
    $routes->match(["get", "post"], 'mandatory-modules', 'AdminController::mandatory_modules', ['as' => 'admin.mandatory_modules']);

    /*  Users Routes */
    $routes->match(["get", "post"], "all-users", "UserController::all_users", ['as' => 'admin.all_users']);
    $routes->match(["get", "post"], "add-user", "UserController::add_user", ['as' => 'admin.add_user']);
    $routes->match(["get", "post"], "save-user", "UserController::save_user", ['as' => 'admin.save_user']);
    $routes->match(["get", "post"], "edit-user/(:num)", "UserController::edit_user/$1", ['as' => 'admin.edit_user']);
    $routes->match(["get", "post"], "update-user", "UserController::update_user", ['as' => 'admin.update_user']);
    $routes->match(["get", "post"], "delete-user", "UserController::delete_user", ['as' => 'admin.delete_user']);
    $routes->match(["get", "post"], "activate-user", "UserController::activate_user", ['as' => 'admin.activate_user']);
    $routes->match(["get", "post"], "deactivate-user", "UserController::deactivate_user", ['as' => 'admin.deactivate_user']);

    // $routes->match(["get", "post"], "user-reset-new-password/(:num)", "UserController::reset_new_password/$1", ['as'=>'admin.reset_new_password']);
    // $routes->match(["get", "post"], "save-reset-passwords", "UserController::save_reset_password", ['as'=>'admin.save_reset_password']);
    // $routes->match(["get", "post"], "login", "UserController::login", ['as'=>'admin.login']);

    $routes->match(["get", "post"], "user-forgot-password", "UserController::user_forgot_password", ['as' => 'admin.forgot_password']);
    $routes->match(["get", "post"], "chk-password-forgoted-user-email", "UserController::chk_password_forgoted_user_email", ['as' => 'admin.chk_password_forgoted_user_email']);
    $routes->match(["get", "post"], "user-reset-new-password/(:num)", "UserController::user_reset_new_password/$1", ['as' => 'admin.reset_new_password']);
    $routes->match(["get", "post"], "user-save-reset-password", "UserController::user_save_reset_password", ['as' => 'admin.save_reset_password']);

    $routes->match(["get", "post"], "user-login", "UserController::user_login", ['as' => 'admin.user_login']);
    $routes->match(["get", "post"], "user-logout", "UserController::user_logout", ['as' => 'admin.user_logout']);

    $routes->match(["get", "post"], "profile", "UserController::profile", ['as' => 'admin.profile']);
    $routes->match(["get", "post"], "update-user-profile-form", "UserController::update_user_profile_form", ['as' => 'admin.update_user_profile_form']);
    $routes->match(["get", "post"], "change-password", "UserController::change_password", ['as' => 'admin.change_password']);
    $routes->match(["get", "post"], "save-change-password", "UserController::save_change_password", ['as' => 'admin.save_change_password']);
    $routes->match(["get", "post"], "user-profile-picture", "UserController::user_profile_picture", ['as' => 'admin.user_profile_picture']);
    $routes->match(["get", "post"], "delete-user-profile-pic", "UserController::delete_user_profile_pic", ['as' => 'admin.delete_user_profile_pic']);

    /*  Users Routes End */

    /* Common Task Routes start */
    $routes->match(["get", "post"], "delete-image", "CommonController::delete_image", ['as' => 'admin.delete_image']);
    /* Common task Routes start */
    /* Product Category Routes start */
    $routes->match(["get", "post"], 'all-product-categories', 'ProdCatController::all_product_categories', ['as' => 'admin.all_product_categories']);
    $routes->match(["get", "post"], 'add-product-category', 'ProdCatController::add_product_category', ['as' => 'admin.add_product_category']);
    $routes->match(["get", "post"], "save-product-category", "ProdCatController::save_product_category", ['as' => 'admin.save_product_category']);
    $routes->match(["get", "post"], 'edit-product-category/(:num)', 'ProdCatController::edit_product_category/$1', ['as' => 'admin.edit_product_category']);
    $routes->match(["get", "post"], "update-product-category", "ProdCatController::update_product_category", ['as' => 'admin.update_product_category']);
    $routes->match(["get", "post"], "delete-product-category", "ProdCatController::delete_product_category", ['as' => 'admin.delete_product_category']);
    $routes->match(["get", "post"], "activate-product-category", "ProdCatController::activate_product_category", ['as' => 'admin.activate_product_category']);
    $routes->match(["get", "post"], "deactivate-product-category", "ProdCatController::deactivate_product_category", ['as' => 'admin.deactivate_product_category']);
    /* Product Category Routes end */
    /* Product Brand Routes start */
    $routes->match(["get", "post"], "all-product-brands", "BrandController::all_product_brands", ['as' => 'admin.all_product_brands']);
    $routes->match(["get", "post"], "add-product-brand", "BrandController::add_product_brand", ['as' => 'admin.add_product_brand']);
    $routes->match(["get", "post"], "save-product-brand", "BrandController::save_product_brand", ['as' => 'admin.save_product_brand']);
    $routes->match(["get", "post"], "edit-product-brand/(:num)", "BrandController::edit_product_brand/$1", ['as' => 'admin.edit_product_brand']);
    $routes->match(["get", "post"], "update-product-brand", "BrandController::update_product_brand", ['as' => 'admin.update_product_brand']);
    $routes->match(["get", "post"], "delete-product-brand", "BrandController::delete_product_brand", ['as' => 'admin.delete_product_brand']);
    $routes->match(["get", "post"], "activate-product-brand", "BrandController::activate_product_brand", ['as' => 'admin.activate_product_brand']);
    $routes->match(["get", "post"], "deactivate-product-brand", "BrandController::deactivate_product_brand", ['as' => 'admin.deactivate_product_brand']);
    /* Product Brand Routes end */
    /* Store Ganaral Setting Routes */
    $routes->match(["get", "post"], 'general-settings', 'SettingController::general_settings', ['as' => 'admin.general_settings']);
    $routes->match(["get", "post"], "save-general-setting", "SettingController::save_general_setting", ['as' => 'admin.save_general_setting']);
    $routes->match(["get", "post"], "update-general-settings", "SettingController::update_general_setting", ['as' => 'admin.update_general_setting']);
    /* Store Ganaral Setting Routes End */
    /* Product Color Routes start */
    $routes->match(["get", "post"], "all-product-colors", "ColorController::all_product_colors", ['as' => 'admin.all_product_colors']);
    $routes->match(["get", "post"], "add-product-color", "ColorController::add_product_color", ['as' => 'admin.add_product_color']);
    $routes->match(["get", "post"], "save-product-color", "ColorController::save_product_color", ['as' => 'admin.save_product_color']);
    $routes->match(["get", "post"], "edit-product-color/(:num)", "ColorController::edit_product_color/$1", ['as' => 'admin.edit_product_color']);
    $routes->match(["get", "post"], "update-product-color", "ColorController::update_product_color", ['as' => 'admin.update_product_color']);
    $routes->match(["get", "post"], "delete-product-color", "ColorController::delete_product_color", ['as' => 'admin.delete_product_color']);
    $routes->match(["get", "post"], "activate-product-color", "ColorController::activate_product_color", ['as' => 'admin.activate_product_color']);
    $routes->match(["get", "post"], "deactivate-product-color", "ColorController::deactivate_product_color", ['as' => 'admin.deactivate_product_color']);
    /* Product Color Routes end */
    /* Product Size Routes start */
    $routes->match(["get", "post"], "all-product-sizes", "SizeController::all_product_sizes", ['as' => 'admin.all_product_sizes']);
    $routes->match(["get", "post"], "add-product-size", "SizeController::add_product_size", ['as' => 'admin.add_product_size']);
    $routes->match(["get", "post"], "save-product-size", "SizeController::save_product_size", ['as' => 'admin.save_product_size']);
    $routes->match(["get", "post"], "edit-product-size/(:num)", "SizeController::edit_product_size/$1", ['as' => 'admin.edit_product_size']);
    $routes->match(["get", "post"], "update-product-size", "SizeController::update_product_size", ['as' => 'admin.update_product_size']);
    $routes->match(["get", "post"], "delete-product-size", "SizeController::delete_product_size", ['as' => 'admin.delete_product_size']);
    $routes->match(["get", "post"], "activate-product-size", "SizeController::activate_product_size", ['as' => 'admin.activate_product_size']);
    $routes->match(["get", "post"], "deactivate-product-size", "SizeController::deactivate_product_size", ['as' => 'admin.deactivate_product_size']);
    /* Product Size Routes end */
    /* Shipping Setting Routes */
    $routes->match(["get", "post"], 'shipping-settings', 'ShippingController::shipping_settings', ['as' => 'admin.shipping_settings']);
    $routes->match(["get", "post"], "save-shipping-setting", "ShippingController::save_shipping_setting", ['as' => 'admin.save_shipping_setting']);
    $routes->match(["get", "post"], "update-shipping-settings", "ShippingController::update_shipping_setting", ['as' => 'admin.update_shipping_setting']);
    $routes->match(["get", "post"], "set-default-shipping-setting", "ShippingController::set_default_shipping_setting", ['as' => 'admin.set_default_shipping_setting']);
    /* Shipping Setting Routes End */
    /* Payment Setting Routes */
    $routes->match(["get", "post"], 'payment-settings', 'PaymentController::payment_settings', ['as' => 'admin.payment_settings']);
    $routes->match(["get", "post"], "save-payment-setting", "PaymentController::save_payment_setting", ['as' => 'admin.save_payment_setting']);
    $routes->match(["get", "post"], "update-payment-settings", "PaymentController::update_payment_setting", ['as' => 'admin.update_payment_setting']);
    /* Payment Setting Routes End */
    /* Product Routes start */
    $routes->match(["get", "post"], "all-products", "ProductController::all_products", ['as' => 'admin.all_products']);
    $routes->match(["get", "post"], "add-product", "ProductController::add_product", ['as' => 'admin.add_product']);
    $routes->match(["get", "post"], "save-product", "ProductController::save_product", ['as' => 'admin.save_product']);
    $routes->match(["get", "post"], "edit-product/(:num)", "ProductController::edit_product/$1", ['as' => 'admin.edit_product']);
    $routes->match(["get", "post"], "update-product", "ProductController::update_product", ['as' => 'admin.update_product']);
    $routes->match(["get", "post"], "delete-product", "ProductController::delete_product", ['as' => 'admin.delete_product']);
    $routes->match(["get", "post"], "activate-product", "ProductController::activate_product", ['as' => 'admin.activate_product']);
    $routes->match(["get", "post"], "deactivate-product", "ProductController::deactivate_product", ['as' => 'admin.deactivate_product']);
    /* Product Routes end */

    /* Customer Routes */
    $routes->match(["get", "post"], "all-customers", "CustomerController::all_customers", ['as' => 'admin.all_customers']);
    $routes->match(["get", "post"], "add-customer", "CustomerController::add_customer", ['as' => 'admin.add_customer']);
    $routes->match(["get", "post"], "save-customer", "CustomerController::save_customer", ['as' => 'admin.save_customer']);
    $routes->match(["get", "post"], "edit-customer/(:num)", "CustomerController::edit_customer/$1", ['as' => 'admin.edit_customer']);
    $routes->match(["get", "post"], "update-customer", "CustomerController::update_customer", ['as' => 'admin.update_customer']);
    $routes->match(["get", "post"], "delete-customer", "CustomerController::delete_customer", ['as' => 'admin.delete_customer']);
    $routes->match(["get", "post"], "activate-customer", "CustomerController::activate_customer", ['as' => 'admin.activate_customer']);
    $routes->match(["get", "post"], "deactivate-customer", "CustomerController::deactivate_customer", ['as' => 'admin.deactivate_customer']);
    /* Customer Routes End */

    /* Coupon Routes */
    $routes->match(["get", "post"], "all-coupons", "CouponController::all_coupons", ['as' => 'admin.all_coupons']);
    $routes->match(["get", "post"], "add-coupon", "CouponController::add_coupon", ['as' => 'admin.add_coupon']);
    $routes->match(["get", "post"], "save-coupon", "CouponController::save_coupon", ['as' => 'admin.save_coupon']);
    $routes->match(["get", "post"], "edit-coupon/(:num)", "CouponController::edit_coupon/$1", ['as' => 'admin.edit_coupon']);
    $routes->match(["get", "post"], "update-coupon", "CouponController::update_coupon", ['as' => 'admin.update_coupon']);
    $routes->match(["get", "post"], "delete-coupon", "CouponController::delete_coupon", ['as' => 'admin.delete_coupon']);
    $routes->match(["get", "post"], "activate-coupon", "CouponController::activate_coupon", ['as' => 'admin.activate_couponr']);
    $routes->match(["get", "post"], "deactivate-coupon", "CouponController::deactivate_coupon", ['as' => 'admin.deactivate_coupon']);
    /* Coupon Routes End */

    /* Banners Routes */
    $routes->match(["get", "post"], "all-banners", "BannerController::all_banners", ['as' => 'admin.all_banners']);
    $routes->match(["get", "post"], "add-banner", "BannerController::add_banner", ['as' => 'admin.add_banner']);
    $routes->match(["get", "post"], "save-banner", "BannerController::save_banner", ['as' => 'admin.save_banner']);
    $routes->match(["get", "post"], "edit-banner/(:num)", "BannerController::edit_banner/$1", ['as' => 'admin.edit_banner']);
    $routes->match(["get", "post"], "update-banner", "BannerController::update_banner", ['as' => 'admin.update_banner']);
    $routes->match(["get", "post"], "delete-banner", "BannerController::delete_banner", ['as' => 'admin.delete_banner']);
    $routes->match(["get", "post"], "activate-banner", "BannerController::activate_banner", ['as' => 'admin.activate_banner']);
    $routes->match(["get", "post"], "deactivate-banner", "BannerController::deactivate_banner", ['as' => 'admin.deactivate_banner']);
    /* Banners Routes End */

    /* Faqs Routes */
    $routes->match(["get", "post"], "all-faqs", "FaqController::all_faqs", ['as' => 'admin.all_faqs']);
    $routes->match(["get", "post"], "add-faq", "FaqController::add_faq", ['as' => 'admin.add_faq']);
    $routes->match(["get", "post"], "save-faq", "FaqController::save_faq", ['as' => 'admin.save_faq']);
    $routes->match(["get", "post"], "edit-faq/(:num)", "FaqController::edit_faq/$1", ['as' => 'admin.edit_faq']);
    $routes->match(["get", "post"], "update-faq", "FaqController::update_faq", ['as' => 'admin.update_faq']);
    $routes->match(["get", "post"], "delete-faq", "FaqController::delete_faq", ['as' => 'admin.delete_faq']);
    $routes->match(["get", "post"], "activate-faq", "FaqController::activate_faq", ['as' => 'admin.activate_faq']);
    $routes->match(["get", "post"], "deactivate-faq", "FaqController::deactivate_faq", ['as' => 'admin.deactivate_faq']);

    $routes->match(["get", "post"], "customer-help", "FaqController::customer_help", ['as' => 'admin.customer_help']);
    $routes->match(["get", "post"], "save-customer-help", "FaqController::save_customer_help", ['as' => 'admin.save_customer_help']);
    $routes->match(["get", "post"], "update-customer-help", "FaqController::update_customer_help", ['as' => 'admin.update_customer_help']);
    $routes->match(["get", "post"], "admin-help", "FaqController::admin_help", ['as' => 'admin.admin_help']);

    /* Terms Conditions Routes */
    $routes->match(["get", "post"], "terms-conditions", "FaqController::terms_conditions", ['as' => 'admin.terms_conditions']);
    $routes->match(["get", "post"], "save-terms-conditions", "FaqController::save_terms_conditions", ['as' => 'admin.save_terms_conditions']);
    $routes->match(["get", "post"], "update-terms-conditions", "FaqController::update_terms_conditions", ['as' => 'admin.update_terms_conditions']);

    /* About Us Routes */
    $routes->match(["get", "post"], "about-us", "FaqController::about_us", ['as' => 'admin.about_us']);
    $routes->match(["get", "post"], "save-about-us", "FaqController::save_about_us", ['as' => 'admin.save_about_us']);
    $routes->match(["get", "post"], "update-about-us", "FaqController::update_about_us", ['as' => 'admin.update_about_us']);

    /* admin subscribes Routes */
    $routes->match(["get", "post"], "all-subscribes", "FaqController::all_subscribes", ['as' => 'admin.all_subscribes']);
    $routes->match(["get", "post"], "delete-subscribes", "FaqController::delete_subscribes", ['as' => 'admin.delete_subscribes']);
    $routes->match(["get", "post"], "activate-subscribes", "FaqController::activate_subscribes", ['as' => 'admin.activate_subscribes']);
    $routes->match(["get", "post"], "deactivate-subscribes", "FaqController::deactivate_subscribes", ['as' => 'admin.deactivate_subscribes']);

    /* admin contact Us Routes */
    $routes->match(["get", "post"], "all-contact-us", "FaqController::all_contact_us", ['as' => 'admin.all_contact_us']);
    $routes->match(["get", "post"], "delete-contact-us", "FaqController::delete_contact_us", ['as' => 'admin.delete_contact_us']);
    $routes->match(["get", "post"], "activate-contact-us", "FaqController::activate_contact_us", ['as' => 'admin.activate_contact_us']);
    $routes->match(["get", "post"], "deactivate-contact-us", "FaqController::deactivate_contact_us", ['as' => 'admin.deactivate_contact_us']);
    $routes->match(["get", "post"], "view-contact-us/(:num)", "FaqController::view_contact_us/$1", ['as' => 'admin.view_contact_us']);
    $routes->match(["get", "post"], "reply-contact-admin", "FaqController::reply_contact_admin", ['as' => 'admin.reply_contact_admin']);

    /* Faqs Routes End */

    /* Gift Cards Routes */
    $routes->match(["get", "post"], "all-gift-cards", "GiftCardController::all_gift_cards", ['as' => 'admin.all_gift_cards']);
    $routes->match(["get", "post"], "add-gift-card", "GiftCardController::add_gift_card", ['as' => 'admin.add_gift_card']);
    $routes->match(["get", "post"], "save-gift-card", "GiftCardController::save_gift_card", ['as' => 'admin.save_gift_card']);
    $routes->match(["get", "post"], "edit-gift-card/(:num)", "GiftCardController::edit_gift_card/$1", ['as' => 'admin.edit_gift_card']);
    $routes->match(["get", "post"], "update-gift-card", "GiftCardController::update_gift_card", ['as' => 'admin.update_gift_card']);
    $routes->match(["get", "post"], "delete-gift-card", "GiftCardController::delete_gift_card", ['as' => 'admin.delete_gift_card']);
    $routes->match(["get", "post"], "activate-gift-card", "GiftCardController::activate_gift_card", ['as' => 'admin.activate_gift_card']);
    $routes->match(["get", "post"], "deactivate-gift-card", "GiftCardController::deactivate_gift_card", ['as' => 'admin.deactivate_gift_card']);
    /* Gift Cards End */
    /* shipping pickup Routes start */
    $routes->match(["get", "post"], "ship-orders", "ShippingController::ship_orders", ['as' => 'admin.ship_orders']);
    $routes->match(["get", "post"], "shipment-pickups", "ShippingController::shipment_pickups", ['as' => 'admin.shipment_pickups']);
    $routes->match(["get", "post"], "cancel-pickup", "ShippingController::cancel_pickup", ['as' => 'admin.cancel_pickup']);

    $routes->match(["get", "post"], "track-pickup", "ShippingController::track_pickup", ['as' => 'admin.track_pickup']);
    $routes->match(["get", "post"], "create-pickup-request", "ShippingController::create_pickup_request", ['as' => 'admin.create_pickup_request']);
    $routes->match(["get", "post"], "order-details/(:num)", "ShippingController::order_details/$1", ['as' => 'admin.order_details']);
    $routes->match(["get", "post"], "submit-pickup-request", "ShippingController::submit_pickup_request", ["as" => 'admin.submit_pickup_request']);
    /* shipping pickup Routes end */
    /* orders management Routes start */
    $routes->match(["get", "post"], "all-orders", "OrderController::all_orders", ['as' => 'admin.all_orders']);
    $routes->match(["get", "post"], "single-order-details/(:num)", "OrderController::single_order_details/$1", ['as' => 'admin.single_order_details']);
    /* orders management Routes end */
    /* Refund Request Routes start */
    $routes->match(["get", "post"], "all-refund-request", "OrderController::all_refund_request", ['as' => 'admin.all_refund_request']);
    $routes->match(["get", "post"], "single-refund-details/(:num)", "OrderController::single_refund_details/$1", ['as' => 'admin.single_refund_details']);
    $routes->match(["get", "post"], "approve-refund-request", "OrderController::approve_refund_request", ['as' => 'admin.approve_refund_request']);
    /* Refund Request Routes end */

    /* Advertisements Routes */
    $routes->match(["get", "post"], "all-advertisements", "AdvertisementController::all_advertisements", ['as' => 'admin.all_advertisements']);
    $routes->match(["get", "post"], "add-advertisement", "AdvertisementController::add_advertisement", ['as' => 'admin.add_advertisement']);
    $routes->match(["get", "post"], "save-advertisement", "AdvertisementController::save_advertisement", ['as' => 'admin.save_advertisement']);
    $routes->match(["get", "post"], "edit-advertisement/(:num)", "AdvertisementController::edit_advertisement/$1", ['as' => 'admin.edit_advertisement']);
    $routes->match(["get", "post"], "update-advertisement", "AdvertisementController::update_advertisement", ['as' => 'admin.update_advertisement']);
    $routes->match(["get", "post"], "delete-advertisement", "AdvertisementController::delete_advertisement", ['as' => 'admin.delete_advertisement']);
    $routes->match(["get", "post"], "activate-advertisement", "AdvertisementController::activate_advertisement", ['as' => 'admin.activate_advertisement']);
    $routes->match(["get", "post"], "deactivate-advertisement", "AdvertisementController::deactivate_advertisement", ['as' => 'admin.deactivate_advertisement']);
    /* Advertisements Routes End */
});

/* Faq Front Routes Start */
$routes->group("faq", function ($routes) {
    $routes->match(["get", "post"], 'faqs', 'WebController::faq', ['as' => 'faq.faq']);
});
//$routes->match(["get", "post"],'customer-help','WebController::customerhelp',['as'=>'admin.customerhelp']); 

/* Faq Front Routes End */

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
