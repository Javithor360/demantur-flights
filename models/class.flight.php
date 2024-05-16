<?php

require_once("class.connection.php");

class Flight
{
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

    public function __construct()
    {
        $this->connection = new Database();
    }

    //Fetch the flight info
    public function fetchFlights($type)
    {
        $pdo = $this->connection->connect(); // Se inicia la conexión con la base de datos
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

        // Se prepara la consulta y seguidamente se ejecuta
        $statement = $pdo->prepare($sql);
        $statement->execute();

        // Se obtienen los datos de los vuelos en un array asociativo
        $flightsData = $statement->fetchAll(PDO::FETCH_ASSOC);
        $flights = [];

        foreach ($flightsData as $flightData) {
            $flight = new Flight();
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
            $this->setConnection(null);
            $flights[] = $flight;
        }
        return $flights;
    }

    //Fetch users flights
    public function fetchUserFlights($id)
    {
        $pdo = $this->connection->connect(); // Se inicia la conexión con la base de datos
        $sql = "
            SELECT
                v.id_vuelo,
                v.codigo AS codigo_vuelo,
                DATE(h.hora_salida) AS fecha_salida,
                TIME(h.hora_salida) AS hora_salida,
                DATE(h.hora_llegada) AS fecha_llegada,
                TIME(h.hora_llegada) AS hora_llegada,
                d2.lugar AS origen,
                d2.aeropuerto AS aeropuerto_origen,
                d1.lugar AS destino,
                d2.aeropuerto AS aeropuerto_destino,
                a.nombre AS aerolinea,
                av.codigo_avion AS tipo_avion,
                v.tarifa AS precio_boleto,
                v.finalizado
            FROM
                vuelo v
                JOIN horario h ON v.id_horario = h.id_horario
                JOIN destino d1 ON h.id_destino = d1.id_destino
                JOIN destino d2 ON h.id_origen = d2.id_destino
                JOIN avion av ON v.id_avion = av.id_avion
                JOIN aerolinea a ON av.id_aerolinea = a.id_aerolinea
                JOIN asiento asi ON v.id_vuelo = asi.id_vuelo
                JOIN boleto b ON b.id_asiento = asi.id_asiento
                JOIN usuario u ON b.id_comprador = u.id_usuario
            WHERE
                u.id_usuario = :id";

        // Se prepara la consulta y seguidamente se ejecuta
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();

        // Se obtienen los datos de los vuelos en un array asociativo
        $flightsData = $statement->fetchAll(PDO::FETCH_ASSOC);
        $flights = [];

        foreach ($flightsData as $flightData) {
            $flight = new Flight();
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
            $this->setConnection(null);
            $flights[] = $flight;
        }
        return $flights;
    }

    //Fetch the passengers data
    public function fetchPassengers($id)
    {
        $pdo = $this->connection->connect();
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

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $passengersData = $statement->fetchAll(PDO::FETCH_ASSOC);
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

    // Fetch matching flights by search elements
    public function fetchMatchingFlights($destination, $departure_date)
    {
        $pdo = $this->connection->connect();
        $flights = [];

        $sql = "SELECT v.*, h.hora_salida, h.hora_llegada, a.nombre AS aerolinea_nombre, origen.lugar AS origen_lugar, destino.lugar AS destino_lugar
            FROM vuelo v
            INNER JOIN horario h ON v.id_horario = h.id_horario
            INNER JOIN destino origen ON h.id_origen = origen.id_destino
            INNER JOIN destino destino ON h.id_destino = destino.id_destino
            INNER JOIN avion av ON v.id_avion = av.id_avion
            INNER JOIN aerolinea a ON av.id_aerolinea = a.id_aerolinea
            WHERE destino.lugar LIKE :lugar 
            AND DATE(h.hora_salida) BETWEEN DATE_SUB(:fecha_salida, INTERVAL 1 DAY) AND DATE_ADD(:fecha_salida, INTERVAL 1 DAY)
            AND DATE(h.hora_salida) = DATE(:fecha_salida)";

        $statement = $pdo->prepare($sql);

        // Concatenar comodines al valor del destino
        $destination = '%' . $destination . '%';

        // Bind del valor de lugar (incluyendo los comodines)
        $statement->bindParam(":lugar", $destination, PDO::PARAM_STR);
        // Bind del valor de fecha_salida
        $statement->bindParam(":fecha_salida", $departure_date);

        if ($statement->execute()) {
            $flightsData = $statement->fetchAll(PDO::FETCH_ASSOC);
            $flights = [];

            foreach ($flightsData as $flightData) {
                $flight = new Flight();
                $flight->setIdVuelo($flightData['id_vuelo']);
                $flight->setCodigoVuelo($flightData['codigo']);
                $flight->setFechaSalida($flightData['hora_salida']);
                $flight->setHoraSalida($flightData['hora_salida']);
                $flight->setFechaLlegada($flightData['hora_llegada']);
                $flight->setHoraLlegada($flightData['hora_llegada']);
                $flight->setOrigen($flightData['origen_lugar']);
                $flight->setDestino($flightData['destino_lugar']);
                $flight->setAerolinea($flightData['aerolinea_nombre']);
                $flight->setPrecioBoleto($flightData['tarifa']);
                $flight->setFinalizado($flightData['finalizado']);
                $this->setConnection(null);
                $flights[] = $flight;
            }
        }

        return $flights;
    }

    // Fetch flight by id
    public function fetchFlightById($id)
    {
        $pdo = $this->connection->connect();
        $flight = null;

        $sql = "SELECT v.*, h.hora_salida, h.hora_llegada, a.nombre AS aerolinea_nombre, origen.lugar AS origen_lugar, destino.lugar AS destino_lugar
            FROM vuelo v
            INNER JOIN horario h ON v.id_horario = h.id_horario
            INNER JOIN destino origen ON h.id_origen = origen.id_destino
            INNER JOIN destino destino ON h.id_destino = destino.id_destino
            INNER JOIN avion av ON v.id_avion = av.id_avion
            INNER JOIN aerolinea a ON av.id_aerolinea = a.id_aerolinea
            WHERE v.id_vuelo = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $id);

        if ($statement->execute()) {
            $flightData = $statement->fetch(PDO::FETCH_ASSOC);
            $flight = array(
                'id_vuelo' => $flightData['id_vuelo'],
                'codigo' => $flightData['codigo'],
                'fecha_salida' => $flightData['hora_salida'],
                'hora_salida' => $flightData['hora_salida'],
                'fecha_llegada' => $flightData['hora_llegada'],
                'hora_llegada' => $flightData['hora_llegada'],
                'origen_lugar' => $flightData['origen_lugar'],
                'destino_lugar' => $flightData['destino_lugar'],
                'aerolinea_nombre' => $flightData['aerolinea_nombre'],
                'tarifa' => $flightData['tarifa'],
                'finalizado' => $flightData['finalizado']
            );
        }
        return $flight;
    }

    //Create a new flight
    public function createFlight($id_airplane, $id_schedule, $price, $code)
    {
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

    // Make the corresponding flight reservation
    public function saveFlightReservation($client_id, $flightData, $passengers)
    {
        $pdo = $this->connection->connect();
        $pdo->beginTransaction();

        $tickets = []; // Array para guardar la información de los boletos

        try {
            foreach ($passengers as $passenger) { // Recorrer los pasajeros obtenidos para crear su reservacion
                $seatSQL = "INSERT INTO asiento (numero_asiento, id_vuelo) VALUES (:numero_asiento, :id_vuelo);";
                $stmt = $pdo->prepare($seatSQL);
                $stmt->bindParam(":numero_asiento", $passenger['seat']);
                $stmt->bindParam(":id_vuelo", $flightData['id_vuelo']);

                if ($stmt->execute()) {
                    $passenger['id_asiento'] = $pdo->lastInsertId(); // Obtener el id del asiento creado
                    $passenger_name = $passenger['names'] . ' ' . $passenger['lastNames']; // Concatenar nombres y apellidos
                    $ticket_code = $this->generateRandomCode(); // Generar código de boleto

                    $sql = "INSERT INTO boleto (id_comprador, fecha_compra, codigo_boleto, id_asiento, nombre_pasajero, documento_identidad)
                        VALUES (:id_comprador, NOW(), :codigo_boleto, :id_asiento, :nombre_pasajero, :documento_identidad);";

                    $stmt2 = $pdo->prepare($sql);
                    $stmt2->bindParam(":id_comprador", $client_id);
                    $stmt2->bindParam(":codigo_boleto", $ticket_code);
                    $stmt2->bindParam(":id_asiento", $passenger['id_asiento']);
                    $stmt2->bindParam(":nombre_pasajero", $passenger_name);
                    $stmt2->bindParam(":documento_identidad", $passenger['document']);

                    if ($stmt2->execute()) {
                        // Guardar información del boleto
                        $ticketId = $pdo->lastInsertId();
                        $tickets[] = $this->getTicketInfoById($ticketId);
                    } else {
                        $pdo->rollBack();
                        return false;
                    }
                } else {
                    $pdo->rollBack();
                    return false;
                }
            }

            $pdo->commit(); // Commit después de que se hayan insertado todos los boletos correctamente
        } catch (Exception $e) {
            $pdo->rollBack();
            echo $e;
            return false;
        }

        // Obtener información del vuelo
        $flightInfo = $this->fetchFlightById($flightData['id_vuelo']);

        return array(
            'flight' => $flightInfo,
            'tickets' => $tickets
        );
    }

    // Fetch the ticket information by its id
    public function getTicketInfoById($ticketId)
    {
        $pdo = $this->connection->connect();

        $sql = "SELECT b.*, a.numero_asiento AS nombre_asiento
                FROM boleto b
                INNER JOIN asiento a ON b.id_asiento = a.id_asiento 
                WHERE id_boleto = :id_boleto";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_boleto", $ticketId);
        $stmt->execute();

        $ticketInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ticketInfo;
    }

    // Fetch the occupied seats of a flight
    public function fetchOccupiedSeats($flight_id)
    {
        $pdo = $this->connection->connect();

        $sql = "SELECT a.numero_asiento
                FROM asiento a
                INNER JOIN boleto b ON a.id_asiento = b.id_asiento
                WHERE a.id_vuelo = :id_vuelo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_vuelo", $flight_id);
        $stmt->execute();

        $occupiedSeats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $occupiedSeats;
    }


    // Generate a random code for the ticket
    function generateRandomCode()
    {
        // Generar cuatro letras aleatorias mayúsculas
        $letters = range('A', 'Z');
        $random_letters = '';
        for ($i = 0; $i < 3; $i++) {
            $random_letters .= $letters[rand(0, count($letters) - 1)];
        }

        // Obtener la fecha actual en el formato especificado (YYmmdd)
        $date = date('ymd');

        // Combinar las letras aleatorias y la fecha
        $random_code = $random_letters . $date;

        return $random_code;
    }

    // Setters
    public function setIdVuelo($id_vuelo)
    {
        $this->id_vuelo = $id_vuelo;
    }

    public function setCodigoVuelo($codigo_vuelo)
    {
        $this->codigo_vuelo = $codigo_vuelo;
    }

    public function setFechaSalida($fecha_salida)
    {
        $this->fecha_salida = $fecha_salida;
    }

    public function setHoraSalida($hora_salida)
    {
        $this->hora_salida = $hora_salida;
    }

    public function setFechaLlegada($fecha_llegada)
    {
        $this->fecha_llegada = $fecha_llegada;
    }

    public function setHoraLlegada($hora_llegada)
    {
        $this->hora_llegada = $hora_llegada;
    }

    public function setOrigen($origen)
    {
        $this->origen = $origen;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }
    public function setAeropuertoOrigen($aeropuerto_origen)
    {
        $this->aeropuerto_origen = $aeropuerto_origen;
    }
    public function setAeropuertoDestino($aeropuerto_destino)
    {
        $this->aeropuerto_destino = $aeropuerto_destino;
    }

    public function setAerolinea($aerolinea)
    {
        $this->aerolinea = $aerolinea;
    }

    public function setTipoAvion($tipo_avion)
    {
        $this->tipo_avion = $tipo_avion;
    }

    public function setPrecioBoleto($precio_boleto)
    {
        $this->precio_boleto = $precio_boleto;
    }

    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    // Getters
    public function getIdVuelo()
    {
        return $this->id_vuelo;
    }

    public function getCodigoVuelo()
    {
        return $this->codigo_vuelo;
    }

    public function getFechaSalida()
    {
        return $this->fecha_salida;
    }

    public function getHoraSalida()
    {
        return $this->hora_salida;
    }

    public function getFechaLlegada()
    {
        return $this->fecha_llegada;
    }

    public function getHoraLlegada()
    {
        return $this->hora_llegada;
    }

    public function getOrigen()
    {
        return $this->origen;
    }

    public function getDestino()
    {
        return $this->destino;
    }
    public function getAeropuertoOrigen()
    {
        return $this->aeropuerto_origen;
    }
    public function getAeropuertoDestino()
    {
        return $this->aeropuerto_destino;
    }

    public function getAerolinea()
    {
        return $this->aerolinea;
    }

    public function getTipoAvion()
    {
        return $this->tipo_avion;
    }

    public function getPrecioBoleto()
    {
        return $this->precio_boleto;
    }

    public function getFinalizado()
    {
        return $this->finalizado;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
