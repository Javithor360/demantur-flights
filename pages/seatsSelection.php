<html lang="es">
<?php 
    $title = "Asientos";
    $arg = "<link rel='stylesheet' href='./assets/css/SeatSelection.css'>";
    include_once("./components/headContent.php"); 
?>
<body>
    <?php include_once("./components/navbar.php") ?>
    <div class="siteLayout">
        <main class="mainContainer">
            <div>
                <p class="psgTitle marginL">Selección de asiento</p>
                <div class="splitMsgContainer marginL">
                    <i class="fa-solid fa-person-walking-luggage lightIcon"></i>
                    <div class="subdivision"></div>
                    <p class="simpleText">Selecciona al pasajero y uno de los asientos disponibles</p>
                </div>
            </div>
            <div class="seatSelectionContainer">
                <div class="passengersSide">
                    <div id="passengerList">
                        <!-- Passenger cards will be generated here -->
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
                    <!-- Seat map will be generated here -->
                </div>
                <div class="planeFront"><p>Zona de equipaje</p></div>
            </div>

        </div>
    </div>
    <?php include_once("./components/footer.php") ?>
    <script>
        const seatMap = document.getElementById('seatMap');
        const passengerList = document.getElementById('passengerList');
        const rows = 10; // Number of rows
        const cols = ['A', 'B', 'C', 'D', 'F', 'G']; // Columns
        const passengers = ['Daniel Vásquez', 'Javier Mejía']; // List of passengers

        // Generate passenger cards
        let passengerCount = 1;

        passengers.forEach(passenger => {
            const card = document.createElement('div');
            card.classList.add('passengerNameCard');
            
            const passengerNumberDiv = document.createElement('div');
            passengerNumberDiv.classList.add('numCircleDiv');
            passengerNumberDiv.textContent = passengerCount;
            card.appendChild(passengerNumberDiv);
            
            const seatInfoDiv = document.createElement('div');
            seatInfoDiv.classList.add('seat-info');
            
            const passengerInfo = document.createTextNode(passenger + ' - Asiento: ');
            seatInfoDiv.appendChild(passengerInfo);
            
            const seatNumberSpan = document.createElement('span');
            seatNumberSpan.classList.add('seat-number');
            seatInfoDiv.appendChild(seatNumberSpan);
            
            card.appendChild(seatInfoDiv);
            
            passengerList.appendChild(card);
            
            passengerCount++;
        });

        // Generate seat map
        for (let i = 1; i <= rows; i++) {
            const row = document.createElement('div');
            row.classList.add('seat-row');
            for (let j = 0; j < cols.length; j++) {
                const seat = document.createElement('div');
                seat.classList.add('seat');
                seat.dataset.seatNumber = i + cols[j];
                seat.textContent = i + cols[j];
                row.appendChild(seat);
            }
            seatMap.appendChild(row);
        }

        // Function to handle seat selection
        function selectSeat(event) {
            const selectedSeat = event.target;
            const selectedPassenger = document.querySelector('.passengerNameCard.passengerSelected');
        
            if (!selectedSeat.classList.contains('passengerSelected') && !selectedSeat.dataset.passenger) {
                if (selectedPassenger) {
                    const previouslySelectedSeat = seatMap.querySelector('.seat.passengerSelected[data-passenger="' + selectedPassenger.textContent.split(' - ')[0] + '"]');
                    if (previouslySelectedSeat) {
                        previouslySelectedSeat.classList.remove('passengerSelected');
                        previouslySelectedSeat.removeAttribute('data-passenger');
                    }
                
                    selectedSeat.classList.add('passengerSelected');
                    selectedSeat.dataset.passenger = selectedPassenger.textContent.split(' - ')[0];
                    selectedPassenger.querySelector('.seat-number').textContent = selectedSeat.dataset.seatNumber;
                }
            }
        }

        // Function to handle passenger selection
        function selectPassenger(event) {
            const selectedPassenger = event.currentTarget; // Usar currentTarget en lugar de target
            if (!selectedPassenger.classList.contains('passenger-number') && !selectedPassenger.classList.contains('seat-number')) { 
        
                const allPassengers = document.querySelectorAll('.passengerNameCard');
                allPassengers.forEach(passenger => {
                    passenger.classList.remove('passengerSelected');
                });
                selectedPassenger.classList.add('passengerSelected');
            }
        }

        // Add event listeners to seats
        const allSeats = document.querySelectorAll('.seat');
        allSeats.forEach(seat => {
            seat.addEventListener('click', selectSeat);
        });

        // Add event listeners to passenger cards
        const allPassengers = document.querySelectorAll('.passengerNameCard');
        allPassengers.forEach(passenger => {
            passenger.addEventListener('click', selectPassenger);
        });
    </script>
</body>
</html>