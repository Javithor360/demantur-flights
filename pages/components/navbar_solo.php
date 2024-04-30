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
    </div>
</nav>