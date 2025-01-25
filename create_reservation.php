<?php
include_once "backend/controller/reservaController.php";
$controller = new ReservationController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST["usuario_id"];
    $espaco_id = $_POST["espaco_id"];
    $data_reserva = $_POST["data_reserva"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_fim = $_POST["hora_fim"];

    $message = $controller->CreateReservation($usuario_id, $espaco_id, $data_reserva, $hora_inicio, $hora_fim);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Reserva</title>
    <link rel="stylesheet" href="home.css">
</head>
<body class="bodyeditar">
    <h1>Criar Nova Reserva</h1>
    
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    
    <form method="POST">
        <label for="usuario_id">ID do Usuário:</label><br>
        <input type="number" id="usuario_id" name="usuario_id" required><br><br>
        
        <label for="espaco_id">ID do Espaço:</label><br>
        <input type="number" id="espaco_id" name="espaco_id" required><br><br>
        
        <label for="data_reserva">Data da Reserva:</label><br>
        <input type="date" id="data_reserva" name="data_reserva" required><br><br>
        
        <label for="hora_inicio">Hora de Início:</label><br>
        <input type="time" id="hora_inicio" name="hora_inicio" required><br><br>
        
        <label for="hora_fim">Hora de Término:</label><br>
        <input type="time" id="hora_fim" name="hora_fim" required><br><br>
        
        <button class="botaocriar" type="submit">Criar Reserva</button>
    </form>
</body>
</html>
