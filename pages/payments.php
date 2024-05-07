<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar y confirmar reserva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="./assets/css/navfoot.css">
</head>

<body class="bg-gray-100">
    <?php include_once("./components/navbar_solo.php"); ?>

    <div class="container mx-auto px-4 py-24 min-h-[90vh]">
        <div class="flex flex-col justify-between overflow-hidden bg-white rounded-lg shadow-lg lg:flex-row">
            <!-- Left side -->
            <div class="w-full p-8 lg:w-2/3">
                <h2 class="mb-2 text-2xl font-semibold">Pagar y confirmar reserva</h2>
                <p class="mb-6 text-lg text-gray-600">Elige tu método de pago favorito.</p>

                <form action="./infoCard.php" method="POST">
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Datos de facturación</h3>
                        <input type="email" name="email" placeholder="Correo electrónico" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="address" placeholder="Dirección de residencia" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="city" placeholder="Ciudad" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="country" placeholder="País" class="w-full p-4 mb-4 border rounded-lg" required>
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" name="terms" class="mr-2" required>
                        <label for="terms" class="text-sm">He leído y acepto las condiciones del <a href="#" class="text-blue-600">contrato de transporte</a> y las restricciones sobre <a href="#" class="text-blue-600">mercancías peligrosas</a>.</label>
                    </div>

                    <div class="flex items-center">
                        <button class="px-6 py-3 font-semibold text-white bg-green-600 rounded-lg cursor-pointer hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50" type="submit">Confirmar y pagar</button>
                        <p class="ml-4 text-sm text-green-600"><i class="mr-1 fas fa-lock"></i>Usamos métodos de confianza para procesar tus pagos de forma segura.</p>
                    </div>
                </form>
            </div>

            <!-- Right side -->
            <div class="flex flex-col w-full p-8 bg-gray-200 lg:w-1/3">
                <h3 class="mb-4 text-2xl font-semibold">Resumen de compra</h3>
                <?php if ($_SESSION['selected_flight']) : ?>
                    <div class="pb-4 mb-6 border-b-2 border-gray-300 border-solid">
                        <h4 class="mb-2 text-xl font-semibold">Vuelos</h4>
                        <div class="mb-4">
                            <div class="flex items-center">
                                <i class="mr-2 text-lg text-black fas fa-plane-departure"></i>
                                <p class="mb-1 text-lg font-semibold"><?= $_SESSION['selected_flight']['origen_lugar'] . ' a ' . $_SESSION['selected_flight']['destino_lugar']; ?></p>
                            </div>
                            <p class="text-base text-gray-600"><?= date('d/m/Y (H:i)', strtotime($_SESSION['selected_flight']['hora_salida'])); ?> - <?= date('d/m/Y (H:i)', strtotime($_SESSION['selected_flight']['hora_llegada'])); ?></p>
                        </div>
                        <div class="flex items-center">
                            <i class="mr-2 text-base text-black fa fa-users"></i>
                            <p class="text-base"><?= count($_SESSION['selected_passengers']) > 1 ? count($_SESSION['selected_passengers']) . " pasajeros" : "1 pasajero" ?></p>
                        </div>
                    </div>
                    <?php if ($_SESSION['selected_passengers'] && is_array($_SESSION['selected_passengers'])) { ?>
                        <div class="pb-4 mb-6 border-b-2 border-gray-300 border-solid">
                            <h4 class="mb-2 text-xl font-semibold">Pasajeros</h4>
                            <?php foreach ($_SESSION['selected_passengers'] as $index => $passengerData) {
                                $passenger = $passengerData['names'] . " " . $passengerData['lastNames'];
                            ?>
                                <div class="flex items-center">
                                    <i class="mr-2 text-lg text-black fas fa-user"></i>
                                    <p class="mb-1 text-lg"><?php echo htmlspecialchars($passenger); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="mb-6 border-b-2 border-gray-300 border-solid">
                        <h4 class="mb-2 text-xl font-semibold">Detalle de compra</h4>
                        <div class="mb-4 ml-6 text-gray-600">
                            <div class="mb-4 ml-6 text-gray-600">
                                <?php 
                                    foreach ($_SESSION['selected_passengers'] as $index => $passengerData) {
                                        $passenger = $passengerData['names'] . " " . $passengerData['lastNames'];
                                        echo "<p>Asiento de pasajero #" . ($index + 1) . " (" . htmlspecialchars($passengerData['seat']) . ") - Precio: USD " . number_format($_SESSION['selected_flight']['tarifa'], 2) . "</p>";
                                    }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="mt-auto">
                        <p class="text-2xl font-semibold">Total a pagar</p>
                        <p class="text-4xl font-bold">USD <?= number_format(($_SESSION['selected_flight']['tarifa'] * count($_SESSION['selected_passengers'])), 2); ?></p>
                    </div>
                <?php else : ?>
                    <p>No se ha encontrado información del vuelo seleccionado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include_once("./components/footer.php"); ?>
</body>

</html>