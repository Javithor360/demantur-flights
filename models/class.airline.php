<?php 

require_once("class.connection.php");

class Airline {
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }

    public function createAirline($name) {
        $pdo = $this->connection->connect();

        $sql = "
            INSERT INTO aerolinea
            (nombre)
            VALUES (:nombre);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nombre", $name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAirlines() {
        $pdo = $this->connection->connect();

        $sql = "
            SELECT * FROM aerolinea;
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}