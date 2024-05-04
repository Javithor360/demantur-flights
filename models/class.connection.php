<?php
// require "../src/func/load_env.php";

class Database {
    private $host ="localhost:3306";
    private $user  = "root";
    private $password = "";
    private $database = "demantur_flights";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "[ERROR] No se pudo conectar a la base de datos: " . $e->getMessage();
            die();
        }
    }

    public function connect()
    {
        return $this->connection;
    }

    public function disconnect()
    {
        $this->connection = null;
    }

}


/*
    OLD CONNECTION
*/

// class Database
// {
//     private $connection;
//     private static $instance;

//     private function __construct()
//     {
// //      $this->connection = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'] , $_ENV['DB_DATABASE']);
//         // $this->connection = new mysqli("localhost", "root", "12345" , "demantur_flights");
//         $this->connection = new mysqli("localhost", "root", "" , "demantur_flights");
//         if ($this->connection->connect_error) {
//             die("Error de conexión: " . $this->connection->connect_error);
//         }
//     }

//     public static function getInstance()
//     {
//         if (!self::$instance) {
//             self::$instance = new self();
//         }
//         return self::$instance;
//     }

//     public function executeQuery($sql)
//     {
//         $this->connection->query($sql);
//     }

//     public function fetchQuery($sql)
//     {
//         $result = $this->connection->query($sql);
//         $data = [];
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $data[] = $row;
//             }
//         }
//         return $data;
//     }

//     public function fetchSingle($sql)
//     {
//         $result = $this->connection->query($sql);
//         if ($result && $result->num_rows > 0) {
//             return $result->fetch_assoc();
//         }
//         return null;
//     }
// }