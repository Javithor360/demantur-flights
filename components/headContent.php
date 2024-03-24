<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../src/css/global_index.css" >
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f008f6fb10.js" crossorigin="anonymous"></script>
    <title>Demantur Flights - <?php echo $title ?></title>

    <?php 
        // % En caso de que se quieran agregar otras etiquetas a la parte del header, solo se definen en una variable llamada $arg
        if(isset($arg)) {
            echo $arg;
        }
    ?>

</head>