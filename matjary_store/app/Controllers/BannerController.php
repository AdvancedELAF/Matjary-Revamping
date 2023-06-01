<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\BannerModel;

class BannerController extends BaseController
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

    public function all_banners(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Banners';
            $this->pageData['adminageId'] = 1;
            $this->pageData['table'] = $this->Banners;
            $this->pageData['bannerList'] = $this->BannerModel->get_all_data();
            return view('store_admin/banner/all-banners',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_banner(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Banner';
            return view('store_admin/banner/add-banner',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_banner(){      
        $enRqrdFldsAry = array();
        $arRqrdFldsAry = array();
        if($this->ses_lang == 'en'){   
            if(isset($_POST['title']) && !empty($_POST['title'])){
                if(isset($_POST['sub_title']) && !empty($_POST['sub_title'])){  
                    $title	= $this->remove_special_char_from_string($_POST['title']);
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
        $banner_url	= $this->request->getPost('banner_url');             
        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
            $path 				= 'uploads/banners/';
            $file 			    = $this->request->getFile('image');
            $upload_file 	    = $this->uploadFile($path, $file); /* upload banner image file */
            if(isset($upload_file) && !empty($upload_file)){
                /* save banner data  */                        
                $reqAry = array(                               
                    'image' => $upload_file,
                    'banner_url' => isset($banner_url)?$banner_url:'',
                    "is_active" => 1,
                    "created_at" => DATETIME
                );
                $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);      
                $insertedId = $this->BannerModel->insert_data($finalReqAry); 
                if(is_int($insertedId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Added Successfully." : "تمت إضافة البانر بنجاح."; 
                    $resp['redirectUrl'] = base_url('admin/all-banners');
                    return json_encode($resp); exit;
                }else{                    
                    $errorMsg =  $this->ses_lang=='en' ? "Error While Banner Insertion." : "خطأ أثناء إدراج الشعار.";
                    if(file_exists('uploads/banners/'.$upload_file)){
                        unlink("store/".$this->storeActvTmplName."/uploads/banners/".$upload_file);
                    }else{                       
                        $errorMsg .=  $this->ses_lang=='en' ? " and banner image is not exist so can not deleted from folder" : "وصورة الشعار غير موجودة لذا لا يمكن حذفها من المجلد";
                    }
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 500;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Banner Image." : "خطأ أثناء تحميل صورة الشعار."; 
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;   
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Image Is Required." : "صورة البانر مطلوبة.";
            return json_encode($resp); exit;
        }
    }

    public function edit_banner($Id=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Banner';
            $this->pageData['bannerDetails'] = $this->BannerModel->find($Id);
            return view('store_admin/banner/edit-banner',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_banner(){
        if(isset($_POST['banner_id']) && !empty($_POST['banner_id'])){        
            $enRqrdFldsAry = array();
            $arRqrdFldsAry = array();
            if($this->ses_lang == 'en'){   
                if(isset($_POST['title']) && !empty($_POST['title'])){
                    if(isset($_POST['sub_title']) && !empty($_POST['sub_title'])){  
                        $title	= $this->remove_special_char_from_string($_POST['title']);
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
            $banner_url	= $this->request->getPost('banner_url');                    
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){  /* upload banner image if set */
                $path 				= 'uploads/banners/';
                $file 			    = $this->request->getFile('image');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload banner image file */
                if(isset($upload_file) && !empty($upload_file)){   
                    $reqAry = array(  /* update banner data  */
                        'image' => $upload_file,
                        'banner_url' => isset($banner_url)?$banner_url:'',
                        "updated_at" => DATETIME
                    );
                    $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                       
                    $affectedRowId = $this->BannerModel->update_data($_POST['banner_id'],$finalReqAry);
                    if(is_int($affectedRowId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Updated Successfully." : "تم تحديث البانر بنجاح."; 
                        $resp['redirectUrl'] = base_url('admin/edit-banner/'.$_POST['banner_id']);
                        return json_encode($resp); exit;
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error While Brand Information Updating." : "خطأ أثناء تحديث معلومات العلامة التجارية.";
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Banner image." : "خطأ أثناء تحميل صورة الشعار.";
                    return json_encode($resp); exit;
                }
            }else{
                /* update banner info in database table name as 'banners' */            
                $reqAry = array(  /* update banner data  */
                    'banner_url' => isset($banner_url)?$banner_url:'',
                    "updated_at" => DATETIME
                );
                $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);                       
                $affectedRowId = $this->BannerModel->update_data($_POST['banner_id'],$finalReqAry);

                if(is_int($affectedRowId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Updated Successfully." : "تم تحديث البانر بنجاح.";
                   
                    $resp['redirectUrl'] = base_url('admin/all-banners');
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Banner Updated Successfully." : "خطأ أثناء تحديث الشعار بنجاح.";
                    return json_encode($resp); exit;
                }
            } 
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Id Is Required." : "معرف الشعار مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function delete_banner(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update banner status in database table name as 'banners' */
            $affectedRowId = $this->BannerModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Deleted Successfully." : "تم حذف البانر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-banners');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Banner Deletion." :"خطأ أثناء حذف الشعار.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Id Is Required." : "معرف الشعار مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function activate_banner(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update banner status in database table name as 'banners' */
            $affectedRowId = $this->BannerModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;                
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Activated Successfully." : "تم تفعيل البانر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while Banner Deletion." : "خطأ أثناء حذف الشعار.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Id Is Required." : "معرف الشعار مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_banner(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update banner status in database table name as 'banners' */
            $affectedRowId = $this->BannerModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Deactivated Successfully." :"تم إلغاء تنشيط البانر بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Banner Deletion." :"خطأ أثناء حذف الشعار.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Banner Id Is Required." : "معرف الشعار مطلوب.";
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



