<?php
require_once '../src/db/connection.php';

$db = Database::getInstance();

function redirect($error)
{
    header("Location: ../pages/login.php?error=$error&form=register");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // datos recibidos
    $names = $_POST['names'];
    $last_names = $_POST['last_names'];
    $dui = $_POST['dui'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!$names || !$last_names || !$dui || !$email || !$pass) {
        redirect('empty_files');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect('empty_files');
        exit();
    }

    if (!preg_match("/^\d{8}-\d$/", $dui)) {
        redirect('empty_files');
        exit();
    }

    $exist_user = $db->fetchSingle("SELECT * FROM usuario WHERE documento_identidad = '$dui'");

    if ($exist_user) {
        redirect('dui');
        exit();
    }

    $db->executeQuery("INSERT INTO usuario (nombres, apellidos, documento_identidad, password, email) VALUES ('$names', '$last_names', '$dui', '$pass', '$email')");
    header('Location: ../pages/login.php?form=register&success=register');
    exit();
}