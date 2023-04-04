<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AdminController extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Add your code here.
        
    }

    public function index(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Dashboard';
            $this->pageData['dashboardAnalytics'] = $this->CommonModel->dashboard_analytics();
            $this->pageData['getCurrentYrProfit'] = $this->CommonModel->get_current_year_profit();
            //$this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data($this->ses_lang);
            if(isset($this->pageData['getCurrentYrProfit'][0]) && !empty($this->pageData['getCurrentYrProfit'][0])){
                $getTotalAmt[0] = '';
                $GetMonths = '';
                foreach($this->pageData['getCurrentYrProfit'][0] as $data_count){				        
                    if($getTotalAmt[0] !='')
                    {
                        $getTotalAmt[0] .=','.$data_count.'';
                    }else{
                        $getTotalAmt[0] .=''.$data_count.'';
                    }                         
                }            
                $this->pageData['getCurrentTotal'] = $getTotalAmt[0];
                $this->pageData['getCurrentMonth'] = $GetMonths;
            }           
            $this->pageData['bestSellingProducts'] = $this->CommonModel->best_selling_products();
            if(isset($this->pageData['bestSellingProducts']) && !empty($this->pageData['bestSellingProducts'])){
                foreach($this->pageData['bestSellingProducts'] as $val){               
                    $this->pageData['getSellingProducts'][] = $this->ProductModel->get_single_prod_details($val->product_id);                      
                }                       
            }    
            return view('store_admin/dashboard',$this->pageData);      
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function login(){
        $this->pageData['pageTitle'] = 'Store Admin Login';
        //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
        return view('store_admin/user/login',$this->pageData);
    }    

    public function dashboard(){
        if(isset($this->ses_user_logged_in) && $this->ses_user_logged_in===true){
            $this->is_all_mandotory_modules_filled();
            $this->pageData['pageTitle'] = 'Dashboard';
            $this->pageData['dashboardAnalytics'] = $this->CommonModel->dashboard_analytics();
            $this->pageData['getCurrentYrProfit'] = $this->CommonModel->get_current_year_profit();
            //$this->pageData['storeSettingInfo'] = $this->SettingModel->get_store_setting_data();
            //$this->pageData['notificationInfo'] = $this->NotificationsModel->get_all_data($this->ses_lang);
            if(isset($this->pageData['getCurrentYrProfit'][0]) && !empty($this->pageData['getCurrentYrProfit'][0])){
                $getTotalAmt[0] = '';
                $GetMonths = '';
                foreach($this->pageData['getCurrentYrProfit'][0] as $data_count){				        
                    if($getTotalAmt[0] !='')
                    { 
                        $getTotalAmt[0] .=','.$data_count.'';
                    }else
                    {
                    $getTotalAmt[0] .=''.$data_count.'';
                    }                         
                }         
                $this->pageData['getCurrentTotal'] = $getTotalAmt[0];
                $this->pageData['getCurrentMonth'] = $GetMonths;
            }                
            $this->pageData['bestSellingProducts'] = $this->CommonModel->best_selling_products();
            if(isset($this->pageData['bestSellingProducts']) && !empty($this->pageData['bestSellingProducts'])){
                foreach($this->pageData['bestSellingProducts'] as $val){               
                    $pageData['getSellingProducts'][] = $this->ProductModel->get_single_prod_details($val->product_id);                      
                }                       
            }           
            return view('store_admin/dashboard',$this->pageData); 
        }else{
            return redirect()->to('/admin/login');
        }
    }

    public function mandatory_modules(){
        $this->pageData['pageTitle'] = 'Store Admin Mandotory Modules';
        return view('store_admin/mandatory-modules',$this->pageData);
    }
   
}

?>



