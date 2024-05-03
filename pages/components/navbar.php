<?php 
    // % Ruta de acceso a la carpeta de assets desde cualquier archivo
    isset($dipath) ? $dipath : $dipath = "./";
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
                <li><a href="<?php echo $dipath !== "./" ? "./index.php" : $dipath . "../index.php" ?>">Buscar vuelos</a></li>
                <li><a href="<?php echo $dipath . "bookedFlights.php" ?>">Vuelos reservados</a></li>
                <li><a href="<?php echo $dipath . "payments.php" ?>">Pagos</a></li>
                <li><a href="<?php echo isset($_SESSION['user']) ? ($dipath !== "./" ? "./index.php" : $dipath . "../index.php") : $dipath . "login.php" ?>"><?php echo isset($_SESSION['user']) ? $_SESSION['user']['nombres'] . " " . $_SESSION['user']['apellidos'] : "Iniciar sesión" ?></a></li>
            </ul>
        </div>
    </div>
</nav>