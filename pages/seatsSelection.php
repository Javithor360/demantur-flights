<html lang="es">
<?php  // Iniciar la sesión al principio del archivo
$title = "Asientos";
$arg = "<link rel='stylesheet' href='./assets/css/SeatSelection.css'>";
include_once("./components/headContent.php"); 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedSeats'])) {
    // Asegúrate de que la entrada es un JSON válido y guárdalo en la sesión
    $_SESSION['selectedSeats'] = json_decode($_POST['selectedSeats'], true);
}
?>
?>
<body>
    <?php include_once("./components/navbar.php"); ?>
    <div class="siteLayout">
        <main class="mainContainer">
            <div>
                <p class="psgTitle marginL">Vuelo de <?php echo htmlspecialchars($_POST['origen'] ?? 'Origen desconocido'); ?> hasta <?php echo htmlspecialchars($_POST['destino'] ?? 'Destino desconocido'); ?></p>
                <div class="splitMsgContainer marginL">
                    <i class="fa-solid fa-person-walking-luggage lightIcon"></i>
                    <div class="subdivision"></div>
                    <p class="simpleText">Selecciona al pasajero y uno de los asientos disponibles.</p>
                </div>
            </div>
            <div class="seatSelectionContainer">
                <div class="passengersSide">
                    <div id="passengerList">
                        <?php
                        $passengers = [];
                        $cantidad_personas = intval($_POST['cantidad_personas'] ?? 0);
                        $_SESSION['cantidad_personas'] = $cantidad_personas; // Guardar la cantidad de personas en la sesión
                        for ($i = 1; $i <= $cantidad_personas; $i++) {
                            if (isset($_POST["names_$i"], $_POST["lastNames_$i"])) {
                                $passengers[] = htmlspecialchars($_POST["names_$i"]) . ' ' . htmlspecialchars($_POST["lastNames_$i"]);
                            }
                        }
                        foreach ($passengers as $index => $passenger) {
                            echo "<div class='passengerNameCard' onclick='selectPassenger(event)'>
                                <div class='numCircleDiv'>" . ($index + 1) . "</div>
                                <div class='seat-info'>
                                    <span>{$passenger} - Asiento: </span>
                                    <span class='seat-number'></span>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div style="margin-top: 3rem;">
                <a href="./payments.php" class="seatsContinue">Continuar</a>
            </div>
        </main>
        <div class="planeSide">
            <div class="planeBody shadow-xl">
                <div class="planeFront"><p>Cabina</p></div>
                <div id="seatMap">
                    <!-- Seat map will be generated here using JavaScript -->
                </div>
                <div class="planeFront"><p>Zona de equipaje</p></div>
            </div>

        </div>
    </div>
    <footer><?php include_once("./components/footer.php"); ?></footer>
    <script>



        const seatMap = document.getElementById('seatMap');
        const rows = 10; // Number of rows
        const cols = ['A', 'B', 'C', 'D', 'F', 'G']; // Columns

        // Generate seat map
        for (let i = 1; i <= rows; i++) {
            const row = document.createElement('div');
            row.classList.add('seat-row');
            for (let j = 0; j < cols.length; j++) {
                const seat = document.createElement('div');
                seat.classList.add('seat');
                seat.dataset.seatNumber = i + cols[j];
                seat.textContent = i + cols[j                ];
                row.appendChild(seat);
                seat.addEventListener('click', selectSeat);
            }
            seatMap.appendChild(row);
        }

        document.getElementById('formId').addEventListener('submit', function(event) {
    event.preventDefault();
    const allSelectedSeats = [];

    // Suponiendo que cada asiento seleccionado tiene una clase 'selected'
    document.querySelectorAll('.seat.selected').forEach(function(seat) {
        allSelectedSeats.push(seat.dataset.seatNumber);
    });

    // Añade los asientos seleccionados como un campo oculto en el formulario
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'selectedSeats';
    hiddenInput.value = JSON.stringify(allSelectedSeats);
    this.appendChild(hiddenInput);

    this.submit(); // Envía el formulario con los datos de los asientos
});


// Function to handle seat selection
function selectSeat(event) {
    const selectedSeat = event.target;
    const selectedPassenger = document.querySelector('.passengerNameCard.passengerSelected');
    if (selectedPassenger && !selectedSeat.classList.contains('passengerSelected')) {
        const seatNumberSpan = selectedPassenger.querySelector('.seat-number');
        seatNumberSpan.textContent = selectedSeat.dataset.seatNumber;

        // Actualizar todos los asientos seleccionados
        const allSelectedSeats = Array.from(document.querySelectorAll('.seat-number')).map(seat => seat.textContent || "No seleccionado");
        sessionStorage.setItem('selectedSeats', JSON.stringify(allSelectedSeats));
    }
}


document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    const allSelectedSeats = sessionStorage.getItem('selectedSeats');
    // Añade los asientos seleccionados como un campo oculto en el formulario
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'selectedSeats';
    hiddenInput.value = allSelectedSeats;
    this.appendChild(hiddenInput);
    this.submit();
});


// Cuando se envía el formulario, guardar los asientos seleccionados en la sesión
document.querySelector('form').addEventListener('submit', function() {
    const passengerNames = Array.from(document.querySelectorAll('.seat-info span')).map(span => span.textContent);
    const selectedSeats = passengerNames.map(name => ({ name: name, seat: sessionStorage.getItem(name) }));
    sessionStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
});


// Cuando se envía el formulario, guardar los asientos seleccionados en la sesión
document.querySelector('form').addEventListener('submit', function() {
    const selectedSeats = Array.from(document.querySelectorAll('.seat-number')).map(span => span.textContent);
    sessionStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
});



        // Function to handle passenger selection
        function selectPassenger(event) {
            const selectedPassenger = event.currentTarget;
            const allPassengers = document.querySelectorAll('.passengerNameCard');
            allPassengers.forEach(passenger => {
                passenger.classList.remove('passengerSelected');
            });
            selectedPassenger.classList.add('passengerSelected');


        }
    </script>
</body>
</html>
