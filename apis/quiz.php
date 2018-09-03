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
 
// query questoes
$stmt = $paciente->getQuestoes();
$num = $stmt->rowCount();
 
// verifica registro foi encontrado
if($num>0){
 
    // quiz array

    // recuperar o conteúdo da nossa tabela
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extrai linha
        extract($linha);
 
        $quiz_item=array(
            "id" => $idQuestoes,
            "pergunta" => $pergunta,
            "alternativa_a" => $alternativa_a,
            "alternativa_b" => $alternativa_b,
            "alternativa_c" => $alternativa_c,
            "resposta" => $resposta
        );
    }
    echo json_encode($quiz_item);
}
 
else{
    echo json_encode(
        array("mensagem:" => "Não há perguntas cadastrada.")
    );
}
?>