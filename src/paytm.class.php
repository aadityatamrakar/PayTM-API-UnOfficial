<?php
$imei = rand(111111111111111, 999999999999999);
    $device_identifier = "deviceIdentifier=Xiaomi-Redmi_note3-$imei&deviceManufacturer=Xiaomi&deviceName=Redmi_Note_3&client=androidapp&version=6.0.1&playStore=true&language=en&networkType=Mobile&imei=$imei&osVersion=6.0";
    
class PayTM{
    function register($number, $password, $email = ''){
        $url = "https://accounts.paytm.com/v3/api/register?$device_identifier";
        $auth_user = 'market-app';
        $auth_pass = '9a071762-a499-4bd9-914a-4361e7c3f4bc';
        $data = array(
                    "email" => $email,
                    "mobile" => $number,
                    "loginPassword" => $password,
                    "clientId" => $auth_user,
                    "scope" => "paytm",
                    "state" => "xyz",
                    "doNotRedirect" => "true",
                    "responseType" => "code"
                    );
        $post_data = json_encode($data);
        $length = strlen($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$auth_user:$authpass");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json',
            'Accept-Encoding: gzip',
            'Authorization: Basic bWFya2V0LWFwcDo5YTA3MTc2Mi1hNDk5LTRiZDktOTE0YS00MzYxZTdjM2Y0YmM=',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)',
            'Host: accounts.paytm.com',
            'Connection: Keep-Alive',
            "Content-Length: $length"
                    ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $server_output = json_decode($server_output);
        $status = $server_output->status;
        if($status == "SUCCESS"){
        $signup_token = $server_output->signupToken;
        return $signup_token;
        }else{
            $error = $server_output->message;
            return $error;
        }
        //echo "Status: $server_output->status\nEmail: $server_output->email\nCountryCode: $server_output->countryCode\nMobile: $server_output->mobile\nsignupToken: $server_output->signupToken\nresponseCode: $server_output->responseCode\n";
    }
    function resendOTP($signup_token){
        $url = 'https://accounts.paytm.com/v3/api/register/resendOtp';
        $auth_user = 'market-app';
        $auth_pass = '9a071762-a499-4bd9-914a-4361e7c3f4bc';
        $data = array(
                    "signupToken" => $signup_token
                    );
        $post_data = json_encode($data);
        $length = strlen($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$auth_user:$$authpass");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json',
            'Accept-Encoding: gzip',
            'Authorization: Basic bWFya2V0LWFwcDo5YTA3MTc2Mi1hNDk5LTRiZDktOTE0YS00MzYxZTdjM2Y0YmM=',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)',
            'Host: accounts.paytm.com',
            'Connection: Keep-Alive',
            "Content-Length: $length"
                    ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $server_output = json_decode($server_output);
        $status = $server_output->status;
        if($status == "SUCCESS"){
        $signup_token = $server_output->message;
        return $signup_token;
        }else{
            $error = $server_output->message;
            return $error;
        }
    }
    function validate($signup_token, $first_name, $last_name, $dob, $gender, $otp){
        $url = "https://accounts.paytm.com/v3/api/register/validate?deviceIdentifier=$device_identifier";
        $auth_user = 'market-app';
        $auth_pass = '9a071762-a499-4bd9-914a-4361e7c3f4bc';
        $user_data = array(
                            "firstName" => $first_name,
                            "lastName" => $last_name,
                            "dob" => $dob,
                            "gender" => $gender
                            );
        $data = array(
                            "signupToken" => $signup_token,
                            "userData" => $user_data,
                            "otp" => $otp
                            );
        $post_data = json_encode($data);
        $length = strlen($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$auth_user:$authpass");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json',
            'Accept-Encoding: gzip',
            'Authorization: Basic bWFya2V0LWFwcDo5YTA3MTc2Mi1hNDk5LTRiZDktOTE0YS00MzYxZTdjM2Y0YmM=',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)',
            'Host: accounts.paytm.com',
            'Connection: Keep-Alive',
            "Content-Length: $length"
                    ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);    
        $server_output = json_decode($server_output);
        $status = $server_output->status;
        if($status == "SUCCESS"){
        $signup_token = $server_output->state;
        return $signup_token;
        }else{
            $error = $server_output->message;
            return $error;
        }
    }
    function checkWalletStatus($token){
        $url = "https://accounts.paytm.com/user/wallet?deviceIdentifier=$device_identifier";
        $auth_user = 'market-app';
        $auth_pass = '9a071762-a499-4bd9-914a-4361e7c3f4bc';
        $data = array(
                    "state" => $token,
                    "doNotRedirect" => true
                    );
        $post_data = json_encode($data);
        $length = strlen($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$auth_user:$authpass");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = [
            'Content-Type: application/json',
            'Accept-Encoding: gzip',
            'Authorization: Basic bWFya2V0LWFwcDo5YTA3MTc2Mi1hNDk5LTRiZDktOTE0YS00MzYxZTdjM2Y0YmM=',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.0; ASUS_Z00AD Build/LRX21V)',
            'Host: accounts.paytm.com',
            'Connection: Keep-Alive',
            "Content-Length: $length"
                    ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $server_output = json_decode($server_output);
        $status = $server_output->status;
        if($status == "SUCCESS"){
        $message = $server_output->message;
        return $message;
        }else{
            $error = $server_output->message;
            return $error;
        }
    }
}
?>
