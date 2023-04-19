<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'array', 'html', 'form', 'JWT', 'file'));
        $this->load->library(array('form_validation', 'session', 'restclient', 'JWT', 'upload', 'pagination', 'image_lib', 'Encryption'));
        $this->response = array("responseCode" => 0, "responseMessage" => "", "responseData" => array());
        $this->load->model(array('UsrModel', 'CommonModel', 'WebModel', 'TemplateModel','CatModel','PlanModel','DashboardModel','CouponModel','EmployeeModel'));

        if ($this->session->userdata('loggedInUsrData')) {
            $this->loggedInUsrData = $this->session->userdata('loggedInUsrData');
        }

        if ($this->session->userdata('loggedInSuperAdminData')) {
            $this->loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
        }
    }

    public function is_native_app_token_validate($apiValidToken) {
        $nativeapptoken = json_decode(NATIVEAPPTOKENS);
        if (isset($nativeapptoken) && !empty($nativeapptoken)) {
            if (in_array($apiValidToken, $nativeapptoken)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function create_store($sub_domain_name, $template_id) {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://88h0y8lga1.execute-api.ap-south-1.amazonaws.com/staging/generate?sub=' . $sub_domain_name . '&template=' . $template_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: tZRzXFXLitGWxoNfhqOq2ojDfkyBWVOa26T5oN4e'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $resAry = json_decode($response);
        return $resAry;

        /*
          $request = new HttpRequest();
          $request->setUrl('https://88h0y8lga1.execute-api.ap-south-1.amazonaws.com/staging/generate');
          $request->setMethod(HTTP_METH_GET);

          $request->setQueryData(array(
          'sub' => $sub_domain_name,
          'template' => $template_id
          ));

          $request->setHeaders(array(
          'postman-token' => '6ed6740f-bff4-7054-476a-89c5322a5dca',
          'cache-control' => 'no-cache',
          'x-api-key' => 'tZRzXFXLitGWxoNfhqOq2ojDfkyBWVOa26T5oN4e',
          'content-type' => 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
          ));

          try {
          $response = $request->send();

          return $response->getBody();
          } catch (HttpException $ex) {
          return $ex;
          }
         */
    }

    function callAPI($method, $url, $data){
        
        $curl = curl_init();
        switch ($method){
           case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
           case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
           default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        /* OPTIONS: */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        /* EXECUTE: */
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

}

?>
