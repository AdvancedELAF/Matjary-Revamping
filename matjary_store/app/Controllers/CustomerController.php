<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CustomerController extends BaseController
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
    
    public function index(){
        $this->pageData['pageTitle'] = 'Dashboard';
        return view('store_admin/dashboard',$this->pageData);
    }

    public function all_customers(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
        $this->pageData['pageTitle'] = 'All Customerss';
        $this->pageData['adminPageId'] = 13;	
        $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
		$this->pageData['customerList'] = $this->CustomerModel->get_all_data();
        return view('store_admin/customer/all-customers',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_customer(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
        $this->pageData['pageTitle'] = 'Add Customer';
        $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
        return view('store_admin/customer/add-customer',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_customer(){
        if(isset($_POST['name']) && !empty($_POST['name'])){
            if(isset($_POST['email']) && !empty($_POST['email'])){
                if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                    $nameExist = $this->CustomerModel->check_email_exist($_POST['email']); /* check email already exist or not */
                    if($nameExist==true){
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email already exits with another customer." : "البريد الإلكتروني يخرج بالفعل مع عميل آخر.";
                        return json_encode($resp); exit;
                    }else{
                        $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                        $email	= $this->request->getPost('email');                            
                        $contact_no = $this->request->getPost('contact_no');
                        $server_site_path = base_url();
                        // $this->pageData['EmailData'] = $this->SettingModel->get_all_data();
                        // $images = $server_site_path.'/uploads/logo/'.$this->pageData['EmailData'][0]->logo;
                        // $this->pageData['Emailimages'] = $images;    
                        $store_logo = '<img src="'.$server_site_path.'/store_admin/assets/images/logo.png">';
                        $sociaFB = 'javascript:void(0);';
                        $socialTwitter = 'javascript:void(0);';
                        $socialYoutube = 'javascript:void(0);';
                        $socialLinkedin = 'javascript:void(0);';
                        $socialInstagram = 'javascript:void(0);';                             
                        if(isset($this->pageData['storeSettingInfo']) && !empty($this->pageData['storeSettingInfo'])){
                            if (isset($this->pageData['storeSettingInfo']->logo) && !empty($this->pageData['storeSettingInfo']->logo)) {
                                $store_logo = '<img src="'.$server_site_path.'/store_admin/uploads/logo/'.$this->pageData['storeSettingInfo']->logo.'">';
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
                        }
                        $this->pageData['store_logo'] = $store_logo;
                        $this->pageData['sociaFB'] = $sociaFB; 
                        $this->pageData['socialTwitter'] = $socialTwitter; 
                        $this->pageData['socialYoutube'] = $socialYoutube; 
                        $this->pageData['socialLinkedin'] = $socialLinkedin;                       
                        $this->pageData['socialInstagram'] = $socialInstagram; 
                        $mailBody = view('store_admin/customer/email-customer',$this->pageData);
                        $subject ='Customer Registration Sucessfully';
                        $sendEmail = $this->sendEmail($email,$mailBody,$subject);                      
                                              
                        if($sendEmail == true){
                        $result = $this->CustomerModel->insert_data(array(                                                                           
                            "name" =>isset($name)?$name:'',
                            "email" => isset($email)?$email:'',                                  
                            "contact_no" => isset($contact_no)?$contact_no:'',                                                                                                 
                            "is_active" => 1,
                            "created_at" => DATETIME
                        ));

                        if(isset($result) && !empty($result)){ 
                            
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Added Successfully." : "تمت إضافة العميل بنجاح.";
                            $resp['redirectUrl'] = base_url('admin/all-customers');
                            return json_encode($resp); exit; 
                            
                        }else{
                            $errorMsg =  $this->ses_lang=='en' ? "Error While Customer Insertion." : "خطأ أثناء إدراج العميل.";
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While Email Sending." : "خطأ أثناء إرسال البريد الإلكتروني.";
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;

                    }
                    }    
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Contact Number Is Required." : "رقم الاتصال مطلوب.";
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

    public function edit_customer($id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){  
            $this->pageData['pageTitle'] = 'Edit Customer';
            $this->pageData['customerDetails'] = $this->CustomerModel->find($id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/customer/edit-customer',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_customer(){
        if(isset($_POST['cus_id']) && !empty($_POST['cus_id'])){
        if(isset($_POST['name']) && !empty($_POST['name'])){
                if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                        $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                        $email	= $this->request->getPost('email');                      
                        $contact_no = $this->request->getPost('contact_no');                     
                        $result = $this->CustomerModel->update_data($_POST['cus_id'],array(                                                                           
                            "name" =>isset($name)?$name:'',
                            /*"email" => isset($email)?$email:'', */                          
                            "contact_no" => isset($contact_no)?$contact_no:'',
                            "updated_at" => DATETIME
                        ));
                        if(isset($result) && !empty($result)){ 
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Update Successfully." : "تحديث العميل بنجاح.";
                            $resp['redirectUrl'] = base_url('admin/all-customers');
                            return json_encode($resp); exit;         
                        
                        }else{
                            $errorMsg =  $this->ses_lang=='en' ? "Error While Customer Insertion." : "خطأ أثناء إدراج العميل.";
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
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم.";
            return json_encode($resp); exit;
        }
    }else{
        $resp['responseCode'] = 404;
        $resp['responseMessage'] =  $this->ses_lang=='en' ? "User Id Is Required." : "معرف المستخدم مطلوب.";
        return json_encode($resp); exit;
    }
    }

    public function delete_customer(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CustomerModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Deleted Successfully." : "تم حذف العميل بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-customers');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Customer Deletion." : "خطأ أثناء حذف العميل.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Id Is Required." : "معرف العميل مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function activate_customer(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CustomerModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Activated Successfully." : "تم تفعيل العميل بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-customers');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Customer Deletion." : "خطأ أثناء حذف العميل.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Id Is Required." : "معرف العميل مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_customer(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CustomerModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME    
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Deactivated Successfully." : "تم إلغاء تنشيط العميل بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-customers');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $$resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Customer Deletion." : "خطأ أثناء حذف العميل.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Id Is Required." : "معرف العميل مطلوب.";
            return json_encode($resp); exit;
        }
    }   
   
}

?>



