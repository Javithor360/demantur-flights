<?php
// session_start();

require_once __DIR__ . "/../models/class.destination.php";
require_once __DIR__ . "/../models/class.schedule.php";

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
}
