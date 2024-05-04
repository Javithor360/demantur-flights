<?php
session_start();
session_unset();

require_once "../models/class.auth.php";
require_once "../src/func/load_env.php";

$controller = new AuthController();

if (isset($_POST['action']) || isset($_GET['action'])) {
    $action = $_POST['action'] ?? $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Error: No existe el método $action en el controlador";
    }
}

class AuthController
{

    public function redirect($error, $type)
    {
        header("Location: ../pages/login.php?error=$error" . ($type === "register" ? "&form=register" : ""));
        exit();
    }

    public function register()
    {
        // Verificando que el método recibido sea POST (form)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validación de campos del formulario
            if (
                empty($_POST['names']) ||
                empty($_POST['last_names']) ||
                empty($_POST['dui']) ||
                empty($_POST['email']) ||
                empty($_POST['password'])
            ) $this->redirect('empty_files', 'register');

            // Definición de variables en base a los datos del formulario
            $names = $_POST['names'];
            $last_names = $_POST['last_names'];
            $dui = $_POST['dui'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Validación de correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $this->redirect('empty_files', 'register');

            // Validación de documento de identidad
            if (!preg_match("/^\d{8}-\d$/", $dui)) $this->redirect('empty_files', 'register');

            // Instancia del modelo de autenticación
            $userModel = new Auth();
            $user = $userModel->register($names, $last_names, $dui, $email, $pass);

            if (!$user) {
                $this->redirect('dui', 'register');
            } else {
                header('Location: ../pages/login.php?form=register&success=register');
                exit();
            }
        }
    }

    public function login()
    {
        // Verificando que el método recibido sea POST (form)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validación de campos del formulario
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $this->redirect('empty_files', 'login');
            }

            // Definición de variables en base a los datos del formulario
            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Instancia del modelo de autenticación
            $userModel = new Auth();
            $user = $userModel->login($email, $pass);

            // Si el usuario no se encuentra, se manda error
            if (!$user || $user === null) {
                $this->redirect('login', 'login');
            }

            // Creación de la variable de sesión para el usuario
            $_SESSION['user'] = $user;
            
            // Redireccionamiento a la página de inicio dependiendo del tipo de usuario
            header("Location: " . ($user['id_usuario'] !== "admin" ? "../index.php?login=true" : "../pages/admin/index.php"));
            exit();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../pages/login.php");
    }
}
