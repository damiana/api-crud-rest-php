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

// set ID do paciente a ser editado
$paciente->idPacientes = $data->idPacientes;
 
// set valores pacientes
//$paciente->dataNasc = $data->dataNasc;
$paciente->nome = $data->nome;
// $paciente->cidade = $data->cidade;
$paciente->email = $data->email;
$paciente->nickName = $data->nickName;
// $paciente->senha = $data->senha;
// $paciente->irDentista = $data->irDentista;
// $paciente->usaAparelho = $data->usaAparelho;
// $paciente->temSangramento = $data->temSangramento;
// $paciente->qtdVezesEscova = $data->qtdVezesEscova;
// $paciente->qtdVezesUsaFio = $data->qtdVezesUsaFio;
// $paciente->UsaEnxagueBucal = $data->UsaEnxagueBucal;
// $paciente->Fuma = $data->Fuma;
// $paciente->TemDiabetes = $data->TemDiabetes;
// $paciente->pontuacao = $data->pontuacao;
 
// atualiza o cadastro do paciente
if($paciente->updateDadosCadastrais()){
    echo "Dados alterados com sucesso!";
}
 
// se nao for possivel atualizar, mandar uma mensagem
else{
    echo "Nao foi possivel atualizar o cadastro.";
}
?>