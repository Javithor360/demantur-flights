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

    public function getDestinations() {
        $pdo = $this->connection->connect();

        $sql = "
            SELECT * FROM destino;
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}