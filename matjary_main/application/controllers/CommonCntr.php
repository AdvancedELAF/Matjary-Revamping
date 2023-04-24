<?php

class CommonCntr extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function get_country_states() {
        if (isset($_POST['country_id']) && !empty($_POST['country_id'])) {
            $result = $this->CommonModel->get_country_states($_POST['country_id']);
            if (isset($result) && !empty($result)) {
                $resp['responseCode'] = 200;
                $resp['responseData'] = $result;
                $resp['responseMessage'] = 'Records Retrived Successfully.';
                echo json_encode($resp);
                exit;
            } else {
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = 'Records Not Found.';
                echo json_encode($resp);
                exit;
            }
        } else {
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Country Is Required.';
            echo json_encode($resp);
            exit;
        }
    }

    public function get_state_cities() {

        if (isset($_POST['state_id']) && !empty($_POST['state_id'])) {
            $result = $this->CommonModel->get_state_cities($_POST['state_id']);
            if (isset($result) && !empty($result)) {
                $resp['responseCode'] = 200;
                $resp['responseData'] = $result;
                $resp['responseMessage'] = 'Records Retrived Successfully.';
                echo json_encode($resp);
                exit;
            } else {
                $resp['responseCode'] = 404;
                $resp['responseMessage'] = '';
                echo json_encode($resp);
                exit;
            }
        } else {
            $resp['responseCode'] = 404;
            $resp['responseMessage'] = 'Country Is Required.';
            echo json_encode($resp);
            exit;
        }
    }

    public function submit_contact_form() {
        $pageData = array();
        $pageData['post_data'] = $this->input->post();
        if (isset($pageData['post_data']) && !empty($pageData['post_data'])) {
            $usrData = new stdClass();
            $saveContactInfo = base_url('submit-contact-form-api');
            $requestData = array(
                'user_id' => $this->input->post('user_id') != '' ? $this->input->post('user_id') : '',
                'ticket_id' => $this->input->post('ticket_id') != '' ? $this->input->post('ticket_id') : '',
                'cont_name' => $this->input->post('cont_name') != '' ? $this->input->post('cont_name') : '',
                'cont_email' => $this->input->post('cont_email') != '' ? $this->input->post('cont_email') : '',
                'con_phone_no' => $this->input->post('con_phone_no') != '' ? $this->input->post('con_phone_no') : '',
                'cont_subject' => $this->input->post('cont_subject') != '' ? $this->input->post('cont_subject') : '',
                'cont_message' => $this->input->post('cont_message') != '' ? $this->input->post('cont_message') : '',
                'created_by' => $this->input->post('user_id') != '' ? $this->input->post('user_id') : ''
                
            );
            $header[0] = 'form-data';
            /* //send request to api */
            $inptData['token'] = JWT::encode($requestData, JWT_TOKEN);
            $urlJsonData = $this->restclient->post($saveContactInfo, $inptData, $header);
            if ($urlJsonData->info->http_code == 200) {
                $usrData->apiResponse = json_decode($urlJsonData->response);
                if ($usrData->apiResponse->responseCode == 200) {
                    $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                    $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    $this->response['redirectUrl'] = base_url('login');
                    echo json_encode($this->response);
                    exit;
                } else {
                    $this->response['responseCode'] = $usrData->apiResponse->responseCode;
                    $this->response['responseMessage'] = $usrData->apiResponse->responseMessage;
                    echo json_encode($this->response);
                    exit;
                }
            }
        } else {
            $this->response['responseCode'] = 404;
            $this->response['responseMessage'] = 'Post data is empty.';
            echo json_encode($this->response);
            exit;
        }
    }

}

?>