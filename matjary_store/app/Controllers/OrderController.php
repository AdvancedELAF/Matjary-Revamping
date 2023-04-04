<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class OrderController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        $this->is_all_mandotory_modules_filled();
    }

    public function all_orders(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Customer Orders';  
            $this->pageData['adminPageId'] = 3;
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['AllOrders'] = $this->OrderModel->get_all_data();     
            return view('store_admin/order/all-orders',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function single_order_details($orderId){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Order Details';  
            $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderId);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();  
            //echo '<pre>'; print_r($this->pageData['orderDetails']); exit;    
            return view('store_admin/order/order-details',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function all_refund_request(){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Refund Details';  
            $this->pageData['adminPageId'] = 4;
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['all_refund_request'] = $this->OrderModel->all_refund_request();
            
            return view('store_admin/order/all-refund-request',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function single_refund_details($orderId){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Refund Details';  
            $this->pageData['orderDetails'] = $this->OrderModel->get_single_refund_details($orderId);  
            $this->pageData['checkrefundApproved'] = $this->OrderModel->check_refund_detals($orderId);    
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //echo '<pre>'; print_r($this->pageData['checkrefundApproved']); exit;    
            return view('store_admin/order/refund-details',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function approve_refund_request(){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){ 
            //echo '<pre>'; print_r($_POST); exit;
            if(isset($_POST['orderid']) && !empty($_POST['orderid'])){

                $orderDetails = $this->OrderModel->get_single_order_details($_POST['orderid']);
                $refundOrderInfo = $this->OrderModel->check_refund_detals($_POST['orderid']);
               
                $cart_amount = '';
                $tran_ref = '';
                if(isset($orderDetails) && !empty($orderDetails)){
                    $cart_amount = isset($orderDetails['orderInfo']->total_price)?number_format((float)$orderDetails['orderInfo']->total_price, 2, '.', ''):'';
                    $tran_ref = isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'';
                }
               
                $cart_description = 'Refund reason';
                if(isset($refundOrderInfo) && !empty($refundOrderInfo)){
                    if(isset($refundOrderInfo->refund_reason) && !empty($refundOrderInfo->refund_reason)){
                        $cart_description = $refundOrderInfo->refund_reason;
                    }
                }

                if(!empty($orderDetails['orderInfo']->payment_type) && $orderDetails['orderInfo']->payment_type==2){
                    /*refund intiated paytabs api start*/
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://secure.paytabs.sa/payment/request',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "profile_id": '.PAYTABS_PROFILE_ID_TEST.',
                        "tran_type": "refund",
                        "tran_class": "ecom",
                        "cart_id": "cart_66666",
                        "cart_currency": "SAR",
                        "cart_amount": '.$cart_amount.',
                        "cart_description": "'.$cart_description.'",
                        "tran_ref": "'.$tran_ref.'"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: SWJNTLGLNB-JBTRDDN6DM-WW6DGD9DJD'
                    ),
                    ));
                    /*update order table with refund request start*/
                    $apiPayTabsRefundRequest = '{
                        "profile_id": '.PAYTABS_PROFILE_ID_TEST.',
                        "tran_type": "refund",
                        "tran_class": "ecom",
                        "cart_id": "cart_66666",
                        "cart_currency": "SAR",
                        "cart_amount": '.$cart_amount.',
                        "cart_description": "'.$cart_description.'",
                        "tran_ref": "'.$tran_ref.'"
                    }';
                    $affectedId = $this->OrderModel->update_data($_POST['orderid'], array(
                        "id"=>$_POST['orderid'],
                        "refund_req"=>$apiPayTabsRefundRequest,
                        "updated_at"=> DATETIME
                    ));
                    if(!is_int($affectedId)){
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Order Updation." : "خطأ أثناء تحديث الطلب.";
                        return json_encode($resp); exit;
                    }
                    /*update order table with refund request end*/
                    $apiPayTabsRefundResponse = curl_exec($curl);
                    //echo '<pre>'; print_r($apiPayTabsRefundResponse); exit;
                    $apiPayTabsRefundResponse = json_decode($apiPayTabsRefundResponse);
                    //echo '<pre>'; print_r($apiPayTabsRefundResponse); exit;
                    if(isset($apiPayTabsRefundResponse->payment_result->response_status) && $apiPayTabsRefundResponse->payment_result->response_status=='A'){
                        /*update order table with refund response start*/
                        $affectedId = $this->OrderModel->update_data($_POST['orderid'], array(
                            "id"=>$_POST['orderid'],
                            "refund_res"=>json_encode($apiPayTabsRefundResponse),
                            "updated_at"=> DATETIME
                        ));
                        if(!is_int($affectedId)){
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Order Updation." : "خطأ أثناء تحديث الطلب.";
                            return json_encode($resp); exit;
                        }
                        /*update order table with refund response end*/

                        /*get order items details start*/
                        $cartItemList = isset($orderDetails['orderProductItemsInfo'])?$orderDetails['orderProductItemsInfo']:'';
                        /*get order items details end*/
                        /*update Products table with stock_quantity start*/
                        if(isset($cartItemList) && !empty($cartItemList)){
                            foreach($cartItemList as $cartItemData){
                                /* get product stock quantity */
                                $productRow = $this->ProductModel->find($cartItemData->product_id);
                                $stock_quantity = $productRow['stock_quantity'] + $cartItemData->product_qty;
                                /* update product stock quantity */
                                $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData->product_id,array(
                                    "stock_quantity"=>$stock_quantity
                                ));
                            }
                        }
                        /*update Products table with stock_quantity end*/

                        $is_approved = $this->OrderModel->refund_approved_by_admin($_POST['orderid'],$this->ses_user_id);     
                        if($is_approved==true){ 
                            
                            /*Email Sending when customer refund has approved*/
                            $server_site_path = base_url();
                            $cusEmail = $orderDetails['orderInfo']->email;
                            $sociaFB = 'javascript:void(0);';
                            $socialTwitter = 'javascript:void(0);';
                            $socialYoutube = 'javascript:void(0);';
                            $socialLinkedin = 'javascript:void(0);';
                            $socialInstagram = 'javascript:void(0);';
                            $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
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
                            $this->pageData['sociaFB'] = $sociaFB;
                            $this->pageData['socialTwitter'] = $socialTwitter;
                            $this->pageData['socialYoutube'] = $socialYoutube;
                            $this->pageData['socialLinkedin'] = $socialLinkedin;
                            $this->pageData['socialInstagram'] = $socialInstagram;
                            $this->pageData['cusName'] = isset($this->pageData['orderInfo']->customer_name)?$this->pageData['orderInfo']->customer_name:'';
                            $this->pageData['refundedAmount'] = isset($cart_amount)?$cart_amount:'';
                            $this->pageData['paymentMethod'] = 'Online Banking';
                            $this->pageData['address'] = $address;
                            $this->pageData['supportEmail'] = $supportEmail;
                            $this->pageData['cusEmail'] = $cusEmail;
                            $this->pageData['storeName'] = $storeName;
                            $store_admin_mailBody = view('store_admin/email-templates/refund-request-approval',$this->pageData); 
                            $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/refund-request-approval',$this->pageData); 
                            $subject ='Cancelled Order Refund Approved Successfully.';

                            if (isset($cusEmail) && !empty($cusEmail)) {
                                $sendEmail = $this->sendEmail($cusEmail,$store_mailBody,$subject);
                            }
                            if (isset($supportEmail) && !empty($supportEmail)) {
                                $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$subject);
                                if($sendEmail == false){
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = 'Error While sending mail.';
                                    return json_encode($resp); exit;
                                }
                            } 
                            //$sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$subject);
                            
                            if($sendEmail == true){
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Refund is Approved Successfully." : "تمت الموافقة على رد الأموال بنجاح.";
                                $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                                return json_encode($resp); exit;   
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Sending Email." : "خطأ أثناء إرسال البريد الإلكتروني.";                                                               
                                $resp['responseCode'] = 500;
                                $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                                return json_encode($resp); exit;
                            }                
                        }else{                                  
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Refund Request Approval ." : "خطأ أثناء الموافقة على طلب الاسترداد.";
                            $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                            return json_encode($resp); exit;                   
                        } 
                    }else{
                        /*update order table with refund response start*/
                        $affectedId = $this->OrderModel->update_data($_POST['orderid'], array(
                            "id"=>$_POST['orderid'],
                            "refund_res"=>json_encode($apiPayTabsRefundResponse),
                            "updated_at"=> DATETIME
                        ));
                        if(!is_int($affectedId)){
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Order Updation." : "خطأ أثناء تحديث الطلب.";
                            return json_encode($resp); exit;
                        }
                        /*update order table with refund response end*/
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $apiPayTabsRefundResponse->payment_result->response_message;
                        $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                        return json_encode($resp); exit; 
                    }
                    curl_close($curl);
                    /*refund intiated paytabs api start*/
                }elseif(!empty($orderDetails['orderInfo']->payment_type) && $orderDetails['orderInfo']->payment_type==3){
                    /*get gift card info to refund and reset the giftcard balance amount start*/
                    $refundGiftCardInfo = $this->GiftCardModel->get_single_purchased_gc_details($orderDetails['orderInfo']->giftcard_prchsed_id);
                    $gc_refund_amount = $refundGiftCardInfo->gc_balance + $orderDetails['orderInfo']->giftcard_amount;
                    /*get gift card info to refund and reset the giftcard balance amount end*/
                    /*update GiftCardPurchased table with refund amount start*/
                    $affectedId = $this->GiftCardModel->update_single_purchased_gc_details($orderDetails['orderInfo']->giftcard_prchsed_id, $gc_refund_amount);
                    if($affectedId==false){
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Gift Card Balance Updation." : "خطأ أثناء تحديث رصيد بطاقة الهدايا.";
                        return json_encode($resp); exit;
                    }
                    /*update order table with refund response end*/
                    /*get order items details start*/
                    $cartItemList = isset($orderDetails['orderProductItemsInfo'])?$orderDetails['orderProductItemsInfo']:'';
                    /*get order items details end*/
                    /*update Products table with stock_quantity start*/
                    if(isset($cartItemList) && !empty($cartItemList)){
                        foreach($cartItemList as $cartItemData){
                            /* get product stock quantity */
                            $productRow = $this->ProductModel->find($cartItemData->product_id);
                            $stock_quantity = $productRow['stock_quantity'] + $cartItemData->product_qty;
                            /* update product stock quantity */
                            $affectedId = $this->OrderModel->upt_product_stock_qty($cartItemData->product_id,array(
                                "stock_quantity"=>$stock_quantity
                            ));
                        }
                    }
                    /*update Products table with stock_quantity end*/
                    $is_approved = $this->OrderModel->refund_approved_by_admin_and_amount_refunded_in_gc($_POST['orderid'],$this->ses_user_id);     
                    if($is_approved==true){   
                        
                        /*Email Sending For when customer refund approved*/
                        $server_site_path = base_url();
                        $cusEmail = $orderDetails['orderInfo']->email;
                        $sociaFB = 'javascript:void(0);';
                        $socialTwitter = 'javascript:void(0);';
                        $socialYoutube = 'javascript:void(0);';
                        $socialLinkedin = 'javascript:void(0);';
                        $socialInstagram = 'javascript:void(0);';
                        $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
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
                        $this->pageData['sociaFB'] = $sociaFB;
                        $this->pageData['socialTwitter'] = $socialTwitter;
                        $this->pageData['socialYoutube'] = $socialYoutube;
                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                        $this->pageData['socialInstagram'] = $socialInstagram;
                        $this->pageData['cusName'] = isset($this->pageData['orderInfo']->customer_name)?$this->pageData['orderInfo']->customer_name:'';
                        $this->pageData['refundedAmount'] = isset($cart_amount)?$cart_amount:'';
                        $this->pageData['paymentMethod'] = 'Paid by GiftCard';
                        $this->pageData['address'] = $address;
                        $this->pageData['supportEmail'] = $supportEmail;
                        $this->pageData['cusEmail'] = $cusEmail;
                       $this->pageData['storeName'] = $storeName;
                        $store_admin_mailBody = view('store_admin/email-templates/refund-request-approval',$this->pageData); 
                        $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/refund-request-approval',$this->pageData); 
                        $subject ='Cancelled Order Refund Approved Successfully.';
                        if (isset($cusEmail) && !empty($cusEmail)) {
                            $sendEmail = $this->sendEmail($cusEmail,$store_mailBody,$subject);
                        }
                        $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$subject);
                        
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Refund is Approved and Refunded Amount Successfully Credited into Gift Card Balance." : "تمت الموافقة على رد الأموال وتم استرداد المبلغ بنجاح في رصيد بطاقة الهدايا.";                       
                        $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                        return json_encode($resp); exit;                   
                    }else{                                  
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Refund Request Approval and refunding amount into gift card balance." : "حدث خطأ أثناء الموافقة على طلب رد الأموال ورد المبلغ إلى رصيد بطاقة الهدايا.";
                       
                        $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                        return json_encode($resp); exit;                   
                    } 

                }

            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "order id is required." : "مطلوب معرف الطلب."; 
                return json_encode($resp); exit;  
            }
        }else{
            return redirect()->to('/admin/login');
        }
    }

  
}

?>



