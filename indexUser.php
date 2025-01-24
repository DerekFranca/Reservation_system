<?php
include_once "backend/controller/userController.php";
$userController = new UserController();
$users = $userController->GetAllUser();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>
    <a href="createUser.php">Cadastrar Novo Usuário</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($users) > 0): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['nome'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="editUser.php?id=<?= $user['id'] ?>">Editar</a>
                            <a href="deleteUser.php?id=<?= $user['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum usuário encontrado</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
