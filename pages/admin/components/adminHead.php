<?php 
    // Iniciando la sesión para usarla en cualquier página
    if (!isset($_SESSION)) {
        session_start();
    }

    // Validando que solo los administradores puedan acceder al panel
    if (!isset($_SESSION['user']) || $_SESSION['user']['id_usuario'] !== "admin") {
        header("Location: ../../index.php");
        exit();
    }

    // % Título de la página
    isset($title) ? $title : $title = "Demantur Flights";

    // % Ruta de acceso a la carpeta de assets desde cualquier archivo
    isset($dipath) ? $dipath : $dipath = "./";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $dipath . "../assets/img/logo_single_white.png" ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f008f6fb10.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <title>Demantur Flights - <?php echo $title ?></title>

    <?php 
        // % En caso de que se quieran agregar otras etiquetas a la parte del header, solo se definen en una variable llamada $arg
        if(isset($arg)) {
            echo $arg;
        }
    ?>
</head>