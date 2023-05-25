<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class SizeController extends BaseController
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

    public function all_product_sizes(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Product Sizes';
            $this->pageData['adminPageId'] = 11;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['productSizeList'] = $this->SizeModel->get_all_data();    
            return view('store_admin/product_size/all-product-sizes',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_product_size(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Product Size';
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_size/add-product-size',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_product_size(){
        if(isset($_POST['size']) && !empty($_POST['size'])){
            $size	= $this->remove_special_char_from_string($this->request->getPost('size'));
            $nameExist = $this->SizeModel->check_size_name_exist($size); /* check size name already exist or not */
            if($nameExist==true){
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Name Is Already Exist." : "اسم حجم المنتج موجود بالفعل.";               
                return json_encode($resp); exit;
            }else{
                /* save brand data  */
                $insertedId = $this->SizeModel->insert_data(array(
                    "size" => isset($size)?$size:'',
                    "is_active" => 1,
                    "created_at" => DATETIME
                )); 
                if(is_int($insertedId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Added Successfully." : "تم إدراج حجم المنتج بنجاح.";
                    $resp['redirectUrl'] = base_url('admin/all-product-sizes');
                    return json_encode($resp); exit;
                }else{
                    $errorMsg =  $this->ses_lang=='en' ? "Error While Size Insertion." : "خطأ أثناء إدخال الحجم.";
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] = $errorMsg;
                    return json_encode($resp); exit;
                }
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Name Is Required." : "اسم حجم المنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function edit_product_size($prodSizeId=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Product Color';
            $this->pageData['prodSizeDetails'] = $this->SizeModel->find($prodSizeId);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_size/edit-product-size',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_product_size(){
        if(isset($_POST['size_id']) && !empty($_POST['size_id'])){
            if(isset($_POST['size']) && !empty($_POST['size'])){
                $size = $this->remove_special_char_from_string($this->request->getPost('size'));
                /* update size info in database table name as 'sizes' */
                $affectedRowId = $this->SizeModel->update_data($_POST['size_id'], array(
                    "size" => isset($size)?$size:'',
                    "updated_at" => DATETIME
                ));
                if(is_int($affectedRowId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] = 'Product Size Updated Successfully.';
                    $resp['redirectUrl'] = base_url('admin/all-product-sizes');
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = 'Error While Size Updated Successfully.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Name Is Required." : "اسم حجم المنتج مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Id Is Required." : "معرف حجم المنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function delete_product_size(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update size status in database table name as 'sizes' */
            $affectedRowId = $this->SizeModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Deleted Successfully." : "تم حذف حجم المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-sizes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Size Deletion." : "خطأ أثناء حذف الحجم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Id Is Required." : "معرف حجم المنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function activate_product_size(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update size status in database table name as 'sizes' */
            $affectedRowId = $this->SizeModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Activated Successfully." : "تم تفعيل حجم المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-sizes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error while size deletion." : "خطأ أثناء حذف الحجم.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Id Is Required." : "معرف حجم المنتج مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_product_size(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update size status in database table name as 'sizes' */
            $affectedRowId = $this->SizeModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Size Deactivated Successfully." : "تم إلغاء تنشيط حجم المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-sizes');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While sizes deletion." : "خطأ أثناء حذف الأحجام.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Sizes Id Is Required." : "معرف أحجام المنتج مطلوب.";
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



