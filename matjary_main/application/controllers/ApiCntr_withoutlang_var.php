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
            if ($isValidTokenResult == false) { /* //if mobile API token not match */
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Request is Invalid.'; /* //API token not valid. */
            } else { /* // if mobile API token match */
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
                        $this->response['responseMessage'] = 'Request is Invalid.';
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
                        $this->response['responseMessage'] = 'Request is Invalid.';
                        echo json_encode($this->response);
                        exit;
                    }
                }
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'Request is Invalid.';
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
                    $this->response['responseMessage'] = 'Invalid first name, contains vulnerable characters';
                    echo json_encode($this->response);
                    exit;
                }
                if (isset($decode_data['lname']) & !empty($decode_data['lname'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $decode_data['lname'])) {
                        /* // one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid last name, contains vulnerable characters';
                        echo json_encode($this->response);
                        exit;
                    }
                    if (isset($decode_data['email']) & !empty($decode_data['email'])) {
                        if (!filter_var($decode_data['email'], FILTER_VALIDATE_EMAIL)) {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Invalid Email.';
                            echo json_encode($this->response);
                            exit;
                        }
                        if (isset($decode_data['phone_no']) & !empty($decode_data['phone_no'])) {
                            if (isset($decode_data['password']) & !empty($decode_data['password'])) {

                                if (isset($decode_data['passconf']) & !empty($decode_data['passconf'])) {
                                    if (trim($decode_data['password'], ' ') != trim($decode_data['passconf'], ' ')) {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = 'Password & Confirm Password not Match.';
                                        echo json_encode($this->response);
                                        exit;
                                    }
                                    /* //check unique user - user already exist with same email */
                                    $email = trim($decode_data['email'], " ");
                                    $emailExist = $this->UsrModel->chk_email_exist($email);
                                    if ($emailExist == true) {
                                        $this->response['responseCode'] = 405;
                                        $this->response['responseMessage'] = 'Email already exist.';
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
                                        $this->response['responseMessage'] = 'error while saving user details.';
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
                                                $this->response['responseMessage'] = "User Junk Data Not remove.";
                                                echo json_encode($this->response);
                                                exit;
                                            }
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = "User Password Not Save.";
                                            echo json_encode($this->response);
                                            exit;
                                        } else {

                                            $server_site_path = SERVER_SITE_PATH;
                                            $userLoginUrl = SERVER_SITE_PATH;
                                            $stvr_rt_pth_asts = SERVER_ROOT_PATH_ASSETS;

                                            /* //$shortUrl = $this->shorten_url($partnerLoginUrl); */
                                            /* // send welcome mail to partner */

                                            $email_subject = "Welcome to Matjary.";
                                            $email_message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                <html xmlns="http://www.w3.org/1999/xhtml">
                                                <head>
                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                                    <meta name="description" content="">
                                                    <meta name="keywords" content="">
                                                    <meta name="author" content="MotorGate">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Matjary Mail</title>
                                                </head>
                                                <body>
                                                    <div class="mail-template-box" style="margin: 0;padding: 0;display: grid;place-content: center;in-height: 100vh;border:1px solid #333;">
                                                        <div class="mail-template-body" style="background-color: #FFF;box-shadow: 3px 4px 15px #44464778;padding: 2rem;border-radius: 10px;margin: 10px;">
                                                            <div class="mail-template-logo">
                                                                <img class="img-fluid" style="width: 400px !important;margin-left: auto;margin-right: auto;display: block;" src="' . $server_site_path . 'assets/image/motorgate-logo-new1.png">
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-content text-center" style="padding: 1rem 0;text-align: center;">
                                                                <h3>!Welcome to Matjary!</h3>
                                                                <h4>Thanks for joining with us.</h4>
                                                                <h5>Your login link is below:</h5>
                                                                <a href="' . $server_site_path . '" target="blank">click here to login</a>
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-footer" style="text-align: center;">
                                                                <h4 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Follow us</h4>
                                                                <ul class="mail-template-icons-list" style="display: inline-flex;padding-left: 0;list-style: none;">
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . $server_site_path . 'assets/image/facebook.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . $server_site_path . 'assets/image/instagram.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . $server_site_path . 'assets/image/twitter.png" style="width: 40px;height: 40px;"></a></li>
                                                                </ul>
                                                                <h6 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;margin-top: 0;">Visit us on <a href="http://www.matjary.in" target="blank">matjary.in</a></h6>
                                                                <h4 class="mt-3" style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Download App</h4>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . $server_site_path . 'assets/image/google-play-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . $server_site_path . 'assets/image/appl-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </body>
                                                </html>';
                                            $emailStatus = sendEmail($decode_data['email'], $email_message, $email_subject);

                                            if ($emailStatus == true) {
                                                $this->response['responseCode'] = 200;
                                                $this->response['responseMessage'] = 'Registered successfully, for welcome mail please check your registered email inbox/spam folder.';
                                                echo json_encode($this->response);
                                                exit;
                                            } else {
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = 'Error while sending email.';
                                                echo json_encode($this->response);
                                                exit;
                                            }
                                        }
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Confirm Password is required.';
                                    echo json_encode($this->response);
                                    exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Password is required.';
                                echo json_encode($this->response);
                                exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Phone Number is required.';
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Email is required.';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Last Name is required.';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'First Name is required.';
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
                    $this->response['responseMessage'] = 'Invalid Email.';
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
                        $this->response['responseMessage'] = 'Incorrect Username/Password.';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Success';
                        $this->response['responseData'] = $usrData;
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Password is required.';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Email is required.';
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
                        $this->response['responseMessage'] = 'Error while updating user login history details.';
                        echo json_encode($this->response);
                        exit;
                    }
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'User Logout Successfully.';
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'User Logout Successfully.';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'User ID is Required.';
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
            $this->response['responseMessage'] = 'Plan Data Retrived Successfully.';
            $this->response['responseData'] = $planData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'No record found.';
            echo json_encode($this->response);
            exit;
        }
    }

    public function template_list() {
        $templateData = $this->CommonModel->template_list();
        if (isset($templateData) && !empty($templateData)) {
            $this->response['responseCode'] = 200;
            $this->response['responseMessage'] = 'Template Data Retrived Successfully.';
            $this->response['responseData'] = $templateData;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'No record found.';
            echo json_encode($this->response);
            exit;
        }
    }

    public function template_details_id() {
        if (isset($_POST['template_id']) && !empty($_POST['template_id'])) {
            $templateData = $this->CommonModel->template_details_id($this->input->post('template_id'));
            if (isset($templateData) && !empty($templateData)) {
                $this->response['responseCode'] = 200;
                $this->response['responseMessage'] = 'Template Data Retrived Successfully.';
                $this->response['responseData'] = $templateData;
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'No record found';
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'No record found';
            echo json_encode($this->response);
            exit;
        }
    }

    public function check_subdomain_availability() {
        if (isset($_POST['sub_domain_name']) && !empty($_POST['sub_domain_name'])) {
            $usrData = $this->WebModel->check_subdomain_availability($_POST['sub_domain_name']);
            if ($usrData == false) {
                $this->response['responseCode'] = 200;
                //$this->response['responseMessage'] = 'Subdomain is available.';
                $this->response['responseMessage'] = $this->lang->line('domain_available');
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = 404;
                //$this->response['responseMessage'] = 'Subdomain is not available';
                $this->response['responseMessage'] = $this->lang->line('domain_not_available');
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'Enter Store Subdomain';
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
                                    $this->response['responseMessage'] = 'Invalid Email.';
                                    echo json_encode($this->response);
                                    exit;
                                }
                                if (isset($decode_data['store_link']) && !empty($decode_data['store_link'])) {
                                    if (isset($decode_data['store_admin_link']) && !empty($decode_data['store_admin_link'])) {
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
                                            'is_active' => 1
                                        );
                                        /* //send data to database by module */
                                        $saveStatus = $this->UsrModel->save_usr_subscription($requestData);
                                        $user_subscriptions_id = $this->db->insert_id();
                                        /* save user subcription data into user_subcription table end */

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
                                            'user_subscriptions_id' => $user_subscriptions_id,
                                            'total_price' => isset($decode_data['plan_total_price']) ? $decode_data['plan_total_price'] : '',
                                            'pg_id' => isset($decode_data['pg_id']) ? $decode_data['pg_id'] : '',
                                            'payment_type' => isset($decode_data['payment_type']) ? $decode_data['payment_type'] : '',
                                            'pg_req' => isset($decode_data['pg_req']) ? $decode_data['pg_req'] : '',
                                            'cartId' => isset($decode_data['cartId']) ? $decode_data['cartId'] : '',
                                            'tranRef' => isset($decode_data['tranRef']) ? $decode_data['tranRef'] : '',
                                        );
                                        /* //send data to database by module */
                                        $saveBillInfo = $this->UsrModel->save_subscription_billing_info($requestDataBilling);
                                        /* save user billing info data into user_payment_info table end */

                                        /* user store template details enntry on purchase start */
                                        $tempalteDetails = array(
                                            'user_id' => isset($decode_data['user_id']) ? $decode_data['user_id'] : '',
                                            'template_id' => isset($decode_data['template_id']) ? $decode_data['template_id'] : '',
                                            'template_active' => 1,
                                            'template_type' => 2
                                        );
                                        $save_user_tempalte_details = $this->UsrModel->save_user_tempalte_details($tempalteDetails);
                                        /* user store template details enntry on purchase end */

                                        if ($saveStatus == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = 'error proceesing your plan data';
                                            echo json_encode($this->response);
                                            exit;
                                        } elseif ($saveBillInfo == false) {
                                            $this->response['responseCode'] = 404;
                                            $this->response['responseMessage'] = 'error proceesing your billing data';
                                            echo json_encode($this->response);
                                            exit;
                                        } else {
                                            $this->response['responseCode'] = 200;
                                            $this->response['responseMessage'] = 'You Plan, Billing Info Processed Succesfully';
                                            echo json_encode($this->response);
                                            exit;
                                        }
                                    } else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = 'Store admin link is required.';
                                        echo json_encode($this->response);
                                        exit;
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Store link is required.';
                                    echo json_encode($this->response);
                                    exit;
                                }
                            } else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Email is required.';
                                echo json_encode($this->response);
                                exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Sub-domain name is required.';
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Template id is required.';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Plan id is required.';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'User id is required.';
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
                        $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Success';
                        $this->response['responseData'] = $doaminsData;
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                    $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'Success';
                    $this->response['responseData'] = $profileData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                    $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'Success';
                    $this->response['responseData'] = $orderData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                $templateData = $this->UsrModel->user_store_template_details($user_id);

                if ($templateData == false) {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                    $this->response['responseData'] = $templateData;
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'Success';
                    $this->response['responseData'] = $templateData;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                        $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Profile Data Updated Succesfully';
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                        $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 200;
                        $this->response['responseMessage'] = 'Password Updated Succesfully';
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                $insertData = array(
                    'pg_res' => isset($decode_data['pg_res']) ? $decode_data['pg_res'] : '',
                    'payment_status' => isset($decode_data['payment_status']) ? $decode_data['payment_status'] : '',
                    'is_active' => isset($decode_data['is_active']) ? $decode_data['is_active'] : ''
                );

                $UsrInsertData = $this->UsrModel->update_pg_res_api($insertData, $decode_data['cartId'], $decode_data['tranRef']);

                if ($UsrInsertData == true) {
                    /* get the details of user entered domain details after successfull payment and data insertaion */
                    $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);
                    /* call store creation api AWS */

                    if (isset($UsrRegDomainData) && !empty($UsrRegDomainData)) {

                        $this->response['responseCode'] = 200;
                        $this->response['responseData'] = $UsrRegDomainData;
                        if ($decode_data['payment_status'] == '1') {
                            $this->response['responseMessage'] = 'Payment Successfull, Creating your store please hold on.';
                        } else {
                            $this->response['responseMessage'] = 'Payment did not went through, kindly try later.';
                        }
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                        echo json_encode($this->response);
                        exit;
                    }
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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

    public function create_store_api() {
        try {

            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['store_tkn']) && !empty($decode_data['store_tkn'])) {

                /* call store creation api start */
                $curl_res = store_creation_api($decode_data['store_sub_domain'], $decode_data['template_id'], $decode_data['store_tkn'], $decode_data['email']);

                /* call store creation api end */
                /*
                  ///CUrl repons samaple///
                  {
                  "responseCode": 200,
                  "subdomain": "santosh-112.matjary.in",
                  "folder": "/var/www/html/santosh-112.matjary.in",
                  "ftpuser": "santosh-112"
                  }
                 */

                if (isset($curl_res) && !empty($curl_res)) {

                    $curl_res_decode = json_decode($curl_res, true);

                    if (isset($curl_res_decode['responseCode']) && $curl_res_decode['responseCode'] == 200) {
                        /* send mail to user on success payment & store creation start */
                        /* // send welcome mail to customer on succesfull store creation */
                        $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);
                        /*
                         * Response $UsrRegDomainData
                         * 
                          [user_id] => 7
                          [user_email] => santoshpaskanti@gmail.com
                          [store_domain] =>
                          [store_sub_domain] => mat3
                          [template_id] => 2
                          [store_link] => mat3.matjary.in
                          [store_admin_link] => mat3.matjary.in/admin
                          [store_tkn] => 66e10124-5118-4252-acf8-0da83360f073
                          [order_id] => 211
                          [tranRef] => TST2235500626278
                          [cartId] => 63a32f00998ae
                          [payment_type] => 1
                          [total_price] => 29
                          [user_subscriptions_id] => 212
                         */
                        $email_subject = "Welcome to Your Store - " . $decode_data['store_link'];
                        $email_message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                <html xmlns="http://www.w3.org/1999/xhtml">
                                                <head>
                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                                    <meta name="description" content="">
                                                    <meta name="keywords" content="">
                                                    <meta name="author" content="Matjary">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Matjary</title>
                                                </head>
                                                <body>
                                                    <div class="mail-template-box" style="margin: 0;padding: 0;display: grid;place-content: center;in-height: 100vh;border:1px solid #333;">
                                                        <div class="mail-template-body" style="background-color: #FFF;box-shadow: 3px 4px 15px #44464778;padding: 2rem;border-radius: 10px;margin: 10px;">
                                                            <div class="mail-template-logo">
                                                                <img class="img-fluid" style="width: 400px !important;margin-left: auto;margin-right: auto;display: block;" src="' . SERVER_SITE_PATH . 'assets/image/motorgate-logo-new1.png">
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-content text-center" style="padding: 1rem 0;text-align: center;">
                                                                <h3>!Welcome to Matjary!</h3>
                                                                <h4>Thanks for joining with us.</h4>
                                                                <h5>Your store link is below:</h5>
                                                                <a href="' . $decode_data['store_link'] . '" target="blank">click here to store link</a>
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-footer" style="text-align: center;">
                                                                <h4 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Follow us</h4>
                                                                <ul class="mail-template-icons-list" style="display: inline-flex;padding-left: 0;list-style: none;">
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/facebook.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/instagram.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/twitter.png" style="width: 40px;height: 40px;"></a></li>
                                                                </ul>
                                                                <h6 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;margin-top: 0;">Visit us on <a href="' . base_url() . '" target="blank">matjary.in</a></h6>
                                                                <h4 class="mt-3" style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Download App</h4>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/google-play-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/appl-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </body>
                                                </html>';

                        $mail_status = sendEmail($UsrRegDomainData->user_email, $email_message, $email_subject);
                        /* Apache Restart API call */

                        $curl_res_apache = apache_reboot($decode_data['store_sub_domain'], $decode_data['store_tkn']);
                        if (isset($curl_res_apache) && !empty($curl_res_apache)) {
                            $curl_res_apache_decode = json_decode($curl_res_apache, true);

                            if (isset($curl_res_apache_decode['responseCode']) && $curl_res_apache_decode['responseCode'] == 200) {
                                $this->response['responseCode'] = $curl_res_decode['responseCode'];
                                $this->response['responseMessage'] = 'Store create succesfully';
                                $this->response['responseData'] = $curl_res_decode;
                            } else {
                                $this->response['responseCode'] = $curl_res_apache_decode['responseCode'];
                                $this->response['responseMessage'] = 'Something went wrong kindly contact site admin';
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
                    $this->response['responseMessage'] = 'No Response from Store creation API';
                    $this->response['responseData'] = '';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseData'] = '';
                $this->response['responseMessage'] = 'Somthing went wrong, please try again in some time! ++++';
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

    public function create_free_trial_store() {
        try {

            $decode_data = (array) JWT::decode($this->input->post('token'), JWT_TOKEN);

            if (isset($decode_data['free_trial_email']) && !empty($decode_data['free_trial_email'])) {

                /* check email already exits */
                $emailExist = $this->UsrModel->chk_email_exist($decode_data['free_trial_email']);
                if ($emailExist == true) {
                    $this->response['responseCode'] = 405;
                    $this->response['responseMessage'] = 'Email already exist.';
                    echo json_encode($this->response);
                    exit;
                }

                /* call store creation api start */
                $curl_res = store_creation_api($decode_data['store_sub_domain'], $decode_data['template_id'], $decode_data['store_tkn']);
                /* call store creation api end */

                if (isset($curl_res) && !empty($curl_res)) {
                    $curl_res_decode = json_decode($curl_res, true);
                    if (isset($curl_res_decode['responseCode']) && $curl_res_decode['responseCode'] == 200) {

                        /* send mail to user on success payment & store creation start */
                        /* // send welcome mail to customer on succesfull store creation */
                        $UsrRegDomainData = $this->UsrModel->get_store_creation_data($decode_data['cartId'], $decode_data['tranRef']);

                        $email_subject = "Welcome to Matjary.";
                        $email_message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                <html xmlns="http://www.w3.org/1999/xhtml">
                                                <head>
                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                                    <meta name="description" content="">
                                                    <meta name="keywords" content="">
                                                    <meta name="author" content="Matjary">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Matjary Mail</title>
                                                </head>
                                                <body>
                                                    <div class="mail-template-box" style="margin: 0;padding: 0;display: grid;place-content: center;in-height: 100vh;border:1px solid #333;">
                                                        <div class="mail-template-body" style="background-color: #FFF;box-shadow: 3px 4px 15px #44464778;padding: 2rem;border-radius: 10px;margin: 10px;">
                                                            <div class="mail-template-logo">
                                                                <img class="img-fluid" style="width: 400px !important;margin-left: auto;margin-right: auto;display: block;" src="' . SERVER_SITE_PATH . 'assets/image/motorgate-logo-new1.png">
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-content text-center" style="padding: 1rem 0;text-align: center;">
                                                                <h3>!Welcome to Matjary!</h3>
                                                                <h4>Thanks for joining with us.</h4>
                                                                <h5>Your store link is below:</h5>
                                                                <a href="' . $UsrRegDomainData->store_link . '" target="blank">click here to store link</a>
                                                            </div>
                                                            <hr>
                                                            <div class="mail-template-footer" style="text-align: center;">
                                                                <h4 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Follow us</h4>
                                                                <ul class="mail-template-icons-list" style="display: inline-flex;padding-left: 0;list-style: none;">
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/facebook.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/instagram.png" style="width: 40px;height: 40px;"></a></li>
                                                                    <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/twitter.png" style="width: 40px;height: 40px;"></a></li>
                                                                </ul>
                                                                <h6 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;margin-top: 0;">Visit us on <a href="' . base_url() . '" target="blank">matjary.in</a></h6>
                                                                <h4 class="mt-3" style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Download App</h4>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/google-play-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                                <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/appl-store-transparent.png" style="width: 150px;height: auto;"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </body>
                                                </html>';

                        $mail_status = sendEmail($UsrRegDomainData->user_email, $email_message, $email_subject);

                        /* Now Apache Restart API call */


                        /* send mail to user on success payment & store creation start */
                        $this->response['responseCode'] = $curl_res_decode['responseCode'];
                        $this->response['responseMessage'] = 'Store create succesfully';
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
                    $this->response['responseMessage'] = 'No Response from Store creation API';
                    $this->response['responseData'] = '';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseData'] = '';
                $this->response['responseMessage'] = 'Somthing went wrong, please try again in some time! ++++';
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
                    $this->response['responseMessage'] = 'Somthing went wrong! Please try later!';
                    echo json_encode($this->response);
                    exit;
                } else {
                    /* Send mail to admin */
                    $email_subject = "Enquiry from Contact Page - Matjary Site";
                    $email_message = '<!DOCTYPE html>
                    <html>
                        <head>
                            <title>Matjary</title>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body>
                            <div class="mail-template-box" style="margin: 0;padding: 0;display: grid;place-content: center;in-height: 100vh;border:1px solid #333;">
                                <div class="mail-template-body" style="background-color: #FFF;box-shadow: 3px 4px 15px #44464778;padding: 2rem;border-radius: 10px;margin: 10px;">
                                    <div class="mail-template-logo">
                                        <img class="img-fluid" style="width: 400px !important;margin-left: auto;margin-right: auto;display: block;" src="' . SERVER_SITE_PATH . 'assets/image/motorgate-logo-new1.png">
                                    </div>
                                    <hr>
                                    <div class="mail-template-content text-center" style="padding: 1rem 0;text-align: center;">
                                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                                            <tr>
                                                <td align="center" valign="top">
                                                    <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                                                        <tr>
                                                            <td align="center" valign="top">Name</td>
                                                            <td align="center" valign="top">"' . $decode_data['cont_name'] . '"</td>                                        
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top">Email</td>
                                                            <td align="center" valign="top">"' . $decode_data['cont_email'] . '"</td>                                        
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top">Contact</td>
                                                            <td align="center" valign="top">"' . $decode_data['con_phone_no'] . '"</td>                                        
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top">Subject</td>
                                                            <td align="center" valign="top">"' . $decode_data['cont_subject'] . '"</td>                                        
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top">Message</td>
                                                            <td align="center" valign="top">"' . $decode_data['cont_message'] . '"</td>                                        
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="mail-template-footer" style="text-align: center;">
                                        <h4 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Follow us</h4>
                                        <ul class="mail-template-icons-list" style="display: inline-flex;padding-left: 0;list-style: none;">
                                            <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/facebook.png" style="width: 40px;height: 40px;"></a></li>
                                            <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/instagram.png" style="width: 40px;height: 40px;"></a></li>
                                            <li style="margin: 0.5rem;"><a href="#"><img src="' . SERVER_SITE_PATH . 'assets/image/twitter.png" style="width: 40px;height: 40px;"></a></li>
                                        </ul>
                                        <h6 style="color: #000000;font-size: 1.5rem;margin-bottom: 0;margin-top: 0;">Visit us on <a href="' . base_url() . '" target="blank">matjary.in</a></h6>
                                        <h4 class="mt-3" style="color: #000000;font-size: 1.5rem;margin-bottom: 0;">Download App</h4>
                                        <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/google-play-store-transparent.png" style="width: 150px;height: auto;"></a>
                                        <a href="#"><img class="mail-template-app-logo" src="' . SERVER_SITE_PATH . 'assets/image/appl-store-transparent.png" style="width: 150px;height: auto;"></a>
                                    </div>
                                </div>
                            </div>

                        </body>
                    </html>';

                    $mail_status = sendEmail(ADMIN_EMAIL, $email_message, $email_subject);

                    /* Send acknowledge mail to user email */
                    $this->response['responseCode'] = 200;
                    $this->response['responseMessage'] = 'Your Query Submitted Successfully! Our Support Team will get back to you shortly';
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Something went wrong! Please try again';
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
                $this->response['responseMessage'] = 'Domain name is required.';
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

}

?>