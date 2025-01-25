<?php
include_once "backend/controller/reservaController.php";
$controller = new ReservationController();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
</head>
<body>
    <h1>Bem-vindo ao Sistema de Reservas</h1>
    <nav>
        <ul>
            <li><a href="create_reservation.php">Criar Reserva</a></li>
            <li><a href="agenda.php">Exibir Agenda</a></li>
            <li><a href="reservations.php">Listar Reservas</a></li>
        </ul>
    </nav>
</body>
</html>
