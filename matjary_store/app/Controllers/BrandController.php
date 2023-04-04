<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BrandController extends BaseController
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

    public function all_product_brands(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Product Brands';
            $this->pageData['adminPageId'] = 9;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
          
            // Get all rows
            $this->pageData['productBrandList'] = $this->BrandModel->get_all_data();
            return view('store_admin/product_brand/all-product-brands',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_product_brand(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Product Brand';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            return view('store_admin/product_brand/add-product-brand',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_product_brand(){
        if(isset($_POST['brand_name']) && !empty($_POST['brand_name'])){
            $brand_name	= $this->remove_special_char_from_string($this->request->getPost('brand_name'));
            $nameExist = $this->BrandModel->check_brand_name_exist($brand_name); /* check brand name already exist or not */
            if($nameExist==true){
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Name Is Already Exist." : "اسم العلامة التجارية للمنتج موجود بالفعل.";
                return json_encode($resp); exit;
            }else{
                if(isset($_FILES['brand_image']['name']) && !empty($_FILES['brand_image']['name'])){
                    $path 				= 'uploads/product_brands/';
                    $file 			    = $this->request->getFile('brand_image');
                    $upload_file 	    = $this->uploadFile($path, $file); /* upload brand image file */
                    if(isset($upload_file) && !empty($upload_file)){
                        /* save brand data  */
                        $insertedId = $this->BrandModel->insert_data(array(
                            "brand_name" => isset($brand_name)?$brand_name:'',
                            'brand_image' => $upload_file,
                            "is_active" => 1,
                            "created_at" => DATETIME
                        )); 
                        if(is_int($insertedId)){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Inserted Successfully." : "تم إدراج علامة المنتج التجارية بنجاح."; 
                            $resp['redirectUrl'] = base_url('admin/all-product-brands');
                            return json_encode($resp); exit;
                        }else{
                            $errorMsg = 'Error While Brand Insertion.';
                            if(file_exists('uploads/product_brands/'.$upload_file)){
                                unlink("store/".$this->storeActvTmplName."/uploads/product_brands/".$upload_file);
                            }else{
                                $errorMsg .= ' and brand image is not exist so can not deleted from folder';
                            }
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Brand Image." : "خطأ أثناء تحميل صورة العلامة التجارية."; 
                        
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Image Is Required." : "مطلوب صورة العلامة التجارية للمنتج.";
                    return json_encode($resp); exit;
                }
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Name Is Required." : "اسم العلامة التجارية للمنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function edit_product_brand($prodBrandId=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Product Brand';
            $this->pageData['prodBrandDetails'] = $this->BrandModel->find($prodBrandId);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();   
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();      
            return view('store_admin/product_brand/edit-product-brand',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_product_brand(){
        if(isset($_POST['brand_id']) && !empty($_POST['brand_id'])){
            if(isset($_POST['brand_name']) && !empty($_POST['brand_name'])){
                $brand_name	= $this->remove_special_char_from_string($this->request->getPost('brand_name'));
                /* upload brand image if set */
                if(isset($_FILES['brand_image']['name']) && !empty($_FILES['brand_image']['name'])){
                    $path 				= 'uploads/product_brands/';
                    $file 			    = $this->request->getFile('brand_image');
                    $upload_file 	    = $this->uploadFile($path, $file); /* upload brand image file */
                    if(isset($upload_file) && !empty($upload_file)){
                        /* update brand data  */
                        $affectedRowId = $this->BrandModel->update_data($_POST['brand_id'], array(
                            "brand_name" => isset($brand_name)?$brand_name:'',
                            'brand_image' => $upload_file,
                            "updated_at" => DATETIME
                        ));
                        if(is_int($affectedRowId)){
                            $resp['responseCode'] = 200;
                            $resp['responseMessage'] = $this->ses_lang=='en' ? "Product Brand Updated Successfully." : "تم تحديث العلامة التجارية للمنتج بنجاح.";
                            $resp['redirectUrl'] = base_url('admin/edit-product-brand/'.$_POST['brand_id']);
                            return json_encode($resp); exit;
                        }else{
                            $errorMsg = $this->ses_lang=='en' ? "Error While Brand Information Updating." : "خطأ أثناء تحديث معلومات العلامة التجارية.";
                            $resp['responseCode'] = 500;
                            $resp['responseMessage'] = $errorMsg;
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $this->ses_lang=='en' ? "Error While Uploading Brand Image." : "خطأ أثناء تحميل صورة العلامة التجارية.";
                        return json_encode($resp); exit;
                    }
                }else{
                    /* update brand info in database table name as 'brands' */
                    $affectedRowId = $this->BrandModel->update_data($_POST['brand_id'], array(
                        "brand_name" => isset($brand_name)?$brand_name:'',
                        "updated_at" => DATETIME
                    ));
                    if(is_int($affectedRowId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] = $this->ses_lang=='en' ? "Product Brand Updated Successfully." : "تم تحديث العلامة التجارية للمنتج بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/all-product-brands');
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = $this->ses_lang=='en' ? "Error While Brand Updated Successfully." : "خطأ أثناء تحديث العلامة التجارية بنجاح.";                       
                        return json_encode($resp); exit;
                    }
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Name Is Required." : "اسم العلامة التجارية للمنتج مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Id Is Required." : "مطلوب معرف العلامة التجارية للمنتج.";
            return json_encode($resp); exit;
        }
    }

    public function delete_product_brand(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->BrandModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Deleted Successfully." : "تم حذف العلامة التجارية للمنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Brand Deletion." : "خطأ أثناء حذف العلامة التجارية.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Id Is Required." : "مطلوب معرف العلامة التجارية للمنتج.";
            return json_encode($resp); exit;
        }
    }

    public function activate_product_brand(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->BrandModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Activated Successfully." : "تم تفعيل العلامة التجارية للمنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Brand Deletion." : "خطأ أثناء حذف العلامة التجارية.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Id Is Required." : "مطلوب معرف العلامة التجارية للمنتج.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_product_brand(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update brand status in database table name as 'brands' */
            $affectedRowId = $this->BrandModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Deactivated Successfully." : "تم إلغاء تنشيط العلامة التجارية للمنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Brand Deletion." : "خطأ أثناء حذف العلامة التجارية.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Brand Id Is Required." : "مطلوب معرف العلامة التجارية للمنتج.";
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



