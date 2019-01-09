<?php
function curl($url, $fields = null, $cookie = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
}
 
$token = ''; // Access Token
$uu = curl("https://graph.facebook.com/me/posts?access_token=$token&limit=1000&fields=id,name");
$ua = json_decode($uu);
 
 
foreach($ua->data as $hide) {
    $n = '?privacy={"value":"SELF"}';
    $cu = curl("https://graph.facebook.com/v3.1/".$hide->id."/".$n, 'access_token='.$token);
    if(@json_decode($cu,1)['success'] == true)
    {
        echo $hide->id." Success set to privacy.\n";
    } else {
         echo $hide->id." Failed set to privacy.\n";       
    }
}
