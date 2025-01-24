<?php
include_once "backend/controller/userController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userController = new UserController();
    if ($userController->DeleteUser($id)) {
        header("Location: indexUser.php");
        exit();
    } else {
        echo "Erro ao excluir o usuário.";
    }
}
