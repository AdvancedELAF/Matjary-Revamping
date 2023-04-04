<?php

class TestController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'array', 'html', 'form', 'JWT', 'file'));
        //$this->load->library(array('form_validation', 'session', 'restclient', 'JWT', 'Smartie', 'upload', 'pagination', 'image_lib', 'Encryption'));
        $this->response = array("responseCode" => 0, "responseMessage" => "", "responseData" => array());
        $this->load->model(array('UsrModel'));
    }

    public function update_garage_uniqe_id() {

        $errorStatus = true;
        $garageList = $this->CommonModel->all_srvc_cntrs();
        foreach ($garageList as $key => $value) {
            # code...
            $str_result = 'G';

            // $usr_ip = $_SERVER['REMOTE_ADDR'];
            // $geolocationInfo = file_get_contents('https://www.iplocate.io/api/lookup/' . $usr_ip);
            // $geolocationResilt = json_decode($geolocationInfo);
            $country_code = 'S';
            // $country_code = isset($geolocationResilt->country_code)?$geolocationResilt->country_code:'';
            // $country_code = isset($country_code)?substr($country_code, 0, 1):'';
            $str_result .= $country_code;

            $garageMaxId = (string) $value->id;
            if (strlen($garageMaxId) == 1) {
                $garageMaxId = '00000' . $garageMaxId;
            } elseif (strlen($garageMaxId) == 2) {
                $garageMaxId = '0000' . $garageMaxId;
            } elseif (strlen($garageMaxId) == 3) {
                $garageMaxId = '000' . $garageMaxId;
            } elseif (strlen($garageMaxId) == 4) {
                $garageMaxId = '00' . $garageMaxId;
            } elseif (strlen($garageMaxId) == 5) {
                $garageMaxId = '0' . $garageMaxId;
            } elseif (strlen($garageMaxId) == 6) {
                $garageMaxId = $garageMaxId;
            }

            $str_result .= $garageMaxId;
            $serial_id = $str_result;
            $requestData = array(
                'id' => $value->id,
                'serial_id' => $serial_id
            );
            $srvcCntrUptStatus = $this->PartnerModel->update_prtnr_srvc_cntr_brnch_info($requestData);
            if ($srvcCntrUptStatus == false) {
                $errorStatus = false;
            }
        }
        if ($errorStatus == false) {
            echo 'error while updating serial number.';
        } else {
            echo 'serial number updated successfully.';
        }
    }

    public function update_user_uniqe_id() {

        $errorStatus = true;
        $usrsData = $this->SuperAdminModel->all_type_usrs();
        foreach ($usrsData as $key => $value) {
            # code...
            // String of all alphanumeric character
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            // Shuffle the $str_result and returns substring of specified length
            $serial_id = substr(str_shuffle($str_result), 0, 6);
            if ($value->usr_role == 1) {
                $serial_id = 'S-' . $serial_id;
            } elseif ($value->usr_role == 2) {
                $serial_id = 'A-' . $serial_id;
            } elseif ($value->usr_role == 3) {
                $serial_id = 'U-' . $serial_id;
            } elseif ($value->usr_role == 4) {
                $serial_id = 'P-' . $serial_id;
            } elseif ($value->usr_role == 2) {
                $serial_id = 'E-' . $serial_id;
            }

            $requestData = array(
                'id' => $value->id,
                'serial_id' => $serial_id
            );
            $uptStatus = $this->SuperAdminModel->upt_all_type_usr($requestData);
            if ($uptStatus == false) {
                $errorStatus = false;
            }
        }
        if ($errorStatus == false) {
            echo 'error while updating serial number.';
        } else {
            echo 'serial number updated successfully.';
        }
    }

    public function update_user_serial_id() {

        $errorStatus = true;
        $usrsData = $this->SuperAdminModel->all_type_usrs();
        foreach ($usrsData as $key => $value) {
            # code...
            $str_result = '';
            if ($value->usr_role == 1) {
                $str_result = 'S';
            } elseif ($value->usr_role == 2) {
                $str_result = 'A';
            } elseif ($value->usr_role == 3) {
                $str_result = 'U';
            } elseif ($value->usr_role == 4) {
                $str_result = 'P';
            } elseif ($value->usr_role == 5) {
                $str_result = 'E';
            }

            // $usr_ip = $_SERVER['REMOTE_ADDR'];
            // $geolocationInfo = file_get_contents('https://www.iplocate.io/api/lookup/' . $usr_ip);
            // $geolocationResilt = json_decode($geolocationInfo);
            $country_code = 'S';
            // $country_code = isset($geolocationResilt->country_code)?$geolocationResilt->country_code:'';
            // $country_code = isset($country_code)?substr($country_code, 0, 1):'';
            $str_result .= $country_code;

            //get max id number from user table
            // $usrMaxId = $this->CommonModel->get_max_usrid();
            // $usrMaxId = $usrMaxId + 1;
            $usrMaxId = (string) $value->id;
            if (strlen($usrMaxId) == 1) {
                $usrMaxId = '00000' . $usrMaxId;
            } elseif (strlen($usrMaxId) == 2) {
                $usrMaxId = '0000' . $usrMaxId;
            } elseif (strlen($usrMaxId) == 3) {
                $usrMaxId = '000' . $usrMaxId;
            } elseif (strlen($usrMaxId) == 4) {
                $usrMaxId = '00' . $usrMaxId;
            } elseif (strlen($usrMaxId) == 5) {
                $usrMaxId = '0' . $usrMaxId;
            } elseif (strlen($usrMaxId) == 6) {
                $usrMaxId = $usrMaxId;
            }
            $str_result .= $usrMaxId;

            $serial_id = $str_result;

            $requestData = array(
                'id' => $value->id,
                'serial_id' => $serial_id
            );
            $uptStatus = $this->SuperAdminModel->upt_all_type_usr($requestData);
            if ($uptStatus == false) {
                $errorStatus = false;
            }
        }
        if ($errorStatus == false) {
            echo 'error while updating serial number.';
        } else {
            echo 'serial number updated successfully.';
        }
    }

    public function get_lat_long_by_zipcode($postal_code) {
        //$postal_code =  400614;
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($postal_code) . "&key=" . GEOCODEMAP_API_KEY;
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        $result1 = $result['results'][0];
        $result2 = $result1['geometry'];
        $result3 = $result2['location'];
        return $result3;
    }

    public function test_mobile_api() {
        $usrData = new stdClass();
        $saveUsrUlr = base_url('api-token-validation');

        $requestData = array(
            'name' => 'sai',
            'email' => 'sai@gmail.com',
            'cont_no' => 9594244026,
            'password' => 'SaiBaba@123',
            'passconf' => 'SaiBaba@123'
        );
        $header[0] = 'form-data';
        //send request to api
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        $inptData['apiValidToken'] = 'TOKEN1';
        $inptData['apiRequestToken'];
        $inptData['token'];
        $inptData['apiFunctionName'] = 'save_usr';
        //echo $inptData['token']; exit;
        $urlJsonData = $this->restclient->post($saveUsrUlr, $inptData, $header);
        //echo'<pre>'; echo print_r($urlJsonData); exit;
        if ($urlJsonData->info->http_code == 200) {
            $usrData->apiResponse = json_decode($urlJsonData->response);
            if ($usrData->apiResponse->responseCode == 200) {
                $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                echo json_encode($this->response);
                exit;
            } else {
                $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                echo json_encode($this->response);
                exit;
            }
        }
    }

    public function combine_search() {
        //$searchData = array();
        // $usrData = new stdClass();
        // $actionUlr = base_url('api-token-validation');

        $requestData = array(
            'combine_search' => 'bmw'
        );
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        echo'<pre>';
        echo print_r($inptData);
        exit;
        // $header[0] = 'form-data';
        // //send request to api
        // $searchData['apiRequestToken'] = $inptData;
        // $searchData['apiFunctionName'] = 'get_search_result';
        // $searchData['apiValidToken'] = 'TOKEN2';
        // //echo $inptData['token']; exit;
        // $urlJsonData = $this->restclient->post($actionUlr,$searchData,$header);
        // //echo'<pre>'; echo print_r($urlJsonData); exit; 
        // if($urlJsonData->info->http_code==200){
        //     //echo'<pre>'; echo print_r($urlJsonData->response); exit;
        //     $usrData->apiResponse = json_decode($urlJsonData->response);
        //     //echo'<pre>'; echo print_r($usrData->apiResponse); exit;
        //     if($usrData->apiResponse->responseCode==200){
        //         $this->response['responseCode'] = $usrData->apiResponse->responseCode;
        //         $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
        //         $this->response['responseData'] = $usrData->apiResponse->responseData;
        //         echo json_encode($this->response); exit;
        //     }else{
        //         $this->response['responseCode'] = $usrData->apiResponse->responseCode;
        //         $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
        //         echo json_encode($this->response); exit;
        //     }
        // }
    }

    public function generate_token() {
        $requestData = (array) $_REQUEST;
        $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
        echo'<pre>';
        echo print_r($inptData);
        exit;
    }

    //codeigniter sms send
    public function send_sms() {
        $sending = http_post("your_domain", 80, "/sendsms", array("Username" => $uname, "PIN" => $password, "SendTo" => $Phone, "Message" => $usermessage));
    }

    function random_strings() {
        // sha1 the timstamps and returns substring of specified length
        $length_of_string = 20;
        echo substr(sha1(time()), 0, $length_of_string);
    }

    function native_app_token_generator() {
        $length = 24;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        echo $randomString;
    }

    function geo_location_address() {
        // IP address 
        //$userIP = '162.222.198.75';
        $userIP = $_SERVER['REMOTE_ADDR'];

        // API end URL 
        $apiURL = 'https://freegeoip.app/json/' . $userIP;

        // Create a new cURL resource with URL 
        $ch = curl_init($apiURL);

        // Return response instead of outputting 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute API request 
        $apiResponse = curl_exec($ch);

        // Close cURL resource 
        curl_close($ch);

        // Retrieve IP data from API response 
        $ipData = json_decode($apiResponse, true);

        if (!empty($ipData)) {
            $country_code = $ipData['country_code'];
            $country_name = $ipData['country_name'];
            $region_code = $ipData['region_code'];
            $region_name = $ipData['region_name'];
            $city = $ipData['city'];
            $zip_code = $ipData['zip_code'];
            $latitude = $ipData['latitude'];
            $longitude = $ipData['longitude'];
            $time_zone = $ipData['time_zone'];

            echo 'Country Name: ' . $country_name . '<br/>';
            echo 'Country Code: ' . $country_code . '<br/>';
            echo 'Region Code: ' . $region_code . '<br/>';
            echo 'Region Name: ' . $region_name . '<br/>';
            echo 'City: ' . $city . '<br/>';
            echo 'Zipcode: ' . $zip_code . '<br/>';
            echo 'Latitude: ' . $latitude . '<br/>';
            echo 'Longitude: ' . $longitude . '<br/>';
            echo 'Time Zone: ' . $time_zone;

            echo'<pre>';
            echo print_r($ipData);
            exit;
        } else {
            echo 'IP data is not found!';
        }
    }

    public function short_url() {
        $long_url = 'https://motorgate.com/garage-details/MjA3';

        $apiv4 = 'https://api-ssl.bitly.com/v4/bitlinks';
        $genericAccessToken = '0014ca7abdd89610a19c6444e618255206fc1934';

        $data = array(
            'long_url' => $long_url
        );
        $payload = json_encode($data);

        $header = array(
            'Authorization: Bearer ' . $genericAccessToken,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        );

        $ch = curl_init($apiv4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        //echo "<pre>";

        $resultToJson = (array) json_decode($result);
        //echo'<pre>'; echo print_r($resultToJson); exit;
        if (isset($resultToJson['link'])) {
            return $resultToJson['link'];
        } else {
            return false;
        }
    }

    public function get_acurate_current_geo_location() {

        $userIP = $_SERVER['REMOTE_ADDR'];
        //$userIP = '50.87.140.26';
        // no need to pass ip any longer; ipinfo grabs the ip of the person requesting
        $details = json_decode(file_get_contents("http://ipinfo.io/" . $userIP));
        echo'<pre>';
        echo print_r($details);

        // $data = file_get_contents("http://api.hostip.info/?ip=".$userIP);
        // echo'<pre>'; echo print_r($data);
        // Get IP address
        // $ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
        // // Get JSON object
        // $jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);
        // // Decode
        // $data = json_decode($jsondata, true);
        // echo'<pre>'; echo print_r($data); 

        $res1 = file_get_contents('https://ipwho.is/' . $userIP); //aulternate option
        $res1 = json_decode($res1);
        echo'<pre>';
        echo print_r($res1);

        $res = file_get_contents('https://www.iplocate.io/api/lookup/' . $userIP);
        $res = json_decode($res);
        echo'<pre>';
        echo print_r($res);

        $result = json_decode(file_get_contents('http://ip-api.io/json/' . $userIP));
        echo'<pre>';
        echo print_r($result);

        //You can use an api:
        //Link to documentation: https://ip-get-geolocation.com/documentation/
        $LocationArray = json_decode(file_get_contents('http://ip-get-geolocation.com/api/json/' . $userIP), true);
        echo'<pre>';
        echo print_r($LocationArray);
    }

    public function create_store_test() {
        $template_id = '3';
        $sub_domain_name = 'mat12';
        $store_tkn = '2a6a4bdf-9f2a-456e-8cfe-248db4ea4b8d';

        $check_site_status = $this->UsrModel->check_site_status($sub_domain_name, $store_tkn);
        echo "<pre>";
        print_r($check_site_status);

        if ($check_site_status->store_tkn == "0") {
            echo "apache restart called";
            $apache_reboot_temp = apache_reboot($sub_domain_name, $store_tkn);
        }

        if ($apache_reboot_temp) {
            $result = json_decode($curl_res, true);
            print_r($result);
        } else {
            echo "No Response";
        }

        die;
    }

    public function email_test() {

        echo "email function called./n/n/n";
        $email = 's.paskanti@advancedelaf.com';
        $subject = 'Test Mail';

        $message = '<html><body>';
        $message .= '<h1>Hello, World!</h1>';
        $message .= '</body></html>';

        $res = sendEmail($email, $message, $subject);
        var_dump($res);
        pre($res);
    }

    public function test_store_api() {
        $store_sub_domain = "myturn15";
        $template_id = "5";
        $token = "myturn15qwer1234";
        $email = 's.paskanti@advancedelaf.com';
        $res = store_creation_api($store_sub_domain, $template_id, $token, $email);
        echo $res . "<br/>";
        $store_creation_api = json_decode($res, true);
        echo "<pre>";
        print_r($store_creation_api);
        echo "</pre>" . $store_creation_api['responseCode'];
        echo "<br>------------------------------------<br>";
        if ($store_creation_api['responseCode'] == '200') {
            echo 'apache called';
            $apache_reboot = apache_reboot($store_sub_domain, $token);
            $apache_res = json_decode($apache_reboot, true);
            echo "<pre>";
            print_r($apache_res);
            echo "</pre>" . $apache_res['responseCode'];
            if ($apache_res['responseCode'] == '200') {
                echo 'apache  Restarted Succesfully<br><br><br><br>';
            } else {
                echo '<br><br>apache not called';
            }
        }
        die;
    }

    public function test_domain() {
        $getSubdomain = base_url();
        $parsedUrl = parse_url($getSubdomain);
        $host = explode('.', $parsedUrl['host']);
        $subdomain = $host[0];

        $domain = str_ireplace('www.', '', parse_url(base_url(), PHP_URL_HOST));

        echo $getSubdomain;
        echo "<br/><br/>";
        echo $host[0];
        echo "<br/><br/>";
        echo $host[1];
        echo "<br/><br/>";
        echo $host[2];
        echo "<br/><br/>";
        echo $domain;
    }

}