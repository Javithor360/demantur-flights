<?php 
session_start();

require_once "../models/class.destination.php";

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
    public function infoHandler ($msg, $type) {
        header("Location: ../pages/admin/destinationsForm.php?info=$type-$msg");
        exit();

    }

    public function new_destination() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST['name']) || empty($_POST['airport_name'])) {
                echo "?";
                $this->infoHandler('empty_fields', 'error');
            }

            // Definición de variables en base a los datos del formulario
            $name = $_POST['name'];
            $airport_name = $_POST['airport_name'];

            // Instancia del modelo de destino
            $destination = new Destination();

            // Creación de un nuevo destino
            $result = $destination->createDestination($name, $airport_name);

            // Redirección a la vista de destinos
            if($result) {
                $this->infoHandler('new_destination', 'success');
            } else {
                $this->infoHandler('new_destination', 'error');
            }
        }
    }
}