<?php
include_once __DIR__ . "/../db/database.php";

class UserController
{
    private $conn;

    public function __construct()
    {
        $objDb = new Database();
        $this->conn = $objDb->connect();
    }

    public function GetAllUser(){
        try {
            $sql = "SELECT * FROM usuarios";
            $db = $this->conn->prepare($sql);
            $db->execute();
            $user = $db->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function GetIdByName($nome){
        try {
            $sql = "SELECT id FROM usuarios WHERE nome =:nome";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":nome", $nome);
            $db->execute();
            $user = $db->fetchAll(PDO::FETCH_ASSOC);
            echo var_dump($user);
            return $user;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function CreateUser($nome, $email, $telefone){
        try {

           
            $sql = "INSERT INTO usuarios (nome,email,telefone) VALUES(:nome,:email,:telefone)";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":nome", $nome);
            $db->bindParam(":email", $email);
            $db->bindParam(":telefone", $telefone);
            if($db->execute()){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function DeleteUser($id){
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":id", $id);
            if($db->execute()){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $th) {
            //throw $th;
        }
    }


    public function UpdateUser($id,$nome, $email, $telefone){
        try {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":nome", $nome);
            $db->bindParam(":email", $email);
            $db->bindParam(":telefone", $telefone);
            $db->bindParam(":id", $id);
            if($db->execute()){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    public function GetUserById($id){
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":id", $id);
            $db->execute();
            $user = $db->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
