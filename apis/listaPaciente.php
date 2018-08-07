<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database e outros objetos
include_once '../config/database.php';
include_once '../obj-paciente/paciente.php';
 
// instancia uma conexao com banco de dados objeto paciente
$database = new Database();
$db = $database->getConnection();
 
// inicializa objeto paciente
$paciente = new Paciente($db);
 
// query paciente
$stmt = $paciente->getDadosCadastrais();
$num = $stmt->rowCount();
 
// verifica registro foi encontrado
if($num>0){
 
    // pacientes array
    $pacientes_arr=array();
    $pacientes_arr["pacientes"]=array();
 
    // recuperar o conteúdo da nossa tabela
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extrai linha
        extract($linha);
 
        $paciente_item=array(
            "id" => $idPacientes,
            "nome" => $nome,
            "cidade" => $cidade,
            "email" => $email,
            "nickName" => $nickName,
            "senha" => $senha,
            "vaiAoDentista" => $irDentista,
            "usaAparelho" => $usaAparelho,
            "temSangramento" => $temSangramento,
            "qtdVezesEscova" => $qtdVezesEscova,
            "qtdVezesUsaFio" => $qtdVezesUsaFio,
            "usaEnxagueBucal" => $UsaEnxagueBucal,
            "fuma" => $Fuma,
            "temDiabetes" => $TemDiabetes,
            "pontuacaoDoQuiz" => $pontuacao
        );
        array_push($pacientes_arr["pacientes"], $paciente_item);
    }
    echo json_encode($pacientes_arr);
}
 
else{
    echo json_encode(
        array("mensagem:" => "Não há paciente cadastrado.")
    );
}
?>