<?php
session_start();
session_unset();
require_once '../src/db/connection.php';
require __DIR__ . '/../src/func/load_env.php';

$db = Database::getInstance();

function redirect($error)
{
    header("Location: ../pages/login.php?error=$error");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // datos del form
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!$email || !$pass) {
        redirect('empty_files');
        exit();
    }

    if ($email == 'alvin@gmail.com' && $pass == '12345') {
        $_SESSION['user'] = array(
            "id_usuario" => "admin",
            "nombres" => "Alvin M.",
            "apellidos" => null,
            "documento_identidad" => null,
            "password" => null,
            "email" => $email
        );
        header('Location: ../pages/admin/index.php');
        exit();
    }

    $result = $db->fetchSingle("SELECT * FROM usuario WHERE email = '$email' AND password = '$pass'");

    if (!$result) {
        redirect('login');
        exit();
    }

    $_SESSION['user'] = $result;
    header('Location: ../index.php?login=true');

} else {
    header("Location: ../index.php");
    exit();
}