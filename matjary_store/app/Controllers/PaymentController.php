<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class PaymentController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
    }

    public function payment_settings(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Payment Setting';  
            $this->pageData['adminPageId'] = 15;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['paymentCompanies'] = $this->PaymentModel->get_all_payment_companies();    
            $this->pageData['paymentInfo'] = $this->PaymentModel->get_all_data();     
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            //echo '<pre>'; print_r($this->pageData['paymentInfo']); exit;
            return view('store_admin/settings/payment-settings',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }      
    } 

    public function save_payment_setting(){
        $result = true;
        if(isset($_POST['pay_cmp_id']) && !empty($_POST['pay_cmp_id'])){
            $totalCount = count($_POST['pay_cmp_id']);
            for ($i=0; $i < $totalCount; $i++) { 
                if($_POST['pay_cmp_id'][$i]==1){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==2){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==3){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==4){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==5){
                    
                    if(isset($_POST['profile_id'][$i]) && !empty($_POST['profile_id'][$i])){ 
                        if(isset($_POST['apikey'][$i]) && !empty($_POST['apikey'][$i])){
                                                        
                                $ac_no = $this->remove_special_char_from_string($_POST['profile_id'][$i]);
                                $profile_id = $_POST['profile_id'][$i];
                                $apikey =   $_POST['apikey'][$i];                                                         
                                
                                $pay_cmp_data = serialize(array(  
                                    "profile_id" => isset($profile_id)?$profile_id:'',
                                    "apikey" => isset($apikey)?$apikey:''
                                ));

                                $insertedId = $this->PaymentModel->insert_data(array(    
                                    "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                    "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                    "is_active" => 1,
                                    "created_at" => DATETIME
                                ));

                                if(!is_int($insertedId)){ 
                                    $result = false;  
                                }   
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "API KEY Is Required." : "API KEY مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Profile ID Is Required." : "معرف الملف الشخصي مطلوب.";
                        return json_encode($resp); exit;
                    }
                    
                }elseif($_POST['pay_cmp_id'][$i]==6){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==7){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==8){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==9){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==10){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==11){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==12){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));

                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }elseif($_POST['pay_cmp_id'][$i]==13){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
    
                                    $insertedId = $this->PaymentModel->insert_data(array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
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
                }
                
            }

            if($result==true){ 
        
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Payment Setting Updated Successfully." : "تم تحديث إعداد الدفع بنجاح.";
                $resp['redirectUrl'] = base_url('admin/payment-settings');
                return json_encode($resp); exit;           
            
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Payment Setting Insertion." : "خطأ أثناء إدخال إعداد الدفع.";  
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }  
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Payment Company Id Is Required." : "معرف شركة الدفع مطلوب.";
            return json_encode($resp); exit;
        }
    }
    
    public function update_payment_setting(){
        //echo '<pre>'; print_r($_POST); exit; 
        $result = true;
        if(isset($_POST['pay_cmp_id']) && !empty($_POST['pay_cmp_id'])){
            $totalCount = count($_POST['pay_cmp_id']);
            for ($i=0; $i < $totalCount; $i++) {
                
                // if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                //     if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                //         if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                        
                //                 $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                //                 $username = $_POST['username'][$i];
                //                 $password = $_POST['password'][$i];    
                //                 $apikey = $_POST['apikey'][$i];

                //                 $pay_cmp_data = serialize(array(    
                //                     "ac_no" =>isset($ac_no)?$ac_no:'',
                //                     "username" =>isset($username)?$username:'',
                //                     "password" => isset($password)?$password:'',
                //                     "apikey" => isset($apikey)?$apikey:''
                //                 ));
                                
                //                 $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                //                     "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                //                     "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',   
                //                     "updated_at" => DATETIME
                //                 ));

                //                 if(!is_int($insertedAffectedId)){ 
                //                     $result = false;  
                //                 }   
                //         }else{
                //             $resp['responseCode'] = 404;
                //             $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة."; 
                //             return json_encode($resp); exit;
                //         }
                //     }else{
                //         $resp['responseCode'] = 404;
                //         $resp['responseMessage'] =  $this->ses_lang=='en' ? "Username Is Required." : "اسم المستخدم مطلوب."; 
                //         return json_encode($resp); exit;
                //     }
                // }else{
                //     $resp['responseCode'] = 404;
                //     $resp['responseMessage'] =  $this->ses_lang=='en' ? "Account No Is Required." : "رقم الحساب مطلوب."; 
                //     return json_encode($resp); exit;
                // }
                if($_POST['pay_cmp_id'][$i]==1){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==2){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==3){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==4){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==5){
                    
                    if(isset($_POST['profile_id'][$i]) && !empty($_POST['profile_id'][$i])){ 
                        if(isset($_POST['apikey'][$i]) && !empty($_POST['apikey'][$i])){
                                                        
                                $ac_no = $this->remove_special_char_from_string($_POST['profile_id'][$i]);
                                $profile_id = $_POST['profile_id'][$i];
                                $apikey =   $_POST['apikey'][$i];                                                         
                                
                                $pay_cmp_data = serialize(array(  
                                    "profile_id" => isset($profile_id)?$profile_id:'',
                                    "apikey" => isset($apikey)?$apikey:''
                                ));
                
                                $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                    "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                    "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                    "is_active" => 1,
                                    "created_at" => DATETIME
                                ));
                
                                if(!is_int($insertedAffectedId)){ 
                                    $result = false;  
                                }   
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "API KEY Is Required." : "API KEY مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Profile ID Is Required." : "معرف الملف الشخصي مطلوب.";
                        return json_encode($resp); exit;
                    }
                    
                }elseif($_POST['pay_cmp_id'][$i]==6){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==7){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==8){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==9){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==10){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==11){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==12){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }elseif($_POST['pay_cmp_id'][$i]==13){
                    if(isset($_POST['ac_no'][$i]) && !empty($_POST['ac_no'][$i])){
                        if(isset($_POST['username'][$i]) && !empty($_POST['username'][$i])){ 
                            if(isset($_POST['password'][$i]) && !empty($_POST['password'][$i])){
                                                            
                                    $ac_no = $this->remove_special_char_from_string($_POST['ac_no'][$i]);
                                    $username = $_POST['username'][$i];
                                    $password = $_POST['password'][$i]; 
                                    $apikey =   $_POST['apikey'][$i];                                                         
                                    
                                    $pay_cmp_data = serialize(array(  
                                        "ac_no" =>isset($ac_no)?$ac_no:'',
                                        "username" =>isset($username)?$username:'',
                                        "password" => isset($password)?$password:'',
                                        "apikey" => isset($apikey)?$apikey:''
                                    ));
                
                                    $insertedAffectedId = $this->PaymentModel->update_data($_POST['pay_cmp_id'][$i],array(    
                                        "pay_cmp_id"=> $_POST['pay_cmp_id'][$i],
                                        "pay_cmp_data" =>isset($pay_cmp_data)?$pay_cmp_data:'',                                                                                                                               
                                        "is_active" => 1,
                                        "created_at" => DATETIME
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
                }  
            }
            if($result==true){ 
        
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Payment Setting Updated Successfully." : "تم تحديث إعداد الدفع بنجاح.";
                $resp['redirectUrl'] = base_url('admin/payment-settings');
                return json_encode($resp); exit;           
            
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Payment Setting Updation." : "خطأ أثناء تحديث إعداد الدفع."; 
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }  
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Payment Company Is Required." : "شركة الدفع مطلوبة."; 
            return json_encode($resp); exit;
        }
    }
  
}

?>



