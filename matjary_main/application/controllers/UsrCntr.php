<?php

class UsrCntr extends MY_Controller {

    function __construct() {
        parent::__construct();

        /*//load helper for language*/
        $this->load->helper('language');
        /*//content_lang is the language file within language folder*/
        if(isset($_SESSION['site_lang'])){
            $this->lang->load('content_lang',$_SESSION['site_lang']);
        }else{
            $this->lang->load('content_lang','ar');
        }
    }

    public function register() {
        $this->load->view('register');
    }

    public function login() {
        $this->load->view('login');
    }

    public function save_user() {
        try {
            if (isset($_POST['fname']) & !empty($_POST['fname'])) {
                if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['fname'])) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2'); /* Invalid first name, contains vulnerable characters */
                    echo json_encode($this->response); exit;
                }
                if (isset($_POST['lname']) & !empty($_POST['lname'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['lname'])) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3'); /* Invalid first name, contains vulnerable characters */
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['email']) & !empty($_POST['email'])) {
                        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4'); /* Invalid Email. */
                            echo json_encode($this->response); exit;
                        }
                        if (isset($_POST['phone_no']) & !empty($_POST['phone_no'])) {
                            if (!preg_match("/^[1-9][0-9]*$/", $_POST['phone_no'])) {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14'); /* Invalid phone number */
                                echo json_encode($this->response); exit;
                            }
                            if (isset($_POST['password']) & !empty($_POST['password'])) {

                                if (isset($_POST['passconf']) & !empty($_POST['passconf'])) {
                                    if (trim($_POST['password'], ' ') != trim($_POST['passconf'], ' ')) {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_5'); /* Password & Confirm Password not Match. */
                                        echo json_encode($this->response); exit;
                                    }
                                    $usrData = new stdClass();
                                    $saveUsrUlr = base_url('save-usr');
                                    $requestData = array(
                                        'fname' => isset($_POST['fname']) ? $_POST['fname'] : '',
                                        'lname' => isset($_POST['lname']) ? $_POST['lname'] : '',
                                        'email' => isset($_POST['email']) ? $_POST['email'] : '',
                                        'phone_no' => isset($_POST['phone_no']) ? $_POST['phone_no'] : '',
                                        'password' => isset($_POST['password']) ? $_POST['password'] : '',
                                        'passconf' => isset($_POST['passconf']) ? $_POST['passconf'] : ''
                                    );
                                    $header[0] = 'form-data';
                                    /* send request to api */
                                    $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                                    $urlJsonData = $this->restclient->post($saveUsrUlr, $inptData, $header);
                                    if ($urlJsonData->info->http_code == 200) {
                                        $usrData->apiResponse = json_decode($urlJsonData->response);
                                        if ($usrData->apiResponse->responseCode == 200) {
                                            $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                                            $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                                            $this->response['redirectUrl'] = base_url('login');
                                            echo json_encode($this->response); exit;
                                        } else {
                                            $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                                            $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                                            echo json_encode($this->response); exit;
                                        }
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_12'); /* Confirm Password is required. */
                                    echo json_encode($this->response); exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13'); /* Password is required. */
                                echo json_encode($this->response); exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14'); /* Contact Number is required. */
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15'); /* Email is required. */
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_16'); /* Last Name is required. */
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17'); /* First Name is required. */
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function usr_login() {
        if (isset($_POST['email']) & !empty($_POST['email'])) {
            if (isset($_POST['password']) & !empty($_POST['password'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4'); /* Invalid Email. */
                    echo json_encode($this->response); exit;
                }
                $usrData = new stdClass();
                $chkUsrLoginUrl = base_url('chk-usr-login');
                $requestData = array(
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                );
                $header[0] = 'form-data';
                $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                $urlJsonData = $this->restclient->post($chkUsrLoginUrl, $inptData, $header);
                if ($urlJsonData->info->http_code == 200) {
                    $usrData->apiResponse = json_decode($urlJsonData->response);
                    if ($usrData->apiResponse->responseCode == 200) {
                        if (isset($usrData->apiResponse->responseData) & !empty($usrData->apiResponse->responseData)) {
                            $responseData = $usrData->apiResponse->responseData;
                            $usrSessiondata = array(
                                'id' => $responseData->id,
                                'fname' => $responseData->fname,
                                'lname' => $responseData->lname,
                                'email' => $responseData->email,
                                'usr_role' => $responseData->usr_role,
                                'logged_in' => TRUE
                            );
                            /* adding data to session */
                            $this->session->set_userdata('loggedInUsrData', $usrSessiondata);
                        } else {
                            $usrData->apiResponse = '';
                        }
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_40'); /* Login Successfull. */
                        $this->response['redirectUrl'] = base_url();
                        echo json_encode($this->response); exit;
                    } else {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = $urlJsonData->info->http_code;
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13'); /* Password Required. */
                echo json_encode($this->response); exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15'); /* Email Required. */
            echo json_encode($this->response); exit;
        }
    }

    public function usr_logout() {
        try {
            $this->session->unset_userdata('loggedInUsrData');
            $this->session->sess_destroy();
            redirect(base_url());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function matjary_templates() {
        $pageData = array();
        if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
            $pageData['postData'] = $this->input->post();
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
                        $pageData['categoryData'] =  $this->CatModel->category_list();
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
            /* send plan data to template choosing page */
            $this->load->view('choose-template', $pageData);
        } else {
            /* redirect to login page with error msg */
            redirect('login');
        }
    }

    public function save_user_plan() {
        $pageData = array();
        $pageData['post_data'] = $this->input->post();
        if (isset($pageData['post_data']) && !empty($pageData['post_data'])) {
            if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
                /* get plan details */
                $pageData['plan_data'] = $this->CommonModel->get_plan_info($pageData['post_data']['plan_id']);
                $pageData['template_data'] = $this->CommonModel->template_list($pageData['post_data']['template_id']);
                $pageData['countries'] = $this->CommonModel->country_list();
                $pageData['states'] = $this->CommonModel->state_list();

                /* user profile details */
                /* MyAccount -> My Profile */
                $user_profile_details = $this->get_user_profile_details();
                $pageData['user_profile_details1'] = json_decode($user_profile_details, TRUE);
                $pageData['user_profile_details'] = isset($pageData['user_profile_details1']['responseData'][0])?$pageData['user_profile_details1']['responseData'][0]:'';
                //echo '<pre>'; print_r($pageData); exit;
                $userData = json_decode($user_profile_details, TRUE);
                $pageData['user_profile_details'] = $userData['responseData'];
                /* send post data to billing info page */
                $pageData['pageTitle'] = 'storeBillingPage';
                $this->load->view('billing', $pageData);
            } else {
                /* redirect to login page with error msg */
                redirect('login');
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'No data.';
            echo json_encode($this->response);
            exit;
        }
    }

    public function generate_password($password) {
        $encrypted_pass = hash_hmac("SHA256", $password, SECRET_KEY);
        return $encrypted_pass;
    }

    public function user_dashboard() {
        $pageData = array();
        $pageData['countries'] = $this->CommonModel->country_list();
        $pageData['states'] = $this->CommonModel->state_list();
        if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {

            /* get user list of domain / subdomain / store of user logged-in */
            /* MyAccount -> Dashboard */
            $user_domains_details = $this->get_user_domains();
            $usrSitesData = json_decode($user_domains_details, TRUE);
            $pageData['user_domains_details'] = $usrSitesData['responseData'];
            
            /* user profile details */
            /* MyAccount -> My Profile */
            $user_profile_details = $this->get_user_profile_details();
            $usrProfileData = json_decode($user_profile_details,TRUE);
            $pageData['user_profile_details'] = $usrProfileData['responseData'];
            
            /* order history */
            /* MyAccount -> Billing History/Receipts */
            $user_order_details = $this->get_user_order_details();
            $usrOrdersData = json_decode($user_order_details, TRUE);
            $pageData['user_payment_history'] = $usrOrdersData['responseData'];
            
            /* User Store Temaplates */
            /* MyAccount -> Templates Tab */
            $user_store_template_details = $this->UsrModel->user_purchased_templates($this->loggedInUsrData['id']);
            $pageData['user_purchased_templates'] = $user_store_template_details;

            /**Customer Enquiry List */
            $customer_enquiry_details = $this->UsrModel->get_customer_wise_contact_data($this->loggedInUsrData['id']);
            $pageData['EnquiryList'] = $customer_enquiry_details;
            //echo '<pre>'; print_r($pageData['EnquiryList']); die;
            
            $this->load->view('user-dashboard-list', $pageData); /* send data page */
        } else {
            redirect('login'); /* redirect to login page with error msg */
        }
    }

    public function get_user_domains() {
        $usrDomainData = new stdClass();
        $getDomainUrl = base_url('user-domains');
        $requestData = array(
            'user_id' => $this->loggedInUsrData['id'],
            'user_email' => $this->loggedInUsrData['email']
        );
        $header[0] = 'form-data';
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        $urlJsonData = $this->restclient->post($getDomainUrl, $inptData, $header);
        if ($urlJsonData->info->http_code == 200) {
            $usrDomainData->apiResponse = json_decode($urlJsonData->response);
            if ($usrDomainData->apiResponse->responseCode == 200) {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
                $this->response['responseData'] = $usrDomainData->apiResponse->responseData;
            } else {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
            }
            return json_encode($this->response);
        }
    }

    public function get_user_profile_details() {
        $usrDomainData = new stdClass();
        $getUserProfileDetails = base_url('user-profile-details');
        $requestData = array(
            'user_id' => $this->loggedInUsrData['id']
        );
        $header[0] = 'form-data';
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        $urlJsonData = $this->restclient->post($getUserProfileDetails, $inptData, $header);
        if ($urlJsonData->info->http_code == 200) {
            $usrDomainData->apiResponse = json_decode($urlJsonData->response);
            if ($usrDomainData->apiResponse->responseCode == 200) {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
                $this->response['responseData'] = $usrDomainData->apiResponse->responseData;
            } else {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
            }
            return json_encode($this->response);
        }
    }

    public function get_user_order_details() {
        $usrDomainData = new stdClass();
        $getUserOrderDetails = base_url('user-order-details');
        $requestData = array(
            'user_id' => $this->loggedInUsrData['id']
        );
        $header[0] = 'form-data';
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        $urlJsonData = $this->restclient->post($getUserOrderDetails, $inptData, $header);
        if ($urlJsonData->info->http_code == 200) {
            $usrDomainData->apiResponse = json_decode($urlJsonData->response);
            if ($usrDomainData->apiResponse->responseCode == 200) {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
                $this->response['responseData'] = $usrDomainData->apiResponse->responseData;
            } else {
                $this->response['responseCode'] = $usrDomainData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrDomainData->apiResponse->responseMessage;
            }
            return json_encode($this->response);
        }
    }

    public function get_user_store_template_details() {
        $usrTemplateData = new stdClass();
        $getStoreTemplateDetails = base_url('user-store-template-details');
        $requestData = array(
            'user_id' => $this->loggedInUsrData['id']
        );
        $header[0] = 'form-data';
        $urlJsonData = $this->restclient->post($getStoreTemplateDetails, json_encode($requestData), $header);
        if ($urlJsonData->info->http_code == 200) {
            $usrTemplateData->apiResponse = json_decode($urlJsonData->response);
            if ($usrTemplateData->apiResponse->responseCode == 200) {
                $this->response['responseCode'] = $usrTemplateData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrTemplateData->apiResponse->responseMessage;
                $this->response['responseData'] = $usrTemplateData->apiResponse->responseData;
            } else {
                $this->response['responseCode'] = $usrTemplateData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrTemplateData->apiResponse->responseMessage;
                $this->response['responseData'] = $usrTemplateData->apiResponse->responseData;
            }
            return json_encode($this->response);
        }
    }

    public function update_user_profile_form() {
        try {
            if ($this->input->post() != "") {
                $user_id = $this->loggedInUsrData['id'];
                $usrData = new stdClass();
                $saveUsrDetails = base_url('update-user-profile-api');
                $requestData = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'zipcode' => $this->input->post('zipcode'),
                    'phone_no' => $this->input->post('phone_no'),
                    'fax_no' => $this->input->post('fax_no'),
                    'user_id' => $user_id
                );
                $header[0] = 'form-data';
                /* send request to api */
                $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                $urlJsonData = $this->restclient->post($saveUsrDetails, $inptData, $header);
                if ($urlJsonData->info->http_code == 200) {
                    $usrData->apiResponse = json_decode($urlJsonData->response);
                    if ($usrData->apiResponse->responseCode == 200) {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    } else {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    }
                    echo json_encode($this->response);
                    return json_encode($this->response);
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17'); /* First Name is required. */
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_usr_pro_pass_frm() {
        try {
            if ($this->input->post() != "") {
                $user_id = $this->loggedInUsrData['id'];
                /* check if old password entered macthes woth old password is in database */
                $old_pwd_details = $this->get_user_profile_details();
                $old_pwd_details_temp = json_decode($old_pwd_details, TRUE);
                $old_db_pswrd = $old_pwd_details_temp['responseData'][0]['pswrd'];
                $post_old_pswrd = $this->generate_password($this->input->post('old_pass'));
                if ($old_db_pswrd != $post_old_pswrd) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_42'); /* Old Password does not Matched, Please try again */
                    echo json_encode($this->response); exit;
                }
                $usrData = new stdClass();
                $saveUsrPass = base_url('update-usr-pro-pass-api');
                $requestData = array(
                    'old_pass' => $post_old_pswrd,
                    'new_pass' => $this->generate_password($this->input->post('new_pass')),
                    'cnf_pass' => $this->input->post('cnf_pass'),
                    'user_id' => $user_id
                );
                $header[0] = 'form-data';

                /* //send request to api */
                $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                $urlJsonData = $this->restclient->post($saveUsrPass, $inptData, $header);
                if ($urlJsonData->info->http_code == 200) {
                    $usrData->apiResponse = json_decode($urlJsonData->response);
                    if ($usrData->apiResponse->responseCode == 200) {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    } else {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    }
                    echo json_encode($this->response);
                    return json_encode($this->response);
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17'); /* First Name is required. */
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function proceed_payment() {
        $sub_domain_name = $_POST['pd_sub_dom_name'];
        $template_id = $_POST['pd_template_id'];
        $createStoreArg = array(
            'sub_domain_name' => $sub_domain_name,
            'template_id' => $template_id
        );
        $this->session->set_userdata('create_store_arg', $createStoreArg);
        if (isset($_POST['pd_user_id']) && !empty($_POST['pd_user_id'])) {
            if (isset($_POST['pd_plan_id']) && !empty($_POST['pd_plan_id'])) {
                if (isset($_POST['pd_plan_price']) && !empty($_POST['pd_plan_price'])) {
                    if (isset($_POST['pd_plan_months']) && !empty($_POST['pd_plan_months'])) {
                        if (isset($_POST['pd_template_id']) && !empty($_POST['pd_template_id'])) {
                            if (isset($_POST['pd_sub_dom_name']) && !empty($_POST['pd_sub_dom_name'])) {
                                if (isset($_POST['b_fname']) && !empty($_POST['b_fname'])) {
                                    if (isset($_POST['b_lname']) && !empty($_POST['b_lname'])) {
                                        if (isset($_POST['b_email']) && !empty($_POST['b_email'])) {
                                            if (isset($_POST['plan_total_price']) && !empty($_POST['plan_total_price'])) {

                                                $storeUrl = $sub_domain_name . '.matjary.sa';
                                                $store_admin_url = $storeUrl . '/admin';
                                                $plan_months = isset($_POST['pd_plan_months']) ? $_POST['pd_plan_months'] : '';
                                                $today = date('Y-m-d');
                                                $plan_expiry_dt = date('Y-m-d', strtotime("+" . $plan_months . " months", strtotime($today)));
                                                $cust_name = $_POST['b_fname'] . " " . $_POST['b_lname'];
                                                $country_name = $this->CommonModel->country_list($_POST['b_country']);

                                                /* call paymentgate */
                                                /* Paytabs payment url request start */
                                                $unique_order_reference = uniqid();
                                                $cart_amount = isset($_POST['plan_total_price']) ? $_POST['plan_total_price'] : 0;
                                                $cart_description = json_encode($this->input->post());
                                                $paytabsinfo = array();
                                                /* paytabs parameters do not change start */
                                                /* getting paytab configerations */
                                                $data_array =  array(
                                                    "slag" => 'paytab'
                                                );
                                                $make_call = callAPI('POST', 'https://www.matjary.sa/matjary-config', json_encode($data_array));
                                                $paytabConfig = json_decode($make_call, true);
                                                $paytabsinfo['profile_id'] = $paytabConfig['responseData']['paytab_profile_id_test'];
                                                $paytabsinfo['tran_type'] = 'sale';
                                                $paytabsinfo['tran_class'] = 'ecom';
                                                $paytabsinfo['cart_id'] = $unique_order_reference;
                                                $paytabsinfo['cart_currency'] = $paytabConfig['responseData']['paytab_currency'];
                                                $paytabsinfo['cart_amount'] = $cart_amount;
                                                $paytabsinfo['cart_description'] = $cart_description;
                                                $paytabsinfo['customer_details'] = array(
                                                    "name" => isset($cust_name) ? $cust_name : '',
                                                    "email" => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                                                    "phone" => isset($_POST['b_tel']) ? $_POST['b_tel'] : '',
                                                    "street1" => isset($_POST['b_address']) ? $_POST['b_address'] : '',
                                                    "city" => isset($_POST['b_city']) ? $_POST['b_city'] : '',
                                                    "state" => isset($_POST['b_state']) ? $_POST['b_state'] : '',
                                                    "country" => isset($country_name) ? $country_name[0]['name'] : '',
                                                    "zip" => isset($_POST['b_zipcode']) ? $_POST['b_zipcode'] : ''
                                                );
                                                $paytabsinfo['callback'] = base_url() . "order-status";
                                                $paytabsinfo['return'] = base_url() . "order-status";
                                                $paytabsinfo['hide_shipping'] = true;
                                                $paytabsinfo['tokenise'] = '2';
                                                $paytabsinfo['show_save_card'] = false;
                                                /* paytabs parameters do not change start */
                                                $paytabsinfo_req = json_encode($paytabsinfo);
                                                $paytabs_url = $paytabConfig['responseData']['paytab_call_url'];
                                                $paytabs_apikey = $paytabConfig['responseData']['paytab_test_apikey'];

                                                $paytabs_headr = array();
                                                $paytabs_headr[] = 'Content-Type: application/json';
                                                $paytabs_headr[] = 'Authorization: ' . $paytabs_apikey;
                                                $ch_p = curl_init();
                                                curl_setopt($ch_p, CURLOPT_URL, $paytabs_url);
                                                curl_setopt($ch_p, CURLOPT_POST, true);
                                                curl_setopt($ch_p, CURLOPT_POSTFIELDS, $paytabsinfo_req);
                                                curl_setopt($ch_p, CURLOPT_HTTPHEADER, $paytabs_headr);
                                                curl_setopt($ch_p, CURLOPT_RETURNTRANSFER, true);
                                                curl_setopt($ch_p, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

                                                $paytabs_response = curl_exec($ch_p); /* Send request. */
                                                if (curl_errno($ch_p)) {
                                                    $this->response['responseCode'] = 404;
                                                    $this->response['responseMessage'] = curl_error($ch_p);
                                                    echo json_encode($this->response);
                                                }
                                                curl_close($ch_p);
                                                $paytabs_response_temp = json_decode($paytabs_response, true);
                                                /* Paytabs payment url request start */
                                                /* adding session language element in payment gateway response into pg_req in jsone object */
                                                $paytabs_response_temp['site_lang'] = $this->session->userdata('site_lang');
                                                $paytabs_response = json_encode($paytabs_response_temp);
                                                if ($paytabs_response) {
                                                    /* save data */
                                                    $store_utkn = store_utkn();
                                                    $usrSbcrptnData = new stdClass();
                                                    $saveUsrSbcrptnUlr = base_url('save-usr-subscription');
                                                    $requestData = array(
                                                        'user_id' => isset($_POST['pd_user_id']) ? $_POST['pd_user_id'] : '',
                                                        'plan_id' => isset($_POST['pd_plan_id']) ? $_POST['pd_plan_id'] : '',
                                                        'plan_month' => $plan_months,
                                                        'plan_start_dt' => $today,
                                                        'plan_expiry_dt' => $plan_expiry_dt,
                                                        'template_id' => isset($_POST['pd_template_id']) ? $_POST['pd_template_id'] : '',
                                                        'sub_domain_name' => isset($_POST['pd_sub_dom_name']) ? $_POST['pd_sub_dom_name'] : '',
                                                        'user_email' => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                                                        'store_tkn' => $store_utkn,
                                                        'store_link' => $storeUrl,
                                                        'store_admin_link' => $store_admin_url,
                                                        'subscription_type' => 2,
                                                        'is_active' => 3,
                                                        'b_fname' => isset($_POST['b_fname']) ? $_POST['b_fname'] : '',
                                                        'b_lname' => isset($_POST['b_lname']) ? $_POST['b_lname'] : '',
                                                        'b_email' => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                                                        'b_tel' => isset($_POST['b_tel']) ? $_POST['b_tel'] : '',
                                                        'b_address' => isset($_POST['b_address']) ? $_POST['b_address'] : '',
                                                        'b_country' => isset($_POST['b_country']) ? $_POST['b_country'] : '',
                                                        'b_city' => isset($_POST['b_city']) ? $_POST['b_city'] : '',
                                                        'b_state' => isset($_POST['b_state']) ? $_POST['b_state'] : '',
                                                        'b_zipcode' => isset($_POST['b_zipcode']) ? $_POST['b_zipcode'] : '',
                                                        'is_coupon_applied' => isset($_POST['is_coupon_applied']) ? $_POST['is_coupon_applied'] : 0,
                                                        'coupon_id' => isset($_POST['coupon_id']) ? $_POST['coupon_id'] : 0,
                                                        'coupon_amount' => isset($_POST['coupon_amount']) ? $_POST['coupon_amount'] : 0.00,
                                                        'plan_cost' => isset($_POST['pd_plan_price']) ? $_POST['pd_plan_price'] : '',
                                                        'template_cost' => isset($_POST['pd_template_price']) ? $_POST['pd_template_price'] : '',
                                                        'plan_total_price' => isset($_POST['plan_total_price']) ? $_POST['plan_total_price'] : '',
                                                        'pg_req' => $paytabs_response,
                                                        'cartId' => $paytabs_response_temp['cart_id'],
                                                        'tranRef' => $paytabs_response_temp['tran_ref'],
                                                        'pg_id' => 1, /* 1 => paytabs */
                                                        'payment_type' => 1 /* 1=> Online Payment, 2=> GIftcars, 3=>COD */
                                                    );
                                                    $header[0] = 'form-data';
                                                    $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                                                    $urlJsonData = $this->restclient->post($saveUsrSbcrptnUlr, $inptData, $header);
                                                    if ($urlJsonData->info->http_code == 200) {
                                                        $usrSbcrptnData->apiResponse = json_decode($urlJsonData->response);
                                                        if ($usrSbcrptnData->apiResponse->responseCode == 200) {
                                                            $this->response['responseCode'] = '200';
                                                            $this->response['responseMessage'] = 'Please Hold While you are redirected to Payment Gateway';
                                                            $this->response['redirectUrl'] = $paytabs_response_temp['redirect_url']; /* redirect to payment url */
                                                            echo json_encode($this->response); exit;
                                                        } else {
                                                            $this->response['responseCode'] = $usrSbcrptnData->apiResponse->responseCode;
                                                            $this->response['responseMessage'] = $usrSbcrptnData->apiResponse->responseMessage;
                                                            echo json_encode($this->response); exit;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $this->response['responseCode'] = 404;
                                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_43');
                                                echo json_encode($this->response); exit;
                                            }
                                        } else {
                                            $this->response['responseCode'] = 404;
                                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                                            echo json_encode($this->response); exit;
                                        }
                                    } else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_16');
                                        echo json_encode($this->response); exit;
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17');
                                    echo json_encode($this->response); exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_31');
                                echo json_encode($this->response); exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_32');
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_33');
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_43');
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_33');
                echo json_encode($this->response); exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_22');
            echo json_encode($this->response); exit;
        }
    }

    public function pg_response() {
        /* this function is call by payment to send response */
        try {
            if ($this->input->post() != "") {
                $pg_reponse = $this->input->post();
                if (!isset($pg_reponse) && empty($pg_reponse)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Payment Gateway Response is Empty.';
                    echo json_encode($this->response); exit;
                }else{
                    /* get payment gateway request for getting previous language version before payment gateway redirect page */
                    $userPaymentInfo = $this->UsrModel->get_user_payment_info($pg_reponse['cartId'], $pg_reponse['tranRef']);
                    if(isset($userPaymentInfo) && !empty($userPaymentInfo)){
                        /* updating pg response to tables start  */
                        $usrData = new stdClass();
                        $updateUserPaymentInfo = base_url('update-pg-res-api');
                        $pg_requestData = array(
                            'pg_req' => isset($userPaymentInfo->pg_req)?$userPaymentInfo->pg_req:'',
                            'pg_res' => json_encode($pg_reponse),
                            'customerEmail' => isset($pg_reponse['customerEmail'])?$pg_reponse['customerEmail']:'',
                            'tranRef' => isset($pg_reponse['tranRef'])?$pg_reponse['tranRef']:'',
                            'cartId' => isset($pg_reponse['cartId'])?$pg_reponse['cartId']:''
                        );
                        /* If payment is success hit store creation api */
                        if ($pg_reponse['respStatus'] == 'A') { /* Authorized - Payment successful */
                            $orderMessage = 'Payment Success';
                            $pg_requestData['payment_status'] = 1;
                            $pg_requestData['is_active'] = 1;
                        }elseif ($pg_reponse['respStatus'] == 'C') { /* Payment Cancelled */
                            $orderMessage = $this->lang->line('pay_res_1');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        } elseif ($pg_reponse['respStatus'] == 'H') { /* Hold (Authorised but on hold for further anti-fraud review) */
                            $orderMessage = $this->lang->line('pay_res_2');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        } elseif ($pg_reponse['respStatus'] == 'P') { /* Pending (for refunds) */
                            $orderMessage = $this->lang->line('pay_res_3');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        } elseif ($pg_reponse['respStatus'] == 'V') { /* Voided */
                            $orderMessage = $this->lang->line('pay_res_4');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        } elseif ($pg_reponse['respStatus'] == 'E') { /* Error */
                            $orderMessage = $this->lang->line('pay_res_5');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        } elseif ($pg_reponse['respStatus'] == 'D') { /* Declined */
                            $orderMessage = $this->lang->line('pay_res_6');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        }elseif ($pg_reponse['respStatus'] == 'X') { /* Expired */
                            $orderMessage = $this->lang->line('pay_res_6');
                            $pg_requestData['payment_status'] = 2;
                            $pg_requestData['is_active'] = 3;
                        }
                        $header[0] = 'form-data';
                        $inptData['token'] = JWT::encode($pg_requestData, JWT_TOKEN);
                        $urlJsonData = $this->restclient->post($updateUserPaymentInfo, $inptData, $header);
                        /* updating pg response to tables end */
                        if ($urlJsonData->info->http_code == 200) {
                            $usrData->apiResponse = json_decode($urlJsonData->response);
                            if ($usrData->apiResponse->responseCode == 200) {

                                /* set session language  start */
                                $pg_req = json_decode($usrData->apiResponse->responseData->pg_req,true);
                                $site_lang = $pg_req['site_lang'];
                                $this->session->set_userdata('site_lang', $site_lang);
                                /* set session language  end */
                                $post_page_data = array(
                                    'pg_req' => isset($userPaymentInfo->pg_req)?$userPaymentInfo->pg_req:'',
                                    'pg_respMessage' => $pg_reponse['respMessage'],
                                    'pg_respStatus' => $pg_reponse['respStatus'],
                                    'user_id' => $userPaymentInfo->customer_id,
                                    'template_id' => $userPaymentInfo->template_id,
                                    'store_sub_domain' => $userPaymentInfo->store_sub_domain,
                                    'store_link' => $userPaymentInfo->store_link,
                                    'store_admin_link' => $userPaymentInfo->store_admin_link,
                                    'store_tkn' => $userPaymentInfo->store_tkn,
                                    'payment_type' => $userPaymentInfo->payment_type,
                                    'total_price' => $userPaymentInfo->total_price,
                                    'order_id' => $userPaymentInfo->id,
                                    'tranRef' => $userPaymentInfo->tranRef,
                                    'cartId' => $userPaymentInfo->cartId,
                                    'email' => $userPaymentInfo->user_email,
                                    'info_msg' => $orderMessage
                                );
                                $pg_reponse_data['token'] = JWT::encode($post_page_data, JWT_TOKEN);
                                redirect('store-details/' . $pg_reponse_data['token']); /* Redirect to store creation page */
                            } else {
                                $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                                $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                                echo json_encode($this->response); exit;
                            }
                        }else{
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Something Went Wrong While Updating Payment Information.';
                            echo json_encode($this->response); exit;
                        }
                    }else{
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'No Record Found.';
                        echo json_encode($this->response); exit;
                    }
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store_details_cont() {
        $decode_data = (array) JWT::decode($this->uri->segment(2), JWT_TOKEN);
        $decode_data['form_token'] = $this->uri->segment(2);
        $decode_data['pageTitle'] = 'storeDetailsPage';
        /* setting user session */
        $user_id = $decode_data['user_id'];
        $usrData_temp = $this->UsrModel->user_profile_details($user_id);
        $usrSessiondata = array(
            'id' => $usrData_temp->id,
            'fname' => $usrData_temp->fname,
            'lname' => $usrData_temp->lname,
            'email' => $usrData_temp->email,
            'logged_in' => TRUE,
            'free_trial_tkn' => $usrData->apiResponse->responseData
        );
        $this->session->set_userdata('loggedInUsrData', $usrSessiondata);
        /* setting user session end */
        
        if (isset($decode_data['free_trail_true']) && !empty($decode_data['free_trail_true'] && $decode_data['free_trail_true'] == 1)) {
            $view_file = 'creating-store-free-trial';
        } else {
            $view_file = 'creating-store';
        }
        $this->load->view($view_file, $decode_data);
    }

    public function create_store_con() {
        $create_store_tkn = $this->input->post('create_store_tkn');
        if (isset($create_store_tkn) && !empty($create_store_tkn)) {
            $decode_data = (array) JWT::decode($create_store_tkn, JWT_TOKEN);
            if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
                $email = $this->loggedInUsrData['email'];
            } else {
                $email = $decode_data['email'];
            }
            $storeData = new stdClass();
            $saveUsrPass = base_url('create-store-api');
            $requestData = array(
                'store_sub_domain' => $decode_data['store_sub_domain'],
                'store_link' => $decode_data['store_link'],
                'template_id' => $decode_data['template_id'],
                'tranRef' => $decode_data['tranRef'],
                'cartId' => $decode_data['cartId'],
                'store_tkn' => $decode_data['store_tkn'],
                'email' => $email,
                'free_trail_true' => isset($decode_data['free_trail_true']) ? $decode_data['free_trail_true'] : '',
            );
            $header[0] = 'form-data';
            /* send request to api */
            $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
            $urlJsonData = $this->restclient->post($saveUsrPass, $inptData, $header);
            if ($urlJsonData->info->http_code == 200) {
                $storeData->apiResponse = json_decode($urlJsonData->response);
                if ($storeData->apiResponse->responseCode == 200) {
                    $this->response['responseCode'] = $storeData->apiResponse->responseCode;
                    $this->response['responseMessage'] = $storeData->apiResponse->responseMessage;
                    $this->response['responseData'] = $storeData->apiResponse->responseData;
                } else {
                    $this->response['responseCode'] = $storeData->apiResponse->responseCode;
                    $this->response['responseMessage'] = $storeData->apiResponse->responseMessage;
                    $this->response['responseData'] = $storeData->apiResponse->responseData;
                }
                echo json_encode($this->response); exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
            echo json_encode($this->response); exit;
        }
    }

    public function free_trial_store() {
        $pageData = array();
        /* session check for user login */
        if ($this->session->userdata('loggedInUsrData')) {
            $pageData['usr_data'] = $this->session->userdata('loggedInUsrData');
            /* check if user has created free store once start */
            $usrTempData = $this->UsrModel->user_profile_details($pageData['usr_data']['id']);
            $pageData['free_store_created_flag'] = $usrTempData->is_free_trail_store_used;
            /* check if user has created free store once end */
            if ($pageData['usr_data']['free_trial_tkn'] != '') {
                $temp_seg = (array) JWT::decode($pageData['usr_data']['free_trial_tkn'], JWT_TOKEN);
                $pageData['domain'] = $temp_seg['domain'];
                $pageData['free_trial_tkn'] = $pageData['usr_data']['free_trial_tkn'];
            } else {
                $responseData_temp = array(
                    'user_id' => $pageData['usr_data']['id'],
                    'email' => $pageData['usr_data']['email'],
                    'domain' => ''
                );
                $inptData_send = JWT::encode($responseData_temp, JWT_TOKEN);
                $pageData['free_trial_tkn'] = $inptData_send;
            }
        }
        $this->load->view('free-trial', $pageData);
    }

    public function free_trial_form() {
        try {
            if ($this->session->userdata('loggedInUsrData')) {
                /* Registered user free trail start */
                $free_trial_domain = $this->input->post('free_trial_domain');
                if (empty($free_trial_domain)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_31');
                    echo json_encode($this->response); exit;
                }
                if (isset($free_trial_domain) && !empty($free_trial_domain)) {
                    /* check domain availablilty start */
                    $storeData_1 = new stdClass();
                    $saveUsrPass = base_url('check-subdomain-availability');
                    $requestData = array(
                        'sub_domain_name' => $free_trial_domain
                    );
                    $header[0] = 'form-data';
                    $urlJsonData_1 = $this->restclient->post($saveUsrPass, $requestData, $header);

                    if ($urlJsonData_1->info->http_code == 200) {
                        $storeData_1->apiResponse = json_decode($urlJsonData_1->response);
                        if ($storeData_1->apiResponse->responseCode == 200) {
                            $this->response['responseCode'] = $storeData_1->apiResponse->responseCode;
                            $this->response['responseMessage'] = $storeData_1->apiResponse->responseMessage;
                            $this->response['responseData'] = $storeData_1->apiResponse->responseData;
                        } else {
                            $this->response['responseCode'] = $storeData_1->apiResponse->responseCode;
                            $this->response['responseMessage'] = $storeData_1->apiResponse->responseMessage;
                            $this->response['responseData'] = $storeData_1->apiResponse->responseData;
                        }
                        echo json_encode($this->response); exit;
                    }
                }
                /* Registered user free trail end */
            } else {
                /* New user free trail flow start */
                if (isset($_POST['fname']) & !empty($_POST['fname'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['fname'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2');
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['lname']) & !empty($_POST['lname'])) {
                        if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['lname'])) {
                            /* one or more of the 'special characters' found in string */
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3');
                            echo json_encode($this->response); exit;
                        }
                        if (isset($_POST['email']) & !empty($_POST['email'])) {
                            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                                echo json_encode($this->response); exit;
                            }
                            if (isset($_POST['phone_no']) & !empty($_POST['phone_no'])) {
                                if (!preg_match("/^\\+?[1-9][0-9]{7,14}$/", $_POST['phone_no'])) {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                    echo json_encode($this->response); exit;
                                }
                                if (isset($_POST['password']) & !empty($_POST['password'])) {
                                    if (isset($_POST['passconf']) & !empty($_POST['passconf'])) {
                                        if (trim($_POST['password'], ' ') != trim($_POST['passconf'], ' ')) {
                                            $this->response['responseCode'] = 404;
                                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_5');
                                            echo json_encode($this->response); exit;
                                        }
                                        $usrData = new stdClass();
                                        $saveUsrUlr = base_url('save-usr');
                                        $requestData = array(
                                            'fname' => isset($_POST['fname']) ? $_POST['fname'] : '',
                                            'lname' => isset($_POST['lname']) ? $_POST['lname'] : '',
                                            'email' => isset($_POST['email']) ? $_POST['email'] : '',
                                            'phone_no' => isset($_POST['phone_no']) ? $_POST['phone_no'] : '',
                                            'password' => isset($_POST['password']) ? $_POST['password'] : '',
                                            'passconf' => isset($_POST['passconf']) ? $_POST['passconf'] : '',
                                            'free_trial_domain' => isset($_POST['free_trial_domain']) ? $_POST['free_trial_domain'] : ''
                                        );
                                        $header[0] = 'form-data';
                                        /* send request to api */
                                        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                                        $urlJsonData = $this->restclient->post($saveUsrUlr, $inptData, $header);
                                        if ($urlJsonData->info->http_code == 200) {
                                            $usrData->apiResponse = json_decode($urlJsonData->response);
                                            if ($usrData->apiResponse->responseCode == 200) {
                                                $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                                                $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                                                $this->response['redirectUrl'] = base_url('free-trial-store');
                                                $decode_temp = (array) JWT::decode($usrData->apiResponse->responseData, JWT_TOKEN);
                                                /* setting user session start */
                                                $user_id = $decode_temp['user_id'];
                                                $usrData_temp = $this->UsrModel->user_profile_details($user_id);
                                                $usrSessiondata = array(
                                                    'id' => $usrData_temp->id,
                                                    'fname' => $usrData_temp->fname,
                                                    'lname' => $usrData_temp->lname,
                                                    'email' => $usrData_temp->email,
                                                    'logged_in' => TRUE,
                                                    'free_trial_tkn' => $usrData->apiResponse->responseData
                                                );
                                                $this->session->set_userdata('loggedInUsrData', $usrSessiondata);
                                                /* setting user session end */
                                                echo json_encode($this->response); exit;
                                            } else {                                                
                                                $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                                                $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                                                echo json_encode($this->response); exit;
                                            }
                                        }
                                    } else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_12');
                                        echo json_encode($this->response); exit;
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13');
                                    echo json_encode($this->response); exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                echo json_encode($this->response); exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_16');
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17');
                    echo json_encode($this->response); exit;
                }
                /* New user free trail flow end */
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create_free_trial_store() {
        $usr_sess = $this->session->userdata('loggedInUsrData');
        $tranRef = random_alpha_num(8);
        $cartId = random_alpha_num(4);
        /* save info user */
        $storeUrl = $_POST['sub_domain_name'] . '.matjary.sa';
        $store_admin_url = $storeUrl . '/admin';
        $plan_months = FREE_TRIAL_VALIDITY;
        $today = date('Y-m-d');
        $plan_expiry_dt = date('Y-m-d', strtotime("+" . $plan_months . " days", strtotime($today)));
        $store_utkn = store_utkn();
        $usrTrialStore = new stdClass();
        $saveUsrSbcrptnUlr = base_url('save-usr-subscription');
        $requestData = array(
            'user_id' => isset($usr_sess['id']) ? $usr_sess['id'] : '',
            'plan_id' => FREE_TRIAL_PLAN_ID,
            'plan_month' => $plan_months,
            'plan_start_dt' => $today,
            'plan_expiry_dt' => $plan_expiry_dt,
            'template_id' => DEFAULT_FREE_TRIAL_TEMPLATE_ID,
            'sub_domain_name' => isset($_POST['sub_domain_name']) ? $_POST['sub_domain_name'] : '',
            'user_email' => isset($usr_sess['email']) ? $usr_sess['email'] : '',
            'store_tkn' => $store_utkn,
            'store_link' => $storeUrl,
            'store_admin_link' => $store_admin_url,
            'subscription_type' => 1,
            'is_active' => 1,
            'b_fname' => isset($usr_sess['fname']) ? $usr_sess['fname'] : '',
            'b_lname' => isset($usr_sess['lname']) ? $usr_sess['lname'] : '',
            'b_email' => isset($usr_sess['email']) ? $usr_sess['email'] : '',
            'b_tel' => isset($_POST['b_tel']) ? $_POST['b_tel'] : '',
            'b_address' => isset($_POST['b_address']) ? $_POST['b_address'] : '',
            'b_country' => isset($_POST['b_country']) ? $_POST['b_country'] : '',
            'b_city' => isset($_POST['b_city']) ? $_POST['b_city'] : '',
            'b_state' => isset($_POST['b_state']) ? $_POST['b_state'] : '',
            'b_zipcode' => isset($_POST['b_zipcode']) ? $_POST['b_zipcode'] : '',
            'plan_total_price' => isset($_POST['plan_total_price']) ? $_POST['plan_total_price'] : '',
            'pg_req' => '',
            'cartId' => $cartId,
            'tranRef' => $tranRef,
            'pg_id' => '0', /* free-trial-pg */
            'payment_type' => '0' /* free-trial-payment */
        );
        $header[0] = 'form-data';
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        $urlJsonData = $this->restclient->post($saveUsrSbcrptnUlr, $inptData, $header);
        if ($urlJsonData->info->http_code == 200) {
            $usrTrialStore->apiResponse = json_decode($urlJsonData->response);
            if ($usrTrialStore->apiResponse->responseCode == 200) {
                /* payment failed due to any reason */
                $post_page_data = array(
                    'pg_respMessage' => 'Authorised',
                    'pg_respStatus' => '',
                    'user_id' => isset($usr_sess['id']) ? $usr_sess['id'] : '',
                    'template_id' => DEFAULT_FREE_TRIAL_TEMPLATE_ID,
                    'store_sub_domain' => isset($_POST['sub_domain_name']) ? $_POST['sub_domain_name'] : '',
                    'store_link' => $storeUrl,
                    'store_admin_link' => $store_admin_url,
                    'store_tkn' => $store_utkn,
                    'payment_type' => '0', /* free-trial-payment */
                    'total_price' => '',
                    'order_id' => $usrTrialStore->apiResponse->responseData,
                    'cartId' => $cartId,
                    'tranRef' => $tranRef,
                    'email' => isset($usr_sess['email']) ? $usr_sess['email'] : '',
                    'info_msg' => 'Free Trail Store Under Process',
                    'free_trail_true' => 1
                );
                $pg_reponse_data['token'] = JWT::encode($post_page_data, JWT_TOKEN);
                $this->response['responseCode'] = $usrTrialStore->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrTrialStore->apiResponse->responseMessage;
                $this->response['redirectUrl'] = 'free-trail-store-details/' . $pg_reponse_data['token'];
            } else {
                $this->response['responseCode'] = $usrTrialStore->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrTrialStore->apiResponse->responseMessage;
            }
            echo json_encode($this->response); exit;
        }
    }

    public function send_reset_password_link() {
        try {
            if ($this->input->post() != "") {
                $reset_pwd_email = $this->input->post('reset_pwd_email');
                $usrEmail = new stdClass();
                $getDetails = base_url('send-reset-password-link-api');
                $requestData = array(
                    'reset_pwd_email' => $reset_pwd_email
                );
                $header[0] = 'form-data';
                $urlJsonData = $this->restclient->post($getDetails, json_encode($requestData), $header);
                if ($urlJsonData->info->http_code == 200) {
                    $usrEmail->apiResponse = json_decode($urlJsonData->response);
                    if ($usrEmail->apiResponse->responseCode == 200) {
                        $this->response['responseCode'] = $usrEmail->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrEmail->apiResponse->responseMessage;
                    } else {
                        $this->response['responseCode'] = $usrEmail->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrEmail->apiResponse->responseMessage;
                    }
                    echo json_encode($this->response); exit;
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function set_usr_reset_password() {
        try {
            if ($this->input->post() != "") {
                $pwd_tkn = $this->input->post('pwd_tkn');
                $new_pwd = $this->input->post('cnf_new_rst_pwd');
                
                if (isset($pwd_tkn) && !empty($pwd_tkn)) {
                    $usrData_temp = new stdClass();
                    $saveUsrPass = base_url('set-usr-reset-password-api');
                    $requestData = array(
                        'cnf_new_rst_pwd' => $new_pwd,
                        'new_pwd_tkn' => $pwd_tkn
                    );
                    
                    $header[0] = 'form-data';
                    /* send request to api */
                    $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                    $urlJsonData = $this->restclient->post($saveUsrPass, $inptData, $header);
                    if ($urlJsonData->info->http_code == 200) {
                        $usrData_temp->apiResponse = json_decode($urlJsonData->response);
                        if ($usrData_temp->apiResponse->responseCode == 200) {
                            $this->response['responseCode'] = $usrData_temp->apiResponse->responseCode;
                            $this->response['responseMessage'] = $usrData_temp->apiResponse->responseMessage;
                            echo json_encode($this->response); exit;
                        } else {
                            $this->response['responseCode'] = $usrData_temp->apiResponse->responseCode;
                            $this->response['responseMessage'] = $usrData_temp->apiResponse->responseMessage;
                            echo json_encode($this->response); exit;
                        }
                    } else {
                        $this->response['responseCode'] = $usrData_temp->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData_temp->apiResponse->responseMessage;
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = $usrData_temp->apiResponse->responseCode;
                    $this->response['responseMessage'] = 'tkn Mising';
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = $usrData_temp->apiResponse->responseCode;
                $this->response['responseMessage'] = 'No Post Data';
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function buy_template() {
        $pageData = array();
        if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
            $pageData['countries'] = $this->CommonModel->country_list();
            $id = $this->input->get('buy');
            $template_id = decryptCode($id, ENCRYPT_URL_DATA_KEY);
            $usrTempData_tmp = $this->CommonModel->template_list($template_id);
            $usrTempData = json_decode(json_encode($usrTempData_tmp), true);
            $pageData['template_data'] = array(
                'user_id' => $this->loggedInUsrData['id'],
                'name' => $usrTempData['name'],
                'template_id' => $template_id,
                'name_ar' => $usrTempData['name_ar'],
                'free_paid_flag' => $usrTempData['free_paid_flag'],
                'template_cost' => $usrTempData['template_cost']
            );
            $user_profile_details = $this->get_user_profile_details();
            $userData = json_decode($user_profile_details, TRUE);
            $pageData['user_profile_details'] = $userData['responseData'];
            /* session check for user login */
            $pageData['site_lang'] = 'ar';
            if ($this->session->userdata('site_lang')) {
                $pageData['site_lang'] = $this->session->userdata('site_lang');
            }
            /* send plan data to template choosing page */
            $this->load->view('buy-template', $pageData);
        } else {
            redirect('login');
        }
    }

    public function proceed_template_payment() {
        try {
            if ($this->input->post() != "") {
                $user_id = $this->loggedInUsrData['id'];

                $country_name = $this->CommonModel->country_list($_POST['b_country']);
                $state_name = $this->CommonModel->state_list($_POST['b_state']);
                $city_name = $this->CommonModel->city_list($_POST['b_city']);

                /* call paymentgate */
                /* Paytabs payment url request start */
                $unique_order_reference = uniqid();
                $cart_amount = isset($_POST['template_cost']) ? $_POST['template_cost'] : 0;
                $cust_name = $_POST['b_fname'].' '.$_POST['b_lname'];
                $cart_description = json_encode($this->input->post());
                $paytabsinfo = array();
                /* paytabs parameters do not change start */
                /* getting paytab configerations */
                $data_array =  array(
                    "slag" => 'paytab'
                );
                $make_call = callAPI('POST', 'https://www.matjary.sa/matjary-config', json_encode($data_array));
                $paytabConfig = json_decode($make_call, true);
                $paytabsinfo['profile_id'] = $paytabConfig['responseData']['paytab_profile_id_test'];
                $paytabsinfo['tran_type'] = 'sale';
                $paytabsinfo['tran_class'] = 'ecom';
                $paytabsinfo['cart_id'] = $unique_order_reference;
                $paytabsinfo['cart_currency'] = $paytabConfig['responseData']['paytab_currency'];
                $paytabsinfo['cart_amount'] = $cart_amount;
                $paytabsinfo['cart_description'] = $cart_description;
                $paytabsinfo['customer_details'] = array(
                    "name" => isset($cust_name) ? $cust_name : '',
                    "email" => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                    "phone" => isset($_POST['b_tel']) ? $_POST['b_tel'] : '',
                    "street1" => isset($_POST['b_address']) ? $_POST['b_address'] : '',
                    "city" => isset($city_name) ? $city_name[0]['name'] : '',
                    "state" => isset($state_name) ? $state_name[0]['name'] : '',
                    "country" => isset($country_name) ? $country_name[0]['name'] : '',
                    "zip" => isset($_POST['b_zipcode']) ? $_POST['b_zipcode'] : '',
                );
                $paytabsinfo['callback'] = base_url() . "template-order-status";
                $paytabsinfo['return'] = base_url() . "template-order-status";
                $paytabsinfo['hide_shipping'] = true;
                $paytabsinfo['tokenise'] = '2';
                $paytabsinfo['show_save_card'] = false;
                /* paytabs parameters do not change start */
                $paytabsinfo_req = json_encode($paytabsinfo);
                $paytabs_url = $paytabConfig['responseData']['paytab_call_url'];
                $paytabs_apikey = $paytabConfig['responseData']['paytab_test_apikey'];

                $paytabs_headr = array();
                $paytabs_headr[] = 'Content-Type: application/json';
                $paytabs_headr[] = 'Authorization: ' . $paytabs_apikey;
                $ch_p = curl_init();
                curl_setopt($ch_p, CURLOPT_URL, $paytabs_url);
                curl_setopt($ch_p, CURLOPT_POST, true);
                curl_setopt($ch_p, CURLOPT_POSTFIELDS, $paytabsinfo_req);
                curl_setopt($ch_p, CURLOPT_HTTPHEADER, $paytabs_headr);
                curl_setopt($ch_p, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch_p, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                $paytabs_response = curl_exec($ch_p); /* Send request. */
                if (curl_errno($ch_p)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = curl_error($ch_p);
                    echo json_encode($this->response);
                }
                curl_close($ch_p);
                $paytabs_response_temp = json_decode($paytabs_response, true);
                /* adding session language element in payment gateway response jsone object */
                $paytabs_response_temp['site_lang'] = $this->session->userdata('site_lang');
                $paytabs_response = json_encode($paytabs_response_temp);
                /* Paytabs payment url request end */
                /* redirect to payment url */
                if ($paytabs_response) {
                    
                    /* save data */
                    $store_utkn = store_utkn();
                    $usrSbcrptnData = new stdClass();
                    $saveUsrSbcrptnUlr = base_url('save-template-subscription');
                    $requestData = array(
                        'user_id' => isset($user_id) ? $user_id : '',
                        'template_id' => isset($_POST['template_id']) ? $_POST['template_id'] : '',
                        'user_email' => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                        'store_tkn' => $store_utkn,
                        'is_active' => 3,
                        'b_fname' => isset($_POST['b_fname']) ? $_POST['b_fname'] : '',
                        'b_lname' => isset($_POST['b_lname']) ? $_POST['b_lname'] : '',
                        'b_email' => isset($_POST['b_email']) ? $_POST['b_email'] : '',
                        'b_tel' => isset($_POST['b_tel']) ? $_POST['b_tel'] : '',
                        'b_address' => isset($_POST['b_address']) ? $_POST['b_address'] : '',
                        'b_country' => isset($_POST['b_country']) ? $_POST['b_country'] : '',
                        'b_city' => isset($_POST['b_city']) ? $_POST['b_city'] : '',
                        'b_state' => isset($_POST['b_state']) ? $_POST['b_state'] : '',
                        'b_zipcode' => isset($_POST['b_zipcode']) ? $_POST['b_zipcode'] : '',
                        'is_coupon_applied' => isset($_POST['is_coupon_applied']) ? $_POST['is_coupon_applied'] : 0,
                        'coupon_id' => isset($_POST['coupon_id']) ? $_POST['coupon_id'] : 0,
                        'coupon_amount' => isset($_POST['coupon_amount']) ? $_POST['coupon_amount'] : 0.00,
                        'template_cost' => isset($_POST['template_cost']) ? $_POST['template_cost'] : '',
                        'total_price' => isset($_POST['plan_total_price']) ? $_POST['plan_total_price'] : '',
                        'pg_req' => $paytabs_response,
                        'cartId' => $paytabs_response_temp['cart_id'],
                        'tranRef' => $paytabs_response_temp['tran_ref'],
                        'pg_id' => 1, /* //1 => paytabs */
                        'payment_type' => 1 /* /1=> Online Payment, 2=> GIftcars, 3=>COD */
                    );
                    $header[0] = 'form-data';
                    $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
                    $urlJsonData = $this->restclient->post($saveUsrSbcrptnUlr, $inptData, $header);
                    if ($urlJsonData->info->http_code == 200) {
                        $usrSbcrptnData->apiResponse = json_decode($urlJsonData->response);

                        if ($usrSbcrptnData->apiResponse->responseCode == 200) {

                            $this->response['responseCode'] = '200';
                            $this->response['responseMessage'] = 'Please Hold While you are redirected to Payment Gateway';
                            $this->response['redirectUrl'] = $paytabs_response_temp['redirect_url'];
                            echo json_encode($this->response);
                            exit;
                        } else {
                            $this->response['responseCode'] = $usrSbcrptnData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $usrSbcrptnData->apiResponse->responseMessage;
                            echo json_encode($this->response);
                            exit;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function template_pg_response() {
        /* this function is call by payment to send response for template purchase */
        try {
            if ($this->input->post() != "") {
                $pg_reponse = $this->input->post();
                if (!empty($pg_reponse)) {
                    /*
                     * updating pg response to tables start 
                     * 
                     * on all cases 
                     * - Success
                     * - Cancelled
                     * - Pending or no respons
                    */
                    $usrData = new stdClass();
                    $updateUserPaymentInfo = base_url('update-pg-res-api');
                    $pg_requestData = array(
                        'pg_res' => json_encode($pg_reponse),
                        'customerEmail' => $pg_reponse['customerEmail'],
                        'tranRef' => $pg_reponse['tranRef'],
                        'cartId' => $pg_reponse['cartId']
                    );
                    if ($pg_reponse['respStatus'] == 'A') { /* Payment successful */
                        $pg_requestData['payment_status'] = 1; 
                        $pg_requestData['is_active'] = 1;
                    }elseif ($pg_reponse['respStatus'] == 'C') { /* Payment Cancelled */
                        $orderMessage = $this->lang->line('pay_res_1');
                        $pg_requestData['payment_status'] = 2;
                        $pg_requestData['is_active'] = 3;
                    } elseif ($pg_reponse['respStatus'] == 'H') { /* Hold (Authorised but on hold for further anti-fraud review) */
                        $orderMessage = $this->lang->line('pay_res_2');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    } elseif ($pg_reponse['respStatus'] == 'P') { /* Pending (for refunds) */
                        $orderMessage = $this->lang->line('pay_res_3');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    } elseif ($pg_reponse['respStatus'] == 'V') { /* Voided */
                        $orderMessage = $this->lang->line('pay_res_4');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    } elseif ($pg_reponse['respStatus'] == 'E') { /* Error */
                        $orderMessage = $this->lang->line('pay_res_5');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    } elseif ($pg_reponse['respStatus'] == 'D') { /* Declined */
                        $orderMessage = $this->lang->line('pay_res_6');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    }elseif ($pg_reponse['respStatus'] == 'X') { /* Expired */
                        $orderMessage = $this->lang->line('pay_res_5');
                        $pg_requestData['payment_status'] = 3;
                        $pg_requestData['is_active'] = 3;
                    }
                    $header[0] = 'form-data';
                    $inptData['token'] = JWT::encode($pg_requestData, JWT_TOKEN);
                    $urlJsonData = $this->restclient->post($updateUserPaymentInfo, $inptData, $header);
                    /* updating pg response to tables end */
                    if ($urlJsonData->info->http_code == 200) {
                        /*//$usrApiRes = json_decode($urlJsonData->response, true);*/
                        $usrData->apiResponse = json_decode($urlJsonData->response);
                        if ($usrData->apiResponse->responseCode == 200) {
                            /* setting user session */
                            $user_id = $usrData->apiResponse->responseData->customer_id;
                            $usrData_temp = $this->UsrModel->user_profile_details($user_id);
                            $usrSessiondata = array(
                                'id' => $usrData_temp->id,
                                'fname' => $usrData_temp->fname,
                                'lname' => $usrData_temp->lname,
                                'email' => $usrData_temp->email,
                                'logged_in' => TRUE,
                                'free_trial_tkn' => $usrData->apiResponse->responseData
                            );
                            /* setting user session end */
                            $this->session->set_userdata('loggedInUsrData', $usrSessiondata);
                            /* set session language  start */
                            $pg_req = json_decode($usrData->apiResponse->responseData->pg_req,true);
                            $site_lang = $pg_req['site_lang'];
                            $this->session->set_userdata('site_lang', $site_lang);
                            /* set session language  end */
                            if ($pg_reponse['respMessage'] == "Authorised") { /* If payment is success hit store creation api */
                                /* send purchase template invoice mail to user start */
                                    $userPaymentData = $this->UsrModel->get_last_purchased_template_data($pg_reponse['cartId'], $pg_reponse['tranRef']);
                                    $payment_status = $userPaymentData->payment_status == 1 ? "Success" : "Unknown";
                                    $invoice_email_data = array(
                                        'email_title' => 'Matjary - Invoice for Template "'.$userPaymentData->template_name.'" ',
                                        'username' => $usrData_temp->fname . " " . $usrData_temp->lname,
                                        'tranRef' => $userPaymentData->tranRef,
                                        'template_name' => $userPaymentData->template_name,
                                        'template_cost'=> $userPaymentData->template_cost,
                                        'plan_tmpl_buy_status'=> $userPaymentData->plan_tmpl_buy_status,
                                        'discount' => '0.00',
                                        'bill_info_address' => $userPaymentData->bill_info_address,
                                        'total' => number_format((float)$userPaymentData->total_price, 2, '.', ''),
                                        'payment_status' => $payment_status
                                    );
                                    $invoice_email_subject = 'Matjary - Invoice for Template Purchase - ' . $userPaymentData->template_name;
                                    $invoice_email_message = $this->load->view('emails/purchase-invoice', $invoice_email_data, TRUE);
                                    $invoice_emailStatus = sendEmail($usrData_temp->email, $invoice_email_message, $invoice_email_subject);
                                /* send purchase template invoice mail to user end */
                                $_msg =  "<span style='color:green';>".$this->lang->line('usr_cntr_msg_44')."</span>";
                                $this->session->set_flashdata('msg', $_msg);
                                $this->session->set_flashdata('msg_class', 'alert-success');
                                /* Redirect to store creation page */
                            } else {
                                $_msg =  $this->lang->line('usr_cntr_msg_39');
                                $this->session->set_flashdata('msg', $_msg);
                                $this->session->set_flashdata('msg_class', 'alert-danger');
                            }
                            /* user login & redirect */
                            redirect("user-dashboard#pills-template-tab"); /* redirect to some function */
                        } else {
                            $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                            echo json_encode($this->response); exit;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function view_coustomer_enquiry_details($ticketId) {
        $pageData = array();
        if (isset($this->loggedInUsrData['id']) && !empty($this->loggedInUsrData['id'])) {
            $pageData['getContactEnquieryData'] = $this->UsrModel->get_customer_wise_data($ticketId);
            $pageData['getContactData'] = $this->EmployeeModel->get_single_contact_data($ticketId);
            
           // echo '<pre>'; print_r($pageData['getContactData']); die;
            $pageData['getTicketID'] = $ticketId;
            $this->load->view('view-coustomer-enquiry-details',$pageData);
        } else {
            redirect('login');
        }        
    }

    
    public function submit_customer_enquiry_form() {
        if (isset($_POST['cont_message']) && !empty($_POST['cont_message'])) {
           /** Meassage Insert in table */
           //echo '<pre>'; print_r($_POST); die;
            $insertDataMeassage = array(        
            'ticket_id' => isset($_POST['ticket_id']) ? $_POST['ticket_id'] : '',
            'message' => isset($_POST['cont_message']) ? $_POST['cont_message'] : '',
            'created_by' => isset($this->loggedInUsrData['id']) ? $this->loggedInUsrData['id'] : '' 
            );
            $UsrInsertDataMeassage = $this->EmployeeModel->submit_contact_measage_data($insertDataMeassage);
                                              
            if ($UsrInsertDataMeassage == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            } else {                 
                                
                /* Send mail to admin */
                $email_data = array(
                    'email_title' => 'Enquiry from Contact Page - Matjary Site',
                    'cont_name' => $_POST['cont_name'],
                    'cont_email' => $_POST['cont_email'],
                    'con_phone_no' => $_POST['con_phone_no'],
                    'cont_subject' => $_POST['cont_subject'],
                    'cont_message' => $_POST['cont_message'],
                    'ticket_link' => base_url('/ticket-details/'.$_POST['ticket_id'])
                );

               
                $email_subject = "Enquiry from Contact Page - Matjary Site";                   
                if (isset($_POST['cont_email']) && !empty($_POST['cont_email'])) {
                    $email_message = $this->load->view('emails/contact-enquiry', $email_data, TRUE);
                    $emailStatus = sendEmail($_POST['cont_email'],$email_message,$email_subject);                        
                }
                
                $adminEmail = "do-notreply@advancedelaf.com";
                $email_message = $this->load->view('emails/contact-enquiry-mail-admin', $email_data, TRUE);
                $emailStatus = sendEmail($adminEmail,$email_message,$email_subject);
                if ($emailStatus) {
                    /* Send acknowledge mail to user email */
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('contact-txt-4');
                    echo json_encode($this->response); exit;
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    echo json_encode($this->response); exit;
                }
            }
           // $this->load->view('view-coustomer-enquiry-details',$pageData);

        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
            echo json_encode($this->response);
            exit;
        }      
    }

}

?>