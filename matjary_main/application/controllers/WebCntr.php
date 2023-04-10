<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WebCntr extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
		echo '<pre>'; print_r('commin on index file'); exit;
        $this->load->view('index');

    }

    public function switchLang() {
        $language_temp = $this->input->post('requestedLanguage');
        if ($language_temp == 'ar') {
            $language = 'en';
        } else if ($language_temp == 'en') {
            $language = 'ar';
        } else {
            $language = 'ar';
        }
        $this->session->set_userdata('site_lang', $language);
    }

    public function about_us() {
        /* //Defining data variable to pass data to page */
        $data = array();

        /* SEO data for this page */
        $data['title'] = '';
        $data['description'] = '';
        $data['keywords'] = '';

        /* pass css required for this specific page */
        $data['css'] = array(
            'style1'
        );

        /* pass javascript required for this specific page */
        $data['js'] = array(
            'script1.js'
        );

        /* session check for user login */
        if ($this->session->userdata('loggedInUsrData')) {
            $data = $this->session->userdata('loggedInUsrData');
        }

        $this->load->view('about-us', $data);
    }

    public function services() {
        $this->load->view('services');
    }

    public function templates() { 
        $pageData = array();
        $filetered_cat = array();
        $templateData = new stdClass();
        $getTemplateListUrl = base_url('template-list');
        $urlJsonData = $this->restclient->post($getTemplateListUrl);
        if ($urlJsonData->info->http_code == 200) {
            $templateData->apiResponse = json_decode($urlJsonData->response);
            if ($templateData->apiResponse->responseCode == 200) {
                if (isset($templateData->apiResponse->responseData) & !empty($templateData->apiResponse->responseData)) {
                    $filetered_cat_temp = json_decode(json_encode($templateData->apiResponse->responseData), true);
                    foreach ($filetered_cat_temp as $key => $value) {
                        $filetered_cat_temp[$key]['enc_id'] = encryptCode($value['id'], ENCRYPT_URL_DATA_KEY);
                        /* if user loggedIn then check this user already purchase this template */
                        $filetered_cat_temp[$key]['tmp_purchase_status'] = false;
                        if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
                            $respData = $this->CommonModel->check_template_purchased($value['id'], $this->loggedInUsrData['id']);
                            if(isset($respData) && !empty($respData)){
                                $filetered_cat_temp[$key]['tmp_purchase_status'] = true;
                            }
                        }
                    }

                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $templateData->apiResponse->responseMessage;
                    $this->response['responseData'] = $templateData->apiResponse->responseData;
                    $pageData['templateData'] = $filetered_cat_temp;
                    $pageData['categoryData'] = $this->CatModel->category_list();
                    if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
                        $pageData['user_id'] = $this->loggedInUsrData['id'];
                    }
                }
            }
        }

        /* session check for user login */
        $pageData['site_lang'] = 'ar';
        if ($this->session->userdata('site_lang')) {
            $pageData['site_lang'] = $this->session->userdata('site_lang');
        }
        $this->load->view('themes', $pageData);
    }
    
    public function help() {
        $this->load->view('help');
    }

    public function faq() {
        $this->load->view('faq');
    }

    public function pricing() {
        $data = array();
        $planData = new stdClass();
        $getPlanListUrl = base_url('plan-list');
        $urlJsonData = $this->restclient->post($getPlanListUrl);
        if ($urlJsonData->info->http_code == 200) {
            $planData->apiResponse = json_decode($urlJsonData->response);
            if ($planData->apiResponse->responseCode == 200) {
                if (isset($planData->apiResponse->responseData) & !empty($planData->apiResponse->responseData)) {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $planData->apiResponse->responseMessage;
                    $this->response['responseData'] = $planData->apiResponse->responseData;
                    $data['planData'] = $planData->apiResponse->responseData;
                }
            }
        }

        $this->load->view('pricing', $data);
    }

    public function contact() {
        $this->load->view('contact');
    }

    public function privacy_policy() {
        $this->load->view('privacy-policy');
    }

    public function terms_services() {
        $this->load->view('terms-conditions');
    }

    public function refund_return_policy() {
        $this->load->view('refund-return-policy');
    }

    public function chk_domain_subdomain_live_status() {
        $sesData = $this->session->userdata('create_store_arg');
        if (isset($sesData) && !empty($sesData)) {
            $sub_domain_name = $sesData['sub_domain_name'];
            $template_id = $sesData['template_id'];
            $storeUrl = 'http://www.' . $sub_domain_name . '.matjary.in';
            $file_headers = @get_headers($storeUrl);
            if (isset($file_headers) && !empty($file_headers)) {
                if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $statusMessage = 'Sorry , Your online store Url is still not ready to use , please try to access your store after some time or contact to administrator for more details.';
                    $this->session->set_flashdata('statusMessage', $statusMessage);
                    $successPageUrl = base_url('subscription-success');
                    redirect($successPageUrl);
                } else {
                    $statusMessage = 'Congratulations , Your online store is created successfully , for visit your store website plese click on below link.';
                    $this->session->set_flashdata('statusMessage', $statusMessage);
                    redirect($storeUrl);
                }
            }
        }
    }

    public function request_reset_pwd() {
        $this->load->view('forgot-password');
    }

    public function enter_reset_pwd_page() {
        $pageData = array();
        $reset_pwd_data = $this->uri->segment(2);
        $pageData['rst_pwd_tkn'] = $reset_pwd_data;
        $this->load->view('reset-password', $pageData);
    }

    public function paid_themes() {
        $pageData = array();
        $filetered_cat = array();
        $templateData = new stdClass();
        $getTemplateListUrl = base_url('template-list');
        $urlJsonData = $this->restclient->post($getTemplateListUrl);
        if ($urlJsonData->info->http_code == 200) {
            $templateData->apiResponse = json_decode($urlJsonData->response);
            if ($templateData->apiResponse->responseCode == 200) {
                if (isset($templateData->apiResponse->responseData) & !empty($templateData->apiResponse->responseData)) {
                    $filetered_cat_temp = json_decode(json_encode($templateData->apiResponse->responseData), true);
                    //get unnique categories from tamplate data
                    foreach ($filetered_cat_temp as $key => $value) {
                        $temp_category[$key] = $value['category_name'];
                    }
                    $unique_category = array_values(array_unique($temp_category));
                    /*
                      foreach ($unique_category as $val) {
                      foreach ($filetered_cat_temp as $key => $value) {
                      $filter = $val;
                      $filetered_cat[$val] = array_filter($filetered_cat_temp, function ($var) use ($filter) {
                      return ($var['category_name'] == $filter);
                      });
                      }
                      }
                     */
                    foreach ($filetered_cat_temp as $key => $value) {
                        $filetered_cat_temp[$key]['enc_id'] = encryptCode($value['id'], ENCRYPT_URL_DATA_KEY);
                    }

                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $templateData->apiResponse->responseMessage;
                    $this->response['responseData'] = $templateData->apiResponse->responseData;
                    $pageData['templateData'] = $filetered_cat_temp;
                    $pageData['categoryData'] = $unique_category;
                    if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
                        $pageData['user_id'] = $this->loggedInUsrData['id'];
                    }
                }
            }
        }

        $this->load->view('paid-themes', $pageData);
    }

    /*
      public function lang_switch() {
      $lang = $_POST['lang'];
      $curntUrl = $_POST['curntUrl'];
      //adding data to session
      $this->session->set_userdata('language', $lang);
      $this->response['responseCode'] = 200;
      $this->response['responseMessage'] = 'success';
      $this->response['responseUrl'] = $curntUrl;
      echo json_encode($this->response);
      exit;
      }
     */
}
