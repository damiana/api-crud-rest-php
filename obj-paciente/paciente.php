<?php
class Paciente{
 
    // conexao com banco de dados
    private $conn;
 
    // objeto paciente
    public $idPacientes;
    public $dataNasc;
    public $nome;
    public $cidade;
    public $email;
    public $nickName;
    public $senha;
    public $irDentista;
    public $usaAparelho;
    public $temSangramento;
    public $qtdVezesEscova;
    public $qtdVezesUsaFio;
    public $UsaEnxagueBucal;
    public $Fuma;
    public $TemDiabetes;
    public $pontuacao;
 
    // construtor com $db para acesso ao banco de dados
    public function __construct($db){
        $this->conn = $db;
    }

    // obtem a lista pacientes
    function getDadosCadastrais(){
        $query = "SELECT * FROM pacientes";
     
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);

        // executa query
        $stmt->execute();
     
        return $stmt;
    }

    // obtem a lista quiz
    function getQuestoes(){
        $query = "SELECT * FROM questoes ORDER BY RAND() LIMIT 1";
        
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);

        // executa query
        $stmt->execute();
        
        return $stmt;
    }

    // update cadastro
    function updateDadosCadastrais(){
    
        // update query
        $query = "UPDATE pacientes
                SET
                    nome = :nome,
                    dataNasc = :dataNasc,
                    email = :email,
                    senha = :senha
                    -- nickName = :nickName
                    -- cidade = :cidade,
                    -- irDentista = :irDentista,
                    -- usaAparelho = :usaAparelho,
                    -- temSangramento = :temSangramento,
                    -- qtdVezesEscova = :qtdVezesEscova,
                    -- qtdVezesUsaFio = :qtdVezesUsaFio,
                    -- UsaEnxagueBucal = :UsaEnxagueBucal,
                    -- Fuma = :Fuma,
                    -- TemDiabetes = :TemDiabetes,
                    -- pontuacao = :pontuacao
                WHERE idPacientes = :idPacientes";
    
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);
    
        // converte caracteres especiais
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->senha=htmlspecialchars(strip_tags($this->senha));
        $this->idPacientes=htmlspecialchars(strip_tags($this->idPacientes));
    
        // bind dos novos valores
        $stmt->bindParam(':idPacientes', $this->idPacientes);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':dataNasc', $this->dataNasc);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);

        // Descomentar esse código para editar as demais informações.
        
        // $stmt->bindParam(':cidade', $this->cidade);
        // $stmt->bindParam(':nickName', $this->nickName);
        // $stmt->bindParam(':irDentista', $this->irDentista);
        // $stmt->bindParam(':usaAparelho', $this->usaAparelho);
        // $stmt->bindParam(':temSangramento', $this->temSangramento);
        // $stmt->bindParam(':qtdVezesEscova', $this->qtdVezesEscova);
        // $stmt->bindParam(':qtdVezesUsaFio', $this->qtdVezesUsaFio);
        // $stmt->bindParam(':UsaEnxagueBucal', $this->UsaEnxagueBucal);
        // $stmt->bindParam(':Fuma', $this->Fuma);
        // $stmt->bindParam(':TemDiabetes', $this->TemDiabetes);
        // $stmt->bindParam(':pontuacao', $this->pontuacao);
    
        // executa query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // login paciente
    function getLoginPaciente($email, $senha){
        //  query
        $query = "SELECT * FROM pacientes
                  WHERE email = '$email' AND senha = '$senha'";
    
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);
        // executa query
        $stmt->execute();
     
        return $stmt;
    }
}