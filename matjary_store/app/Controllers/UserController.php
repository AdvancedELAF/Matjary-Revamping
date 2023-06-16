<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends BaseController
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
        $this->pageData['pageTitle'] = 'Dashboard';
        return view('store_admin/dashboard',$this->pageData);
    }

    public function all_users(){    
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'All Users';
            $this->pageData['adminPageId'] = 14;
            $this->pageData['table'] = $this->Users;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['UserList'] = $this->UserModel->get_all_data(); /* Get all rows */
            $this->pageData['UserroleList'] = $this->UserRoleModel->get_all_data();  
            return view('store_admin/user/all-users',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_user(){      
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['UserroleList'] = $this->UserRoleModel->get_all_data(); 
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();     
            return view('store_admin/user/add-user',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_user(){   
        if(isset($_POST['name']) && !empty($_POST['name'])){
            if(isset($_POST['email']) && !empty($_POST['email'])){
                if(isset($_POST['addr_residential']) && !empty($_POST['addr_residential'])){
                    if(isset($_POST['addr_permanent']) && !empty($_POST['addr_permanent'])){
                        if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                            if(isset($_POST['role_id']) && !empty($_POST['role_id'])){
                                $nameExist =$this->UserModel->check_email_exist($_POST['email']); /* check email already exist or not */
                                if($nameExist==true){
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Already Exits With Another User." : "البريد الإلكتروني يخرج بالفعل مع مستخدم آخر.";
                                    return json_encode($resp); exit;
                                }else{
                                    $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                                    $email	= $this->request->getPost('email');
                                    $addr_residential = $this->remove_special_char_from_string($this->request->getPost('addr_residential'));
                                    $addr_permanent = $this->request->getPost('addr_permanent');
                                    $contact_no = $this->request->getPost('contact_no');
                                    $role_id = $this->request->getPost('role_id');
                                   // echo  $contact_no; die;
                                                                      
                                         $insertedId = $this->UserModel->insert_data(array(                                                                           
                                            "name" =>isset($name)?$name:'',
                                            "email" => isset($email)?$email:'',
                                            "addr_residential" => isset($addr_residential)?$addr_residential:'',
                                            "addr_permanent" => isset($addr_permanent)?$addr_permanent:'',
                                            "contact_no" => isset($contact_no)?$contact_no:'',
                                            "role_id" => isset($role_id)?$role_id:'',                                                                      
                                            "is_active" => 1,
                                            "created_at" => DATETIME
                                        ));
                                       
                                        if(is_int($insertedId)){ 

                                            $this->UserModel->insert_user_reset_pass_data(array(                                                                           
                                                'user_id' => $insertedId,
                                                'token' => password_hash($insertedId, PASSWORD_DEFAULT),                                                                                                
                                                "reset_flag" => 1,
                                                "created_at" => DATETIME
                                            ));
                                            $server_site_path = base_url();
                                            $store_logo = $server_site_path.'/store_admin/assets/images/logo.png';
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
                                            $resetLink = base_url('admin/user-reset-new-password/'.$insertedId);
                                            $this->pageData['storeLogo'] = $store_logo;
                                            $this->pageData['sociaFB'] = $sociaFB; 
                                            $this->pageData['socialTwitter'] = $socialTwitter; 
                                            $this->pageData['socialYoutube'] = $socialYoutube; 
                                            $this->pageData['socialLinkedin'] = $socialLinkedin;                       
                                            $this->pageData['socialInstagram'] = $socialInstagram; 
                                            $this->pageData['address'] = $address;
                                            $this->pageData['name'] = $_POST['name'];
                                            $this->pageData['supportEmail'] = $supportEmail;
                                            $this->pageData['storeName'] = $storeName;  
                                            $this->pageData['resetLink'] = $resetLink;

                                            $mailBody = view('store_admin/email-templates/user-welcome-mail',$this->pageData);
                                            $subject ='Welcome To Matjary Store Admin';
                                            $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                                            if($sendEmail == true){
                                                $resp['responseCode'] = 200;
                                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Added Successfully." : "تمت إضافة المستخدم بنجاح.";
                                                $resp['redirectUrl'] = base_url('admin/all-users');
                                                return json_encode($resp); exit; 
                                            }else{
                                                $errorMsg =  $this->ses_lang=='en' ? "Error While Sending Email." : "خطأ أثناء إرسال البريد الإلكتروني.";
                                                $resp['responseCode'] = 500;
                                                $resp['responseMessage'] = $errorMsg;
                                                return json_encode($resp); exit;
                                            }
                                        }else{                                            
                                            $errorMsg =  $this->ses_lang=='en' ? "Error While User Data Insertion." : "خطأ أثناء إدخال بيانات المستخدم.";                                 
                                            $resp['responseCode'] = 500;
                                            $resp['responseMessage'] = $errorMsg;
                                            return json_encode($resp); exit;
                                        }
                                }                                    
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Role Is Required." : "الدور مطلوب.";
                                return json_encode($resp); exit;
                            }
                      
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Contact Number Is Required." : "رقم الاتصال مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Permanat Address Is Required." : "مطلوب العنوان الدائم.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Residental Address Is Required." : "مطلوب عنوان السكن.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Is Required." : "البريد الالكتروني مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم.";
            return json_encode($resp); exit;
        }
      
    }

    public function reset_new_password($userId=''){     
        $is_exist = $this->UserModel->chk_reset_pass_request_exist($userId);
        if($is_exist==true){    
            $this->pageData['pageTitle'] = 'Set User New Password';
            $this->pageData['user_id'] = $userId;              
            return view('store_admin/user/reset-new-password',$this->pageData);
        }else{
            $this->pageData['pageTitle'] = 'Set User New Password';
            $this->pageData['errorMsg'] = 'This password reset request link has already used or has been expired so you can contact an administrator for further assistance.';
            return view('store_admin/user/reset-new-password',$this->pageData);
        }       
    }

    public function save_reset_password(){     
     
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){              
                $checkInserted = $this->UserModel->insert_cust_pass_data($_POST['user_id'],array(                                                                           
                    'user_id' => $_POST['user_id'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),                                                                                                
                    "is_active" => 1,
                    "created_at" => DATETIME
                ));
                
                if($checkInserted == true){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Reset Successfully." : "إعادة تعيين كلمة المرور بنجاح.";
                    $resp['redirectUrl'] = base_url('admin/login');
                    return json_encode($resp); exit; 
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Reseting Password." : "خطأ أثناء إعادة تعيين كلمة المرور.";
                    return json_encode($resp); exit;
                }              
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Id Is Required." : "معرف المستخدم مطلوب.";
            return json_encode($resp); exit;
        }
        
    }

    public function edit_user($id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Edit Product Category';
            $this->pageData['userDetails'] = $this->UserModel->find($id);
            $this->pageData['UserroleList'] = $this->UserRoleModel->get_all_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/user/edit-user',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }     
    }

    public function update_user(){
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['name']) && !empty($_POST['name'])){
                if(isset($_POST['addr_residential']) && !empty($_POST['addr_residential'])){
                    if(isset($_POST['addr_permanent']) && !empty($_POST['addr_permanent'])){
                        if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                                
                            $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                            $addr_residential = $this->remove_special_char_from_string($this->request->getPost('addr_residential'));
                            $addr_permanent = $this->request->getPost('addr_permanent');
                            $contact_no = $this->request->getPost('contact_no');
                            $role_id = $this->request->getPost('role_id');                                                              

                            $result = $this->UserModel->update_data($_POST['user_id'],array(                                                                           
                                "name" =>isset($name)?$name:'',
                                "addr_residential" => isset($addr_residential)?$addr_residential:'',
                                "addr_permanent" => isset($addr_permanent)?$addr_permanent:'',
                                "contact_no" => isset($contact_no)?$contact_no:'',
                                "updated_at" => DATETIME
                            ));
                            if(isset($result) && !empty($result)){ 
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Updated Successfully." : "تم تحديث مستخدم المتجر بنجاح.";
                                $resp['redirectUrl'] = base_url('admin/edit-user/'.$_POST['user_id']);
                                return json_encode($resp); exit; 
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Store User Insertion." : "خطأ أثناء تخزين إدراج المستخدم.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }  
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Contact Number Is Required." : "رقم الاتصال مطلوب.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Permanat Address Is Required." : "مطلوب العنوان الدائم.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Residental Address Is Required." : "مطلوب عنوان السكن.";
                    return json_encode($resp); exit;
                }           
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Id Is Required." : "معرف المستخدم مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function delete_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UserModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Deleted Successfully." : "تم حذف مستخدم المتجر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-users');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Store User Deletion." : "خطأ أثناء تخزين حذف المستخدم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Id Is Required." : "معرف مستخدم المتجر مطلوب.";
            return json_encode($resp); exit;
        }
    }
    
    public function activate_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UserModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Activated Successfully." : "تم تفعيل مستخدم المتجر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-user');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While User Deletion." : "خطأ أثناء حذف المستخدم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Id Is Required." : "معرف مستخدم المتجر مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UserModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Deactivated Successfully." : "تم إلغاء تنشيط مستخدم المتجر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-user');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Store User Deletion." : "خطأ أثناء تخزين حذف المستخدم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Id Is Required." : "معرف مستخدم المتجر مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function login(){ 
        $this->pageData['pageTitle'] = 'User Login';        
        return view('store_admin/login',$this->pageData);
    }

    public function user_login(){
       
        if(isset($_POST['email']) && !empty($_POST['email'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                $email	= $this->request->getPost('email'); 
                $password = $_POST['password']; 
                
                $data = $this->UserModel->chk_user_exist_with_email($email);              
                if(isset($data) && !empty($data)){
                    $pass = $data->password;
                    $verify_pass = password_verify($password, $pass);
                    if($verify_pass){
                        $ses_data = [
                            'ses_user_id'       => $data->id,
                            'ses_user_name'     => $data->name,
                            'ses_user_email'    => $data->email,
                            'ses_user_logged_in'     => TRUE
                        ];
                        $this->session->set($ses_data);
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "User logedin successfully." : "قام المستخدم بتسجيل الدخول بنجاح.";
                        $resp['redirectUrl'] = base_url('/admin');
                        return json_encode($resp); exit; 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Incorrect Credentials." : "أوراق غير صحيحة.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Incorrect Credentials." : "أوراق غير صحيحة.";
                    return json_encode($resp); exit;
                }
                
            }else{  
                $resp['responseCode'] = 400;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة.";
                return json_encode($resp); exit;
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Is Required." : "البريد الالكتروني مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function user_logout(){
        $this->session->destroy();
        return redirect()->to('admin/login');
    }
    
    public function profile(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){ 
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'User Profile';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();  
           
            $this->pageData['countryList'] = $this->CommonModel->get_all_country_data();
            if(isset($this->pageData['loggedInUserData']->country_id) && !empty($this->pageData['loggedInUserData']->country_id)){  
                $this->pageData['stateList'] = $this->CommonModel->get_country_states($this->pageData['loggedInUserData']->country_id);
                $this->pageData['cityList'] = $this->CommonModel->get_state_cities($this->pageData['loggedInUserData']->state_id);               

            }else{    
                $this->pageData['stateList'] = $this->CommonModel->get_country_states($this->pageData['loggedInUserData']->country_id);
                $this->pageData['cityList'] = $this->CommonModel->get_state_cities($this->pageData['loggedInUserData']->state_id);
               
            }
           
            $this->pageData['UserroleList'] = $this->UserRoleModel->get_all_data(); 
            return view('store_admin/user/profile',$this->pageData);  
        }else{
            return redirect()->to('/admin/login');
        }
    }
    
    public function update_user_profile_form(){ 
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['addr_permanent']) && !empty($_POST['addr_permanent'])){
                if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                        if(isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])){
                            if(isset($_POST['zipcode']) && !empty($_POST['zipcode'])){   

                                $addr_residential = $this->request->getPost('addr_residential');
                                $addr_permanent = $this->request->getPost('addr_permanent');
                                $contact_no = $this->request->getPost('contact_no');                                                   
                                $date_of_birth = date('Y-m-d', strtotime($_POST['date_of_birth']));
                                $gender = $this->request->getPost('gender');                                                                
                                $country_id = $this->request->getPost('country_id');  
                                $state_id = $this->request->getPost('state_id');  
                                $city_id = $this->request->getPost('city_id');  
                                $zipcode = $this->request->getPost('zipcode'); 
                                $social_fb_link = $this->request->getPost('social_fb_link'); 
                                $social_twitter_link = $this->request->getPost('social_twitter_link'); 
                                $social_linkedin_link = $this->request->getPost('social_linkedin_link'); 
                                $social_skype_link = $this->request->getPost('social_skype_link');  


                                $result = $this->UserModel->update_data($_POST['user_id'],array(                                                                           
                                    
                                    "addr_residential" => isset($addr_residential)?$addr_residential:'',
                                    "addr_permanent" => isset($addr_permanent)?$addr_permanent:'',
                                    "contact_no" => isset($contact_no)?$contact_no:'',                                                      
                                    "date_of_birth" => isset($date_of_birth)?$date_of_birth:'',
                                    "gender" => isset($gender)?$gender:'',
                                    "country_id" => isset($country_id)?$country_id:'',
                                    "state_id" => isset($state_id)?$state_id:'',
                                    "city_id" => isset($city_id)?$city_id:'',
                                    "zipcode" => isset($zipcode)?$zipcode:'',
                                    "social_fb_link" => isset($social_fb_link)?$social_fb_link:'',
                                    "social_twitter_link" => isset($social_twitter_link)?$social_twitter_link:'',
                                    "social_linkedin_link" => isset($social_linkedin_link)?$social_linkedin_link:'',
                                    "social_skype_link" => isset($social_skype_link)?$social_skype_link:'',                                
                                    "updated_at" => DATETIME
                                ));
                                if(isset($result) && !empty($result)){ 
                                    $resp['responseCode'] = 200;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Profile Updated Successfully." : "تم تحديث ملف تعريف المستخدم بنجاح.";
                                    $resp['redirectUrl'] = base_url('admin/profile');
                                    return json_encode($resp); exit; 
                                }else{
                                    $errorMsg =  $this->ses_lang=='en' ? "Error While Store User Insertion." : "خطأ أثناء تخزين إدراج المستخدم.";
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $errorMsg;
                                    return json_encode($resp); exit;
                                }
                                    
                                
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Zipcode Is Required." : "الرمز البريدي مطلوب.";
                                return json_encode($resp); exit;
                            } 
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Date Of Birth Is Required." : "تاريخ الميلاد مطلوب.";
                            return json_encode($resp); exit;
                        }                            
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Contact Number Is Required." : "رقم الاتصال مطلوب.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Permanat Address Is Required." : "مطلوب العنوان الدائم.";
                return json_encode($resp); exit;
            }                        
           
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Id Is Required." : "معرف المستخدم مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function change_password(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Change Password';  
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();   
            return view('store_admin/user/change-user-password',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_change_password(){ 
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                if(isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])){
                    if(isset($_POST['cnf_password']) && !empty($_POST['cnf_password'])){
                        $user_id	= $this->request->getPost('user_id'); 
                        $password = $this->request->getPost('password'); 
                        $oldpassword	= isset($_POST['oldpassword'])?$_POST['oldpassword']:''; 
                        $cnf_password = $this->request->getPost('cnf_password'); 
                      
                        $verify_pass = $this->UserModel->chk_verify_password($user_id);                    
                        $pass = $verify_pass[0]->password;
                        $verify_pass = password_verify($oldpassword, $pass);                    
                            if($verify_pass == '1') {                                   
                                $insertedCustmrPassId = $this->UserModel->update_cust_pass($user_id,array(                                                                           
                                    'user_id' => $user_id,
                                    'password' => password_hash($this->request->getVar('cnf_password'), PASSWORD_DEFAULT), 
                                    "updated_at" => DATETIME
                                ));                               
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Change successfully." : "تغيير كلمة المرور بنجاح.";
                                $resp['redirectUrl'] = base_url('admin/dashboard');
                                return json_encode($resp); exit; 
                            }else{
                                $resp['responseCode'] = 400;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Incorrect Credentials." : "أوراق غير صحيحة.";
                                return json_encode($resp); exit;
                            }
                    }else{
                        $resp['responseCode'] = 400;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Confirm Password Is Required." : "تأكيد كلمة المرور مطلوب.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 400;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Old Password Is Required." : "مطلوب كلمة مرور قديمة.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "User id Is Required." : "معرف المستخدم مطلوب.";
            return json_encode($resp); exit;
        }       
    } 

    public function user_profile_picture(){
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){                         
            if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
                $path 				= 'uploads/user_profile_picture/';
                $file 			    = $this->request->getFile('profile_image');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload profile_picture image file */
                if(isset($upload_file) && !empty($upload_file)){
                    /* update data  */
                    $result = $this->UserModel->update_data($_POST['user_id'],array(                                  
                        'profile_image' => $upload_file,                                    
                        "updated_at" => DATETIME
                    ));
                    if(isset($result) && !empty($result)){ 
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Profile Picture Updated successfully." : "تم تحديث صورة الملف الشخصي بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/profile');
                        return json_encode($resp); exit;    
                    }else{
                        $errorMsg = 'Error while Profile Picture Insertion.';
                        if(file_exists('uploads/user_profile_picture/'.$upload_file)){
                            unlink("store/".$this->storeActvTmplName."/uploads/user_profile_picture/".$upload_file);
                        }else{
                            $errorMsg .= ' and profile image is not exist so can not deleted from folder';
                        }
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }                                             
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Profile Image." : "خطأ أثناء تحميل صورة الملف الشخصي.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Profile image is required." : "صورة الملف الشخصي مطلوبة.";
                return json_encode($resp); exit;
            }                
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id is required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }      
    }

    public function delete_user_profile_pic(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $result = $this->UserModel->delete_profile_picture($_POST['id']);
                if(isset($result)){                       
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Profile Picture Removed From Profile Successfully." : "تمت إزالة صورة الملف الشخصي من الملف الشخصي بنجاح.";
                    
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Removing Picture From Profile." : "خطأ أثناء إزالة الصورة من ملف التعريف.";
                    return json_encode($resp); exit;
                } 
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store User Id Is Required." : "معرف مستخدم المتجر مطلوب.";
                return json_encode($resp); exit;
            }
    }

    public function uploadFile($path, $image) {
		if ($image->isValid() && ! $image->hasMoved()) {
			$newName = $image->getRandomName();
			$image->move('./'.$path, $newName);
            return $image->getName();
		}
		return "";
	}

    /* user forgoted password start */

    public function user_forgot_password(){
        $this->pageData['pageTitle'] = 'User Forgot Password';
        return view('store_admin/user/user-forgot-password',$this->pageData);
    }

    public function chk_password_forgoted_user_email(){
       
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email	= $this->request->getPost('email'); 
            
            $data = $this->UserModel->chk_user_exist_with_email($email);              
            if(isset($data) && !empty($data)){
                /* check customer has already raised password reset request or not */
                $is_exist = $this->UserModel->chk_reset_pass_request_exist($data->id);
               
                if($is_exist==true){                                  
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "you already raised password reset request so please check your registered email inbox/span folder for password reset link or contact administrator for further assistance." : "لقد قدمت بالفعل طلب إعادة تعيين كلمة المرور ، لذا يرجى التحقق من مجلد البريد الوارد / البريد المسجل الخاص بك للحصول على رابط إعادة تعيين كلمة المرور أو الاتصال بالمسؤول للحصول على مزيد من المساعدة.";                    
                    return json_encode($resp); exit;
                }else{

                    $insertedId = $this->UserModel->insert_user_reset_pass_data(array(                                                                           
                        'user_id' => $data->id,
                        'token' => password_hash($data->id, PASSWORD_DEFAULT),                                                                                                
                        "reset_flag" => 1,
                        "created_at" => DATETIME
                    ));
                   
                    if(is_int($insertedId)){

                        $server_site_path = base_url();
                        $store_logo = $server_site_path.'/store_admin/assets/images/logo.png';
                        $sociaFB = 'javascript:void(0);';
                        $socialTwitter = 'javascript:void(0);';
                        $socialYoutube = 'javascript:void(0);';
                        $socialLinkedin = 'javascript:void(0);';
                        $socialInstagram = 'javascript:void(0);';
                        $address = '';
                        $supportEmail = '';
                        $storeName = '';

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
                       
                        $resetLink = base_url('admin/user-reset-new-password/'.$data->id);                  
                        $this->pageData['storeLogo'] = $store_logo;
                        $this->pageData['sociaFB'] = $sociaFB;
                        $this->pageData['socialTwitter'] = $socialTwitter; 
                        $this->pageData['socialYoutube'] = $socialYoutube;
                        $this->pageData['socialLinkedin'] = $socialLinkedin;
                        $this->pageData['socialInstagram'] = $socialInstagram;       
                        $this->pageData['address'] = $address;
                        $this->pageData['name'] = $_POST['email'];
                        $this->pageData['supportEmail'] = $supportEmail;
                        $this->pageData['storeName'] = $storeName;             
                        $this->pageData['resetLink'] = $resetLink;
                        
                        $mailBody = view('store_admin/email-templates/user-forgoted-password',$this->pageData);
                        $subject ='Store User Password Reset Link';
                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                       
                        if($sendEmail == true){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Reset Link Sent to Your Registered Mail ID, Please Check Your Registered Mail Inbox/Spam Folder for Reset Link." : "تم إرسال رابط إعادة تعيين كلمة المرور إلى معرف البريد المسجل الخاص بك ، يرجى التحقق من صندوق الوارد للبريد المسجل / مجلد البريد العشوائي الخاص بك من أجل رابط إعادة التعيين.";
                            $resp['redirectUrl'] = base_url("admin/login");
                            return json_encode($resp); exit; 
                        }else{
                            $errorMsg =  $this->ses_lang=='en' ? "Error While Sending Email." : "خطأ أثناء إرسال البريد الإلكتروني.";                                                               
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While Customer Password Reset Request Insertion." : "حدث خطأ أثناء إدراج طلب إعادة تعيين كلمة مرور العميل.";                                                          
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Not Found.." : "البريد الإلكتروني غير موجود..";
                return json_encode($resp); exit;
            }
            
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Is Required." : "البريد الالكتروني مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function user_reset_new_password($userId=''){
        $is_exist = $this->UserModel->chk_reset_pass_request_exist($userId);
        if($is_exist==true){    
            $this->pageData['pageTitle'] = 'Set User New Password';
            $this->pageData['user_id'] = $userId;              
            return view('store_admin/user/reset-new-password',$this->pageData);
        }else{
            $this->pageData['pageTitle'] = 'Set User New Password';
            $this->pageData['errorMsg'] = $this->ses_lang=='en' ?'This password reset request link has already used or has been expired so you can contact an administrator for further assistance.':'تم استخدام رابط طلب إعادة تعيين كلمة المرور هذا بالفعل أو انتهت صلاحيته ، لذا يمكنك الاتصال بالمسؤول للحصول على مزيد من المساعدة.';
            return view('store_admin/user/reset-new-password',$this->pageData);
        }   
    }

    public function user_save_reset_password(){
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                $insertedCustmrPassId = $this->UserModel->update_user_pass_data($_POST['user_id'],array(                                                                           
                    'user_id' => $_POST['user_id'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), 
                    'is_active' => 1,
                    "updated_at" => DATETIME
                ));
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Reset Successfully." : "إعادة تعيين كلمة المرور بنجاح.";
                $resp['redirectUrl'] = base_url('admin/login');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 400;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Password Is Required." : "كلمة المرور مطلوبة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Id Is Required." : "معرف المستخدم مطلوب.";
            return json_encode($resp); exit;
        }
    }
    /* user forgoted password end */
}

?>



