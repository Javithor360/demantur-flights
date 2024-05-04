<?php 

require_once("class.connection.php");
require_once("class.user.php");

class Auth {
    private $connection;
    
    // Constructor para establecer la conexión con la base de datos
    public function __construct() {
        $this->connection = new Database();
    }

    // Método register
    public function register($names, $last_names, $dui, $email, $password) {
        $pdo = $this->connection->connect();
        
        // Verificando que no exista el usuario en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE documento_identidad = :dui");
        $stmt->bindParam(":dui", $dui);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$user) {
            // Preparando los datos para su incersión
            $sql = "
                INSERT INTO usuario
                (nombres, apellidos, documento_identidad, password, email)
                VALUES (:names, :last_names, :dui, :password, :email);
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":names", $names);
            $stmt->bindParam(":last_names", $last_names);
            $stmt->bindParam(":dui", $dui);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":email", $email);

            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }

    // Método login
    public function login($email, $password) {
        $pdo = $this->connection->connect();
        $user = null;

        if ($email === "admin@mail.com" && $password === "admin") {
            // Creando la sesión del administrador
            $user = array(
                "id_usuario" => "admin",
                "nombres" => "Javier M.",
                "apellidos" => null,
                "documento_identidad" => null,
                "password" => null,
                "email"=> $email
            );
        } else {
            // Creando la sesión de usuario corriente
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email AND password = :password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->execute();

            // Validando si se obtuvo un resultado o no
            if($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $user = array(
                    "id_usuario" => $result['id_usuario'],
                    "nombres" => $result['nombres'],
                    "apellidos" => $result['apellidos'],
                    "documento_identidad" => $result['documento_identidad'],
                    "password" => $result['password'],
                    "email" => $result['email']
                );
            }

            
        }

        // Retornando Array asociativo
        return $user;
    }
}