<?php
include_once __DIR__ . "/../db/database.php";

class ReservationController
{
    private $conn;

    public function __construct()
    {
        $objDb = new Database();
        $this->conn = $objDb->connect();
    }

    // Função para criar uma reserva
    public function CreateReservation($usuario_id, $espaco_id, $data_reserva, $hora_inicio, $hora_fim)
    {
        try {
            // Verificar disponibilidade
            if (!$this->CheckAvailability($espaco_id, $data_reserva, $hora_inicio, $hora_fim)) {
                return "O espaço já está reservado para esse horário.";
            }

            // Criar a reserva
            $sql = "INSERT INTO reservas (usuario_id, espaco_id, data_reserva, hora_inicio, hora_fim) 
                    VALUES (:usuario_id, :espaco_id, :data_reserva, :hora_inicio, :hora_fim)";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":usuario_id", $usuario_id);
            $db->bindParam(":espaco_id", $espaco_id);
            $db->bindParam(":data_reserva", $data_reserva);
            $db->bindParam(":hora_inicio", $hora_inicio);
            $db->bindParam(":hora_fim", $hora_fim);
            
            if ($db->execute()) {
                return "Reserva criada com sucesso!";
            } else {
                return "Erro ao criar reserva.";
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Função para verificar a disponibilidade do espaço
    public function CheckAvailability($espaco_id, $data_reserva, $hora_inicio, $hora_fim)
    {
        try {
            // Verificar se já existe uma reserva no mesmo espaço e horário
            $sql = "SELECT * FROM reservas WHERE espaco_id = :espaco_id AND data_reserva = :data_reserva 
                    AND ((hora_inicio BETWEEN :hora_inicio AND :hora_fim) 
                    OR (hora_fim BETWEEN :hora_inicio AND :hora_fim))";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":espaco_id", $espaco_id);
            $db->bindParam(":data_reserva", $data_reserva);
            $db->bindParam(":hora_inicio", $hora_inicio);
            $db->bindParam(":hora_fim", $hora_fim);
            $db->execute();
            $reservas = $db->fetchAll(PDO::FETCH_ASSOC);
            return count($reservas) == 0; // Retorna true se o espaço estiver disponível
        } catch (\Exception $th) {
            return false;
        }
    }

    // Função para exibir a agenda de um espaço para uma data específica
    public function GetAgenda($espaco_id, $data_inicio, $data_fim)
    {
        try {
            // Buscar reservas para o espaço dentro do intervalo de datas
            $sql = "SELECT * FROM reservas WHERE espaco_id = :espaco_id AND data_reserva BETWEEN :data_inicio AND :data_fim ORDER BY data_reserva, hora_inicio";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":espaco_id", $espaco_id);
            $db->bindParam(":data_inicio", $data_inicio);
            $db->bindParam(":data_fim", $data_fim);
            $db->execute();
            $reservas = $db->fetchAll(PDO::FETCH_ASSOC);
            return $reservas;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Função para listar todas as reservas feitas
    public function GetAllReservations($usuario_id = null, $espaco_id = null)
    {
        try {
            // Filtrar por usuário ou espaço
            $sql = "SELECT * FROM reservas WHERE 1=1";
            
            if ($usuario_id) {
                $sql .= " AND usuario_id = :usuario_id";
            }

            if ($espaco_id) {
                $sql .= " AND espaco_id = :espaco_id";
            }

            $db = $this->conn->prepare($sql);
            
            if ($usuario_id) {
                $db->bindParam(":usuario_id", $usuario_id);
            }

            if ($espaco_id) {
                $db->bindParam(":espaco_id", $espaco_id);
            }

            $db->execute();
            $reservas = $db->fetchAll(PDO::FETCH_ASSOC);
            return $reservas;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    // Função para cancelar uma reserva
    public function CancelReservation($id)
    {
        try {
            $sql = "DELETE FROM reservas WHERE id = :id";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":id", $id);
            if ($db->execute()) {
                return "Reserva cancelada com sucesso!";
            } else {
                return "Erro ao cancelar reserva.";
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
?>
