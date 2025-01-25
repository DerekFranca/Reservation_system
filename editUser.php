<?php
include_once "backend/controller/userController.php";
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    if ($userController->UpdateUser($id, $nome, $email, $telefone)) {
        header("Location: indexUser.php");
        exit();
    } else {
        echo "Erro ao editar o usuário.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userController->GetUserById($id);

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="home.css">
</head>
<body class="bodyeditar">
    <h1>Editar Usuário</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $user['nome'] ?>" required><br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required><br><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= $user['telefone'] ?>" required><br><br>

        <button class="botaoeditar" type="submit">Salvar</button>
    </form>
</body>
</html>
