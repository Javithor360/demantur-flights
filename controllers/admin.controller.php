<?php
// session_start();

require_once __DIR__ . "/../models/class.destination.php";
require_once __DIR__ . "/../models/class.schedule.php";
require_once __DIR__ . "/../models/class.airline.php";
require_once __DIR__ . "/../models/class.airplane.php";
require_once __DIR__ . "/../models/class.flight.php";

$controller = new AdminController();

if (isset($_POST['action']) || isset($_GET['action'])) {
    $action = $_POST['action'] ?? $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: No existe el método $action en el controlador";
    }
}

class AdminController
{
    public function infoHandler($msg, $type, $form)
    {
        header("Location: ../pages/admin/$form.php?info=$type-$msg");
        exit();
    }

    public function new_destination()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['name']) || empty($_POST['airport_name'])) {
                echo "?";
                $this->infoHandler('empty_fields', 'error', 'destinationsForm');
            }

            // Definición de variables en base a los datos del formulario
            $name = $_POST['name'];
            $airport_name = $_POST['airport_name'];

            // Instancia del modelo de destino
            $destination = new Destination();

            // Creación de un nuevo destino
            $result = $destination->createDestination($name, $airport_name);

            // Redirección a la vista de destinos
            if ($result) {
                $this->infoHandler('new_destination', 'success', 'destinationsForm');
            } else {
                $this->infoHandler('new_destination', 'error', 'destinationsForm');
            }
        }
    }

    public function fetch_destinations()
    {
        $destination = new Destination();
        $destinations = $destination->getDestinations();

        return $destinations;
    }

    public function new_schedule()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                empty($_POST['lugar_salida']) ||
                empty($_POST['lugar_llegada']) ||
                empty($_POST['fecha_salida']) ||
                empty($_POST['fecha_llegada']) ||
                empty($_POST['hora_salida']) ||
                empty($_POST['hora_llegada'])
            ) {
                $this->infoHandler('empty_fields', 'error', 'scheduleForm');
            }

            // Definición de variables en base a los datos del formulario
            $departure = $_POST['lugar_salida'];
            $departure_date = $_POST['fecha_salida'];
            $departure_time = $_POST['hora_salida'];
            $arrival = $_POST['lugar_llegada'];
            $arrival_date = $_POST['fecha_llegada'];
            $arrival_time = $_POST['hora_llegada'];

            // Creación de objetos DateTime para las fechas y horas
            $departure_date_obj = DateTime::createFromFormat('Y-m-d', $departure_date);
            $departure_time_obj = DateTime::createFromFormat('H:i', $departure_time);
            $arrival_date_obj = DateTime::createFromFormat('Y-m-d', $arrival_date);
            $arrival_time_obj = DateTime::createFromFormat('H:i', $arrival_time);

            // Concatenación de fechas y horas
            $departure_concat_date = $departure_date_obj->format('Y-m-d') . ' ' . $departure_time_obj->format('H:i:s');
            $arrival_concat_date = $arrival_date_obj->format('Y-m-d') . ' ' . $arrival_time_obj->format('H:i:s');

            // Validación de fechas y horas
            if ($departure_concat_date >= $arrival_concat_date) {
                $this->infoHandler('invalid_dates', 'error', 'scheduleForm');
            } else if ($departure == $arrival) {
                $this->infoHandler('same_destinations', 'error', 'scheduleForm');
            } else if ($departure_date_obj < new DateTime()) {
                $this->infoHandler('invalid_departure_date', 'error', 'scheduleForm');
            } else if ($arrival_date_obj < new DateTime()) {
                $this->infoHandler('invalid_arrival_date', 'error', 'scheduleForm');
            }

            // Instancia del modelo de destino
            $schedule = new Schedule();

            // Creación de un nuevo destino
            $result = $schedule->createSchedule($departure, $arrival, $departure_concat_date, $arrival_concat_date);

            // Redirección a la vista de destinos
            if($result) {
                $this->infoHandler('new_schedule', 'success', 'scheduleForm');
            } else {
                $this->infoHandler('new_schedule', 'error', 'scheduleForm');
            }
        }
    }

    public function fetch_schedules() {
        $schedule = new Schedule();
        $schedules = $schedule->getSchedules();

        return $schedules;
    }

    public function new_airline() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['name'])) {
                $this->infoHandler('empty_fields', 'error', 'airlinesForm');
            }

            // Definición de variables en base a los datos del formulario
            $name = $_POST['name'];

            // Instancia del modelo de destino
            $airline = new Airline();

            // Creación de un nuevo destino
            $result = $airline->createAirline($name);

            // Redirección a la vista de destinos
            if($result) {
                $this->infoHandler('new_airline', 'success', 'airlinesForm');
            } else {
                $this->infoHandler('new_airline', 'error', 'airlinesForm');
            }
        }
    }

    public function fetch_airlines() {
        $airline = new Airline();
        $airlines = $airline->getAirlines();

        return $airlines;
    }

    public function new_airplane() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                empty($_POST['aerolinea']) ||
                empty($_POST['codigo'])
            ) {
                $this->infoHandler('empty_fields', 'error', 'airplanesForm');
            }

            if(strlen($_POST['codigo']) > 4) {
                $this->infoHandler('invalid_code', 'error', 'airplanesForm');
            }

            // Definición de variables en base a los datos del formulario
            $airline = $_POST['aerolinea'];
            $code = $_POST['codigo'];

            // Instancia del modelo de destino
            $airplane = new Airplane();

            // Creación de un nuevo destino
            $result = $airplane->createAirplane($airline, $code);

            // Redirección a la vista de destinos
            if($result) {
                $this->infoHandler('new_airplane', 'success', 'airplanesForm');
            } else {
                $this->infoHandler('new_airplane', 'error', 'airplanesForm');
            }
        }
    }

    public function fetch_airplanes() {
        $airplane = new Airplane();
        $airplanes = $airplane->getAirplanes();

        return $airplanes;
    }

    public function new_flight() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                empty($_POST['schedule']) ||
                empty($_POST['airplane']) ||
                empty($_POST['ticket-price'])
            ) {
                $this->infoHandler('empty_fields', 'error', 'flightsForm');
            }

            if ($_POST['ticket-price'] <= 0) {
                $this->infoHandler('invalid_price', 'error', 'flightsForm');
            }

            // Definición de variables en base a los datos del formulario
            $schedule_id = $_POST['schedule'];
            $airplane_id = $_POST['airplane'];
            $price = $_POST['ticket-price'];
            $code = $this->generate_code();

            // Instancia del modelo de destino
            $flight = new Flight();

            // Creación de un nuevo destino
            $result = $flight->createFlight($airplane_id, $schedule_id, $price, $code);

            // Redirección a la vista de destinos
            if($result) {
                $this->infoHandler('new_flight', 'success', 'flightsForm');
            } else {
                $this->infoHandler('new_flight', 'error', 'flightsForm');
            }
        }
    }

    function generate_code() {
        // Caracteres válidos para las letras
        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // Generar tres letras aleatorias
        $letrasAleatorias = substr(str_shuffle($letras), 0, 3);
    
        // Generar cuatro números aleatorios
        $numerosAleatorios = sprintf('%04d', mt_rand(0, 9999));
    
        // Concatenar letras y números para formar el código
        $codigo = $letrasAleatorias . $numerosAleatorios;
    
        return $codigo;
    }
}
