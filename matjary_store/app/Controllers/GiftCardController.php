<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class GiftCardController extends BaseController
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

    public function all_gift_cards(){      
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Gift Cards';
            $this->pageData['adminPageId'] = 25;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            $this->pageData['GiftCardList'] = $this->GiftCardModel->get_all_data();
            return view('store_admin/gift_card/all_gift_cards',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_gift_card(){   
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){ 
            $this->pageData['pageTitle'] = 'Add Gift Card';
            $this->pageData['CheckList'] = $this->GiftCardModel->get_all_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            return view('store_admin/gift_card/add-gift-card',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_gift_card(){        
        if(isset($_POST['start_date']) && !empty($_POST['start_date'])){
            if(isset($_POST['expiry_date']) && !empty($_POST['expiry_date'])){
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){
                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                    $enRqrdFldsAry = array(
                        "name" =>isset($name)?$name:''                              
                    ); 
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم."; 
                    return json_encode($resp); exit;
                }
            }else{
                if(isset($_POST['name_ar']) && !empty($_POST['name_ar'])){
                    $name_ar	= $this->request->getPost('name_ar');
                    $arRqrdFldsAry = array(
                        "name_ar" =>isset($name_ar)?$name_ar:''                              
                    ); 
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'مطلوب اسم.';
                    return json_encode($resp); exit;
                }

            }
            $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);     
            //$egift_code	= $this->remove_special_char_from_string($this->request->getPost('egift_code'));
            $start_date = date('Y-m-d', strtotime($_POST['start_date']));
            $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date']));
                    
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
                $path 				= 'uploads/giftcards/';
                $file 			    = $this->request->getFile('image');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload giftcards image file */
                if(isset($upload_file) && !empty($upload_file)){
                    $reqAry = array(
                        'image' => $upload_file,
                        'start_date' => $start_date,
                        'expiry_date' => $expiry_date,
                        "is_active" => 1,
                        "created_at" => DATETIME
                    );
                    $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);
                    /* save giftcards data  */
                    $insertedId = $this->GiftCardModel->insert_data($finalReqAry); 
                    if(is_int($insertedId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Added Successfully." : "تمت إضافة بطاقة الهدايا بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/all-gift-cards');
                        return json_encode($resp); exit;
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While Gift Card Insertion." : "خطأ أثناء إدخال بطاقة الهدايا.";
                        if(file_exists('uploads/giftcards/'.$upload_file)){
                            unlink("store/".$this->storeActvTmplName."/uploads/giftcards/".$upload_file);
                        }else{
                            $errorMsg .= ' and Gift card image is not exist so can not deleted from folder';
                        }
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Gift Card Image." : "خطأ أثناء تحميل صورة بطاقة الهدايا.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Image Is Required." : "مطلوب صورة بطاقة الهدايا.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Expiry Date Is Required." : "مطلوب تاريخ انتهاء الصلاحية.";
            return json_encode($resp); exit;
        }
    }else{
        $resp['responseCode'] = 404;
        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Start Date Is Required." : "تاريخ البدء مطلوب.";
        return json_encode($resp); exit;
    }        
     
    }

    public function edit_gift_card($Id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Gift Card';
            $this->pageData['GiftCardDetails'] = $this->GiftCardModel->find($Id);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            return view('store_admin/gift_card/edit-gift-card',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_gift_card(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            //if(isset($_POST['name']) && !empty($_POST['name'])){            
            if(isset($_POST['start_date']) && !empty($_POST['start_date'])){
                if(isset($_POST['expiry_date']) && !empty($_POST['expiry_date'])){
                $enRqrdFldsAry = array();
                $arRqrdFldsAry = array();
                if($this->ses_lang == 'en'){
                    if(isset($_POST['name']) && !empty($_POST['name'])){
                        $name	= $this->remove_special_char_from_string($this->request->getPost('name'));
                        $enRqrdFldsAry = array(
                            "name" =>isset($name)?$name:''                              
                        ); 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم."; 
                        return json_encode($resp); exit;
                    }
                }else{
                    if(isset($_POST['name_ar']) && !empty($_POST['name_ar'])){
                        $name_ar	= $this->request->getPost('name_ar');
                        $arRqrdFldsAry = array(
                            "name_ar" =>isset($name_ar)?$name_ar:''                              
                        ); 
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Name Is Required." : "مطلوب اسم."; 
                        return json_encode($resp); exit;
                    }

                }
                $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
                $start_date = date('Y-m-d', strtotime($_POST['start_date']));
                $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date']));

                if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){  /* upload giftcards image if set */
                    $path 				= 'uploads/giftcards/';
                    $file 			    = $this->request->getFile('image');
                    $upload_file 	    = $this->uploadFile($path, $file); /* upload giftcards image file */
                    if(isset($upload_file) && !empty($upload_file)){    
                        $reqAry = array(  /* update giftcards data  */
                            'image' => $upload_file,
                            "start_date" => isset($start_date)?$start_date:'',
                            "expiry_date" => isset($expiry_date)?$expiry_date:'',
                            "updated_at" => DATETIME
                        );
                        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                        
                        $affectedRowId = $this->GiftCardModel->update_data($_POST['id'], $finalReqAry);
                        if(is_int($affectedRowId)){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Updated Successfully." : "تم تحديث بطاقة الهدايا بنجاح.";
                            $resp['redirectUrl'] = base_url('admin/edit-gift-card/'.$_POST['id']);
                            return json_encode($resp); exit;
                        }else{
                            $errorMsg =  $this->ses_lang=='en' ? "Error While Gift Card Information Updating." : "خطأ أثناء تحديث معلومات بطاقة الهدايا.";
                           
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Gift Card Image." : "خطأ أثناء تحميل صورة بطاقة الهدايا.";
                        return json_encode($resp); exit;
                    }
                }else{
                    /* update Gift card info in database table name as 'bannerGift cards' */
                    $reqAry = array(
                        "start_date" => isset($start_date)?$start_date:'',
                        "expiry_date" => isset($expiry_date)?$expiry_date:'',
                        "updated_at" => DATETIME
                    );
                    $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);
                    $affectedRowId = $this->GiftCardModel->update_data($_POST['id'], $finalReqAry);
                    if(is_int($affectedRowId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Updated Successfully." : "تم تحديث بطاقة الهدايا بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/edit-gift-card/'.$_POST['id']);
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Gift Card Updated Successfully." : "حدث خطأ أثناء تحديث بطاقة الهدايا بنجاح.";                        
                        return json_encode($resp); exit;
                    }
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Expiry Date  Is Required." : "مطلوب تاريخ انتهاء الصلاحية.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Start Date  Is Required." : "تاريخ البدء مطلوب.";
            return json_encode($resp); exit;
        }
         
    }else{
        $resp['responseCode'] = 404;
        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
        return json_encode($resp); exit;
    }
    }

    public function delete_gift_card(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update gift card status in database table name as 'banners' */
            $affectedRowId = $this->GiftCardModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Deleted Successfully." : "تم حذف بطاقة الهدايا بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all_gift_cards');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Gift Card Deletion." : "خطأ أثناء حذف بطاقة الهدايا.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift card id is required." : "مطلوب معرف بطاقة الهدايا.";
            return json_encode($resp); exit;
        }
    }

    public function activate_gift_card(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update banner status in database table name as 'banners' */
            $affectedRowId = $this->GiftCardModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Activated Successfully." : "تم تفعيل بطاقة الهدايا بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all_gift_cards');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Gift Card Deletion." : "خطأ أثناء حذف بطاقة الهدايا.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Id Is Required." : "رقم بطاقة الهدايا مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_gift_card(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Gift card status in database table name as 'Gift card' */
            $affectedRowId = $this->GiftCardModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Deactivated Successfully." : "تم إلغاء تنشيط بطاقة الهدايا بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all_gift_cards');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Gift Card Deletion." : "خطأ أثناء حذف بطاقة الهدايا.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Gift Card Id Is Required." : "رقم بطاقة الهدايا مطلوب.";
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
}

?>



