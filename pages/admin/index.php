<?php 
    $title = "Admin";
    $focus = "Inicio";
    require_once("../../controllers/flightController.php");
    $commingflight = FlightController::getFlights(true);
    $pastflight = FlightController::getFlights(false);   
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once("./components/adminHead.php") ?>
<body>
    <main class="flex">
        <?php require_once("./components/sidebar.php") ?>
        <section class="w-full">
        <header class="bg-[#EEEEEE] text-[#222831] py-4 flex justify-between items-center px-6">
        <div class="flex items-center">
            <span class="inline-block text-2xl font-bold text-[#31363F] tracking-tight">Bienvenido</span>
        </div>
        <div class="flex items-center">
            <span class="mr-2">
                <i class="far fa-calendar text-[#76ABAE]"></i>
            </span>
            <span class="mr-6 font-semibold" id="fecha"><?php 
                date_default_timezone_set('America/El_Salvador');
                echo date('d/m/Y');
                ?></p>
            </span>
            <span class="mr-2">
                <i class="far fa-clock text-[#76ABAE]"></i>
            </span>
            <span class="font-semibold" id="hora"><p id="time"></p></span>
        </div>
    </header>
            <div class="flex w-[80%] mx-auto">
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
                <p class="text-center text-xl font-bold text-[#76ABAE] tracking-tight my-8 ml-4 w-[20%]">Vuelos próximos</p>
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
            </div>
            <div class="overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg w-[80%] mx-auto mb-8 max-h-[30rem]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="sticky top-0 text-xs text-[#fff] uppercase bg-[#31363F]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Código de vuelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de salida
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora de salida
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Origen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Destino
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aerolínea
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <i class="self-center fa-solid fa-plane"></i>
                            </th>
                        </tr>
                    </thead>
                    <?php if (!empty($commingflight)) { ?>
                    <tbody>
                        <?php foreach ($commingflight as $flights): ?>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-[#222831] whitespace-nowrap">
                                    <?php echo $flights->getCodigoVuelo(); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getFechaSalida(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getHoraSalida(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getOrigen(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getDestino(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getAerolinea(); ?>
                                </td>
                                <td class="px-6 py-4">
                                <form action="./flightDetails.php" method="post">
                                        <input type="hidden" name="id_vuelo" value="<?php echo $flights->getIdVuelo(); ?>">
                                        <input type="hidden" name="flight_code" value="<?php echo $flights->getCodigoVuelo(); ?>">
                                        <input type="hidden" name="departure_date" value="<?php echo $flights->getFechaSalida(); ?>">
                                        <input type="hidden" name="departure_time" value="<?php echo $flights->getHoraSalida(); ?>">
                                        <input type="hidden" name="arrival_date" value="<?php echo $flights->getFechaLlegada(); ?>">
                                        <input type="hidden" name="arrival_time" value="<?php echo $flights->getHoraLlegada(); ?>">
                                        <input type="hidden" name="origin" value="<?php echo $flights->getOrigen(); ?>">
                                        <input type="hidden" name="airport_or" value="<?php echo $flights->getAeropuertoOrigen(); ?>">
                                        <input type="hidden" name="airport_des" value="<?php echo $flights->getAeropuertoDestino(); ?>">
                                        <input type="hidden" name="destination" value="<?php echo $flights->getDestino(); ?>">
                                        <input type="hidden" name="airline" value="<?php echo $flights->getAerolinea(); ?>">
                                        <input type="hidden" name="airplane_code" value="<?php echo $flights->getTipoAvion(); ?>">
                                        <input type="hidden" name="price" value="<?php echo $flights->getPrecioBoleto(); ?>">
                                        <button type="submit" class="font-medium text-[#76ABAE] hover:underline">Más detalles</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php } else { ?>
                        <tbody>
                            <tr colspan="7" class="text-center text-xl font-bold text-[#76ABAE] tracking-tight">
                                <td colspan="7" >
                                    
                                </td>
                            </tr>
                            <tr colspan="7" class="text-center text-xl font-bold text-[#8f9194] tracking-tight h-[10rem]">
                                <td colspan="7">
                                    <i class="fa-solid fa-plane-circle-exclamation"></i>
                                    <p>Los vuelos próximos se mostrarán aquí</p>

                                </td> 
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
            <div class="flex w-[80%] mx-auto">
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
                <p class="text-center text-xl font-bold text-[#76ABAE] tracking-tight my-8 ml-4 w-[20%]">Vuelos pasados</p>
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
            </div>
            <div class="overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg w-[80%] mx-auto mb-8 max-h-[20rem]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="sticky top-0 text-xs text-[#fff] uppercase bg-[#31363F]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Código de vuelo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de salida
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora de salida
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Origen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Destino
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aerolínea
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <i class="self-center fa-solid fa-plane"></i>
                            </th>
                        </tr>
                    </thead>
                    <?php if (empty(!$commingflight)) { ?>
                    <tbody>
                        <?php foreach ($pastflight as $flights): ?>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-[#222831] whitespace-nowrap">
                                    <?php echo $flights->getCodigoVuelo(); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getFechaSalida(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getHoraSalida(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getOrigen(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getDestino(); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $flights->getAerolinea(); ?>
                                </td>
                                <td class="px-6 py-4">
                                <form action="./flightDetails.php" method="post">
                                        <input type="hidden" name="id_vuelo" value="<?php echo $flights->getIdVuelo(); ?>">
                                        <input type="hidden" name="flight_code" value="<?php echo $flights->getCodigoVuelo(); ?>">
                                        <input type="hidden" name="departure_date" value="<?php echo $flights->getFechaSalida(); ?>">
                                        <input type="hidden" name="departure_time" value="<?php echo $flights->getHoraSalida(); ?>">
                                        <input type="hidden" name="arrival_date" value="<?php echo $flights->getFechaLlegada(); ?>">
                                        <input type="hidden" name="arrival_time" value="<?php echo $flights->getHoraLlegada(); ?>">
                                        <input type="hidden" name="origin" value="<?php echo $flights->getOrigen(); ?>">
                                        <input type="hidden" name="airport_or" value="<?php echo $flights->getAeropuertoOrigen(); ?>">
                                        <input type="hidden" name="airport_des" value="<?php echo $flights->getAeropuertoDestino(); ?>">
                                        <input type="hidden" name="destination" value="<?php echo $flights->getDestino(); ?>">
                                        <input type="hidden" name="airline" value="<?php echo $flights->getAerolinea(); ?>">
                                        <input type="hidden" name="airplane_code" value="<?php echo $flights->getTipoAvion(); ?>">
                                        <input type="hidden" name="price" value="<?php echo $flights->getPrecioBoleto(); ?>">
                                        <button type="submit" class="font-medium text-[#76ABAE] hover:underline">Más detalles</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr colspan="7" class="text-center text-xl font-bold text-[#8f9194] tracking-tight h-[10rem]">
                            <td colspan="7">
                                <i class="fa-solid fa-plane-circle-check"></i>
                                <p>Los vuelos pasados se mostrarán aquí</p>
                            </td> 
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>
    <script>
        function updateClock() {
            var date = new Date(); 
            var hour = date.toLocaleTimeString('es-SV', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            var clockTag = document.getElementById('time');
            clockTag.textContent = hour;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>