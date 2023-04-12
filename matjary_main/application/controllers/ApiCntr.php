<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApiCntr extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('UsrModel'));
    }

    public function api_token_validation() {
        $apiValidToken = $this->input->post('apiValidToken');
        $apiFunctionName = $this->input->post('apiFunctionName');
        $apiRequestToken = $this->input->post('apiRequestToken');
        if (isset($apiValidToken) && !empty($apiValidToken)) {
            $isValidTokenResult = $this->is_native_app_token_validate($apiValidToken);
            if ($isValidTokenResult == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_1');
            } else {
                if (isset($apiRequestToken) && !empty($apiRequestToken)) {
                    if (method_exists($this, $apiFunctionName)) {
                        $respData = new stdClass();
                        $aipUrl = base_url('ApiCntr/' . $apiFunctionName);
                        $inptData['token'] = $apiRequestToken;
                        $header[0] = 'form-data';
                        $urlJsonData = $this->restclient->post($aipUrl, $inptData, $header);
                        if ($urlJsonData->info->http_code == 200) {
                            $respData->apiResponse = json_decode($urlJsonData->response);
                            $this->response['responseCode'] = $respData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $respData->apiResponse->responseMessage;
                            if (isset($respData->apiResponse->resultRecordCount) && !empty($respData->apiResponse->resultRecordCount)) {
                                $this->response['resultRecordCount'] = $respData->apiResponse->resultRecordCount;
                            }
                            $this->response['responseData'] = $respData->apiResponse->responseData;
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_1');
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    if (method_exists($this, $apiFunctionName)) {
                        $respData = new stdClass();
                        $aipUrl = base_url('ApiCntr/' . $apiFunctionName);
                        $urlJsonData = $this->restclient->post($aipUrl);
                        if ($urlJsonData->info->http_code == 200) {
                            $respData->apiResponse = json_decode($urlJsonData->response);
                            $this->response['responseCode'] = $respData->apiResponse->responseCode;
                            $this->response['responseMessage'] = $respData->apiResponse->responseMessage;
                            $this->response['responseData'] = $respData->apiResponse->responseData;
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_1');
                        echo json_encode($this->response);
                        exit;
                    }
                }
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_1');
            echo json_encode($this->response);
            exit;
        }
    }

    public function save_usr() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['fname']) & !empty($decode_data['fname'])) {
                if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $decode_data['fname'])) {
                    /* // one or more of the 'special characters' found in string */
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2');
                    echo json_encode($this->response);
                    exit;
                }
                if (isset($decode_data['lname']) & !empty($decode_data['lname'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $decode_data['lname'])) {
                        /* // one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3');
                        echo json_encode($this->response);
                        exit;
                    }
                    if (isset($decode_data['email']) & !empty($decode_data['email'])) {
                        if (!filter_var($decode_data['email'], FILTER_VALIDATE_EMAIL)) {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                            echo json_encode($this->response);
                            exit;
                        }
                        if (isset($decode_data['phone_no']) & !empty($decode_data['phone_no'])) {
                            if (isset($decode_data['password']) & !empty($decode_data['password'])) {

                                if (isset($decode_data['passconf']) & !empty($decode_data['passconf'])) {
                                    if (trim($decode_data['password'], ' ') != trim($decode_data['passconf'], ' ')) {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_5');
                                        echo json_encode($this->response);
                                        exit;
                                    }
                                    /* //check unique user - user already exist with same email */
                                    $email = trim($decode_data['email'], " ");
                                    $emailExist = $this->UsrModel->chk_email_exist($email);
                                    if ($emailExist == true) {
                                        $this->response['responseCode'] = 405;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_6');
                                        echo json_encode($this->response);
                                        exit;
                                    }

                                    $requestData = array(
                                        'fname' => isset($decode_data['fname']) ? $decode_data['fname'] : '',
                                        'lname' => isset($decode_data['lname']) ? $decode_data['lname'] : '',
                                        'email' => isset($decode_data['email']) ? $decode_data['email'] : '',
                                        'phone_no' => isset($decode_data['phone_no']) ? $decode_data['phone_no'] : '',
                                        'usr_role' => 1,
                                        'is_active' => 1,
                                        'created_datetime' => DATETIME,
                                        'created_by' => 1
                                    );
                                    /* //send data to database by module */
                                    $usrId = $this->UsrModel->save_usr($requestData);
                                    if ($usrId == false) {
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_7');
                                        echo json_encode($this->response);
                                        exit;
                                    } else {
                                        /* // set password */
                                        $pass = hash_hmac("SHA256", $decode_data['password'], SECRET_KEY);
                                        $saveUsrPass = array(
                                            'user_id' => $usrId,
                                            'pswrd' => $pass
                                        );
                                        /* //save user creadentials */
                                        $passSaveResult = $this->UsrModel->saveUsrPass($saveUsrPass);
                                        if ($passSaveResult == false) {
                                            //remove this user data from database 
                                            $status = $this->UsrModel->delete_usr($usrId);
                                            if ($status == false) {
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_8');
                                                echo json_encode($this->response);
                                                exit;
                                            }
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_9');
                                            echo json_encode($this->response);
                                            exit;
                                        } else {

                                            $server_site_path = SERVER_SITE_PATH;
                                            $userLoginUrl = SERVER_SITE_PATH;
                                            $stvr_rt_pth_asts = SERVER_ROOT_PATH_ASSETS;

                                            /* //$shortUrl = $this->shorten_url($partnerLoginUrl); */
                                            /* // send welcome mail to partner */
                                            $email_data = array(
                                                'email_title' => 'Welcome to Matjary',
                                                'username' => $decode_data['fname'] . " " . $decode_data['lname']
                                            );
                                            $email_subject = "Welcome to Matjary";
                                            $email_message = $this->load->view('emails/welcome-mail-new-registration', $email_data, TRUE);
                                            $emailStatus = sendEmail($decode_data['email'], $email_message, $email_subject);

                                            if ($emailStatus == true) {
                                                /* this data is for free trai new resgtration /+/ */
                                                $responseData_temp = array(
                                                    'user_id' => $usrId,
                                                    'email' => $decode_data['email'],
                                                    'domain' => $decode_data['free_trial_domain']
                                                );
                                                $inptData_send = JWT::encode($responseData_temp, JWT_TOKEN);
                                                /* this data is for free trai new resgtration /-/ */

                                                $this->response['responseCode'] = 200;
                                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_10');
                                                $this->response['responseData'] = $inptData_send;

                                                echo json_encode($this->response);
                                                exit;
                                            } else {
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_11');
                                                echo json_encode($this->response);
                                                exit;
                                            }
                                        }
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_12');
                                    echo json_encode($this->response);
                                    exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13');
                                echo json_encode($this->response);
                                exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_16');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_17');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function chk_usr_login() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['email']) & !empty($decode_data['email'])) {
                if (!filter_var($decode_data['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                    echo json_encode($this->response);
                    exit;
                }
                if (isset($decode_data['password']) & !empty($decode_data['password'])) {
                    /* //check user exist with this email & password */
                    $email = trim($decode_data['email'], " ");
                    $pass1 = trim($decode_data['password'], " ");
                    $pass = hash_hmac("SHA256", $pass1, SECRET_KEY);
                    $usrData = $this->UsrModel->chk_usr_crdntls($email, $pass);
                    if ($usrData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_18');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_19');
                        $this->response['responseData'] = $usrData;
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function user_logout() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['id']) & !empty($decode_data['id'])) {
                $usrId = $decode_data['id'];
                /* //check user login with multipal devices */
                $usrLognDvcsData = $this->UsrModel->chk_usr_login_dvcs($usrId);
                if (isset($usrLognDvcsData) & !empty($usrLognDvcsData)) {
                    /* // update user logout details */
                    $usrLoginHstryData = array(
                        'id' => $usrLognDvcsData->id,
                        'logout_dt' => DATETIME,
                        'flag' => 0
                    );

                    $uptSts = $this->UsrModel->upt_usr_login_hstry($usrLoginHstryData);
                    if ($uptSts == false) {
                        $this->response['responseCode'] = 500;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_20');
                        echo json_encode($this->response);
                        exit;
                    }
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_21');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_21');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_22');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function plan_list() {
        $planData = $this->WebModel->plan_list();
        if (isset($planData) && !empty($planData)) {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_23');
            $this->response['responseData'] = $planData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }

    public function template_list() {
        $templateData = $this->CommonModel->template_list();
        if (isset($templateData) && !empty($templateData)) {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_24');
            $this->response['responseData'] = $templateData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }
 
    public function template_details_id() {
        if (isset($_POST['template_id']) && !empty($_POST['template_id'])) {
            $templateData = $this->CommonModel->template_details_id($this->input->post('template_id'), $this->input->post('lang_var'));
            if (isset($templateData) && !empty($templateData)) {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_24');
                $this->response['responseData'] = $templateData;
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('no_data_found');
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }

    public function check_subdomain_availability() {
        if (isset($_POST['sub_domain_name']) && !empty($_POST['sub_domain_name'])) {
            $usrData = $this->WebModel->check_subdomain_availability($_POST['sub_domain_name']);
            if ($usrData == false) {
                $this->response['responseCode'] = 200;
                /* $this->response['responseMessage'] = 'Subdomain is available.'; */
                $this->response['responseMessage'] = $this->lang->line('domain_available');
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 404;
                /* $this->response['responseMessage'] = 'Subdomain is not available'; */
                $this->response['responseMessage'] = $this->lang->line('domain_not_available');
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_25');
            echo json_encode($this->response);
            exit;
        }
    }

    public function save_usr_subscription() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                if (isset($decode_data['plan_id']) && !empty($decode_data['plan_id'])) {
                    if (isset($decode_data['template_id']) && !empty($decode_data['template_id'])) {
                        if (isset($decode_data['sub_domain_name']) && !empty($decode_data['sub_domain_name'])) {
                            if (isset($decode_data['user_email']) && !empty($decode_data['user_email'])) {
                                if (!filter_var($decode_data['user_email'], FILTER_VALIDATE_EMAIL)) {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                                    echo json_encode($this->response);
                                    exit;
                                }
                                if (isset($decode_data['store_link']) && !empty($decode_data['store_link'])) {
                                    if (isset($decode_data['store_admin_link']) && !empty($decode_data['store_admin_link'])) {
                                        
                                        /* user store template details entry on purchase start */
                                        $tmpltData = $this->CommonModel->template_list($decode_data['template_id']); /* check template free/paid */
                                        if(isset($tmpltData) && !empty($tmpltData)){
                                            $free_paid_flag = $tmpltData->free_paid_flag;
                                            if($free_paid_flag==2){
                                                $tempalteDetails = array(
                                                    'user_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                                                    'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                                                    'template_active' => isset($decode_data['is_active']) ? $decode_data['is_active'] : ''
                                                );
                                                $save_user_tempalte_details = $this->UsrModel->save_user_tempalte_details($tempalteDetails);
                                                if($save_user_tempalte_details==false){
                                                    $this->response['responseCode'] = 500;
                                                    $this->response['responseMessage'] = 'Error While inserting user template information.';
                                                    echo json_encode($this->response); exit;
                                                }
                                            }
                                        }
                                        /* user store template details enntry on purchase end */
                                        
                                        /* save user subcription data into user_subcription table start */
                                        $requestData = array(
                                            'user_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                                            'plan_id' => isset($decode_data['plan_id']) ? $decode_data['plan_id'] : '',
                                            'plan_month' => isset($decode_data['plan_month']) ? $decode_data['plan_month'] : '',
                                            'plan_start_dt' => isset($decode_data['plan_start_dt']) ? $decode_data['plan_start_dt'] : '',
                                            'plan_expiry_dt' => isset($decode_data['plan_expiry_dt']) ? $decode_data['plan_expiry_dt'] : '',
                                            'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                                            'store_sub_domain' => isset($decode_data['sub_domain_name']) ? $decode_data['sub_domain_name'] : '',
                                            'store_link' => isset($decode_data['store_link']) ? $decode_data['store_link'] : '',
                                            'store_admin_link' => isset($decode_data['store_admin_link']) ? $decode_data['store_admin_link'] : '',
                                            'user_email' => isset($decode_data['user_email']) ? $decode_data['user_email'] : '',
                                            'store_tkn' => isset($decode_data['store_tkn']) ? $decode_data['store_tkn'] : '',
                                            'subscription_type' => isset($decode_data['subscription_type']) ? $decode_data['subscription_type'] : '',
                                            'is_active' => isset($decode_data['is_active']) ? $decode_data['is_active'] : ''
                                        );
                                        /* //send data to database by module */
                                        $user_subscriptions_id = $this->UsrModel->save_usr_subscription($requestData);
                                        /* save user subcription data into user_subcription table end */
                                        if(isset($decode_data['subscription_type']) && !empty($decode_data['subscription_type'])){
                                            /* 1=free plan, 2=paid plan */
                                            if($decode_data['subscription_type']==2){ 
                                                $plan_tmpl_buy_status = 1;
                                                if(isset($tmpltData) && !empty($tmpltData)){
                                                    $free_paid_flag = $tmpltData->free_paid_flag;
                                                    if($free_paid_flag==2){
                                                        $plan_tmpl_buy_status = 2;
                                                    }
                                                }
                                                
                                                /* save user billing info data into user_payment_info table start */
                                                $bill_info = array(
                                                    'b_fname' => isset($decode_data['b_fname']) ? $decode_data['b_fname'] : '',
                                                    'b_lname' => isset($decode_data['b_lname']) ? $decode_data['b_lname'] : '',
                                                    'b_email' => isset($decode_data['b_email']) ? $decode_data['b_email'] : '',
                                                    'b_tel' => isset($decode_data['b_tel']) ? $decode_data['b_tel'] : '',
                                                    'b_address' => isset($decode_data['b_address']) ? $decode_data['b_address'] : '',
                                                    'b_country' => isset($decode_data['b_country']) ? $decode_data['b_country'] : '',
                                                    'b_city' => isset($decode_data['b_city']) ? $decode_data['b_city'] : '',
                                                    'b_state' => isset($decode_data['b_state']) ? $decode_data['b_state'] : '',
                                                    'b_zipcode' => isset($decode_data['b_zipcode']) ? $decode_data['b_zipcode'] : '',
                                                );

                                                /* user store template details entry on purchase start */
                                                // $tempalteDetails = array(
                                                //     'user_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                                                //     'user_subscriptions_id' => $user_subscriptions_id,
                                                //     'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                                                //     'template_active' => 1,
                                                //     'template_type' => 0
                                                // );
                                                // $save_user_tempalte_details = $this->UsrModel->save_user_tempalte_details($tempalteDetails);
                                                /* user store template details enntry on purchase end */
                                                $requestDataBilling = array(
                                                    'customer_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                                                    'bill_info_address' => serialize($bill_info),
                                                    'user_subscriptions_id' => $user_subscriptions_id,
                                                    'plan_cost' => isset($decode_data['plan_cost']) ? $decode_data['plan_cost'] : '',
                                                    'template_cost' => isset($decode_data['template_cost']) ? $decode_data['template_cost'] : '',
                                                    'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                                                    'total_price' => isset($decode_data['plan_total_price']) ? $decode_data['plan_total_price'] : '',
                                                    'plan_tmpl_buy_status' => $plan_tmpl_buy_status,
                                                    'pg_id' => isset($decode_data['pg_id']) ? $decode_data['pg_id'] : '',
                                                    'payment_type' => isset($decode_data['payment_type']) ? $decode_data['payment_type'] : '',
                                                    'pg_req' => isset($decode_data['pg_req']) ? $decode_data['pg_req'] : '',
                                                    'cartId' => isset($decode_data['cartId']) ? $decode_data['cartId'] : '',
                                                    'tranRef' => isset($decode_data['tranRef']) ? $decode_data['tranRef'] : '',
                                                );
                                                /* //send data to database by module */
                                                $saveBillInfo = $this->UsrModel->save_subscription_billing_info($requestDataBilling);
                                                if ($saveBillInfo == false) {
                                                    $this->response['responseCode'] = 404;
                                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_27');
                                                    echo json_encode($this->response);
                                                    exit;
                                                }
                                                /* save user billing info data into user_payment_info table end */
                                            }
                                        }
                                        

                                        if ($user_subscriptions_id == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_26');
                                            echo json_encode($this->response);
                                            exit;
                                        } else {
                                            $this->response['responseCode'] = 200;
                                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_28');
                                            $this->response['responseData'] = $user_subscriptions_id;
                                            echo json_encode($this->response);
                                            exit;
                                        }
                                    } else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_29');
                                        echo json_encode($this->response);
                                        exit;
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_30');
                                    echo json_encode($this->response);
                                    exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                                echo json_encode($this->response);
                                exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_31');
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_32');
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_33');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_34');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    /* fetch user domain list */

    public function user_domains() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                if (isset($decode_data['user_email']) && !empty($decode_data['user_email'])) {
                    $email = trim($decode_data['user_email'], " ");
                    $user_id = trim($decode_data['user_id'], " ");
                    $doaminsData = $this->UsrModel->user_domains($user_id, $email);
                    if ($doaminsData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_19');
                        $this->response['responseData'] = $doaminsData;
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    /* fetch user profiles details */

    public function user_profile_details() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                $user_id = trim($decode_data['user_id'], " ");
                $profileData = $this->UsrModel->user_profile_details($user_id);
                if ($profileData == false) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_19');
                    $this->response['responseData'] = $profileData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    /* fetch user order details */

    public function user_order_details() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                $user_id = trim($decode_data['user_id'], " ");
                $orderData = $this->UsrModel->user_order_details($user_id);
                if ($orderData == false) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_19');
                    $this->response['responseData'] = $orderData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function user_store_template_details() {
        try {
            /* Takes raw data from the request */
            $json = file_get_contents('php://input');
            /* Converts it into a PHP object */
            $decode_data = json_decode($json, true);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                $user_id = trim($decode_data['user_id'], " ");
                $templateData_Paid = $this->UsrModel->user_store_paid_template_details($user_id);
                $templateData_Free = $this->UsrModel->user_store_free_template_details();
                if(isset($templateData_Paid) && !empty($templateData_Paid)){
                    $templateData = array_merge($templateData_Paid, $templateData_Free);
                }else{
                    $templateData = $templateData_Free;
                }
                if (!isset($templateData) && empty($templateData)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    $this->response['responseData'] = $templateData;
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_19');
                    $this->response['responseData'] = $templateData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function update_user_profile_api() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {
                if (isset($decode_data)) {
                    $insertData = array(
                        'fname' => isset($decode_data['fname']) ? $decode_data['fname'] : '',
                        'lname' => isset($decode_data['lname']) ? $decode_data['lname'] : '',
                        'email' => isset($decode_data['email']) ? $decode_data['email'] : '',
                        'address' => isset($decode_data['address']) ? $decode_data['address'] : '',
                        'country' => isset($decode_data['country']) ? $decode_data['country'] : '',
                        'state' => isset($decode_data['state']) ? $decode_data['state'] : '',
                        'city' => isset($decode_data['city']) ? $decode_data['city'] : '',
                        'zipcode' => isset($decode_data['zipcode']) ? $decode_data['zipcode'] : '',
                        'phone_no' => isset($decode_data['phone_no']) ? $decode_data['phone_no'] : '',
                        'fax_no' => isset($decode_data['fax_no']) ? $decode_data['fax_no'] : ''
                    );
                    $UsrInsertData = $this->UsrModel->update_user_profile_api($insertData, $decode_data['user_id']);
                    if ($UsrInsertData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_36');
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function update_usr_pro_pass_api() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['user_id']) && !empty($decode_data['user_id'])) {

                if (isset($decode_data)) {
                    $insertData = array(
                        'new_pass' => isset($decode_data['new_pass']) ? $decode_data['new_pass'] : ''
                    );
                    $UsrInsertData = $this->UsrModel->update_usr_pro_pass_api($insertData, $decode_data['user_id']);
                    if ($UsrInsertData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_37');
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function update_pg_res_api() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['pg_res']) && !empty($decode_data['pg_res'])) {
                $requestData = array(
                    'pg_res' => isset($decode_data['pg_res']) ? $decode_data['pg_res'] : '',
                    'payment_status' => isset($decode_data['payment_status']) ? $decode_data['payment_status'] : '',
                    'is_active' => isset($decode_data['is_active']) ? $decode_data['is_active'] : ''
                );
                $UpdateStatus = $this->UsrModel->update_pg_res_api($requestData, $decode_data['cartId'], $decode_data['tranRef']);
                if ($UpdateStatus == true) {
                    /* get the details of user entered domain details after successfull payment and data insertaion */
                    $UsrRegDomainData = '';
                    /* if payment after successfull template purchase get created payment info record template info */
                    $templInfo = $this->UsrModel->get_last_purchased_template_data($decode_data['cartId'], $decode_data['tranRef']);
                    if(isset($templInfo) && !empty($templInfo)){
                        if($templInfo->plan_tmpl_buy_status==3){
                            $UsrRegDomainData = $templInfo;
                        }else{
                            $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);
                        }
                    }
                    /* call store creation api AWS */
                    if (isset($UsrRegDomainData) && !empty($UsrRegDomainData)) {
                        $this->response['responseCode'] = 200;
                        $this->response['responseData'] = $UsrRegDomainData;
                        if ($decode_data['payment_status'] == 1) {
                            if($templInfo->plan_tmpl_buy_status==3){
                                $this->response['responseMessage'] = 'Payment Successfull, Please hold while we process your order.';
                            }else{
                                $this->response['responseMessage'] = 'Payment Successfull, Creating your store please hold on.';
                            }
                        } else {
                            $this->response['responseMessage'] = 'Payment did not went through, kindly try later.';
                        }
                        echo json_encode($this->response); exit;
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                        echo json_encode($this->response); exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response); exit;
        }
    }

    public function create_store_api() {
        try {

            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['store_tkn']) && !empty($decode_data['store_tkn'])) {
                /* call store creation api start */
                $curl_res = store_creation_api($decode_data['store_sub_domain'], $decode_data['template_id'], $decode_data['store_tkn'], $decode_data['email']);
                /* call store creation api end */
                
                if (isset($curl_res) && !empty($curl_res)) {

                    $curl_res_decode = json_decode($curl_res, true);

                    if (isset($curl_res_decode['responseCode']) && $curl_res_decode['responseCode'] == 200) {
                         
                        /* send mail to user on success payment & store creation start */
                        /* // send welcome mail to customer on succesfull store creation */
                        $store_link = $decode_data['store_sub_domain'].'.matjary.in';
                        $storeInfo = $this->UsrModel->get_store_info($store_link,$decode_data['store_tkn']);
                        //echo '<pre>'; print_r($storeInfo); exit;
                        $subscription_type = $storeInfo['responseData']->subscription_type;
                        
                        $user_id = $storeInfo['responseData']->user_id;
                        $UsrDataInvoice = $this->UsrModel->user_profile_details($storeInfo['responseData']->user_id);
                        
                        if (isset($decode_data['free_trail_true']) && !empty($decode_data['free_trail_true']) && $decode_data['free_trail_true'] == 1) {
                            /* update free trail flag for user as 1, i.e he has used */
                            $update_user_free_trail_flag = $this->UsrModel->update_user_free_trail_flag($storeInfo['responseData']->user_id, $storeInfo['responseData']->user_email);
                            //echo '<pre>'; print_r($update_user_free_trail_flag); exit;
                            $email_data = array(
                                'email_title' => 'Matjary - Welcome to Free Trail Store ' . $decode_data['store_link'],
                                'store_link' => $decode_data['store_link'],
                                'store_admin_link' => $storeInfo['responseData']->store_admin_link,
                                'username' => $UsrDataInvoice->fname . " " . $UsrDataInvoice->lname,
                                'set_pass' => "https://" . $storeInfo['responseData']->store_admin_link . "/user-reset-new-password/1"
                            );

                            $email_subject = "Welcome to Your Free Trail Store - " . $decode_data['store_link'];
                            $email_message = $this->load->view('emails/free-new-store-welcome-mail', $email_data, TRUE);
                            $emailStatus = sendEmail($storeInfo['responseData']->user_email, $email_message, $email_subject);
                        } else {
                            $email_data = array(
                                'email_title' => 'Matjary - Welcome to Your Store ' . $decode_data['store_link'],
                                'store_link' => $decode_data['store_link'],
                                'store_admin_link' => $storeInfo['responseData']->store_admin_link,
                                'username' => $UsrDataInvoice->fname . " " . $UsrDataInvoice->lname,
                                'set_pass' => "https://" . $storeInfo['responseData']->store_admin_link . "/user-reset-new-password/1"
                            );

                            $email_subject = "Welcome to Your Store - " . $decode_data['store_link'];
                            $email_message = $this->load->view('emails/paid-new-store-welcome-mail', $email_data, TRUE);
                            $emailStatus = sendEmail($storeInfo['responseData']->user_email, $email_message, $email_subject);

                            if($subscription_type==2){
                                $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);

                                /* invoice mail for Paid store */
                                $billing_type = $UsrRegDomainData->validity_in_months == 1 ? "Monthly" : "Yearly";
                                $plan_details = $UsrRegDomainData->plan_name . " " . $UsrRegDomainData->validity_in_months . " " . $UsrRegDomainData->validity_in_months == 1 ? "Month" : "Months";
                                $payment_status = $UsrRegDomainData->payment_status == 1 ? "Success" : "Unknown";

                                $invoice_email_data = array(
                                    'email_title' => 'Matjary - Invoice for ' . $decode_data['store_link'],
                                    'username' => $UsrDataInvoice->fname . " " . $UsrDataInvoice->lname,
                                    'tranRef' => $UsrRegDomainData->tranRef,
                                    'plan_name' => $UsrRegDomainData->plan_name,
                                    'plan_cost'=> $UsrRegDomainData->plan_cost,
                                    'validity_in_months' => $UsrRegDomainData->validity_in_months,
                                    'template_name' => $UsrRegDomainData->template_name,
                                    'template_cost'=> $UsrRegDomainData->template_cost,
                                    'plan_tmpl_buy_status'=> $UsrRegDomainData->plan_tmpl_buy_status,
                                    'plan_details' => $plan_details, 
                                    'subscription_type' => $UsrRegDomainData->subscription_type,
                                    'billing_type' => $billing_type,
                                    'discount' => '0.00',
                                    'bill_info_address' => $UsrRegDomainData->bill_info_address,
                                    'total' => number_format((float)$UsrRegDomainData->total_price, 2, '.', ''),
                                    'payment_status' => $payment_status
                                );
                                $invoice_email_subject = 'Matjary - Invoice ' . $decode_data['store_link'];
                                $invoice_email_message = $this->load->view('emails/purchase-invoice', $invoice_email_data, TRUE);
                                $invoice_emailStatus = sendEmail($UsrRegDomainData->user_email, $invoice_email_message, $invoice_email_subject);
                            }

                            
                        }
                        /* Apache Restart API call */
                        $curl_res_apache = apache_reboot($decode_data['store_sub_domain'], $decode_data['store_tkn']);
                        if (isset($curl_res_apache) && !empty($curl_res_apache)) {
                            $curl_res_apache_decode = json_decode($curl_res_apache, true);

                            if (isset($curl_res_apache_decode['responseCode']) && $curl_res_apache_decode['responseCode'] == 200) {
                                /* SSL API CALL */
                                $curl_install_ssl = install_ssl($decode_data['store_sub_domain']);

                                $this->response['responseCode'] = $curl_res_decode['responseCode'];
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_38');
                                $this->response['responseData'] = $curl_res_decode;
                            } else {
                                $this->response['responseCode'] = $curl_res_apache_decode['responseCode'];
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_39');
                                $this->response['responseData'] = '';
                            }
                        }

                        echo json_encode($this->response);
                        exit;
                    } elseif (isset($curl_res_decode['message']) && !empty($curl_res_decode['message'])) {
                        $this->response['responseCode'] = $curl_res_decode['responseCode'];
                        $this->response['responseMessage'] = $curl_res_decode['message'];
                        $this->response['responseData'] = '';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    /* $this->response['responseMessage'] = 'No Response from Store creation API'; */
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    $this->response['responseData'] = '';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseData'] = '';
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function create_free_trial_store_old() {
        try {

            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['free_trial_email']) && !empty($decode_data['free_trial_email'])) {

                /* check email already exits */
                $emailExist = $this->UsrModel->chk_email_exist($decode_data['free_trial_email']);
                if ($emailExist == true) {
                    $this->response['responseCode'] = 405;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_6');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = "create store api";
                    echo json_encode($this->response);
                    exit;
                }

                /* call store creation api start */
                //$curl_res = store_creation_api($decode_data['store_sub_domain'], $decode_data['template_id'], $decode_data['store_tkn']);
                $curl_res = store_creation_api($decode_data['store_sub_domain'], $decode_data['template_id'], $decode_data['store_tkn'], $decode_data['email']);
                /* call store creation api end */

                if (isset($curl_res) && !empty($curl_res)) {
                    $curl_res_decode = json_decode($curl_res, true);
                    if (isset($curl_res_decode['responseCode']) && $curl_res_decode['responseCode'] == 200) {

                        /* send mail to user on success payment & store creation start */
                        /* // send welcome mail to customer on succesfull store creation */
                        $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);

                        $email_data = array(
                            'email_title' => 'Matjary - Welcome to Free-2 Trail Store ' . $decode_data['store_link'],
                            'store_link' => $decode_data['store_link'],
                            'username' => $UsrRegDomainData->user_email
                        );

                        $email_subject = "Welcome to Your Free Trail Store - " . $decode_data['store_link'];
                        $email_message = $this->load->view('emails/free-new-store-welcome-mail', $email_data, TRUE);
                        $emailStatus = sendEmail($UsrRegDomainData->user_email, $email_message, $email_subject);

                        /* send mail to user on success payment & store creation start */
                        $this->response['responseCode'] = $curl_res_decode['responseCode'];
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_38');
                        $this->response['responseData'] = $curl_res_decode;
                        echo json_encode($this->response);
                        exit;
                    } elseif (isset($curl_res_decode['message']) && !empty($curl_res_decode['message'])) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $curl_res_decode['message'];
                        $this->response['responseData'] = $curl_res_decode;
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    /* $this->response['responseMessage'] = 'No Response from Store creation API'; */
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    $this->response['responseData'] = '';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseData'] = '';
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function submit_contact_form_api() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['cont_email']) && !empty($decode_data['cont_email'])) {

                $insertData = array(
                    'cont_name' => isset($decode_data['cont_name']) ? $decode_data['cont_name'] : '',
                    'cont_email' => isset($decode_data['cont_email']) ? $decode_data['cont_email'] : '',
                    'con_phone_no' => isset($decode_data['con_phone_no']) ? $decode_data['con_phone_no'] : '',
                    'cont_subject' => isset($decode_data['cont_subject']) ? $decode_data['cont_subject'] : '',
                    'cont_message' => isset($decode_data['cont_message']) ? $decode_data['cont_message'] : ''
                );
                $UsrInsertData = $this->CommonModel->submit_contact_form_api($insertData);

                if ($UsrInsertData == false) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                    echo json_encode($this->response);
                    exit;
                } else {
                    /* Send mail to admin */
                    $email_data = array(
                        'email_title' => 'Enquiry from Contact Page - Matjary Site',
                        'cont_name' => $decode_data['cont_name'],
                        'cont_email' => $decode_data['cont_email'],
                        'con_phone_no' => $decode_data['con_phone_no'],
                        'cont_subject' => $decode_data['cont_subject'],
                        'cont_message' => $decode_data['cont_message']
                    );

                    $email_subject = "Enquiry from Contact Page - Matjary Site";
                    $email_message = $this->load->view('emails/contact-enquiry', $email_data, TRUE);
                    $emailStatus = sendEmail(ADMIN_EMAIL, $email_message, $email_subject);
                    if ($emailStatus) {
                        /* Send acknowledge mail to user email */
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('contact-txt-4');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function matjary_config() {
        try {
            /* Takes raw data from the request */
            $json = file_get_contents('php://input');
            /* Converts it into a PHP object */
            $data = json_decode($json);
            if (isset($data->slag) && !empty($data->slag)) {
                /* get config info */
                $matjaryConfigData = $this->CommonModel->get_matjary_config($data->slag);
                if (isset($matjaryConfigData) && !empty($matjaryConfigData)) {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'success';
                    $this->response['responseData'] = $matjaryConfigData;
                    echo json_encode($this->response); exit;
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'fail';
                    echo json_encode($this->response); exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Slag Required.';
                echo json_encode($this->response); exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response); exit;
        }
    }
    public function store_info() {
        try {
            /* Takes raw data from the request */
            $json = file_get_contents('php://input');
            /* Converts it into a PHP object */
            $data = json_decode($json);
            if (isset($data->store_link) && !empty($data->store_link)) {
                if (isset($data->store_token) && !empty($data->store_token)) {

                    $storeUrl = $data->store_link;
                    $parse = parse_url($storeUrl);
                    $host = $parse['host'];
                    $host = str_ireplace('www.', '', $host);

                    /* check store link exits */
                    $storeExist = $this->UsrModel->chk_store_link_exist($host);
                    if ($storeExist == false) {
                        $this->response['responseCode'] = 405;
                        $this->response['responseMessage'] = 'Store not exist.';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        /* get store info */
                        $storeInfo = $this->UsrModel->get_store_info($host, $data->store_token);
                        if ($storeInfo['responseCode'] == 200) {
                            $this->response['responseCode'] = $storeInfo['responseCode'];
                            $this->response['responseMessage'] = $storeInfo['responseMessage'];
                            $this->response['responseData'] = $storeInfo['responseData'];
                            echo json_encode($this->response);
                            exit;
                        } else {
                            $this->response['responseCode'] = $storeInfo['responseCode'];
                            $this->response['responseMessage'] = $storeInfo['responseMessage'];
                            echo json_encode($this->response);
                            exit;
                        }
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Store token is required.';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                /* $this->response['responseMessage'] = 'Domain name is required.'; */
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_31');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function send_reset_password_link_api() {
        try {
            /* Takes raw data from the request */
            $json = file_get_contents('php://input');
            /* Converts it into a PHP object */
            $decode_data = json_decode($json, true);
            if (isset($decode_data['reset_pwd_email']) && !empty($decode_data['reset_pwd_email'])) {
                $usr_email = trim($decode_data['reset_pwd_email'], " ");
                $emailExist = $this->UsrModel->chk_email_exist($usr_email);
                if ($emailExist == false) {
                    $this->response['responseCode'] = 405;
                    $this->response['responseMessage'] = $this->lang->line('pwd-reset-txt-2');
                    echo json_encode($this->response);
                    exit;
                } else {
                    /* check if user has already raised reset password request */
                    $check_rst_pwd_request = $this->UsrModel->check_rst_pwd_request($emailExist->user_id);

                    if (!empty($check_rst_pwd_request)) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('pwd-reset-txt-3');
                        echo json_encode($this->response);
                        exit;
                    }

                    /* set params for password request raised */
                    $pwd_rst_data = array(
                        'user_id' => $emailExist->user_id,
                        'token' => random_alpha_num(8),
                        'reset_flag' => '1'
                    );
                    /* //send data to database by module */
                    $save_rst_pwd_request = $this->UsrModel->insert_rst_pwd_request($pwd_rst_data);
                    $rst_pwd_request_id = $this->db->insert_id();

                    /* adding last inserted id in to the requst to encode */
                    $pwd_rst_data['rst_pwd_request_id'] = $rst_pwd_request_id;

                    $rst_pwd_request_encd = JWT::encode($pwd_rst_data, JWT_TOKEN);
                    $rst_pwd_request_link = SERVER_SITE_PATH . "/reset-pwd-form/" . $rst_pwd_request_encd;

                    /* send email for reset password */
                    $email_data = array(
                        'email_title' => 'Matjary - Forgot Password',
                        'username' => $emailExist->fname . " " . $emailExist->lname,
                        'useremail' => $usr_email,
                        'rst_pwd_request_link' => $rst_pwd_request_link
                    );
                    $email_subject = "Matjary - Request for Password Reset link";
                    $email_message = $this->load->view('emails/reset-pwd-link', $email_data, TRUE);
                    $emailStatus = sendEmail($decode_data['reset_pwd_email'], $email_message, $email_subject);

                    if ($emailStatus) {
                        $this->response['responseCode'] = 200;
                        /* $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_6'); */
                        $this->response['responseMessage'] = $this->lang->line('pwd-reset-txt-4');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function set_usr_reset_password_api() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            /*
              user_id: "7",
              token: "HUTQCJFN",
              reset_flag: "1",
              rst_pwd_request_id: 1
             */
            if (isset($decode_data['new_pwd_tkn']) && !empty($decode_data['new_pwd_tkn'])) {
                /* geting user data from the tkn passed through URL append */
                $decode_usr_data = (array) JWT::decode($decode_data['new_pwd_tkn'], JWT_TOKEN);

                $check_rst_pwd_request = $this->UsrModel->check_rst_pwd_request($decode_usr_data['user_id'], $decode_usr_data['token']);

                if ($check_rst_pwd_request == false) {
                    $this->response['responseCode'] = 405;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_1');
                    echo json_encode($this->response);
                    exit;
                } else {
                    /* update use password start *
                      /* // create hash password */
                    $new_pass = hash_hmac("SHA256", $decode_data['cnf_new_rst_pwd'], SECRET_KEY);
                    /* //update user creadentials */
                    $passupdateResult = $this->UsrModel->updateUsrPass($decode_usr_data['user_id'], $new_pass);

                    if ($passupdateResult == false) {
                        $this->response['responseCode'] = 500;
                        $this->response['responseMessage'] = "Request Not Processed at Moment, please try again";
                        echo json_encode($this->response); exit;
                    } else {
                        /* update password rest flag start */

                        $passResetFlagUpdate = $this->UsrModel->passResetFlagUpdate($decode_usr_data['user_id'], $decode_usr_data['token']);
                        if ($passResetFlagUpdate == false) {
                            $this->response['responseCode'] = 500;
                            $this->response['responseMessage'] = "Error While updating password reset flag, please try again";
                            echo json_encode($this->response); exit;
                        }

                        /* update password rest flag end */
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_37');
                        echo json_encode($this->response);
                        exit;
                    }
                    /* update use password end *
                     *
                     * TO DO
                     * 1. update the password - done
                     * 2. updated the token - done
                     * 3. Sent Mail for successfull reset
                     */
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = "Token Missing";
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function shipping_info() {
        $shippingData = $this->CommonModel->shipping_info();
        if (isset($shippingData) && !empty($shippingData)) {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = '';
            $this->response['responseData'] = $shippingData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }

    public function get_user_purchased_store_payment_info_api($invoiceId = '') {
        $invoiceData = $this->UsrModel->get_user_purchased_store_payment_info_api($invoiceId);
        if (isset($invoiceData) && !empty($invoiceData)) {
            $invoiceData->bill_info_address = unserialize($invoiceData->bill_info_address);
            $b_country_id = $invoiceData->bill_info_address['b_country'];
            $b_state_id = $invoiceData->bill_info_address['b_state'];
            $b_city_id = $invoiceData->bill_info_address['b_city'];
            /* get country, state, city name by id */
            $countryStateCityNameData = $this->CommonModel->get_country_state_city_name_by_id($b_country_id,$b_state_id,$b_city_id);
            $invoiceData->bill_info_address['b_country_name'] = $countryStateCityNameData->country_name;
            $invoiceData->bill_info_address['b_state_name'] = $countryStateCityNameData->state_name;
            $invoiceData->bill_info_address['b_city_name'] = $countryStateCityNameData->city_name;
            $this->response['responseCode'] = 200;
            $this->response['responseData'] = $invoiceData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }

    public function get_user_purchased_template_payment_info_api($invoiceId = '') {
        $invoiceData = $this->UsrModel->get_user_purchased_template_payment_info_api($invoiceId);
        if (isset($invoiceData) && !empty($invoiceData)) {
            $invoiceData->bill_info_address = unserialize($invoiceData->bill_info_address);
            $b_country_id = $invoiceData->bill_info_address['b_country'];
            $b_state_id = $invoiceData->bill_info_address['b_state'];
            $b_city_id = $invoiceData->bill_info_address['b_city'];
            /* get country, state, city name by id */
            $countryStateCityNameData = $this->CommonModel->get_country_state_city_name_by_id($b_country_id,$b_state_id,$b_city_id);
            $invoiceData->bill_info_address['b_country_name'] = $countryStateCityNameData->country_name;
            $invoiceData->bill_info_address['b_state_name'] = $countryStateCityNameData->state_name;
            $invoiceData->bill_info_address['b_city_name'] = $countryStateCityNameData->city_name;
            $this->response['responseCode'] = 200;
            $this->response['responseData'] = $invoiceData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }

    public function save_newsletter_email() {
        try {
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $insertData = array(
                    'email' => isset($_POST['email']) ? $_POST['email'] : '',
                    'is_active' => 1
                );
                $insertStatus = $this->UsrModel->save_newsletter_email($insertData);
                if ($insertStatus == false) {
                    $this->response['responseCode'] = 404;
                    /* $this->response['responseMessage'] = 'Error while inserting newsletter email'; */
                    $this->response['responseMessage'] = $this->lang->line('index-txt-45');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    /* $this->response['responseMessage'] = 'You have successfully subscribed.'; */
                    $this->response['responseMessage'] = $this->lang->line('index-txt-44');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                /* $this->response['responseMessage'] = 'Email is Required'; */
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function save_template_subscription() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (!filter_var($decode_data['user_email'], FILTER_VALIDATE_EMAIL)) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                echo json_encode($this->response); exit;
            }
            /* save user billing info data into user_payment_info table start */
                $bill_info = array(
                    'b_fname' => isset($decode_data['b_fname']) ? $decode_data['b_fname'] : '',
                    'b_lname' => isset($decode_data['b_lname']) ? $decode_data['b_lname'] : '',
                    'b_email' => isset($decode_data['b_email']) ? $decode_data['b_email'] : '',
                    'b_tel' => isset($decode_data['b_tel']) ? $decode_data['b_tel'] : '',
                    'b_address' => isset($decode_data['b_address']) ? $decode_data['b_address'] : '',
                    'b_country' => isset($decode_data['b_country']) ? $decode_data['b_country'] : '',
                    'b_city' => isset($decode_data['b_city']) ? $decode_data['b_city'] : '',
                    'b_state' => isset($decode_data['b_state']) ? $decode_data['b_state'] : '',
                    'b_zipcode' => isset($decode_data['b_zipcode']) ? $decode_data['b_zipcode'] : '',
                );

                $requestDataBilling = array(
                    'customer_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                    'bill_info_address' => serialize($bill_info),
                    'user_subscriptions_id' => 0,
                    'template_cost' => isset($decode_data['template_cost']) ? $decode_data['template_cost'] : 0,
                    'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                    'total_price' => isset($decode_data['total_price']) ? $decode_data['total_price'] : '',
                    'plan_tmpl_buy_status' => 3,
                    'pg_id' => isset($decode_data['pg_id']) ? $decode_data['pg_id'] : '',
                    'payment_type' => isset($decode_data['payment_type']) ? $decode_data['payment_type'] : '',
                    'pg_req' => isset($decode_data['pg_req']) ? $decode_data['pg_req'] : '',
                    'cartId' => isset($decode_data['cartId']) ? $decode_data['cartId'] : '',
                    'tranRef' => isset($decode_data['tranRef']) ? $decode_data['tranRef'] : '',
                );
                $saveBillInfo = $this->UsrModel->save_subscription_billing_info($requestDataBilling); /* send data to database by module */
            /* save user billing info data into user_payment_info table end */
            /* user store template details entry on purchase start */
                $tempalteDetails = array(
                    'user_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                    'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                    'template_active' => 1
                );
                $save_user_tempalte_details = $this->UsrModel->save_user_tempalte_details($tempalteDetails);
            /* user store template details enntry on purchase end */
            if ($saveBillInfo == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_27');
                echo json_encode($this->response);
                exit;
            }elseif ($save_user_tempalte_details == false) {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Error while inserting user purchased template info.';
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_28');
                $this->response['responseData'] = '';
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function check_template_purchased() {
        if (isset($_POST['template_id']) && !empty($_POST['template_id'])) {
            $templateData = $this->CommonModel->check_template_purchased($this->input->post('template_id'), $this->input->post('user_id'));
            if (isset($templateData) && !empty($templateData)) {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = "Template Already Purchased, You can browse <a href='" . base_url() . "user-dashboard#pills-template-tab' target='_blank'>My Templates";
                $this->response['responseData'] = $templateData;
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('no_data_found');
                $this->response['responseData'] = "";
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = $this->lang->line('no_data_found');
            echo json_encode($this->response);
            exit;
        }
    }
    public function chk_admin_credentials() {
        try {
            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);
            if (isset($decode_data['email']) & !empty($decode_data['email'])) {
                if (!filter_var($decode_data['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_4');
                    echo json_encode($this->response);
                    exit;
                }
                if (isset($decode_data['password']) & !empty($decode_data['password'])) {
                    /* //check user exist with this email & password */
                    $email = trim($decode_data['email'], " ");
                    $pass1 = trim($decode_data['password'], " ");
                    $pass = hash_hmac("SHA256", $pass1, SECRET_KEY);
                    $usrData = $this->UsrModel->chk_admin_crdntls($email, $pass);
                    if ($usrData == false) {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid details. ';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Super Admin Logged In Sucessfully.';
                        $this->response['responseData'] = $usrData;
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_13');
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_15');
                echo json_encode($this->response);
                exit;
            }
        } catch (Exception $e) {
            $this->response['responseCode'] = 400;
            $this->response['responseMessage'] = $e->getMessage();
            echo json_encode($this->response);
            exit;
        }
    }

    public function check_coupon_valid(){
        //echo '<pre>'; print_r($_POST); exit;
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
            if(isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])){
                $couponData = $this->CouponModel->check_coupon_exist($_POST['coupon_code']);
                //echo '<pre>'; print_r($couponData); exit;
                if(isset($couponData) && !empty($couponData)){
                    /* same coupon already used by same user */
                    $couponAlreadyUsedStatus = $this->CouponModel->coupon_already_used($couponData->id,$_POST['user_id']);
                    //echo '<pre>'; print_r($couponAlreadyUsedStatus); exit;
                    if($couponAlreadyUsedStatus==false){

                        //echo '<pre>'; print_r($couponData); exit;
                        /* check coupon not expired */
                        $current_date = date("Y-m-d"); // Get the current date in YYYY-MM-DD format
                        $expiration_date = date("Y-m-d", strtotime($couponData->expiry_date));
                        
                        if(strtotime($current_date) <= strtotime($expiration_date)){
                            $this->response['responseCode'] = 200;
                            $this->response['responseMessage'] = 'Success.';
                            $this->response['responseData'] = $couponData;
                            echo json_encode($this->response); exit;
                        }else{
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Coupon not valid.'; /* coupon code has been expired. */
                            echo json_encode($this->response); exit;
                        }

                        
                    }else{
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Coupon already used.';
                        echo json_encode($this->response); exit;
                    }
                }else{
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Coupon not valid.';
                    echo json_encode($this->response); exit;
                }
                
            }else{
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Coupon Code is Required.';
                echo json_encode($this->response); exit;
            }
        }else{
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'User Id is Required.';
            echo json_encode($this->response); exit;
        }
        
    }

}

?>