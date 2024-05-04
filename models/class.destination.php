<?php 

    require_once("class.connection.php");

class Destination {
    private $id;
    private $name;
    private $airport;
    private $connection;

    public function __construct($id, $name, $airport) {
        $this->id = $id;
        $this->name = $name;
        $this->airport = $airport;
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
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAirport() {
        return $this->airport;
    }

}