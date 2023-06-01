<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class CouponController extends BaseController
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

    public function all_coupons(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){ 
            $this->pageData['pageTitle'] = 'All Customerss';
            $this->pageData['adminPageId'] = 12;	
            $this->pageData['table'] = $this->Coupons;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['couponList'] = $this->CouponModel->get_all_data();
            return view('store_admin/coupon/all-coupons',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_coupon(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Coupon';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/coupon/add-coupon',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_coupon(){ 
        if(isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])){
            if(isset($_POST['coupon_desc']) && !empty($_POST['coupon_desc'])){
                if(isset($_POST['coupon_startdate']) && !empty($_POST['coupon_startdate'])){                              
                    if(isset($_POST['coupon_expirydate']) && !empty($_POST['coupon_expirydate'])){                            
                        if(isset($_POST['discount_type']) && !empty($_POST['discount_type'])){
                            $enRqrdFldsAry = array();
                            $arRqrdFldsAry = array();
                            if($this->ses_lang == 'en'){   
                                if(isset($_POST['coupon_title']) && !empty($_POST['coupon_title'])){ 
                                    $coupon_title	= isset($_POST['coupon_title'])?$_POST['coupon_title']:'';
                                    $enRqrdFldsAry = array(
                                        "coupon_title" =>isset($coupon_title)?$coupon_title:''                               
                                    );                          
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = 'Title Is Required.';
                                    return json_encode($resp); exit;
                                }
                                
                            }else{
                                if(isset($_POST['coupon_title_ar']) && !empty($_POST['coupon_title_ar'])){ 
                                    $coupon_title_ar	= isset($_POST['coupon_title_ar'])?$_POST['coupon_title_ar']:'';
                                    $arRqrdFldsAry = array(
                                        "coupon_title_ar" =>isset($coupon_title_ar)?$coupon_title_ar:''                               
                                    );                          
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = 'العنوان مطلوب.';
                                    return json_encode($resp); exit;
                                }                                   
                            }    
                            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
                                                            
                            
                            $coupon_code	= $this->request->getPost('coupon_code');                            
                            $coupon_desc = $this->request->getPost('coupon_desc');
                            $coupon_startdate = date('Y-m-d', strtotime($_POST['coupon_startdate']));
                            $coupon_expirydate = date('Y-m-d', strtotime($_POST['coupon_expirydate']));
                            $discount_type = $this->request->getPost('discount_type');
                            $discount_value	 = $this->request->getPost('discount_value');
                            $for_orders	 = $this->request->getPost('for_orders');
                            $min_amount	 = $this->request->getPost('min_amount');

                            $reqAry =array( 
                                "coupon_code" => isset($coupon_code)?$coupon_code:'',                                  
                                "coupon_desc" => isset($coupon_desc)?$coupon_desc:'', 
                                "coupon_startdate" => isset($coupon_startdate)?$coupon_startdate:'', 
                                "coupon_expirydate" => isset($coupon_expirydate)?$coupon_expirydate:'',
                                "discount_type" => isset($discount_type)?$discount_type:'',  
                                "discount_value" => isset($discount_value)?$discount_value:'',
                                "for_orders" => isset($for_orders)?$for_orders:'',
                                "min_amount" => isset($min_amount)?$min_amount:'',		                                                                                                  
                                "is_active" => 1,
                                "created_at" => DATETIME
                            ); 
                            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);       
                            $result = $this->CouponModel->insert_data($finalReqAry);

                            if(isset($result) && !empty($result)){ 
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Code Added Successfully." : "تمت إضافة رمز القسيمة بنجاح.";                                 
                                $resp['redirectUrl'] = base_url('admin/all-coupons');
                                return json_encode($resp); exit;           
                            
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Coupon Code Insertion." : "خطأ أثناء إدراج رمز القسيمة.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                                        
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Discount Type Is Required." : "نوع الخصم مطلوب.";
                            return json_encode($resp); exit;
                        } 
                    
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "End Date Is Required." : "تاريخ الانتهاء مطلوب.";
                        return json_encode($resp); exit;
                    }  
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Start Date Is Required." : "تاريخ البدء مطلوب.";
                    return json_encode($resp); exit;
                }     
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Description Number Is Required." : "رقم وصف القسيمة مطلوب.";
                return json_encode($resp); exit;
            }               
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Code Is Required." : "الرمز مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function edit_coupon($id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Coupon';
            $this->pageData['couponDetails'] = $this->CouponModel->find($id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/coupon/edit-coupon',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_coupon(){     
        if(isset($_POST['coupon_id']) && !empty($_POST['coupon_id'])){
                if(isset($_POST['coupon_desc']) && !empty($_POST['coupon_desc'])){
                    if(isset($_POST['coupon_startdate']) && !empty($_POST['coupon_startdate'])){                              
                        if(isset($_POST['coupon_expirydate']) && !empty($_POST['coupon_expirydate'])){                            
                                if(isset($_POST['discount_type']) && !empty($_POST['discount_type'])){

                                $enRqrdFldsAry = array();
                                $arRqrdFldsAry = array();
                                if($this->ses_lang == 'en'){   
                                    if(isset($_POST['coupon_title']) && !empty($_POST['coupon_title'])){ 
                                        $coupon_title	= isset($_POST['coupon_title'])?$_POST['coupon_title']:'';
                                        $enRqrdFldsAry = array(
                                            "coupon_title" =>isset($coupon_title)?$coupon_title:''                               
                                        );                          
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] = 'Title Is Required.';
                                        return json_encode($resp); exit;
                                    }
                                  
                                }else{
                                    if(isset($_POST['coupon_title_ar']) && !empty($_POST['coupon_title_ar'])){ 
                                        $coupon_title_ar	= isset($_POST['coupon_title_ar'])?$_POST['coupon_title_ar']:'';
                                        $arRqrdFldsAry = array(
                                            "coupon_title_ar" =>isset($coupon_title_ar)?$coupon_title_ar:''                               
                                        );                          
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] = 'العنوان مطلوب.';
                                        return json_encode($resp); exit;
                                    }                                   
                                }    
                                $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);                                              
                                   
                                $coupon_desc = $this->request->getPost('coupon_desc');
                                $coupon_startdate = date('Y-m-d', strtotime($_POST['coupon_startdate']));
                                $coupon_expirydate = date('Y-m-d', strtotime($_POST['coupon_expirydate']));
                                $discount_type = $this->request->getPost('discount_type');
                                $discount_value	 = $this->request->getPost('discount_value');
                                $for_orders	 = $this->request->getPost('for_orders');
                                $min_amount	 = $this->request->getPost('min_amount'); 
                                $reqAry = array(   
                                        "coupon_desc" => isset($coupon_desc)?$coupon_desc:'',                                                                                                 
                                        "coupon_startdate" => isset($coupon_startdate)?$coupon_startdate:'', 
                                        "coupon_expirydate" => isset($coupon_expirydate)?$coupon_expirydate:'', 
                                        "discount_type" => isset($discount_type)?$discount_type:'',  
                                        "discount_value" => isset($discount_value)?$discount_value:'',
                                        "for_orders" => isset($for_orders)?$for_orders:'',
                                        "min_amount" => isset($min_amount)?$min_amount:'',	
                                        "updated_at" => DATETIME
                                );
                                $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                              
                                
                                $result = $this->CouponModel->update_data($_POST['coupon_id'],$finalReqAry);
                                if(isset($result) && !empty($result)){ 
                                    $resp['responseCode'] = 200;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Code Update Successfully." : "تم تحديث رمز القسيمة بنجاح.";
                                    $resp['redirectUrl'] = base_url('admin/edit-coupon/'.$_POST['coupon_id']);
                                    return json_encode($resp); exit;           
                                
                                }else{                                    
                                    $errorMsg =  $this->ses_lang=='en' ? "Error while Coupon Code Updation." : "خطأ أثناء تحديث رمز القسيمة.";
                                    $resp['responseCode'] = 500;
                                    $resp['responseMessage'] = $errorMsg;
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Discount Type Is Required." : "نوع الخصم مطلوب.";
                                return json_encode($resp); exit;
                            } 
                            
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "End Date Is Required." : "تاريخ الانتهاء مطلوب.";
                            return json_encode($resp); exit;
                        } 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Start Date Is Required." : "تاريخ البدء مطلوب.";
                        return json_encode($resp); exit;
                    }
                    
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Description Number Is Required." : "رقم وصف القسيمة مطلوب.";
                    return json_encode($resp); exit;
                }           
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id is required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function delete_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CouponModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Deleted Successfully." : "تم حذف القسيمة بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-coupons');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Coupon Deletion." : "خطأ أثناء حذف القسيمة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Id Is Required." : "معرف القسيمة مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function activate_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CouponModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Activated Successfully." : "تم تفعيل القسيمة بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-coupons');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Coupon Deletion." : "خطأ أثناء حذف القسيمة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Id Is Required." : "معرف القسيمة مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->CouponModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Deactivated Successfully." : "تم إلغاء تنشيط القسيمة بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-coupons');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Coupon Deletion." : "خطأ أثناء حذف القسيمة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Coupon Id Is Required." : "معرف القسيمة مطلوب.";
            return json_encode($resp); exit;
        }
    }

}

?>



