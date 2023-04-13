<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('curl_call')) {

    function store_utkn() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0C2f) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0x2Aff), mt_rand(0, 0xffD3), mt_rand(0, 0xff4B)
        );
    }

    function random_alpha_num($length_of_string) {
        /* // String of all alphanumeric character */
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        /* // Shuffle the $str_result and returns substring of specified length */
        return substr(str_shuffle(strtoupper($str_result)), 0, $length_of_string);
    }

    function store_creation_api($store_sub_domain, $template_id, $token, $email) {
        /* Store Creation API */
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://88h0y8lga1.execute-api.ap-south-1.amazonaws.com/staging/generate?sub=' . $store_sub_domain . '&template=' . $template_id . '&token=' . $token . '&email=' . $email,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_TIMEOUT => 50,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: tZRzXFXLitGWxoNfhqOq2ojDfkyBWVOa26T5oN4e'
            ),
        ));
        $curl_res = curl_exec($curl);
        curl_close($curl);
        return $curl_res;
    }

    function apache_reboot($store_sub_domain, $store_tkn) {
        /* Apache Restart API */
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://gid1q9zezc.execute-api.eu-west-1.amazonaws.com/Prod/apache?sub=' . $store_sub_domain . '&token=' . $store_tkn,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: abcdefg1234&56665f$@fghsdghfgdhfgdh4565$25@55hfdstew'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function install_ssl($store_sub_domain) {
        /* Apache Restart API */
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://h3ijc91xtj.execute-api.ap-south-1.amazonaws.com/Prod/ssl?sub=' . $store_sub_domain,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: abcdefg1234&56665f$@fghsdghfgdhfgdsacsasac234673285012h4565$25@55hfdstew'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function sendEmail($email, $message, $subject) {
        $data_array =  array(
            "slag" => 'sendgrid'
        );
        $make_call = $this->callAPI('POST', 'https://www.matjary.in/matjary-config', json_encode($data_array));
        $response = json_decode($make_call, true);
        $emailSentStatus = true;
        $name = $email;
        $body = $message;
        $domain = str_ireplace('www.', '', parse_url(base_url(), PHP_URL_HOST));

        $headers = array(
            'Authorization: Bearer '.$response['responseData']['sendgrid_bearer_token'],
            'Content-Type: application/json'
        ); 
        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        )
                    )
                )
            ),
            "from" => array(
                "email" => $response['responseData']['sendgrid_email_from'],
                "name" => ucwords($domain)
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        // /* response is in boolean */
        // if (isset($response) && !empty($response)) {
        //     /* mail not sent */
        //     return $response;
        // } else {
        //     /* mail sent */
        //     return true;
        // }
        if(isset($response) && !empty($response)){
            //echo $mail->ErrorInfo;
            $emailSentStatus = false;
        }else{          
            $emailSentStatus = true; 
        }

        if($emailSentStatus==false){
            require_once(APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php');
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = false;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'mail.motorgate.com';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'smtpmail@motorgate.com';                   // SMTP username
                $mail->Password = '2NrW_q,i9Z;%';                   // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('smtpmail@motorgate.com', ucwords($domain));
                $mail->addAddress($email, $name);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;

                //echo 'Message has been sent';
                //$mail->AddCC($superAdminEmail);
                if($mail->Send()) {
                    //echo 'Email Send Successfully.';
                    $emailSentStatus = true;
                }
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $emailSentStatus = false;
            }
        }

        return $emailSentStatus;
    }

    function pre($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        die;
    }

    function encryptCode($string, $key) {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return base64_encode($result);
    }

    function decryptCode($string, $key) {
        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return $result;
    }

}
