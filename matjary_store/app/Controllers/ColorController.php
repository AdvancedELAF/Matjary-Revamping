<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class ColorController extends BaseController
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

    public function all_product_colors(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Product Colors';
            $this->pageData['adminPageId'] = 10;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            // Get all rows
            $this->pageData['productColorList'] = $this->ColorModel->get_all_data();
            return view('store_admin/product_color/all-product-colors',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_product_color(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Product Color';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_color/add-product-color',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_product_color(){
        if(isset($_POST['color_name']) && !empty($_POST['color_name'])){
            $color_name	= $this->remove_special_char_from_string($this->request->getPost('color_name'));
            $nameExist = $this->ColorModel->check_color_name_exist($color_name); /* check color name already exist or not */
            if($nameExist==true){
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Name Is Already Exist." : "اسم لون المنتج موجود بالفعل.";
                return json_encode($resp); exit;
            }else{
                /* save brand data  */
                $insertedId = $this->ColorModel->insert_data(array(
                    "color_name" => isset($color_name)?$color_name:'',
                    "is_active" => 1,
                    "created_at" => DATETIME
                )); 
                if(is_int($insertedId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Added Successfully." : "تم إدراج لون المنتج بنجاح.";
                    $resp['redirectUrl'] = base_url('admin/all-product-colors');
                    return json_encode($resp); exit;
                }else{                    
                    $errorMsg =  $this->ses_lang=='en' ? "Error While Color Deletion." : "خطأ أثناء حذف اللون.";
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Name Is Required." : "اسم لون المنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function edit_product_color($prodColorId=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Product Color';
            $this->pageData['prodColorDetails'] = $this->ColorModel->find($prodColorId);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_color/edit-product-color',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_product_color(){
        if(isset($_POST['color_id']) && !empty($_POST['color_id'])){
            if(isset($_POST['color_name']) && !empty($_POST['color_name'])){
                $color_name	= $this->remove_special_char_from_string($this->request->getPost('color_name'));
                /* update color info in database table name as 'colors' */
                $affectedRowId = $this->ColorModel->update_data($_POST['color_id'], array(
                    "color_name" => isset($color_name)?$color_name:'',
                    "updated_at" => DATETIME
                ));
                if(is_int($affectedRowId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Updated Successfully." : "تم تحديث لون المنتج بنجاح."; 
                    $resp['redirectUrl'] = base_url('admin/all-product-colors');
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Color Updated Successfully." : "خطأ أثناء تحديث اللون بنجاح.";                 
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Name Is Required." : "اسم لون المنتج مطلوب."; 
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Id Is Required." : "معرف لون المنتج مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function delete_product_color(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update color status in database table name as 'colors' */
            $affectedRowId = $this->ColorModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Deleted Successfully." : "تم حذف لون المنتج بنجاح."; 
                $resp['redirectUrl'] = base_url('admin/all-product-brands');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Color Deletion." : "تم حذف لون المنتج بنجاح."; 
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Id Is Required." : "معرف لون المنتج مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function activate_product_color(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update color status in database table name as 'colors' */
            $affectedRowId = $this->ColorModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Activated Successfully." : "تم تنشيط لون المنتج بنجاح."; 
                $resp['redirectUrl'] = base_url('admin/all-product-colors');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $errorMsg =  $this->ses_lang=='en' ? "Error While Color Deletion." : "خطأ أثناء حذف اللون.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Id Is Required." : "معرف لون المنتج مطلوب."; 
            return json_encode($resp); exit;
        }
    }

    public function deactivate_product_color(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update color status in database table name as 'colors' */
            $affectedRowId = $this->ColorModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Deactivated Successfully." : "تم إلغاء تنشيط لون المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-colors');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $errorMsg =  $this->ses_lang=='en' ? "Error While Color Deletion." : "خطأ أثناء حذف اللون.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Color Id Is Required." : "معرف لون المنتج مطلوب."; 
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



