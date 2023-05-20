<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AuthCntr extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('index');
    }
    public function login() {
        $this->load->view('site_admin/login');
    }

    public function chk_admin_login() {  
        /* // set password */
       /* echo $pass = hash_hmac("SHA256",'Superadmin@123', SECRET_KEY); die; */
        if (isset($_POST['email']) & !empty($_POST['email'])) {
            if (isset($_POST['password']) & !empty($_POST['password'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $this->response['responseCode'] = 404;
                     $this->response['responseMessage'] = 'Invalid Email.'; 
                    echo json_encode($this->response);
                    exit;
                }
                $usrData = new stdClass();
                $chkUsrLoginUrl = base_url('chk-admin-credentials');             
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
                            $superAdminSessiondata = array(
                                'id' => $responseData->id,
                                'fname' => $responseData->fname,
                                'lname' => $responseData->lname,
                                'email' => $responseData->email,
                                'usr_role' => $responseData->usr_role,
                                'logged_in' => TRUE
                            );                          
                            /* adding data to session */
                            $this->session->set_userdata('loggedInSuperAdminData', $superAdminSessiondata);
                        }else {
                            $usrData->apiResponse = '';
                        }
                        $this->response['responseCode'] = 200;
                         $this->response['responseMessage'] = 'Login Successfull.'; 
                        $this->response['redirectUrl'] = base_url('site-admin/dashboard');
                        echo json_encode($this->response);
                        exit;
                    } else {
                        $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                        $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = $urlJsonData->info->http_code;
                    echo json_encode($this->response);
                    exit;
                }
            } else {
                $this->response['responseCode'] = 404;
                $this->response['responseMessage'] = 'Password Required.'; 
                echo json_encode($this->response);
                exit;
            }
        } else {
            $this->response['responseCode'] = 404;
             $this->response['responseMessage'] = 'Email Required.'; 
            echo json_encode($this->response);
            exit;
        }
    }
   
    public function site_admin_logout() {
        try {
            $this->session->unset_userdata('loggedInUsrData');
            $this->session->sess_destroy();
            redirect(base_url('site-admin/login'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
}
