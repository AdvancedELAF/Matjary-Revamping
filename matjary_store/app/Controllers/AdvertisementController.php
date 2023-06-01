<?php 

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AdvertisementControllerModel;

class AdvertisementController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        /* Add your code here. */
        $this->is_all_mandotory_modules_filled();
    }

    public function index(){
        $this->pageData['pageTitle'] = 'Dashboard';
        return view('store_admin/dashboard',$this->pageData);
    }

    public function all_advertisements(){ 
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){    
            $this->pageData['pageTitle'] = 'All Advertisements';	
            $this->pageData['adminPageId'] = 5;
            $this->pageData['table'] = $this->Advertisements;
            $this->pageData['advertisementList'] = $this->AdvertisementModel->get_all_data();            
            return view('store_admin/advertisement/all-advertisements',$this->pageData);           
            
        }else{
            return redirect()->to('/admin/login');
        } 
    }

    public function add_advertisement(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Advertisement';
            return view('store_admin/advertisement/add-advertisement',$this->pageData);
            
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_advertisement(){
        if(isset($_POST['advertise_link']) && !empty($_POST['advertise_link'])){
            if(isset($_POST['add_position']) && !empty($_POST['add_position'])){
                $enRqrdFldsAry = array();
                $arRqrdFldsAry = array();
                if($this->ses_lang == 'en'){   
                    if(isset($_POST['title']) && !empty($_POST['title'])){
                        if(isset($_POST['sub_title']) && !empty($_POST['sub_title'])){  
                            $title	= $_POST['title'];
                            $sub_title	= isset($_POST['sub_title'])?$_POST['sub_title']:'';
                            $enRqrdFldsAry = array(
                                "title" =>isset($title)?$title:'',
                                "sub_title" =>isset($sub_title)?$sub_title:''                               
                            );                          
                            }else{
                            $resp['responseCode'] = 404;
                                $resp['responseMessage'] = 'Sub Title Is Required.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] = 'Title Is Required.';
                            return json_encode($resp); exit;
                        }
                }else{
                    if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                        if(isset($_POST['sub_title_ar']) && !empty($_POST['sub_title_ar'])){  
                            $title_ar	= $_POST['title_ar'];
                            $sub_title_ar	= isset($_POST['sub_title_ar'])?$_POST['sub_title_ar']:'';
                            $arRqrdFldsAry = array(
                                "title_ar" =>isset($title_ar)?$title_ar:'',
                                "sub_title_ar" =>isset($sub_title_ar)?$sub_title_ar:''                               
                            );                          
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] = 'العنوان الفرعي مطلوب.';
                            return json_encode($resp); exit;
                            }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = 'العنوان مطلوب.';
                        return json_encode($resp); exit;
                    }

                }    
                $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry); 
                $advertise_link	= $this->request->getPost('advertise_link'); 
                $add_position	= $this->request->getPost('add_position');            
                if(isset($_FILES['add_img']['name']) && !empty($_FILES['add_img']['name'])){
                    $path 				= 'uploads/advertisement/';
                    $file 			    = $this->request->getFile('add_img');
                    $upload_file 	    = $this->uploadFile($path, $file); /* upload advertisement image file */
                    if(isset($upload_file) && !empty($upload_file)){
                        /* save advertisement data  */
                        $reqAry = array(                                   
                            'add_img' => $upload_file,
                            'advertise_link' => $advertise_link,
                            'add_position' => $add_position,
                            "is_active" => 1,
                            "created_at" => DATETIME
                        );
                        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry); 
                        $insertedId = $this->AdvertisementModel->insert_data($finalReqAry); 
                        if(is_int($insertedId)){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Added Successfully." : "تمت إضافة الإعلان بنجاح.";                                    
                            $resp['redirectUrl'] = base_url('admin/all-advertisements');
                            return json_encode($resp); exit;
                        }else{
                            $errorMsg =  $this->ses_lang=='en' ? "Error While Advertisement Insertion." :"خطأ أثناء إدراج الإعلان.";
                            if(file_exists('uploads/advertisement/'.$upload_file)){
                                unlink("store/".$this->storeActvTmplName."/uploads/advertisement/".$upload_file);
                            }else{
                                $errorMsg .=  $this->ses_lang=='en' ? " and advertisement image is not exist so can not deleted from folder" :"وصورة الإعلان غير موجودة فلا يمكن حذفها من المجلد";
                            }
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Advertisement Image." : "خطأ أثناء تحميل صورة الإعلان."; 
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Image Is Required." : "مطلوب صورة إعلان."; 
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Position Is Required." : "الوظيفة مطلوبة."; 
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Link Is Required." : "رابط الإعلان مطلوب."; 
            return json_encode($resp); exit;
        }
       
    }

    public function edit_advertisement($Id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Advertisement';
            $this->pageData['advertisementDetails'] = $this->AdvertisementModel->find($Id);        
            return view('store_admin/advertisement/edit-advertisement',$this->pageData);
           
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_advertisement(){
        if(isset($_POST['id']) && !empty($_POST['id'])){           
                if(isset($_POST['advertise_link']) && !empty($_POST['advertise_link'])){
                    if(isset($_POST['add_position']) && !empty($_POST['add_position'])){
                        $enRqrdFldsAry = array();
                        $arRqrdFldsAry = array();
                        if($this->ses_lang == 'en'){   
                            if(isset($_POST['title']) && !empty($_POST['title'])){
                                if(isset($_POST['sub_title']) && !empty($_POST['sub_title'])){  
                                    $title	= $_POST['title'];
                                    $sub_title	= isset($_POST['sub_title'])?$_POST['sub_title']:'';
                                    $enRqrdFldsAry = array(
                                        "title" =>isset($title)?$title:'',
                                        "sub_title" =>isset($sub_title)?$sub_title:''                               
                                    );                          
                                    }else{
                                    $resp['responseCode'] = 404;
                                        $resp['responseMessage'] = 'Sub Title Is Required.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = 'Title Is Required.';
                                    return json_encode($resp); exit;
                                }
                        }else{
                            if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                                if(isset($_POST['sub_title_ar']) && !empty($_POST['sub_title_ar'])){  
                                    $title_ar	= $_POST['title_ar'];
                                    $sub_title_ar	= isset($_POST['sub_title_ar'])?$_POST['sub_title_ar']:'';
                                    $arRqrdFldsAry = array(
                                        "title_ar" =>isset($title_ar)?$title_ar:'',
                                        "sub_title_ar" =>isset($sub_title_ar)?$sub_title_ar:''                               
                                    );                          
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = 'العنوان الفرعي مطلوب.';
                                    return json_encode($resp); exit;
                                    }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] = 'العنوان مطلوب.';
                                return json_encode($resp); exit;
                            }
                        }    
                    $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry); 
                    $advertise_link	= $this->request->getPost('advertise_link');
                    $add_position	= $this->request->getPost('add_position');                      
                    if(isset($_FILES['add_img']['name']) && !empty($_FILES['add_img']['name'])){  /* upload advertisement image if set */
                        $path 				= 'uploads/advertisement/';
                        $file 			    = $this->request->getFile('add_img');
                        $upload_file 	    = $this->uploadFile($path, $file); /* upload advertisement image file */

                        if(isset($upload_file) && !empty($upload_file)){     
                            $reqAry = array(                                    
                                'add_img' => $upload_file,
                                'advertise_link' => $advertise_link,
                                'add_position' => $add_position,
                                "updated_at" => DATETIME
                            );
                            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                        
                            $affectedRowId = $this->AdvertisementModel->update_data($_POST['id'], $finalReqAry);
                            if(is_int($affectedRowId)){
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Updated Successfully." : "تم تحديث الإعلان بنجاح."; 
                                $resp['redirectUrl'] = base_url('admin/edit-advertisement/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error while Advertisement Information Updating." : "خطأ أثناء تحديث معلومات الإعلان."; 
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While UploadingAdvertisement Image." : "خطأ أثناء تحميل صورة الإعلان."; 
                            return json_encode($resp); exit;
                        }
                    }else{
                            /* update advertisement info in database table name as 'advertisements' */
                            $reqAry = array(                                   
                                "advertise_link" => $advertise_link,
                                'add_position' => $add_position,
                                "updated_at" => DATETIME
                            );
                            $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);   

                            $affectedRowId = $this->AdvertisementModel->update_data($_POST['id'], $finalReqAry);
                            if(is_int($affectedRowId)){
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Updated Successfully." : "تم تحديث الإعلان بنجاح."; 
                                $resp['redirectUrl'] = base_url('admin/all-advertisements');
                                return json_encode($resp); exit;
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Advertisement updated Successfully." : "خطأ أثناء تحديث الإعلان بنجاح."; 
                                return json_encode($resp); exit;
                            }
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Position Is Required." : "الوظيفة مطلوبة."; 
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Link Is Required." : "رابط الإعلان مطلوب."; 
                return json_encode($resp); exit;
            }           
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function delete_advertisement(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Advertisement status in database table name as 'Advertisement' */
            $affectedRowId = $this->AdvertisementModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Deleted Successfully." : "تم حذف الإعلان بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-advertisements');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Advertisement Deletion." : "خطأ أثناء حذف الإعلان.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function activate_advertisement(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Advertisement status in database table name as 'Advertisement' */
            $affectedRowId = $this->AdvertisementModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Activated Successfully." : "تم تفعيل الإعلان بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-advertisements');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Advertisement Deletion." : "خطأ أثناء حذف الإعلان.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function deactivate_advertisement(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update Advertisement status in database table Advertisement as 'Advertisement' */
            $affectedRowId = $this->AdvertisementModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Advertisement Deactivated Successfully." : "تم إلغاء تنشيط الإعلان بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Advertisement Deletion." : "خطأ أثناء حذف الإعلان.";
                return json_encode($resp); exit;
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
            return $image->getName();
		}
		return "";
	}
}

?>



