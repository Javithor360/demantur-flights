<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once(__DIR__ . "../../models/class.flight.php");

$controller = new FlightController();

if (isset($_POST['action']) || isset($_GET['action'])) {
    $action = $_POST['action'] ?? $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: No existe el método $action en el controlador";
    }
}

class FlightController{
    public static function getFlights($type){
        $flight = new Flight(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        try {
            return $flight->fetchFlights($type);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public static function getFlightPassengers(){
        $flight = new Flight(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        if(isset($_POST['flight_code'])) {
            $id = $_POST['id_vuelo'];
            try {
                return $flight->fetchPassengers($id);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return [];
            }
        }
    }

    public static function getFlightDetails(){
        $flight_details = [];
    
        if(isset($_POST['flight_code'])) {
            $flight_details['id_vuelo'] = $_POST['id_vuelo'];
            $flight_details['flight_code'] = $_POST['flight_code'];
            $flight_details['departure_date'] = $_POST['departure_date'];
            $flight_details['departure_time'] = $_POST['departure_time'];
            $flight_details['arrival_date'] = $_POST['arrival_date'];
            $flight_details['arrival_time'] = $_POST['arrival_time'];
            $flight_details['origin'] = $_POST['origin'];
            $flight_details['airport_or'] = $_POST['airport_or'];
            $flight_details['airport_des'] = $_POST['airport_des'];
            $flight_details['destination'] = $_POST['destination'];
            $flight_details['airline'] = $_POST['airline'];
            $flight_details['airplane_code'] = $_POST['airplane_code'];
            $flight_details['price'] = $_POST['price'];
            return $flight_details;
        } else {
            $flight_details['error'] = "El código de vuelo no está especificado.";
        }
    
        return $flight_details;
    }

    public function filter_flight() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['lugar']) || empty($_POST['fecha_salida'])) {
                header("Location: ./index.php");
                exit();
            }

            $lugar = $_POST['lugar'];
            $fecha_salida = $_POST['fecha_salida'];

            $_SESSION['last_search'] = array(
                'lugar' => $lugar,
                'fecha_salida' => $fecha_salida
            );

            header("Location: ../pages/flights.php");
        }
    }

    public static function flight_search($destination, $departure_date) {
        if (empty($destination) || empty($departure_date)) {
            header("Location: ./flights.php");
            exit();
        }

        $flightsModel = new Flight();
        $flights = $flightsModel->fetchMatchingFlights($destination, $departure_date);

        return $flights;
    }

    public function flight_reservation() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (empty($_GET['id_vuelo'])) {
                header("Location: ./flights.php");
                exit();
            }

            $id_vuelo = $_GET['id_vuelo'];
            $flight = new Flight();

            $_SESSION['selected_flight'] = $flight->fetchFlightById($id_vuelo);

            // print_r($_SESSION['flight']);
            header("Location: ../pages/passengerForm.php");
        }
    }

    public function selected_passengers_info() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['pasajeros']) || !is_numeric($_POST['pasajeros'])) { 
                header("Location: ./flights.php");
                exit();
            }

            $passangersData = [];

            for ($i = 1; $i <= $_POST['pasajeros']; $i++) {
                if (empty($_POST["names_$i"]) || empty($_POST["lastNames_$i"]) || empty($_POST["document_$i"])) {
                    header("Location: ../pages/flights.php");
                    exit();
                }

                $passangersData[] = array(
                    'names' => $_POST["names_$i"],
                    'lastNames' => $_POST["lastNames_$i"],
                    'document' => $_POST["document_$i"],
                    'seat' => null
                );
            }

            $_SESSION['selected_passengers'] = $passangersData;

            header("Location: ../pages/seatsSelection.php");
        }
    }

    public function update_seat_selection() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_SESSION['selected_passengers'] as $index => $passengerData) {
                if (empty($_POST["selected_seat_$index"])) {
                    header("Location: ../pages/seatsSelection.php?info=empty_fields");
                    exit();
                }

                $_SESSION['selected_passengers'][$index]['seat'] = $_POST["selected_seat_$index"];
            }

            // print_r($_SESSION['selected_passengers']);
            header("Location: ../pages/payments.php");
        }
    }
}
