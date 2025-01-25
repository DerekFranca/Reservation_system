<?php
include_once "backend/controller/reservaController.php";
$controller = new ReservationController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $message = $controller->CancelReservation($id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Reserva</title>
</head>
<body>
    <h1>Cancelar Reserva</h1>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    
    <a href="reservations.php">Voltar para Listagem de Reservas</a>
</body>
</html>
