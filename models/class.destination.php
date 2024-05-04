<?php 

    require_once("class.connection.php");

class Destination {
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }
    
    public function createDestination($name, $airport) {
        $pdo = $this->connection->connect();

        $sql = "
            INSERT INTO destino
            (lugar, aeropuerto)
            VALUES (:lugar, :aeropuerto);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":lugar", $name);
        $stmt->bindParam(":aeropuerto", $airport);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}