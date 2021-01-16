<?php
session_start();
$mob_num=$_POST["mobile"];

$otp=rand(100000,999999);
$_SESSION["mobotp"]=$otp;

// echo $mob_num, "\n".$otp;



if($mob_num==''){
    echo "unable to sent otp";
}else{
    $fields = array(
        "sender_id" => "FSTSMS",
        "message" => "Your Mobile otp is :  $otp",
        "language" => "english",
        "route" => "p",
        "numbers" => "$mob_num",
    );
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => array(
        "authorization: DsGoqQw08gCSxY3ePWdiKbRVZvhNLyM274OlaIf6tuUcjzF59AFxqrzeL5tN1CQl6MR07ISfZ3b8WiTu",
        "accept: */*",
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo "otp sent";
    }

}