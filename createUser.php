<?php
include_once "backend/controller/userController.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    $userController = new UserController();
    if ($userController->CreateUser($nome, $email, $telefone)) {
        header("Location: indexUser.php");
        exit();
    } else {
        echo "Erro ao cadastrar o usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
