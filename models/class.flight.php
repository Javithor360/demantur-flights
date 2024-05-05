<?php 

require_once("class.connection.php");

class Flight {
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }

    public function createFlight($id_airplane, $id_schedule, $price, $code) {
        $pdo = $this->connection->connect();

        $sql = "
            INSERT INTO vuelo
            (codigo, id_horario, tarifa, id_avion, finalizado)
            VALUES (:codigo, :id_horario, :precio, :id_avion, false);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":codigo", $code);
        $stmt->bindParam(":id_horario", $id_schedule);
        $stmt->bindParam(":precio", $price);
        $stmt->bindParam(":id_avion", $id_airplane);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}