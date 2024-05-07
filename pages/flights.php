<?php
    include_once("../controllers/flight.controller.php");
    $title = 'Búsqueda de Vuelos';
    
    if (isset($_SESSION['last_search']['lugar']) && isset($_SESSION['last_search']['fecha_salida'])) {
        $flights = FlightController::flight_search($_SESSION['last_search']['lugar'], $_SESSION['last_search']['fecha_salida']);
    } else {
        $flights = FlightController::getFlights(true);
    }
?>

<html lang="en">
<?php include_once("./components/headContent.php"); ?>

<body>
    <?php include_once("./components/navbar.php"); ?>
    <main class="container min-h-full mx-auto mt-10">
        <div>
            <h1 class="mb-4 font-bold text-8xl">¡Elije tu destino!</h1>
            <p>Descripción de la página</p>
        </div>
        <hr class="my-5 border-gray-500 max-w-[30%] border-t-2">
        <div class="flex w-full mt-20 flights-container">
            <div class="w-[20%] mt-2 rounded-xl">
                <form action="../controllers/flight.controller.php" method="POST" class="flex flex-col">
                    <label for="lugar" class="text-2xl font-bold">Destino</label>
                    <input type="text" name="lugar" id="lugar" class="w-1/2 p-2 mb-5 border-2 border-gray-500 rounded-md" value="<?php echo isset($_SESSION['last_search']['lugar']) ? $_SESSION['last_search']['lugar'] : "" ?>" required>
                    <label for="fecha_salida" class="text-2xl font-bold">Fecha de salida</label>
                    <input type="date" name="fecha_salida" id="fecha_salida" class="w-1/2 p-2 mb-5 border-2 border-gray-500 rounded-md" value="<?php echo isset($_SESSION['last_search']['fecha_salida']) ? $_SESSION['last_search']['fecha_salida'] : "" ?>" required>
                    <div class="flex w-[50%] space-x-2">
                        <input type="hidden" name="action" value="filter_flight" />
                        <button type="submit" class="w-1/2 p-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">Buscar</button>
                        <button type="button" onclick="removeFilters()" class="w-1/2 p-2 text-white bg-red-500 rounded-md hover:bg-red-700">Limpiar</button>
                    </div>
                </form>
            </div>
            <div class="flex flex-col w-[80%] flights-list bg-opacity-50 shadow-md bg-gray-50 rounded-xl">
                <div class='p-8'>
                    <?php if(isset($_SESSION['last_search']) && count($flights) > 0) { ?>
                        <p class='text-4xl font-bold'>Vuelos Disponibles</p>
                        <?php foreach ($flights as $flight) { ?>
                            <div name='info_vuelo' class='flex items-center justify-center p-10 mt-10 mb-20 space-x-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800 h-50'>
                                <!-- Origen -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-plane-departure'></i>
                                        <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>Origen</p>
                                    </div>
                                    <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getOrigen() ?></p>
                                </div>
                                <!-- Destino -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-plane-arrival'></i>
                                        <p name='destino' class='text-2xl text-gray-700 dark:text-gray-300'>Destino</p>
                                    </div>
                                    <p name='lu' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getDestino() ?></p>
                                </div>
                                <!-- Aerolínea -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-ticket'></i>
                                        <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>Aerolínea</p>
                                    </div>
                                    <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getAerolinea() ?></p>
                                </div>
                                <!-- Fecha de salida -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-calendar-days'></i>
                                        <p name='salida' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de salida</p>
                                    </div>
                                    <p name='fecha_salida' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getFechaSalida() ?></p>
                                </div>
                                <!-- Fecha de llegada -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-calendar-day'></i>
                                        <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de llegada</p>
                                    </div>
                                    <p name='fecha_llegada' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getHoraLlegada() ?></p>
                                </div>
                                <!-- Tarifa -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-dollar-sign'></i>
                                        <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Tarifa</p>
                                    </div>
                                    <p name='tarifa' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getPrecioBoleto() ?></p>
                                </div>

                                <div>
                                    <a href="<?php echo isset($_SESSION['user']) ? "./passengerForm.php" : "./login.php" ?>" class='items-center px-4 py-2 ml-10 text-white transition duration-500 ease-in-out bg-green-500 rounded hover:bg-green-700 hover:text-white'><?php echo isset($_SESSION['user']) ? "Comprar" : "Iniciar sesión" ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else if (empty($_SESSION['last_search']) && count($flights) > 0) { ?>
                        <p class='text-4xl font-bold'>Echa un vistazo a nuestros vuelos disponibles</p>
                        <?php foreach ($flights as $flight) { ?>
                            <div name='info_vuelo' class='flex items-center justify-center p-10 mt-10 mb-20 space-x-8 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800 h-50'>
                                <!-- Origen -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-plane-departure'></i>
                                        <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>Origen</p>
                                    </div>
                                    <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getOrigen() ?></p>
                                </div>
                                <!-- Destino -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-plane-arrival'></i>
                                        <p name='destino' class='text-2xl text-gray-700 dark:text-gray-300'>Destino</p>
                                    </div>
                                    <p name='lu' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getDestino() ?></p>
                                </div>
                                <!-- Aerolínea -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-ticket'></i>
                                        <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>Aerolínea</p>
                                    </div>
                                    <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getAerolinea() ?></p>
                                </div>
                                <!-- Fecha de salida -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-calendar-days'></i>
                                        <p name='salida' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de salida</p>
                                    </div>
                                    <p name='fecha_salida' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getFechaSalida() ?></p>
                                </div>
                                <!-- Fecha de llegada -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-calendar-day'></i>
                                        <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de llegada</p>
                                    </div>
                                    <p name='fecha_llegada' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getHoraLlegada() ?></p>
                                </div>
                                <!-- Tarifa -->
                                <div class='flex flex-col items-center'>
                                    <div class='flex items-center mr-8'>
                                        <i style='color:#76ABAE;' class='mr-2 fa-solid fa-dollar-sign'></i>
                                        <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Tarifa</p>
                                    </div>
                                    <p name='tarifa' class='text-2xl text-gray-700 dark:text-gray-300'><?= $flight->getPrecioBoleto() ?></p>
                                </div>

                                <div>
                                <a href="<?php echo isset($_SESSION['user']) ? "./passengerForm.php" : "./login.php" ?>" class='items-center px-4 py-2 ml-10 text-white transition duration-500 ease-in-out bg-green-500 rounded hover:bg-green-700 hover:text-white'><?php echo isset($_SESSION['user']) ? "Comprar" : "Iniciar sesión" ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class='text-4xl font-bold'>No hay vuelos disponibles</p>
                    <?php } ?>
                </div>
            </div>
    </main>
    <?php include_once("./components/footer.php"); $_SESSION['last_search'] = null; ?>

    <script>
        function removeFilters() {
            document.getElementById('lugar').value = '';
            document.getElementById('fecha_salida').value = '';

            <?php $_SESSION['last_search'] = null; ?>

            window.location.href = './flights.php';
        }
    </script>
</body>

</html>