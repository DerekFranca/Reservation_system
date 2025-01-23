<?php
include_once __DIR__ . "/../db/database.php";

class EspacoController
{
    private $conn;

    public function __construct()
    {
        $objDb = new Database();
        $this->conn = $objDb->connect();
    }

    // Listar todos os espaços cadastrados
    public function GetAllEspacos()
    {
        try {
            $sql = "SELECT * FROM espacos";
            $db = $this->conn->prepare($sql);
            $db->execute();
            $espacos = $db->fetchAll(PDO::FETCH_ASSOC);
            return $espacos;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Cadastrar um novo espaço
    public function CreateEspaco($nome, $tipo, $capacidade, $descricao)
    {
        try {
            $sql = "INSERT INTO espacos (nome, tipo, capacidade, descricao) 
                    VALUES (:nome, :tipo, :capacidade, :descricao)";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":nome", $nome);
            $db->bindParam(":tipo", $tipo);
            $db->bindParam(":capacidade", $capacidade);
            $db->bindParam(":descricao", $descricao);
            
            if ($db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $th) {
            // Exceção pode ser registrada aqui, como sugerido anteriormente
            return $th->getMessage();
        }
    }

    // Excluir um espaço pelo id
    public function DeleteEspaco($id)
    {
        try {
            $sql = "DELETE FROM espaco WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":id", $id);

            if ($db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Editar as informações de um espaço
    public function UpdateEspaco($id, $nome, $tipo, $capacidade, $descricao)
    {
        try {
            $sql = "UPDATE espacos SET nome = :nome, tipo = :tipo, capacidade = :capacidade, descricao = :descricao WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":nome", $nome);
            $db->bindParam(":tipo", $tipo);
            $db->bindParam(":capacidade", $capacidade);
            $db->bindParam(":descricao", $descricao);
            $db->bindParam(":id", $id);
            
            if ($db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Buscar um espaço específico pelo id
    public function GetEspacoById($id)
    {
        try {
            $sql = "SELECT * FROM espacos WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":id", $id);
            $db->execute();
            $espaco = $db->fetch(PDO::FETCH_ASSOC);
            return $espaco;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}