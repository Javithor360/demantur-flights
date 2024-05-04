<?php 

    require_once("./class.connection.php");

class Destination {
    private $id;
    private $name;
    private $airport;

    public function __construct($id, $name, $airport) {
        $this->id = $id;
        $this->name = $name;
        $this->airport = $airport;
    }
        
}