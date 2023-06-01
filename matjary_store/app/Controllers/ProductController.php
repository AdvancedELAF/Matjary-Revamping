<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\ColorModel;
use App\Models\SizeModel;
use App\Models\ProdCatModel;

class ProductController extends BaseController
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

    public function add_product(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){            
            $this->pageData['pageTitle'] = 'Add Product';
            $this->pageData['productCategories'] = $this->ProdCatModel->get_all_active_category_data();
            $this->pageData['productBrands'] = $this->BrandModel->get_all_active_data();
            $this->pageData['productColors'] = $this->ColorModel->get_all_active_data();
            $this->pageData['productSizes'] = $this->SizeModel->get_all_active_data();
            return view('store_admin/product/add-product',$this->pageData); 
            
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function save_product(){
        $result = true;        
        $enRqrdFldsAry = array();
        $arRqrdFldsAry = array();
        if($this->ses_lang=='en'){
            if(isset($_POST['title']) && !empty($_POST['title'])){
                if(isset($_POST['keywords']) && !empty($_POST['keywords'])){
                    if(isset($_POST['tags']) && !empty($_POST['tags'])){
                        $title	= $this->remove_special_char_from_string($_POST['title']);
                        $short_desc	= isset($_POST['short_desc'])?$_POST['short_desc']:'';
                        $long_desc	= isset($_POST['long_desc'])?$_POST['long_desc']:'';
                        $keywords	= $this->remove_special_char_from_keyword_tags($_POST['keywords']);
                        $tags	= $this->remove_special_char_from_keyword_tags($_POST['tags']);
                        $enRqrdFldsAry = array(
                            "title" =>isset($title)?$title:'',
                            "short_desc" =>isset($short_desc)?$short_desc:'',
                            "long_desc" =>isset($long_desc)?$long_desc:'',
                            "keywords" =>isset($keywords)?$keywords:'',
                            "tags" =>isset($tags)?$tags:''
                        );
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Tags Are Required." : "علامات المنتج مطلوبة.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Keywords Are Required." : "الكلمات الرئيسية للمنتج مطلوبة.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Title Is Required.';
                return json_encode($resp); exit;
            }
        }else{
            if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                if(isset($_POST['keywords_ar']) && !empty($_POST['keywords_ar'])){
                    if(isset($_POST['tags_ar']) && !empty($_POST['tags_ar'])){
                        $title_ar	= $_POST['title_ar'];
                        $short_desc_ar	= isset($_POST['short_desc_ar'])?$_POST['short_desc_ar']:'';
                        $long_desc_ar	= isset($_POST['long_desc_ar'])?$_POST['long_desc_ar']:'';
                        $keywords_ar	= isset($_POST['keywords_ar'])?$_POST['keywords_ar']:'';
                        $tags_ar	= isset($_POST['tags_ar'])?$_POST['tags_ar']:'';
                        $arRqrdFldsAry = array(
                            "title_ar" =>isset($title_ar)?$title_ar:'',
                            "short_desc_ar" =>isset($short_desc_ar)?$short_desc_ar:'',
                            "long_desc_ar" =>isset($long_desc_ar)?$long_desc_ar:'',
                            "keywords_ar" =>isset($keywords_ar)?$keywords_ar:'',
                            "tags_ar" =>isset($tags_ar)?$tags_ar:''
                        );
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Tags Are Required." : "علامات المنتج مطلوبة.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Keywords Are Required." : "الكلمات الرئيسية للمنتج مطلوبة.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Title Is Required.';
                return json_encode($resp); exit;
            }
        }
        $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){ 
            if(isset($_POST['retail_price']) && !empty($_POST['retail_price'])){
                if(isset($_POST['wholesale_price']) && !empty($_POST['wholesale_price'])){
                    if(isset($_POST['stock_quantity']) && !empty($_POST['stock_quantity'])){
                        if(isset($_POST['order_limit_quantity']) && !empty($_POST['order_limit_quantity'])){
                            if(isset($_POST['threshold_quantity']) && !empty($_POST['threshold_quantity'])){
                                if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
                                    if(isset($_POST['promotion_status']) && !empty($_POST['promotion_status'])){
                                        if(isset($_POST['feature']) && !empty($_POST['feature'])){
                                            if($this->ses_lang=='en'){
                                                $nameExist = $this->ProductModel->check_product_name_exist($_POST['title']); /* check category name already exist or not */
                                            }else{
                                                $nameExist = $this->ProductModel->check_product_name_ar_exist($_POST['title_ar']); /* check category name already exist or not */
                                            }
                                            if($nameExist==true){
                                                $resp['responseCode'] = 404;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Product Name Is Already Exist.':'اسم المنتج موجود بالفعل.';
                                                return json_encode($resp); exit;
                                            }else{

                                                $retail_price	= isset($_POST['retail_price'])?$_POST['retail_price']:'';
                                                $wholesale_price	= isset($_POST['wholesale_price'])?$_POST['wholesale_price']:'';
                                                $discount_per	= isset($_POST['discount_per'])?$_POST['discount_per']:'';
                                                $sales_tax	= isset($_POST['sales_tax'])?$_POST['sales_tax']:'';
                                                $stock_quantity	= isset($_POST['stock_quantity'])?$_POST['stock_quantity']:'';
                                                $order_limit_quantity	= isset($_POST['order_limit_quantity'])?$_POST['order_limit_quantity']:'';
                                                $threshold_quantity	= isset($_POST['threshold_quantity'])?$_POST['threshold_quantity']:'';
                                                $feature	= isset($_POST['feature'])?$_POST['feature']:'';
                                                $category_id	= isset($_POST['category_id'])?$_POST['category_id']:'';
                                                $brand_id	= isset($_POST['brand_id'])?$_POST['brand_id']:'';
                                                $color_id	= isset($_POST['color_id'])?$_POST['color_id']:'';
                                                $size_id	= isset($_POST['size_id'])?$_POST['size_id']:'';
                                                $weight     = isset($_POST['weight'])?$_POST['weight']:'';
                                                $promotion_status	= isset($_POST['promotion_status'])?$_POST['promotion_status']:'';
                                                
                                                $path 				= 'uploads/product/';
                                                $file 			    = $this->request->getFile('image');
                                                $upload_file 	    = $this->uploadFile($path, $file); /* upload product image file */
                                                if(isset($upload_file) && !empty($upload_file)){
                                                    $requestAry = array(    
                                                        "image" =>isset($upload_file)?$upload_file:'',
                                                        "retail_price" =>isset($retail_price)?$retail_price:'',
                                                        "wholesale_price" =>isset($wholesale_price)?$wholesale_price:'',
                                                        "discount_per" =>isset($discount_per)?$discount_per:'',
                                                        "sales_tax" =>isset($sales_tax)?$sales_tax:'',
                                                        "stock_quantity" =>isset($stock_quantity)?$stock_quantity:'',
                                                        "order_limit_quantity" =>isset($order_limit_quantity)?$order_limit_quantity:'',
                                                        "threshold_quantity" =>isset($threshold_quantity)?$threshold_quantity:'',
                                                        "feature" =>isset($feature)?$feature:'',
                                                        "category_id" =>isset($category_id)?$category_id:'',
                                                        "brand_id" =>isset($brand_id)?$brand_id:'',
                                                        "color_id" =>isset($color_id)?$color_id:'',
                                                        "size_id" =>isset($size_id)?$size_id:'',
                                                        "weight" => isset($weight)?$weight:'',
                                                        "promotion_status" =>isset($promotion_status)?$promotion_status:'',
                                                        "is_active" => 1,
                                                        "created_at" => DATETIME
                                                    );
                                                    $finalRequestAry = array_merge($enarRqrdFldsAry,$requestAry);
                                                    $insertedId = $this->ProductModel->insert_data($finalRequestAry);

                                                    if(is_int($insertedId)){ 
                                                        $resp['responseCode'] = 200;
                                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Added Successfully." : "تمت إضافة المنتج بنجاح.";                                                                                   
                                                        $resp['redirectUrl'] = base_url('admin/all-products');
                                                        return json_encode($resp); exit;     
                                                    }else{
                                                        $errorMsg = 'Error While Product Insertion.';
                                                        if(file_exists('uploads/product/'.$upload_file)){
                                                            unlink("uploads/product/".$upload_file);
                                                        }else{
                                                            $errorMsg .=  $this->ses_lang=='en' ? " and product image is not exist so can not deleted from folder" : "وصورة المنتج غير موجودة لذا لا يمكن حذفها من المجلد";
                                                        }                                                                 
                                                        $resp['responseCode'] = 500;
                                                        $resp['responseMessage'] = $errorMsg;
                                                        return json_encode($resp); exit;
                                                    }
                                                }else{
                                                    $resp['responseCode'] = 500;
                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Error While Uploading Product Image." : "خطأ أثناء تحميل صورة المنتج.";  
                                                    return json_encode($resp); exit;
                                                }
                                            }
                                        }else{
                                            $resp['responseCode'] = 404;
                                            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Feature Status Is Required.':'مطلوب حالة ميزة المنتج.';
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Promotion Status Is Required.':'مطلوب حالة ترويج المنتج.';
                                        return json_encode($resp); exit;
                                    }                                                  
                                            
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] = $this->ses_lang=='en'?'Product Category Is Required.':'فئة المنتج مطلوبة.';
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] = $this->ses_lang=='en'?'A threshold Quantity Limit Is Required.':'مطلوب حد كمية الحد.';
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] = $this->ses_lang=='en'?'Per Order Quantity Limit Is Required.':'مطلوب حد الكمية لكل طلب.';
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Stock Quantity Is Required.':'مطلوب كمية مخزون المنتج.';
                        return json_encode($resp); exit;
                    }                                
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Wholesale Price Is Required.':'مطلوب سعر الجملة.';
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Retail Price Is Required.':'مطلوب سعر التجزئة.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Image Is Required.':'مطلوب صورة المنتج.';
            return json_encode($resp); exit;
        }        
    }

    public function edit_product($prodId=''){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Edit Product';
            $this->pageData['productCategories'] = $this->ProdCatModel->get_all_active_category_data();
            $this->pageData['productBrands'] = $this->BrandModel->get_all_active_data();
            $this->pageData['productColors'] = $this->ColorModel->get_all_active_data();
            $this->pageData['productSizes'] = $this->SizeModel->get_all_active_data();
            $this->pageData['prodDetails'] = $this->ProductModel->find($prodId);
            return view('store_admin/product/edit-product',$this->pageData);
            
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function update_product(){
        if(isset($_POST['product_id']) && !empty($_POST['product_id'])){
            //if(isset($_POST['title']) && !empty($_POST['title'])){
                $enRqrdFldsAry = array();
                $arRqrdFldsAry = array();
                if($this->ses_lang=='en'){
                    if(isset($_POST['title']) && !empty($_POST['title'])){
                        if(isset($_POST['keywords']) && !empty($_POST['keywords'])){
                            if(isset($_POST['tags']) && !empty($_POST['tags'])){
                                $title	= $this->remove_special_char_from_string($_POST['title']);
                                $short_desc	= isset($_POST['short_desc'])?$_POST['short_desc']:'';
                                $long_desc	= isset($_POST['long_desc'])?$_POST['long_desc']:'';
                                $keywords	= $this->remove_special_char_from_keyword_tags($_POST['keywords']);
                                $tags	= $this->remove_special_char_from_keyword_tags($_POST['tags']);
                                $enRqrdFldsAry = array(
                                    "title" =>isset($title)?$title:'',
                                    "short_desc" =>isset($short_desc)?$short_desc:'',
                                    "long_desc" =>isset($long_desc)?$long_desc:'',
                                    "keywords" =>isset($keywords)?$keywords:'',
                                    "tags" =>isset($tags)?$tags:''
                                );
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Tags Are Required." : "علامات المنتج مطلوبة.";
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Keywords Are Required." : "الكلمات الرئيسية للمنتج مطلوبة.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = 'Title Is Required.';
                        return json_encode($resp); exit;
                    }
                }else{
                    if(isset($_POST['title_ar']) && !empty($_POST['title_ar'])){
                        if(isset($_POST['keywords_ar']) && !empty($_POST['keywords_ar'])){
                            if(isset($_POST['tags_ar']) && !empty($_POST['tags_ar'])){
                                $title_ar	= $_POST['title_ar'];
                                $short_desc_ar	= isset($_POST['short_desc_ar'])?$_POST['short_desc_ar']:'';
                                $long_desc_ar	= isset($_POST['long_desc_ar'])?$_POST['long_desc_ar']:'';
                                $keywords_ar	= isset($_POST['keywords_ar'])?$_POST['keywords_ar']:'';
                                $tags_ar	= isset($_POST['tags_ar'])?$_POST['tags_ar']:'';
                                $arRqrdFldsAry = array(
                                    "title_ar" =>isset($title_ar)?$title_ar:'',
                                    "short_desc_ar" =>isset($short_desc_ar)?$short_desc_ar:'',
                                    "long_desc_ar" =>isset($long_desc_ar)?$long_desc_ar:'',
                                    "keywords_ar" =>isset($keywords_ar)?$keywords_ar:'',
                                    "tags_ar" =>isset($tags_ar)?$tags_ar:''
                                );
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Tags Are Required." : "علامات المنتج مطلوبة.";
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Keywords Are Required." : "الكلمات الرئيسية للمنتج مطلوبة.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = 'Title Is Required.';
                        return json_encode($resp); exit;
                    }
                }
                $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);
                if(isset($_POST['retail_price']) && !empty($_POST['retail_price'])){
                    if(isset($_POST['wholesale_price']) && !empty($_POST['wholesale_price'])){
                            if(isset($_POST['stock_quantity']) && !empty($_POST['stock_quantity'])){
                                if(isset($_POST['order_limit_quantity']) && !empty($_POST['order_limit_quantity'])){
                                    if(isset($_POST['threshold_quantity']) && !empty($_POST['threshold_quantity'])){
                                        if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
                                            if(isset($_POST['promotion_status']) && !empty($_POST['promotion_status'])){
                                                if(isset($_POST['feature']) && !empty($_POST['feature'])){

                                                    $retail_price	= isset($_POST['retail_price'])?$_POST['retail_price']:'';
                                                    $wholesale_price	= isset($_POST['wholesale_price'])?$_POST['wholesale_price']:'';
                                                    $discount_per	= isset($_POST['discount_per'])?$_POST['discount_per']:'';
                                                    $sales_tax	= isset($_POST['sales_tax'])?$_POST['sales_tax']:'';
                                                    $stock_quantity	= isset($_POST['stock_quantity'])?$_POST['stock_quantity']:'';
                                                    $order_limit_quantity	= isset($_POST['order_limit_quantity'])?$_POST['order_limit_quantity']:'';
                                                    $threshold_quantity	= isset($_POST['threshold_quantity'])?$_POST['threshold_quantity']:'';
                                                    $feature	= isset($_POST['feature'])?$_POST['feature']:'';
                                                    $category_id	= isset($_POST['category_id'])?$_POST['category_id']:'';
                                                    $brand_id	= isset($_POST['brand_id'])?$_POST['brand_id']:'';
                                                    $color_id	= isset($_POST['color_id'])?$_POST['color_id']:'';
                                                    $size_id	= isset($_POST['size_id'])?$_POST['size_id']:'';
                                                    $weight     = isset($_POST['weight'])?$_POST['weight']:'';
                                                    $promotion_status	= isset($_POST['promotion_status'])?$_POST['promotion_status']:'';
                                                    
                                                    $array1 = array();
                                                    
                                                    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
                                                        $path 				= 'uploads/product/';
                                                        $file 			    = $this->request->getFile('image');
                                                        $upload_file 	    = $this->uploadFile($path, $file); /* upload product image file */
                                                        if(isset($upload_file) && !empty($upload_file)){
                                                            $array1 = array("image" =>isset($upload_file)?$upload_file:'');
                                                        }else{
                                                            $resp['responseCode'] = 500;
                                                            $resp['responseMessage'] = 'Error while uploading product image.';
                                                            return json_encode($resp); exit;
                                                        }
                                                    }

                                                    $array2 = array(    
                                                        "retail_price" =>isset($retail_price)?$retail_price:'',
                                                        "wholesale_price" =>isset($wholesale_price)?$wholesale_price:'',
                                                        "discount_per" =>isset($discount_per)?$discount_per:'',
                                                        "sales_tax" =>isset($sales_tax)?$sales_tax:'',
                                                        "stock_quantity" =>isset($stock_quantity)?$stock_quantity:'',
                                                        "order_limit_quantity" =>isset($order_limit_quantity)?$order_limit_quantity:'',
                                                        "threshold_quantity" =>isset($threshold_quantity)?$threshold_quantity:'',
                                                        "feature" =>isset($feature)?$feature:'',
                                                        "category_id" =>isset($category_id)?$category_id:'',
                                                        "brand_id" =>isset($brand_id)?$brand_id:'',
                                                        "color_id" =>isset($color_id)?$color_id:'',
                                                        "size_id" =>isset($size_id)?$size_id:'',
                                                        "weight" => isset($weight)?$weight:'',
                                                        "promotion_status" =>isset($promotion_status)?$promotion_status:'',
                                                        "updated_at" => DATETIME
                                                    );
                                                    $enarArray = array_merge($enarRqrdFldsAry,$array2);
                                                    $requestArray = array_merge($array1,$enarArray);

                                                    $affectedRowId = $this->ProductModel->update_data($_POST['product_id'], $requestArray);

                                                    if(is_int($affectedRowId)){ 
                                                        $resp['responseCode'] = 200;
                                                        $resp['responseMessage'] = $this->ses_lang=='en'?'Product Updated Successfully.':'تم تحديث المنتج بنجاح.';
                                                        $resp['redirectUrl'] = base_url('admin/edit-product/'.$_POST['product_id']);
                                                        return json_encode($resp); exit;     
                                                    }else{
                                                        $errorMsg = $this->ses_lang=='en'?'Error While Product Updation.':'خطأ أثناء تحديث المنتج.';                                                                   
                                                        $resp['responseCode'] = 500;
                                                        $resp['responseMessage'] = $errorMsg;
                                                        return json_encode($resp); exit;
                                                    }
                                                    
                                                }else{
                                                    $resp['responseCode'] = 404;
                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Feature Status Is Required." : "مطلوب حالة ميزة المنتج.";  
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 404;
                                                $resp['responseMessage'] = $this->ses_lang=='en'?'Product Promotion Status Is Required.':'مطلوب حالة ترويج المنتج.';
                                                return json_encode($resp); exit;
                                            }     
                                        }else{
                                            $resp['responseCode'] = 404;
                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Category Is Required." : "فئة المنتج مطلوبة."; 
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Threshold Quantity Is Required." : "مطلوب كمية العتبة."; 
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Per Order Quantity Limit Is Required." : "مطلوب حد الكمية لكل طلب."; 
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Product Stock Quantity Is Required." : "مطلوب كمية مخزون المنتج.";
                                return json_encode($resp); exit;
                            }                       
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] = $this->ses_lang=='en'?'Wholesale Price Is Required.':'مطلوب سعر الجملة.';
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] = $this->ses_lang=='en'?'Retail Price Is Required.':'مطلوب سعر التجزئة.';
                    return json_encode($resp); exit;
                }  
           
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function all_products(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'All Products';            
            $this->pageData['adminPageId'] = 7;
            $this->pageData['table'] = $this->Products;
            // Get all rows
            $this->pageData['productList'] =$this->ProductModel->get_all_data();
            return view('store_admin/product/all-products',$this->pageData);
            
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function delete_product(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update product status in database table name as 'products' */
            $affectedRowId = $this->ProductModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Product Deleted Successfully.';
                $resp['redirectUrl'] = base_url('admin/all-products');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Product Deletion.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function activate_product(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update product status in database table name as 'products' */
            $affectedRowId = $this->ProductModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = 'Product Activated Successfully.';
                $resp['redirectUrl'] = base_url('admin/all-products');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Error While Product Deletion.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
            return json_encode($resp); exit;
        }
    }

    public function deactivate_product(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update product status in database table name as 'products' */
            $affectedRowId = $this->ProductModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ));
            if(is_int($affectedRowId)){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Product Deactivated Successfully.':'تم إلغاء تنشيط المنتج بنجاح.';
                $resp['redirectUrl'] = base_url('admin/all-products');
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = $this->ses_lang=='en'?'Error While Product Deletion.':'خطأ أثناء حذف المنتج.';
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = $this->ses_lang=='en'?'Product Id Is Required.':'معرف المنتج مطلوب.';
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



