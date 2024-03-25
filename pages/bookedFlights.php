<html lang="es">
<?php 
    $title = "Asientos";
    $arg = "<link rel='stylesheet' href='../src/css/bookedFlights.css'>";
    require_once(__DIR__."/../components/headContent.php"); 
?>
<body>
    <?php include_once(__DIR__."/../components/navbar.php") ?>
    <div class="heroContainer">
        <div class="heroImg"></div>
        <div class="dimmedBg">
            <div class="heroText">Gestiona tus vuelos reservados</div>
        </div>
    </div>
    <div class="ticketsContainer shadow-xl">
        <p class="ml-[15rem] text-[#31363F] font-bold text-[3rem]">Próximos</p> 
        <hr class="style-one">
        <div class="flightCard shadow-xl">
            <div class="headerC">
                <p class="countryTitle"><i class="fa-solid fa-earth-americas mr-[1rem]"></i> El Salvador - Madrid</p>
                <p class="countryTitle"><i class="fa-solid fa-calendar mr-[1rem]"></i> 30 marzo de 2024</p>
            </div>
            <hr>
            <div class="contentI">
                <i class="fa-solid fa-plane-departure plane-icon-p"></i>
                <div>
                    <p class="hourT">15:30</p>
                    <p>SAL</p>
                </div>
                <div class="separator"></div>
                <div>
                    <p class="hourT">22:30</p>
                    <p>MAD</p>
                </div>
                <div class="aditionalinfoC">
                    <p class="grayText">2 pasajeros</p>
                    <p class="greenText">Sin escalas</p>
                    <p class="grayText">Codigo: VL20240321V01</p>
                </div>
                <div class="aditionalinfoCC">
                    <a href="#" class="btnShowDetails">Ver detalles</a>
                </div>
                
            </div>
        </div>
        <div class="flightCard shadow-xl">
            <div class="headerC">
                <p class="countryTitle"><i class="fa-solid fa-earth-americas mr-[1rem]"></i> El Salvador - Madrid</p>
                <p class="countryTitle"><i class="fa-solid fa-calendar mr-[1rem]"></i> 30 marzo de 2024</p>
            </div>
            <hr>
            <div class="contentI">
                <i class="fa-solid fa-plane-departure plane-icon-p"></i>
                <div>
                    <p class="hourT">15:30</p>
                    <p>SAL</p>
                </div>
                <div class="separator"></div>
                <div>
                    <p class="hourT">22:30</p>
                    <p>MAD</p>
                </div>
                <div class="aditionalinfoC">
                    <p class="grayText">2 pasajeros</p>
                    <p class="greenText">Sin escalas</p>
                    <p class="grayText">Codigo: VL20240321V01</p>
                </div>
                <div class="aditionalinfoCC">
                    <a href="#" class="btnShowDetails">Ver detalles</a>
                </div>
                
            </div>
        </div>
    </div>
    <?php include_once(__DIR__."/../components/footer.php") ?>

    <!-- Modal -->
    <div id="detailsModal" class="modal">
        <!-- Contenido del modal -->
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