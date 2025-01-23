<?php
// Inclui o controlador de espaços
include_once 'backend/controller/espacoController.php';

$espacoController = new EspacoController();

// Verifica se há uma ação de criar, editar ou excluir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (($_GET['acao'] == 'create' )) {
        // Cadastrar um novo espaço
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $capacidade = $_POST['capacidade'];
        $descricao = $_POST['descricao'];
         $espacoController->CreateEspaco($nome, $tipo, $capacidade, $descricao);
    } elseif (($_GET['acao'] == 'update' )) {
        // Editar um espaço existente
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $capacidade = $_POST['capacidade'];
        $descricao = $_POST['descricao'];
        $espacoController->UpdateEspaco($id, $nome, $tipo, $capacidade, $descricao);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {
    // Excluir um espaço
    $id = $_GET['delete'];
    $espacoController->DeleteEspaco($id);
}

// Listar todos os espaços
$espacos = $espacoController->GetAllEspacos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Espaços</title>
</head>
<body>
    <h1>Cadastro de Espaços</h1>

    <!-- Formulário de Cadastro -->
    <h2>Cadastrar Novo Espaço</h2>
    <form action="espacos.php?acao=create" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" required><br><br>

        <label for="capacidade">Capacidade:</label>
        <input type="number" name="capacidade" id="capacidade" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea><br><br>

        <button type="submit" name="create">Cadastrar</button>
    </form>

    <hr>

    <!-- Listar Espaços Cadastrados -->
    <h2>Espaços Cadastrados</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Capacidade</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($espacos as $espaco) : ?>
                <tr>
                    <td><?php echo $espaco['id']; ?></td>
                    <td><?php echo $espaco['nome']; ?></td>
                    <td><?php echo $espaco['tipo']; ?></td>
                    <td><?php echo $espaco['capacidade']; ?></td>
                    <td><?php echo $espaco['descricao']; ?></td>
                    <td>
                        <!-- Botões de Editar e Excluir -->
                        <a href="espacos.php?edit=<?php echo $espaco['id']; ?>">Editar</a>
                        <a href="espacos.php?delete=<?php echo $espaco['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este espaço?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulário de Edição (aparece quando clicar em "Editar") -->
    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $espaco = $espacoController->GetEspacoById($id);
    ?>
        <h2>Editar Espaço</h2>
        <form action="espacos.php?acao=update" method="POST">
            <input type="hidden" name="id" value="<?php echo $espaco['id']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $espaco['nome']; ?>" required><br><br>

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" value="<?php echo $espaco['tipo']; ?>" required><br><br>

            <label for="capacidade">Capacidade:</label>
            <input type="number" name="capacidade" id="capacidade" value="<?php echo $espaco['capacidade']; ?>" required><br><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required><?php echo $espaco['descricao']; ?></textarea><br><br>

            <button type="submit" name="update">Atualizar</button>
        </form>
    <?php } ?>
</body>
</html>