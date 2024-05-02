<?php 
    $title = "Detalles del vuelo";
    $focus = "Inicio";
    $description = "Detalles de pasajeros, y horarios y del vuelo en general";
    $type = "Vuelo";
    require_once("../../controllers/flightController.php");
    if (empty($_POST['id_vuelo'])) {
        header("Location: index.php");
        exit;
    }
    $flight_details = FlightController::getFlightDetails();
    $passengers_details = FlightController::getFlightPassengers();
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./components/adminHead.php") ?>
<body>
<main class="flex">
        <?php require_once("./components/sidebar.php") ?>
        <section class="w-full">
            <div class="w-[80%] ml-8 mb-8 mt-8">
                <?php require_once("./components/pageHeader.php") ?>
            </div>
            
            <div class="overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg w-[95%] ml-8 mb-8 max-h-[30rem]">
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
                                Fecha de llegada
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora de llegada
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
                                Código del avión
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio del boleto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($flight_details['error'])) {
                                echo "<tr colspan='10' class='odd:bg-white even:bg-gray-50 border-b w-full'>
                                <td colspan='10' class='px-6 py-4 font-medium text-[#222831] whitespace-nowrap text-red-500 w-full text-center'>
                                    [!] {$flight_details['error']}
                                </td>
                              </tr>";
                            } else {
                        ?>      <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <td scope="row" class="px-6 py-4 font-medium text-[#222831] whitespace-nowrap">
                                        <?php echo $flight_details['flight_code']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['departure_date']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['departure_time']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['arrival_date']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['arrival_time']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['origin']; ?>
                                        <p>
                                            <?php echo $flight_details['airport_or']; ?>
                                        </p>

                                    </td>
                                    <td class="px-6 py-4 ">
                                        <?php echo $flight_details['destination']; ?>
                                        <p>
                                            <?php echo $flight_details['airport_des']; ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['airline']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['airplane_code']; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $flight_details['price']; ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="flex w-[80%] mx-auto">
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
                <p class="text-center text-xl font-bold text-[#76ABAE] tracking-tight my-8 ml-4 w-[20%]">Pasajeros del vuelo</p>
                <div class="w-[40%] flex items-center"><hr class="w-full h-1 bg-[#76ABAE]"></div>
            </div>
            <div class="overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg w-[80%] mx-auto mb-8 max-h-[20rem]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="sticky top-0 text-xs text-[#fff] uppercase bg-[#31363F]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Código del boleto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de compra
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre del pasajero
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Número de asiento
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($flight_details['error'])) {
                                echo "<tr colspan='10' class='odd:bg-white even:bg-gray-50 border-b w-full'>
                                <td colspan='10' class='px-6 py-4 font-medium text-[#222831] whitespace-nowrap text-red-500 w-full text-center'>
                                    [!] {$flight_details['error']}
                                </td>
                              </tr>";
                            } else {
                            ?>     
                                <?php if(empty($passengers_details)) {?>
                                <tr colspan="7" class="text-center text-xl font-bold text-[#8f9194] tracking-tight h-[10rem]">
                                    <td colspan="7">
                                        <i class="fa-solid fa-person-circle-xmark"></i>
                                        <p>No hay pasajeros registrados para este vuelo</p>
                                    </td> 
                                </tr>
                            <?php } else {?>

                                <?php foreach ($passengers_details as $passenger): ?>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <td class="px-6 py-4 font-medium text-[#222831]"><?php echo $passenger['codigo_boleto']; ?></td>
                                        <td class="px-6 py-4"><?php echo $passenger['fecha_compra']; ?></td>
                                        <td class="px-6 py-4"><?php echo $passenger['nombre_pasajero']; ?></td>
                                        <td class="px-6 py-4"><?php echo $passenger['numero_asiento']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                            <?php
                            }   
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>