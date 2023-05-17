<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class FaqController extends BaseController
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

    public function all_faqs(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Faqs';
            $this->pageData['adminPageId'] = 18;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['FaqList'] = $this->FaqModel->get_all_data();
            return view('store_admin/cms/all-faqs',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_faq(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Faq';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/cms/add-faq',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_faq(){  
        $enRqrdFldsAry = array();
        $arRqrdFldsAry = array();
        if($this->ses_lang == 'en'){   
            if(isset($_POST['question']) && !empty($_POST['question'])){
                if(isset($_POST['answear']) && !empty($_POST['answear'])){  
                    $question	= $_POST['question'];
                    $answear	= isset($_POST['answear'])?$_POST['answear']:'';
                    $enRqrdFldsAry = array(
                        "question" =>isset($question)?$question:'',
                        "answear" =>isset($answear)?$answear:''                               
                    );                          
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'Answer Is Required.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Question Is Required.';
                return json_encode($resp); exit;
            }
        }else{
            if(isset($_POST['question_ar']) && !empty($_POST['question_ar'])){
                if(isset($_POST['answear_ar']) && !empty($_POST['answear_ar'])){  
                    $question_ar	= $_POST['question_ar'];
                    $answear_ar	= isset($_POST['answear_ar'])?$_POST['answear_ar']:'';
                    $arRqrdFldsAry = array(
                        "question_ar" =>isset($question_ar)?$question_ar:'',
                        "answear_ar" =>isset($answear_ar)?$answear_ar:''                               
                    );                          
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'مطلوب الإجابة.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'السؤال مطلوب.';
                return json_encode($resp); exit;
            }

        }    
        $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);            
        $reqAry =array(                                                                                           
            "is_active" => 1,
            "created_at" => DATETIME
        );

        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry); 
        $result = $this->FaqModel->insert_data($finalReqAry);

        if(isset($result) && !empty($result)){ 
            
            $resp['responseCode'] = 200;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Added Successfully." : "تمت إضافة البيانات بنجاح."; 
            $resp['redirectUrl'] = base_url('admin/all-faqs');
            return json_encode($resp); exit; 
            
        }else{
            $errorMsg =  $this->ses_lang=='en' ? "Error While Faq Insertion." : "خطأ أثناء إدراج التعليمات.";                                 
            $resp['responseCode'] = 500;
            $resp['responseMessage'] = $errorMsg;
            return json_encode($resp); exit;
        }                                            
        
    }

    public function edit_faq($Id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Faq';
            $this->pageData['faqDetails'] = $this->FaqModel->find($Id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/cms/edit-faq',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_faq(){
        if(isset($_POST['faq_id']) && !empty($_POST['faq_id'])){
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){   
                if(isset($_POST['question']) && !empty($_POST['question'])){
                    if(isset($_POST['answear']) && !empty($_POST['answear'])){  
                        $question	= $_POST['question'];
                        $answear	= isset($_POST['answear'])?$_POST['answear']:'';
                        $enRqrdFldsAry = array(
                            "question" =>isset($question)?$question:'',
                            "answear" =>isset($answear)?$answear:''                               
                        );                          
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = 'Answer Is Required.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'Question Is Required.';
                    return json_encode($resp); exit;
                }
            }else{
                if(isset($_POST['question_ar']) && !empty($_POST['question_ar'])){
                    if(isset($_POST['answear_ar']) && !empty($_POST['answear_ar'])){  
                        $question_ar	= $_POST['question_ar'];
                        $answear_ar	= isset($_POST['answear_ar'])?$_POST['answear_ar']:'';
                        $arRqrdFldsAry = array(
                            "question_ar" =>isset($question_ar)?$question_ar:'',
                            "answear_ar" =>isset($answear_ar)?$answear_ar:''                               
                        );                          
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = 'مطلوب الإجابة.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'السؤال مطلوب.';
                    return json_encode($resp); exit;
                }

            }    
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
            $reqAry = array(  /* update banner data  */
                "updated_at" => DATETIME
            );
            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                                         
            $result = $this->FaqModel->update_data($_POST['faq_id'],$finalReqAry);
            if(isset($result) && !empty($result)){ 
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Updated Successfully." : "تم تحديث البيانات بنجاح."; 
                $resp['redirectUrl'] = base_url('admin/edit-faq/'.$_POST['faq_id']);
                return json_encode($resp); exit; 
            }else{                  
                $errorMsg =  $this->ses_lang=='en' ? "Error While Faq Insertion." : "خطأ أثناء إدراج التعليمات.";                           
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }             
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Faq Id Is Required." : "مطلوب معرف التعليمات.";
            return json_encode($resp); exit;
        }
    }

    public function delete_faq(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update faq status in database table name as 'faqs' */
            $affectedRowId = $this->FaqModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Faq Deleted Successfully." : "تم حذف الأسئلة الشائعة بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-faqs');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Faq Deletion." : "خطأ أثناء حذف التعليمات.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "FAQ Id Is Required." : "مطلوب معرف التعليمات.";
            return json_encode($resp); exit;
        }
    }

    public function activate_faq(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update faq status in database table name as 'faqs' */
            $affectedRowId = $this->FaqModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Activated Successfully." : "تم تفعيل البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-faqs');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While FAQ Deletion." : "خطأ أثناء حذف الأسئلة الشائعة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "FAQ Id Is Required." : "مطلوب معرف التعليمات.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_faq(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update faq status in database table name as 'faqs' */
            $affectedRowId = $this->FaqModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Deactivated Successfully." : "تم إلغاء تنشيط البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-faqs');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While FAQ Deletion." : "خطأ أثناء حذف الأسئلة الشائعة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "FAQ Id Is Required." : "مطلوب معرف التعليمات.";
            return json_encode($resp); exit;
        }
    }

    public function customer_help(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Customer Help';
            $this->pageData['adminPageId'] = 24;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['CustomerHelp'] = $this->SettingModel->find();
            return view('store_admin/help/customer-help',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_customer_help(){
        $enRqrdFldsAry = array();
        $arRqrdFldsAry = array();
        if($this->ses_lang == 'en'){   
            if(isset($_POST['customer_help']) && !empty($_POST['customer_help'])){

                    $customer_help	= isset($_POST['customer_help'])?$_POST['customer_help']:'';
                    $enRqrdFldsAry = array(                        
                        "customer_help" =>isset($customer_help)?$customer_help:''                               
                    );
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Help Is Required." : "مطلوب مساعدة العملاء.";
                return json_encode($resp); exit;
            }
        }else{
            if(isset($_POST['customer_help_ar']) && !empty($_POST['customer_help_ar'])){

                    $customer_help_ar	= isset($_POST['customer_help_ar'])?$_POST['customer_help_ar']:'';
                    $arRqrdFldsAry = array(                        
                        "customer_help_ar" =>isset($customer_help_ar)?$customer_help_ar:''                               
                    );
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Help Is Required." : "مطلوب مساعدة العملاء.";
                return json_encode($resp); exit;
            }

        }    
        $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry); 
                $reqAry = array( 
                    "updated_at" => DATETIME
                ); 
        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                      
        $result = $this->SettingModel->update_data(1,$finalReqAry);
        
        if(is_int($result)){                             
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Added Successfully." : "تمت إضافة البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/customer-help');
                return json_encode($resp); exit;            
        }else{
                $errorMsg = 'Error While Data Insertion.';                                    
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
        } 
        
    }

    public function update_customer_help(){
        if(isset($_POST['cushelp_id']) && !empty($_POST['cushelp_id'])){ 
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){   
                if(isset($_POST['customer_help']) && !empty($_POST['customer_help'])){
    
                        $customer_help	= isset($_POST['customer_help'])?$_POST['customer_help']:'';
                        $enRqrdFldsAry = array(                        
                            "customer_help" =>isset($customer_help)?$customer_help:''                               
                        );
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Help Is Required." : "مطلوب مساعدة العملاء.";
                    return json_encode($resp); exit;
                }
            }else{
                if(isset($_POST['customer_help_ar']) && !empty($_POST['customer_help_ar'])){
    
                        $customer_help_ar	= isset($_POST['customer_help_ar'])?$_POST['customer_help_ar']:'';
                        $arRqrdFldsAry = array(                        
                            "customer_help_ar" =>isset($customer_help_ar)?$customer_help_ar:''                               
                        );
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Customer Help Is Required." : "مطلوب مساعدة العملاء.";
                    return json_encode($resp); exit;
                }
    
            }    
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);  
            $reqAry = array( 
                "updated_at" => DATETIME
            );
            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);   
            $result = $this->SettingModel->update_data($_POST['cushelp_id'],$finalReqAry);

            if(isset($result) && !empty($result)){                             
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Updated successfully." : "تم تحديث البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/customer-help');
                return json_encode($resp); exit; 
                
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Data Updation." : "خطأ أثناء تحديث البيانات.";                                   
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            } 
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }   

    public function admin_help(){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Admin Help';  
            $this->pageData['adminPageId'] = 23;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();    
            return view('store_admin/help/admin-help',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function terms_conditions(){     
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Terms And Conditions';
            $this->pageData['adminPageId'] = 20;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $GetTermsconditonData = $this->TermsConditionsModel->get_all_data();
            if(isset($GetTermsconditonData) && !empty($GetTermsconditonData)){
                $this->pageData['GetTermsconditonInfo'] = $GetTermsconditonData;
            }
            return view('store_admin/cms/terms-conditions',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_terms_conditions(){  
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){ 
                if(isset($_POST['title']) && !empty($_POST['title'])){ 
                    if(isset($_POST['description']) && !empty($_POST['description'])){ 
                            $title	= $this->request->getPost('title');     
                            $description	= $this->request->getPost('description');     
                            $enRqrdFldsAry = array(                                                                           
                                "title" =>isset($title)?$title:'',
                                "description" =>isset($description)?$description:''
                            );
                    }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Description Is Required." : "الوصف مطلوب.";
                    return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }
                            
            }else{
                if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){ 
                    if(isset($_POST['description_ar']) && !empty($_POST['description_ar'])){ 
                            $title_ar	= $this->request->getPost('title_ar');     
                            $description_ar	= $this->request->getPost('description_ar');     
                            $arRqrdFldsAry = array(                                                                           
                                "title_ar" =>isset($title_ar)?$title_ar:'',
                                "description_ar" =>isset($description_ar)?$description_ar:'',                                
                            );
                    }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Description Is Required." : "الوصف مطلوب.";
                    return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }

            }         
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);  
            $reqAry =array(                                                                                           
                "is_active" => 1,
                "created_at" => DATETIME
            );
            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);   

            $result = $this->TermsConditionsModel->insert_data($finalReqAry);
            if(isset($result) && !empty($result)){                             
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Added Successfully." : "تمت إضافة البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/terms-conditions');
                return json_encode($resp); exit;                
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Data Insertion." : "خطأ أثناء إدخال البيانات.";
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }            
    }
    
    public function update_terms_conditions(){   
        if(isset($_POST['tc_id']) && !empty($_POST['tc_id'])){  
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){ 
                if(isset($_POST['title']) && !empty($_POST['title'])){ 
                    if(isset($_POST['description']) && !empty($_POST['description'])){ 
                        $title	= $this->request->getPost('title');     
                        $description	= $this->request->getPost('description');     
                        $enRqrdFldsAry = array(                                                                           
                            "title" =>isset($title)?$title:'',
                            "description" =>isset($description)?$description:''
                        );
                    }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Description Is Required." : "الوصف مطلوب.";
                    return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }
                            
            }else{
                if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){ 
                    if(isset($_POST['description_ar']) && !empty($_POST['description_ar'])){ 
                            $title_ar	= $this->request->getPost('title_ar');     
                            $description_ar	= $this->request->getPost('description_ar');     
                            $arRqrdFldsAry = array(                                                                           
                                "title_ar" =>isset($title_ar)?$title_ar:'',
                                "description_ar" =>isset($description_ar)?$description_ar:'',                                
                            );
                    }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Description Is Required." : "الوصف مطلوب.";
                    return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }

            }         
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
            $reqAry = array( 
                "updated_at" => DATETIME
            );
            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);   
            $result = $this->TermsConditionsModel->update_data($_POST['tc_id'],$finalReqAry);

            if(isset($result) && !empty($result)){                             
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Updated successfully." : "تم تحديث البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/terms-conditions');
                return json_encode($resp); exit; 
                
            }else{
                $errorMsg =  $this->ses_lang=='en' ? "Error While Data Updation." : "خطأ أثناء تحديث البيانات.";                                 
                $resp['responseCode'] = 500;
                $resp['responseMessage'] = $errorMsg;
                return json_encode($resp); exit;
            }             
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function about_us(){      
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'About Us';
            $this->pageData['adminPageId'] = 19;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $AboutUsData = $this->AboutUsModel->get_all_data();
            if(isset($AboutUsData) && !empty($AboutUsData)){
                $this->pageData['GetAboutUsInfo'] = $AboutUsData;
            }
            return view('store_admin/cms/about-us',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }        
    }

    public function save_about_us(){        
       
        $enRqrdFldsAry = array();
        $arRqrdFldsAry = array();
        if($this->ses_lang == 'en'){
            if(isset($_POST['title']) && !empty($_POST['title'])){
                if(isset($_POST['short_description']) && !empty($_POST['short_description'])){
                    if(isset($_POST['long_description']) && !empty($_POST['long_description'])){
                        $title	= $this->request->getPost('title'); 
                        $short_description	= $this->request->getPost('short_description');
                        $long_description	= $this->request->getPost('long_description');
                        $enRqrdFldsAry = array(
                            "title" =>isset($title)?$title:'',
                            "short_description" =>isset($short_description)?$short_description:'',
                            "long_description" =>isset($long_description)?$long_description:''                                
                        ); 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Description Is Required." : "الوصف مطلوب.";
                        return json_encode($resp); exit;
                        }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Short Description Is Required." : "مطلوب وصف قصير.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                if(isset($_POST['short_description_ar']) && !empty($_POST['short_description_ar'])){
                    if(isset($_POST['long_description_ar']) && !empty($_POST['long_description_ar'])){
                        $title_ar	= $this->request->getPost('title_ar'); 
                        $short_description_ar	= $this->request->getPost('short_description_ar');
                        $long_description_ar	= $this->request->getPost('long_description_ar');
                        $enRqrdFldsAry = array(
                            "title_ar" =>isset($title_ar)?$title_ar:'',
                            "short_description_ar" =>isset($short_description_ar)?$short_description_ar:'',
                            "long_description_ar" =>isset($long_description_ar)?$long_description_ar:''                                
                        ); 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Long Description Is Required." : "مطلوب وصف طويل.";
                        return json_encode($resp); exit;
                        }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Short Description Is Required." : "مطلوب وصف قصير.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                return json_encode($resp); exit;
            }

        }
        $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);       
        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
            $path 				= 'uploads/aboutus/';
            $file 			    = $this->request->getFile('image');
            $upload_file 	    = $this->uploadFile($path, $file); /* upload banner image file */
            if(isset($upload_file) && !empty($upload_file)){
                /* save banner data  */
                $reqAry = array(                            
                    'image' => $upload_file,
                    "is_active" => 1,
                    "created_at" => DATETIME
                );
                $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);  

                $insertedId = $this->AboutUsModel->insert_data($finalReqAry); 
                if(is_int($insertedId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Added Successfully." : "تمت إضافة البيانات بنجاح.";
                    $resp['redirectUrl'] = base_url('admin/about-us');
                    return json_encode($resp); exit;
                }else{
                    $errorMsg =  $this->ses_lang=='en' ? "Error While Abous Us Insertion." : "خطأ أثناء الإدراج لنا.";
                    if(file_exists('uploads/aboutus/'.$upload_file)){
                        unlink("uploads/aboutus/".$upload_file);
                    }else{
                        $errorMsg .= ' and About image is not exist so can not deleted from folder';
                    }
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading About Us Image." : "خطأ أثناء تحميل صورة نبذة عنا";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "About Us Image Is Required." : "معلومات عنا الصورة مطلوبة.";
            return json_encode($resp); exit;
        }               
      
    }
    public function update_about_us(){       
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){
                if(isset($_POST['title']) && !empty($_POST['title'])){
                    if(isset($_POST['short_description']) && !empty($_POST['short_description'])){
                        if(isset($_POST['long_description']) && !empty($_POST['long_description'])){
                            $title	= $this->request->getPost('title'); 
                            $short_description	= $this->request->getPost('short_description');
                            $long_description	= $this->request->getPost('long_description');
                            $enRqrdFldsAry = array(
                                "title" =>isset($title)?$title:'',
                                "short_description" =>isset($short_description)?$short_description:'',
                                "long_description" =>isset($long_description)?$long_description:''                                
                            ); 
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Long Description Is Required." : "مطلوب وصف طويل.";
                            return json_encode($resp); exit;
                            }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Short Description Is Required." : "مطلوب وصف قصير.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }
            }else{
                if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                    if(isset($_POST['short_description_ar']) && !empty($_POST['short_description_ar'])){
                        if(isset($_POST['long_description_ar']) && !empty($_POST['long_description_ar'])){
                            $title_ar	= $this->request->getPost('title_ar'); 
                            $short_description_ar	= $this->request->getPost('short_description_ar');
                            $long_description_ar	= $this->request->getPost('long_description_ar');
                            $enRqrdFldsAry = array(
                                "title_ar" =>isset($title_ar)?$title_ar:'',
                                "short_description_ar" =>isset($short_description_ar)?$short_description_ar:'',
                                "long_description_ar" =>isset($long_description_ar)?$long_description_ar:''                                
                            ); 
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Long Description Is Required." : "مطلوب وصف طويل.";
                            return json_encode($resp); exit;
                            }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Short Description Is Required." : "مطلوب وصف قصير.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Title Is Required." : "العنوان مطلوب.";
                    return json_encode($resp); exit;
                }

            }
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){  /* upload About us image if set */
                $path 				= 'uploads/aboutus/';
                $file 			    = $this->request->getFile('image');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload About us image file */
                if(isset($upload_file) && !empty($upload_file)){     
                    
                    $reqAry = array(  /* update About us data  */                        
                        'image' => $upload_file,
                        "updated_at" => DATETIME
                    );  
                    $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                     
                    $affectedRowId = $this->AboutUsModel->update_data($_POST['id'],$finalReqAry );
                    if(is_int($affectedRowId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "About Us Page Content Updated Successfully." : "من نحن تم تحديث محتوى الصفحة بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/about-us/');
                        return json_encode($resp); exit;
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While About Information Updating." : "خطأ أثناء تحديث المعلومات.";
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading About image." : "خطأ أثناء تحميل حول الصورة";
                    return json_encode($resp); exit;
                }
            }else{
                /* update banner info in database table name as 'banners' */
                $reqAry = array(                   
                    "updated_at" => DATETIME
                );
                $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);    
                $affectedRowId = $this->AboutUsModel->update_data($_POST['id'], $finalReqAry);
                if(is_int($affectedRowId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Updated Successfully." : "تم تحديث البيانات بنجاح."; 
                    $resp['redirectUrl'] = base_url('admin/about-us');
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While About Updated Successfully." : "خطأ أثناء التحديث بنجاح."; 
                    return json_encode($resp); exit;
                }
            }            
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
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
    
    public function all_subscribes(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Subscribes';
            $this->pageData['adminPageId'] = 21;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['SubscribesList'] = $this->SubscribesModel->get_all_data();
            return view('store_admin/cms/all-subscribes',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function delete_subscribes(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId = $this->SubscribesModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Subscribed Email Removed  Successfully." : "تمت إزالة البريد الإلكتروني المشترك بنجاح.";               
                $resp['redirectUrl'] = base_url('admin/all-subscribes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Subscribes Deletion" : "خطأ أثناء حذف الاشتراكات";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Subscribes Id Is Required." : "معرف الاشتراك مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function activate_subscribes(){
       
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId = $this->SubscribesModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email Subscribe Successfully." : "اشترك في البريد الإلكتروني بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-subscribes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Subscribes Deletion." : "خطأ أثناء حذف الاشتراكات.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Subscribes Id is Required." : "معرف الاشتراكات مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_subscribes(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId = $this->SubscribesModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Email UnSubscribe Successfully." : "البريد الإلكتروني إلغاء الاشتراك بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-subscribes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Subscribes Deletion." : "خطأ أثناء حذف الاشتراكات.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Subscribes Id Is Required." : "معرف الاشتراك مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function all_contact_us(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Contact Us';
            $this->pageData['adminPageId'] = 22;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['ContactUsList'] = $this->ContactUsModel->get_all_data();
            return view('store_admin/cms/all-contact-us',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function view_contact_us($id){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'View Contact Us';
            $this->pageData['ContactUsInfo'] = $this->ContactUsModel->get_single_data($id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/cms/view-contact-us',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }
    
    public function reply_contact_admin(){       
            if(isset($_POST['id']) && !empty($_POST['id'])){
                if(isset($_POST['admin_reply']) && !empty($_POST['admin_reply'])){

                        $getUserMsg = $this->ContactUsModel->get_single_data($_POST['id']);                  
                        $admin_reply = $this->request->getPost('admin_reply'); 
                        $email = $this->request->getPost('email'); 
                       
                        $insertedId =
                        $this->ContactUsModel->update_data($_POST['id'], array(
                            "admin_reply" => isset($admin_reply)?$admin_reply:'',
                            "updated_at" => DATETIME
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
                            $this->pageData['storeLogo'] = $store_logo;
                            $this->pageData['sociaFB'] = $sociaFB;
                            $this->pageData['socialTwitter'] = $socialTwitter;
                            $this->pageData['socialYoutube'] = $socialYoutube;
                            $this->pageData['socialLinkedin'] = $socialLinkedin;
                            $this->pageData['socialInstagram'] = $socialInstagram;
                            $this->pageData['massage'] = $getUserMsg->massage;
                            $this->pageData['adminReply'] = $admin_reply;
                            $this->pageData['name'] = $_POST['name'];
                            $this->pageData['address'] = $address;
                            $this->pageData['supportEmail'] = $supportEmail;
                            $this->pageData['storeName'] = $storeName;
                            $mailBody = view('store_admin/email-templates/admin-reply-contact',$this->pageData);     
                            $subject = $this->ses_lang=='en' ? $storeName.' - Response From Support' : $storeName.'- استجابة من الدعم';
                            $sendEmail = $this->sendEmail($email,$mailBody,$subject);
                            if($sendEmail == true){
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Reply Sent Successfully to Customer." : "تم إرسال الرد بنجاح إلى العميل.";
                                $resp['redirectUrl'] = $_SERVER['HTTP_REFERER'];
                                return json_encode($resp); exit; 
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error while sending email." : "خطأ أثناء إرسال البريد الإلكتروني.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While Contact Us Request Insertion" : "خطأ أثناء الاتصال بنا طلب الإدراج";
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    } 
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Meassage Is Required." : "القياس مطلوب.";
                    return json_encode($resp); exit;
                }               
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
                return json_encode($resp); exit;
            }        
    }

    public function delete_contact_us(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId =  $this->ContactUsModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Deleted Successfully." : "تم حذف البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-contact-us');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Data Deletion." : "خطأ أثناء حذف البيانات.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";;
            return json_encode($resp); exit;
        }
    }

    public function activate_contact_us(){
       
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId =  $this->ContactUsModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Activated Successfully." : "تم تفعيل البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-contact-us');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Data Deletion.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_contact_us(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $affectedRowId =  $this->ContactUsModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Data Deactivated Successfully." : "تم إلغاء تنشيط البيانات بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-contact-us');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Data Reletion." : "خطأ أثناء إعادة البيانات.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }

}
?>



