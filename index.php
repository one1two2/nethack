<?php
require 'init.php';
require ('facebook-sdk/src/facebook.php');
    
$config = array(
    'appId' => '250002738518098',
    'secret' => 'a63c2d788c57c79bcd46026f670423f5',
    'allowSignedRequest' => false
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
//var_dump($user_id);
    
if($user_id) {
    try {
        $user_profile = $facebook->api('/me','GET');
      } catch(FacebookApiException $e) {
        error_log($e->getType());
        error_log($e->getMessage());
      }   
}

include 'views/index.php';
?>