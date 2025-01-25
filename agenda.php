<?php
include_once "backend/controller/reservaController.php";
$controller = new ReservationController();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $espaco_id = $_GET["espaco_id"];
    $data_inicio = $_GET["data_inicio"];
    $data_fim = $_GET["data_fim"];

    $reservas = $controller->GetAgenda($espaco_id, $data_inicio, $data_fim);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="home.css">
</head>
<body class="bodyeditar">
    <h1>Agenda do Espaço</h1>
    
    <form method="GET">
        <label for="espaco_id">ID do Espaço:</label><br>
        <input type="number" id="espaco_id" name="espaco_id" required><br><br>
        
        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio" required><br><br>
        
        <label for="data_fim">Data de Fim:</label><br>
        <input type="date" id="data_fim" name="data_fim" required><br><br>
        
        <button type="submit">Ver Agenda</button>
    </form>

    <?php if (isset($reservas)) { ?>
        <h2>Reservas:</h2>
        <ul>
            <?php foreach ($reservas as $reserva) { ?>
                <li>Data: <?php echo $reserva['data_reserva']; ?> - Início: <?php echo $reserva['hora_inicio']; ?> - Fim: <?php echo $reserva['hora_fim']; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>
