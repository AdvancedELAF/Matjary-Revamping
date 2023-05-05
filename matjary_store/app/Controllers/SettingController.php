<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class SettingController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
    }

    public function general_settings(){        
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->pageData['pageTitle'] = 'Ganeral Setting'; 
            $this->pageData['adminPageId'] = 16;
            $this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data();
            $this->pageData['matjaryTmpltList'] = '';
            $requestData = json_encode(array(
                "user_id"=>isset($this->pageData['storeInfo']['responseData']['user_id'])?$this->pageData['storeInfo']['responseData']['user_id']:''
            ));
            //echo '<pre>'; print_r($requestData); exit;
            $matjaryTmpltListApi = $this->callAPI('POST', 'https://www.matjary.sa/user-store-template-details', $requestData);
            $matjaryTmpltList = json_decode($matjaryTmpltListApi, true);
            
            if(isset($matjaryTmpltList['responseCode']) && $matjaryTmpltList['responseCode']==200){
                if(isset($matjaryTmpltList['responseData']) && !empty($matjaryTmpltList['responseData'])){
                    $this->pageData['matjaryTmpltList'] = $matjaryTmpltList['responseData'];
                }
            } 
            //echo '<pre>'; print_r($this->pageData['matjaryTmpltList']); exit;
            $this->pageData['settingModel'] = $this->SettingModel->find();
            return view('store_admin/settings/general-settings',$this->pageData);
        }else{
            return redirect()->to('/admin/login');
        }
    }   
    
    public function save_general_setting(){
        if(isset($_POST['site_email']) && !empty($_POST['site_email'])){
            if(isset($_POST['template_id']) && !empty($_POST['template_id'])){                    
                if(isset($_POST['administraitor_email']) && !empty($_POST['administraitor_email'])){
                    if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                        if(isset($_POST['support_email']) && !empty($_POST['support_email'])){                                           
                                $enRqrdFldsAry = array();
                                $arRqrdFldsAry = array();
                                if($this->ses_lang == 'en'){
                                    if(isset($_POST['name']) && !empty($_POST['name'])){
                                        if(isset($_POST['address']) && !empty($_POST['address'])){                                                                        
                                            if(isset($_POST['short_desc']) && !empty($_POST['short_desc'])){
                                                if(isset($_POST['long_desc']) && !empty($_POST['long_desc'])){
                                                    $name	= $this->request->getPost('name');
                                                    $address = $this->request->getPost('address');
                                                    $short_desc = $this->request->getPost('short_desc');
                                                    $long_desc = $this->request->getPost('long_desc');
                                                    $enRqrdFldsAry = array(   
                                                        "name" =>isset($name)?$name:'',
                                                        "address" => isset($address)?$address:'',
                                                        "short_desc" => isset($short_desc)?$short_desc:'',
                                                        "long_desc" => isset($long_desc)?$long_desc:''                                                                                        
                                                    );
                                                }else{
                                                    $resp['responseCode'] = 404;
                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Long Description Is Required." : "مطلوب تخزين الوصف الطويل.";
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 404;
                                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Short Description Is Required." : "مطلوب وصف مختصر عن المتجر.";
                                                $resp['responseMessage'] = '';
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 404;
                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Address Is Required." : "عنوان المتجر مطلوب.";
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Name Is Required." : "اسم المتجر مطلوب.";
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    if(isset($_POST['name_ar']) && !empty($_POST['name_ar'])){
                                        if(isset($_POST['address_ar']) && !empty($_POST['address_ar'])){                                                                        
                                            if(isset($_POST['short_desc_ar']) && !empty($_POST['short_desc_ar'])){
                                                if(isset($_POST['long_desc_ar']) && !empty($_POST['long_desc_ar'])){
                                                    $name_ar	= $this->request->getPost('name_ar');
                                                    $address_ar = $this->request->getPost('address_ar');
                                                    $short_desc_ar = $this->request->getPost('short_desc_ar');
                                                    $long_desc_ar = $this->request->getPost('long_desc_ar');
                                                    $arRqrdFldsAry = array(   
                                                        "name_ar" =>isset($name_ar)?$name_ar:'',
                                                        "address_ar" => isset($address_ar)?$address_ar:'',
                                                        "short_desc_ar" => isset($short_desc_ar)?$short_desc_ar:'',
                                                        "long_desc_ar" => isset($long_desc_ar)?$long_desc_ar:''                                                                                        
                                                    );
                                                }else{
                                                    $resp['responseCode'] = 404;
                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Long Description Is Required." : "مطلوب تخزين الوصف الطويل.";
                                                    return json_encode($resp); exit;
                                                }
                                            }else{
                                                $resp['responseCode'] = 404;
                                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Short Description Is Required." : "مطلوب وصف مختصر عن المتجر.";
                                                return json_encode($resp); exit;
                                            }
                                        }else{
                                            $resp['responseCode'] = 404;
                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Address Is Required." : "عنوان المتجر مطلوب.";
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Name Is Required." : "اسم المتجر مطلوب.";
                                        return json_encode($resp); exit;
                                    }
                                } 
                                $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);  
                                if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])){
                                    if(isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name'])){

                                        $site_email	= $this->request->getPost('site_email');
                                        $template_id = $this->request->getPost('template_id');                                                                       
                                        $administraitor_email = $this->request->getPost('administraitor_email');
                                        $contact_no = $this->request->getPost('contact_no');
                                        $support_email = $this->request->getPost('support_email');
                                        $social_fb_link = $this->request->getPost('social_fb_link');
                                        $social_instagram_link =  $this->request->getPost('social_instagram_link');
                                        $social_twitter_link =  $this->request->getPost('social_twitter_link');
                                        $social_linkedin_link =  $this->request->getPost('social_linkedin_link');
                                        $social_youtube_link =  $this->request->getPost('social_youtube_link');
                                        
                                        $path_logo 				= 'uploads/logo/';
                                        $file_logo 			    = $this->request->getFile('logo');
                                        $upload_file_logo 	    = $this->uploadFile($path_logo, $file_logo);
                                        $path_favicon 				= 'uploads/favicon/';
                                        $file_favicon 			    = $this->request->getFile('favicon');        
                                        $upload_file_fivicon	    = $this->uploadFile($path_favicon, $file_favicon);

                                        $reqAry = array(    
                                            "logo" =>isset($upload_file_logo)?$upload_file_logo:'',
                                            "favicon" =>isset($upload_file_fivicon)?$upload_file_fivicon:'',
                                            "site_email" => isset($site_email)?$site_email:'',
                                            "template_id" => isset($template_id)?$template_id:'',
                                            "administraitor_email" => isset($administraitor_email)?$administraitor_email:'',
                                            "contact_no" => isset($contact_no)?$contact_no:'',
                                            "support_email" => isset($support_email)?$support_email:'',
                                            "social_fb_link" =>isset($social_fb_link)?$social_fb_link:'',
                                            "social_instagram_link" => isset($social_instagram_link)?$social_instagram_link:'',
                                            "social_twitter_link" => isset($social_twitter_link)?$social_twitter_link:'',
                                            "social_linkedin_link" => isset($social_linkedin_link)?$social_linkedin_link:'',
                                            "social_youtube_link" => isset($social_youtube_link)?$social_youtube_link:'',
                                            "is_active" => 1,
                                        );
                                        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);
                                        $result = $this->SettingModel->insert_data($finalReqAry);

                                        if(isset($result) && !empty($result)){
                                            $resp['responseCode'] = 200;
                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "General Setting Updated Successfully." : "تم تحديث الإعداد العام بنجاح.";
                                            $resp['redirectUrl'] = base_url('admin/general-settings');
                                            return json_encode($resp); exit;           
                                        
                                        }else{
                                            $errorMsg =  $this->ses_lang=='en' ? "Error While Genaral Setting Insertion." : "خطأ أثناء الإعداد العام للإدراج.";
                                            if(file_exists('uploads/logo/'.$upload_file_logo)){
                                                unlink("uploads/logo/".$upload_file_logo);
                                            }else{
                                                
                                                $errorMsg .= ' and store logo image is not exist so can not deleted from folder';
                                            }
                                            if(file_exists('uploads/favicon/'.$upload_file_fivicon)){
                                                unlink("uploads/favicon/".$upload_file_fivicon);
                                            }else{
                                                $errorMsg .= ' and store favicon image is not exist so can not deleted from folder';
                                            }
                                            $resp['responseCode'] = 500;
                                            $resp['responseMessage'] = $errorMsg;
                                            return json_encode($resp); exit;
                                        }
                                    }else{
                                        $resp['responseCode'] = 404;
                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Favicon Image Is Required.." : "مطلوب صورة أيقونة المتجر المفضلة.";
                                        $resp['responseMessage'] = 'Store Favicon Image Is Required.';
                                        return json_encode($resp); exit;
                                    }
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Logo Image Is Required." : "صورة شعار المتجر مطلوبة.";
                                    return json_encode($resp); exit;
                                }
                            
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Support Mail Is Rrequired." : "مطلوب بريد دعم المتجر.";
                            return json_encode($resp); exit;
                        }
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Contact No Is Required." : "رقم الاتصال بالمتجر مطلوب.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Administration Is Required." : "إدارة المتجر مطلوبة.";
                    return json_encode($resp); exit;
                }
                
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Site Template Is Required." : "قالب الموقع مطلوب.";
                return json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Site Email Is Required." : "البريد الإلكتروني للموقع مطلوب.";
            return json_encode($resp); exit;
        }          
    }

    public function update_general_setting(){        
        if(isset($_POST['setting_id']) && !empty($_POST['setting_id'])){
                if(isset($_POST['site_email']) && !empty($_POST['site_email'])){
                    if(isset($_POST['template_id']) && !empty($_POST['template_id'])){
                        if(isset($_POST['administraitor_email']) && !empty($_POST['administraitor_email'])){
                            if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
                                if(isset($_POST['support_email']) && !empty($_POST['support_email'])){
                                    // if(isset($_POST['smtp_host']) && !empty($_POST['smtp_host'])){
                                    //     if(isset($_POST['smtp_username']) && !empty($_POST['smtp_username'])){
                                    //         if(isset($_POST['smtp_password']) && !empty($_POST['smtp_password'])){
                                    //             if(isset($_POST['smtp_port']) && !empty($_POST['smtp_port'])){
                                    //                 if(isset($_POST['smtp_from']) && !empty($_POST['smtp_from'])){
                                                        $enRqrdFldsAry = array();
                                                        $arRqrdFldsAry = array();
                                                        if($this->ses_lang == 'en'){
                                                            if(isset($_POST['name']) && !empty($_POST['name'])){
                                                                if(isset($_POST['address']) && !empty($_POST['address'])){                                                                        
                                                                    if(isset($_POST['short_desc']) && !empty($_POST['short_desc'])){
                                                                        if(isset($_POST['long_desc']) && !empty($_POST['long_desc'])){
                                                                            $name	= $this->request->getPost('name');
                                                                            $address = $this->request->getPost('address');
                                                                            $short_desc = $this->request->getPost('short_desc');
                                                                            $long_desc = $this->request->getPost('long_desc');
                                                                            $enRqrdFldsAry = array(   
                                                                                "name" =>isset($name)?$name:'',
                                                                                "address" => isset($address)?$address:'',
                                                                                "short_desc" => isset($short_desc)?$short_desc:'',
                                                                                "long_desc" => isset($long_desc)?$long_desc:''                                                                                        
                                                                            );
                                                                        }else{
                                                                            $resp['responseCode'] = 404;
                                                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Long Description Is Required." : "مطلوب تخزين الوصف الطويل.";
                                                                            return json_encode($resp); exit;
                                                                        }
                                                                    }else{
                                                                        $resp['responseCode'] = 404;
                                                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Short Description Is Required." : "مطلوب وصف مختصر عن المتجر.";
                                                                        return json_encode($resp); exit;
                                                                    }
                                                                }else{
                                                                    $resp['responseCode'] = 404;
                                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Address Is Required." : "عنوان المتجر مطلوب.";
                                                                    return json_encode($resp); exit;
                                                                }
                                                            }else{
                                                                $resp['responseCode'] = 404;
                                                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Name Is Required." : "اسم المتجر مطلوب.";
                                                                return json_encode($resp); exit;
                                                            }
                                                        }else{
                                                            if(isset($_POST['name_ar']) && !empty($_POST['name_ar'])){
                                                                if(isset($_POST['address_ar']) && !empty($_POST['address_ar'])){                                                                        
                                                                    if(isset($_POST['short_desc_ar']) && !empty($_POST['short_desc_ar'])){
                                                                        if(isset($_POST['long_desc_ar']) && !empty($_POST['long_desc_ar'])){
                                                                            $name_ar	= $this->request->getPost('name_ar');
                                                                            $address_ar = $this->request->getPost('address_ar');
                                                                            $short_desc_ar = $this->request->getPost('short_desc_ar');
                                                                            $long_desc_ar = $this->request->getPost('long_desc_ar');
                                                                            $arRqrdFldsAry = array(   
                                                                                "name_ar" =>isset($name_ar)?$name_ar:'',
                                                                                "address_ar" => isset($address_ar)?$address_ar:'',
                                                                                "short_desc_ar" => isset($short_desc_ar)?$short_desc_ar:'',
                                                                                "long_desc_ar" => isset($long_desc_ar)?$long_desc_ar:''                                                                                        
                                                                            );
                                                                        }else{
                                                                            $resp['responseCode'] = 404;
                                                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Long Description Is Required." : "مطلوب تخزين الوصف الطويل.";
                                                                            return json_encode($resp); exit;
                                                                        }
                                                                    }else{
                                                                        $resp['responseCode'] = 404;
                                                                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Short Description Is Required." : "مطلوب وصف مختصر عن المتجر.";
                                                                        return json_encode($resp); exit;
                                                                    }
                                                                }else{
                                                                    $resp['responseCode'] = 404;
                                                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Address Is Required." : "عنوان المتجر مطلوب.";
                                                                    return json_encode($resp); exit;
                                                                }
                                                            }else{
                                                                $resp['responseCode'] = 404;
                                                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Name Is Required." : "اسم المتجر مطلوب.";
                                                                return json_encode($resp); exit;
                                                            }
                                                        } 
                                                        $enarRqrdFldsAry = array_merge($enRqrdFldsAry,$arRqrdFldsAry);  

                                                        $id = $this->request->getPost('setting_id');
                                                        $site_email	= $this->request->getPost('site_email');
                                                        $template_id = $this->request->getPost('template_id');
                                                        $administraitor_email = $this->request->getPost('administraitor_email');
                                                        $contact_no = $this->request->getPost('contact_no');
                                                        $support_email = $this->request->getPost('support_email');
                                                        $social_fb_link = $this->request->getPost('social_fb_link');
                                                        $social_instagram_link =  $this->request->getPost('social_instagram_link');
                                                        $social_twitter_link =  $this->request->getPost('social_twitter_link');
                                                        $social_linkedin_link =  $this->request->getPost('social_linkedin_link');
                                                        $social_youtube_link =  $this->request->getPost('social_youtube_link');
                                                        // $smtp_host =  $this->request->getPost('smtp_host');
                                                        // $smtp_username =  $this->request->getPost('smtp_username');
                                                        // $smtp_password =  $this->request->getPost('smtp_password');
                                                        // $smtp_port =  $this->request->getPost('smtp_port'); 
                                                        // $smtp_from = $this->request->getPost('smtp_from');

                                                        if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])){
                                                            $path_logo 				= 'uploads/logo/';
                                                            $file_logo 			    = $this->request->getFile('logo');
                                                            $upload_file_logo 	    = $this->uploadFile($path_logo, $file_logo);

                                                            $affectedRowId = $this->SettingModel->update_data($id,array(    
                                                                'logo'=>$upload_file_logo
                                                            ));
                                                        }

                                                        if(isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name'])){
                                                            $path_favicon 				= 'uploads/favicon/';
                                                            $file_favicon 			    = $this->request->getFile('favicon');        
                                                            $upload_file_fivicon	    = $this->uploadFile($path_favicon, $file_favicon);
                                                            
                                                            $affectedRowId = $this->SettingModel->update_data($id,array(    
                                                                'favicon'=>$upload_file_fivicon
                                                            ));
                                                        }
                                                        $reqAry = array(  
                                                            "site_email" => isset($site_email)?$site_email:'',
                                                            "template_id" => isset($template_id)?$template_id:'',
                                                            "administraitor_email" => isset($administraitor_email)?$administraitor_email:'',
                                                            "contact_no" => isset($contact_no)?$contact_no:'',
                                                            "support_email" => isset($support_email)?$support_email:'',
                                                            "social_fb_link" =>isset($social_fb_link)?$social_fb_link:'',
                                                            "social_instagram_link" => isset($social_instagram_link)?$social_instagram_link:'',
                                                            "social_twitter_link" => isset($social_twitter_link)?$social_twitter_link:'',
                                                            "social_linkedin_link" => isset($social_linkedin_link)?$social_linkedin_link:'',
                                                            "social_youtube_link" => isset($social_youtube_link)?$social_youtube_link:''
                                                            // "smtp_host" => isset($smtp_host)?$smtp_host:'',
                                                            // "smtp_username" => isset($smtp_username)?$smtp_username:'',
                                                            // "smtp_password" => isset($smtp_password)?$smtp_password:'',
                                                            // "smtp_port" => isset($smtp_port)?$smtp_port:'', 
                                                            // "smtp_from" => isset($smtp_from)?$smtp_from:''
                                                        );
                                                        $finalReqAry = array_merge($reqAry, $enarRqrdFldsAry);

                                                        $affectedRowId = $this->SettingModel->update_data($id,$finalReqAry);

                                                        if(is_int($affectedRowId)){ 
                                                            $resp['responseCode'] = 200;
                                                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "General Setting Updated Successfully." : "تم تحديث الإعداد العام بنجاح.";
                                                            $resp['redirectUrl'] = base_url('admin/general-settings');
                                                            return json_encode($resp); exit;     
                                                        }else{
                                                            $errorMsg =  $this->ses_lang=='en' ? "Error While Genaral Setting Updation." : "خطأ أثناء تحديث الإعداد العام.";
                                                            $resp['responseCode'] = 500;
                                                            $resp['responseMessage'] = $errorMsg;
                                                            return json_encode($resp); exit;
                                                        }
                                    //                 }else{
                                    //                     $resp['responseCode'] = 404;
                                    //                     $resp['responseMessage'] = 'Store SMTP From Mail Is Required.';
                                    //                     return json_encode($resp); exit;
                                    //                 }
                                    //             }else{
                                    //                 $resp['responseCode'] = 404;
                                    //                 $resp['responseMessage'] = 'Store SMTP Port Is Required.';
                                    //                 return json_encode($resp); exit;
                                    //             }
                                    //         }else{
                                    //             $resp['responseCode'] = 404;
                                    //             $resp['responseMessage'] = 'Store SMTP Password Is Required.';
                                    //             return json_encode($resp); exit;
                                    //         }
                                    //     }else{
                                    //         $resp['responseCode'] = 404;
                                    //         $resp['responseMessage'] = 'Store SMTP Username Is Required.';
                                    //         return json_encode($resp); exit;
                                    //     }
                                    // }else{
                                    //     $resp['responseCode'] = 404;
                                    //     $resp['responseMessage'] = 'Store SMTP Host Is Required.';
                                    //     return json_encode($resp); exit;
                                    // }
                                }else{
                                    $resp['responseCode'] = 404;
                                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Support Mail Is Required." : "مطلوب بريد دعم المتجر.";
                                    return json_encode($resp); exit;
                                }
                            }else{
                                $resp['responseCode'] = 404;
                                $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Contact No Is Required." : "رقم الاتصال بالمتجر مطلوب.";
                                return json_encode($resp); exit;
                            }
                        }else{
                            $resp['responseCode'] = 404;
                            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Administration Is Required." : "إدارة المتجر مطلوبة.";
                            return json_encode($resp); exit;
                        }
                       
                    }else{
                        $resp['responseCode'] = 404;
                        $resp['responseMessage'] =  $this->ses_lang=='en' ? "Site Template Is Required." : "قالب الموقع مطلوب.";
                        return json_encode($resp); exit;
                    }
                }else{
                    $resp['responseCode'] = 404;
                    $resp['responseMessage'] =  $this->ses_lang=='en' ? "Site Email Is Required." : "البريد الإلكتروني للموقع مطلوب.";
                    return json_encode($resp); exit;
                }
          
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  $this->ses_lang=='en' ? "Store Setting Id Is Required." : "مطلوب معرف إعداد المتجر.";
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



