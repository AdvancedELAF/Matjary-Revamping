<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class ShippingController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        
    }

    public function shipping_settings(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Shipping Setting'; 
            $this->pageData['adminPageId'] = 17; 
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['shippingCompanies'] = $this->ShippingModel->get_all_shipping_companies();    
            $this->pageData['shippingInfo'] = $this->ShippingModel->get_all_data();        
            return view('store_admin/settings/shipping-settings',$this->pageData);    
        }else{
            return redirect()->to('/admin/login');
        }   
    } 

    public function save_shipping_setting(){
        $result = true;
        if(isset($_POST['ship_cmp_id']) && !empty($_POST['ship_cmp_id'])){
            $totalCount = count($_POST['ship_cmp_id']);
            for ($i=0; $i < $totalCount; $i++) { 
                if(isset($_POST['address'][$i]) && !empty($_POST['address'][$i])){
                    if(isset($_POST['cost'][$i]) && !empty($_POST['cost'][$i])){
                        if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                            if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                                if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                             
                                        $address	= $this->remove_special_char_from_string($_POST['address'][$i]);
                                        $zipcode = $this->remove_special_char_from_string($_POST['zipcode'][$i]);
                                        $cost	= $this->remove_special_char_from_string($_POST['cost'][$i]);
                                        $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                        $ac_pin = $this->remove_special_char_from_string($_POST['ac_pin'][$i]);
                                        $username = $_POST['username'][$i];
                                        $password = $_POST['password'][$i];                                                           
                                        
                                        $ship_cmp_data = serialize(array(  
                                            "country_code" => isset($_POST['ship_cmp_country_code'][$i])?$_POST['ship_cmp_country_code'][$i]:'',
                                            "city" => isset($_POST['ship_cmp_city'][$i])?$_POST['ship_cmp_city'][$i]:'',
                                            "address" =>isset($address)?$address:'',
                                            'zipcode' => isset($zipcode)?$zipcode:'',
                                            "cost" =>isset($cost)?$cost:'',
                                            "ac_no" =>isset($ac_no)?$ac_no:'',
                                            "ac_pin"=>isset($ac_pin)?$ac_pin:'',
                                            "username" =>isset($username)?$username:'',
                                            "password" => isset($password)?$password:''
                                        ));

                                        $insertedId = $this->ShippingModel->insert_data(array(    
                                            "ship_cmp_id"=> $_POST['ship_cmp_id'][$i],
                                            "ship_cmp_data" =>isset($ship_cmp_data)?$ship_cmp_data:'',                                                                                                                               
                                            "is_active" => 1,
                                            "created_at" => DATETIME
                                        ));
        
                                        if(!is_int($insertedId)){ 
                                            $result = false;  
                                        }   
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة."; 
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Username Is Required." : "اسم المستخدم مطلوب.";
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Account No Is Required." : "رقم الحساب مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Cost Is Required." : "التكلفة مطلوبة.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Address Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                } 
            }

            if($result==true){ 
                /*update default shipping setting flag */
                $affectedRowId = $this->SettingModel->update_data(1,array(    
                    'default_shipping'=>0
                ));
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Setting Updated Successfully." : "تم تحديث إعداد الشحن بنجاح.";
                $resp['redirectUrl'] = base_url('admin/shipping-settings');
                return json_encode($resp); exit;           
            
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Genaral Setting Insertion." : "خطأ أثناء الإعداد العام للإدراج.";                                                                  
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }  
        }else{
            $resp['responseCode'] = 404;
            
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Company Is Required." : "مطلوب شركة شحن.";
            return json_encode($resp); exit;
        }
    }
    
    public function update_shipping_setting(){
        $result = true;
        if(isset($_POST['ship_cmp_id']) && !empty($_POST['ship_cmp_id'])){
            $totalCount = count($_POST['ship_cmp_id']);
            for ($i=0; $i < $totalCount; $i++) { 
                if(isset($_POST['address'][$i]) && !empty($_POST['address'][$i])){
                    if(isset($_POST['cost'][$i]) && !empty($_POST['cost'][$i])){
                        if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                            if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                                if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                             
                                        $address	= $this->remove_special_char_from_string($_POST['address'][$i]);
                                        $zipcode = $this->remove_special_char_from_string($_POST['zipcode'][$i]);
                                        $cost	= $this->remove_special_char_from_string($_POST['cost'][$i]);
                                        $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                        $ac_pin = $this->remove_special_char_from_string($_POST['ac_pin'][$i]);
                                        $username = $_POST['username'][$i];
                                        $password = $_POST['password'][$i];                                                           
                                        
                                        $ship_cmp_data = serialize(array(    
                                            "country_code" => isset($_POST['ship_cmp_country_code'][$i])?$_POST['ship_cmp_country_code'][$i]:'',
                                            "city" => isset($_POST['ship_cmp_city'][$i])?$_POST['ship_cmp_city'][$i]:'',
                                            "address" =>isset($address)?$address:'',
                                            "zipcode" => isset($zipcode)?$zipcode:'',
                                            "cost" =>isset($cost)?$cost:'',
                                            "ac_no" =>isset($ac_no)?$ac_no:'',
                                            "ac_pin"=>isset($ac_pin)?$ac_pin:'',
                                            "username" =>isset($username)?$username:'',
                                            "password" => isset($password)?$password:''
                                        ));
                                        
                                        $insertedAffectedId = $this->ShippingModel->update_data($_POST['ship_cmp_id'][$i],array(    
                                            "ship_cmp_id"=> $_POST['ship_cmp_id'][$i],
                                            "ship_cmp_data" =>isset($ship_cmp_data)?$ship_cmp_data:'',   
                                            "updated_at" => DATETIME
                                        ));

                                        if(!is_int($insertedAffectedId)){ 
                                            $result = false;  
                                        }   
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة."; 
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Username Is Required." : "اسم المستخدم مطلوب.";
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Account No Is Required." : "رقم الحساب مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Cost Is Required." : "التكلفة مطلوبة.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Address Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                } 
            }

            if($result==true){ 
                /*update default shipping setting flag */
                $affectedRowId = $this->SettingModel->update_data(1,array(    
                    'default_shipping'=>0
                ));
                
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Setting Updated Successfully." : "تم تحديث إعداد الشحن بنجاح.";
                $resp['redirectUrl'] = base_url('admin/shipping-settings');
                return json_encode($resp); exit;           
            
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Genaral Setting Updation." : "خطأ أثناء تحديث الإعداد العام.";
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }  
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Company Is Required." : "مطلوب شركة شحن.";
            return json_encode($resp); exit;
        }
    }

    public function set_default_shipping_setting(){
        /*update default shipping setting flag */
        $affectedRowId = $this->SettingModel->update_data(1,array(    
            'default_shipping'=>1
        ));

        if(isset($affectedRowId) && !empty($affectedRowId)){ 
            $resp['responseCode'] = 200;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Default Shipping Setting Set Successfully." : "تم ضبط إعداد الشحن الافتراضي بنجاح.";
            $resp['redirectUrl'] = base_url('admin/dashboard');
            return json_encode($resp); exit;           
        }else{                                                                  
            $resp['responseCode'] = 500;
            $resp['responseMessage'] = $this->ses_lang=='en' ? "Error While Set Shipping Setting Insertion." : "خطأ أثناء تعيين إدراج إعداد الشحن.";
            return json_encode($resp); exit;
        }

    }

    public function ship_orders(){
        $this->is_all_mandotory_modules_filled();
        $this->pageData['pageTitle'] = 'Shipping Orders'; 
        $this->pageData['adminPageId'] = 2;
        $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
        $this->pageData['shippingOrders'] = $this->OrderModel->get_all_shipment_orders();     
        return view('store_admin/shipping/ship-orders',$this->pageData); 
    }

    public function shipment_pickups(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Pickups'; 
            $this->pageData['adminPageId'] = 6; 
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['shippingPickups'] = $this->OrderModel->get_all_shipment_pickups();
            if(isset($this->pageData['shippingPickups']) && !empty($this->pageData['shippingPickups'])){
                foreach($this->pageData['shippingPickups'] as $pickupData){
                    $pickupData->pickup_req = json_decode($pickupData->pickup_req);
                    $pickupData->pickup_res = json_decode($pickupData->pickup_res);
                    $timestampPickupDate=substr($pickupData->pickup_req->Pickup->PickupDate,6,16);
                    
                    $timestampPickupDate = (integer) $timestampPickupDate / 1000;
                    $timestampPickupDate = substr("$timestampPickupDate", 0, 10);
                    $pickupData->pickup_datetime = date('Y-m-d H:i:s', $timestampPickupDate);
                    $pickupData->pickupStatus = 'Pending';
                    if($pickupData->pickup_req_flag==1){
                        $ReferenceID = $pickupData->pickup_req_ref_id;

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackPickup',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                            "ClientInfo": {
                                "UserName": "'.ARAMEX_USERNAME_TEST.'",
                                "Password": "'.ARAMEX_PASSWORD_TEST.'",
                                "Version": "v1",
                                "AccountNumber": "'.ARAMEX_ACCOUNT_NO_TEST.'",
                                "AccountPin": "'.ARAMEX_ACCOUNT_PIN_TEST.'",
                                "AccountEntity": "RUH",
                                "AccountCountryCode": "SA",
                                "Source": 24
                            },
                            "Reference": "'.$ReferenceID.'",
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
                        
                        $apiAramexTrackPickupResponse = curl_exec($curl);
                        //echo '<pre>'; print_r($apiAramexTrackPickupResponse); exit;
                        $apiAramexTrackPickupResponse = json_decode($apiAramexTrackPickupResponse);
                        //echo '<pre>'; print_r($apiAramexTrackPickupResponse); exit;
                        if($apiAramexTrackPickupResponse->HasErrors==false){
                            $pickupData->pickupStatus = $apiAramexTrackPickupResponse->LastStatus;
                        }else{
                            $pickupData->pickupStatus = $apiAramexTrackPickupResponse->LastStatus;
                        }
                        curl_close($curl);
                    }

                }

            } 
            
            return view('store_admin/shipping/shipment-pickups',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function track_pickup(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            if(isset($_POST['shipcmpid']) && !empty($_POST['shipcmpid'])){
                if(isset($_POST['pickreffid']) && !empty($_POST['pickreffid'])){
                    $clientInfo = $this->ShippingModel->get_shipping_cmp_info($_POST['shipcmpid']);
                    $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);

                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                    $ReferenceID = isset($_POST['pickreffid'])?$_POST['pickreffid']:'';

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackPickup',
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
                        "Reference": "'.$ReferenceID.'",
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
                    
                    $apiAramexTrackPickupRequest = '{
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
                        "Reference": "'.$ReferenceID.'",
                        "Transaction": {
                            "Reference1": "",
                            "Reference2": "",
                            "Reference3": "",
                            "Reference4": "",
                            "Reference5": ""
                        }
                    }';
                    //echo '<pre>'; print_r($apiAramexTrackPickupRequest); exit;
                    $apiAramexTrackPickupResponse = curl_exec($curl);
                    //echo '<pre>'; print_r($apiAramexTrackPickupResponse); exit;
                    curl_close($curl);

                    $apiAramexTrackPickupResponse = json_decode($apiAramexTrackPickupResponse);
                    //echo '<pre>'; print_r($apiAramexTrackPickupResponse); exit;
                    if($apiAramexTrackPickupResponse->HasErrors==false){
                        
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $apiAramexTrackPickupResponse->Message;
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $apiAramexTrackPickupResponse->Message;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Pickup Refference ID Is Required." : "مطلوب معرف مرجع الالتقاط.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Company ID Is Required." : "مطلوب معرف شركة الشحن.";
                return json_encode($resp); exit;
            }
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function cancel_pickup(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            if(isset($_POST['guid']) && !empty($_POST['guid'])){
                if(isset($_POST['shipcmpid']) && !empty($_POST['shipcmpid'])){
                    $getCusInfo = array();
                    $shippingPickupInfos = $this->OrderModel->get_single_shipment_pickups($_POST['guid']);
                    if(isset($shippingPickupInfos) && !empty($shippingPickupInfos)){
                        $i=0;
                        foreach($shippingPickupInfos as $shippingPickupData){
                            if(isset($shippingPickupData->customer_id) && !empty($shippingPickupData->customer_id)){
                                $getCusInfo[$i] = $this->CustomerModel->get_single_customer_data($shippingPickupData->customer_id);
                            }
                            $i++;
                        }
                                                  
                    }

                    if(isset($this->pageData['storeSettingInfo']->default_shipping) && $this->pageData['storeSettingInfo']->default_shipping==1){
                        $matjaryShippingInfoApi = $this->callAPI('GET', 'https://www.matjary.in/shipping-info', '');
                        $clientInfo = json_decode($matjaryShippingInfoApi, true);

                        if(isset($clientInfo['responseCode']) && $clientInfo['responseCode']==200){
                            $shipCmpInfo = $clientInfo['responseData'];

                            $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                            $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                            $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                            $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                            $PickupGUID = $_POST['guid'];

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CancelPickup',
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
                                "Comments": "Test",
                                "PickupGUID": "'.$PickupGUID.'",
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
                            
                            $apiAramexCancelPickupResponse = curl_exec($curl);
                            curl_close($curl);

                            $apiAramexCancelPickupResponse = json_decode($apiAramexCancelPickupResponse);
                            if($apiAramexCancelPickupResponse->HasErrors==false){
                                /*update shipment orders start */
                                $requestData = array(
                                    'pickup_req_flag'=>2,
                                    'updated_at'=>DATETIME
                                );
                                $affectedOrderId = $this->OrderModel->update_order_pickup_reff_id($PickupGUID,$requestData);
                                if(filter_var($affectedOrderId, FILTER_VALIDATE_INT) === false){
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while updating order shipment GUID & Refference ID." : "حدث خطأ أثناء تحديث GUID الخاص بشحنة الطلب";
                                    
                                    return json_encode($resp); exit;
                                }
                                /*update shipment orders end */

                                $server_site_path = base_url();
                                $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                                $sociaFB = 'javascript:void(0);';
                                $socialTwitter = 'javascript:void(0);';
                                $socialYoutube = 'javascript:void(0);';
                                $socialLinkedin = 'javascript:void(0);';
                                $socialInstagram = 'javascript:void(0);';
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
                                $this->pageData['address'] = $address;
                                $this->pageData['supportEmail'] = $supportEmail;
                                $this->pageData['pickupId'] = $PickupGUID;
                                $this->pageData['storeName'] = $storeName;
                                
                                $store_admin_mailBody = view('store_admin/email-templates/cancel-pickup-email',$this->pageData);
                                $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/cancel-pickup-email',$this->pageData);
                                $subject ='Pickup Cancelled.'; 
                                
                                foreach($getCusInfo as $getCusData){
                                    $sendEmail = $this->sendEmail($getCusData->email,$store_mailBody,$subject);
                                    if($sendEmail == false){
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = 'Error While sending mail.';
                                        return json_encode($resp); exit;
                                    }
                                }
                                if (isset($supportEmail) && !empty($supportEmail)) {
                                    $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$subject);
                                    if($sendEmail == false){
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = 'Error While sending mail.';
                                        return json_encode($resp); exit;
                                    }
                                }           

                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $apiAramexCancelPickupResponse->Message;
                                return json_encode($resp); exit;
                            }else{
                                $resp['responseCode'] = 500;
                                $resp['responseNotifications'] = $apiAramexCancelPickupResponse->Notifications[0]->Code;
                                $resp['responseMessage'] = $apiAramexCancelPickupResponse->Message;
                                return json_encode($resp); exit;
                            }

                        }else{
                            $resp['responseCode'] = 400;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty, kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                            return json_encode($resp); exit;
                        }
                    }else{

                        $clientInfo = $this->ShippingModel->get_shipping_cmp_info($_POST['shipcmpid']);
                        $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);

                        $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                        $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                        $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                        $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                        $PickupGUID = $_POST['guid'];

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CancelPickup',
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
                            "Comments": "Test",
                            "PickupGUID": "'.$PickupGUID.'",
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
                        
                        $apiAramexCancelPickupResponse = curl_exec($curl);
                        curl_close($curl);

                        $apiAramexCancelPickupResponse = json_decode($apiAramexCancelPickupResponse);
                        if($apiAramexCancelPickupResponse->HasErrors==false){
                            /*update shipment orders start */
                            $requestData = array(
                                'pickup_req_flag'=>2,
                                'updated_at'=>DATETIME
                            );
                            $affectedOrderId = $this->OrderModel->update_order_pickup_reff_id($PickupGUID,$requestData);
                            if(filter_var($affectedOrderId, FILTER_VALIDATE_INT) === false){
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while updating order shipment GUID & Refference ID." : "حدث خطأ أثناء تحديث GUID الخاص بشحنة الطلب";
                                
                                return json_encode($resp); exit;
                            }
                            /*update shipment orders end */

                            $server_site_path = base_url();
                            $store_logo = $server_site_path.'/store/'.$this->storeActvTmplName.'/assets/images/logo.png';
                            $sociaFB = 'javascript:void(0);';
                            $socialTwitter = 'javascript:void(0);';
                            $socialYoutube = 'javascript:void(0);';
                            $socialLinkedin = 'javascript:void(0);';
                            $socialInstagram = 'javascript:void(0);';
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
                            $this->pageData['address'] = $address;
                            $this->pageData['supportEmail'] = $supportEmail;
                            $this->pageData['pickupId'] = $PickupGUID;
                            $this->pageData['storeName'] = $storeName;
                            
                            $store_admin_mailBody = view('store_admin/email-templates/cancel-pickup-email',$this->pageData);
                            $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/cancel-pickup-email',$this->pageData);
                            $subject ='Pickup Cancelled.';  
                            foreach($getCusInfo as $getCusData){
                                $sendEmail = $this->sendEmail($getCusData->email,$store_mailBody,$subject);
                                if($sendEmail == false){
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Sending Email. 1':'خطأ أثناء إرسال البريد الإلكتروني.'; 
                                    return json_encode($resp); exit;
                                }
                            }
                            
                            if (isset($supportEmail) && !empty($supportEmail)) {
                                $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$subject);
                                if($sendEmail == false){
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Sending Email. 2':'خطأ أثناء إرسال البريد الإلكتروني.'; 
                                    return json_encode($resp); exit;
                                }
                            }   
                            if($sendEmail == true){
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $apiAramexCancelPickupResponse->Message;
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg = $this->ses_lang=='en'?'Error While Sending Email.':'خطأ أثناء إرسال البريد الإلكتروني.';                                    
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 500;
                            $resp['responseNotifications'] = $apiAramexCancelPickupResponse->Notifications[0]->Code;
                            $resp['responseMessage'] = $apiAramexCancelPickupResponse->Message;
                            return json_encode($resp); exit;
                        }
                    }

                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Company ID Is Required." : "مطلوب معرف شركة الشحن.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "GUID Is Required." : "واجهة المستخدم الرسومية مطلوبة.";
                return json_encode($resp); exit;
            }
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function order_details($orderId){ 
        $this->is_all_mandotory_modules_filled();
        $this->pageData['pageTitle'] = 'Order Details';  
        $this->pageData['orderDetails'] = $this->OrderModel->get_single_order_details($orderId); 
        $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data(); 
        return view('store_admin/shipping/order-details',$this->pageData); 
    }

    public function create_pickup_request(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Create Delivery Pickup Request';  
            $this->pageData['shippingCmpList'] = $this->ShippingModel->get_store_all_active_shipping_companies(); 
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $defaultShipping = '';
            if (isset($this->pageData['storeSettingInfo']->default_shipping) && !empty($this->pageData['storeSettingInfo']->default_shipping)) {
                $defaultShipping = $this->pageData['storeSettingInfo']->default_shipping;
            }
            $this->pageData['defaultShipping'] = $defaultShipping;
            return view('store_admin/shipping/create-pickup-request',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function submit_pickup_request(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            if(isset($_POST['shipping_company_id']) && !empty($_POST['shipping_company_id'])){
                if(isset($this->pageData['storeSettingInfo']->default_shipping) && $this->pageData['storeSettingInfo']->default_shipping==1){
                    $matjaryShippingInfoApi = $this->callAPI('GET', 'https://www.matjary.in/shipping-info', '');
                    $clientInfo = json_decode($matjaryShippingInfoApi, true);
                    
                    if(isset($clientInfo['responseCode']) && $clientInfo['responseCode']==200){
                        $shipCmpInfo = $clientInfo['responseData'];

                        $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                        $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                        $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                        $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                        date_default_timezone_set("Asia/Riyadh");
                        $PickupDate = round(microtime(true) * 1000);
                        usleep(100);
                        $ReadyTime = round(microtime(true) * 1000);
                        usleep(100);
                        $LastPickupTime = round(microtime(true) * 1000);
                        usleep(100);
                        $ClosingTime = round(microtime(true) * 1000);

                        // echo '<pre>'; print_r($PickupDate); exit;

                        // $curruntTime = date("H");
                        // if($curruntTime>15 && $curruntTime<=17){
                            
                        // }elseif($curruntTime>9 && $curruntTime<15){
                        //     $remainingHrs = 15 - $curruntTime;
                        //     //echo '<pre>'; print_r($remainingHrs); exit;
                        //     $PickupDate = 3600000 * (int)$remainingHrs;
                        //     echo '<pre>'; print_r($PickupDate); exit;
                        //     $ReadyTime = 3600000 * $remainingHrs;
                        //     $LastPickupTime = 7200000 + $ReadyTime;
                        //     $ClosingTime = 7200000 + $ReadyTime;
                        // }
                        // echo '<pre>'; print_r("PickupDate= ".$PickupDate); 
                        // echo '<pre>'; print_r("ReadyTime= ".$ReadyTime); 
                        // echo '<pre>'; print_r("LastPickupTime= ".$LastPickupTime); 
                        // echo '<pre>'; print_r("ClosingTime= ".$ClosingTime); exit;

                        // $today = date("Y-m-d");
                        // $ReadyTime = $today . ' T15:00:00';
                        // $PickupDate = $today . ' T15:00:00';
                        // $LastPickupTime = $today . ' T17:00:00';
                        // $ClosingTime = $today . ' T17:00:00';


                        $PickupAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                        $PickupAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                        
                        $NumberOfShipments = 0;
                        $TotalShipmentWeight = 0;
                        $TotalShipmentNumberOfPieces = 0;

                        $available_shipments = $this->ShippingModel->get_number_of_available_shipments();
                        if(isset($available_shipments) && !empty($available_shipments)){
                            $NumberOfShipments = count($available_shipments);
                            $ShipmentWeight = 0;
                            $ShipmentPieces = 0;
                            foreach($available_shipments as $shipmentData){
                                //echo '<pre>'; print_r($shipmentData->id); exit;
                                $orderInfo = $this->OrderModel->get_single_order_details($shipmentData->id);
                                //echo '<pre>'; print_r($orderInfo); exit;
                                if(isset($orderInfo['orderProductItemsInfo']) && !empty($orderInfo['orderProductItemsInfo'])){
                                    $totalProductsWeight = 0;
                                    $NumberOfPieces = 0;

                                    foreach($orderInfo['orderProductItemsInfo'] as $orderProductItemsData){
                                        $product_weight = (int)$orderProductItemsData->product_qty * number_format((float)$orderProductItemsData->product_weight, 2, '.', '');
                                        $totalProductsWeight += isset($product_weight)?$product_weight:0;
                                        $NumberOfPieces += isset($orderProductItemsData->product_qty)?$orderProductItemsData->product_qty:0;
                                    }
                                    $ShipmentWeight += $totalProductsWeight;
                                    $ShipmentPieces += $NumberOfPieces;
                                }
                                
                            }
                            $TotalShipmentWeight = $ShipmentWeight;
                            $TotalShipmentNumberOfPieces = $ShipmentPieces;

                            // echo '<pre>'; print_r($NumberOfShipments); 
                            // echo '<pre>'; print_r($TotalShipmentWeight); 
                            // echo '<pre>'; print_r($TotalShipmentNumberOfPieces); exit;

                            $getCusInfo = array();
                            $shippingOrdersList = $this->OrderModel->get_all_shipment_orders();                       
                            if(isset($shippingOrdersList) && !empty($shippingOrdersList)){
                                $i=0;
                                foreach($shippingOrdersList as $shippingOrdersData){
                                    if(isset($shippingOrdersData->customer_id) && !empty($shippingOrdersData->customer_id)){
                                        $getCusInfo[$i] = $this->CustomerModel->get_single_customer_data($shippingOrdersData->customer_id);
                                        $getCusInfo[$i]->shipping_id = $shippingOrdersData->shipping_id;
                                        $getCusInfo[$i]->transaction_id = $shippingOrdersData->transaction_id;
                                    }  
                                    $i++;                              
                                }                           
                            }

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreatePickup',
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
                                "Pickup": {
                                    "PickupAddress": {
                                    "Line1": "'.$PickupAddress_Line1.'",
                                    "Line2": "",
                                    "Line3": "",
                                    "City": "Riyadh",
                                    "StateOrProvinceCode": "",
                                    "PostCode": "'.$PickupAddress_PostCode.'",
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
                                    "PickupContact": {
                                    "Department": "store inventory",
                                    "PersonName": "store inventory manager name",
                                    "Title": "",
                                    "CompanyName": "store name",
                                    "PhoneNumber1": "1111111111111",
                                    "PhoneNumber1Ext": "",
                                    "PhoneNumber2": "",
                                    "PhoneNumber2Ext": "",
                                    "FaxNumber": "",
                                    "CellPhone": "11111111111111",
                                    "EmailAddress": "storename@test.com",
                                    "Type": ""
                                    },
                                    "PickupItems": [
                                    {
                                        "ProductGroup": "EXP", 
                                        "ProductType": "PDX",
                                        "NumberOfShipments": '.$NumberOfShipments.',
                                        "PackageType": "Box",
                                        "Payment": "P",
                                        "ShipmentWeight": {
                                        "Unit": "KG",
                                        "Value": '.$TotalShipmentWeight.'
                                        },
                                        "ShipmentVolume": null,
                                        "NumberOfPieces": '.$TotalShipmentNumberOfPieces.',
                                        "CashAmount": null,
                                        "ExtraCharges": null,
                                        "ShipmentDimensions": {
                                        "Length": 0,
                                        "Width": 0,
                                        "Height": 0,
                                        "Unit": ""
                                        },
                                        "Comments": "Test"
                                    }
                                    ],
                                    "PickupLocation": "'.$PickupAddress_Line1.'",
                                    "PickupDate": "\/Date('.$PickupDate.'+03)\/",
                                    "ReadyTime": "\/Date('.$ReadyTime.')\/", 
                                    "LastPickupTime": "\/Date('.$LastPickupTime.')\/", 
                                    "ClosingTime": "\/Date('.$ClosingTime.')\/",
                                    "Comments": "",
                                    "Reference1": "001",
                                    "Reference2": "",
                                    "Vehicle": "",
                                    "Status": "Ready",
                                    "ExistingShipments": null,
                                    "Branch": "",
                                    "RouteCode": ""
                                },
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
                            $apiAramexPickupRequest = '{
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
                                    "Pickup": {
                                        "PickupAddress": {
                                        "Line1": "'.$PickupAddress_Line1.'",
                                        "Line2": "",
                                        "Line3": "",
                                        "City": "Riyadh",
                                        "StateOrProvinceCode": "",
                                        "PostCode": "'.$PickupAddress_PostCode.'",
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
                                        "PickupContact": {
                                        "Department": "store inventory",
                                        "PersonName": "store inventory manager name",
                                        "Title": "",
                                        "CompanyName": "store name",
                                        "PhoneNumber1": "1111111111111",
                                        "PhoneNumber1Ext": "",
                                        "PhoneNumber2": "",
                                        "PhoneNumber2Ext": "",
                                        "FaxNumber": "",
                                        "CellPhone": "11111111111111",
                                        "EmailAddress": "storename@test.com",
                                        "Type": ""
                                        },
                                        "PickupItems": [
                                        {
                                            "ProductGroup": "EXP", 
                                            "ProductType": "PDX",
                                            "NumberOfShipments": '.$NumberOfShipments.',
                                            "PackageType": "Box",
                                            "Payment": "P",
                                            "ShipmentWeight": {
                                            "Unit": "KG",
                                            "Value": '.$TotalShipmentWeight.'
                                            },
                                            "ShipmentVolume": null,
                                            "NumberOfPieces": '.$TotalShipmentNumberOfPieces.',
                                            "CashAmount": null,
                                            "ExtraCharges": null,
                                            "ShipmentDimensions": {
                                            "Length": 0,
                                            "Width": 0,
                                            "Height": 0,
                                            "Unit": ""
                                            },
                                            "Comments": "Test"
                                        }
                                        ],
                                        "PickupLocation": "'.$PickupAddress_Line1.'",
                                        "PickupDate": "\/Date('.$PickupDate.'+03)\/",
                                        "ReadyTime": "\/Date('.$ReadyTime.')\/", 
                                        "LastPickupTime": "\/Date('.$LastPickupTime.')\/", 
                                        "ClosingTime": "\/Date('.$ClosingTime.')\/",
                                        "Comments": "",
                                        "Reference1": "001",
                                        "Reference2": "",
                                        "Vehicle": "",
                                        "Status": "Ready",
                                        "ExistingShipments": null,
                                        "Branch": "",
                                        "RouteCode": ""
                                    },
                                    "Transaction": {
                                        "Reference1": "",
                                        "Reference2": "",
                                        "Reference3": "",
                                        "Reference4": "",
                                        "Reference5": ""
                                    }
                                }';
                            //echo '<pre>'; print_r($apiAramexPickupRequest); exit;
                            $apiAramexPickupResponse = curl_exec($curl);
                            //echo '<pre>'; print_r($apiAramexPickupResponse); exit;
                            curl_close($curl);
                            
                            $aramex_pickup_api_response = json_decode($apiAramexPickupResponse);
                            //echo '<pre>'; print_r($aramex_pickup_api_response); 
                            $pickup_req_ref_id = isset($aramex_pickup_api_response->ProcessedPickup->ID)?$aramex_pickup_api_response->ProcessedPickup->ID:'Error in aramex create pickup API, Reference No/ID not generated. '.exit();
                            $pickup_req_gu_id = isset($aramex_pickup_api_response->ProcessedPickup->GUID)?$aramex_pickup_api_response->ProcessedPickup->GUID:'Error in aramex create pickup API, GUID not generated. '.exit(); 
                            //echo '<pre>'; print_r($pickup_req_ref_id); exit;
                            $orderUpdateStatus = false;
                            if(isset($available_shipments) && !empty($available_shipments)){
                                foreach($available_shipments as $shipmentData){
                            
                                    $affectedId = $this->OrderModel->update_data($shipmentData->id, array(
                                        "pickup_req_ref_id"=>isset($pickup_req_ref_id)?$pickup_req_ref_id:'',
                                        "pickup_req_gu_id"=>isset($pickup_req_gu_id)?$pickup_req_gu_id:'',
                                        "pickup_req_flag"=>1,
                                        "pickup_req"=>isset($apiAramexPickupRequest)?$apiAramexPickupRequest:'',
                                        "pickup_res"=>isset($apiAramexPickupResponse)?$apiAramexPickupResponse:'',
                                        "updated_at"=> DATETIME
                                    ));
                                    if(is_int($affectedId)){
                                        $orderUpdateStatus = true;

                                    }
                                }
                            }

                            if($orderUpdateStatus==true){
                                
                                //Create pickup email
                                $server_site_path = base_url();
                                $store_logo = $server_site_path.'/store_admin/assets/images/logo.png';
                                $sociaFB = 'javascript:void(0);';
                                $socialTwitter = 'javascript:void(0);';
                                $socialYoutube = 'javascript:void(0);';
                                $socialLinkedin = 'javascript:void(0);';
                                $socialInstagram = 'javascript:void(0);';
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
                                $this->pageData['address'] = $address;
                                $this->pageData['supportEmail'] = $supportEmail;
                                $this->pageData['pickupId'] = $pickup_req_gu_id;
                                $this->pageData['storeName'] = $storeName;
                                
                                foreach($getCusInfo as $value){
                                    $this->pageData['shipping_id'] = $value->shipping_id;
                                    /* send aknowlegment email about his order cancelation to each order customer */
                                    $store_subject ='Order #'.$value->transaction_id.' has been confirmed.';
                                    $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/create-pickup-email',$this->pageData);
                                    $this->sendEmail($value->email,$store_mailBody,$store_subject);
                                }

                                if (isset($supportEmail) && !empty($supportEmail)) {
                                    $store_admin_subject ='Create Pickup Successfully.';
                                    $store_admin_mailBody = view('store_admin/email-templates/create-pickup-email',$this->pageData);
                                    $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$store_admin_subject);
                                    if($sendEmail == false){
                                        $resp['responseCode'] = 500;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Sending Email. 2':'خطأ أثناء إرسال البريد الإلكتروني.'; 
                                        return json_encode($resp); exit;
                                    }
                                }   
                                
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipment Pickup Created Successfully." : "تم إنشاء استلام الشحنة بنجاح.";
                                $resp['redirectUrl'] = base_url('admin/ship-orders');
                                return json_encode($resp); exit;
                            }else{
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Creating Shipment Pickup." : "خطأ أثناء إنشاء لاقط الشحنة.";
                                return json_encode($resp); exit;
                            }
                            
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "No Shipment Available For Create Pickup." : "لا توجد شحنة متاحة لإنشاء الاستلام.";              
                            return json_encode($resp); exit;
                        }

                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Store Shipping setting is empty, kindly mention shipping setting in store admin.':'إعداد شحن المتجر فارغ ، يرجى ذكر إعدادات الشحن في إدارة المتجر.';
                        return json_encode($resp); exit;
                    }
                    
                }else{
                    $clientInfo = $this->ShippingModel->get_shipping_cmp_info($_POST['shipping_company_id']);
                    $shipCmpInfo = unserialize($clientInfo->ship_cmp_data);

                    $UserName = isset($shipCmpInfo['username'])?$shipCmpInfo['username']:'';
                    $Password = isset($shipCmpInfo['password'])?$shipCmpInfo['password']:'';
                    $AccountNumber = isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:'';
                    $AccountPin = isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:'';

                    date_default_timezone_set("Asia/Riyadh");
                    $PickupDate = round(microtime(true) * 1000);
                    usleep(100);
                    $ReadyTime = round(microtime(true) * 1000);
                    usleep(100);
                    $LastPickupTime = round(microtime(true) * 1000);
                    usleep(100);
                    $ClosingTime = round(microtime(true) * 1000);

                    // echo '<pre>'; print_r($PickupDate); exit;

                    // $curruntTime = date("H");
                    // if($curruntTime>15 && $curruntTime<=17){
                        
                    // }elseif($curruntTime>9 && $curruntTime<15){
                    //     $remainingHrs = 15 - $curruntTime;
                    //     //echo '<pre>'; print_r($remainingHrs); exit;
                    //     $PickupDate = 3600000 * (int)$remainingHrs;
                    //     echo '<pre>'; print_r($PickupDate); exit;
                    //     $ReadyTime = 3600000 * $remainingHrs;
                    //     $LastPickupTime = 7200000 + $ReadyTime;
                    //     $ClosingTime = 7200000 + $ReadyTime;
                    // }
                    // echo '<pre>'; print_r("PickupDate= ".$PickupDate); 
                    // echo '<pre>'; print_r("ReadyTime= ".$ReadyTime); 
                    // echo '<pre>'; print_r("LastPickupTime= ".$LastPickupTime); 
                    // echo '<pre>'; print_r("ClosingTime= ".$ClosingTime); exit;

                    // $today = date("Y-m-d");
                    // $ReadyTime = $today . ' T15:00:00';
                    // $PickupDate = $today . ' T15:00:00';
                    // $LastPickupTime = $today . ' T17:00:00';
                    // $ClosingTime = $today . ' T17:00:00';


                    $PickupAddress_Line1 = isset($shipCmpInfo['address'])?$shipCmpInfo['address']:'';
                    $PickupAddress_PostCode = isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:'';
                    
                    $NumberOfShipments = 0;
                    $TotalShipmentWeight = 0;
                    $TotalShipmentNumberOfPieces = 0;

                    $available_shipments = $this->ShippingModel->get_number_of_available_shipments();
                    if(isset($available_shipments) && !empty($available_shipments)){
                        $NumberOfShipments = count($available_shipments);
                        $ShipmentWeight = 0;
                        $ShipmentPieces = 0;
                        foreach($available_shipments as $shipmentData){
                            $orderInfo = $this->OrderModel->get_single_order_details($shipmentData->id);
                            if(isset($orderInfo['orderProductItemsInfo']) && !empty($orderInfo['orderProductItemsInfo'])){
                                $totalProductsWeight = 0;
                                $NumberOfPieces = 0;

                                foreach($orderInfo['orderProductItemsInfo'] as $orderProductItemsData){
                                    $product_weight = (int)$orderProductItemsData->product_qty * number_format((float)$orderProductItemsData->product_weight, 2, '.', '');
                                    $totalProductsWeight += isset($product_weight)?$product_weight:0;
                                    $NumberOfPieces += isset($orderProductItemsData->product_qty)?$orderProductItemsData->product_qty:0;
                                }
                                $ShipmentWeight += $totalProductsWeight;
                                $ShipmentPieces += $NumberOfPieces;
                            }
                            
                        }
                        $TotalShipmentWeight = $ShipmentWeight;
                        $TotalShipmentNumberOfPieces = $ShipmentPieces;
                       
                        $getCusInfo = array();
                        $shippingOrdersList = $this->OrderModel->get_all_shipment_orders();                       
                        if(isset($shippingOrdersList) && !empty($shippingOrdersList)){
                            $i=0;
                            foreach($shippingOrdersList as $shippingOrdersData){
                                if(isset($shippingOrdersData->customer_id) && !empty($shippingOrdersData->customer_id)){
                                    $getCusInfo[$i] = $this->CustomerModel->get_single_customer_data($shippingOrdersData->customer_id);
                                    $getCusInfo[$i]->shipping_id = $shippingOrdersData->shipping_id;
                                    $getCusInfo[$i]->transaction_id = $shippingOrdersData->transaction_id;
                                }  
                                $i++;                              
                            }                           
                        }
                                                                                
                       
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreatePickup',
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
                            "Pickup": {
                                "PickupAddress": {
                                "Line1": "'.$PickupAddress_Line1.'",
                                "Line2": "",
                                "Line3": "",
                                "City": "Riyadh",
                                "StateOrProvinceCode": "",
                                "PostCode": "'.$PickupAddress_PostCode.'",
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
                                "PickupContact": {
                                "Department": "store inventory",
                                "PersonName": "store inventory manager name",
                                "Title": "",
                                "CompanyName": "store name",
                                "PhoneNumber1": "1111111111111",
                                "PhoneNumber1Ext": "",
                                "PhoneNumber2": "",
                                "PhoneNumber2Ext": "",
                                "FaxNumber": "",
                                "CellPhone": "11111111111111",
                                "EmailAddress": "storename@test.com",
                                "Type": ""
                                },
                                "PickupItems": [
                                {
                                    "ProductGroup": "EXP", 
                                    "ProductType": "PDX",
                                    "NumberOfShipments": '.$NumberOfShipments.',
                                    "PackageType": "Box",
                                    "Payment": "P",
                                    "ShipmentWeight": {
                                    "Unit": "KG",
                                    "Value": '.$TotalShipmentWeight.'
                                    },
                                    "ShipmentVolume": null,
                                    "NumberOfPieces": '.$TotalShipmentNumberOfPieces.',
                                    "CashAmount": null,
                                    "ExtraCharges": null,
                                    "ShipmentDimensions": {
                                    "Length": 0,
                                    "Width": 0,
                                    "Height": 0,
                                    "Unit": ""
                                    },
                                    "Comments": "Test"
                                }
                                ],
                                "PickupLocation": "'.$PickupAddress_Line1.'",
                                "PickupDate": "\/Date('.$PickupDate.'+03)\/",
                                "ReadyTime": "\/Date('.$ReadyTime.')\/", 
                                "LastPickupTime": "\/Date('.$LastPickupTime.')\/", 
                                "ClosingTime": "\/Date('.$ClosingTime.')\/",
                                "Comments": "",
                                "Reference1": "001",
                                "Reference2": "",
                                "Vehicle": "",
                                "Status": "Ready",
                                "ExistingShipments": null,
                                "Branch": "",
                                "RouteCode": ""
                            },
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
                        $apiAramexPickupRequest = '{
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
                                "Pickup": {
                                    "PickupAddress": {
                                    "Line1": "'.$PickupAddress_Line1.'",
                                    "Line2": "",
                                    "Line3": "",
                                    "City": "Riyadh",
                                    "StateOrProvinceCode": "",
                                    "PostCode": "'.$PickupAddress_PostCode.'",
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
                                    "PickupContact": {
                                    "Department": "store inventory",
                                    "PersonName": "store inventory manager name",
                                    "Title": "",
                                    "CompanyName": "store name",
                                    "PhoneNumber1": "1111111111111",
                                    "PhoneNumber1Ext": "",
                                    "PhoneNumber2": "",
                                    "PhoneNumber2Ext": "",
                                    "FaxNumber": "",
                                    "CellPhone": "11111111111111",
                                    "EmailAddress": "storename@test.com",
                                    "Type": ""
                                    },
                                    "PickupItems": [
                                    {
                                        "ProductGroup": "EXP", 
                                        "ProductType": "PDX",
                                        "NumberOfShipments": '.$NumberOfShipments.',
                                        "PackageType": "Box",
                                        "Payment": "P",
                                        "ShipmentWeight": {
                                        "Unit": "KG",
                                        "Value": '.$TotalShipmentWeight.'
                                        },
                                        "ShipmentVolume": null,
                                        "NumberOfPieces": '.$TotalShipmentNumberOfPieces.',
                                        "CashAmount": null,
                                        "ExtraCharges": null,
                                        "ShipmentDimensions": {
                                        "Length": 0,
                                        "Width": 0,
                                        "Height": 0,
                                        "Unit": ""
                                        },
                                        "Comments": "Test"
                                    }
                                    ],
                                    "PickupLocation": "'.$PickupAddress_Line1.'",
                                    "PickupDate": "\/Date('.$PickupDate.'+03)\/",
                                    "ReadyTime": "\/Date('.$ReadyTime.')\/", 
                                    "LastPickupTime": "\/Date('.$LastPickupTime.')\/", 
                                    "ClosingTime": "\/Date('.$ClosingTime.')\/",
                                    "Comments": "",
                                    "Reference1": "001",
                                    "Reference2": "",
                                    "Vehicle": "",
                                    "Status": "Ready",
                                    "ExistingShipments": null,
                                    "Branch": "",
                                    "RouteCode": ""
                                },
                                "Transaction": {
                                    "Reference1": "",
                                    "Reference2": "",
                                    "Reference3": "",
                                    "Reference4": "",
                                    "Reference5": ""
                                }
                            }';

                        $apiAramexPickupResponse = curl_exec($curl);
                        curl_close($curl);
                        
                        $aramex_pickup_api_response = json_decode($apiAramexPickupResponse);
                        $pickup_req_ref_id = isset($aramex_pickup_api_response->ProcessedPickup->ID)?$aramex_pickup_api_response->ProcessedPickup->ID:'Error in aramex create pickup API, Reference No/ID not generated. '.exit();
                        $pickup_req_gu_id = isset($aramex_pickup_api_response->ProcessedPickup->GUID)?$aramex_pickup_api_response->ProcessedPickup->GUID:'Error in aramex create pickup API, GUID not generated. '.exit(); 
                       
                        $orderUpdateStatus = false;
                        if(isset($available_shipments) && !empty($available_shipments)){
                            foreach($available_shipments as $shipmentData){
                        
                                $affectedId = $this->OrderModel->update_data($shipmentData->id, array(
                                    "pickup_req_ref_id"=>isset($pickup_req_ref_id)?$pickup_req_ref_id:'',
                                    "pickup_req_gu_id"=>isset($pickup_req_gu_id)?$pickup_req_gu_id:'',
                                    "pickup_req_flag"=>1,
                                    "pickup_req"=>isset($apiAramexPickupRequest)?$apiAramexPickupRequest:'',
                                    "pickup_res"=>isset($apiAramexPickupResponse)?$apiAramexPickupResponse:'',
                                    "updated_at"=> DATETIME
                                ));
                                if(is_int($affectedId)){
                                    $orderUpdateStatus = true;
                                }
                            }
                        }

                        if($orderUpdateStatus==true){
                            //Create pickup email
                            $server_site_path = base_url();
                            $store_logo = $server_site_path.'/store_admin/assets/images/logo.png';
                            $sociaFB = 'javascript:void(0);';
                            $socialTwitter = 'javascript:void(0);';
                            $socialYoutube = 'javascript:void(0);';
                            $socialLinkedin = 'javascript:void(0);';
                            $socialInstagram = 'javascript:void(0);';
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
                            $this->pageData['address'] = $address;
                            $this->pageData['supportEmail'] = $supportEmail;
                            $this->pageData['pickupId'] = $pickup_req_gu_id;
                            $this->pageData['storeName'] = $storeName;
                            
                            foreach($getCusInfo as $value){
                                $this->pageData['shipping_id'] = $value->shipping_id;
                                /* send aknowlegment email about his order cancelation to each order customer */
                                $store_subject ='Order #'.$value->transaction_id.' has been confirmed.';
                                $store_mailBody = view('store/'.$this->storeActvTmplName.'/email-templates/create-pickup-email',$this->pageData);
                                $this->sendEmail($value->email,$store_mailBody,$store_subject);
                            }

                            if (isset($supportEmail) && !empty($supportEmail)) {
                                $store_admin_subject ='Create Pickup Successfully.';
                                $store_admin_mailBody = view('store_admin/email-templates/create-pickup-email',$this->pageData);
                                $sendEmail = $this->sendEmail($supportEmail,$store_admin_mailBody,$store_admin_subject);
                                if($sendEmail == false){
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Sending Email. 2':'خطأ أثناء إرسال البريد الإلكتروني.'; 
                                    return json_encode($resp); exit;
                                }
                            }      

                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipment Pickup Created Successfully." : "تم إنشاء استلام الشحنة بنجاح.";
                            $resp['redirectUrl'] = base_url('admin/ship-orders');
                            return json_encode($resp); exit;
                        }else{
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Creating Shipment Pickup." : "خطأ أثناء إنشاء لاقط الشحنة.";
                            return json_encode($resp); exit;
                        }
                        
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "No Shipment Available For Create Pickup." : "لا توجد شحنة متاحة لإنشاء الاستلام.";              
                        return json_encode($resp); exit;
                    }
                }
                
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Shipping Company Is Required." : "مطلوب شركة شحن.";
                return json_encode($resp); exit;
            }
        }else{
            return redirect()->to('/admin/login');
        }
    }
  
}

?>



