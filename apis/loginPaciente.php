<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database e outros objetos
include_once '../config/database.php';
include_once '../obj-paciente/paciente.php';
 
// instancia uma conexao com banco de dados objeto paciente
$database = new Database();
$db = $database->getConnection();
 
// inicializa objeto paciente
$paciente = new Paciente($db);
 
// obtem o id do paciente que será editado
// $data = json_decode(file_get_contents("php://input"));  // usar com android chamando a api
$data = (object) $_POST; // usar com postman
 
// query paciente
$stmt = $paciente->getLoginPaciente($data->email, $data->senha);
$num = $stmt->rowCount();

if($num >0){

    // get linha recuperada
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    //echo json_encode($linha);
    echo json_encode("sucesso!");
    
} else {
    echo json_encode("Erro nas credencias do login!");
}

?>