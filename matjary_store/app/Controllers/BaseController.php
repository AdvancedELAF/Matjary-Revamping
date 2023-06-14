<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\ProdCatModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\BannerModel;
use App\Models\FaqModel;
use App\Models\CartModel;
use App\Models\SettingModel;
use App\Models\ProductFeedBackModel;
use App\Models\CustomerAddressesModel;
use App\Models\PaymentModel;
use App\Models\ContactUsModel;
use App\Models\SubscribesModel;
use App\Models\BrandModel;
use App\Models\TermsConditionsModel;
use App\Models\AboutUsModel;
use App\Models\OrderModel;
use App\Models\CommonModel;
use App\Models\GiftCardModel;
use App\Models\CouponModel;
use App\Models\ColorModel;
use App\Models\SizeModel;
use App\Models\WishlistModel;
use App\Models\ShippingModel;
use App\Models\GiftCardFeedbacksModel;
use App\Models\AdvertisementModel;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\NotificationsModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url','html','form','text','security','file','language','cookie'];

    /* Table name define variable used in each module */

    protected $GiftCards = 'GiftCards';
    protected $Banners = 'Banners';
    protected $Advertisements = 'Advertisements';
    protected $Products = 'Products';
    protected $ProductCategories = 'ProductCategories';
    protected $Brands = 'Brands';
    protected $Colors = 'Colors';
    protected $Sizes = 'Sizes';
    protected $Coupons = 'Coupons';
    protected $Customers = 'Customers';
    protected $Users = 'Users';
    protected $Faqs = 'Faqs';
    protected $Subscribers = 'Subscribers';
    protected $ContactUs = 'ContactUs';
   
    /* "global" veriable */
    var $pageData,$storeTemplateId,$storeActvTmplName; 
    var $ProdCatModel,$ProductModel,$CustomerModel,$BannerModel,$FaqModel,$CartModel,$SettingModel,$ProductFeedBackModel,$ContactUsModel,$SubscribesModel,$BrandModel,$TermsConditionsModel,$AboutUsModel,$CouponModel,$ColorModel,$SizeModel,$WishlistModel,$OrderModel,$CommonModel,$CustomerAddressesModel,$PaymentModel,$GiftCardModel,$ShippingModel,$GiftCardFeedbacksModel,$AdvertisementModel,$UserModel,$UserRoleModel,$NotificationsModel;
    var $session,$ses_logged_in,$ses_custmr_id,$ses_custmr_name,$ses_custmr_email;
    var $ses_user_logged_in,$ses_user_id,$ses_user_name,$ses_user_email;
    var $lang_session,$ses_lang;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        
        /* Do Not Edit This Line */
        parent::initController($request, $response, $logger);
        /* Preload any models, libraries, etc, here. */
        $this->ProdCatModel         = new ProdCatModel();
        $this->ProductModel         = new ProductModel();
        $this->CustomerModel        = new CustomerModel();
        $this->BannerModel          = new BannerModel();
        $this->FaqModel             = new FaqModel();
        $this->CartModel            = new CartModel();
        $this->SettingModel         = new SettingModel();
        $this->ProductFeedBackModel = new ProductFeedBackModel(); 
        $this->ContactUsModel       = new ContactUsModel();
        $this->SubscribesModel      = new SubscribesModel();
        $this->BrandModel           = new BrandModel(); 
        $this->TermsConditionsModel = new TermsConditionsModel();
        $this->AboutUsModel         = new AboutUsModel();
        $this->CouponModel          = new CouponModel();
        $this->ColorModel           = new ColorModel();
        $this->SizeModel            = new SizeModel();
        $this->WishlistModel        = new WishlistModel();
        $this->OrderModel           = new OrderModel();
        $this->CommonModel          = new CommonModel();
        $this->CustomerAddressesModel = new CustomerAddressesModel();
        $this->PaymentModel         = new PaymentModel();
        $this->GiftCardModel        = new GiftCardModel();
        $this->ShippingModel        = new ShippingModel();
        $this->GiftCardFeedbacksModel = new GiftCardFeedbacksModel();
        $this->AdvertisementModel   = new AdvertisementModel();
        $this->UserModel            = new UserModel();
        $this->UserRoleModel        = new UserRoleModel();
        $this->NotificationsModel   = new NotificationsModel();
       
        /* E.g.: $this->session = \Config\Services::session(); */

        $this->session = \Config\Services::session();
        $this->ses_logged_in = $this->session->get('ses_logged_in');
        $this->ses_custmr_id = $this->session->get('ses_custmr_id');
        $this->ses_custmr_name = $this->session->get('ses_custmr_name');
        $this->ses_custmr_email = $this->session->get('ses_custmr_email');

        $this->ses_user_logged_in = $this->session->get('ses_user_logged_in');
        $this->ses_user_id = $this->session->get('ses_user_id');
        $this->ses_user_name = $this->session->get('ses_user_name');
        $this->ses_user_email = $this->session->get('ses_user_email');

        /* loading engilsh/arabic content start */
        $this->pageData['locale'] = $this->request->getLocale();
        $this->lang_session = $this->session->get('lang_session');
        $this->ses_lang = $this->session->get('ses_lang');
        if(isset($this->lang_session) && $this->lang_session===true){
            $this->pageData['locale'] = $this->ses_lang;
        }
        if($this->pageData['locale']=='ar'){
            $this->pageData['language'] = language($this->pageData['locale']);
        }elseif($this->pageData['locale']=='en'){
            $this->pageData['language'] = language($this->pageData['locale']);
        }
        $this->pageData['supportedLocales'] = $request->config->supportedLocales;
        /* loading engilsh/arabic content end*/

        $this->pageData['is_generalsetting_modules_filled'] = 1;
        $this->pageData['is_paymentsetting_modules_filled'] = 1;
        $this->pageData['is_shippingsetting_modules_filled'] = 1;
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['loggedInUserData'] = $this->UserModel->get_login_user_data($this->ses_user_id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();

            $generalSetting = $this->SettingModel->get_store_setting_data(); 
            if(empty($generalSetting)){
                $this->pageData['is_generalsetting_modules_filled'] = 0;
            }

            $paymentSetting = $this->PaymentModel->get_all_data();  
            if(empty($paymentSetting)){
                $this->pageData['is_paymentsetting_modules_filled'] = 0;
            }

            $shippingSetting = $this->ShippingModel->get_all_data(); 
            if(empty($shippingSetting)){
                /*check default shipping setting set 1 or 0 */
                $storeSettingInfo = $this->SettingModel->get_store_setting_data();
                if(isset($storeSettingInfo) && !empty($storeSettingInfo)){
                    if($storeSettingInfo->default_shipping==0){
                        $this->pageData['is_shippingsetting_modules_filled'] = 0;
                    }
                }
                
            }
        }

        if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
            $this->pageData['customerDetails'] = $this->CustomerModel->get_single_customer_data($this->ses_custmr_id); 
            $customerCartProducts = $this->CartModel->get_single_customer_cart_products($this->ses_custmr_id);
            if(isset($customerCartProducts) && !empty($customerCartProducts)){
                $this->pageData['snglCstmrCartProductList'] = $customerCartProducts;
            }
        }
        $this->pageData['AboutUsInfo'] = $this->AboutUsModel->get_all_data(); 
        $this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
        $this->pageData['productCategories'] = $this->ProdCatModel->get_all_active_data();
        if(isset($this->pageData['productCategories']) && !empty($this->pageData['productCategories'])){
            foreach ($this->pageData['productCategories'] as $productCatData) {
                if(isset($productCatData->id) && !empty($productCatData->id)){
                    $productCatData->subcat = $this->ProdCatModel->get_all_active_subCategory($productCatData->id);
                    if(isset($productCatData->subcat) && !empty($productCatData->subcat)){
                        foreach($productCatData->subcat as $pdctSubcatData){
                            $pdctSubcatData->subcat_level_1 = $this->ProdCatModel->get_all_active_subCategory($pdctSubcatData->id);
                        }
                    }
                }
            }
        }
        $this->pageData['storeActvTmplName'] = '';
        /* call store info api start */
        //$store_link = base_url(); /* at server side */
        $store_link = 'https://finalstore.matjary.sa/'; 
        $store_token = $this->pageData['storeSettingInfo']->auth_tkn;
        if(isset($this->pageData['storeSettingInfo']->auth_tkn) && !empty($this->pageData['storeSettingInfo']->auth_tkn)){
            $data_array =  array(
                "store_link" => $store_link,
                "store_token" => $store_token
            );
            $make_call = $this->callAPI('POST', 'https://www.matjary.sa/store-info', json_encode($data_array));
            $response = json_decode($make_call, true);
            $this->pageData['storeInfo'] = $response;
            if(isset($response['responseCode']) && $response['responseCode']==200){
                if(isset($response['responseData']) && !empty($response['responseData'])){
                    $todayDate = date('Y-m-d');
                    $todayDate = date('Y-m-d', strtotime($todayDate));
                    $planDateBegin = date('Y-m-d', strtotime($response['responseData']['plan_start_dt']));
                    $planDateEnd = date('Y-m-d', strtotime($response['responseData']['plan_expiry_dt']));
                    if ($todayDate <= $planDateEnd){
                        $storeTplId = $this->pageData['storeSettingInfo']->template_id;
                        if(isset($storeTplId) && !empty($storeTplId)){
                            $this->storeTemplateId = $storeTplId;
                        }else{
                            $this->storeTemplateId = 1;
                        }
                        $matjaryTmpltListApi = $this->callAPI('POST', 'https://www.matjary.sa/template-list', '');
                        $matjaryTmpltList = json_decode($matjaryTmpltListApi, true);
                        if(isset($matjaryTmpltList['responseCode']) && $matjaryTmpltList['responseCode']==200){
                            if(isset($matjaryTmpltList['responseData']) && !empty($matjaryTmpltList['responseData'])){
                                foreach ($matjaryTmpltList['responseData'] as $value) {
                                    if($this->storeTemplateId==$value['id']){
                                        $this->storeActvTmplName = strtolower($value['name']);
                                    }
                                }
                            }
                        }
                        $this->pageData['storeActvTmplName'] = $this->storeActvTmplName;
                    }else{
                        $resp = array(
                            'responseCode'=>404,
                            'responseMesssage'=>'Your Store Plan Has Expired, Please Renew The Plan To Get The Store Live.'
                        );
                        echo json_encode($resp); exit;
                    }
                }
            }
            /* call store info api end */
        }else{
            $resp = array(
                'responseCode'=>404,
                'responseMesssage'=>'Your Store Template Not Set To Open Store.'
            );
            echo json_encode($resp); exit;
        }

        date_default_timezone_set("Asia/Riyadh");
        
    }

    function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
           case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
           case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
           default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        /* OPTIONS: */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        /* EXECUTE: */
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    public function is_all_mandotory_modules_filled(){
        if(isset($this->pageData) && !empty($this->pageData)){
            if($this->pageData['is_generalsetting_modules_filled']==0){
                header('Location:'.base_url('admin/mandatory-modules')); exit;
            }elseif($this->pageData['is_paymentsetting_modules_filled']==0){
                header('Location:'.base_url('admin/mandatory-modules')); exit;
            }elseif($this->pageData['is_shippingsetting_modules_filled']==0){
                header('Location:'.base_url('admin/mandatory-modules')); exit;
            }
        }
    }

    public function remove_special_char_from_string($str){
        $str = preg_replace('/[^A-Za-z0-9_.-]/',' ',$str);
        return $str;
    }

    public function remove_special_char_from_keyword_tags($str){
        $str = preg_replace('/[^A-Za-z0-9_,-]/',' ',$str);
        return $str;
    }

    public function calculate_discounted_price($retail_price,$discount_per){
        $price = $retail_price;
        $percent = $discount_per;
        $discount = ($price*($percent/100));
        $discount_price = $price-$discount;
        return $discount_price;
    }

    public function calculate_profit_margin_percent($retail_price,$wholesale_price){
        $discount = $retail_price - $wholesale_price; /* Calculating discount */
        $disPercent = ($discount / $retail_price) * 100; /* Calculating discount percentage */
        return $disPercent;
    }

    public function aramex_create_shipment($param=''){
        echo '<pre>'; print_r($param); exit;
        echo '<pre>'; print_r(json_encode($param)); exit;
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
        CURLOPT_POSTFIELDS => $param,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function sendEmail($email,$message,$subject){
        $data_array =  array(
            "slag" => 'smtp'
        );
        $make_call = $this->callAPI('POST', 'https://www.matjary.sa/matjary-config', json_encode($data_array));
        $response = json_decode($make_call, true);
        $emailSentStatus = true;
        $name = $email;
        $body = $message;
        $getSubdomain = base_url(); 
        $parsedUrl = parse_url($getSubdomain);
        $host = explode('.', $parsedUrl['host']);        
        $subdomain = $host[0];
        require '../vendor/autoload.php';
        $mail = new PHPMailer(true);
        try {
            /* Server settings */
            $mail->SMTPDebug = false;                                                       /* Enable verbose debug output */
            $mail->isSMTP();                                                                /* Set mailer to use SMTP */
            $mail->Host = $response['responseData']['smpt_host'];                           /* Specify main and backup SMTP servers */
            $mail->SMTPAuth = true;                                                         /* Enable SMTP authentication */
            $mail->Username = $response['responseData']['smpt_username'];                   /* SMTP username */
            $mail->Password = $response['responseData']['smpt_password'];                   /* SMTP password */
            $mail->SMTPSecure = 'tls';                                                      /* Enable TLS encryption, `ssl` also accepted */
            $mail->Port = 587;                                                              /* TCP port to connect to */
            /* recipients */
            $mail->setFrom($response['responseData']['smtp_email_from'], ucwords($subdomain));
            $mail->addAddress($email, $name);                                               /* Add a recipient  */
            /* Content */
            $mail->isHTML(true);                                                            /* Set email format to HTML */
            $mail->Subject = $subject;
            $mail->Body    = $body;
            if($mail->Send()) {
                $emailSentStatus = true;
            }
        } catch (Exception $e) {
            $emailSentStatus = false;                                                       /* echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; */
        }

        if($emailSentStatus==false){
            $data_array =  array(
                "slag" => 'sendgrid'
            );
            $make_call = $this->callAPI('POST', 'https://www.matjary.sa/matjary-config', json_encode($data_array));
            $response = json_decode($make_call, true);
            $headers = array(
                'Authorization: Bearer '.$response['responseData']['sendgrid_bearer_token'],
                'Content-Type: application/json'
            ); 
            $data = array(
                "personalizations" => array(
                    array(
                        "to" => array(
                            array(
                                "email" => $email,
                                "name" => $name
                            )
                        )
                    )
                ),
                "from" => array(
                    "email" => $response['responseData']['sendgrid_email_from'],
                    "name" => ucwords($subdomain)
                ),
                "subject" => $subject,
                "content" => array(
                    array(
                        "type" => "text/html",
                        "value" => $body
                    )
                )
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            if(isset($response) && !empty($response)){
                $emailSentStatus = false; /* echo $mail->ErrorInfo; */
            }else{          
                $emailSentStatus = true; 
            }
        }

        return $emailSentStatus;
       
    }

    /* store public search code start (search using product name,category name,any ptoduct tags,keywords,etc.) */
    public function public_search($query_str,$ses_lang){
        $searchResult = '';
        $suggestions = array();
        $result = $this->CommonModel->search($query_str,$ses_lang);
        if(isset($result) && !empty($result)){
            /* get searched product names start */
                $ary1 = array();
                $product_names = '';
                
                $product_name_en = '';
                $tmp1 = array();
                $i=0;
                foreach($result as $row){
                    if(isset($row->title) && !empty($row->title)){
                        $tmp1[$i] = $row->title;
                    }
                    $i++;
                }
                $product_name_en = $tmp1;
                
                $product_name_ar = '';
                $tmp2 = array();
                $i=0;
                foreach($result as $row){
                    if(isset($row->title_ar) && !empty($row->title_ar)){
                        $tmp2[$i] = $row->title_ar;
                    }
                    $i++;
                }
                $product_name_ar = $tmp2;
                
                if(!empty($product_name_en)){
                    $product_names = $product_name_en;
                }
                if(!empty($product_name_ar)){
                    $product_names = $product_name_ar;
                }
                if(!empty($product_name_en) && !empty($product_name_ar)){
                    $product_names = array_merge($product_name_en,$product_name_ar);
                }
                $ary1['product_names'] = $product_names;
            /* get searched product names end */

            /* get searched product keywords start */
                $b=0;
                $ary2 = array();
                foreach($result as $row){
                    $product_keywords = '';
                    if(isset($row->keywords) && !empty($row->keywords)){
                        $keywords_en = '';
                        $keywords = array();
                        if(strpos($row->keywords, ",") !== false){
                            $keywords = explode(",",$row->keywords);
                        }else{
                            $keywords[0] = $row->keywords;
                        }
                        $tmp = array();
                        $i=0;
                        foreach($keywords as $keywordValues){
                            $keyword = trim($keywordValues," ");
                            $tmp[$i] = trim($keyword,".");
                            $i++;
                        }
                        $keywords_en = $tmp;
                    }
                    if(isset($row->keywords_ar) && !empty($row->keywords_ar)){
                        $keywords_ar = '';
                        $keywords = array();
                        if(strpos($row->keywords_ar, "،") !== false){
                            $strReplaceedStr = str_replace("،",",",$row->keywords_ar);
                            $keywords = explode(",",$strReplaceedStr);
                        }elseif(strpos($row->keywords_ar, ",") !== false){
                            $keywords = explode(",",$row->keywords_ar);
                        }else{
                            $keywords[0] = $row->keywords_ar;
                        }

                        $tmp = array();
                        $i=0;
                        foreach($keywords as $keywordValues){
                            $keyword = trim($keywordValues," ");
                            $tmp[$i] = trim($keyword,".");
                            $i++;
                        }
                        $keywords_ar = $tmp;
                    }
                    if(!empty($keywords_en)){
                        $product_keywords = $keywords_en;
                    }
                    if(!empty($keywords_ar)){
                        $product_keywords = $keywords_ar;
                    }
                    if(!empty($keywords_en) && !empty($keywords_ar)){
                        $product_keywords = array_merge($keywords_en,$keywords_ar);
                    }
                    $ary2['product_keywords'][$b] = $product_keywords;
                    $b++;
                }
            /* get searched product keywords end */

            /* get searched product tags start */
                $c=0;
                $ary3 = array();
                foreach($result as $row){
                    $product_tags = '';
                    if(isset($row->tags) && !empty($row->tags)){
                        $tags_en = '';
                        $tags = array();
                        if(strpos($row->tags, ",") !== false){
                            $tags = explode(",",$row->tags);
                        }else{
                            $tags[0] = $row->tags;
                        }
                        $tmp = array();
                        $i=0;
                        foreach($tags as $tagsValues){
                            $tag = trim($tagsValues," ");
                            $tmp[$i] = trim($tag,".");
                            $i++;
                        }
                        $tags_en = $tmp;
                    }
                    if(isset($row->tags_ar) && !empty($row->tags_ar)){
                        $tags_ar = '';

                        $tags = array();
                        if(strpos($row->tags_ar, "،") !== false){
                            $strReplaceedStr = str_replace("،",",",$row->tags_ar);
                            $tags = explode(",",$strReplaceedStr);
                        }elseif(strpos($row->tags_ar, ",") !== false){
                            $tags = explode(",",$row->tags_ar);
                        }else{
                            $tags[0] = $row->tags_ar;
                        }

                        $tmp = array();
                        $i=0;
                        foreach($tags as $tagsValues){
                            $tag = trim($tagsValues," ");
                            $tmp[$i] = trim($tag,".");
                            $i++;
                        }
                        $tags_ar = $tmp;
                    }
                    if(!empty($tags_en)){
                        $product_tags = $tags_en;
                    }
                    if(!empty($tags_ar)){
                        $product_tags = $tags_ar;
                    }
                    if(!empty($tags_en) && !empty($tags_ar)){
                        $product_tags = array_merge($tags_en,$tags_ar);
                    }
                    $ary3['product_tags'][$c] = $product_tags;
                    $c++;
                }
            /* get searched product tags end */
            $suggestions = array_merge($ary1,$ary2,$ary3);
            $suggestionAry = array();

            $sgtnAry1 = array();
            if(isset($suggestions['product_names']) && !empty($suggestions['product_names'])){
                $p=0;
                $tmp = array();
                foreach($suggestions['product_names'] as $productNameData){
                    $tmp[$p] = $productNameData;
                    $p++;
                }
                $sgtnAry1 = $tmp;
            }
            $suggestionAry = $sgtnAry1;

            $sgtnAry2 = array();
            if(isset($suggestions['product_keywords']) && !empty($suggestions['product_keywords'])){
                $p=0;
                $tmp = array();
                foreach($suggestions['product_keywords'] as $productKeywordData){
                    $tmp[$p] = $productKeywordData;
                    $p++;
                }
                $sgtnAry2 = $tmp;
                if(isset($sgtnAry2) && !empty($sgtnAry2)){
                    foreach($sgtnAry2 as $sgtnAry2Data){
                        if(isset($suggestionAry) && !empty($suggestionAry)){
                            $suggestionAry = array_merge($suggestionAry,$sgtnAry2Data);
                        }else{
                            $suggestionAry = $sgtnAry2Data;
                        }
                    }
                }
            }

            $sgtnAry3 = array();
            if(isset($suggestions['product_tags']) && !empty($suggestions['product_tags'])){
                $p=0;
                $tmp = array();
                foreach($suggestions['product_tags'] as $productTagData){
                    $tmp[$p] = $productTagData;
                    $p++;
                }
                $sgtnAry3 = $tmp;
                if(isset($sgtnAry3) && !empty($sgtnAry3)){
                    foreach($sgtnAry3 as $sgtnAry3Data){
                        if(isset($suggestionAry) && !empty($suggestionAry)){
                            $suggestionAry = array_merge($suggestionAry,$sgtnAry3Data);
                        }else{
                            $suggestionAry = $sgtnAry3Data;
                        }
                    }
                }
            }
            $searchResult = $this->make_unique_array($suggestionAry);
        }
        return $searchResult;
    }

    public function make_unique_array( $array ) {
        $unqAry = '';
        if(isset($array) && !empty($array)){
            $i=0;
            $tmp = array();
            foreach($array as $arrayVal){
                $tmp[$i] = ucwords($arrayVal);
                $i++;
            }
            $unqAry = array_unique($tmp);
        }
        return $unqAry;
    }
    /* store public search code end */

    
        

}
