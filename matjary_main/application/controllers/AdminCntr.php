<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCntr extends MY_Controller {  

    function __construct() {
        parent::__construct();
        $this->load->model('CatModel');
    }

    public function index() {
        $this->load->view('index');
    }

    public function login() {
        $this->load->view('site_admin/login');
    }

    public function dashboard() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 1;            
            $pageData['dashboardAnalytics'] = $this->DashboardModel->dashboard_analytics();
            $pageData['getUserRegMonthReport'] = $this->DashboardModel->get_monthly_user_register_report();
            if(isset($pageData['getUserRegMonthReport']) && !empty($pageData['getUserRegMonthReport'])){
                $getTotal = '';
                $GetMonths = '';
                foreach($pageData['getUserRegMonthReport'] as $data_count){				        
                    if($getTotal !=''){
                        $getTotal .=','.$data_count.'';
                    }else{
                        $getTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentTotal'] = $getTotal.',';
                $pageData['getCurrentMonth'] = $GetMonths;
            } 
            $pageData['getMonthArray'] = MONTHS;
            $this->load->view('site_admin/dashboard',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    
    public function get_dashboard_data() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['getUserRegMonthReport'] = $this->DashboardModel->get_monthly_user_register_report();            
            if(isset($pageData['getUserRegMonthReport']) && !empty($pageData['getUserRegMonthReport'])){
                $getTotal = '';
                $GetMonths = '';
                foreach($pageData['getUserRegMonthReport'] as $data_count){				        
                    if($getTotal !=''){
                        $getTotal .=','.$data_count.'';
                    }else{
                        $getTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentTotal'] = $getTotal.'';
                $pageData['getCurrentMonth'] = $GetMonths;
            }           
            $this->response['responseCode'] = 200;
            $this->response['getCurrentMonthval'] = $pageData['getCurrentTotal'];
            $this->response['getMonthArry'] = MONTHS;
            echo json_encode($this->response);  exit;
        }else {
            redirect('site-admin/login');
        }
    }
    public function get_monthly_orders_data() {        
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {           
            /* Get order Report Data */
            $pageData['getOrderMonthReport'] = $this->DashboardModel->get_monthly_orders_report();
            if(isset($pageData['getOrderMonthReport']) && !empty($pageData['getOrderMonthReport'])){
                $getOrderTotal = '';
                $GetMonths = '';
                foreach($pageData['getOrderMonthReport'] as $data_count){				        
                    if($getOrderTotal !=''){
                        $getOrderTotal .=','.$data_count.'';
                    }else{
                        $getOrderTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentOrderTotal'] = $getOrderTotal.'';
                $pageData['getCurrentOrderMonth'] = $GetMonths;                
            }
            /* End Order Reort Data */        
            $pageData['getMonthArray'] = MONTHS;            
            $this->response['responseCode'] = 200;
            $this->response['getCurrentOrderTotal'] = $pageData['getCurrentOrderTotal'];
            $this->response['getCurrentSalesTotal'] = $pageData['getCurrentSalesTotal'];
            $this->response['getMonthArry'] = $pageData['getMonthArray'];
            echo json_encode($this->response);  exit;
        }else {
            redirect('site-admin/login');
        }
    }

    public function get_oreder_sales_data() {        
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {           
            /* Get order Report Data */
            $pageData['getOrderMonthReport'] = $this->DashboardModel->get_monthly_orders_report();
            if(isset($pageData['getOrderMonthReport']) && !empty($pageData['getOrderMonthReport'])){
                $getOrderTotal = '';
                $GetMonths = '';
                foreach($pageData['getOrderMonthReport'] as $data_count){				        
                    if($getOrderTotal !=''){
                        $getOrderTotal .=','.$data_count.'';
                    }else{
                        $getOrderTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentOrderTotal'] = $getOrderTotal.'';
                $pageData['getCurrentOrderMonth'] = $GetMonths;                
            }
            /* End Order Reort Data */
            /* Get Sales Report Data */
            $pageData['getSalesMonthReport'] = $this->DashboardModel->get_monthly_sales_report();
            if(isset($pageData['getSalesMonthReport']) && !empty($pageData['getSalesMonthReport'])){
                $getTotal = '';
                $GetMonths = '';
                foreach($pageData['getSalesMonthReport'] as $data_count){				        
                    if($getTotal !=''){
                        $getTotal .=','.$data_count.'';
                    }else{
                        $getTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentSalesTotal'] = $getTotal.'';
                $pageData['getCurrentSalesMonth'] = $GetMonths;
                
            }
            /* End Sales Reort Data */
            $pageData['getMonthArray'] = MONTHS;            
            $this->response['responseCode'] = 200;
            $this->response['getCurrentOrderTotal'] = $pageData['getCurrentOrderTotal'];
            $this->response['getCurrentSalesTotal'] = $pageData['getCurrentSalesTotal'];
            $this->response['getMonthArry'] = $pageData['getMonthArray'];
            echo json_encode($this->response);  exit;
        }else {
            redirect('site-admin/login');
        }
    }
    public function get_revenue_data() {        
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {        
            /* Get Sales Report Data */
            $pageData['getRevenueMonthReport'] = $this->DashboardModel->get_monthly_sales_report();
            if(isset($pageData['getRevenueMonthReport']) && !empty($pageData['getRevenueMonthReport'])){
                $getTotal = '';
                $GetMonths = '';
                foreach($pageData['getRevenueMonthReport'] as $data_count){				        
                    if($getTotal !='')
                    {
                        $getTotal .=','.$data_count.'';
                    }else{
                        $getTotal .=''.$data_count.'';
                    }                         
                }            
                $pageData['getCurrentRevenueTotal'] = $getTotal.'';
                $pageData['getCurrentRevenueMonth'] = $GetMonths;
                
            }
            /* End Sales Reort Data */
            $pageData['getMonthArray'] = MONTHS;            
            $this->response['responseCode'] = 200;
            $this->response['getCurrentRevenueTotal'] = $pageData['getCurrentRevenueTotal'];
            $this->response['getMonthArry'] = $pageData['getMonthArray'];
            echo json_encode($this->response);  exit;
        }else {
            redirect('site-admin/login');
        }
    }
    public function all_users() {     
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 2;
            $pageData['getAdminUserData'] = $this->UsrModel->get_user_data();
            $this->load->view('site_admin/user/all-users',$pageData);
        }else {
            redirect('site-admin/login');
        }   
    }
    public function create() {   
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 3;
            $pageData['countries'] = $this->CommonModel->country_list();
            $pageData['states'] = $this->CommonModel->state_list();
            $pageData['UserroleList'] = $this->UsrModel->get_admin_role_list(); 
            $this->load->view('site_admin/user/create',$pageData);
        }else {
            redirect('site-admin/login');
        }  
    }
    public function save_admin_user() {   
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
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
                                if (!preg_match("/^[1-9][0-9]*$/", $_POST['phone_no'])) {
                                    /* validate 12-digit mobile numbers */
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                    echo json_encode($this->response); exit;
                                }
                                if (isset($_POST['usr_role']) & !empty($_POST['usr_role'])) {
                                    if (!preg_match("/^[1-9][0-9]*$/", $_POST['usr_role'])) {
                                        /* validate 12-digit mobile numbers */
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = 'User Role is Required.';
                                        echo json_encode($this->response); exit;
                                    }
                                    if (isset($_POST['zipcode']) & !empty($_POST['zipcode'])) {
                                        if (!preg_match("/^[1-9][0-9]*$/", $_POST['zipcode'])) {
                                            /* validate 12-digit mobile numbers */
                                            $this->response['responseCode'] = 404;
                                            $this->response['responseMessage'] = 'Zipcode is Required.';
                                            echo json_encode($this->response); exit;
                                        }
                                        $email = trim($_POST['email'], " ");
                                        $emailExist = $this->UsrModel->chk_email_exist($email);
                                        if ($emailExist == true) {
                                            $this->response['responseCode'] = 405;
                                            $this->response['responseMessage'] = 'Email Already Exist!';
                                            echo json_encode($this->response); exit;
                                        }
                                        $usrData = new stdClass();
                                        $requestData = array(
                                            'fname' => isset($_POST['fname']) ? $_POST['fname'] : '',
                                            'lname' => isset($_POST['lname']) ? $_POST['lname'] : '',
                                            'email' => isset($_POST['email']) ? $_POST['email'] : '',
                                            'phone_no' => isset($_POST['phone_no']) ? $_POST['phone_no'] : '',
                                            'usr_role' => isset($_POST['usr_role']) ? $_POST['usr_role'] : '',
                                            'country_id' => isset($_POST['country_id']) ? $_POST['country_id'] : '',
                                            'state_id' => isset($_POST['state_id']) ? $_POST['state_id'] : '',
                                            'city_id' => isset($_POST['city_id']) ? $_POST['city_id'] : '',
                                            'zipcode' => isset($_POST['zipcode']) ? $_POST['zipcode'] : '',
                                            'fax_no' => isset($_POST['fax_no']) ? $_POST['fax_no'] : '',
                                            'address' => isset($_POST['address']) ? $_POST['address'] : '',
                                            'is_active' => 1
                                            
                                        );
                                        $usrId = $this->UsrModel->save_usr($requestData);
                                        if ($usrId == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = 'Error while adding new user information';
                                            echo json_encode($this->response); exit;
                                        } else {                                              
    
                                            $server_site_path = SERVER_SITE_PATH;
                                            $userLoginUrl = SERVER_SITE_PATH;
                                            $stvr_rt_pth_asts = SERVER_ROOT_PATH_ASSETS;

                                            /* set params for password request raised */
                                            $pwd_rst_data = array(
                                                'user_id' => $usrId,
                                                'token' => random_alpha_num(8),
                                                'reset_flag' => '1'
                                            );
                                            /* send data to database by module */
                                            $save_rst_pwd_request = $this->UsrModel->insert_rst_pwd_request($pwd_rst_data);
                                            $rst_pwd_request_id = $this->db->insert_id();

                                            /* adding last inserted id in to the requst to encode */
                                            $pwd_rst_data['rst_pwd_request_id'] = $rst_pwd_request_id;

                                            $rst_pwd_request_encd = JWT::encode($pwd_rst_data, JWT_TOKEN);
                                            $rst_pwd_request_link = SERVER_SITE_PATH . "/reset-pwd-form/" . $rst_pwd_request_encd;

                                            $email_data = array(
                                                'email_title' => 'Welcome to Matjary',
                                                'username' => $_POST['fname'] . " " . $_POST['lname'],
                                                'pass_reset' => $rst_pwd_request_link
                                            );
                                            $email_subject = "Welcome to Matjary";
                                            $email_message = $this->load->view('site_admin/emails/welcome-mail-new-admin-user', $email_data, TRUE);
                                            $emailStatus = sendEmail($_POST['email'], $email_message, $email_subject);    
                                            if ($emailStatus == true) {
                                                $this->response['responseCode'] = 200;
                                                $this->response['responseMessage'] = 'User Added Successfully.';
                                                $this->response['redirectUrl'] = base_url('site-admin/all-users');
                                                echo json_encode($this->response); exit;
                                            }else{
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_11');
                                                echo json_encode($this->response); exit;
                                            }
                                        }
                                    } else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                        echo json_encode($this->response); exit;
                                    }
                                } else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
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
            } catch (Exception $e) {
                return $e->getMessage();
            }           
        }else {
            redirect('site-admin/login');
        }  
    }
    public function edit_admin_user($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 4;
            $pageData['singleUserData'] = $this->UsrModel->get_single_user_details($id); 
            $pageData['UserroleList'] = $this->UsrModel->get_admin_role_list(); 
            $pageData['countryList'] = $this->CommonModel->country_list(); 
			$pageData['stateList'] = '';
			$pageData['cityList'] = '';
            if(isset($pageData['singleUserData'][0]->country_id) && !empty($pageData['singleUserData'][0]->country_id)){  
                $pageData['stateList'] = $this->CommonModel->get_country_states($pageData['singleUserData'][0]->country_id);
            }
			if(isset($pageData['singleUserData'][0]->state_id) && !empty($pageData['singleUserData'][0]->state_id)){    
                $pageData['cityList'] = $this->CommonModel->get_state_cities($pageData['singleUserData'][0]->state_id);
            }
            $this->load->view('site_admin/user/edit-admin-user', $pageData);
        }else{
            redirect('site-admin/login');
        }  
    }
    public function update_admin_user() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
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
                        if (isset($_POST['phone_no']) & !empty($_POST['phone_no'])) {
                            if (!preg_match("/^[1-9][0-9]*$/", $_POST['phone_no'])) {
                                /* validate 12-digit mobile numbers */
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                echo json_encode($this->response); exit;
                            } 
                            if (isset($_POST['zipcode']) & !empty($_POST['zipcode'])) {
                                if (!preg_match("/^[1-9][0-9]*$/", $_POST['zipcode'])) {
                                    /* validate 12-digit mobile numbers */
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Zipcode is Required.';
                                    echo json_encode($this->response); exit;
                                }                                

								$usrData = new stdClass();
								$updateData = array(
									'fname' => isset($_POST['fname']) ? $_POST['fname'] : '',
									'lname' => isset($_POST['lname']) ? $_POST['lname'] : '',
									'phone_no' => isset($_POST['phone_no']) ? $_POST['phone_no'] : '',
									'usr_role' => isset($_POST['usr_role']) ? $_POST['usr_role'] : '',
									'country_id' => isset($_POST['country_id']) ? $_POST['country_id'] : '',
									'state_id' => isset($_POST['state_id']) ? $_POST['state_id'] : '',
									'city_id' => isset($_POST['city_id']) ? $_POST['city_id'] : '',
									'zipcode' => isset($_POST['zipcode']) ? $_POST['zipcode'] : '',
									'fax_no' => isset($_POST['fax_no']) ? $_POST['fax_no'] : '',
									'address' => isset($_POST['address']) ? $_POST['address'] : ''                                        
								);
								$UsrInsertData = $this->UsrModel->update_user_data($updateData, $_POST['user_id']);
								if ($UsrInsertData == false) {
									$this->response['responseCode'] = 404;
									$this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
									echo json_encode($this->response); exit;
								} else {
									$this->response['responseCode'] = 200;
									$this->response['responseMessage'] = 'User Data Updated Sucessfully.';
									echo json_encode($this->response); exit;
								}
                            } else {
                                $this->response['responseCode'] = 404;
                                 $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                echo json_encode($this->response); exit;
                            }                            
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
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
            } catch (Exception $e) {
                return $e->getMessage();
            } 
        }else{
            redirect('site-admin/login');
        }  
    }
    public function deactivate_admin_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UsrModel->update_data($_POST['id'], array(
                "is_active" => 2,
                "updated_datetime" => DATETIME
            ));
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "User Deactivated Successfully.";
                $resp['redirectUrl'] = base_url('site-admin/all-user');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While User  Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "User Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_admin_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UsrModel->update_data($_POST['id'], array(
                "is_active" => 1,
                "updated_datetime" => DATETIME
            ));
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "User Activated Successfully.";
                $resp['redirectUrl'] = base_url('site-admin/all-user');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While User Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "User Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_admin_user(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->UsrModel->update_data($_POST['id'], array(
                "is_active" => 3,
                "updated_datetime" => DATETIME
            ));
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "User Removed Successfully.";
                $resp['redirectUrl'] = base_url('site-admin/all-users');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While User Deletion."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "User Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function all_categorys() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 5; 
            $pageData['getCategoryList'] = $this->CatModel->category_list();
            $this->load->view('site_admin/category/all-categorys',$pageData);
        }else {
            redirect('site-admin/login');
        }  
    }
    public function add_category() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {  
            $pageData['pageId'] = 6;                    
            $this->load->view('site_admin/category/add-category',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function save_template_category() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
                if (isset($_POST['theme_cat_name']) & !empty($_POST['theme_cat_name'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['theme_cat_name'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid category name, contains vulnerable characters';
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['theme_cat_name_ar']) & !empty($_POST['theme_cat_name_ar'])) {
                        if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {                               
                            $requestData = array(
                                'theme_cat_name' => isset($_POST['theme_cat_name']) ? $_POST['theme_cat_name'] : '',
                                'theme_cat_name_ar' => isset($_POST['theme_cat_name_ar']) ? $_POST['theme_cat_name_ar'] : '',  
                                'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                            );
                            $insertData = $this->CatModel->insert_data($requestData);
                            if ($insertData == false) {
                                $this->response['responseCode'] = 500;
                                $this->response['responseMessage'] = "Error While Data Insertion.";
                                echo json_encode($this->response); exit;
                            } else {                                              
                                $errorMsg = "Template Category Added Successfully.";                                 
                                $this->response['responseCode'] = 200;
                                $this->response['responseMessage'] = $errorMsg;
                                echo json_encode($this->response); exit;                               
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Is Active is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Template Category Name Arabic is required.';
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Template Category Name English is required ';
                    echo json_encode($this->response); exit;
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else {
            redirect('site-admin/login');
        }  
    }
    public function edit_category($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 7;
            $pageData['GetSingleCatDetails'] = $this->CatModel->get_single_cat_details($id);             
            $this->load->view('site_admin/category/edit-category', $pageData);
        }else{
            redirect('site-admin/login');
        }  
    }
    public function save_category() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
                if (isset($_POST['theme_cat_name']) & !empty($_POST['theme_cat_name'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['theme_cat_name'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid category name, contains vulnerable characters';
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['theme_cat_name_ar']) & !empty($_POST['theme_cat_name_ar'])) {
                        if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {                               
                            $updateData = array(
                                'theme_cat_name' => isset($_POST['theme_cat_name']) ? $_POST['theme_cat_name'] : '',
                                'theme_cat_name_ar' => isset($_POST['theme_cat_name_ar']) ? $_POST['theme_cat_name_ar'] : '',  
                                'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                            );
                            $insertData = $this->CatModel->update_data($updateData,$_POST['id']);
                            if ($insertData == false) {
                                $this->response['responseCode'] = 500;
                                $this->response['responseMessage'] = "Error While Template Data Insertion.";
                                echo json_encode($this->response); exit;
                            } else {                                              
                                $errorMsg = "Data Updated Successfully.";                                 
                                $this->response['responseCode'] = 200;
                                $this->response['responseMessage'] = $errorMsg;
                                echo json_encode($this->response); exit;                               
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Is Active is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Template Category Name Arabic is required.';
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Template Category Name English is required ';
                    echo json_encode($this->response); exit;
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else {
            redirect('site-admin/login');
        }  
    }
    public function deactivate_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data(array(
                "is_active" => 2,
                "updated_at" => DATETIME
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "Template Category Deactivated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Category Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Category Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data(array(
                "is_active" => 1,
                "updated_at" => DATETIME
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Template Category Activated Successfully.";
                $resp['redirectUrl'] = base_url('site-admin/all-categorys');
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Category Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Category Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_category(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data(array(
                "is_active" => 3,
                "updated_at" => DATETIME
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Template Category Removed Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Category Remove."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Category Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function deactivate_subscribers(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data_subscribers(array(
                "is_active" => 2
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "Subscriber Deactivated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Subscriber Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Subscriber Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_subscribers(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data_subscribers(array(
                "is_active" => 1
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Subscriber Activated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Subscriber Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Subscriber Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_subscribers(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CatModel->update_data_subscribers(array(
                "is_active" => 3
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Subscriber Removed Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Subscriber Removing."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Subscriber Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function all_templates() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) { 
            $pageData['pageId'] = 8;
            $pageData['getTemplateList'] = $this->TemplateModel->template_list();
            $this->load->view('site_admin/template/all-templates',$pageData);
        }else {
            redirect('site-admin/login');
        }  
    }
    public function save_template() {          
        try {
            if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
                if (isset($_POST['name']) & !empty($_POST['name'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['name'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid template name, contains vulnerable characters';
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['name_ar']) & !empty($_POST['name_ar'])) {
                        if (isset($_POST['is_active']) & !empty($_POST['is_active'])) { 
                            if(isset($_FILES['template_full_banner']['name']) && !empty($_FILES['template_full_banner']['name'])){
                                if(isset($_FILES['template_half_banner']['name']) && !empty($_FILES['template_half_banner']['name'])){
                                    $InserData = array(
                                        'name' => isset($_POST['name']) ? $_POST['name'] : '',
                                        'name_ar' => isset($_POST['name_ar']) ? $_POST['name_ar'] : '',
                                        'category_id' => isset($_POST['category_id']) ? $_POST['category_id'] : '',
                                        'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : '',
                                        'free_paid_flag' => isset($_POST['free_paid_flag']) ? $_POST['free_paid_flag'] : '',
                                        'template_cost' => isset($_POST['template_cost']) ? $_POST['template_cost'] : '0',
                                        'demo_link' => isset($_POST['demo_link']) ? $_POST['demo_link'] : '',  
                                        'description' => isset($_POST['description']) ? $_POST['description'] : '',
                                        'description_ar' => isset($_POST['description_ar']) ? $_POST['description_ar'] : ''                               
                                    );
                                    $lat_insert_id = $this->TemplateModel->insert_data($InserData);
                                    if (isset($lat_insert_id) && !empty($lat_insert_id)) {
                                        /* uploading half banner image start */
                                        if(isset($_FILES['template_half_banner']['name']) && !empty($_FILES['template_half_banner']['name'])){
                                            $original_template_half_banner_name = $_FILES['template_half_banner']['name']; /* Get the original name of the uploaded file */
                                            $unique_id = uniqid(); /* Generate a unique ID based on the current time in microseconds */
                                            $encrypted_name = md5($unique_id); /* Encrypt the unique ID using the MD5 algorithm */
                                            $file_extension = pathinfo($original_template_half_banner_name, PATHINFO_EXTENSION); /* Get the file extension */
                                            $new_name = $encrypted_name . '.' . $file_extension; /* Combine the encrypted name and file extension */
                                            $destination = './uploads/template_half_banners/' . $new_name; /* Specify the directory where the file will be moved to */
                                            if (move_uploaded_file($_FILES['template_half_banner']['tmp_name'], $destination)) { /* Move the uploaded file to the new location */
                                                $updateImg = array(
                                                    'id' => $lat_insert_id,
                                                    'template_half_banner' => $new_name
                                                );
                                                $uptStatus = $this->TemplateModel->update_data($updateImg,$lat_insert_id);
                                                if ($uptStatus == false) {
                                                    $this->response['responseCode'] = 500;
                                                    $this->response['responseMessage'] = 'Error While updating half banner image.';
                                                    echo json_encode($this->response); exit;
                                                }
                                            } else {
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = 'An error occurred while uploading the half banner image.';
                                                echo json_encode($this->response); exit;
                                            }
                                        }
                                        /* uploading half banner image end */
                                        
                                        /* uploading full banner image start */
                                        if(isset($_FILES['template_full_banner']['name']) && !empty($_FILES['template_full_banner']['name'])){
                                            $original_template_full_banner_name = $_FILES['template_full_banner']['name']; /* Get the original name of the uploaded file */
                                            $unique_id = uniqid(); /* Generate a unique ID based on the current time in microseconds */
                                            $encrypted_name = md5($unique_id); /* Encrypt the unique ID using the MD5 algorithm */
                                            $file_extension = pathinfo($original_template_full_banner_name, PATHINFO_EXTENSION); /* Get the file extension */
                                            $new_name = $encrypted_name . '.' . $file_extension; /* Combine the encrypted name and file extension */
                                            $destination = './uploads/template_full_banners/' . $new_name; /* Specify the directory where the file will be moved to */
                                            if (move_uploaded_file($_FILES['template_full_banner']['tmp_name'], $destination)) { /* Move the uploaded file to the new location */
                                                $updateImg = array(
                                                    'id' => $lat_insert_id,
                                                    'template_full_banner' => $new_name
                                                );
                                                $uptStatus = $this->TemplateModel->update_data($updateImg,$lat_insert_id);
                                                if ($uptStatus == false) {
                                                    $this->response['responseCode'] = 500;
                                                    $this->response['responseMessage'] = 'Error While updating full banner image.';
                                                    echo json_encode($this->response); exit;
                                                }
                                            } else {
                                                $this->response['responseCode'] = 500;
                                                $this->response['responseMessage'] = 'An error occurred while uploading the full banner image.';
                                                echo json_encode($this->response); exit;
                                            }
                                        }
                                        /* uploading full banner image end */
                                        $this->response['responseCode'] = 200;
                                        $this->response['responseMessage'] = "Template Added Successfully.";
                                        $this->response['redirectUrl'] = base_url('site-admin/all-templates');
                                        echo json_encode($this->response); exit;
                                    }else{
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = "Error While Adding Template Data.";
                                        echo json_encode($this->response); exit;
                                    }
                                }else{
                                    $this->response['responseCode'] = 404;                                    
                                    $this->response['responseMessage'] = 'Half Banner Is Required.';
                                    echo json_encode($this->response); exit;
                                }
                            }else{
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] =  "Full Banner Is Required.";
                                echo json_encode($this->response); exit;
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Is Active is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Template Name Arabic is required.';
                        echo json_encode($this->response); exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Template Name English is required ';
                    echo json_encode($this->response); exit;
                }
            }else {
                redirect('site-admin/login');
            }  
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit_save_template() {      
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
                if (isset($_POST['name']) & !empty($_POST['name'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['name'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Invalid template name, contains vulnerable characters';
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['name_ar']) & !empty($_POST['name_ar'])) {
                        if (isset($_POST['is_active']) & !empty($_POST['is_active'])) { 
                            $UpdateData = array(
                                'name' => isset($_POST['name']) ? $_POST['name'] : '',
                                'name_ar' => isset($_POST['name_ar']) ? $_POST['name_ar'] : '',
                                'category_id' => isset($_POST['category_id']) ? $_POST['category_id'] : '',
                                'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : '',
                                'free_paid_flag' => isset($_POST['free_paid_flag']) ? $_POST['free_paid_flag'] : '',
                                'template_cost' => isset($_POST['template_cost']) ? $_POST['template_cost'] : '0',
                                'demo_link' => isset($_POST['demo_link']) ? $_POST['demo_link'] : '',  
                                'description' => isset($_POST['description']) ? $_POST['description'] : '',
                                'description_ar' => isset($_POST['description_ar']) ? $_POST['description_ar'] : ''                               
                            );
                            $updateStatus = $this->TemplateModel->update_data($UpdateData,$_POST['id']);
                            if($updateStatus==true){
                                /* uploading half banner image start */
                                if(isset($_FILES['template_half_banner']['name']) && !empty($_FILES['template_half_banner']['name'])){
                                    $original_template_half_banner_name = $_FILES['template_half_banner']['name']; /* Get the original name of the uploaded file */
                                    $unique_id = uniqid(); /* Generate a unique ID based on the current time in microseconds */
                                    $encrypted_name = md5($unique_id); /* Encrypt the unique ID using the MD5 algorithm */
                                    $file_extension = pathinfo($original_template_half_banner_name, PATHINFO_EXTENSION); /* Get the file extension */
                                    $new_name = $encrypted_name . '.' . $file_extension; /* Combine the encrypted name and file extension */
                                    $destination = './uploads/template_half_banners/' . $new_name; /* Specify the directory where the file will be moved to */
                                    if (move_uploaded_file($_FILES['template_half_banner']['tmp_name'], $destination)) { /* Move the uploaded file to the new location */
                                        $updateImg = array(
                                            'id' => $_POST['id'],
                                            'template_half_banner' => $new_name
                                        );
                                        $uptStatus = $this->TemplateModel->update_data($updateImg,$_POST['id']);
                                        if ($uptStatus == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = 'Error While updating half banner image.';
                                            echo json_encode($this->response); exit;
                                        }
                                    } else {
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = 'An error occurred while uploading the half banner image.';
                                        echo json_encode($this->response); exit;
                                    }
                                }
                                /* uploading half banner image end */
                                
                                /* uploading full banner image start */
                                if(isset($_FILES['template_full_banner']['name']) && !empty($_FILES['template_full_banner']['name'])){
                                    $original_template_full_banner_name = $_FILES['template_full_banner']['name']; /* Get the original name of the uploaded file */
                                    $unique_id = uniqid(); /* Generate a unique ID based on the current time in microseconds */
                                    $encrypted_name = md5($unique_id); /* Encrypt the unique ID using the MD5 algorithm */
                                    $file_extension = pathinfo($original_template_full_banner_name, PATHINFO_EXTENSION); /* Get the file extension */
                                    $new_name = $encrypted_name . '.' . $file_extension; /* Combine the encrypted name and file extension */
                                    $destination = './uploads/template_full_banners/' . $new_name; /* Specify the directory where the file will be moved to */
                                    if (move_uploaded_file($_FILES['template_full_banner']['tmp_name'], $destination)) { /* Move the uploaded file to the new location */
                                        $updateImg = array(
                                            'id' => $_POST['id'],
                                            'template_full_banner' => $new_name
                                        );
                                        $uptStatus = $this->TemplateModel->update_data($updateImg,$_POST['id']);
                                        if ($uptStatus == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = 'Error While updating full banner image.';
                                            echo json_encode($this->response); exit;
                                        }
                                    } else {
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = 'An error occurred while uploading the full banner image.';
                                        echo json_encode($this->response); exit;
                                    }
                                }
                                /* uploading full banner image end */

                                $this->response['responseCode'] = 200;
                                $this->response['responseMessage'] =  "Data Updated Sucessfully.";
                                $this->response['redirectUrl'] = base_url('site-admin/all-templates');
                                echo json_encode($this->response); exit;
                            }else{
                                $this->response['responseCode'] = 500;
                                $this->response['responseMessage'] = 'Error While Updating Template Information.';
                                echo json_encode($this->response);exit;
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Is Active is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Template Name Arabic is required.';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Template Name English is required ';
                    echo json_encode($this->response);
                    exit;
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else {
            redirect('site-admin/login');
        }  
    }
    public function edit_template($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 9;
            $pageData['GetSingleTemDetails'] = $this->TemplateModel->get_single_template_details($id);
            $pageData['getCategoryList'] = $this->CatModel->category_list();             
            $this->load->view('site_admin/template/edit-template', $pageData);
        }else{
            redirect('site-admin/login');
        }
    }      
    public function deactivate_template(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->TemplateModel->update_data_template(array(
                "is_active" => 2
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "Template Deactivated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_template(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->TemplateModel->update_data_template(array(
                "is_active" => 1
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Template Activated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_template(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->TemplateModel->update_data_template(array(
                "is_active" => 3
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Template Deleted Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Template Deletion."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Template Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function all_subscribers() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 10;
            $pageData['getSubscribersList'] = $this->CatModel->subscribers_list();
            $this->load->view('site_admin/subscriber/all-subscribers',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function add_template() {        
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) { 
            $pageData['pageId'] = 11;
            $pageData['getCategoryList'] = $this->CatModel->category_list();
            $this->load->view('site_admin/template/add-template',$pageData);
        }else {
            redirect('site-admin/login');
        } 
    }    
    public function all_plans() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 13;
            $pageData['getPlansList'] = $this->PlanModel->plans_list();
            $this->load->view('site_admin/plans/all-plans',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function add_plan() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 14;
            $this->load->view('site_admin/plans/add-plan',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function save_plan() {
        try {
            if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
                if (isset($_POST['plan_name']) & !empty($_POST['plan_name'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['plan_name'])) {
                        /* one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2');
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['plan_desc']) & !empty($_POST['plan_desc'])) {
                        if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['plan_desc'])) {
                            /* one or more of the 'special characters' found in string */
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3');
                            echo json_encode($this->response); exit;
                        }                        
                        if (isset($_POST['plan_periods']) & !empty($_POST['plan_periods'])) {
                            if (isset($_POST['price']) & !empty($_POST['price'])) {
                                if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {                               
                                    $insertData = array(
                                        'plan_name' => isset($_POST['plan_name']) ? $_POST['plan_name'] : '',
                                        'plan_desc' => isset($_POST['plan_desc']) ? $_POST['plan_desc'] : '',
                                        'validity_in_months' => isset($_POST['plan_periods']) ? $_POST['plan_periods'] : '', 
                                        'price' => isset($_POST['price']) ? $_POST['price'] : '',  
                                        'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                                    );
                                    $insertDatas = $this->PlanModel->insert_data($insertData);
                                    $insert_id = $this->db->insert_id();
                                    if ($insertDatas == false) {
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = "Error While Plan Data Insertion.";
                                        echo json_encode($this->response); exit;
                                    } else {
                                        $engArr = $_POST['feature_name_en'];
                                        $arArr = $_POST['feature_name_ar'];
                                        if(!empty($engArr)){
                                            for($i = 0; $i < count($engArr); $i++){
                                                if(!empty($arArr[$i])){
                                                    $data = array(
                                                        'plan_id' => $insert_id,
                                                        'feature_name_en' => $engArr[$i],
                                                        'feature_name_ar' => $arArr[$i],
                                                        'is_active' => 1,
                                                        'created_dt' => DATETIME
                                                    );
                                                    $insertStatus = $this->PlanModel->insert_data_plans($data);
                                                    if($insertStatus==false){
                                                        $this->response['responseCode'] = 404;
                                                        $this->response['responseMessage'] = 'Error While Inserting Features of Plan.';
                                                        echo json_encode($this->response); exit;
                                                    }
                                                }
                                            }
                                        }
                                                                      
                                        $this->response['responseCode'] = 200;
                                        $this->response['responseMessage'] = "Plan Data Added Successfully.";  
                                        echo json_encode($this->response); exit;                               
                                    }
                                }else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Is Active is required.';
                                    echo json_encode($this->response);exit;
                                }
                            }else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Plan Price is required.';
                                echo json_encode($this->response);exit;
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Plan Periods is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Plan Description is required.';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Plan Name is required ';
                    echo json_encode($this->response);
                    exit;
                }
            }else {
                redirect('site-admin/login');
            }  
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit_plan($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 17;
            $pageData['GetSinglePlanDetails'] = $this->PlanModel->get_single_plan_details($id);
            $pageData['getPlanFetauresList'] = $this->PlanModel->plan_fetaure_list($id); 
            $this->load->view('site_admin/plans/edit-plan', $pageData);
        }else{
            redirect('site-admin/login');
        }
    }
    public function update_plan(){
        try {
            if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
                if(isset($_POST['plan_id']) & !empty($_POST['plan_id'])){
                    if (isset($_POST['plan_name']) & !empty($_POST['plan_name'])) {
                        if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['plan_name'])) {
                            /* // one or more of the 'special characters' found in string */
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2');
                            echo json_encode($this->response); exit;
                        }
                        if (isset($_POST['plan_desc']) & !empty($_POST['plan_desc'])) {
                            if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['plan_desc'])) {
                                /* // one or more of the 'special characters' found in string */
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3');
                                echo json_encode($this->response); exit;
                            }                        
                            if (isset($_POST['plan_periods']) & !empty($_POST['plan_periods'])) {
                                if (isset($_POST['price']) & !empty($_POST['price'])) {
                                    if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {                               
                                                
                                        $requestData = array(
                                            'id' => isset($_POST['plan_id']) ? $_POST['plan_id'] : '',
                                            'plan_name' => isset($_POST['plan_name']) ? $_POST['plan_name'] : '',
                                            'plan_desc' => isset($_POST['plan_desc']) ? $_POST['plan_desc'] : '',
                                            'validity_in_months' => isset($_POST['plan_periods']) ? $_POST['plan_periods'] : '', 
                                            'price' => isset($_POST['price']) ? $_POST['price'] : '',  
                                            'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                                        );
                                        $updateStatus = $this->PlanModel->update_data_plan($requestData,$_POST['plan_id']);
                                        if ($updateStatus == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = "Error While Plan Data Insertion.";
                                            echo json_encode($this->response); exit;
                                        } else {

                                            $engArr = $_POST['feature_name_en'];
                                            $arArr = $_POST['feature_name_ar'];
                                            if(!empty($engArr)){
                                                /*remove old plan features */
                                                $removeStatus = $this->PlanModel->remove_plan_features($_POST['plan_id']);
                                                if($removeStatus==false){
                                                    $this->response['responseCode'] = 404;
                                                    $this->response['responseMessage'] = 'Error While Removing Old Features of Plan.';
                                                    echo json_encode($this->response); exit;
                                                }
                                                for($i = 0; $i < count($engArr); $i++){
                                                    if(!empty($arArr[$i])){
                                                        $data = array(
                                                            'plan_id' => $_POST['plan_id'],
                                                            'feature_name_en' => $engArr[$i],
                                                            'feature_name_ar' => $arArr[$i],
                                                            'is_active' => 1,
                                                            'created_dt' => DATETIME
                                                        );
                                                        $insertStatus = $this->PlanModel->insert_data_plans($data);
                                                        if($insertStatus==false){
                                                            $this->response['responseCode'] = 404;
                                                            $this->response['responseMessage'] = 'Error While Inserting New Features of Plan.';
                                                            echo json_encode($this->response); exit;
                                                        }
                                                    }
                                                }
                                            }                                                                     
                                            $this->response['responseCode'] = 200;
                                            $this->response['responseMessage'] = "Plan Data Updated Successfully."; 
                                            echo json_encode($this->response); exit;                               
                                        }
                                    }else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = 'Is Active is required.';
                                        echo json_encode($this->response);exit;
                                    }
                                }else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Plan Price is required.';
                                    echo json_encode($this->response);exit;
                                }
                            }else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Plan Periods is required.';
                                echo json_encode($this->response);exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Plan Description is required.';
                            echo json_encode($this->response);
                            exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Plan Name is required ';
                        echo json_encode($this->response);
                        exit;
                    }
                }else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Plan id is required ';
                    echo json_encode($this->response);
                    exit;
                }
            }else {
                redirect('site-admin/login');
            } 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function deactivate_plan(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->PlanModel->update_data_plan(array(
                "is_active" => 2
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "Plan Deactivated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Plan Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Plan Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_plan(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->PlanModel->update_data_plan(array(
                "is_active" => 1
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Plan Activated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Plan Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Plan Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_plan(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->PlanModel->update_data_plan(array(
                "is_active" => 3
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Plan Removed Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Plan Removing."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Plan Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function profile() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 15;
            $pageData['getAdminUserData'] = $this->UsrModel->user_profile_details($this->loggedInSuperAdminData['id']);
            $pageData['countryList'] = $this->CommonModel->country_list(); 
			$pageData['stateList'] = '';
			$pageData['cityList'] = '';
            if(isset($pageData['getAdminUserData']->country_id) && !empty($pageData['getAdminUserData']->country_id)){  
                $pageData['stateList'] = $this->CommonModel->get_country_states($pageData['getAdminUserData']->country_id);
            }
			if(isset($pageData['getAdminUserData']->state_id) && !empty($pageData['getAdminUserData']->state_id)){    
                $pageData['cityList'] = $this->CommonModel->get_state_cities($pageData['getAdminUserData']->state_id);
            }            
            $this->load->view('site_admin/profile',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function save_profile() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            try {
                if (isset($_POST['fname']) & !empty($_POST['fname'])) {
                    if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['fname'])) {
                        /* // one or more of the 'special characters' found in string */
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_2');
                        echo json_encode($this->response); exit;
                    }
                    if (isset($_POST['lname']) & !empty($_POST['lname'])) {
                        if (preg_match('/[\'^£$%&*()}{@#~?><>|=+]/', $_POST['lname'])) {
                            /* // one or more of the 'special characters' found in string */
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_3');
                            echo json_encode($this->response); exit;
                        }                        
                        if (isset($_POST['phone_no']) & !empty($_POST['phone_no'])) {
                            if (!preg_match("/^[1-9][0-9]*$/", $_POST['phone_no'])) {
                                /* validate 12-digit mobile numbers */
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
                                echo json_encode($this->response); exit;
                            } 
                            if (isset($_POST['zipcode']) & !empty($_POST['zipcode'])) {
                                if (!preg_match("/^[1-9][0-9]*$/", $_POST['zipcode'])) {
                                    /* validate 12-digit mobile numbers */
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Zipcode is Required.';
                                    echo json_encode($this->response); exit;
                                }                                

								$usrData = new stdClass();
								$updateData = array(
									'fname' => isset($_POST['fname']) ? $_POST['fname'] : '',
									'lname' => isset($_POST['lname']) ? $_POST['lname'] : '',
									'phone_no' => isset($_POST['phone_no']) ? $_POST['phone_no'] : '',
									'usr_role' => 1,
									'country_id' => isset($_POST['country_id']) ? $_POST['country_id'] : '',
									'state_id' => isset($_POST['state_id']) ? $_POST['state_id'] : '',
									'city_id' => isset($_POST['city_id']) ? $_POST['city_id'] : '',
									'zipcode' => isset($_POST['zipcode']) ? $_POST['zipcode'] : '',
									'fax_no' => isset($_POST['fax_no']) ? $_POST['fax_no'] : '',
									'address' => isset($_POST['address']) ? $_POST['address'] : ''                                        
								);
								$UsrInsertData = $this->UsrModel->update_user_data($updateData, $_POST['user_id']);
								if ($UsrInsertData == false) {
									$this->response['responseCode'] = 404;
									$this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_35');
									echo json_encode($this->response); exit;
								} else {
									$this->response['responseCode'] = 200;
									$this->response['responseMessage'] = 'Data Updated Sucessfully.';
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
                            $this->response['responseMessage'] = $this->lang->line('usr_cntr_msg_14');
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
                return $e->getMessage();
            } 
        }else{
            redirect('site-admin/login');
        }
    }
    public function change_password() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {            
            $this->load->view('site_admin/change-password');
        }else {
            redirect('site-admin/login');
        }
    }
    public function change_admin_password() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            if ($this->input->post() != "") {
                $user_id = $this->loggedInSuperAdminData['id'];
                /* check if old password entered macthes woth old password is in database */
                $old_pwd_details = $this->get_user_profile_details();
                $old_pwd_details_temp = json_decode($old_pwd_details, TRUE);
                $old_db_pswrd = $old_pwd_details_temp['responseData']['pswrd'];
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
        }else {
            redirect('site-admin/login');
        }
    }
    public function get_user_profile_details() {
        $usrDomainData = new stdClass();
        $getUserProfileDetails = base_url('user-profile-details');
        $requestData = array(
            'user_id' => $this->loggedInSuperAdminData['id']
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
    public function generate_password($password) {
        $encrypted_pass = hash_hmac("SHA256", $password, SECRET_KEY);
        return $encrypted_pass;
    }
    public function all_stores() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 18;
            $pageData['getStoresList'] = $this->PlanModel->stores_list();
            $this->load->view('site_admin/store/all-stores',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function store_details($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 23;
            $GetUsrInvoiceDetails = $this->PlanModel->get_user_store_payment_info($id);
            if (isset($GetUsrInvoiceDetails) && !empty($GetUsrInvoiceDetails)) {
            $pageData['billingAddress'] = unserialize($GetUsrInvoiceDetails->bill_info_address);
            }
            $pageData['GetUsrInvoiceDetails'] = $GetUsrInvoiceDetails;           
            $this->load->view('site_admin/store/store-details', $pageData);
        }else{
            redirect('site-admin/login');
        }
    }
    public function all_coupons() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 20;
            $pageData['getCouponsList'] = $this->CouponModel->coupons_list();
            $this->load->view('site_admin/coupon/all-coupons',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function add_coupon() {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 21;
            $this->load->view('site_admin/coupon/add-coupon',$pageData);
        }else {
            redirect('site-admin/login');
        }
    }
    public function save_coupon() {
        try {
            if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
                if (isset($_POST['code']) & !empty($_POST['code'])) {                   
                    if (isset($_POST['discount_in_percent']) & !empty($_POST['discount_in_percent'])) {                                           
                        if (isset($_POST['start_date']) & !empty($_POST['start_date'])) {
                            if (isset($_POST['expiry_date']) & !empty($_POST['expiry_date'])) {
                                if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {     
                                    
                                    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
                                    $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date']));
                                            
                                    $insertData = array(
                                        'code' => isset($_POST['code']) ? $_POST['code'] : '',
                                        'discount_in_percent' => isset($_POST['discount_in_percent']) ? $_POST['discount_in_percent'] : '',
                                        'start_date' => isset($start_date) ? $start_date : '', 
                                        'expiry_date' => isset($expiry_date) ? $expiry_date : '',                                      
                                        'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                                    );
                                    $insertDatas = $this->CouponModel->insert_data($insertData);
                                    if ($insertDatas == false) {
                                        $this->response['responseCode'] = 500;
                                        $this->response['responseMessage'] = "Error While Coupon Data Insertion.";
                                        echo json_encode($this->response); exit;
                                    } else {                         
                                        $this->response['responseCode'] = 200;
                                        $this->response['responseMessage'] = "Coupon Data Added Successfully.";  
                                        echo json_encode($this->response); exit;                               
                                    }
                                }else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Is Active is required.';
                                    echo json_encode($this->response);exit;
                                }
                            }else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Expiry Date is required.';
                                echo json_encode($this->response);exit;
                            }
                        }else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Start Date is required.';
                            echo json_encode($this->response);exit;
                        }
                    } else {
                        $this->response['responseCode'] = 404;
                        $this->response['responseMessage'] = 'Discount is required.';
                        echo json_encode($this->response);
                        exit;
                    }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Code is required ';
                    echo json_encode($this->response);
                    exit;
                }
            }else {
                redirect('site-admin/login');
            }  
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit_coupon($id) {
        if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
            $pageData['pageId'] = 22;
            $pageData['GetSingleCouponDetails'] = $this->CouponModel->get_user_store_payment_info($id);
            $this->load->view('site_admin/coupon/edit-coupon', $pageData);
        }else{
            redirect('site-admin/login');
        }
    }
    public function update_coupon(){
        try {
            if (isset($this->loggedInSuperAdminData['id']) && !empty($this->loggedInSuperAdminData['id'])) {
                if(isset($_POST['id']) & !empty($_POST['id'])){                  
                        if (isset($_POST['discount_in_percent']) & !empty($_POST['discount_in_percent'])) {                                           
                            if (isset($_POST['start_date']) & !empty($_POST['start_date'])) {
                                if (isset($_POST['expiry_date']) & !empty($_POST['expiry_date'])) {
                                    if (isset($_POST['is_active']) & !empty($_POST['is_active'])) {     
                                        
                                        $start_date = date('Y-m-d', strtotime($_POST['start_date']));
                                        $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date']));
                                                
                                        $updateData = array(
                                            'discount_in_percent' => isset($_POST['discount_in_percent']) ? $_POST['discount_in_percent'] : '',
                                            'start_date' => isset($start_date) ? $start_date : '', 
                                            'expiry_date' => isset($expiry_date) ? $expiry_date : '',                                      
                                            'is_active' => isset($_POST['is_active']) ? $_POST['is_active'] : ''
                                        );
                                        $updateDatas = $this->CouponModel->update_data($updateData,$_POST['id']);
                                        if ($updateDatas == false) {
                                            $this->response['responseCode'] = 500;
                                            $this->response['responseMessage'] = "Error While Coupon Data Updation.";
                                            echo json_encode($this->response); exit;
                                        } else {                         
                                            $this->response['responseCode'] = 200;
                                            $this->response['responseMessage'] = "Coupon Data Updated Successfully.";  
                                            echo json_encode($this->response); exit;                               
                                        }
                                    }else {
                                        $this->response['responseCode'] = 404;
                                        $this->response['responseMessage'] = 'Is Active is required.';
                                        echo json_encode($this->response);exit;
                                    }
                                }else {
                                    $this->response['responseCode'] = 404;
                                    $this->response['responseMessage'] = 'Expiry Date is required.';
                                    echo json_encode($this->response);exit;
                                }
                            }else {
                                $this->response['responseCode'] = 404;
                                $this->response['responseMessage'] = 'Start Date is required.';
                                echo json_encode($this->response);exit;
                            }
                        } else {
                            $this->response['responseCode'] = 404;
                            $this->response['responseMessage'] = 'Discount is required.';
                            echo json_encode($this->response);
                            exit;
                        }
                } else {
                    $this->response['responseCode'] = 404;
                    $this->response['responseMessage'] = 'Id is required ';
                    echo json_encode($this->response);
                    exit;
                }
            }else {
                redirect('site-admin/login');
            }  
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function deactivate_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CouponModel->update_data(array(
                "is_active" => 2
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] = "Coupon Deactivated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Coupon Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Coupon Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function activate_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CouponModel->update_data(array(
                "is_active" => 1
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Coupon Activated Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Coupon Deletion.";
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Coupon Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
    public function delete_coupon(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            /* update user status in database table name as 'users' */
            $affectedRowId = $this->CouponModel->update_data(array(
                "is_active" => 3
            ), $_POST['id']);
            if($affectedRowId == true){
                $resp['responseCode'] = 200;
                $resp['responseMessage'] =  "Coupon Removed Successfully.";
                echo json_encode($resp); exit;
            }else{
                $resp['responseCode'] = 404;
                $resp['responseMessage'] =  "Error While Coupon Removing."; 
                echo json_encode($resp); exit;
            }
        }else{
            $resp['responseCode'] = 404;
            $resp['responseMessage'] =  "Coupon Id Is Required.";
            echo json_encode($resp); exit;
        }
    }
}
