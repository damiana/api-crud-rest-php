<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once './notification.php';

$date1 = date_create("09:00:00");
$date2 = date_create("12:00:00");
$date3 = date_create("18:00:00");

$now = date("H:i:s");
//echo json_encode(date_format($date,"H:i:s"));

// if (date_format($date1,"H:i:s") == $now ) {
//     echo enviarNotificacao();
// }

// if (date_format($date2,"H:i:s") == $now ) {
//     echo enviarNotificacao();
// }

// if (date_format($date3,"H:i:s") == $now ) {
//     echo enviarNotificacao();
// }


echo enviarNotificacao();

function enviarNotificacao() {

    $notification = new Notification();
	
    $title = 'Saúde Bucal !';
    $message = 'Você já escovou os dentes hoje?';
    $imageUrl = '';
    $action = '';
    $actionDestination = '';

    if($actionDestination ==''){
        $action = '';
    }

    $notification->setTitle($title);
    $notification->setMessage($message);
    $notification->setImage($imageUrl);
    $notification->setAction($action);
    $notification->setActionDestination($actionDestination);

    $firebase_token = 'dCn0Z6ogdlQ:APA91bERGGfByIt1hmqWD-eLIm45JSXJYETzyv9KhGlsxYHrNGzr0bin7LHnSe0B7-AiVOZPhsexGPiPbySMjZv-rXx9FnnkGovZSGMtW49irDMTq-ys3J8xT6xDC4AGFjSS7gTcawumg60H7n21qgJEo0gKEtBgpg';
    $firebase_api = 'AAAA7HYgZIA:APA91bHNrgqHeStH81LZ9U1di54mQ-DApfTt3VDNi6NGjoFduPpjjP0JQBRM_q1F8KrkA1qHxpHNHV_p-Gke7uBm7mBfCxn8zZ42A2oQskcSOljhID0BeS-LiQ-r5IaE9fKW9fPogP-L8Ye3WxK3swPpXPgbeUn_GA';

    $requestData = $notification->getNotificatin();

    $fields = array(
        'to' => $firebase_token,
        'data' => $requestData,
        'content_available' => true,
        'priority' => 'high'
    );

    // Set POST variables
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    $headers = array(
        'Authorization: key=' . $firebase_api,
        'Content-Type: application/json'
    );

    // Open connection
    $ch = curl_init();

    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Disabling SSL Certificate support temporarily
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    // Execute post
    $result = curl_exec($ch);
    if($result === FALSE){
        die('Curl failed: ' . curl_error($ch));
    }

    // Fecha conexao
    curl_close($ch);

    // exibe o retorno completo da API FCM
    return json_encode($fields,JSON_PRETTY_PRINT);
    }
?>