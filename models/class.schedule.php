<?php 

require_once("class.connection.php");

class Schedule {
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }

    // Método para crear un nuevo horario
    public function createSchedule($id_origin, $id_arrival, $date_origin, $date_arrival) {
        $pdo = $this->connection->connect();

        $sql = "
            INSERT INTO horario
            (id_destino, id_origen, hora_salida, hora_llegada)
            VALUES (:id_destino, :id_origen, :hora_salida, :hora_llegada);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_destino", $id_arrival);
        $stmt->bindParam(":id_origen", $id_origin);
        $stmt->bindParam(":hora_salida", $date_origin);
        $stmt->bindParam(":hora_llegada", $date_arrival);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}