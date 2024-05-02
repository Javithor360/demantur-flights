<?php
require_once("../../models/flightModel.php");

class FlightController{
    public static function getFlights($type){
        $flight = new flight(null, null, null, null, null, null, null, null, null, null, null, null, null, null);

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
}
