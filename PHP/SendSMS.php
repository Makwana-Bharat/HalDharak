<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '../vendor/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "ACed371051925cff17db6a01d0bc2f5978"; 
$token  = "f1745d522a2189ca1358b9dc13a761ce"; 
$twilio = new Client($sid, $token); 

$message = $twilio->messages 
                  ->create("+919327274766", // to 
                           array(  
                               "messagingServiceSid" => "MGfbd61fab869196a3631e27ea207d5ba0",      
                               "body" => $_POST['SMS'] 
                           ) 
                  ); 
 
print($message->sid);