<?php
include_once "backend/controller/reservaController.php";
$controller = new ReservationController();

$reservas = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $usuario_id = $_GET["usuario_id"] ?? null;
    $espaco_id = $_GET["espaco_id"] ?? null;
    $reservas = $controller->GetAllReservations($usuario_id, $espaco_id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
</head>
<body>
    <h1>Listar Reservas</h1>

    <form method="GET">
        <label for="usuario_id">ID do Usuário (opcional):</label><br>
        <input type="number" id="usuario_id" name="usuario_id"><br><br>
        
        <label for="espaco_id">ID do Espaço (opcional):</label><br>
        <input type="number" id="espaco_id" name="espaco_id"><br><br>
        
        <button type="submit">Buscar Reservas</button>
    </form>

    <h2>Reservas:</h2>
    <ul>
        <?php foreach ($reservas as $reserva) { ?>
            <li>
                Usuário ID: <?php echo $reserva['usuario_id']; ?> | Espaço ID: <?php echo $reserva['espaco_id']; ?>
                | Data: <?php echo $reserva['data_reserva']; ?> 
                | Início: <?php echo $reserva['hora_inicio']; ?> | Fim: <?php echo $reserva['hora_fim']; ?>
                | <a href="cancel_reservation.php?id=<?php echo $reserva['id']; ?>">Cancelar</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
