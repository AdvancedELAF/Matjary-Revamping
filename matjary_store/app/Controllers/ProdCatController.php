<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class ProdCatController extends BaseController
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

    public function all_product_categories(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Product Categories';
            $this->pageData['adminPageId'] = 8;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['productCategoryList'] = $this->ProdCatModel->get_all_active_category_data();
            return view('store_admin/product_category/all-product-categories',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function add_product_category(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Add Product Category';
            $this->pageData['allProductCategoryList'] = $this->ProdCatModel->get_all_data();
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_category/add-product-category',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_product_category(){
        $ary1 = array();
        $ary2 = array();
        if($this->ses_lang=='en'){
            if(isset($_POST['category_name']) && !empty($_POST['category_name'])){
                $category_name	= $this->remove_special_char_from_string($_POST['category_name']);
                $ary1 = array(
                    "category_name"=>$category_name,
                    "category_desc"=>isset($_POST['category_desc'])?$_POST['category_desc']:''
                );
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Name Is Required.." : "اسم فئة المنتج مطلوب ..";
                return json_encode($resp); exit;
            }
        }else{
            if(isset($_POST['category_name_ar']) && !empty($_POST['category_name_ar'])){
                $category_name_ar	= $_POST['category_name_ar'];
                $ary2 = array(
                    "category_name_ar"=>$category_name_ar,
                    "category_desc_ar"=>isset($_POST['category_desc_ar'])?$_POST['category_desc_ar']:''
                );
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Name Is Required.." : "اسم فئة المنتج مطلوب ..";
                return json_encode($resp); exit;
            }
        }

        $ary3 = array_merge($ary1,$ary2);

        if(isset($_FILES['category_img']['name']) && !empty($_FILES['category_img']['name'])){
            if($this->ses_lang=='en'){
                $nameExist = $this->ProdCatModel->check_category_name_exist($_POST['category_name']); /* check category name already exist or not */
            }else{
                $nameExist = $this->ProdCatModel->check_category_name_ar_exist($_POST['category_name_ar']); /* check category name already exist or not */
            }
            
            if($nameExist==true){
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product category name is already exist." : "اسم فئة المنتج موجود بالفعل.";
                return json_encode($resp); exit;
            }else{
                $parent_cat_id	= $this->request->getPost('parent_cat_id');
               
                $path 				= 'uploads/product_category/';
                $file 			    = $this->request->getFile('category_img');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload brand image file */
                if(isset($upload_file) && !empty($upload_file)){
                    $ary4 = array(
                        "parent_cat_id" => isset($parent_cat_id)?$parent_cat_id:'0',
                        'category_img' => $upload_file,
                        "is_active" => 1,
                        "created_at" => DATETIME
                    );
                    $insAry = array_merge($ary3,$ary4);
                    /* save category data  */
                    $insertedId = $this->ProdCatModel->insert_data($insAry); 
                    if(is_int($insertedId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Inserted Successfully." : "تم إدراج فئة المنتج بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/all-product-categories');
                        return json_encode($resp); exit;
                    }else{
                        $errorMsg = 'Error While Category Insertion.';
                        if(file_exists('uploads/product_category/'.$upload_file)){
                            unlink("uploads/product_category/".$upload_file);
                        }else{
                            $errorMsg .=  $this->ses_lang=='en' ? " and category image is not exist so can not deleted from folder" : "وصورة الفئة غير موجودة لذا لا يمكن حذفها من المجلد";
                        }
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Category Image." : "خطأ أثناء تحميل صورة الفئة.";
                    return json_encode($resp); exit;
                }
            }
        }else{
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Image Is Required." : "مطلوب صورة فئة المنتج.";
            return json_encode($resp); exit;
        }
    }

    public function edit_product_category($prodCatId=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Product Category';
            $this->pageData['allProductCategoryList'] = $this->ProdCatModel->get_all_data();
            $this->pageData['prodCatDetails'] = $this->ProdCatModel->find($prodCatId);
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            return view('store_admin/product_category/edit-product-category',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_product_category(){
        if(isset($_POST['cat_id']) && !empty($_POST['cat_id'])){
            
            $parent_cat_id	= $this->request->getPost('parent_cat_id');
            $ary1 = array();
            $ary2 = array();
            if($this->ses_lang=='en'){
                if(isset($_POST['category_name']) && !empty($_POST['category_name'])){
                    $category_name	= $this->remove_special_char_from_string($_POST['category_name']);
                    $ary1 = array(
                        "category_name"=>$category_name,
                        "category_desc"=>isset($_POST['category_desc'])?$_POST['category_desc']:''
                    );
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Name Is Required.." : "اسم فئة المنتج مطلوب ..";
                    return json_encode($resp); exit;
                }
            }else{
                if(isset($_POST['category_name_ar']) && !empty($_POST['category_name_ar'])){
                    $category_name_ar	= $_POST['category_name_ar'];
                    $ary2 = array(
                        "category_name_ar"=>$category_name_ar,
                        "category_desc_ar"=>isset($_POST['category_desc_ar'])?$_POST['category_desc_ar']:''
                    );
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Name Is Required.." : "اسم فئة المنتج مطلوب ..";
                    return json_encode($resp); exit;
                }
            }
            
            $ary3 = array_merge($ary1,$ary2);
            /* upload category image if set */
            if(isset($_FILES['category_img']['name']) && !empty($_FILES['category_img']['name'])){
                $path 				= 'uploads/product_category/';
                $file 			    = $this->request->getFile('category_img');
                $upload_file 	    = $this->uploadFile($path, $file); /* upload brand image file */
                if(isset($upload_file) && !empty($upload_file)){
                    $ary4 = array(
                        "parent_cat_id" => isset($parent_cat_id)?$parent_cat_id:'0',
                        'category_img' => $upload_file,
                        "updated_at" => DATETIME
                    );
                    $uptAry = array_merge($ary3,$ary4);
                    /* update category data  */
                    $affectedRowId = $this->ProdCatModel->update_data($_POST['cat_id'], $uptAry);
                    if(is_int($affectedRowId)){
                        $resp['responseCode'] = 200;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Updated Successfully." : "تم تحديث فئة المنتج بنجاح.";
                        $resp['redirectUrl'] = base_url('admin/edit-product-category/'.$_POST['cat_id']);
                        return json_encode($resp); exit;
                    }else{
                        $errorMsg =  $this->ses_lang=='en' ? "Error while Category Information Updating." : "خطأ أثناء تحديث معلومات الفئة.";
                        $resp['responseCode'] = 500;
                        $resp['responseMessage'] = $errorMsg;
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 500;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Category Image." : "خطأ أثناء تحميل صورة الفئة.";
                    return json_encode($resp); exit;
                }
            }else{
                /* update category info in database table name as 'productcategories' */
                $ary4 = array(
                    "parent_cat_id" => isset($parent_cat_id)?$parent_cat_id:'0',
                    "updated_at" => DATETIME
                );
                $uptAry = array_merge($ary3,$ary4);
                $affectedRowId = $this->ProdCatModel->update_data($_POST['cat_id'], $uptAry);
                if(is_int($affectedRowId)){
                    $resp['responseCode'] = 200;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Updated Successfully." : "تم تحديث فئة المنتج بنجاح.";
                    $resp['redirectUrl'] = base_url('admin/all-product-categories');
                    return json_encode($resp); exit;
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Category Updated Successfully." : "خطأ أثناء تحديث الفئة بنجاح.";
                    return json_encode($resp); exit;
                }
            }
            
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Id Is Required.." : "مطلوب معرف فئة المنتج ..";
            return json_encode($resp); exit;
        }
    }

    public function delete_product_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update category status in database table name as 'productcategories' */
            $affectedRowId = $this->ProdCatModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Deleted Successfully." : "تم حذف فئة المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-categories');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Category Deletion." : "خطأ أثناء حذف الفئة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Id Is Required.." : "مطلوب معرف فئة المنتج ..";
            return json_encode($resp); exit;
        }
    }

    public function activate_product_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update category status in database table name as 'productcategories' */
            $affectedRowId = $this->ProdCatModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Activated Successfully." : "تم تفعيل فئة المنتج بنجاح.";
                $resp['redirectUrl'] = base_url('admin/all-product-categories');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Category Deletion." : "خطأ أثناء حذف الفئة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Id Is Required.." : "مطلوب معرف فئة المنتج ..";
            return json_encode($resp); exit;
        }
    }

    public function deactivate_product_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update category status in database table name as 'productcategories' */
            $affectedRowId = $this->ProdCatModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Deactivated Successfully." : "تم إلغاء تنشيط فئة المنتج بنجاح.";
                
                $resp['redirectUrl'] = base_url('admin/all-product-categories');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Category Deletion.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Id Is Required.." : "مطلوب معرف فئة المنتج ..";
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



