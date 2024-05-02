<?php
require_once("../../src/db/connection.php");

class flight {
    private $id_vuelo;
    private $codigo_vuelo;
    private $fecha_salida;
    private $hora_salida;
    private $fecha_llegada;
    private $hora_llegada; 
    private $origen;
    private $destino;
    private $aeropuerto_origen;
    private $aeropuerto_destino;
    private $aerolinea;
    private $tipo_avion;
    private $precio_boleto;
    private $finalizado;
    private $connection;
    
    //class constructor
    public function __construct($id_vuelo, $codigo_vuelo, $fecha_salida, $hora_salida, $fecha_llegada, $hora_llegada, $origen, $destino, $aeropuerto_origen, $aeropuerto_destino, $aerolinea, $tipo_avion, $precio_boleto, $finalizado) {
        $this->id_vuelo = $id_vuelo;
        $this->codigo_vuelo = $codigo_vuelo;
        $this->fecha_salida = $fecha_salida;
        $this->hora_salida = $hora_salida;
        $this->fecha_llegada = $fecha_llegada;
        $this->hora_llegada = $hora_llegada;
        $this->origen = $origen;
        $this->destino = $destino;
        $this->aerolinea = $aerolinea;
        $this->aeropuerto_origen = $aeropuerto_origen;
        $this->aeropuerto_destino = $aeropuerto_destino;
        $this->tipo_avion = $tipo_avion;
        $this->precio_boleto = $precio_boleto;
        $this->finalizado = $finalizado;
    }
    //Fetch the flight info
    public function fetchFlights($type) {
        $this->connection = Database::getInstance();
        $condition = $type ? "h.hora_salida >= NOW()" : "h.hora_salida < NOW()";
        $sql = "
        SELECT 
            v.id_vuelo,
            v.codigo AS codigo_vuelo,
            DATE(h.hora_salida) AS fecha_salida,
            TIME(h.hora_salida) AS hora_salida,
            DATE(h.hora_llegada) AS fecha_llegada,
            TIME(h.hora_llegada) AS hora_llegada,
            orig.lugar AS origen,
            orig.aeropuerto AS aeropuerto_origen,
            dest.lugar AS destino,
            dest.aeropuerto AS aeropuerto_destino,
            a.nombre AS aerolinea,
            av.codigo_avion AS tipo_avion,
            v.tarifa AS precio_boleto,
            v.finalizado
        FROM 
            vuelo v
        JOIN 
            horario h ON v.id_horario = h.id_horario
        JOIN 
            destino orig ON h.id_origen = orig.id_destino
        JOIN 
            destino dest ON h.id_destino = dest.id_destino
        JOIN 
            avion av ON v.id_avion = av.id_avion
        JOIN 
            aerolinea a ON av.id_aerolinea = a.id_aerolinea WHERE $condition";

        $flightsData = $this->connection->fetchQuery($sql);
        $flights = [];

        foreach ($flightsData as $flightData) {
            $flight = new Flight(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $flight->setIdVuelo($flightData['id_vuelo']);
            $flight->setCodigoVuelo($flightData['codigo_vuelo']);
            $flight->setFechaSalida($flightData['fecha_salida']);
            $flight->setHoraSalida($flightData['hora_salida']);
            $flight->setFechaLlegada($flightData['fecha_llegada']);
            $flight->setHoraLlegada($flightData['hora_llegada']);
            $flight->setOrigen($flightData['origen']);
            $flight->setDestino($flightData['destino']);
            $flight->setAerolinea($flightData['aerolinea']);
            $flight->setAeropuertoOrigen($flightData['aeropuerto_origen']);
            $flight->setAeropuertoDestino($flightData['aeropuerto_destino']);
            $flight->setTipoAvion($flightData['tipo_avion']);
            $flight->setPrecioBoleto($flightData['precio_boleto']);
            $flight->setFinalizado($flightData['finalizado']);
            $flights[] = $flight;
        }
        return $flights;
    }
    //Fetch the passengers data
    public function fetchPassengers($id) {
        $this->connection = Database::getInstance();
        $sql = " 
        SELECT b.codigo_boleto AS 'codigo_boleto',
            b.fecha_compra AS 'fecha_compra',
            b.nombre_pasajero AS 'nombre_pasajero',
            a.numero_asiento AS 'numero_asiento'
        FROM boleto b
            INNER JOIN asiento a ON b.id_asiento = a.id_asiento
            INNER JOIN vuelo v ON a.id_vuelo = v.id_vuelo
            INNER JOIN usuario u ON b.id_comprador = u.id_usuario
        WHERE v.id_vuelo = $id";
        $passengersData = $this->connection->fetchQuery($sql);
        $passengers = [];
        foreach ($passengersData as $passengerData) {
            $passenger = [
                'codigo_boleto' => $passengerData['codigo_boleto'],
                'fecha_compra' => $passengerData['fecha_compra'],
                'nombre_pasajero' => $passengerData['nombre_pasajero'],
                'numero_asiento' => $passengerData['numero_asiento']
            ];
            $passengers[] = $passenger;
        }
        return $passengers;
    }
    // Setters
    public function setIdVuelo($id_vuelo) {
        $this->id_vuelo = $id_vuelo;
    }

    public function setCodigoVuelo($codigo_vuelo) {
        $this->codigo_vuelo = $codigo_vuelo;
    }

    public function setFechaSalida($fecha_salida) {
        $this->fecha_salida = $fecha_salida;
    }

    public function setHoraSalida($hora_salida) {
        $this->hora_salida = $hora_salida;
    }

    public function setFechaLlegada($fecha_llegada) {
        $this->fecha_llegada = $fecha_llegada;
    }

    public function setHoraLlegada($hora_llegada) {
        $this->hora_llegada = $hora_llegada;
    }

    public function setOrigen($origen) {
        $this->origen = $origen;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }
    public function setAeropuertoOrigen($aeropuerto_origen) {
        $this->aeropuerto_origen = $aeropuerto_origen;
    }
    public function setAeropuertoDestino($aeropuerto_destino) {
        $this->aeropuerto_destino = $aeropuerto_destino;
    }

    public function setAerolinea($aerolinea) {
        $this->aerolinea = $aerolinea;
    }

    public function setTipoAvion($tipo_avion) {
        $this->tipo_avion = $tipo_avion;
    }

    public function setPrecioBoleto($precio_boleto) {
        $this->precio_boleto = $precio_boleto;
    }

    public function setFinalizado($finalizado) {
        $this->finalizado = $finalizado;
    }

    // Getters
    public function getIdVuelo() {
        return $this->id_vuelo;
    }

    public function getCodigoVuelo() {
        return $this->codigo_vuelo;
    }

    public function getFechaSalida() {
        return $this->fecha_salida;
    }

    public function getHoraSalida() {
        return $this->hora_salida;
    }

    public function getFechaLlegada() {
        return $this->fecha_llegada;
    }

    public function getHoraLlegada() {
        return $this->hora_llegada;
    }

    public function getOrigen() {
        return $this->origen;
    }

    public function getDestino() {
        return $this->destino;
    }
    public function getAeropuertoOrigen() {
        return $this->aeropuerto_origen;
    }
    public function getAeropuertoDestino() {
        return $this->aeropuerto_destino;
    }

    public function getAerolinea() {
        return $this->aerolinea;
    }

    public function getTipoAvion() {
        return $this->tipo_avion;
    }

    public function getPrecioBoleto() {
        return $this->precio_boleto;
    }

    public function getFinalizado() {
        return $this->finalizado;
    }
}