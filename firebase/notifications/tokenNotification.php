<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once './notification.php';

// $data = json_decode(file_get_contents("php://input"));  // usar com android chamando a api
$data = (object) $_POST; // usar com postman


// inicializa objeto Notification
$notification = new Notification();

$firebaseToken = $notification->getFirebaseToken($data->token);

if ($firebaseToken) {
    echo json_encode("OK");
} else {
    echo json_encode("Erro ao enviar o token.");
}

?>