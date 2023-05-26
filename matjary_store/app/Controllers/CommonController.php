<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CommonController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
    }

    public function language(){
        if(isset($_POST['lang']) && !empty($_POST['lang'])){
            $ses_data = [
                'ses_lang'       => $_POST['lang'],
                'lang_session'     => TRUE
            ];
            $this->session->set($ses_data);
        }
        
        $resp['responseCode'] = 200;
        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Language Change Successfully" : "تغيير اللغة بنجاح"; 
        $resp['redirectUrl'] = base_url();
        return json_encode($resp); exit;
    }

    public function index(){
        $this->pageData['pageTitle'] = 'Dashboard';
        return view('store_admin/dashboard',$this->pageData);
    }

    public function delete_image(){
        
        if(isset($_POST['imgname']) && !empty($_POST['imgname'])){
            if(isset($_POST['id']) && !empty($_POST['id'])){
                if(isset($_POST['tablename']) && !empty($_POST['tablename'])){
                    if(isset($_POST['tablecolumn']) && !empty($_POST['tablecolumn'])){
                       
                        if($_POST['tablename']=='products'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'products', array(
                                'image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/product/'.$_POST['imgname'])){
                                    unlink("uploads/product/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد"; 
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-product/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات."; 
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='productcategories'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'productcategories', array(
                                'category_img' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/product_category/'.$_POST['imgname'])){
                                    unlink("uploads/product_category/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-product-category/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='brands'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'brands', array(
                                'brand_image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/product_brands/'.$_POST['imgname'])){
                                    unlink("uploads/product_brands/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-brand/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='banners'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'banners', array(
                                'image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/banners/'.$_POST['imgname'])){
                                    unlink("uploads/banners/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-banner/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='aboutus'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'aboutus', array(
                                'image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/aboutus/'.$_POST['imgname'])){
                                    unlink("uploads/aboutus/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-banner/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='giftcards'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'giftcards', array(
                                'image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/giftcards/'.$_POST['imgname'])){
                                    unlink("uploads/giftcards/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-gift-card/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='Advertisements'){
                                /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'Advertisements', array(
                                'add_img' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/advertisement/'.$_POST['imgname'])){
                                    unlink("uploads/advertisement/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/edit-advertisement/'.$_POST['id']);
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='Users'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'Users', array(
                                'profile_image' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/user_profile_picture/'.$_POST['imgname'])){
                                    unlink("uploads/user_profile_picture/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/profile');
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='Setting'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'Setting', array(
                                'logo' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/logo/'.$_POST['imgname'])){
                                    unlink("uploads/logo/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/general-settings');
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }elseif($_POST['tablename']=='Settings'){
                            /* update data  */
                            $affectedRowId = $this->CommonModel->update_data($_POST['id'],'Setting', array(
                                'favicon' => '',
                                "updated_at" => DATETIME
                            ));
                            if(is_int($affectedRowId)){ 
                                $errorMsg =  $this->ses_lang=='en' ? "Image Removed Successfully." : "تمت إزالة الصورة بنجاح."; 
                                if(file_exists('uploads/favicon/'.$_POST['imgname'])){
                                    unlink("uploads/favicon/".$_POST['imgname']);
                                }else{
                                    $errorMsg .=  $this->ses_lang=='en' ? " and image is not exist so can not deleted from folder" : "والصورة غير موجودة لذلك لا يمكن حذفها من المجلد";
                                }
                                $resp['responseCode'] = 200;
                                $resp['responseMessage'] = $errorMsg;
                                $resp['redirectUrl'] = base_url('admin/general-settings');
                                return json_encode($resp); exit;
                            }else{
                                $errorMsg =  $this->ses_lang=='en' ? "Error While Information Updating." : "خطأ أثناء تحديث المعلومات.";
                                $resp['responseCode'] = 500;
                                $resp['responseMessage'] = $errorMsg;
                                return json_encode($resp); exit;
                            }
                        }
                        
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Database Table Column Name Is Required." : "اسم عمود جدول قاعدة البيانات مطلوب."; 
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Database Table Name Is Required." : "اسم جدول قاعدة البيانات مطلوب."; 
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Affected Id Is Required." : "المعرف المتأثر مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Image Name Records Not Found." : "لم يتم العثور على سجلات اسم الصورة.";
            return json_encode($resp); exit;
        }
        
    }

    public function get_country_states(){
        if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
            $result = $this->CommonModel->get_country_states($_POST['country_id']);
            if(isset($result) && !empty($result)){
                $resp['responseCode'] = 200;
                $resp['responseData'] = $result;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Records Retrived Successfully." : "تم استرداد السجلات بنجاح.";
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Records Not Found." : "السجلات غير موجودة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Country Is Required." : "الدولة مطلوبة.";
            return json_encode($resp); exit;
        }
    }

    public function get_state_cities(){
        if(isset($_POST['state_id']) && !empty($_POST['state_id'])){
            $result = $this->CommonModel->get_state_cities($_POST['state_id']);
            if(isset($result) && !empty($result)){
                $resp['responseCode'] = 200;
                $resp['responseData'] = $result;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Records Retrived Successfully." : "تم استرداد السجلات بنجاح.";
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Records Not Found." : "السجلات غير موجودة.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Country Is Required." : "الدولة مطلوبة.";
            return json_encode($resp); exit;
        }
    }

    public function multi_action_option(){
        
        if(isset($_POST['action_id']) && !empty($_POST['action_id'])){
            if(isset($_POST['checkvalue']) && !empty($_POST['checkvalue'])){
                if(isset($_POST['table']) && !empty($_POST['table'])){
                    $callAction = true;
                    $msg = "";            
                    $itemIDArray = explode(',' , $_POST['checkvalue']);
                    if($_POST['action_id'] == 1){                
                        foreach($itemIDArray as $idData){
                            $data = array('is_active'=> 1);
                            $callAction = $this->CommonModel->activate_record($idData,$_POST['table'],$data);
                        } 
                        $msg = $this->ses_lang=='en' ? "Records Activated Successfully." : "يتم تنشيط السجلات بنجاح.";              
                        
                    }elseif($_POST['action_id'] == 2){ 
                        foreach($itemIDArray as $idData){
                            $data = array('is_active'=> 2);
                            $callAction = $this->CommonModel->deactive_record($idData,$_POST['table'],$data);
                        } 
                        $msg = $this->ses_lang=='en' ? "Records Deactivated Successfully." : "تم إلغاء تنشيط السجلات بنجاح.";    

                    }elseif($_POST['action_id'] == 3){
                        
                        foreach($itemIDArray as $idData){
                            $data = array('is_active'=> 3);
                            $callAction = $this->CommonModel->delete_record($idData,$_POST['table'],$data);
                        }  
                        $msg = $this->ses_lang=='en' ? "Records Deleted Successfully." : "تم حذف السجلات بنجاح."; 
                    
                    }
                    if(isset($callAction)){
                        $resp['responseCode'] = 200;              
                        $resp['responseMessage'] =  $msg;
                        return json_encode($resp); exit;
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Something went Wrong." : "هناك خطأ ما.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Table Name Is Required." : "اسم الجدول مطلوب.";
                    return json_encode($resp); exit;
                }
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Item Id Is Required." : "معرف العنصر مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Id Is Required." : "المعرف مطلوب.";
            return json_encode($resp); exit;
        }
    }

    public function get_category_products(){
        if(isset($_POST['catid']) && !empty($_POST['catid'])){    
            $productList = $this->ProductModel->get_all_prod_categories($_POST['catid']); 
            if(isset($productList) && !empty($productList)){
                
                foreach($productList as $productData){
                    $productData->already_incart = false;
                    if(isset($this->ses_logged_in) && $this->ses_logged_in===true){
                        $productData->already_incart = $this->CartModel->chk_prod_exist_with_same_customer($productData->id,$this->ses_custmr_id);
                    }
                }
                
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Category Product Retrived Successfully." : "فئة المنتج تم استرداده بنجاح.";              
                $resp['responseData'] = $productList;
                return json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Products not found in this category." : "المنتجات غير موجودة في هذه الفئة.";
                return json_encode($resp); exit;
            }
        }else{  
            $resp['responseCode'] = 400;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Category Id Is Required." : "معرف الفئة مطلوب.";
            return json_encode($resp); exit;
        } 
    }

    public function test_sendgrid_mail(){
        //require '../vendor/autoload.php'; // If you're using Composer (recommended)
        // Comment out the above line if not using Composer
        // require("<PATH TO>/sendgrid-php.php");
        // If not using Composer, uncomment the above line and
        // download sendgrid-php.zip from the latest release here,
        // replacing <PATH TO> with the path to the sendgrid-php.php file,
        // which is included in the download:
        // https://github.com/sendgrid/sendgrid-php/releases

        // $email = new \SendGrid\Mail\Mail(); 
        // $email->setFrom("test@example.com", "Example User");
        // $email->setSubject("Sending with SendGrid is Fun");
        // $email->addTo("test@example.com", "Example User");
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        // $email->addContent(
        //     "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        // );
        // $sendgrid = new \SendGrid(getenv('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'));
        // try {
        //     $response = $sendgrid->send($email);
        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (Exception $e) {
        //     echo 'Caught exception: '. $e->getMessage() ."\n";
        // }

        // $headers = array(
        //     'Authorization: Bearer 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',
        //     'Content-Type: application/json'
        // );

        // $data = array(
        //     "personalizations" => array(
        //         array(
        //             "to" => array(
        //                 array(
        //                     "email" => 'babasahebatpadkar@gmail.com',
        //                     "name" => 'babasaheb'
        //                 )
        //             )
        //         )
        //     ),          
        //     "from" => array(
        //         "email" => 'saiatpadkar15@gmail.com',
        //         "name" => 'sai atpadkar'
        //     ),
        //     "subject" => 'test mail',
        //     "content" => array(
        //         array(
        //             "type" => "text/html",
        //             "value" => 'hi this is test mail.'
        //         )
        //     )
        // );

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $response = curl_exec($ch);
        // curl_close($ch);

        // // print everything out
        // echo '<pre>'; print_r($response); exit;
        // if(isset($response) && !empty($response)){
        //     //echo $mail->ErrorInfo;
        //     return false;
        // }else{          
        //     return true; 
        // }

        $SENDGRID_API_KEY = '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'; 

        // curl --request POST \
        // --url https://api.sendgrid.com/v3/mail/send \
        // --header "Authorization: Bearer $SENDGRID_API_KEY" \
        // --header 'Content-Type: application/json' \
        // --data '{"personalizations": [{"to": [{"email": "test@example.com"}]}],"from": {"email": "test@example.com"},"subject": "Sending with SendGrid is Fun","content": [{"type": "text/plain", "value": "and easy to do anywhere, even with cURL"}]}'

        $headers = array(
            'Authorization: Bearer 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',
            'Content-Type: application/json'
        );
        $email = 'babasahebatpadkar@gmail.com';
        $body = 'test body';
        $subject = 'test mail';
        $name = 'babasaheb';
        $subdomain = 'subdomain';

        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        )
                    )
                )
            ),          
            "from" => array(
                "email" => 'saiatpadkar15@gmail.com',
                "name" => $subdomain
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // print everything out
        echo '<pre>'; print_r($response); exit;

    }

    public function core_php_test_mail(){
        // $to = "saiatpadkar15@gmail.com";
        // $subject = "Test Email";
        // $message = "This is a test email.";
        // $headers = "From: babasahebatpadkar@gmail.com" . "\r\n";

        // if (mail($to, $subject, $message, $headers)) {
        //     echo "Email sent successfully.";
        // } else {
        //     echo "Email sending failed.";
        // }

        // $to = "saiatpadkar15@gmail.com";
        // $subject = "Test Email";
        // $message = "This is a test email sent using the PHP mail function.";
        // $headers = "From: babasahebatpadkar@gmail.com\r\n";

        // $result = mail($to, $subject, $message, $headers);
        // if ($result) {
        //     echo "Email sent successfully.";
        // } else {
        //     echo "Email sending failed. Error: " . error_get_last()['message'];
        // }
        
        

        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            /* Server settings */
            $mail->SMTPDebug = 2;                                 /* Enable verbose debug output */
            $mail->isSMTP();                                      /* Set mailer to use SMTP */
            $mail->Host = 'mail.motorgate.com';                    /* Specify main and backup SMTP servers */
            $mail->SMTPAuth = true;                               /* Enable SMTP authentication */
            $mail->Username = 'smtpmail@motorgate.com';                   /* SMTP username */
            $mail->Password = '2NrW_q,i9Z;%';                   /* SMTP password */
            $mail->SMTPSecure = 'tls';                            /* Enable TLS encryption, `ssl` also accepted */
            $mail->Port = 587;                                    /* TCP port to connect to */

            /*Recipients */
            $mail->setFrom('smtpmail@motorgate.com', 'Sender Name');
            $mail->addAddress('saiatpadkar15@gmail.com', 'Recipient Name');     /* Add a recipient */

            /* Content */
            $mail->isHTML(true);                                  /* Set email format to HTML */
            $mail->Subject = 'Test Email via SMTP';
            $mail->Body    = 'This is a test email sent via SMTP using PHPMailer.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }

}

?>



