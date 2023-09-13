<?php
ob_start();

// Send email from website
function sendMail($from, $to, $subject, $body){
    $url = 'https://api.sendgrid.com/';
//    $user = 'VarshaWdipl';
//    $pass = 'wdipl@123';
    //$key = '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';
    $key='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';
    $mail = array(
//        'api_user' => $user,
//        'api_key' => $pass,
        'to' => $to,
        'subject' => $subject,
        'html' => $body,
        'from' => $from,
    );
//    $request =  $url.'api/mail.send.json';
    $request = $url . 'api/mail.send.json';
     //Nirali start
    $headr = array(); // set authorization header
    $headr[] = 'Authorization: Bearer '.$key;
    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt($session, CURLOPT_POSTFIELDS, $mail);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//   
    curl_setopt($session, CURLOPT_HTTPHEADER,$headr);
    //Nirali ends
    // obtain response
    $response = curl_exec($session);
//    print_r($response);exit;
    curl_close($session);
    if ($response == '{"message":"success"}') {
        $return = "1";
    } else {
        $return = "0";
    }
    return $return;
}
