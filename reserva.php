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
    <link rel="stylesheet" href="home.css">
</head>
<body class="reserva">
    <h1>Bem-vindo ao Sistema de Reservas</h1>
    <nav>
        <ul>
            <a href="create_reservation.php"> <button class="botaoreserva">Criar Reserva</button></a>
            <a href="agenda.php"><button class="botaoreserva">Exibir Agenda</button></a>
            <a href="reservations.php"><button class="botaoreserva">Listar Reservas</button></a>
        </ul>
    </nav>
</body>
</html>
