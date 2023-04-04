<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use PhpParser\Node\Expr\FuncCall;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use CodeIgniter\Cookie\Cookie;
use Config\Cookie as CookieConfig;
use DateTime;
use DateTimeZone;

class WebController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        // Add your code here.
    }

    public function index(){

        $this->pageData['pageTitle'] = 'Home';
        $this->pageData['pageId'] = 1;
        $this->pageData['pageCostomCss'] = array();
        $this->pageData['pageCostomJs'] = array();
        $this->pageData['productList'] = $this->ProductModel->get_all_active_data();
        $this->pageData['productFeatureList'] = $this->ProductModel->get_feature_product_data();
        $this->pageData['productLatestList'] = $this->ProductModel->get_latest_product_data();
        $this->pageData['productDiscountList'] = $this->ProductModel->get_discount_product_data();
        $this->pageData['BannerList'] = $this->BannerModel->get_all_active_data();
        $this->pageData['BrandInfo'] = $this->BrandModel->get_all_brand_name_data();
        $this->pageData['AboutUsInfo'] = $this->AboutUsModel->get_all_data(); 
        $this->pageData['GiftCardList'] = $this->GiftCardModel->get_all_active_data();
        $this->pageData['advertisementList'] = $this->AdvertisementModel->get_all_data();

        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
            if(isset($customerCartProducts) && !empty($customerCartProducts)){
                $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
            }               
            $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
            }                
        }       
        
        if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
            $this->pageData['productList'] = $this->ProductModel->get_search_result($_REQUEST['query']);
        }else{
            $this->pageData['productList'] = $this->ProductModel->get_all_active_data();
        }
        
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/index',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function products(){
        $this->pageData['pageTitle'] = 'Products';
        $this->pageData['pageId'] = 2;
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){ 
             
            $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
            if(isset($customerCartProducts) && !empty($customerCartProducts)){
                $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
            }  
                       
            $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
            }                
        }
        if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
            $ses_lang = 'ar';
            if(isset($this->ses_lang) && !empty($this->ses_lang)){
                $ses_lang = $this->ses_lang;
            }
            $this->pageData['productList'] = $this->ProductModel->get_search_result($_REQUEST['query'],$ses_lang);
        }else{
            $this->pageData['productList'] = $this->ProductModel->get_all_active_data();
        }
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/product/products',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function category_details($prodCatId=''){
        if(isset($prodCatId) && !empty($prodCatId)){
            $this->pageData['pageTitle'] = 'Product Category';
            $this->pageData['prodCatDetails'] = $this->ProdCatModel->find($prodCatId);
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
                $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
                if(isset($customerCartProducts) && !empty($customerCartProducts)){
                    $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                }
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/product_category/category-details',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = 'Product Category Id Is Required.';
            return json_encode($resp); exit;
        }
    }

    public function product_details($prodId=''){
        if(isset($prodId) && !empty($prodId)){
            $this->pageData['pageTitle'] = 'Product Details';
            $this->pageData['productDetails'] = $this->ProductModel->get_single_product_details($prodId);
            $this->pageData['productColors'] = $this->ColorModel->get_all_active_data();
            $this->pageData['productSizes'] = $this->SizeModel->get_all_active_data();
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
                $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
                if(isset($customerCartProducts) && !empty($customerCartProducts)){
                    $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                }               
                $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                    $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
                }                
            }
            $ProductFeedBackInfo = $this->ProductFeedBackModel->get_customer_feedback_products($prodId);
            if(isset($ProductFeedBackInfo) && !empty($ProductFeedBackInfo)){
                $this->pageData['GetProductFeedbacks'] = $ProductFeedBackInfo;
            }
            $cstratingCount = $this->ProductFeedBackModel->get_customer_feedback_count_ratting($prodId); 
            if(isset($cstratingCount) && !empty($cstratingCount)){
                $this->pageData['cstratingCount'] = $cstratingCount;
            }
            $cstavgCount = $this->ProductFeedBackModel->get_customer_feedback_avg_ratting($prodId); 
            if(isset($cstavgCount) && !empty($cstavgCount)){
                $this->pageData['cstavgCount'] = $cstavgCount;
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/product/product-details',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function single_product_details(){
        if(isset($_POST['prodId']) && !empty($_POST['prodId'])){
            $this->pageData['productDetails'] = $this->ProductModel->get_single_product_details($_POST['prodId']);
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
                $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
                if(isset($customerCartProducts) && !empty($customerCartProducts)){
                    $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                }               
                $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                    $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
                }                
            }
            $ProductFeedBackInfo = $this->ProductFeedBackModel->get_customer_feedback_products($_POST['prodId']);
            if(isset($ProductFeedBackInfo) && !empty($ProductFeedBackInfo)){
                $this->pageData['GetProductFeedbacks'] = $ProductFeedBackInfo;
            }
            $cstratingCount = $this->ProductFeedBackModel->get_customer_feedback_count_ratting($_POST['prodId']); 
            if(isset($cstratingCount) && !empty($cstratingCount)){
                $this->pageData['cstratingCount'] = $cstratingCount;
            }
            $cstavgCount = $this->ProductFeedBackModel->get_customer_feedback_avg_ratting($_POST['prodId']); 
            if(isset($cstavgCount) && !empty($cstavgCount)){
                $this->pageData['cstavgCount'] = $cstavgCount;
            }
            $resp['responseCode'] = 200;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product details retrived successfully.':'تم استرداد تفاصيل المنتج بنجاح.';
            $resp['responseData'] = $this->pageData;
            echo json_encode($resp); exit;
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            echo json_encode($resp); exit;
        }
    }

    public function login(){
        $this->pageData['pageTitle'] = 'Customer Login';
        return view('store/'.$this->storeActvTmplName.'/customer/login',$this->pageData);
    }

    public function register(){
        $this->pageData['pageTitle'] = 'Customer Register';
        return view('store/'.$this->storeActvTmplName.'/customer/register',$this->pageData);
    }

    public function save_customer_register(){
        if(isset($_POST['name']) && !empty($_POST['name'])){
            if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    if(isset($_POST['password']) && !empty($_POST['password'])){
                        if(isset($_POST['cnf_password']) && !empty($_POST['cnf_password'])){                                                                              
                            $emailExist = $this->CustomerModel->check_email_exist($_POST['email']); /* check email already exist or not */
                            if($emailExist==true){
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Email Already Exits With Another Customer.':'البريد الإلكتروني موجود بالفعل مع عميل آخر.';
                                return json_encode($resp); exit;
                            }else{
                                $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                                $email	= $this->request->getPost('email');                            
                                $contact_no = $this->request->getPost('contact_no');
                                $insertedCustmrId = $this->CustomerModel->insert_data(array(                                                                           
                                    "name" =>isset($name)?$name:'',
                                    "email" => isset($email)?$email:'',                                  
                                    "contact_no" => isset($contact_no)?$contact_no:'',                                                                                                 
                                    "is_active" => 1,
                                    "created_at" => DATETIME
                                ));
                                if(is_int($insertedCustmrId)){ 
                                    /* save customer password */
                                    $insertedCustmrPassId = $this->CustomerModel->insert_cust_pass_data(array(                                                                           
                                        'customer_id' => $insertedCustmrId,
                                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),                                                                                                
                                        "is_active" => 1,
                                        "created_at" => DATETIME
                                    ));
                                    if(is_int($insertedCustmrId)){ 
                                        $server_site_path = base_url();
                                        $templateName = $this->storeActvTmplName;
                                        $sociaFB = 'javascript:void(0);';
                                        $socialTwitter = 'javascript:void(0);';
                                        $socialYoutube = 'javascript:void(0);';
                                        $socialLinkedin = 'javascript:void(0);';
                                        $socialInstagram = 'javascript:void(0);';
                                        $address = '';
                                        $storeName = '';
                                        $supportEmail = '';
                                    
                                        $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                        if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                            if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                $address = $this->pageData['storeSettingInfo']->address;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                $storeName = $this->pageData['storeSettingInfo']->name;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                            }
                                        }                                        
                                        $this->pageData['storeLogo'] = $store_logo;
                                        $this->pageData['templateName'] = $templateName;
                                        $this->pageData['sociaFB'] = $sociaFB;
                                        $this->pageData['socialTwitter'] = $socialTwitter;
                                        $this->pageData['socialYoutube'] = $socialYoutube;
                                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                                        $this->pageData['socialInstagram'] = $socialInstagram;
                                        $this->pageData['name'] = $_POST['name'];
                                        $this->pageData['address'] = $address;
                                        $this->pageData['supportEmail'] = $supportEmail;
                                        $this->pageData['storeName'] = $storeName;
                                        $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/customer_register',$this->pageData); 
                                        $subject ='Registration Successful, Welcome to Store.';
                                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                                        if($sendEmail == true){
                                            /* Notification Code For Gift Card Purchased Start*/
                                            $newCustomer = base_url('admin/all-customers'); 
                                            $this->NotificationsModel->insert_data(array(                                                                           
                                                "type_id" => 1,
                                                "is_seen" => 0,                                  
                                                "reff_link" => isset($newCustomer)?$newCustomer:'',    
                                                "created_at" => DATETIME
                                            ));
                                            /* Notification Code For Gift Card Purchased End*/
                                           
                                            $resp['responseCode'] = 200;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'You Have Registered Successfully.':'لقد سجلت بنجاح.';
                                            $resp['redirectUrl'] = base_url('customer/login');
                                            return json_encode($resp); exit; 
                                        }else{
                                            $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                                            $resp['responseCode'] = 500;
                                            $resp['responseMessage'] = $errorMsg;
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $errorMsg = $this->ses_lang=='en'?'Error While Customer Password Insertion.':'خطأ أثناء إدخال كلمة مرور العميل.';                                    
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $errorMsg;
                                        return json_encode($resp); exit;
                                    } 
                                }else{
                                    $errorMsg = $this->ses_lang=='en'?'Error While Customer Registration.':'خطأ أثناء تسجيل العميل.';                                    
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $errorMsg;
                                    return json_encode($resp); exit;
                                }                                
                            }
                        }else{  
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Confirm Password Is Required.':'تأكيد كلمة المرور مطلوب.';
                            return json_encode($resp); exit;
                        }
                    }else{  
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Password Is Required.':'كلمة المرور مطلوبة.';
                        return json_encode($resp); exit;
                    }
                }else{  
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Email Is Required.':'البريد الالكتروني مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{  
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Contact number Is Required.':'رقم الاتصال مطلوب.';
                return json_encode($resp); exit;
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Name Is Required.':'مطلوب اسم.';
            return json_encode($resp); exit;
        }
    }

    public function customer_login(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                $email	= $this->request->getPost('email'); 
                $password = isset($_POST['password'])?$_POST['password']:''; 
                $data = $this->CustomerModel->chk_customer_exist_with_email($email);
                if(isset($data) && !empty($data)){
                    $pass = $data->password;
                    $verify_pass = password_verify($password, $pass);
                    if($verify_pass){
                        $ses_data = [
                            'ses_custmr_id'       => $data->id,
                            'ses_custmr_name'     => $data->name,
                            'ses_custmr_email'    => $data->email,
                            'ses_logged_in'     => TRUE
                        ];
                        $this->session->set($ses_data);
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Logedin Successfully.':'تم تسجيل دخول العميل بنجاح.';
                        $resp['redirectUrl'] = base_url();
                        return json_encode($resp); exit; 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Incorrect Credentials.':'أوراق غير صحيحة.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Incorrect Credentials.':'أوراق غير صحيحة.';
                    return json_encode($resp); exit;
                }
            }else{  
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Password Is Required.':'كلمة المرور مطلوبة.';
                return json_encode($resp); exit;
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Email Is Required.':'البريد الالكتروني مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function customer_logout(){
        $this->session->destroy();
        return redirect()->to('/home');
    }

    public function forgot_password(){
        $this->pageData['pageTitle'] = $this->ses_lang=='en'?'Customer Forgot Password':'نسيت كلمة المرور للعميل';
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/forgot-password',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function reset_forgoted_password(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email	= $this->request->getPost('email');  
            $data = $this->CustomerModel->chk_customer_exist_with_email($email);
            if(isset($data) && !empty($data)){
                /* check customer has already raised password reset request or not */
                $is_exist = $this->CustomerModel->chk_reset_pass_request_exist($data->id);
                if($is_exist==true){                                  
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'You already raised a password reset request so please check your registered email inbox/spam folder for the password reset link or contact the administrator for further assistance.':'لقد قمت بالفعل بتقديم طلب إعادة تعيين كلمة المرور ، لذا يرجى مراجعة مجلد البريد الإلكتروني / البريد العشوائي المسجل الخاص بك للحصول على رابط إعادة تعيين كلمة المرور أو الاتصال بالمسؤول للحصول على مزيد من المساعدة.';
                    return json_encode($resp); exit;
                }
                $insertedId = $this->CustomerModel->insert_customer_reset_pass_data(array(                                                                           
                    'customer_id' => $data->id,
                    'token' => password_hash($data->id, PASSWORD_DEFAULT),                                                                                                
                    "reset_flag" => 1,
                    "created_at" => DATETIME
                ));
                if(is_int($insertedId)){ 
                    $server_site_path = base_url();
                    $templateName = $this->storeActvTmplName;
                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                    $sociaFB = 'javascript:void(0);';
                    $socialTwitter = 'javascript:void(0);';
                    $socialYoutube = 'javascript:void(0);';
                    $socialLinkedin = 'javascript:void(0);';
                    $socialInstagram = 'javascript:void(0);';
                    $address = '';
                    $storeName = '';
                    $supportEmail = '';
                    
                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                        }
                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                        }
                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                        }
                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                        }
                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                        }
                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                        }
                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                            $address = $this->pageData['storeSettingInfo']->address;
                        }
                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                            $storeName = $this->pageData['storeSettingInfo']->name;
                        }
                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                        }
                    } 
                    $resetLink = base_url('customer/reset-new-password/'.$data->id);
                    $this->pageData['storeLogo'] = $store_logo;
                    $this->pageData['templateName'] = $templateName;
                    $this->pageData['sociaFB'] = $sociaFB;
                    $this->pageData['socialTwitter'] = $socialTwitter;
                    $this->pageData['socialYoutube'] = $socialYoutube;
                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                    $this->pageData['socialInstagram'] = $socialInstagram;       
                    $this->pageData['address'] = $address;
                    $this->pageData['supportEmail'] = $supportEmail;
                    $this->pageData['storeName'] = $storeName;             
                    $this->pageData['resetLink'] = $resetLink;
                    $this->pageData['email'] = $email;

                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/customer-forgoted-password',$this->pageData);
                    $subject = 'Customer password reset link';
                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                    if($sendEmail == true){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Password Reset Link Sent to Your Registered Mail ID, Please Check Your Registered Mail Inbox/Spam Folder for Reset Link.':'تم إرسال رابط إعادة تعيين كلمة المرور إلى معرف البريد المسجل الخاص بك ، يرجى التحقق من صندوق الوارد للبريد المسجل / مجلد البريد العشوائي للحصول على رابط إعادة التعيين.';
                        $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                        return json_encode($resp); exit; 
                    }else{
                        $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $errorMsg = $this->ses_lang=='en'?'Error While Customer Password Reset Request Insertion.':'حدث خطأ أثناء إدراج طلب إعادة تعيين كلمة مرور العميل.';                                    
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Email Not Found.':'البريد الإلكتروني غير موجود.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Email Is Required.':'البريد الالكتروني مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function reset_new_password($customerId=''){
        /* check customer has already raised password reset request or not */
        $is_exist = $this->CustomerModel->chk_reset_pass_request_exist($customerId);
        if($is_exist==true){    
            $this->pageData['pageTitle'] = $this->ses_lang=='en'?'Set Customer New Password':'قم بتعيين كلمة مرور جديدة للعميل';
            $this->pageData['customer_id'] = $customerId;
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/reset-new-password',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            $this->pageData['pageTitle'] = $this->ses_lang=='en'?'Set Customer New Password':'قم بتعيين كلمة مرور جديدة للعميل';
            $this->pageData['errorMsg'] = $this->ses_lang=='en'?'This password reset request link has already been used or expired so you can contact an administrator for further assistance.':'تم استخدام رابط طلب إعادة تعيين كلمة المرور هذا بالفعل أو انتهت صلاحيته ، لذا يمكنك الاتصال بالمسؤول للحصول على مزيد من المساعدة.';
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/reset-new-password',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }
    }

    public function save_reset_password(){
        if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                $insertedCustmrPassId = $this->CustomerModel->update_cust_pass_data($_POST['customer_id'],array(                                                                           
                    'customer_id' => $_POST['customer_id'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), 
                    "updated_at" => DATETIME
                ));
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Password Reset Successfully.':'إعادة تعيين كلمة المرور بنجاح.';
                $resp['redirectUrl'] = base_url('customer/login');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Password Is Required.':'كلمة المرور مطلوبة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function my_account(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = $this->ses_lang=='en'?'Set Customer New Password':'قم بتعيين كلمة مرور جديدة للعميل';
            $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
            if(isset($customerCartProducts) && !empty($customerCartProducts)){
                $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-account',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function faq(){     
        $this->pageData['pageTitle'] = 'FAQ';
        $this->pageData['faqList'] = $this->FaqModel->get_all_active_data();
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/faq/faqs',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function all_categories(){  
        $this->pageData['pageTitle'] = 'Product Category'; 
        $this->pageData['prodCatList'] = $this->ProdCatModel->get_all_active_data();        
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/product_category/all-categories',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }   
    }

    public function category_product_list($id){   
        if(isset($id) && !empty($id)){     
            $this->pageData['pageTitle'] = 'Product Details';
            $this->pageData['productList'] = $this->ProductModel->get_all_prod_categories($id); 
            $this->pageData['catDetails'] = $this->ProductModel->get_categories_details($id);
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){             
                $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                    $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
                } 
                
                $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
                if(isset($customerCartProducts) && !empty($customerCartProducts)){
                    $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                }  
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/product_category/category-product-list',$this->pageData); 
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Category Id Is Required.':'معرف الفئة مطلوب.';
            return json_encode($resp); exit;
        }       
    }

    public function my_profile(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'My Profile';
            $this->pageData['countryList'] = $this->CommonModel->get_all_country_data();
            if(isset($this->pageData['customerDetails']->country_id) && !empty($this->pageData['customerDetails']->country_id)){  
                $this->pageData['stateList'] = $this->CommonModel->get_country_states($this->pageData['customerDetails']->country_id);
                $this->pageData['cityList'] = $this->CommonModel->get_state_cities($this->pageData['customerDetails']->state_id);               
            }else{    
                $this->pageData['stateList'] = $this->CommonModel->get_country_states($this->pageData['customerDetails']->country_id);
                $this->pageData['cityList'] = $this->CommonModel->get_state_cities($this->pageData['customerDetails']->state_id);
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-profile',$this->pageData); 
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }
  
    public function update_my_profile(){        
        if(isset($_POST['profile_id']) && !empty($_POST['profile_id'])){
            if(isset($_POST['name']) && !empty($_POST['name'])){
                if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){     
                    if(isset($_POST['address']) && !empty($_POST['address'])){ 
                        if(isset($_POST['country_id']) && !empty($_POST['country_id'])){ 
                            if(isset($_POST['state_id']) && !empty($_POST['state_id'])){ 
                                if(isset($_POST['city_id']) && !empty($_POST['city_id'])){ 
                                    if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){ 
                                        $name	 = $this->request->getPost('name');
                                        $contact_no	 = $this->request->getPost('contact_no');
                                        $address	 = $this->request->getPost('address');
                                        $country_id	 = $this->request->getPost('country_id');
                                        $state_id	 = $this->request->getPost('state_id');
                                        $city_id	 = $this->request->getPost('city_id');  
                                        $zipcode	 = $this->request->getPost('zipcode'); 
                                        if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
                                            $path 				= 'uploads/customer_profile_picture/';
                                            $file 			    = $this->request->getFile('profile_image');
                                            $upload_file 	    = $this->uploadFile($path, $file); /* upload profile_picture image file */
                                            if(isset($upload_file) && !empty($upload_file)){
                                                /* update data  */
                                                $result = $this->CustomerModel->update_data($_POST['profile_id'],array(
                                                    "name" => isset($name)?$name:'',
                                                    "contact_no" => isset($contact_no)?$contact_no:'',
                                                    'profile_image' => $upload_file,
                                                    "address" => isset($address)?$address:'',
                                                    "country_id" => isset($country_id)?$country_id:'',
                                                    "state_id" => isset($state_id)?$state_id:'',
                                                    "city_id" => isset($city_id)?$city_id:'',
                                                    "zipcode" => isset($zipcode)?$zipcode:'',	
                                                    "updated_at" => DATETIME
                                                ));
                                                if(isset($result) && !empty($result)){ 
                                                    $resp['responseCode'] = 200;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Profile data Updated successfully.':'تم تحديث بيانات الملف الشخصي بنجاح.';
                                                    $resp['redirectUrl'] = base_url('customer/my-profile');
                                                    return json_encode($resp); exit;    
                                                }else{
                                                    $errorMsg = $this->ses_lang=='en'?'Error While Profile Insertion.':'خطأ أثناء إدراج ملف التعريف.';
                                                    if(file_exists('uploads/customer_profile_picture/'.$upload_file)){
                                                        unlink("uploads/customer_profile_picture/".$upload_file);
                                                    }else{
                                                        $errorMsg .= $this->ses_lang=='en'?' and profile image is not exist so can not deleted from folder':' وصورة الملف الشخصي غير موجودة لذا لا يمكن حذفها من المجلد';
                                                    }
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] = $errorMsg;
                                                    return json_encode($resp); exit;
                                                }                                             
                                            }else{
                                                $resp['responseCode'] = 500;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Uploading Profile Image.':'خطأ أثناء تحميل صورة الملف الشخصي.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $result = $this->CustomerModel->update_data($_POST['profile_id'],array(
                                                "name" => isset($name)?$name:'',
                                                "contact_no" => isset($contact_no)?$contact_no:'',
                                                "address" => isset($address)?$address:'',
                                                "country_id" => isset($country_id)?$country_id:'',
                                                "state_id" => isset($state_id)?$state_id:'',
                                                "city_id" => isset($city_id)?$city_id:'',
                                                "zipcode" => isset($zipcode)?$zipcode:'',	
                                                "updated_at" => DATETIME
                                            ));
                                            if(isset($result) && !empty($result)){ 
                                                $resp['responseCode'] = 200;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Profile Data Updated Successfully.':'تم تحديث بيانات الملف الشخصي بنجاح.';
                                                $resp['redirectUrl'] = base_url('customer/my-profile');
                                                return json_encode($resp); exit;    
                                            }else{
                                                $errorMsg = $this->ses_lang=='en'?'Error While Profile Insertion.':'خطأ أثناء إدراج ملف التعريف.';                                               
                                                $resp['responseCode'] = 500;
                                                $resp['responseMessage'] = $errorMsg;
                                                return json_encode($resp); exit;
                                            } 
                                        } 
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Zipcode Is Required.':'الرمز البريدي مطلوب.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'City Id Is Required.':'معرف المدينة مطلوب.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'State Id Is Required.':'معرف الولاية مطلوب.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'City Id Is Required.':'معرف المدينة مطلوب.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Address Is Required.':'العنوان مطلوب.';
                        return json_encode($resp); exit;
                    } 
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Contact No. Is Required.':'رقم الاتصال مطلوب.';
                    return json_encode($resp); exit;
                } 
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Name Is Required.':'مطلوب اسم.';
                return json_encode($resp); exit;
            }
        }
    }

    public function remove_profile_picture(){
        if(isset($_POST['customerid']) && !empty($_POST['customerid'])){           
            $result = $this->CustomerModel->delete_profile_picture($_POST['customerid']);
            if(isset($result)){                       
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Profile Picture Removed Successfully.':'تمت إزالة صورة الملف الشخصي بنجاح.';
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Removing Profile Picture.':'خطأ أثناء إزالة صورة الملف الشخصي.';
                return json_encode($resp); exit;
            }            
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
            return json_encode($resp); exit;
        }       
    }

    public function add_product_cart(){
        if(isset($_POST['productid']) && !empty($_POST['productid'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                $is_exist = $this->CartModel->chk_prod_exist_with_same_customer($_POST['productid'],$_POST['customerid']);
                if($is_exist==false){
                    $customerCartCount = $this->CartModel->insert_data_in_cart(array(
                        "customer_id" => $_POST['customerid'],
                        "product_id" => $_POST['productid'],
                        "created_at" => DATETIME
                    ));
                    if(is_int($customerCartCount)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Added Into Cart Successfully.':'تمت إضافة المنتج إلى عربة التسوق بنجاح.';
                        $resp['customerCartCount'] = $customerCartCount;
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Adding Product Into Cart.':'خطأ أثناء إضافة المنتج إلى عربة التسوق.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Already in Cart With Same Customer.':'المنتج موجود بالفعل في سلة التسوق مع نفس العميل.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function empty_cart(){
        if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
            $result = $this->CartModel->where(['customer_id'=>$_POST['customerid']])->delete();
            if(isset($result)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Empty Successfully.':'سلة التسوق فارغة بنجاح.';
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Making Empty Cart.':'خطأ أثناء عمل عربة فارغة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function remove_product_cart(){
        if(isset($_POST['productid']) && !empty($_POST['productid'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                $is_exist = $this->CartModel->chk_prod_exist_with_same_customer($_POST['productid'],$_POST['customerid']);
                if($is_exist==true){
                    $result = $this->CartModel->where(['customer_id'=>$_POST['customerid'],'product_id'=>$_POST['productid']])->delete();
                    if(isset($result)){
                        $customerCartCount = 0;
                        $customerCartProducts = $this->CartModel->get_single_customer_cart_products($_POST['customerid']);
                        if($customerCartProducts<>false){
                            $customerCartCount = count($customerCartProducts);
                        }
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Removed From Cart Successfully.':'تمت إزالة المنتج من عربة التسوق بنجاح.';
                        $resp['customerCartCount'] = $customerCartCount;
                        echo json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Removing Product From Cart.':'خطأ أثناء إزالة المنتج من عربة التسوق.';
                        echo json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Not in Cart.':'المنتج ليس في عربة التسوق.';
                    echo json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            echo json_encode($resp); exit;
        }
    }

    public function add_product_wishlist(){
        if(isset($_POST['productid']) && !empty($_POST['productid'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                $is_exist = $this->WishlistModel->chk_prod_exist_with_same_customer($_POST['productid'],$_POST['customerid']);
                if($is_exist==false){
                    $insertedId = $this->WishlistModel->insert_data_in_wishlist(array(
                        "customer_id" => $_POST['customerid'],
                        "product_id" => $_POST['productid'],
                        "created_at" => DATETIME
                    ));
                    if(is_int($insertedId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Added Into Wishlist Successfully.':'تمت إضافة المنتج إلى قائمة الرغبات بنجاح.';
                        echo json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Adding Product Into Wishlist.':'خطأ أثناء إضافة المنتج إلى قائمة الرغبات.';
                        echo json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Already in Wishlist With Same Customer.':'المنتج موجود بالفعل في قائمة الرغبات مع نفس العميل.';
                    echo json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product id is required.':'معرف المنتج مطلوب.';
            echo json_encode($resp); exit;
        }
    }

    public function buy_product(){
        if(isset($_POST['productid']) && !empty($_POST['productid'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                $cartBuyItem = array(
                    'productid'=>$_POST['productid'],
                    'customerid'=>$_POST['customerid']
                );
                $this->session->set('cartBuyItem', $cartBuyItem);
                $is_exist = $this->CartModel->chk_prod_exist_with_same_customer($_POST['productid'],$_POST['customerid']);
                if($is_exist==false && empty($is_exist)){
                    $insertedId = $this->CartModel->insert_data_in_cart(array(
                        "customer_id" => $_POST['customerid'],
                        "product_id" => $_POST['productid'],
                        "created_at" => DATETIME
                    ));
                    if(is_int($insertedId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Added Into Wishlist Successfully.':'تمت إضافة المنتج إلى قائمة الرغبات بنجاح.';
                        $resp['redirectUrl'] = base_url('customer/cart');
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Adding Product Into Wishlist.':'خطأ أثناء إضافة المنتج إلى قائمة الرغبات.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Already in Wishlist With Same Customer.':'المنتج موجود بالفعل في قائمة الرغبات مع نفس العميل.';
                    $resp['redirectUrl'] = base_url('customer/cart');
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function remove_product_wishlist(){
        if(isset($_POST['productid']) && !empty($_POST['productid'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                $is_exist = $this->WishlistModel->chk_prod_exist_with_same_customer($_POST['productid'],$_POST['customerid']);
                if($is_exist==true){
                    $result = $this->WishlistModel->where(['customer_id'=>$_POST['customerid'],'product_id'=>$_POST['productid']])->delete();
                    if(isset($result)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Removed From Wishlist Successfully.':'تمت إزالة المنتج من قائمة الرغبات بنجاح.';
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Removing Product From Wishlist.':'خطأ أثناء إزالة المنتج من قائمة الرغبات.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Not in Wishlist.':'المنتج ليس في قائمة الرغبات.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function change_password(){
        $this->pageData['pageTitle'] = 'Change Password';
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $getCurId = $this->ses_custmr_id;          
            if(isset($getCurId) && !empty($getCurId)){
                $this->pageData['getCurId'] = $getCurId;
            }
        }       
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/change-password',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function save_change_password(){ 
        if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                if(isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])){
                    if(isset($_POST['cnf_password']) && !empty($_POST['cnf_password'])){
                        $customer_id	= $this->request->getPost('customer_id'); 
                        $password = $this->request->getPost('password'); 
                        $oldpassword	= isset($_POST['oldpassword'])?$_POST['oldpassword']:''; 
                        $cnf_password = $this->request->getPost('cnf_password'); 
                        $verify_pass = $this->CustomerModel->chk_verify_password($customer_id);                    
                        $pass = $verify_pass[0]->password;
                        $verify_pass = password_verify($oldpassword, $pass);                    
                            if($verify_pass == '1') {                                   
                                $insertedCustmrPassId = $this->CustomerModel->update_cust_pass($customer_id,array(                                                                           
                                    'customer_id' => $customer_id,
                                    'password' => password_hash($this->request->getVar('cnf_password'), PASSWORD_DEFAULT), 
                                    "updated_at" => DATETIME
                                ));                               
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Password Change Successfully.':'تم تغيير كلمة المرور بنجاح.';
                                $resp['redirectUrl'] = base_url();
                                return json_encode($resp); exit; 
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Incorrect Credentials.':'أوراق غير صحيحة.';
                                return json_encode($resp); exit;
                            }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Confirm Password Is Required.':'تأكيد كلمة المرور مطلوب.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Old Password Is Required.':'مطلوب كلمة مرور قديمة.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Password Is Required.':'كلمة المرور مطلوبة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
            return json_encode($resp); exit;
        }       
    } 
    
    public function customerhelp(){  
        $this->pageData['pageTitle'] = 'Custome Help';
        $this->pageData['pageId'] = 4;
        $this->pageData['CusHelpData'] = '';
        $SettingModel = $this->SettingModel->get_store_setting_data();
        if(isset($SettingModel) && !empty($SettingModel)){
            $this->pageData['CusHelpData'] = $SettingModel;
        }
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/customer-help',$this->pageData);
        }else{
            return view('store/atzshop/index',$this->pageData);
        }
    }

    public function cart(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'Cart';
            $this->pageData['cartTotal'] = array(
                'subtotal'=>0,
                'total_price'=>0
            );
            $customerCartProducts = $this->CartModel->get_customer_cart_data($this->ses_custmr_id);
            if(isset($customerCartProducts) && !empty($customerCartProducts)){
                $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                foreach($customerCartProducts as $customerCartProductData){
                    $this->pageData['cartTotal']['subtotal'] += $customerCartProductData->product_price + $customerCartProductData->sales_tax;
                    /* $this->pageData['cartTotal']['taxtotal'] += $customerCartProductData->sales_tax; */
                }
                $this->pageData['cartTotal']['total_price'] = $this->pageData['cartTotal']['subtotal'];
            }
            $this->pageData['customerCartData'] = $this->CartModel->get_customer_cart_data($this->ses_custmr_id);
            $cartBuyItem = $this->session->get('cartBuyItem');
            if(isset($cartBuyItem) && !empty($cartBuyItem)){
                $snglProductInfo = $this->ProductModel->get_single_product_details($cartBuyItem['productid']);
                $this->pageData['cartTotal']['subtotal'] = $snglProductInfo->product_price + $snglProductInfo->sales_tax;
                /* $this->pageData['cartTotal']['taxtotal'] = $snglProductInfo->sales_tax; */
                $this->pageData['cartTotal']['total_price'] = $this->pageData['cartTotal']['subtotal'];
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/cart',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function applied_coupon_code(){
        if(isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])){
            if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
                if(isset($_POST['total_price']) && !empty($_POST['total_price'])){
                    $couponCodeStatus = $this->CouponModel->chk_coupon_code_valid($_POST['coupon_code'],$_POST['customer_id'],$_POST['total_price']);
                    if($couponCodeStatus['responseCode']==1){
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Code Invalid.':'رمز القسيمة غير صالح.';
                        return json_encode($resp); exit;
                    }elseif($couponCodeStatus['responseCode']==2){
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Code Not Valid/Expired.':'رمز القسيمة غير صالح / منتهي الصلاحية.';
                        return json_encode($resp); exit;
                    }elseif($couponCodeStatus['responseCode']==3){
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Already Redeemed.':'القسيمة مستردة بالفعل.';
                        return json_encode($resp); exit;
                    }elseif($couponCodeStatus['responseCode']==4){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Code Applied Successfully.':'تم تطبيق رمز القسيمة بنجاح.';
                        $resp['responseData'] = $couponCodeStatus['responseData'];
                        return json_encode($resp); exit;
                    }elseif($couponCodeStatus['responseCode']==5){
                        $min_amount = isset($couponCodeStatus['responseData']->min_amount)?$couponCodeStatus['responseData']->min_amount:'';
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Code is Valid On Cart Amount Above ':'كود الكوبون صالح على قيمة سلة التسوق أعلاه'.$min_amount;
                        $resp['responseData'] = $couponCodeStatus['responseData'];
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Total Price Is required.':'إجمالي سعر سلة التسوق مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer id Is required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Coupon Code Is required.':'كود الكوبون مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function proceed_cart(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'Checkout';
            $cartItemList = array();
            if(isset($_POST['index']) && !empty($_POST['index'])){
                $indextmp = array();
                $k = 0;
                foreach($_POST['index'] as $index){
                    $indextmp[$k] = array(
                        'product_id'=>$_POST['product_id'][$index],
                        'product_qty'=>$_POST['product_qty'][$index],
                        'product_price'=>$_POST['product_price'][$index],
                        'product_weight'=>$_POST['product_weight'][$index],
                        'sales_tax'=>$_POST['sales_tax'][$index]
                    );
                    $k++;
                }
                $cartItemList = $indextmp;
                $this->session->set('cartItemList', $cartItemList);
            }
            $this->pageData['countryList'] = $this->CommonModel->get_all_country_data(); 
            $this->pageData['customerAddressList'] = $this->CustomerAddressesModel->get_customer_address_list($this->ses_custmr_id);
            $this->pageData['cartTotal'] = array(
                "subtotal"=>$_POST['subtotal'],
                "is_coupon_applied"=>isset($_POST['is_coupon_applied'])?$_POST['is_coupon_applied']:0,
                "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                "total_price"=>$_POST['total_price']
            );
            $this->pageData['shippingCompanies'] = $this->ShippingModel->get_all_shipping_companies();
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/checkout',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function proceed_checkout(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            if(isset($_POST['subtotal']) && !empty($_POST['subtotal'])){
                if(isset($_POST['total_price']) && !empty($_POST['total_price'])){
                    if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
                        if(isset($_POST['customer_address_id']) && !empty($_POST['customer_address_id'])){
                            if(isset($_POST['ship_cmp_id']) && !empty($_POST['ship_cmp_id'])){
                                $this->pageData['pageTitle'] = 'Payment';
                                $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
                                if(isset($customerCartProducts) && !empty($customerCartProducts)){
                                    $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
                                }
                                $this->pageData['cartTotal'] = array(
                                    "subtotal"=>$_POST['subtotal'],
                                    "is_coupon_applied"=>isset($_POST['is_coupon_applied'])?$_POST['is_coupon_applied']:0,
                                    "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                    "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                    "total_price"=>isset($_POST['total_price'])?$_POST['total_price']:0,
                                    "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0,
                                    "customer_address_id"=>isset($_POST['customer_address_id'])?$_POST['customer_address_id']:0,
                                    "ship_cmp_id"=>isset($_POST['ship_cmp_id'])?$_POST['ship_cmp_id']:0
                                );
                                $this->pageData['availablePaymentGatewayList'] = $this->PaymentModel->get_available_payment_gateways();
                                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                    return view('store/'.$this->storeActvTmplName.'/customer/payment',$this->pageData);
                                }else{
                                    return view('store/atzshop/index',$this->pageData);
                                }
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Shipping Company Is Required.':'مطلوب شركة شحن.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Product Delivery Address Is Required.':'عنوان تسليم منتج العميل مطلوب.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Customer ID Is Required.':'الرقم التعريفي للعميل مطلوب.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Total Price Is Required.':'السعر الإجمالي مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Sub-Total Price Is Required.':'السعر الإجمالي الفرعي مطلوب.';
                return json_encode($resp); exit;
            }
            
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function proceed_payment(){
        if(isset($_POST['is_giftcard_purchasing']) && !empty($_POST['is_giftcard_purchasing'])){
            if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
                if(isset($_POST['gc_id']) && !empty($_POST['gc_id'])){
                    if(isset($_POST['total_price']) && !empty($_POST['total_price'])){
                        if(isset($_POST['payment_option']) && !empty($_POST['payment_option'])){
                            if($_POST['payment_option']==2){
                                if(isset($_POST['payment_gateway']) && !empty($_POST['payment_gateway'])){

                                    $paymentSettingInfo = $this->PaymentModel->get_pg_data($_POST['payment_gateway']);
                                    $paymentSettingData = unserialize($paymentSettingInfo->pay_cmp_data);
                                    $customerInfo = $this->CustomerModel->get_single_customer_data($this->ses_custmr_id);

                                    $profile_id = isset($paymentSettingData['profile_id'])?$paymentSettingData['profile_id']:'';
                                    $apikey = isset($paymentSettingData['apikey'])?$paymentSettingData['apikey']:'';
                                    $unique_order_reference = strtoupper(uniqid());
                                    $cart_currency = "SAR";
                                    $cart_amount = isset($_POST['total_price'])?$_POST['total_price']:0;
                                    $cart_description = "Description of the items/services";
                                    $callback = base_url('customer/proceed-payment');
                                    $return = base_url('customer/order-success');
                                    
                                    $paytabsinfo = array();
                                    $paytabsinfo['profile_id'] = $profile_id;
                                    $paytabsinfo['tran_type'] = 'sale';
                                    $paytabsinfo['tran_class'] = 'ecom';
                                    $paytabsinfo['cart_id'] = $unique_order_reference;
                                    $paytabsinfo['cart_currency'] = $cart_currency;
                                    $paytabsinfo['cart_amount'] = $cart_amount;
                                    $paytabsinfo['cart_description'] = $cart_description;
                                    $paytabsinfo['customer_details'] = array(
                                        "name"=>isset($customerInfo->name)?$customerInfo->name:'',
                                        "email"=> isset($customerInfo->email)?$customerInfo->email:'',
                                        "phone"=> isset($customerInfo->contact_no)?$customerInfo->contact_no:'',
                                        "street1"=> isset($customerInfo->address)?$customerInfo->address:'',
                                        "city"=> isset($customerInfo->city_name)?$customerInfo->city_name:'',
                                        "state"=> isset($customerInfo->state_name)?$customerInfo->state_name:'',
                                        "country"=> isset($customerInfo->country_name)?$customerInfo->country_name:'',
                                        "zip"=> isset($customerInfo->zipcode)?$customerInfo->zipcode:''
                                    );
                                    
                                    $paytabsinfo['callback'] = $callback;
                                    $paytabsinfo['return'] = $return;
                                    $paytabsinfo['hide_shipping'] = true;
                                    $paytabsinfo['tokenise'] = '2';
                                    $paytabsinfo['show_save_card'] = false;

                                    $paytabsinfo = json_encode($paytabsinfo); 

                                    $paytabs_url = 'https://secure.paytabs.sa/payment/request';
                                    $paytabs_apikey = $apikey;

                                    $paytabs_headr = array();
                                    $paytabs_headr[] = 'Content-Type: application/json';
                                    $paytabs_headr[] = 'Authorization: ' . $paytabs_apikey;
                                    $ch_p = curl_init();
                                    curl_setopt($ch_p, CURLOPT_URL, $paytabs_url);
                                    curl_setopt($ch_p, CURLOPT_POST, true);
                                    curl_setopt($ch_p, CURLOPT_POSTFIELDS, $paytabsinfo);
                                    curl_setopt($ch_p, CURLOPT_HTTPHEADER, $paytabs_headr);
                                    curl_setopt($ch_p, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch_p, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

                                    $paytabs_create_payment_page_response = curl_exec($ch_p); /* Send request. */
                                    $pg_resp_tmp = json_decode($paytabs_create_payment_page_response, TRUE);
                                    $pg_resp_tmp['ses_lang'] = $this->ses_lang=='en'?'en':'ar'; /*set session language before redirecting sequere url*/
                                    $paytabs_create_payment_page_response = json_encode($pg_resp_tmp);
                                    curl_close($ch_p);
                                    $paytab_res = json_decode($paytabs_create_payment_page_response, TRUE);
                                    if(isset($paytab_res['tran_ref']) && !empty($paytab_res['tran_ref'])){
                                        if ($paytab_res['tran_ref'] <> '') {

                                            $transaction_id = isset($paytab_res['tran_ref'])?$paytab_res['tran_ref']:'';
                                            $orderInfo = array(
                                                "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0,
                                                "is_giftcard_purchased"=>isset($_POST['is_giftcard_purchasing'])?$_POST['is_giftcard_purchasing']:0,
                                                "giftcard_id"=>isset($_POST['gc_id'])?$_POST['gc_id']:0,
                                                "giftcard_amount"=>isset($_POST['total_price'])?$_POST['total_price']:0,
                                                "total_price"=>isset($_POST['total_price'])?$_POST['total_price']:0,
                                                "payment_type"=>isset($_POST['payment_option'])?$_POST['payment_option']:0,
                                                "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                                "pg_id"=>isset($_POST['payment_gateway'])?$_POST['payment_gateway']:0,
                                                "pg_req"=>$paytabs_create_payment_page_response,
                                                "payment_status"=>2,
                                                "order_status"=>2,
                                                "is_active"=>2,
                                                "created_at"=> DATETIME
                                            );
                                            $insertedOrderId = $this->OrderModel->insert_data($orderInfo);
            
                                            if(is_int($insertedOrderId)){
                                                
                                                $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                                
                                                $redirectPGUrl = $paytab_res['redirect_url'];
                                                $resp['responseCode'] = 200;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Redirecting to payment gateway.':'إعادة التوجيه لبوابة الدفع.';
                                                $resp['redirectUrl'] = $redirectPGUrl;
                                                return json_encode($resp); exit;   
                                                
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                                return json_encode($resp); exit;
                                            }
                                        }
                                    }else{
                                        echo '<pre>'; print_r($paytab_res); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Choose Payment Gateway.':'اختر بوابة الدفع.';
                                    return json_encode($resp); exit;
                                }
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Payment Option Is Required.':'مطلوب خيار الدفع.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Total proce Is Required.':'السعر الإجمالي مطلوب.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Card Id Is Required.':'رقم بطاقة الهدايا مطلوب.';
                    return json_encode($resp); exit;
                }  
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
            
        }else{
            if(isset($_POST['customer_address_id']) && !empty($_POST['customer_address_id'])){
                if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
                    if(isset($_POST['subtotal']) && !empty($_POST['subtotal'])){
                        if(isset($_POST['total_price']) && !empty($_POST['total_price'])){
                            if(isset($_POST['payment_option']) && !empty($_POST['payment_option'])){
                                if($_POST['payment_option']==1){
                                    
                                    $orderInfo = array(
                                        "customer_id"=>$_POST['customer_id'],
                                        "is_coupon_applied"=>isset($_POST['is_coupon_applied'])?$_POST['is_coupon_applied']:0,
                                        "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                        "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                        "total_price"=>$_POST['total_price'],
                                        "customer_address_id"=>$_POST['customer_address_id'],
                                        "ship_cmp_id"=>$_POST['ship_cmp_id'],
                                        "payment_type"=>$_POST['payment_option'],
                                        "payment_status"=>2,
                                        "order_status"=>2,
                                        "is_active"=>1,
                                        "created_at"=> DATETIME
                                    );
                                    $this->session->set('orderInfo', $orderInfo);

                                    if(isset($_POST['is_coupon_applied']) && !empty($_POST['is_coupon_applied'])){
                                        $couponInfo = array(
                                            "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0,
                                            "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                            "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                            "created_at"=> DATETIME
                                        );
                                        $this->session->set('couponInfo', $couponInfo);
                                    }

                                    $resp['responseCode'] = 200;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Order Placed Successfully.':'تم تقديم الطلب بنجاح.';
                                    $resp['redirectUrl'] = base_url('/customer/order-success');
                                    return json_encode($resp); exit;

                                }elseif($_POST['payment_option']==2){
                                    if(isset($_POST['payment_gateway']) && !empty($_POST['payment_gateway'])){

                                        $cartItemList = $this->session->get('cartItemList');
                                        $cartBuyItem = $this->session->get('cartBuyItem');

                                        $paymentSettingInfo = $this->PaymentModel->get_pg_data($_POST['payment_gateway']);
                                        $paymentSettingData = unserialize($paymentSettingInfo->pay_cmp_data);
                                        $customerInfo = $this->CustomerModel->get_single_customer_data($this->ses_custmr_id);

                                        $profile_id = isset($paymentSettingData['profile_id'])?$paymentSettingData['profile_id']:'';
                                        $apikey = isset($paymentSettingData['apikey'])?$paymentSettingData['apikey']:'';
                                        $unique_order_reference = strtoupper(uniqid());
                                        $cart_currency = "SAR";
                                        $cart_amount = $_POST['total_price'];
                                        $cart_description = $this->ses_lang=='en'?"Description of the items/services":'وصف الأصناف / الخدمات';
                                        $callback = base_url('customer/order-success');
                                        $return = base_url('customer/order-success');
                                        
                                        $paytabsinfo = array();
                                        $paytabsinfo['profile_id'] = $profile_id;
                                        $paytabsinfo['tran_type'] = 'sale';
                                        $paytabsinfo['tran_class'] = 'ecom';
                                        $paytabsinfo['cart_id'] = 'cart_11111';
                                        $paytabsinfo['cart_currency'] = $cart_currency;
                                        $paytabsinfo['cart_amount'] = $cart_amount;
                                        $paytabsinfo['cart_description'] = $cart_description;
                                        $paytabsinfo['paypage_lang'] = "en";
                                        $paytabsinfo['customer_details'] = array(
                                            "name"=>isset($customerInfo->name)?$customerInfo->name:'',
                                            "email"=> isset($customerInfo->email)?$customerInfo->email:'',
                                            "phone"=> isset($customerInfo->contact_no)?$customerInfo->contact_no:'',
                                            "street1"=> isset($customerInfo->address)?$customerInfo->address:'',
                                            "city"=> isset($customerInfo->city_name)?$customerInfo->city_name:'',
                                            "state"=> isset($customerInfo->state_name)?$customerInfo->state_name:'',
                                            "country"=> isset($customerInfo->country_name)?$customerInfo->country_name:'',
                                            "zip"=> isset($customerInfo->zipcode)?$customerInfo->zipcode:''
                                        );
                                        $paytabsinfo['callback'] = $callback;
                                        $paytabsinfo['return'] = $return;
                                        $paytabsinfo['hide_shipping'] = true;
                                        $paytabsinfo['tokenise'] = '2';
                                        $paytabsinfo['show_save_card'] = false;

                                        $paytabsinfo = json_encode($paytabsinfo); 
                                        $paytabs_url = 'https://secure.paytabs.sa/payment/request';
                                        $paytabs_apikey = $apikey;

                                        $paytabs_headr = array();
                                        $paytabs_headr[] = 'Content-Type: application/json';
                                        $paytabs_headr[] = 'Authorization: ' . $paytabs_apikey;
                                        $ch_p = curl_init();
                                        curl_setopt($ch_p, CURLOPT_URL, $paytabs_url);
                                        curl_setopt($ch_p, CURLOPT_POST, true);
                                        curl_setopt($ch_p, CURLOPT_POSTFIELDS, $paytabsinfo);
                                        curl_setopt($ch_p, CURLOPT_HTTPHEADER, $paytabs_headr);
                                        curl_setopt($ch_p, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($ch_p, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                        
                                        $paytabs_create_payment_page_response = curl_exec($ch_p); /* Send request. */
                                        $pg_resp_tmp = json_decode($paytabs_create_payment_page_response, TRUE);
                                        $pg_resp_tmp['ses_lang'] = $this->ses_lang=='en'?'en':'ar'; /*set session language before redirecting sequere url*/
                                        $paytabs_create_payment_page_response = json_encode($pg_resp_tmp);
                                        curl_close($ch_p);
                                        $paytab_res = json_decode($paytabs_create_payment_page_response, TRUE);
                                        if(isset($paytab_res['tran_ref']) && !empty($paytab_res['tran_ref'])){
                                            if ($paytab_res['tran_ref'] <> '') {
                                                
                                                $transaction_id = isset($paytab_res['tran_ref'])?$paytab_res['tran_ref']:'';
                                                $orderInfo = array(
                                                    "customer_id"=>$_POST['customer_id'],
                                                    "is_coupon_applied"=>isset($_POST['is_coupon_applied'])?$_POST['is_coupon_applied']:0,
                                                    "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                                    "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                                    "total_price"=>$_POST['total_price'],
                                                    "customer_address_id"=>$_POST['customer_address_id'],
                                                    "ship_cmp_id"=>$_POST['ship_cmp_id'],
                                                    "payment_type"=>$_POST['payment_option'],
                                                    "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                                    "pg_id"=>$_POST['payment_gateway'],
                                                    "pg_req"=>$paytabs_create_payment_page_response,
                                                    "order_status"=>2,
                                                    "is_active"=>2,
                                                    "created_at"=> DATETIME
                                                );
                                                $insertedOrderId = $this->OrderModel->insert_data($orderInfo);
                
                                                if(is_int($insertedOrderId)){
                                                    if(isset($_POST['is_coupon_applied']) && !empty($_POST['is_coupon_applied'])){
                                                        /* insert utilized coupon info */
                                                        $insrdUtlzdCpnId = $this->CouponModel->insert_utilized_coupon_data(array(
                                                            "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0,
                                                            "order_id"=>isset($insertedOrderId)?$insertedOrderId:0,
                                                            "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                                            "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                                            "created_at"=> DATETIME
                                                        ));
                                                        if(!is_int($insrdUtlzdCpnId)){
                                                            $resp['responseCode'] = 400;
                                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting utilized coupon details.':'خطأ أثناء إدخال تفاصيل القسيمة المستخدمة.';
                                                            return json_encode($resp); exit;
                                                        }
                                                    }
                                                    $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                                    
                                                    $cartItemList = $this->session->get('cartItemList');
                                                    if(isset($cartItemList) && !empty($cartItemList)){
                                                        $insStatus = false;
                                                        foreach($cartItemList as $cartItemData){
                                                            /* insert order items info */
                                                            $insertedOrderItemId = $this->OrderModel->insert_order_item_data(array(
                                                                "order_id"=>$insertedOrderId,
                                                                "product_id"=>isset($cartItemData['product_id'])?$cartItemData['product_id']:'',
                                                                "product_qty"=>isset($cartItemData['product_qty'])?$cartItemData['product_qty']:'',
                                                                "qty_price"=>isset($cartItemData['product_price'])?$cartItemData['product_price']:'',
                                                                "qty_sales_tax"=>isset($cartItemData['sales_tax'])?$cartItemData['sales_tax']:'',
                                                                "created_at"=> DATETIME
                                                            ));
                                                            if(is_int($insertedOrderItemId)){
                                                                $insStatus = true;
                                                                
                                                            }
                                                        }
                                                        if(isset($insStatus) && $insStatus==true){
                                                            $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                                            
                                                            /* set cookei for ses_lang veriable */
                                                                // $cookieName = 'cookie_ses_lang';
                                                                // $cookieValue = $this->ses_lang=='en'?'en':'ar';
                                                                // $now = date("Y-m-d H:i:s");
                                                                // $cookieExpiresTime= strtotime($now.' + 5 minute');

                                                                // $cookie_name = "cookie_ses_lang";
                                                                // $cookie_value = $this->ses_lang=='en'?'en':'ar';
                                                                // //echo '<pre>'; print_r($cookie_value);  
                                                                // setcookie("cookie_ses_lang", $cookie_value, time()+3600);  /* expire in 1 hour */
                                                                //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                                                                //echo '<pre>'; print_r($_COOKIE['cookie_ses_lang']); exit;
                                                                // $cookie= array(
                                                                //     'name'   => 'cookie_ses_lang',
                                                                //     'value'  => $this->ses_lang=='en'?'en':'ar',
                                                                //     'expire' => '3600',
                                                                //     'secure' => false,
                                                                //     'httpOnly' => false
                                                                // );
                                                                // set_cookie($cookie);

                                                            /* end  set cookei for ses_lang veriable */

                                                            $redirectPGUrl = $paytab_res['redirect_url'];
                                                            $resp['responseCode'] = 200;
                                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Redirecting to payment gateway.':'إعادة التوجيه لبوابة الدفع.';
                                                            $resp['redirectUrl'] = $redirectPGUrl;
                                                            return json_encode($resp); exit;
                                                        }else{
                                                            $resp['responseCode'] = 500;
                                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order items.':'خطأ أثناء إدخال عناصر الطلب.';
                                                            return json_encode($resp); exit;
                                                        }
                                                    }else{
                                                        $resp['responseCode'] = 400;
                                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                                        return json_encode($resp); exit;
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                        }else{
                                            echo '<pre>'; print_r($paytab_res); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 400;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Choose Payment Gateway.':'اختر بوابة الدفع.';
                                        return json_encode($resp); exit;
                                    }
                                }elseif($_POST['payment_option']==3){
                                    if(isset($_POST['giftcard_code']) && !empty($_POST['giftcard_code'])){
                                        if(isset($_POST['is_giftcard_applied']) && !empty($_POST['is_giftcard_applied'])){
                                            if(isset($_POST['giftcard_id']) && !empty($_POST['giftcard_id'])){
                                                if(isset($_POST['giftcard_prchsed_id']) && !empty($_POST['giftcard_prchsed_id'])){
                                                    if(isset($_POST['giftcard_amount']) && !empty($_POST['giftcard_amount'])){
                                                        
                                                        $orderInfo = array(
                                                            "customer_id"=>$_POST['customer_id'],
                                                            "is_coupon_applied"=>isset($_POST['is_coupon_applied'])?$_POST['is_coupon_applied']:0,
                                                            "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                                            "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                                            "giftcard_code"=>isset($_POST['giftcard_code'])?$_POST['giftcard_code']:0,
                                                            "is_giftcard_applied"=>isset($_POST['is_giftcard_applied'])?$_POST['is_giftcard_applied']:0,
                                                            "giftcard_id"=>isset($_POST['giftcard_id'])?$_POST['giftcard_id']:0,
                                                            "giftcard_prchsed_id"=>isset($_POST['giftcard_prchsed_id'])?$_POST['giftcard_prchsed_id']:0,
                                                            "giftcard_amount"=>isset($_POST['giftcard_amount'])?$_POST['giftcard_amount']:0,
                                                            "total_price"=>$_POST['total_price'],
                                                            "customer_address_id"=>$_POST['customer_address_id'],
                                                            "ship_cmp_id"=>$_POST['ship_cmp_id'],
                                                            "payment_type"=>$_POST['payment_option'],
                                                            "payment_status"=>1,
                                                            "order_status"=>2,
                                                            "is_active"=>1,
                                                            "created_at"=> DATETIME
                                                        );
                                                        $this->session->set('orderInfo', $orderInfo);

                                                        if(isset($_POST['is_coupon_applied']) && !empty($_POST['is_coupon_applied'])){
                                                            $couponInfo = array(
                                                                "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0,
                                                                "coupon_id"=>isset($_POST['coupon_id'])?$_POST['coupon_id']:0,
                                                                "coupon_amount"=>isset($_POST['coupon_amount'])?$_POST['coupon_amount']:0,
                                                                "created_at"=> DATETIME
                                                            );
                                                            $this->session->set('couponInfo', $couponInfo);
                                                        }

                                                        $resp['responseCode'] = 200;
                                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Order Placed Successfully.':'تم تقديم الطلب بنجاح.';
                                                        $resp['redirectUrl'] = base_url('/customer/order-success');
                                                        return json_encode($resp); exit;

                                                    }else{
                                                        $resp['responseCode'] = 400;
                                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Cart Amount Not Set.':'لم يتم تحديد مبلغ عربة الهدايا.';
                                                        return json_encode($resp); exit;
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Cart Purchased Id Not Set.':'لم يتم تعيين معرّف شراء بطاقة الهدايا.';
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Cart Id Not Set.':'لم يتم تعيين معرف سلة الهدايا.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 400;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Cart Check Not Set.':'لم يتم تعيين شيك بطاقة الهدايا.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 400;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Cart Code Not Set.':'لم يتم تعيين رمز بطاقة الهدايا.';
                                        return json_encode($resp); exit;
                                    }
                                }
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Payment Option Is Required.':'مطلوب خيار الدفع.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Total proce Is Required.':'السعر الإجمالي مطلوب.';
                            return json_encode($resp); exit;
                        }
                            
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Subtotal Is Required.':'مطلوب المجموع الفرعي.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Address Id Is Required.':'معرف عنوان العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }
    }

    public function purchase_giftcard(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'Payment';
            $this->pageData['cartTotal'] = array(
                "is_giftcard_purchasing"=>isset($_POST['is_giftcard_purchasing'])?$_POST['is_giftcard_purchasing']:0,
                "gc_id"=>isset($_POST['gc_id'])?$_POST['gc_id']:0,
                "total_price"=>isset($_POST['gc_amount'])?$_POST['gc_amount']:0,
                "customer_id"=>isset($_POST['customer_id'])?$_POST['customer_id']:0
            );
            $this->pageData['availablePaymentGatewayList'] = $this->PaymentModel->get_available_payment_gateways();
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/payment',$this->pageData);
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function order_success(){
        $this->pageData['pageTitle'] = 'Order Success';
        $server_site_path = base_url(); 
        $PayTabsResponseStatus = array('C','H','P','V','E','D');
        if(isset($_REQUEST['respStatus']) && !empty($_REQUEST['respStatus'])){
            $PayTabsResponseStatus = in_array($_REQUEST['respStatus'],$PayTabsResponseStatus);
        }
        if(isset($_REQUEST['tranRef']) && $_REQUEST['respStatus']=='A'){
            $orderData = $this->OrderModel->get_single_order_details_by_tran_ref($_REQUEST['tranRef']);
            if(empty($orderData['orderInfo'])){
                $orderData = $this->OrderModel->get_single_order_details_by_tran_ref_only($_REQUEST['tranRef']);
                $orderInfo = isset($orderData['orderInfo'])?$orderData['orderInfo']:'';
                
                /* get payment gateway request ses_lang value start */
                    $pg_req = json_decode($orderInfo->pg_req,TRUE);
                    $ses_data = [
                        'ses_lang'       => $pg_req['ses_lang'],
                        'lang_session'     => TRUE
                    ];
                    $this->session->set($ses_data);
                    $this->lang_session = $this->session->get('lang_session');
                    $this->ses_lang = $this->session->get('ses_lang');
                    $this->pageData['locale'] = $this->ses_lang;
                    if($this->pageData['locale']=='ar'){
                        $this->pageData['language'] = language($this->pageData['locale']);
                    }elseif($this->pageData['locale']=='en'){
                        $this->pageData['language'] = language($this->pageData['locale']);
                    }
                /* get payment gateway request ses_lang value end */

                /* forcefully doing customer loggedIn session */
                $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                $ses_data = [
                    'ses_custmr_id'       => $customerDetails['id'],
                    'ses_custmr_name'     => $customerDetails['name'],
                    'ses_custmr_email'    => $customerDetails['email'],
                    'ses_logged_in'     => TRUE
                ];
                $this->session->set($ses_data);
                $orderTrackingData = array(
                    'tranRef'=>isset($_REQUEST['tranRef'])?$_REQUEST['tranRef']:'',
                    'trackingId'=>isset($orderInfo->shipping_id)?$orderInfo->shipping_id:''
                );
                $this->pageData['orderTrackingData'] = $orderTrackingData;
                $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderInfo->id);
                $this->pageData['customerDetails'] = $customerDetails;
                $this->pageData['orderStatusCode'] = 200;
                $orderMessage = $this->ses_lang=='en'?'Your Order Is Already Successfully Placed, Please Check In Your My Order Section.':'تم تقديم طلبك بالفعل بنجاح ، يرجى التحقق من قسم طلبي.';
                $this->pageData['orderMessage'] = $orderMessage;
                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                    return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);
                }else{
                    return view('store/atzshop/index',$this->pageData);
                }
            }else{
                $orderInfo = isset($orderData['orderInfo'])?$orderData['orderInfo']:'';
                $cartItemList = isset($orderData['orderProductItemsInfo'])?$orderData['orderProductItemsInfo']:'';
                $pg_res = json_encode($_REQUEST);
                if(isset($orderInfo->is_giftcard_purchased) && $orderInfo->is_giftcard_purchased==1){
                    
                    $egift_code = uniqid();
                    $this->session->remove('orderInfo');
                    $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                    $insertedGcPurchaseId = $this->GiftCardModel->insert_customer_giftcard(array(
                        "order_id"=>isset($orderInfo->id)?$orderInfo->id:0,
                        "customer_id"=>isset($orderInfo->customer_id)?$orderInfo->customer_id:0,
                        "gc_id"=>isset($orderInfo->giftcard_id)?$orderInfo->giftcard_id:0,
                        "egift_code"=>isset($egift_code)?$egift_code:'',
                        "gc_amount"=>isset($orderInfo->total_price)?$orderInfo->total_price:0,
                        "gc_balance"=>isset($orderInfo->total_price)?$orderInfo->total_price:0,
                        "gc_status"=>1,
                        "is_active"=>1,
                        "created_at"=>DATETIME
                    ));
                    if(is_int($insertedGcPurchaseId)){

                        $requestData = array(
                            "giftcard_prchsed_id"=>$insertedGcPurchaseId,
                            "giftcard_amount"=>isset($orderInfo->total_price)?$orderInfo->total_price:0,
                            "pg_res"=>isset($pg_res)?$pg_res:'',
                            "payment_status"=>1,
                            "order_status"=>1,
                            "is_active"=>1,
                            "updated_at"=> DATETIME
                        );
                        
                        /* insert order info */
                        $affectedOrderId = $this->OrderModel->update_data($orderInfo->id,$requestData);
        
                        if(is_int($affectedOrderId)){
                            /* get payment gateway request ses_lang value start */
                                $pg_req = json_decode($orderInfo->pg_req,TRUE);
                                $ses_data = [
                                    'ses_lang'       => $pg_req['ses_lang'],
                                    'lang_session'     => TRUE
                                ];
                                $this->session->set($ses_data);
                                $this->lang_session = $this->session->get('lang_session');
                                $this->ses_lang = $this->session->get('ses_lang');
                                $this->pageData['locale'] = $this->ses_lang;
                                if($this->pageData['locale']=='ar'){
                                    $this->pageData['language'] = language($this->pageData['locale']);
                                }elseif($this->pageData['locale']=='en'){
                                    $this->pageData['language'] = language($this->pageData['locale']);
                                }
                            /* get payment gateway request ses_lang value end */
                            /* forcefully doing customer loggedIn session */
                            $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                            $ses_data = [
                                'ses_custmr_id'       => $customerDetails['id'],
                                'ses_custmr_name'     => $customerDetails['name'],
                                'ses_custmr_email'    => $customerDetails['email'],
                                'ses_logged_in'     => TRUE
                            ];
                            $this->session->set($ses_data);
                            
                            $transaction_id = $_REQUEST['tranRef'];
                            $orderTrackingData = array(
                                'tranRef'=>isset($transaction_id)?$transaction_id:''
                            );
                            $this->pageData['orderTrackingData'] = $orderTrackingData;

                            $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderInfo->id);
                            /* Notification Code For Gift Card Purchased Start*/
                            $GiftCardsOrder = base_url('admin/all-orders'); 
                            $this->NotificationsModel->insert_data(array(                                                                           
                                "type_id" => 4,
                                "is_seen" => 0,                                  
                                "reff_link" => isset($GiftCardsOrder)?$GiftCardsOrder:'',    
                                "created_at" => DATETIME
                            ));
                            /* Notification Code For Gift Card Purchased End*/
                                    
                            /* Email Sending For Customer Code For Gift Card Purchased start*/  
                                $templateName = $this->storeActvTmplName;
                                $sociaFB = 'javascript:void(0);';
                                $socialTwitter = 'javascript:void(0);';
                                $socialYoutube = 'javascript:void(0);';
                                $socialLinkedin = 'javascript:void(0);';
                                $socialInstagram = 'javascript:void(0);';  
                                $storeName = '';
                                $address = '';
                                $supportEmail = '';                          
                                $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                    if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                        $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                        $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                        $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                        $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                        $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                        $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                        $address = $this->pageData['storeSettingInfo']->address;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                        $storeName = $this->pageData['storeSettingInfo']->name;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                        $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                    }
                                }
                                $this->pageData['storeLogo'] = $store_logo;
                                $this->pageData['templateName'] = $templateName;
                                $this->pageData['sociaFB'] = $sociaFB;
                                $this->pageData['socialTwitter'] = $socialTwitter;
                                $this->pageData['socialYoutube'] = $socialYoutube;
                                $this->pageData['socialLinkedin'] = $socialLinkedin;
                                $this->pageData['socialInstagram'] = $socialInstagram;
                                $this->pageData['storeName'] = $storeName;
                                $this->pageData['address'] = $address;
                                $this->pageData['supportEmail'] = $supportEmail;                               
                                $email	= $customerDetails['email'];                
                                $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-gc-purchase',$this->pageData);
                                $subject ='Gift Card Purchase Order Placed Sucessfully';
                                $sendEmail = $this->sendEmail($email,$mailBody,$subject);    
                            /* Email Sending For Customer Code For Gift Card Purchased End*/                           
                            $this->pageData['customerDetails'] = $customerDetails;
                            
                            $orderMessage = $this->ses_lang=='en'?'Congratulations! Giftcard Purchased Successfully.':'تهانينا! بطاقة الهدايا تم شراؤها بنجاح.';
                            
                            $this->pageData['orderStatusCode'] = 200;
                            $this->pageData['orderMessage'] = $orderMessage;
                            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);
                            }else{
                                return view('store/atzshop/index',$this->pageData);
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error While purchasing giftcard.':'خطأ أثناء شراء بطاقة الهدايا.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error while purchacing giftcard.':'خطأ أثناء شراء بطاقة الهدايا.';
                        return json_encode($resp); exit;
                    }
                }else{
                    if(isset($this->pageData['storeSettingInfo']->default_shipping) && $this->pageData['storeSettingInfo']->default_shipping==1){
                        $matjaryShippingInfoApi = $this->callAPI('GET', 'https://www.matjary.in/shipping-info', '');
                        $clientInfo = json_decode($matjaryShippingInfoApi, true);

                        if(isset($clientInfo['responseCode']) && $clientInfo['responseCode']==200){
                            $shipCmpInfo = $clientInfo['responseData'];
                            
                            $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                            $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                            $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                            $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                            $ShippingDateTime = round(microtime(true) * 1000);
                            usleep(100);
                            $DueDate = round(microtime(true) * 1000);

                            $CashOnDeliveryAmount = isset($orderInfo->total_price)?$orderInfo->total_price:null;
                            
                            $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                            $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                            
                            $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo->customer_address_id,$orderInfo->customer_id);
                            $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                            $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                            $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                            $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                            $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';

                            $totalProductsWeight = 0;
                            $NumberOfPieces = 0;
                            if(isset($cartItemList) && !empty($cartItemList)){
                                foreach($cartItemList as $cartItemData){
                                    $totalProductsWeight += number_format((float)$cartItemData->product_weight, 2, '.', '');
                                    $NumberOfPieces += $cartItemData->product_qty;
                                }
                            }
                            
                            $Services = '';
                            if($orderInfo->payment_type==1){
                                $Services='CODS';
                            }elseif($orderInfo->payment_type==2){
                                $Services='';
                            }elseif($orderInfo->payment_type==3){
                                $Services='';
                            }

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>'{
                                "ClientInfo": {
                                    "UserName": "'.$UserName.'",
                                    "Password": "'.$Password.'",
                                    "Version": "v1",
                                    "AccountNumber": "'.$AccountNumber.'",
                                    "AccountPin": "'.$AccountPin.'",
                                    "AccountEntity": "RUH",
                                    "AccountCountryCode": "SA",
                                    "Source": 24
                                },
                                "LabelInfo": null,
                                "Shipments": [
                                    {
                                        "Reference1": "",
                                        "Reference2": "",
                                        "Reference3": "",
                                        "Shipper": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "Riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "aramex",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "00966551511111",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "Consignee": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "",
                                            "PartyAddress": {
                                                "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": "",
                                                "BuildingName": "",
                                                "Floor": "",
                                                "Apartment": "",
                                                "POBox": null,
                                                "Description": ""
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                "Type": ""
                                            }
                                        },
                                        "ThirdParty": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                "Line3": "Saudi Arabia",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "TEST",
                                                "Title": "",
                                                "CompanyName": "",
                                                "PhoneNumber1": "966512345678",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "966512345678",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                        "DueDate": "\\/Date('.$DueDate.')\\/",
                                        "Comments": "",
                                        "PickupLocation": "",
                                        "OperationsInstructions": "",
                                        "AccountingInstrcutions": "",
                                        "Details": {
                                            "Dimensions": null,
                                            "ActualWeight": {
                                                "Unit": "KG",
                                                "Value": "'.$totalProductsWeight.'"
                                            },
                                            "ChargeableWeight": null,
                                            "DescriptionOfGoods": "product description",
                                            "GoodsOriginCountry": "SA",
                                            "NumberOfPieces": '.$NumberOfPieces.',
                                            "ProductGroup": "DOM",
                                            "ProductType": "CDS",
                                            "PaymentType": "P",
                                            "PaymentOptions": "",
                                            "CustomsValueAmount": null,
                                            "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                            "InsuranceAmount": null,
                                            "CashAdditionalAmount": null,
                                            "CashAdditionalAmountDescription": "",
                                            "CollectAmount": null,
                                            "Services": "'.$Services.'",
                                            "Items": []
                                        },
                                        "Attachments": [],
                                        "ForeignHAWB": "",
                                        "TransportType ": 0,
                                        "PickupGUID": "",
                                        "Number": null,
                                        "ScheduledDelivery": null
                                    }
                                ],
                                "Transaction": {
                                    "Reference1": "",
                                    "Reference2": "",
                                    "Reference3": "",
                                    "Reference4": "",
                                    "Reference5": ""
                                }
                            }',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Accept: application/json'
                            ),
                            ));
                            $apiAramexShippingRequest = '{
                                "ClientInfo": {
                                    "UserName": "'.$UserName.'",
                                    "Password": "'.$Password.'",
                                    "Version": "v1",
                                    "AccountNumber": "'.$AccountNumber.'",
                                    "AccountPin": "'.$AccountPin.'",
                                    "AccountEntity": "RUH",
                                    "AccountCountryCode": "SA",
                                    "Source": 24
                                },
                                "LabelInfo": null,
                                "Shipments": [
                                    {
                                        "Reference1": "",
                                        "Reference2": "",
                                        "Reference3": "",
                                        "Shipper": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "Riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "aramex",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "00966551511111",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "Consignee": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "",
                                            "PartyAddress": {
                                                "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": "",
                                                "BuildingName": "",
                                                "Floor": "",
                                                "Apartment": "",
                                                "POBox": null,
                                                "Description": ""
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                "Type": ""
                                            }
                                        },
                                        "ThirdParty": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                "Line3": "Saudi Arabia",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "TEST",
                                                "Title": "",
                                                "CompanyName": "",
                                                "PhoneNumber1": "966512345678",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "966512345678",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                        "DueDate": "\\/Date('.$DueDate.')\\/",
                                        "Comments": "",
                                        "PickupLocation": "",
                                        "OperationsInstructions": "",
                                        "AccountingInstrcutions": "",
                                        "Details": {
                                            "Dimensions": null,
                                            "ActualWeight": {
                                                "Unit": "KG",
                                                "Value": "'.$totalProductsWeight.'"
                                            },
                                            "ChargeableWeight": null,
                                            "DescriptionOfGoods": "product description",
                                            "GoodsOriginCountry": "SA",
                                            "NumberOfPieces": '.$NumberOfPieces.',
                                            "ProductGroup": "DOM", 
                                            "ProductType": "CDS",
                                            "PaymentType": "P",
                                            "PaymentOptions": "",
                                            "CustomsValueAmount": null,
                                            "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                            "InsuranceAmount": null,
                                            "CashAdditionalAmount": null,
                                            "CashAdditionalAmountDescription": "",
                                            "CollectAmount": null,
                                            "Services": "'.$Services.'",
                                            "Items": []
                                        },
                                        "Attachments": [],
                                        "ForeignHAWB": "",
                                        "TransportType ": 0,
                                        "PickupGUID": "",
                                        "Number": null,
                                        "ScheduledDelivery": null
                                    }
                                ],
                                "Transaction": {
                                    "Reference1": "",
                                    "Reference2": "",
                                    "Reference3": "",
                                    "Reference4": "",
                                    "Reference5": ""
                                }
                            }';
                            
                            $apiAramexShippingResponse = curl_exec($curl);
                            curl_close($curl);
                            $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                            $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                            if(isset($shipmentId) && !empty($shipmentId)){
                                $pg_res = json_encode($_REQUEST);
                                $requestData = array(
                                    "customer_id"=>isset($orderInfo->customer_id)?$orderInfo->customer_id:0,
                                    "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                    "pg_res"=>isset($pg_res)?$pg_res:'',
                                    "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                    "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                    "payment_status"=>1,
                                    "is_active"=>1,
                                    "updated_at"=> DATETIME
                                );
                                /* insert order info */
                                $affectedOrderId = $this->OrderModel->update_data($orderInfo->id,$requestData);

                                if(is_int($affectedOrderId)){
                                    $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                    $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        $insStatus = false;
                                        foreach($cartItemList as $cartItemData){
                                            /* get product stock quantity */
                                            $productRow = $this->ProductModel->find($cartItemData->product_id);
                                            $stock_quantity = $productRow['stock_quantity'] - $cartItemData->product_qty;
                                            /* update product stock quantity */
                                            $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData->product_id,array(
                                                "stock_quantity"=>$stock_quantity
                                            ));
                                            if(!is_int($affectedId)){
                                                $insStatus = false;
                                            }
                                            /* remove product from customer cart  */
                                            $removedProdCartStatus = $this->OrderModel->remove_product_from_customer_cart($cartItemData->product_id,$orderInfo->customer_id);
                                        }
                                        
                                        $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                        /* get payment gateway request ses_lang value start */
                                            $pg_req = json_decode($orderInfo->pg_req,TRUE);
                                            $ses_data = [
                                                'ses_lang'       => $pg_req['ses_lang'],
                                                'lang_session'     => TRUE
                                            ];
                                            $this->session->set($ses_data);
                                            $this->lang_session = $this->session->get('lang_session');
                                            $this->ses_lang = $this->session->get('ses_lang');
                                            $this->pageData['locale'] = $this->ses_lang;
                                            if($this->pageData['locale']=='ar'){
                                                $this->pageData['language'] = language($this->pageData['locale']);
                                            }elseif($this->pageData['locale']=='en'){
                                                $this->pageData['language'] = language($this->pageData['locale']);
                                            }
                                        /* get payment gateway request ses_lang value end */
                                        /* forcefully doing customer loggedIn session */
                                        $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                                        $ses_data = [
                                            'ses_custmr_id'       => $customerDetails['id'],
                                            'ses_custmr_name'     => $customerDetails['name'],
                                            'ses_custmr_email'    => $customerDetails['email'],
                                            'ses_logged_in'     => TRUE
                                        ];
                                        $this->session->set($ses_data);
                                        $orderTrackingData = array(
                                            'tranRef'=>isset($_REQUEST['tranRef'])?$_REQUEST['tranRef']:'',
                                            'trackingId'=>isset($shipmentId)?$shipmentId:''
                                        );
                                        $this->pageData['orderTrackingData'] = $orderTrackingData;
                                        $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderInfo->id);
                                        
                                        /* Notification Code For order palced Start*/
                                        $ordersGrid = base_url('admin/all-orders'); 
                                        $this->NotificationsModel->insert_data(array(                                                                           
                                            "type_id" => 2,
                                            "is_seen" => 0,                                  
                                            "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                            "created_at" => DATETIME
                                        ));
                                        /* Notification Code For order palced  End*/  

                                        /* Email Sending For Customer Code start*/  
                                        $templateName = $this->storeActvTmplName;
                                        $sociaFB = 'javascript:void(0);';
                                        $socialTwitter = 'javascript:void(0);';
                                        $socialYoutube = 'javascript:void(0);';
                                        $socialLinkedin = 'javascript:void(0);';
                                        $socialInstagram = 'javascript:void(0);';  
                                        $storeName = '';
                                        $address = '';
                                        $supportEmail = '';  
                                        $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                        if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                            if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                $address = $this->pageData['storeSettingInfo']->address;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                $storeName = $this->pageData['storeSettingInfo']->name;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                            }
                                        }  
                                        $this->pageData['storeLogo'] = $store_logo;
                                        $this->pageData['templateName'] = $templateName;
                                        $this->pageData['sociaFB'] = $sociaFB;
                                        $this->pageData['socialTwitter'] = $socialTwitter;
                                        $this->pageData['socialYoutube'] = $socialYoutube;
                                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                                        $this->pageData['socialInstagram'] = $socialInstagram;
                                        $this->pageData['cusName'] = $customerDetails['name'];
                                        $this->pageData['storeName'] = $storeName;
                                        $this->pageData['address'] = $address;
                                        $this->pageData['supportEmail'] = $supportEmail;
                                        $email	= $customerDetails['email'];          
                                        $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                        $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);    
                                        /* Email Sending For Customer Code For Gift Card Purchased End*/ 
                                        $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';
                                        
                                        $this->pageData['orderStatusCode'] = 200;
                                        $this->pageData['orderMessage'] = $orderMessage;
                                        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                            return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);  
                                        }else{
                                            return view('store/atzshop/index',$this->pageData);
                                        }
                                    }else{
                                        $resp['responseCode'] = 400;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Inserting Order Details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                echo json_encode($resp); 
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty, kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                            return json_encode($resp); exit;
                        }

                    }else{
                        $clientInfo = $this->ShippingModel->get_shipping_cmp_info($orderInfo->ship_cmp_id);
                        if(isset($clientInfo) && !empty($clientInfo)){
                            $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);
                            
                            $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                            $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                            $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                            $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                            $ShippingDateTime = round(microtime(true) * 1000);
                            usleep(100);
                            $DueDate = round(microtime(true) * 1000);

                            $CashOnDeliveryAmount = isset($orderInfo->total_price)?$orderInfo->total_price:null;
                            
                            $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                            $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                            
                            $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo->customer_address_id,$orderInfo->customer_id);
                            $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                            $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                            $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                            $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                            $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';

                            $totalProductsWeight = 0;
                            $NumberOfPieces = 0;
                            if(isset($cartItemList) && !empty($cartItemList)){
                                foreach($cartItemList as $cartItemData){
                                    $totalProductsWeight += number_format((float)$cartItemData->product_weight, 2, '.', '');
                                    $NumberOfPieces += $cartItemData->product_qty;
                                }
                            }
                            
                            $Services = '';
                            if($orderInfo->payment_type==1){
                                $Services='CODS';
                            }elseif($orderInfo->payment_type==2){
                                $Services='';
                            }elseif($orderInfo->payment_type==3){
                                $Services='';
                            }

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>'{
                                "ClientInfo": {
                                    "UserName": "'.$UserName.'",
                                    "Password": "'.$Password.'",
                                    "Version": "v1",
                                    "AccountNumber": "'.$AccountNumber.'",
                                    "AccountPin": "'.$AccountPin.'",
                                    "AccountEntity": "RUH",
                                    "AccountCountryCode": "SA",
                                    "Source": 24
                                },
                                "LabelInfo": null,
                                "Shipments": [
                                    {
                                        "Reference1": "",
                                        "Reference2": "",
                                        "Reference3": "",
                                        "Shipper": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "Riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "aramex",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "00966551511111",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "Consignee": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "",
                                            "PartyAddress": {
                                                "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": "",
                                                "BuildingName": "",
                                                "Floor": "",
                                                "Apartment": "",
                                                "POBox": null,
                                                "Description": ""
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                "Type": ""
                                            }
                                        },
                                        "ThirdParty": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                "Line3": "Saudi Arabia",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "TEST",
                                                "Title": "",
                                                "CompanyName": "",
                                                "PhoneNumber1": "966512345678",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "966512345678",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                        "DueDate": "\\/Date('.$DueDate.')\\/",
                                        "Comments": "",
                                        "PickupLocation": "",
                                        "OperationsInstructions": "",
                                        "AccountingInstrcutions": "",
                                        "Details": {
                                            "Dimensions": null,
                                            "ActualWeight": {
                                                "Unit": "KG",
                                                "Value": "'.$totalProductsWeight.'"
                                            },
                                            "ChargeableWeight": null,
                                            "DescriptionOfGoods": "product description",
                                            "GoodsOriginCountry": "SA",
                                            "NumberOfPieces": '.$NumberOfPieces.',
                                            "ProductGroup": "DOM",
                                            "ProductType": "CDS",
                                            "PaymentType": "P",
                                            "PaymentOptions": "",
                                            "CustomsValueAmount": null,
                                            "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                            "InsuranceAmount": null,
                                            "CashAdditionalAmount": null,
                                            "CashAdditionalAmountDescription": "",
                                            "CollectAmount": null,
                                            "Services": "'.$Services.'",
                                            "Items": []
                                        },
                                        "Attachments": [],
                                        "ForeignHAWB": "",
                                        "TransportType ": 0,
                                        "PickupGUID": "",
                                        "Number": null,
                                        "ScheduledDelivery": null
                                    }
                                ],
                                "Transaction": {
                                    "Reference1": "",
                                    "Reference2": "",
                                    "Reference3": "",
                                    "Reference4": "",
                                    "Reference5": ""
                                }
                            }',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Accept: application/json'
                            ),
                            ));
                            $apiAramexShippingRequest = '{
                                "ClientInfo": {
                                    "UserName": "'.$UserName.'",
                                    "Password": "'.$Password.'",
                                    "Version": "v1",
                                    "AccountNumber": "'.$AccountNumber.'",
                                    "AccountPin": "'.$AccountPin.'",
                                    "AccountEntity": "RUH",
                                    "AccountCountryCode": "SA",
                                    "Source": 24
                                },
                                "LabelInfo": null,
                                "Shipments": [
                                    {
                                        "Reference1": "",
                                        "Reference2": "",
                                        "Reference3": "",
                                        "Shipper": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "Riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "aramex",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "00966551511111",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "Consignee": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "",
                                            "PartyAddress": {
                                                "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                "Line2": "",
                                                "Line3": "",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": "",
                                                "BuildingName": "",
                                                "Floor": "",
                                                "Apartment": "",
                                                "POBox": null,
                                                "Description": ""
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                "Title": "",
                                                "CompanyName": "aramex",
                                                "PhoneNumber1": "00966551511111",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                "Type": ""
                                            }
                                        },
                                        "ThirdParty": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "PartyAddress": {
                                                "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                "Line3": "Saudi Arabia",
                                                "City": "riyadh",
                                                "StateOrProvinceCode": "",
                                                "PostCode": "",
                                                "CountryCode": "SA",
                                                "Longitude": 0,
                                                "Latitude": 0,
                                                "BuildingNumber": null,
                                                "BuildingName": null,
                                                "Floor": null,
                                                "Apartment": null,
                                                "POBox": null,
                                                "Description": null
                                            },
                                            "Contact": {
                                                "Department": "",
                                                "PersonName": "TEST",
                                                "Title": "",
                                                "CompanyName": "",
                                                "PhoneNumber1": "966512345678",
                                                "PhoneNumber1Ext": "",
                                                "PhoneNumber2": "",
                                                "PhoneNumber2Ext": "",
                                                "FaxNumber": "",
                                                "CellPhone": "966512345678",
                                                "EmailAddress": "test@test.com",
                                                "Type": ""
                                            }
                                        },
                                        "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                        "DueDate": "\\/Date('.$DueDate.')\\/",
                                        "Comments": "",
                                        "PickupLocation": "",
                                        "OperationsInstructions": "",
                                        "AccountingInstrcutions": "",
                                        "Details": {
                                            "Dimensions": null,
                                            "ActualWeight": {
                                                "Unit": "KG",
                                                "Value": "'.$totalProductsWeight.'"
                                            },
                                            "ChargeableWeight": null,
                                            "DescriptionOfGoods": "product description",
                                            "GoodsOriginCountry": "SA",
                                            "NumberOfPieces": '.$NumberOfPieces.',
                                            "ProductGroup": "DOM", 
                                            "ProductType": "CDS",
                                            "PaymentType": "P",
                                            "PaymentOptions": "",
                                            "CustomsValueAmount": null,
                                            "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                            "InsuranceAmount": null,
                                            "CashAdditionalAmount": null,
                                            "CashAdditionalAmountDescription": "",
                                            "CollectAmount": null,
                                            "Services": "'.$Services.'",
                                            "Items": []
                                        },
                                        "Attachments": [],
                                        "ForeignHAWB": "",
                                        "TransportType ": 0,
                                        "PickupGUID": "",
                                        "Number": null,
                                        "ScheduledDelivery": null
                                    }
                                ],
                                "Transaction": {
                                    "Reference1": "",
                                    "Reference2": "",
                                    "Reference3": "",
                                    "Reference4": "",
                                    "Reference5": ""
                                }
                            }';
                            
                            $apiAramexShippingResponse = curl_exec($curl);
                            curl_close($curl);
                            $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                            $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                            
                            if(isset($shipmentId) && !empty($shipmentId)){
                                $pg_res = json_encode($_REQUEST);
                                $requestData = array(
                                    "customer_id"=>isset($orderInfo->customer_id)?$orderInfo->customer_id:0,
                                    "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                    "pg_res"=>isset($pg_res)?$pg_res:'',
                                    "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                    "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                    "payment_status"=>1,
                                    "is_active"=>1,
                                    "updated_at"=> DATETIME
                                );
                                /* insert order info */
                                $affectedOrderId = $this->OrderModel->update_data($orderInfo->id,$requestData);

                                if(is_int($affectedOrderId)){
                                    $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                    $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        $insStatus = false;
                                        foreach($cartItemList as $cartItemData){
                                            /* get product stock quantity */
                                            $productRow = $this->ProductModel->find($cartItemData->product_id);
                                            $stock_quantity = $productRow['stock_quantity'] - $cartItemData->product_qty;
                                            /* update product stock quantity */
                                            $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData->product_id,array(
                                                "stock_quantity"=>$stock_quantity
                                            ));
                                            if(!is_int($affectedId)){
                                                $insStatus = false;
                                            }
                                            /* remove product from customer cart  */
                                            $removedProdCartStatus = $this->OrderModel->remove_product_from_customer_cart($cartItemData->product_id,$orderInfo->customer_id);
                                        }
                                        
                                        $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                        /* get payment gateway request ses_lang value start */
                                            $pg_req = json_decode($orderInfo->pg_req,TRUE);
                                            $ses_data = [
                                                'ses_lang'       => $pg_req['ses_lang'],
                                                'lang_session'     => TRUE
                                            ];
                                            $this->session->set($ses_data);
                                            $this->lang_session = $this->session->get('lang_session');
                                            $this->ses_lang = $this->session->get('ses_lang');
                                            $this->pageData['locale'] = $this->ses_lang;
                                            if($this->pageData['locale']=='ar'){
                                                $this->pageData['language'] = language($this->pageData['locale']);
                                            }elseif($this->pageData['locale']=='en'){
                                                $this->pageData['language'] = language($this->pageData['locale']);
                                            }
                                        /* get payment gateway request ses_lang value end */
                                        /* forcefully doing customer loggedIn session */
                                        $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                                        $ses_data = [
                                            'ses_custmr_id'       => $customerDetails['id'],
                                            'ses_custmr_name'     => $customerDetails['name'],
                                            'ses_custmr_email'    => $customerDetails['email'],
                                            'ses_logged_in'     => TRUE
                                        ];
                                        $this->session->set($ses_data);
                                        $orderTrackingData = array(
                                            'tranRef'=>isset($_REQUEST['tranRef'])?$_REQUEST['tranRef']:'',
                                            'trackingId'=>isset($shipmentId)?$shipmentId:''
                                        );
                                        $this->pageData['orderTrackingData'] = $orderTrackingData;
                                        $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderInfo->id);
                                        
                                        /* Notification Code For order palced Start*/
                                        $ordersGrid = base_url('admin/all-orders'); 
                                        $this->NotificationsModel->insert_data(array(                                                                           
                                            "type_id" => 2,
                                            "is_seen" => 0,                                  
                                            "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                            "created_at" => DATETIME
                                        ));
                                        /* Notification Code For order palced  End*/  

                                        /* Email Sending For Customer Code start*/   
                                        $templateName = $this->storeActvTmplName;
                                        $sociaFB = 'javascript:void(0);';
                                        $socialTwitter = 'javascript:void(0);';
                                        $socialYoutube = 'javascript:void(0);';
                                        $socialLinkedin = 'javascript:void(0);';
                                        $socialInstagram = 'javascript:void(0);';  
                                        $storeName = '';
                                        $address = '';
                                        $supportEmail = '';  
                                        $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                        if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                            if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                $address = $this->pageData['storeSettingInfo']->address;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                $storeName = $this->pageData['storeSettingInfo']->name;
                                            }
                                            if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                            }
                                        }  
                                        $this->pageData['storeLogo'] = $store_logo;
                                        $this->pageData['templateName'] = $templateName;
                                        $this->pageData['sociaFB'] = $sociaFB;
                                        $this->pageData['socialTwitter'] = $socialTwitter;
                                        $this->pageData['socialYoutube'] = $socialYoutube;
                                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                                        $this->pageData['socialInstagram'] = $socialInstagram;
                                        $this->pageData['cusName'] = $customerDetails['name'];
                                        $this->pageData['storeName'] = $storeName;
                                        $this->pageData['address'] = $address;
                                        $this->pageData['supportEmail'] = $supportEmail;
                                        $email	= $customerDetails['email'];          
                                        $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                        $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);    
                                        /* Email Sending For Customer Code For Gift Card Purchased End*/ 
                                        $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';
                                        
                                        $this->pageData['orderStatusCode'] = 200;
                                        $this->pageData['orderMessage'] = $orderMessage;
                                        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                            return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);  
                                        }else{
                                            return view('store/atzshop/index',$this->pageData);
                                        }
                                    }else{
                                        $resp['responseCode'] = 400;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Inserting Order Details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                echo json_encode($resp); 
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty, kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                            return json_encode($resp); exit;
                        }
                    }
                }
            }

        }elseif(isset($_REQUEST['tranRef']) && $PayTabsResponseStatus==true){
            $orderData = $this->OrderModel->get_single_order_details_by_tran_ref($_REQUEST['tranRef']);
            $orderInfo = $orderData['orderInfo'];
            $transaction_id = isset($_REQUEST['tranRef'])?$_REQUEST['tranRef']:'';
            $pg_res = json_encode($_REQUEST);

            $requestData = array(
                "customer_id"=>isset($orderInfo->customer_id)?$orderInfo->customer_id:0,
                "pg_res"=>isset($pg_res)?$pg_res:'',
                "payment_status"=>3,
                "order_status"=>4,
                "is_active"=>3,
                "updated_at"=> DATETIME
            );
            /* insert order info */
            $affectedOrderId = $this->OrderModel->update_data($orderInfo->id,$requestData);

            if(is_int($affectedOrderId)){
                
                $this->session->remove('orderInfo'); /* remove orderInfo session key */
                $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                /* get payment gateway request ses_lang value start */
                    $pg_req = json_decode($orderInfo->pg_req,TRUE);
                    $ses_data = [
                        'ses_lang'       => $pg_req['ses_lang'],
                        'lang_session'     => TRUE
                    ];
                    $this->session->set($ses_data);
                    $this->lang_session = $this->session->get('lang_session');
                    $this->ses_lang = $this->session->get('ses_lang');
                    $this->pageData['locale'] = $this->ses_lang;
                    if($this->pageData['locale']=='ar'){
                        $this->pageData['language'] = language($this->pageData['locale']);
                    }elseif($this->pageData['locale']=='en'){
                        $this->pageData['language'] = language($this->pageData['locale']);
                    }
                /* get payment gateway request ses_lang value end */
                /* forcefully doing customer loggedIn session */
                $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                $ses_data = [
                    'ses_custmr_id'       => $customerDetails['id'],
                    'ses_custmr_name'     => $customerDetails['name'],
                    'ses_custmr_email'    => $customerDetails['email'],
                    'ses_logged_in'     => TRUE
                ];
                $this->session->set($ses_data);
                $orderMessage = 'Message not set.';
                if($_REQUEST['respStatus']=='C'){
                    $orderMessage = $this->ses_lang=='en'?'Canceled ! Your Order was not Processed as Your Payment was Canceled.':'ألغيت ! لم تتم معالجة طلبك حيث تم إلغاء دفعتك.';
                }elseif($_REQUEST['respStatus']=='H'){
                    $orderMessage = $this->ses_lang=='en'?'Hold (Authorised but on hold for further anti-fraud review) ! Your Order Is Under Process While we wait for Payment Complete.':'تعليق (مصرح به ولكنه معلق لمزيد من المراجعة لمكافحة الاحتيال)! طلبك قيد المعالجة بينما ننتظر اكتمال الدفع.';
                }elseif($_REQUEST['respStatus']=='P'){
                    $orderMessage = $this->ses_lang=='en'?'Pending (for refunds) ! Your Order Is Under Process While we wait for Payment Pending.':'معلق (للمبالغ المستردة)! طلبك قيد المعالجة بينما ننتظر الدفع معلق.';
                }elseif($_REQUEST['respStatus']=='V'){
                    $orderMessage = $this->ses_lang=='en'?'Voided ! Your Order was not Processed as Your Payment Is Gone on Voided.':'باطل! لم تتم معالجة طلبك حيث انتهى الدفع الخاص بك.';
                }elseif($_REQUEST['respStatus']=='E'){
                    $orderMessage = $this->ses_lang=='en'?'Error ! Your Order was not Processed due to Some Error While Payment.':'خطأ ! لم تتم معالجة طلبك بسبب خطأ ما أثناء الدفع.';
                }elseif($_REQUEST['respStatus']=='D'){
                    $orderMessage = $this->ses_lang=='en'?'Declined ! Your Order was not Processed due to Payment Declined.':'انخفض ! لم تتم معالجة طلبك بسبب رفض الدفع.';
                }
                $this->pageData['customerDetails'] = $customerDetails;
                $this->pageData['orderStatusCode'] = 400;
                $this->pageData['orderMessage'] = $orderMessage;
                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                    return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);  
                }else{
                    return view('store/atzshop/index',$this->pageData);
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Error while updating order table.':'خطأ أثناء تحديث جدول الطلبات.';
                return json_encode($resp); exit;
            }
        }else{
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
                $orderInfo = $this->session->get('orderInfo');
                $cartItemList = $this->session->get('cartItemList');
                if(isset($orderInfo) && !empty($orderInfo)){
                    if(isset($orderInfo['is_giftcard_purchasing']) && !empty($orderInfo['is_giftcard_purchasing'])){
                        $pg_res = json_decode($orderInfo['pg_res']);
                        $transaction_id = isset($pg_res->tran_ref)?$pg_res->tran_ref:'';
                        /* insert order info */
                        $insertedOrderId = $this->OrderModel->insert_data(array(
                            "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                            "is_coupon_applied"=>isset($orderInfo['is_coupon_applied'])?$orderInfo['is_coupon_applied']:0,
                            "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                            "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                            "giftcard_id"=>isset($orderInfo['gc_id'])?$orderInfo['gc_id']:0,
                            "giftcard_amount"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                            "is_giftcard_purchased"=>isset($orderInfo['is_giftcard_purchasing'])?$orderInfo['is_giftcard_purchasing']:0,
                            "total_price"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                            "customer_address_id"=>isset($orderInfo['customer_address_id'])?$orderInfo['customer_address_id']:0,
                            "payment_type"=>isset($orderInfo['payment_type'])?$orderInfo['payment_type']:0,
                            "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                            "pg_id"=>isset($orderInfo['pg_id'])?$orderInfo['pg_id']:0,
                            "pg_req"=>isset($orderInfo['pg_req'])?$orderInfo['pg_req']:'',
                            "pg_res"=>isset($orderInfo['pg_res'])?$orderInfo['pg_res']:'',
                            "payment_status"=>isset($orderInfo['payment_status'])?$orderInfo['payment_status']:'',
                            "order_status"=>1,
                            "is_active"=>isset($orderInfo['is_active'])?$orderInfo['is_active']:'',
                            "created_at"=> DATETIME
                        ));
                        if(is_int($insertedOrderId)){
                            $egift_code = uniqid();
                            $this->session->remove('orderInfo');
                            $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                            $insertedGcPurchaseId = $this->GiftCardModel->insert_customer_giftcard(array(
                                "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                "gc_id"=>isset($orderInfo['gc_id'])?$orderInfo['gc_id']:0,
                                "egift_code"=>isset($egift_code)?$egift_code:'',
                                "gc_amount"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                "gc_balance"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                "gc_status"=>1,
                                "created_at"=>DATETIME
                            ));
                            if(is_int($insertedGcPurchaseId)){
                                $orderTrackingData = array(
                                    'tranRef'=>isset($transaction_id)?$transaction_id:''
                                );
                                $this->pageData['orderTrackingData'] = $orderTrackingData;
                                $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($insertedOrderId);
                                $customerDetails = $this->CustomerModel->find($orderInfo->customer_id);
                                $this->pageData['customerDetails'] = $customerDetails;
                                $orderMessage = $this->ses_lang=='en'?'Congratulations! Giftcard Purchased Successfully.':'تهانينا! بطاقة الهدايا تم شراؤها بنجاح.'; 
                                $this->pageData['orderStatusCode'] = 200;
                                $this->pageData['orderMessage'] = $orderMessage;
                                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                    return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);  
                                }else{
                                    return view('store/atzshop/index',$this->pageData);
                                }
                            }else{
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error while purchacing giftcard.':'خطأ أثناء شراء بطاقة الهدايا.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        if($orderInfo['payment_type']==1){
                            if(isset($this->pageData['storeSettingInfo']->default_shipping) && $this->pageData['storeSettingInfo']->default_shipping==1){
                                $matjaryShippingInfoApi = $this->callAPI('GET', 'https://www.matjary.in/shipping-info', '');
                                $clientInfo = json_decode($matjaryShippingInfoApi, true);
                                if(isset($clientInfo['responseCode']) && $clientInfo['responseCode']==200){
                                    $shipCmpInfo = $clientInfo['responseData'];
                                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';
            
                                    $ShippingDateTime = round(microtime(true) * 1000);
                                    usleep(100);
                                    $DueDate = round(microtime(true) * 1000);
                                    $CashOnDeliveryAmount = isset($orderInfo['total_price'])?$orderInfo['total_price']:null;
            
                                    $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                                    $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                                    
                                    $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo['customer_address_id'],$this->ses_custmr_id);
                                    $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                                    $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                                    $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                                    $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                                    $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';
            
                                    $totalProductsWeight = 0;
                                    $NumberOfPieces = 0;
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        foreach($cartItemList as $cartItemData){
                                            $totalProductsWeight += number_format((float)$cartItemData['product_weight'], 2, '.', '');
                                            $NumberOfPieces += $cartItemData['product_qty'];
                                        }
                                    }
                                    $Services = '';
                                    if($orderInfo['payment_type']==1){
                                        $Services='CODS';
                                    }elseif($orderInfo['payment_type']==2){
                                        $Services='';
                                    }elseif($orderInfo['payment_type']==3){
                                        $Services='';
                                    }
            
                                    $curl = curl_init();
            
                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS =>'{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM",
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }',
                                    CURLOPT_HTTPHEADER => array(
                                        'Content-Type: application/json',
                                        'Accept: application/json'
                                    ),
                                    ));
                                    $apiAramexShippingRequest = '{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM", 
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }';
                                    $apiAramexShippingResponse = curl_exec($curl);
                                    curl_close($curl);
                                    
                                    $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                                    $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                                    
                                    if(isset($shipmentId) && !empty($shipmentId)){
                                        $transaction_id = strtoupper(uniqid());
                                        $requestData = array(
                                            "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                            "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                            "is_coupon_applied"=>isset($orderInfo['is_coupon_applied'])?$orderInfo['is_coupon_applied']:0,
                                            "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                            "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                            "total_price"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                            "customer_address_id"=>isset($orderInfo['customer_address_id'])?$orderInfo['customer_address_id']:0,
                                            "ship_cmp_id"=>isset($orderInfo['ship_cmp_id'])?$orderInfo['ship_cmp_id']:0,
                                            "payment_type"=>isset($orderInfo['payment_type'])?$orderInfo['payment_type']:0,
                                            "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                            "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                            "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                            "payment_status"=>isset($orderInfo['payment_status'])?$orderInfo['payment_status']:'',
                                            "order_status"=>2,
                                            "is_active"=>isset($orderInfo['is_active'])?$orderInfo['is_active']:'',
                                            "created_at"=> DATETIME
                                        );
                                        /* insert order info */
                                        $insertedOrderId = $this->OrderModel->insert_data($requestData);
                    
                                        if(is_int($insertedOrderId)){
                                            if(isset($orderInfo['is_coupon_applied']) && !empty($orderInfo['is_coupon_applied'])){
                                                /* insert utilized coupon info */
                                                $insrdUtlzdCpnId = $this->CouponModel->insert_utilized_coupon_data(array(
                                                    "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                                    "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                                    "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                                    "created_at"=> DATETIME
                                                ));
                                                if(!is_int($insrdUtlzdCpnId)){
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting utilized coupon details.':'خطأ أثناء إدخال تفاصيل القسيمة المستخدمة.';
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                            $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                            $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                            
                                            if(isset($cartItemList) && !empty($cartItemList)){
                                                $insStatus = false;
                                                foreach($cartItemList as $cartItemData){
                                                    /* insert order items info */
                                                    $insertedOrderItemId = $this->OrderModel->insert_order_item_data(array(
                                                        "order_id"=>$insertedOrderId,
                                                        "product_id"=>isset($cartItemData['product_id'])?$cartItemData['product_id']:'',
                                                        "product_qty"=>isset($cartItemData['product_qty'])?$cartItemData['product_qty']:'',
                                                        "qty_price"=>isset($cartItemData['product_price'])?$cartItemData['product_price']:'',
                                                        "qty_sales_tax"=>isset($cartItemData['sales_tax'])?$cartItemData['sales_tax']:'',
                                                        "created_at"=> DATETIME
                                                    ));
                                                    if(is_int($insertedOrderItemId)){
                                                        $insStatus = true;
                                                        /* get product stock quantity */
                                                        $productRow = $this->ProductModel->find($cartItemData['product_id']);
                                                        $stock_quantity = $productRow['stock_quantity'] - $cartItemData['product_qty'];
                                                        /* update product stock quantity */
                                                        $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData['product_id'],array(
                                                            "stock_quantity"=>$stock_quantity
                                                        ));
                                                        if(!is_int($affectedId)){
                                                            $insStatus = false;
                                                        }
                                                        /* remove product from customer cart  */
                                                        $insertedOrderItemId = $this->OrderModel->remove_product_from_customer_cart($cartItemData['product_id'],$this->ses_custmr_id);
                                                    }
                                                }
                                                if(isset($insStatus) && $insStatus==true){
                                                    $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                                    $orderTrackingData = array(
                                                        'tranRef'=>isset($transaction_id)?$transaction_id:'',
                                                        'trackingId'=>isset($shipmentId)?$shipmentId:''
                                                    );
                                                    $this->pageData['orderTrackingData'] = $orderTrackingData;

                                                    $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($insertedOrderId);
                                                    /* Notification Code For order palced Start*/
                                                    $ordersGrid = base_url('admin/all-orders'); 
                                                    $this->NotificationsModel->insert_data(array(                                                                           
                                                        "type_id" => 2,
                                                        "is_seen" => 0,                                  
                                                        "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                                        "created_at" => DATETIME
                                                    ));
                                                    /* Notification Code For order palced  End*/  

                                                    /* Email Sending For Customer Code For order palced start*/                                                  
                                                    $templateName = $this->storeActvTmplName;
                                                    $sociaFB = 'javascript:void(0);';
                                                    $socialTwitter = 'javascript:void(0);';
                                                    $socialYoutube = 'javascript:void(0);';
                                                    $socialLinkedin = 'javascript:void(0);';
                                                    $socialInstagram = 'javascript:void(0);';  
                                                    $storeName = '';
                                                    $address = '';
                                                    $supportEmail = '';  
                                                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                            $address = $this->pageData['storeSettingInfo']->address;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                            $storeName = $this->pageData['storeSettingInfo']->name;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                                        }
                                                    }  
                                                    $this->pageData['storeLogo'] = $store_logo;
                                                    $this->pageData['templateName'] = $templateName;
                                                    $this->pageData['sociaFB'] = $sociaFB;
                                                    $this->pageData['socialTwitter'] = $socialTwitter;
                                                    $this->pageData['socialYoutube'] = $socialYoutube;
                                                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                                                    $this->pageData['socialInstagram'] = $socialInstagram;
                                                    $this->pageData['cusName'] = $this->ses_custmr_name;;
                                                    $this->pageData['storeName'] = $storeName;
                                                    $this->pageData['address'] = $address;
                                                    $this->pageData['supportEmail'] = $supportEmail;
                                                    $email	= $this->ses_custmr_email;                
                                                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                                    $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);  
                                                    $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';   
                                                    if($sendEmail == true){
                                                        $this->pageData['orderStatusCode'] = 200;
                                                        $this->pageData['orderMessage'] = $orderMessage;
                                                    }else{
                                                        $errorMsg = 'Error While Sending Email.';                                    
                                                        $resp['responseCode'] = 500;
                                                        $resp['responseMessage'] = $errorMsg;
                                                        return json_encode($resp); exit;
                                                    }
                                                    /* Email Sending For Customer Code For order palced End*/ 
                                                    
                                                    if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                                        return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);   
                                                    }else{
                                                        return view('store/atzshop/index',$this->pageData);
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order items.':'خطأ أثناء إدخال عناصر الطلب.';
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 400;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                        echo json_encode($resp); 
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                                    return json_encode($resp); exit;
                                } 
                            }else{
                                $clientInfo = $this->ShippingModel->get_shipping_cmp_info($orderInfo['ship_cmp_id']);
                                if(isset($clientInfo) && !empty($clientInfo)){
                                    $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);
            
                                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';
            
                                    $ShippingDateTime = round(microtime(true) * 1000);
                                    usleep(100);
                                    $DueDate = round(microtime(true) * 1000);
            
                                    $CashOnDeliveryAmount = isset($orderInfo['total_price'])?$orderInfo['total_price']:null;
            
                                    $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                                    $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                                    
                                    $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo['customer_address_id'],$this->ses_custmr_id);
                                    $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                                    $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                                    $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                                    $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                                    $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';
            
                                    $totalProductsWeight = 0;
                                    $NumberOfPieces = 0;
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        foreach($cartItemList as $cartItemData){
                                            $totalProductsWeight += number_format((float)$cartItemData['product_weight'], 2, '.', '');
                                            $NumberOfPieces += $cartItemData['product_qty'];
                                        }
                                    }
                                    $Services = '';
                                    if($orderInfo['payment_type']==1){
                                        $Services='CODS';
                                    }elseif($orderInfo['payment_type']==2){
                                        $Services='';
                                    }elseif($orderInfo['payment_type']==3){
                                        $Services='';
                                    }
            
                                    $curl = curl_init();
            
                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS =>'{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM",
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }',
                                    CURLOPT_HTTPHEADER => array(
                                        'Content-Type: application/json',
                                        'Accept: application/json'
                                    ),
                                    ));
                                    $apiAramexShippingRequest = '{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM", 
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }';
                                    $apiAramexShippingResponse = curl_exec($curl);
                                    curl_close($curl);
                                    
                                    $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                                    $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                                    
                                    if(isset($shipmentId) && !empty($shipmentId)){
                                        $transaction_id = strtoupper(uniqid());
                                        $requestData = array(
                                            "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                            "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                            "is_coupon_applied"=>isset($orderInfo['is_coupon_applied'])?$orderInfo['is_coupon_applied']:0,
                                            "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                            "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                            "total_price"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                            "customer_address_id"=>isset($orderInfo['customer_address_id'])?$orderInfo['customer_address_id']:0,
                                            "ship_cmp_id"=>isset($orderInfo['ship_cmp_id'])?$orderInfo['ship_cmp_id']:0,
                                            "payment_type"=>isset($orderInfo['payment_type'])?$orderInfo['payment_type']:0,
                                            "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                            "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                            "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                            "payment_status"=>isset($orderInfo['payment_status'])?$orderInfo['payment_status']:'',
                                            "order_status"=>2,
                                            "is_active"=>isset($orderInfo['is_active'])?$orderInfo['is_active']:'',
                                            "created_at"=> DATETIME
                                        );
                                        /* insert order info */
                                        $insertedOrderId = $this->OrderModel->insert_data($requestData);
                    
                                        if(is_int($insertedOrderId)){
                                            if(isset($orderInfo['is_coupon_applied']) && !empty($orderInfo['is_coupon_applied'])){
                                                /* insert utilized coupon info */
                                                $insrdUtlzdCpnId = $this->CouponModel->insert_utilized_coupon_data(array(
                                                    "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                                    "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                                    "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                                    "created_at"=> DATETIME
                                                ));
                                                if(!is_int($insrdUtlzdCpnId)){
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting utilized coupon details.':'خطأ أثناء إدخال تفاصيل القسيمة المستخدمة.';
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                            $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                            $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                            
                                            if(isset($cartItemList) && !empty($cartItemList)){
                                                $insStatus = false;
                                                foreach($cartItemList as $cartItemData){
                                                    /* insert order items info */
                                                    $insertedOrderItemId = $this->OrderModel->insert_order_item_data(array(
                                                        "order_id"=>$insertedOrderId,
                                                        "product_id"=>isset($cartItemData['product_id'])?$cartItemData['product_id']:'',
                                                        "product_qty"=>isset($cartItemData['product_qty'])?$cartItemData['product_qty']:'',
                                                        "qty_price"=>isset($cartItemData['product_price'])?$cartItemData['product_price']:'',
                                                        "qty_sales_tax"=>isset($cartItemData['sales_tax'])?$cartItemData['sales_tax']:'',
                                                        "created_at"=> DATETIME
                                                    ));
                                                    if(is_int($insertedOrderItemId)){
                                                        $insStatus = true;
                                                        /* get product stock quantity */
                                                        $productRow = $this->ProductModel->find($cartItemData['product_id']);
                                                        $stock_quantity = $productRow['stock_quantity'] - $cartItemData['product_qty'];
                                                        /* update product stock quantity */
                                                        $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData['product_id'],array(
                                                            "stock_quantity"=>$stock_quantity
                                                        ));
                                                        if(!is_int($affectedId)){
                                                            $insStatus = false;
                                                        }
                                                        /* remove product from customer cart  */
                                                        $insertedOrderItemId = $this->OrderModel->remove_product_from_customer_cart($cartItemData['product_id'],$this->ses_custmr_id);
                                                    }
                                                }
                                                if(isset($insStatus) && $insStatus==true){
                                                    $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                                    $orderTrackingData = array(
                                                        'tranRef'=>isset($transaction_id)?$transaction_id:'',
                                                        'trackingId'=>isset($shipmentId)?$shipmentId:''
                                                    );
                                                    $this->pageData['orderTrackingData'] = $orderTrackingData;

                                                    $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($insertedOrderId);
                                                    /* Notification Code For order palced Start*/
                                                    $ordersGrid = base_url('admin/all-orders'); 
                                                    $this->NotificationsModel->insert_data(array(                                                                           
                                                        "type_id" => 2,
                                                        "is_seen" => 0,                                  
                                                        "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                                        "created_at" => DATETIME
                                                    ));
                                                    /* Notification Code For order palced  End*/  

                                                    /* Email Sending For Customer Code For order palced start*/                                                  
                                                    $templateName = $this->storeActvTmplName;
                                                    $sociaFB = 'javascript:void(0);';
                                                    $socialTwitter = 'javascript:void(0);';
                                                    $socialYoutube = 'javascript:void(0);';
                                                    $socialLinkedin = 'javascript:void(0);';
                                                    $socialInstagram = 'javascript:void(0);';  
                                                    $storeName = '';
                                                    $address = '';
                                                    $supportEmail = '';  
                                                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                            $address = $this->pageData['storeSettingInfo']->address;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                            $storeName = $this->pageData['storeSettingInfo']->name;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                                        }
                                                    }  
                                                    $this->pageData['storeLogo'] = $store_logo;
                                                    $this->pageData['templateName'] = $templateName;
                                                    $this->pageData['sociaFB'] = $sociaFB;
                                                    $this->pageData['socialTwitter'] = $socialTwitter;
                                                    $this->pageData['socialYoutube'] = $socialYoutube;
                                                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                                                    $this->pageData['socialInstagram'] = $socialInstagram;
                                                    $this->pageData['cusName'] = $this->ses_custmr_name;;
                                                    $this->pageData['storeName'] = $storeName;
                                                    $this->pageData['address'] = $address;
                                                    $this->pageData['supportEmail'] = $supportEmail;
                                                    $email	= $this->ses_custmr_email;                
                                                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                                    $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);  
                                                    /* Email Sending For Customer Code For order palced end */    
                                                    
                                                    $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';   
                                                    
                                                    if($sendEmail == true){
                                                        $this->pageData['orderStatusCode'] = 200;
                                                        $this->pageData['orderMessage'] = $orderMessage;
                                                    
                                                    }else{
                                                        $errorMsg = 'Error While Sending Email.';                                    
                                                        $resp['responseCode'] = 500;
                                                        $resp['responseMessage'] = $errorMsg;
                                                        return json_encode($resp); exit;
                                                    }
                                                    /* Email Sending For Customer Code For order palced End*/ 
                                                    // $this->pageData['orderStatusCode'] = 200;
                                                    // $this->pageData['orderMessage'] = 'Congratulations! Your Order is Successfully Placed....';
                                                    
                                                    if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                                        return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);   
                                                    }else{
                                                        return view('store/atzshop/index',$this->pageData);
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order items.':'خطأ أثناء إدخال عناصر الطلب.';
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 400;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                        echo json_encode($resp); 
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                                    return json_encode($resp); exit;
                                } 
                            }
                        }elseif($orderInfo['payment_type']==3){ 
                            if(isset($this->pageData['storeSettingInfo']->default_shipping) && $this->pageData['storeSettingInfo']->default_shipping==1){
                                $matjaryShippingInfoApi = $this->callAPI('GET', 'https://www.matjary.in/shipping-info', '');
                                $clientInfo = json_decode($matjaryShippingInfoApi, true);
                                
                                if(isset($clientInfo['responseCode']) && $clientInfo['responseCode']==200){
                                    $shipCmpInfo = $clientInfo['responseData'];
            
                                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';
            
                                    $ShippingDateTime = round(microtime(true) * 1000);
                                    usleep(100);
                                    $DueDate = round(microtime(true) * 1000);
            
                                    $CashOnDeliveryAmount = isset($orderInfo['total_price'])?$orderInfo['total_price']:null;
            
                                    $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                                    $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                                    
                                    $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo['customer_address_id'],$this->ses_custmr_id);
                                    $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                                    $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                                    $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                                    $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                                    $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';
            
                                    $totalProductsWeight = 0;
                                    $NumberOfPieces = 0;
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        foreach($cartItemList as $cartItemData){
                                            $totalProductsWeight += number_format((float)$cartItemData['product_weight'], 2, '.', '');
                                            $NumberOfPieces += $cartItemData['product_qty'];
                                        }
                                    }
                                    $Services = '';
                                    if($orderInfo['payment_type']==1){
                                        $Services='CODS';
                                    }elseif($orderInfo['payment_type']==2){
                                        $Services='';
                                    }elseif($orderInfo['payment_type']==3){
                                        $Services='';
                                    }
            
                                    $curl = curl_init();
            
                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS =>'{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM",
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }',
                                    CURLOPT_HTTPHEADER => array(
                                        'Content-Type: application/json',
                                        'Accept: application/json'
                                    ),
                                    ));
                                    $apiAramexShippingRequest = '{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM", 
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }';
                                    $apiAramexShippingResponse = curl_exec($curl);
                                    curl_close($curl);
                                    
                                    $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                                    $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                                    
                                    if(isset($shipmentId) && !empty($shipmentId)){
                                        $transaction_id = strtoupper(uniqid());
                                        $total_price = $orderInfo['total_price'];
                                        $giftcard_code = $orderInfo['giftcard_code'];
                                        $giftcard_id = $orderInfo['giftcard_id'];
                                        $requestData = array(
                                            "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                            "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                            "is_coupon_applied"=>isset($orderInfo['is_coupon_applied'])?$orderInfo['is_coupon_applied']:0,
                                            "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                            "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                            "total_price"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                            "customer_address_id"=>isset($orderInfo['customer_address_id'])?$orderInfo['customer_address_id']:0,
                                            "ship_cmp_id"=>isset($orderInfo['ship_cmp_id'])?$orderInfo['ship_cmp_id']:0,
                                            "payment_type"=>isset($orderInfo['payment_type'])?$orderInfo['payment_type']:0,
                                            "is_giftcard_applied"=>isset($orderInfo['is_giftcard_applied'])?$orderInfo['is_giftcard_applied']:0,
                                            "giftcard_id"=>isset($orderInfo['giftcard_id'])?$orderInfo['giftcard_id']:0,
                                            "giftcard_prchsed_id"=>isset($orderInfo['giftcard_prchsed_id'])?$orderInfo['giftcard_prchsed_id']:0,
                                            "giftcard_amount"=>isset($orderInfo['giftcard_amount'])?$orderInfo['giftcard_amount']:0,
                                            "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                            "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                            "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                            "payment_status"=>isset($orderInfo['payment_status'])?$orderInfo['payment_status']:'',
                                            "order_status"=>2,
                                            "is_active"=>isset($orderInfo['is_active'])?$orderInfo['is_active']:'',
                                            "created_at"=> DATETIME
                                        );
                                        /* insert order info */
                                        $insertedOrderId = $this->OrderModel->insert_data($requestData);
                    
                                        if(is_int($insertedOrderId)){
                                            if(isset($orderInfo['is_coupon_applied']) && !empty($orderInfo['is_coupon_applied'])){
                                                /* insert utilized coupon info */
                                                $insrdUtlzdCpnId = $this->CouponModel->insert_utilized_coupon_data(array(
                                                    "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                                    "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                                    "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                                    "created_at"=> DATETIME
                                                ));
                                                if(!is_int($insrdUtlzdCpnId)){
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting utilized coupon details.':'خطأ أثناء إدخال تفاصيل القسيمة المستخدمة.';
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                            $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                            $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                            
                                            $cartItemList = $this->session->get('cartItemList');
                                            if(isset($cartItemList) && !empty($cartItemList)){
                                                $insStatus = false;
                                                foreach($cartItemList as $cartItemData){
                                                    /* insert order items info */
                                                    $insertedOrderItemId = $this->OrderModel->insert_order_item_data(array(
                                                        "order_id"=>$insertedOrderId,
                                                        "product_id"=>isset($cartItemData['product_id'])?$cartItemData['product_id']:'',
                                                        "product_qty"=>isset($cartItemData['product_qty'])?$cartItemData['product_qty']:'',
                                                        "qty_price"=>isset($cartItemData['product_price'])?$cartItemData['product_price']:'',
                                                        "qty_sales_tax"=>isset($cartItemData['sales_tax'])?$cartItemData['sales_tax']:'',
                                                        "created_at"=> DATETIME
                                                    ));
                                                    if(is_int($insertedOrderItemId)){
                                                        $insStatus = true;
                                                        /* get product stock quantity */
                                                        $productRow = $this->ProductModel->find($cartItemData['product_id']);
                                                        $stock_quantity = $productRow['stock_quantity'] - $cartItemData['product_qty'];
                                                        /* update product stock quantity */
                                                        $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData['product_id'],array(
                                                            "stock_quantity"=>$stock_quantity
                                                        ));
                                                        if(!is_int($affectedId)){
                                                            $insStatus = false;
                                                        }
            
                                                        /* remove product from customer cart  */
                                                        $insertedOrderItemId = $this->OrderModel->remove_product_from_customer_cart($cartItemData['product_id'],$this->ses_custmr_id);
                                                    }
                                                }
                                                if(isset($insStatus) && $insStatus==true){
                                                    /* update giftcard balance */
                                                    $gc_balance = '';
                                                    $gcRow = $this->GiftCardModel->find_in_giftcardpurchased($giftcard_code);
                                                    $gc_balance = $gcRow->gc_balance - $total_price;
                                                    $affectedId = $this->GiftCardModel->upt_gc_balance($gcRow->id,array(
                                                        "gc_balance"=>$gc_balance
                                                    ));
                                                    if(!is_int($affectedId)){
                                                        $insStatus = false;
                                                    }

                                                    $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                                    
                                                    $orderTrackingData = array(
                                                        'tranRef'=>isset($transaction_id)?$transaction_id:'',
                                                        'trackingId'=>isset($shipmentId)?$shipmentId:''
                                                    );
                                                    $this->pageData['orderTrackingData'] = $orderTrackingData;

                                                    $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($insertedOrderId);
            
                                                    /* Notification Code For order palced Start*/
                                                    $ordersGrid = base_url('admin/all-orders'); 
                                                    $this->NotificationsModel->insert_data(array(                                                                           
                                                        "type_id" => 2,
                                                        "is_seen" => 0,                                  
                                                        "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                                        "created_at" => DATETIME
                                                    ));
                                                    /* Notification Code For order palced  End*/   

                                                    /* Email Sending For Customer Code For Product Purchased start*/
                                                   
                                                    $templateName = $this->storeActvTmplName;
                                                    $sociaFB = 'javascript:void(0);';
                                                    $socialTwitter = 'javascript:void(0);';
                                                    $socialYoutube = 'javascript:void(0);';
                                                    $socialLinkedin = 'javascript:void(0);';
                                                    $socialInstagram = 'javascript:void(0);';  
                                                    $storeName = '';
                                                    $address = '';
                                                    $supportEmail = '';  
                                                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                            $address = $this->pageData['storeSettingInfo']->address;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                            $storeName = $this->pageData['storeSettingInfo']->name;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                                        }
                                                    }  
                                                    $this->pageData['storeLogo'] = $store_logo;
                                                    $this->pageData['templateName'] = $templateName;
                                                    $this->pageData['sociaFB'] = $sociaFB;
                                                    $this->pageData['socialTwitter'] = $socialTwitter;
                                                    $this->pageData['socialYoutube'] = $socialYoutube;
                                                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                                                    $this->pageData['socialInstagram'] = $socialInstagram;
                                                    $this->pageData['cusName'] = $this->ses_custmr_name;;
                                                    $this->pageData['storeName'] = $storeName;
                                                    $this->pageData['address'] = $address;
                                                    $this->pageData['supportEmail'] = $supportEmail;
                                                    $email	= $this->ses_custmr_email;                
                                                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                                    $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);    
                                                    /* Email Sending For Customer Code For Product Purchased End*/ 
                                                    $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';  
                                                    
                                                    $this->pageData['orderStatusCode'] = 200;
                                                    //$this->pageData['orderMessage'] = 'Congratulations! Your Order is Successfully Placed...';
                                                    $this->pageData['orderMessage'] = $orderMessage;
                                                    
                                                    if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                                        return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);     
                                                    }else{
                                                        return view('store/atzshop/index',$this->pageData);
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order items.':'خطأ أثناء إدخال عناصر الطلب.';
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 400;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                        echo json_encode($resp); 
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $clientInfo = $this->ShippingModel->get_shipping_cmp_info($orderInfo['ship_cmp_id']);
                                if(isset($clientInfo) && !empty($clientInfo)){
                                    $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);
            
                                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';
            
                                    $ShippingDateTime = round(microtime(true) * 1000);
                                    usleep(100);
                                    $DueDate = round(microtime(true) * 1000);
            
                                    $CashOnDeliveryAmount = isset($orderInfo['total_price'])?$orderInfo['total_price']:null;
            
                                    $Shipments_Shipper_PartyAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                                    $Shipments_Shipper_PartyAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                                    
                                    $customerAddrInfo = $this->CustomerAddressesModel->get_customer_single_address_info($orderInfo['customer_address_id'],$this->ses_custmr_id);
                                    $Consignee_PartyAddress_Line1 = isset($customerAddrInfo->address)?$customerAddrInfo->address:'';
                                    $Consignee_PartyAddress_PostCode = isset($customerAddrInfo->zipcode)?$customerAddrInfo->zipcode:'';
                                    $Consignee_Contact_PersonName = isset($customerAddrInfo->customer_name)?$customerAddrInfo->customer_name:'';
                                    $Consignee_Contact_CellPhone = isset($customerAddrInfo->customer_contactno)?$customerAddrInfo->customer_contactno:'';
                                    $Consignee_Contact_EmailAddress = isset($customerAddrInfo->customer_email)?$customerAddrInfo->customer_email:'';
            
                                    $totalProductsWeight = 0;
                                    $NumberOfPieces = 0;
                                    
                                    if(isset($cartItemList) && !empty($cartItemList)){
                                        foreach($cartItemList as $cartItemData){
                                            $totalProductsWeight += number_format((float)$cartItemData['product_weight'], 2, '.', '');
                                            $NumberOfPieces += $cartItemData['product_qty'];
                                        }
                                    }
                                    $Services = '';
                                    if($orderInfo['payment_type']==1){
                                        $Services='CODS';
                                    }elseif($orderInfo['payment_type']==2){
                                        $Services='';
                                    }elseif($orderInfo['payment_type']==3){
                                        $Services='';
                                    }
            
                                    $curl = curl_init();
            
                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS =>'{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM",
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }',
                                    CURLOPT_HTTPHEADER => array(
                                        'Content-Type: application/json',
                                        'Accept: application/json'
                                    ),
                                    ));
                                    $apiAramexShippingRequest = '{
                                        "ClientInfo": {
                                            "UserName": "'.$UserName.'",
                                            "Password": "'.$Password.'",
                                            "Version": "v1",
                                            "AccountNumber": "'.$AccountNumber.'",
                                            "AccountPin": "'.$AccountPin.'",
                                            "AccountEntity": "RUH",
                                            "AccountCountryCode": "SA",
                                            "Source": 24
                                        },
                                        "LabelInfo": null,
                                        "Shipments": [
                                            {
                                                "Reference1": "",
                                                "Reference2": "",
                                                "Reference3": "",
                                                "Shipper": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Shipments_Shipper_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "Riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Shipments_Shipper_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "aramex",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "00966551511111",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "Consignee": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "",
                                                    "PartyAddress": {
                                                        "Line1": "'.$Consignee_PartyAddress_Line1.'",
                                                        "Line2": "",
                                                        "Line3": "",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "'.$Consignee_PartyAddress_PostCode.'",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": "",
                                                        "BuildingName": "",
                                                        "Floor": "",
                                                        "Apartment": "",
                                                        "POBox": null,
                                                        "Description": ""
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "'.$Consignee_Contact_PersonName.'",
                                                        "Title": "",
                                                        "CompanyName": "aramex",
                                                        "PhoneNumber1": "00966551511111",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "'.$Consignee_Contact_CellPhone.'",
                                                        "EmailAddress": "'.$Consignee_Contact_EmailAddress.'",
                                                        "Type": ""
                                                    }
                                                },
                                                "ThirdParty": {
                                                    "Reference1": "",
                                                    "Reference2": "",
                                                    "AccountNumber": "'.$AccountNumber.'",
                                                    "PartyAddress": {
                                                        "Line1": "شركة إيلاف المتقدمة لتقنية المعلومات Advanced Elaf، ",
                                                        "Line2": "7090 طريق الثمامة - حي الصحافة مكتب 19 الرياض 13315-3599 ",
                                                        "Line3": "Saudi Arabia",
                                                        "City": "riyadh",
                                                        "StateOrProvinceCode": "",
                                                        "PostCode": "",
                                                        "CountryCode": "SA",
                                                        "Longitude": 0,
                                                        "Latitude": 0,
                                                        "BuildingNumber": null,
                                                        "BuildingName": null,
                                                        "Floor": null,
                                                        "Apartment": null,
                                                        "POBox": null,
                                                        "Description": null
                                                    },
                                                    "Contact": {
                                                        "Department": "",
                                                        "PersonName": "TEST",
                                                        "Title": "",
                                                        "CompanyName": "",
                                                        "PhoneNumber1": "966512345678",
                                                        "PhoneNumber1Ext": "",
                                                        "PhoneNumber2": "",
                                                        "PhoneNumber2Ext": "",
                                                        "FaxNumber": "",
                                                        "CellPhone": "966512345678",
                                                        "EmailAddress": "test@test.com",
                                                        "Type": ""
                                                    }
                                                },
                                                "ShippingDateTime": "\\/Date('.$ShippingDateTime.')\\/",
                                                "DueDate": "\\/Date('.$DueDate.')\\/",
                                                "Comments": "",
                                                "PickupLocation": "",
                                                "OperationsInstructions": "",
                                                "AccountingInstrcutions": "",
                                                "Details": {
                                                    "Dimensions": null,
                                                    "ActualWeight": {
                                                        "Unit": "KG",
                                                        "Value": "'.$totalProductsWeight.'"
                                                    },
                                                    "ChargeableWeight": null,
                                                    "DescriptionOfGoods": "product description",
                                                    "GoodsOriginCountry": "SA",
                                                    "NumberOfPieces": '.$NumberOfPieces.',
                                                    "ProductGroup": "DOM", 
                                                    "ProductType": "CDS",
                                                    "PaymentType": "P",
                                                    "PaymentOptions": "",
                                                    "CustomsValueAmount": null,
                                                    "CashOnDeliveryAmount":{"CurrencyCode":"SAR","Value":'.$CashOnDeliveryAmount.'},
                                                    "InsuranceAmount": null,
                                                    "CashAdditionalAmount": null,
                                                    "CashAdditionalAmountDescription": "",
                                                    "CollectAmount": null,
                                                    "Services": "'.$Services.'",
                                                    "Items": []
                                                },
                                                "Attachments": [],
                                                "ForeignHAWB": "",
                                                "TransportType ": 0,
                                                "PickupGUID": "",
                                                "Number": null,
                                                "ScheduledDelivery": null
                                            }
                                        ],
                                        "Transaction": {
                                            "Reference1": "",
                                            "Reference2": "",
                                            "Reference3": "",
                                            "Reference4": "",
                                            "Reference5": ""
                                        }
                                    }';
                                    $apiAramexShippingResponse = curl_exec($curl);
                                    curl_close($curl);
                                    
                                    $aramex_shipping_api_response = json_decode($apiAramexShippingResponse);
                                    $shipmentId = isset($aramex_shipping_api_response->Shipments[0]->ID)?$aramex_shipping_api_response->Shipments[0]->ID:'Error in aramex create shipping API, Shipping ID not generated. '.exit(); 
                                    
                                    if(isset($shipmentId) && !empty($shipmentId)){
                                        $transaction_id = $transaction_id = strtoupper(uniqid());
                                        $total_price = $orderInfo['total_price'];
                                        $giftcard_code = $orderInfo['giftcard_code'];
                                        $giftcard_id = $orderInfo['giftcard_id'];
                                        $requestData = array(
                                            "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                            "shipping_id"=>isset($shipmentId)?$shipmentId:'',
                                            "is_coupon_applied"=>isset($orderInfo['is_coupon_applied'])?$orderInfo['is_coupon_applied']:0,
                                            "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                            "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                            "total_price"=>isset($orderInfo['total_price'])?$orderInfo['total_price']:0,
                                            "customer_address_id"=>isset($orderInfo['customer_address_id'])?$orderInfo['customer_address_id']:0,
                                            "ship_cmp_id"=>isset($orderInfo['ship_cmp_id'])?$orderInfo['ship_cmp_id']:0,
                                            "payment_type"=>isset($orderInfo['payment_type'])?$orderInfo['payment_type']:0,
                                            "is_giftcard_applied"=>isset($orderInfo['is_giftcard_applied'])?$orderInfo['is_giftcard_applied']:0,
                                            "giftcard_id"=>isset($orderInfo['giftcard_id'])?$orderInfo['giftcard_id']:0,
                                            "giftcard_prchsed_id"=>isset($orderInfo['giftcard_prchsed_id'])?$orderInfo['giftcard_prchsed_id']:0,
                                            "giftcard_amount"=>isset($orderInfo['giftcard_amount'])?$orderInfo['giftcard_amount']:0,
                                            "transaction_id"=>isset($transaction_id)?$transaction_id:'',
                                            "shipping_req"=>isset($apiAramexShippingRequest)?$apiAramexShippingRequest:'',
                                            "shipping_res"=>isset($apiAramexShippingResponse)?$apiAramexShippingResponse:'',
                                            "payment_status"=>isset($orderInfo['payment_status'])?$orderInfo['payment_status']:'',
                                            "order_status"=>2,
                                            "is_active"=>isset($orderInfo['is_active'])?$orderInfo['is_active']:'',
                                            "created_at"=> DATETIME
                                        );
                                        /* insert order info */
                                        $insertedOrderId = $this->OrderModel->insert_data($requestData);
                    
                                        if(is_int($insertedOrderId)){
                                            if(isset($orderInfo['is_coupon_applied']) && !empty($orderInfo['is_coupon_applied'])){
                                                /* insert utilized coupon info */
                                                $insrdUtlzdCpnId = $this->CouponModel->insert_utilized_coupon_data(array(
                                                    "customer_id"=>isset($orderInfo['customer_id'])?$orderInfo['customer_id']:0,
                                                    "coupon_id"=>isset($orderInfo['coupon_id'])?$orderInfo['coupon_id']:0,
                                                    "coupon_amount"=>isset($orderInfo['coupon_amount'])?$orderInfo['coupon_amount']:0,
                                                    "created_at"=> DATETIME
                                                ));
                                                if(!is_int($insrdUtlzdCpnId)){
                                                    $resp['responseCode'] = 400;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting utilized coupon details.':'خطأ أثناء إدخال تفاصيل القسيمة المستخدمة.';
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                            $this->session->remove('orderInfo'); /* remove orderInfo session key */
                                            $this->session->remove('cartBuyItem'); /* remove cartBuyItem session key */
                                            
                                            $cartItemList = $this->session->get('cartItemList');
                                            if(isset($cartItemList) && !empty($cartItemList)){
                                                $insStatus = false;
                                                foreach($cartItemList as $cartItemData){
                                                    /* insert order items info */
                                                    $insertedOrderItemId = $this->OrderModel->insert_order_item_data(array(
                                                        "order_id"=>$insertedOrderId,
                                                        "product_id"=>isset($cartItemData['product_id'])?$cartItemData['product_id']:'',
                                                        "product_qty"=>isset($cartItemData['product_qty'])?$cartItemData['product_qty']:'',
                                                        "qty_price"=>isset($cartItemData['product_price'])?$cartItemData['product_price']:'',
                                                        "qty_sales_tax"=>isset($cartItemData['sales_tax'])?$cartItemData['sales_tax']:'',
                                                        "created_at"=> DATETIME
                                                    ));
                                                    if(is_int($insertedOrderItemId)){
                                                        $insStatus = true;
                                                        /* get product stock quantity */
                                                        $productRow = $this->ProductModel->find($cartItemData['product_id']);
                                                        $stock_quantity = $productRow['stock_quantity'] - $cartItemData['product_qty'];
                                                        /* update product stock quantity */
                                                        $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData['product_id'],array(
                                                            "stock_quantity"=>$stock_quantity
                                                        ));
                                                        if(!is_int($affectedId)){
                                                            $insStatus = false;
                                                        }
            
                                                        /* remove product from customer cart  */
                                                        $insertedOrderItemId = $this->OrderModel->remove_product_from_customer_cart($cartItemData['product_id'],$this->ses_custmr_id);
                                                    }
                                                }
                                                if(isset($insStatus) && $insStatus==true){
                                                    /* update giftcard balance */
                                                    $gc_balance = '';
                                                    $gcRow = $this->GiftCardModel->find_in_giftcardpurchased($giftcard_code);
                                                    $gc_balance = $gcRow->gc_balance - $total_price;
                                                    $affectedId = $this->GiftCardModel->upt_gc_balance($gcRow->id,array(
                                                        "gc_balance"=>$gc_balance
                                                    ));
                                                    if(!is_int($affectedId)){
                                                        $insStatus = false;
                                                    }

                                                    $this->session->remove('cartItemList'); /* remove cartItemList session key */
                                                    
                                                    $orderTrackingData = array(
                                                        'tranRef'=>isset($transaction_id)?$transaction_id:'',
                                                        'trackingId'=>isset($shipmentId)?$shipmentId:''
                                                    );
                                                    $this->pageData['orderTrackingData'] = $orderTrackingData;

                                                    $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($insertedOrderId);
            
                                                    /* Notification Code For order palced Start*/
                                                    $ordersGrid = base_url('admin/all-orders'); 
                                                    $this->NotificationsModel->insert_data(array(                                                                           
                                                        "type_id" => 2,
                                                        "is_seen" => 0,                                  
                                                        "reff_link" => isset($ordersGrid)?$ordersGrid:'',    
                                                        "created_at" => DATETIME
                                                    ));
                                                    /* Notification Code For order palced  End*/   

                                                    /* Email Sending For Customer Code For Product Purchased start*/
                                                    
                                                    $templateName = $this->storeActvTmplName;
                                                    $sociaFB = 'javascript:void(0);';
                                                    $socialTwitter = 'javascript:void(0);';
                                                    $socialYoutube = 'javascript:void(0);';
                                                    $socialLinkedin = 'javascript:void(0);';
                                                    $socialInstagram = 'javascript:void(0);';  
                                                    $storeName = '';
                                                    $address = '';
                                                    $supportEmail = '';  
                                                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                                            $address = $this->pageData['storeSettingInfo']->address;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                                            $storeName = $this->pageData['storeSettingInfo']->name;
                                                        }
                                                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                                        }
                                                    }  
                                                    $this->pageData['storeLogo'] = $store_logo;
                                                    $this->pageData['templateName'] = $templateName;
                                                    $this->pageData['sociaFB'] = $sociaFB;
                                                    $this->pageData['socialTwitter'] = $socialTwitter;
                                                    $this->pageData['socialYoutube'] = $socialYoutube;
                                                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                                                    $this->pageData['socialInstagram'] = $socialInstagram;
                                                    $this->pageData['cusName'] = $this->ses_custmr_name;
                                                    $this->pageData['storeName'] = $storeName;
                                                    $this->pageData['address'] = $address;
                                                    $this->pageData['supportEmail'] = $supportEmail; 
                                                    $email	= $this->ses_custmr_email;                
                                                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/email-product-purchase',$this->pageData);
                                                    $subject = 'Your Order #'.$this->pageData['orderDetails']['orderInfo']->transaction_id.' with '.$storeName.' has been placed';
                                                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);    
                                                    /* Email Sending For Customer Code For Product Purchased End*/ 
                                                    $orderMessage = $this->ses_lang=='en'?'Congratulations! Your Order is Successfully Placed...':'تهانينا! تم تقديم طلبك بنجاح ...';  
                                                    
                                                    $this->pageData['orderStatusCode'] = 200;
                                                    //$this->pageData['orderMessage'] = 'Congratulations! Your Order is Successfully Placed...';
                                                    $this->pageData['orderMessage'] = $orderMessage;
                                                    
                                                    if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                                                        return view('store/'.$this->storeActvTmplName.'/customer/order-success',$this->pageData);     
                                                    }else{
                                                        return view('store/atzshop/index',$this->pageData);
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order items.':'خطأ أثناء إدخال عناصر الطلب.';
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 400;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Cart Items are not set.':'لم يتم تعيين عناصر سلة التسوق.';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 400;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Error while inserting order details.':'خطأ أثناء إدخال تفاصيل الطلب.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error while creating shipment ID.':'خطأ أثناء إنشاء معرف الشحنة.';
                                        echo json_encode($resp); 
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                                    return json_encode($resp); exit;
                                }
                            }

                        }
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Order data not set.':'لم يتم تعيين بيانات الطلب.';
                    echo json_encode($resp); 
                    sleep(3); /* sleep for 3 seconds */
                    return redirect()->to('/product/products');
                }
            }else{
                return redirect()->to('/customer/login');
            }
        }
    }

    public function save_customer_deliver_address(){      
        if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
            if(isset($_POST['address']) && !empty($_POST['address'])){
                if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
                    if(isset($_POST['state_id']) && !empty($_POST['state_id'])){
                        if(isset($_POST['city_id']) && !empty($_POST['city_id'])){
                            if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){
                                $insertedId = $this->CustomerAddressesModel->insert_data(array(
                                    "customer_id"=>$_POST['customer_id'],
                                    "address"=>$_POST['address'],
                                    "country_id"=>$_POST['country_id'],
                                    "state_id"=>$_POST['state_id'],
                                    "city_id"=>$_POST['city_id'],
                                    "zipcode"=>$_POST['zipcode'],
                                    "is_active"=>1,
                                    "created_at"=> DATETIME
                                ));
                                if(is_int($insertedId)){
                                    $cstmrSnglAddrDetails = $this->CustomerAddressesModel->find($insertedId);
                                    if(isset($cstmrSnglAddrDetails) && !empty($cstmrSnglAddrDetails)){
                                        $resp['responseCode'] = 200;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Address Added Successfully.':'تمت إضافة العنوان بنجاح.';
                                        $resp['responseData'] = $cstmrSnglAddrDetails;
                                        $resp['isCheckoutPage'] = isset($_POST['is_checkout_page'])?$_POST['is_checkout_page']:0;
                                        $resp['customerAddressList'] = $this->CustomerAddressesModel->get_customer_address_list($this->ses_custmr_id);
                                        return json_encode($resp); exit;
                                    }else{
                                        $resp['responseCode'] = 200;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Retrieving Address Data.':'خطأ أثناء استرداد بيانات العنوان.';
                                        $resp['responseData'] = '';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Saving Customer Address.':'خطأ أثناء حفظ عنوان العميل.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Zipcode Is Required.':'الرمز البريدي مطلوب.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Choose City.':'اختر المدينة.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Choose State.':'اختر الولاية.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Choose Coutry.':'اختر الدولة.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Address Is Required.':'العنوان مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function my_address(){    
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'My Addresses';
            $this->pageData['countryList'] = $this->CommonModel->get_all_country_data();
            $customerAddress = $this->CustomerAddressesModel->get_customer_address_list($this->ses_custmr_id);
            if(isset($customerAddress) && !empty($customerAddress)){
                $this->pageData['GetCstmrAddressList'] = $customerAddress;
            }else{
                $this->pageData['GetCstmrAddressList'] = '';
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-address',$this->pageData);     
            }else{
                return view('store/atzshop/index',$this->pageData);
            }   
        }else{
            return redirect()->to('/customer/login');
        }   
    }

    public function edit_customer_deliver_address(){           
        if(isset($_POST['addressid']) && !empty($_POST['addressid'])){
            $addressInfo = $this->CustomerAddressesModel->get_single_address_info($_POST['addressid']);
            if(isset($addressInfo) && !empty($addressInfo)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Address Details Retrieved Successfully.':'تم استرداد تفاصيل العنوان بنجاح.';
                $resp['addressData'] = $addressInfo;
                $resp['stateList'] = $this->CommonModel->get_country_states($addressInfo->country_id);
                $resp['cityList'] = $this->CommonModel->get_state_cities($addressInfo->state_id);
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $this->ses_lang=='en'?'No Address Info Found.':'لم يتم العثور على معلومات العنوان';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Address Id Is Required.':'معرف العنوان مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function update_customer_deliver_address(){
        if(isset($_POST['address_id']) && !empty($_POST['address_id'])){
            if(isset($_POST['customer_id']) && !empty($_POST['customer_id'])){
                if(isset($_POST['address']) && !empty($_POST['address'])){
                    if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
                        if(isset($_POST['state_id']) && !empty($_POST['state_id'])){
                            if(isset($_POST['city_id']) && !empty($_POST['city_id'])){
                                if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){
                                    $affectedId = $this->CustomerAddressesModel->update_data($_POST['address_id'], array(
                                        "customer_id"=>$_POST['customer_id'],
                                        "address"=>$_POST['address'],
                                        "country_id"=>$_POST['country_id'],
                                        "state_id"=>$_POST['state_id'],
                                        "city_id"=>$_POST['city_id'],
                                        "zipcode"=>$_POST['zipcode'],
                                        "updated_at"=> DATETIME
                                    ));
                                    if(is_int($affectedId)){
                                        $resp['responseCode'] = 200;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Address Updated Successfully.':'تم تحديث العنوان بنجاح.';
                                        $resp['isCheckoutPage'] = isset($_POST['is_checkout_page'])?$_POST['is_checkout_page']:0;
                                        $resp['customerAddressList'] = $this->CustomerAddressesModel->get_customer_address_list($this->ses_custmr_id);
                                        return json_encode($resp); exit;
                                    }else{
                                        $resp['responseCode'] = 400;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Updating Customer Address.':'خطأ أثناء تحديث عنوان العميل.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Zipcode Is Required.':'الرمز البريدي مطلوب.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Choose City.':'اختر المدينة.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Choose State.':'اختر الولاية.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Choose Country.':'اختر الدولة.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Address Is Required.':'العنوان مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Address Id Is Required.':'معرف العنوان مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function delete_customer_deliver_address(){      
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $result =  $this->CustomerAddressesModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));                      
            if(isset($result)){                                                   
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Address Removed Successfully.':'تمت إزالة العنوان بنجاح.';
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Removing Address From Cart.':'خطأ أثناء إزالة العنوان من سلة التسوق.';
                return json_encode($resp); exit;
            }                  
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Id Is Required.':'المعرف مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function post_feedback($prodId=''){        
        $this->pageData['pageTitle'] = 'Product Feedback';
        $this->pageData['productDetails'] = $this->ProductModel->get_single_prod_details($prodId);
        $this->pageData['ProductFeedBackDetails'] = $this->ProductFeedBackModel->get_all_data();     
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/product/post-feedback',$this->pageData);        
        }else{
            return view('store/atzshop/index',$this->pageData);
        }       
    }

    public function save_feedback(){
        if(isset($_POST['ratting']) && !empty($_POST['ratting'])){
            if(isset($_POST['feedback']) && !empty($_POST['feedback'])){                       
                $ratting	= $this->request->getPost('ratting');                            
                $feedback = $this->request->getPost('feedback');
                $product_id	= $this->request->getPost('product_id');                            
                $category_id = $this->request->getPost('category_id');
                $customer_id = $this->request->getPost('customer_id');
                $result = $this->ProductFeedBackModel->insert_data(array(  
                    "ratting" => isset($ratting)?$ratting:'',                                  
                    "feedback" => isset($feedback)?$feedback:'',  
                    "product_id" => isset($product_id)?$product_id:'',                                  
                    "category_id" => isset($category_id)?$category_id:'',
                    "customer_id" => isset($customer_id)?$customer_id:'',                                                                                                
                    "is_active" => 1,
                    "created_at" => DATETIME
                ));
                if(isset($result) && !empty($result)){                             
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Review Added Successfully.':'تمت إضافة مراجعة المنتج بنجاح.';
                    $resp['redirectUrl'] = base_url('product/product-details/'.$product_id);
                    return json_encode($resp); exit;                             
                }else{
                    $errorMsg = $this->ses_lang=='en'?'Error while review insertion.':'خطأ أثناء مراجعة الإدراج.';                                    
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }                             
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Feedback Is Required.':'التعليقات مطلوبة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Ratting Is Required.':'مطلوب حشرجة الموت.';
            return json_encode($resp); exit;
        }       
    }

    public function view_feedback($prodId=''){        
        $this->pageData['pageTitle'] = 'View Feedback'; 
        $this->pageData['productDetails'] = $this->ProductModel->get_single_prod_details($prodId);
        $ses_logged_in = $this->session->get('ses_logged_in');
        if(isset($ses_logged_in) && $ses_logged_in===true){
            $ses_custmr_id = $this->session->get('ses_custmr_id');
            $ProductFeedBackInfo = $this->ProductFeedBackModel->get_customer_feedback_products($ses_custmr_id,$prodId); 
            if(isset($ProductFeedBackInfo) && !empty($ProductFeedBackInfo)){
                $this->pageData['GetProductFeedbacks'] = $ProductFeedBackInfo;
            }
        }   
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/product/view-feedback',$this->pageData);        
        }else{
            return view('store/atzshop/index',$this->pageData);
        }     
    }
    
    public function contact_us(){  
        $this->pageData['pageTitle'] = 'Contact Us';
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/contact-us',$this->pageData);        
        }else{
            return view('store/atzshop/index',$this->pageData);
        } 
    }

    public function save_contact_us(){  
        if(isset($_POST['name']) && !empty($_POST['name'])){
            if(isset($_POST['email']) && !empty($_POST['email'])){
                if(isset($_POST['massage']) && !empty($_POST['massage'])){
                    $name	= $this->remove_special_char_from_string($this->request->getPost('name'));                        
                    $email	= $this->request->getPost('email');  
                    $contact_no	= $this->request->getPost('contact_no');                            
                    $massage = $this->request->getPost('massage'); 
                    $insertedId = $this->ContactUsModel->insert_data(
                        array(                                                                                                     
                            "name" =>isset($name)?$name:'',                                 
                            "email" => isset($email)?$email:'',
                            "contact_no" => isset($contact_no)?$contact_no:'',                                  
                            "massage" => isset($massage)?$massage:'',                                                                                                 
                            "is_active" => 1,
                            "created_at" => DATETIME
                        )
                    );                       
                    if(is_int($insertedId)){ 
                        $server_site_path = base_url();
                        $templateName = $this->storeActvTmplName;
                        $sociaFB = 'javascript:void(0);';
                        $socialTwitter = 'javascript:void(0);';
                        $socialYoutube = 'javascript:void(0);';
                        $socialLinkedin = 'javascript:void(0);';
                        $socialInstagram = 'javascript:void(0);';
                        $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                        $storeName = '';
                        $address = '';
                        $supportEmail = '';
                        if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                            if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                            }
                            if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                            }
                            if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                            }
                            if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                            }
                            if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                            }
                            if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                            }
                            if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                $address = $this->pageData['storeSettingInfo']->address;
                            }
                            if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                $storeName = $this->pageData['storeSettingInfo']->name;
                            }
                            if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                            }
                        }
                        $this->pageData['storeLogo'] = $store_logo;
                        $this->pageData['templateName'] = $templateName;
                        $this->pageData['sociaFB'] = $sociaFB;
                        $this->pageData['socialTwitter'] = $socialTwitter;
                        $this->pageData['socialYoutube'] = $socialYoutube;
                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                        $this->pageData['socialInstagram'] = $socialInstagram;
                        $this->pageData['cusName'] = $name;
                        $this->pageData['name'] = $storeName;
                        $this->pageData['address'] = $address;
                        $this->pageData['supportEmail'] = $supportEmail;
                        $this->pageData['storeName'] = $storeName;
                        $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/contact-us',$this->pageData); 
                        $subject ='Thank You For Contact Us | Matjary Store.';;
                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                        if($sendEmail == true){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Your Request Has Been Submitted Successfully':'وفد فدم طلبك بنجاح';
                            $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                            return json_encode($resp); exit; 
                        }else{
                            $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $errorMsg = $this->ses_lang=='en'?'Error While Contact Us Request Insertion.':'خطأ أثناء الاتصال بنا طلب الإدراج.';                                    
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    } 
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Message Is Required.':'الرسالة مطلوبة.';
                    return json_encode($resp); exit;
                }               
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Email Is Required.':'البريد الالكتروني مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Name Is Required.':'مطلوب اسم.';
            return json_encode($resp); exit;
        }     
    }
    
    public function save_subscribe(){ 
        if(isset($_POST['email']) && !empty($_POST['email'])){                       
            $email	= $this->request->getPost('email');                            
            $result = $this->SubscribesModel->insert_data(array( 
                "email" => isset($email)?$email:'',                                                                                                
                "is_active" => 1,
                "created_at" => DATETIME
            ));
            if(isset($result) && !empty($result)){                             
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'You Have Successfully Subscribed.':'لقد تم اشتراكك بنجاح.';
                $resp['redirectUrl'] = base_url('/home');
                return json_encode($resp); exit;                             
            }else{
                $errorMsg = $this->ses_lang=='en'?'Error While Subscribes Insertion.':'خطأ أثناء الاشتراك في الإدراج.';                                    
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }      
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Email Is Required.':'البريد الالكتروني مطلوب.';
            return json_encode($resp); exit;
        }           
    }

    public function terms_and_conditions(){  
        $this->pageData['pageTitle'] = 'Terms Conditions';
        $TermsConditionsData = $this->TermsConditionsModel->get_all_data();
        if(isset($TermsConditionsData) && !empty($TermsConditionsData)){
            $this->pageData['GetTCInfo'] = $TermsConditionsData;
        }
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/terms-conditions',$this->pageData);         
        }else{
            return view('store/atzshop/index',$this->pageData);
        }     
    }

    public function privacy_policy(){  
        $this->pageData['pageTitle'] = 'Privacy Policy';
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/privacy-policy',$this->pageData);         
        }else{
            return view('store/atzshop/index',$this->pageData);
        }     
    }

    public function refund_return(){  
        $this->pageData['pageTitle'] = 'Refund Return';
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/refund-return',$this->pageData);         
        }else{
            return view('store/atzshop/index',$this->pageData);
        }     
    }
    
    public function abouts_us(){  
        $this->pageData['pageTitle'] = 'About Us';
        $AboutUsModelData = $this->AboutUsModel->get_all_data();
        if(isset($AboutUsModelData) && !empty($AboutUsModelData)){
            $this->pageData['GetAboutUsInfo'] = $AboutUsModelData;
        }
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/abouts-us',$this->pageData);         
        }else{
            return view('store/atzshop/index',$this->pageData);
        }       
    }
    
    public function gift_cards(){        
        $this->pageData['pageTitle'] = 'Gift Cards';
        $this->pageData['pageId'] = 3;
        $this->pageData['GiftCardList'] = $this->GiftCardModel->get_all_active_data();
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/giftcard/gift-cards',$this->pageData);        
        }else{
            return view('store/atzshop/index',$this->pageData);
        }       
    }
    
    public function giftcard_details($giftId=''){
        $this->pageData['pageTitle'] = 'Gift Details';
        $this->pageData['giftDetails'] = $this->GiftCardModel->get_single_gift_details($giftId);
        if(isset($giftId) && !empty($giftId)){
            $cstratingCount = $this->GiftCardFeedbacksModel->get_customer_feedback_count_ratting($giftId); 
            if(isset($cstratingCount) && !empty($cstratingCount)){
                $this->pageData['cstratingCount'] = $cstratingCount;
            }
            $cstavgCount = $this->GiftCardFeedbacksModel->get_customer_feedback_avg_ratting($giftId); 
            if(isset($cstavgCount) && !empty($cstavgCount)){
                $this->pageData['cstavgCount'] = $cstavgCount;
            }
            $get_gc_feedback_all = $this->GiftCardFeedbacksModel->get_all_fb($giftId); 
            if(isset($get_gc_feedback_all) && !empty($get_gc_feedback_all)){
                $this->pageData['getGcFeedbackAll'] = $get_gc_feedback_all;
            }
            
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/giftcard/giftcard-details',$this->pageData);       
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Id Is Required.':'رقم الهدية مطلوب.';
            return json_encode($resp); exit;
        }
    }
    
    public function my_gift_cards(){     
        $this->pageData['pageTitle'] = 'My Gift Cards';
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){   
            $GiftCardPurchData = $this->GiftCardModel->get_gift_purchased_details($this->ses_custmr_id);
            if(isset($GiftCardPurchData) && !empty($GiftCardPurchData)){
                $this->pageData['GetGiftCardPurchasedInfo'] = $GiftCardPurchData;
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-gift-cards',$this->pageData);      
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }       
    }

    public function my_giftcard_details($giftPrchdId=''){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){ 
            if(isset($giftPrchdId) && !empty($giftPrchdId)){
                $this->pageData['pageTitle'] = 'My Gift Details';
                $this->pageData['mySnglGCDetails'] = $this->GiftCardModel->my_single_gc_details($giftPrchdId,$this->ses_custmr_id);
                $this->pageData['giftCardHistory'] = $this->OrderModel->get_cus_gcwise_data($giftPrchdId,$this->ses_custmr_id);
                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                    return view('store/'.$this->storeActvTmplName.'/customer/my-giftcard-details',$this->pageData);     
                }else{
                    return view('store/atzshop/index',$this->pageData);
                }
            }else{  
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Id Is Required.':'رقم الهدية مطلوب.';
                return json_encode($resp); exit;
            }
        }else{
            return redirect()->to('/customer/login');
        }  
    }

    public function apply_giftcard_code(){
        if(isset($_POST['gc_code']) && !empty($_POST['gc_code'])){
            if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                if(isset($_POST['totalprice']) && !empty($_POST['totalprice'])){
                    $gcStatus = $this->GiftCardModel->is_customer_gc_valid($_POST['gc_code'],$_POST['customerid'],$_POST['totalprice']);
                    $resp['responseCode'] = $gcStatus['statusCode'];
                    $resp['responseMessage'] = $gcStatus['statusMessage'];
                    $resp['responseData'] = isset($gcStatus['statusData'])?$gcStatus['statusData']:'';
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Total Price Is Required.':'السعر الإجمالي مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{  
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Customer id Is Required.':'معرف العميل مطلوب.';
                return json_encode($resp); exit;
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Card Code Is Required.':'مطلوب كود بطاقة الهدايا.';
            return json_encode($resp); exit;
        }
    }
    
    public function my_orders(){    
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'My Orders';
            $this->pageData['pageCostomAssetsLib'] = 'datatables';
            $customerOrderHistory = $this->OrderModel->get_userwise_active_data($this->ses_custmr_id);
            if(isset($customerOrderHistory) && !empty($customerOrderHistory)){
                $this->pageData['customerOrderHistoryList'] = $customerOrderHistory;
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-orders',$this->pageData);     
            }else{
                return view('store/atzshop/index',$this->pageData);
            } 
        }else{
            return redirect()->to('/customer/login');
        }       
    }  
    
    public function order_details($orderId){   
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){    
            $this->pageData['orderDetails'] = $this->OrderModel->get_my_single_order_details($orderId,$this->ses_custmr_id);
            if(isset($this->pageData['orderDetails']['orderInfo']) && !empty($this->pageData['orderDetails']['orderInfo'])){
                $this->pageData['pageTitle'] = 'Orders Details';
                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                    return view('store/'.$this->storeActvTmplName.'/customer/order-details',$this->pageData);     
                }else{
                    return view('store/atzshop/index',$this->pageData);
                }
            }else{
                $res['responseCode'] = 403;
                $res['responseMessage'] = $this->ses_lang=='en'?'Access Denied.':'تم الرفض.';
                echo json_encode($res); exit;
            }
        }else{
            return redirect()->to('/customer/login');
        }         
    } 

    public function cancel_order_confirm($orderId){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'Orders Details';
            $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderId);
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/cancel-order-confirm',$this->pageData);      
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }   
    }

    public function cancel_order(){
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            if(isset($_POST['orderid']) && !empty($_POST['orderid'])){
                if(isset($_POST['customerid']) && !empty($_POST['customerid'])){
                    $orderDeta = $this->OrderModel->get_single_order_details($_POST['orderid']);
                    if(isset($orderDeta) && !empty($orderDeta)){
                        if($orderDeta['orderInfo']->payment_type==2 || $orderDeta['orderInfo']->payment_type==3){
                            /* raise the refund request if customer already paid the cancelled order amount */
                            $insertedId = $this->OrderModel->insert_order_refund_request(array(                                                                                                     
                                "customer_id" =>isset($_POST['customerid'])?$_POST['customerid']:0,
                                "order_id" => isset($_POST['orderid'])?$_POST['orderid']:0,                                 
                                "refund_amount" => isset($orderDeta['orderInfo']->total_price)?$orderDeta['orderInfo']->total_price:0,                                                                                                 
                                "refund_reason"=>isset($_POST['cancelreason'])?$_POST['cancelreason']:'Refund Reason',
                                "other_reason"=>isset($_POST['other_reason'])?$_POST['other_reason']:'Other Reason',
                                "is_active" => 1,
                                "created_at" => DATETIME
                            ));                       
                            if(filter_var($insertedId, FILTER_VALIDATE_INT) === false){
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = 'Error While Raising Order Refund Request on Order Cancellation.';
                                return json_encode($resp); exit; 
                            }else{
                                $affectedId = $this->OrderModel->update_data($_POST['orderid'], array(
                                    "customer_id"=>$_POST['customerid'],
                                    "order_status"=>3,
                                    "updated_at"=> DATETIME
                                ));
                                if(is_int($affectedId)){
                                    /* Notification Code For Refund Request Raised By Customer Start*/
                                    $refundRequesrt = base_url('admin/all-refund-request'); 
                                    $this->NotificationsModel->insert_data(array(                                                                           
                                        "type_id" => 3,
                                        "is_seen" => 0,                                  
                                        "reff_link" => isset($refundRequesrt)?$refundRequesrt:'',    
                                        "created_at" => DATETIME
                                    ));
                                    /* Notification Code For Refund Request Raised By Customer End*/
                                    /*Email Sending For when customer cancelled order*/
                                    $server_site_path = base_url();
                                    $templateName = $this->storeActvTmplName;
                                    $email = $this->ses_custmr_email;
                                    $sociaFB = 'javascript:void(0);';
                                    $socialTwitter = 'javascript:void(0);';
                                    $socialYoutube = 'javascript:void(0);';
                                    $socialLinkedin = 'javascript:void(0);';
                                    $socialInstagram = 'javascript:void(0);';
                                    $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                    $storeName = '';
                                    $address = '';
                                    $supportEmail = '';
                                    if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                        if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                            $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                            $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                            $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                            $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                            $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                            $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                            $address = $this->pageData['storeSettingInfo']->address;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                            $storeName = $this->pageData['storeSettingInfo']->name;
                                        }
                                        if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                            $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                        }
                                    }
                                    $this->pageData['storeLogo'] = $store_logo;
                                    $this->pageData['templateName'] = $templateName;
                                    $this->pageData['sociaFB'] = $sociaFB;
                                    $this->pageData['socialTwitter'] = $socialTwitter;
                                    $this->pageData['socialYoutube'] = $socialYoutube;
                                    $this->pageData['socialLinkedin'] = $socialLinkedin;
                                    $this->pageData['socialInstagram'] = $socialInstagram;
                                    $this->pageData['cusName'] = $this->ses_custmr_name;
                                    $this->pageData['name'] = $storeName;
                                    $this->pageData['storeName'] = $storeName;
                                    $this->pageData['address'] = $address;
                                    $this->pageData['supportEmail'] = $supportEmail;
                                    $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($_POST['orderid']);
                                    $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/order-cancel-email',$this->pageData); 
                                    $subject = 'Customer Order Cancelled.';
                                    if (isset($supportEmail) && !empty($supportEmail)) {
                                        $sendEmail = $this->sendEmail($supportEmail,$mailBody,$subject);
                                    }
                                    $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                                
                                    /*Email Cancelled Code End */
                                    if($sendEmail == true){
                                        $resp['responseCode'] = 200;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Order Cancelled Successfully.':'تم إلغاء الطلب بنجاح.';
                                        $resp['redirectUrl'] = base_url('customer/my-orders');
                                        return json_encode($resp); exit;
                                    }else{
                                        $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $errorMsg;
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 400;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Order Cancellation.':'خطأ أثناء إلغاء الطلب.';
                                    return json_encode($resp); exit;
                                }
                            }
                        }else{
                            $affectedId = $this->OrderModel->update_data($_POST['orderid'], array(
                                "customer_id"=>$_POST['customerid'],
                                "order_status"=>3,
                                "updated_at"=> DATETIME
                            ));
                            if(filter_var($affectedId, FILTER_VALIDATE_INT) === false){
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Order Cancellation.':'خطأ أثناء إلغاء الطلب.';
                                return json_encode($resp); exit;
                            }else{
                                /* Notification Code For Customer Cancel Order*/
                                $cancelRequesrt = base_url('admin/all-orders'); 
                                $this->NotificationsModel->insert_data(array(                                                                           
                                    "type_id" => 5,
                                    "is_seen" => 0,                                  
                                    "reff_link" => isset($cancelRequesrt)?$cancelRequesrt:'',    
                                    "created_at" => DATETIME
                                ));
                                /* Notification Code For Customer Cancel Order End*/

                                /*Email Sending For when customer cancelled order*/
                                $server_site_path = base_url();
                                $templateName = $this->storeActvTmplName;
                                $email = $this->ses_custmr_email;
                                $sociaFB = 'javascript:void(0);';
                                $socialTwitter = 'javascript:void(0);';
                                $socialYoutube = 'javascript:void(0);';
                                $socialLinkedin = 'javascript:void(0);';
                                $socialInstagram = 'javascript:void(0);';
                                $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                $storeName = '';
                                $address = '';
                                $supportEmail = '';
                                if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                                    if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                        $store_logo = $server_site_path.'/uploads/logo/'.$this->pageData['storeSettingInfo']->logo; 
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_fb_link) && !empty($this->pageData['storeSettingInfo']->social_fb_link)) {
                                        $sociaFB = $this->pageData['storeSettingInfo']->social_fb_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_twitter_link) && !empty($this->pageData['storeSettingInfo']->social_twitter_link)) {
                                        $socialTwitter = $this->pageData['storeSettingInfo']->social_twitter_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_youtube_link) && !empty($this->pageData['storeSettingInfo']->social_youtube_link)) {
                                        $socialYoutube = $this->pageData['storeSettingInfo']->social_youtube_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_linkedin_link) && !empty($this->pageData['storeSettingInfo']->social_linkedin_link)) {
                                        $socialLinkedin = $this->pageData['storeSettingInfo']->social_linkedin_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->social_instagram_link) && !empty($this->pageData['storeSettingInfo']->social_instagram_link)) {
                                        $socialInstagram = $this->pageData['storeSettingInfo']->social_instagram_link;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->address) && !empty($this->pageData['storeSettingInfo']->address)) {
                                        $address = $this->pageData['storeSettingInfo']->address;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->name) && !empty($this->pageData['storeSettingInfo']->name)) {
                                        $storeName = $this->pageData['storeSettingInfo']->name;
                                    }
                                    if (isset($this->pageData['storeSettingInfo']->support_email) && !empty($this->pageData['storeSettingInfo']->support_email)) {
                                        $supportEmail = $this->pageData['storeSettingInfo']->support_email;
                                    }
                                }
                                $this->pageData['storeLogo'] = $store_logo;
                                $this->pageData['templateName'] = $templateName;
                                $this->pageData['sociaFB'] = $sociaFB;
                                $this->pageData['socialTwitter'] = $socialTwitter;
                                $this->pageData['socialYoutube'] = $socialYoutube;
                                $this->pageData['socialLinkedin'] = $socialLinkedin;
                                $this->pageData['socialInstagram'] = $socialInstagram;
                                $this->pageData['cusName'] = $this->ses_custmr_name;
                                $this->pageData['name'] = $storeName;
                                $this->pageData['storeName'] = $storeName;
                                $this->pageData['address'] = $address;
                                $this->pageData['supportEmail'] = $supportEmail;
                                $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($_POST['orderid']);
                                $mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/order-cancel-email',$this->pageData); 
                                $subject = $storeName.' - Customer Order Cancelled.';
                                if (isset($supportEmail) && !empty($supportEmail)) {
                                    $sendEmail = $this->sendEmail($supportEmail,$mailBody,$subject);
                                }
                                $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                                /*Email Cancelled Code End */
                                if($sendEmail == true){
                                    $resp['responseCode'] = 200;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Order Cancelled Successfully.':'تم إلغاء الطلب بنجاح.';
                                    $resp['redirectUrl'] = base_url('customer/my-orders');
                                    return json_encode($resp); exit;
                                }else{
                                    $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $errorMsg;
                                    return json_encode($resp); exit;
                                }
                            }
                        }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Order Does Not Exist.':'الطلب غير موجود.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Customer Id Is Required.':'معرف العميل مطلوب.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Order Id Is Required.':'مطلوب معرف الطلب.';
                return json_encode($resp); exit;
            }
        }else{
            return redirect()->to('/customer/login');
        } 
    }
     
    public function my_wishlist(){    
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'My Wishlist';  
            $customerWishlistProducts = $this->WishlistModel->get_customer_cart_data($this->ses_custmr_id);
            if(isset($customerWishlistProducts) && !empty($customerWishlistProducts)){
                $this->pageData['CstmrProductWishList'] = $customerWishlistProducts;
            }
            if(isset($this->ses_logged_in) && $this->ses_logged_in===true){             
                $cstmrWishPrdctList = $this->WishlistModel->get_customer_wishlist_products($this->ses_custmr_id); 
                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                    $this->pageData['cstmrWishPrdctList'] = $cstmrWishPrdctList;
                }                
            }
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-wishlist',$this->pageData);       
            }else{
                return view('store/atzshop/index',$this->pageData);
            }
        }else{
            return redirect()->to('/customer/login');
        }    
    }  

    public function gift_card_post_feedback($gcId=''){        
        $this->pageData['pageTitle'] = 'Gift Card Feedback';
        $this->pageData['GiftCardDetails'] = $this->GiftCardModel->get_single_gift_details($gcId);
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/giftcard/post-feedbacks',$this->pageData);        
        }else{
            return view('store/atzshop/index',$this->pageData);
        }   
    }

    public function save_gift_card_feedback(){
        if(isset($_POST['ratting']) && !empty($_POST['ratting'])){
            if(isset($_POST['feedback']) && !empty($_POST['feedback'])){
                $ratting	= $this->request->getPost('ratting');                            
                $feedback = $this->request->getPost('feedback');
                $gc_id	= $this->request->getPost('gc_id');   
                $customer_id = $this->request->getPost('customer_id');
                $result = $this->GiftCardFeedbacksModel->insert_data(array(  
                    "ratting" => isset($ratting)?$ratting:'',                                  
                    "feedback" => isset($feedback)?$feedback:'',  
                    "gc_id" => isset($gc_id)?$gc_id:'',  
                    "customer_id" => isset($customer_id)?$customer_id:'',                                                                                                
                    "is_active" => 1,
                    "created_at" => DATETIME
                ));
                if(isset($result) && !empty($result)){                             
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Gift Card Review Added Successfully.':'تمت إضافة مراجعة بطاقة الهدايا بنجاح.';
                    $resp['redirectUrl'] = base_url('giftcard/giftcard-details/'.$gc_id);
                    return json_encode($resp); exit;                             
                }else{
                    $errorMsg = $this->ses_lang=='en'?'Error While Review Insertion.':'خطأ أثناء مراجعة الإدراج.';                                    
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }                             
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Feedback Is Required.':'التعليقات مطلوبة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Rating Is Required.':'مطلوب حشرجة الموت.';
            return json_encode($resp); exit;
        }       
    }

    public function view_gift_card_feedback($gcId=''){        
        $this->pageData['pageTitle'] = 'View Feedback';        
        $this->pageData['GiftCardDetails'] = $this->GiftCardModel->get_single_gift_details($gcId);
        $ses_logged_in = $this->session->get('ses_logged_in');
        if(isset($ses_logged_in) && $ses_logged_in===true){
            $ses_custmr_id = $this->session->get('ses_custmr_id');
            $gcFeedBackInfo = $this->GiftCardFeedbacksModel->get_customer_feedback_gift_card($ses_custmr_id,$gcId); 
            if(isset($gcFeedBackInfo) && !empty($gcFeedBackInfo)){
                $this->pageData['GetGiftCardsFeedbacks'] = $gcFeedBackInfo;
            }
        }     
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/giftcard/view-feedbacks',$this->pageData);       
        }else{
            return view('store/atzshop/index',$this->pageData);
        }       
    }

    public function my_refund_request(){ 
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'My Refund Details'; 
            $this->pageData['reFundDetails'] = $this->OrderModel->get_myrefund_details_data($this->ses_custmr_id);      
            if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                return view('store/'.$this->storeActvTmplName.'/customer/my-refund-request',$this->pageData);       
            }else{
                return view('store/atzshop/index',$this->pageData);
            }   
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function single_refund_details($orderId){ 
        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['pageTitle'] = 'Refund Details';  
            $this->pageData['orderDetails'] = $this->OrderModel->get_my_single_refund_details($orderId,$this->ses_custmr_id);  
            $this->pageData['checkrefundApproved'] = $this->OrderModel->check_refund_detals($orderId); 
            if(isset($this->pageData['orderDetails']['orderInfo']) && !empty($this->pageData['orderDetails']['orderInfo'])){
                if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
                    return view('store/'.$this->storeActvTmplName.'/customer/refund-details',$this->pageData);      
                }else{
                    return view('store/atzshop/index',$this->pageData);
                } 
            }else{
                $res['responseCode'] = 403;
                $res['responseMessage'] = $this->ses_lang=='en'?'Access Denied.':'تم الرفض.';
                echo json_encode($res); exit;
            }
        }else{
            return redirect()->to('/customer/login');
        }
    }

    public function uploadFile($path, $image) {
		if ($image->isValid() && ! $image->hasMoved()) {
			$newName = $image->getRandomName();
			$image->move('./'.$path, $newName);
			//return $path.$image->getName();
            return $image->getName();
		}
		return "";
	}

    public function search(){
        if(isset($_POST['query']) && !empty($_POST['query'])){
            $actionUrl = base_url('/product/products');
            $output = '';
            $ses_lang = 'ar';
            if(isset($this->ses_lang) && !empty($this->ses_lang)){
                $ses_lang = $this->ses_lang;
            }
            $searchResult = $this->public_search($_POST['query'],$ses_lang);
            if(isset($searchResult) && !empty($searchResult)){
                foreach($searchResult as $searchResultData){
                    $output .= '
                    <li class="list-group-item contsearch">
                        <a href="'.$actionUrl.'?query='.$searchResultData.'" class="gsearch" style="color:#333;text-decoration:none;">'.$searchResultData.'</a>
                    </li>
                    ';
                }
            }else{
                    $output .= '
                    <li class="list-group-item contsearch">
                        <a href="#" class="gsearch" style="color:#333;text-decoration:none;">'.$this->ses_lang=='en'?'لاتوجد بيانات':'No Data Found'.'</a>
                    </li>
                    ';
            }
            echo $output;
        }
    }

    public function cookie_policy(){  
        $this->pageData['pageTitle'] = 'Cookie Policy';
        if(isset($this->storeActvTmplName) && !empty($this->storeActvTmplName)){
            return view('store/'.$this->storeActvTmplName.'/customer/cookie-policy',$this->pageData);         
        }else{
            return view('store/atzshop/index',$this->pageData);
        }       
    }
    
}
?>
