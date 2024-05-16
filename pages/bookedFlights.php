<html lang="es">
<?php 
    $title = "Asientos";
    $arg = "<link rel='stylesheet' href='./assets/css/bookedFlights.css'>";
    include_once("./components/headContent.php");
    include_once("../controllers/flight.controller.php");
    $flights = null;
    
    if (!isset($_SESSION['user'])) {
        header('Location: ../index.php');
    }

    if (isset($_SESSION['user'])) {
        $flights = FlightController::getUserFlights($_SESSION['user']['id_usuario']);
    }
?>
<body>
    <?php include_once("./components/navbar.php") ?>
    <div class="heroContainer">
        <div class="heroImg"></div>
        <div class="dimmedBg">
            <div class="heroText">Gestiona tus vuelos reservados</div>
        </div>
    </div>
    <div class="ticketsContainer shadow-xl overflow-y-auto pb-20">
        <p class="ml-[15rem] text-[#31363F] font-bold text-[3rem]">Próximos</p>
        <hr class="style-one">
        <?php 
        if (empty($flights)) {
            echo '<div class="text-center p-5 text-gray-500">No tienes vuelos reservados.</div>';
        } else {
            foreach ($flights as $flight) {
                $fecha_actual = new DateTime();
                $fecha_llegada = new DateTime($flight->getFechaLlegada());
        ?>
        <div class="flightCard shadow-xl">  
            <div class="headerC">
                <p class="countryTitle"><i class="fa-solid fa-earth-americas mr-[1rem]"></i> <?= $flight->getOrigen() ?> - <?= $flight->getDestino() ?></p>
                <p class="countryTitle"><i class="fa-solid fa-calendar mr-[1rem]"></i> <?= date('j \d\e F \d\e Y', strtotime($flight->getFechaSalida())) ?> </p>
            </div>
            <hr>
            <div class="contentI">
                <i class="fa-solid fa-plane-departure plane-icon-p"></i>
                <div>
                    <p class="hourT"> <?= date("g:i a", strtotime($flight->getHoraSalida()))?> </p>
                    <p><?= strtoupper(substr($flight->getOrigen(), 0, 3)) ?> </p>
                </div>
                <div class="separator"></div>
                <div>
                    <p class="hourT"><?= date("g:i a", strtotime($flight->getHoraLlegada()))?></p>
                    <p><?= strtoupper(substr($flight->getDestino(), 0, 3)) ?></p>
                </div>
                <div class="aditionalinfoC">
                    <p class="grayText">Codigo: <?= $flight->getCodigoVuelo() ?></p>
                </div>
                <div class="aditionalinfoCC">
                    <span class="<?=$fecha_actual > $fecha_llegada ? "text-green-500" : "text-red-500" ?>">
                        <?= $fecha_actual > $fecha_llegada ? "Finalizado" : "Pendiente" ?>
                    </span>
                </div>
                
            </div>
        </div>
        <?php 
            }
        }
        ?>
    </div>
    <?php include_once("./components/footer.php") ?>
    <!-- Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Detalles del vuelo...</p>
        </div>
    </div>
    <script>
        let modal = document.getElementById("detailsModal");
        let btns = document.getElementsByClassName("btnShowDetails");
        let span = document.getElementsByClassName("close")[0];

        for (var i = 0; i < btns.length; i++) {
            btns[i].onclick = function(event) {
                event.preventDefault();
                modal.style.display = "block";
            }
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>