<?php 

require_once("class.connection.php");

class Airplane {
    private $connection;

    public function __construct() {
        $this->connection = new Database();
    }

    public function createAirplane($id_airline, $code) {
        $pdo = $this->connection->connect();

        $sql = "
            INSERT INTO avion
            (codigo_avion, id_aerolinea)
            VALUES (:codigo_avion, :id_aerolinea);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":codigo_avion", $code);
        $stmt->bindParam(":id_aerolinea", $id_airline);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAirplanes() {
        $pdo = $this->connection->connect();

        $sql = "
            SELECT 
                av.id_avion AS id_avion,
                av.codigo_avion AS codigo_avion, 
                ae.nombre AS aerolinea
            FROM avion AS av
            INNER JOIN aerolinea AS ae
            ON av.id_aerolinea = ae.id_aerolinea;
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}