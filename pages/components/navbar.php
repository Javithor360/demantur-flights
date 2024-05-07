<?php 

    // % Ruta de acceso a la carpeta de assets desde cualquier archivo
    isset($dipath) ? $dipath : $dipath = "./";

    // % Verificando que exista una sesión activa
    if (isset($_SESSION['user'])) {
        // Si existe una sesión activa, se obtiene el nombre del usuario
        $user = $_SESSION['user'];
    } else {
        //  Si no existe una sesión activa, se asigna un valor nulo a la variable
        $user = null;
    }
?>

<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <a href="<?php echo $dipath !== "./" ? "./index.php" : $dipath . "../index.php" ?>">
                <img src="<?php echo $dipath . "assets/img/logo_full.png" ?>" alt="Demantur Flights">
            </a>
        </div>
        <div class="nav-menu">
            <ul>
                <!-- Validación de la navegación del index para accederlo desde cualquier carpeta -->
                <li><a href="<?php echo $dipath !== "./" ? "./index.php" : $dipath . "../index.php" ?>">Inicio</a></li>
                <li><a href="<?php echo $dipath . "flights.php" ?>">Buscar vuelos</a></li>
                <!-- <li><a href="<?php echo $dipath . "bookedFlights.php" ?>">Vuelos reservados</a></li> -->
                <li><a href="<?php echo isset($user) ? ($dipath !== "./" ? "./controllers/auth.controller.php?action=logout" : "../controllers/auth.controller.php?action=logout") : $dipath . "login.php" ?>">
                    <?php echo isset($user) ? $user['nombres'] . " " . $user['apellidos'] : "Iniciar sesión" ?>
                </a></li>
            </ul>
        </div>
    </div>
</nav>