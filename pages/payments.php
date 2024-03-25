<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar y confirmar reserva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../src/css/navfoot.css">
</head>

<body class="bg-gray-100">
    <?php include_once("../components/navbar_solo.php"); ?>

    <div class="container mx-auto px-4 py-24 min-h-[90vh]">
        <div class="flex flex-col lg:flex-row justify-between bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Left side -->
            <div class="w-full lg:w-2/3 p-8">
                <h2 class="text-2xl font-semibold mb-2">Pagar y confirmar reserva</h2>
                <p class="text-lg text-gray-600 mb-6">Elige tu método de pago favorito.</p>

                <!-- Card Details -->
                <!-- <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Datos de la tarjeta</h3>
                    <div class="flex space-x-2 mb-4">
                        <img src="https://placehold.co/40x25" alt="Visa logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="MasterCard logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="American Express logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="Diners Club logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="Discover logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="UATP logo" class="h-6">
                    </div>
                    <input type="text" placeholder="Ingresar tu tarjeta" class="w-full p-4 border rounded-lg mb-4">
                </div> -->

                <!-- Billing Details -->
                <form action="./infoCard.php">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Datos de facturación</h3>
                        <input type="email" placeholder="Correo electrónico" class="w-full p-4 border rounded-lg mb-4"
                            required>
                        <input type="text" placeholder="Dirección de residencia"
                            class="w-full p-4 border rounded-lg mb-4" required>
                        <input type="text" placeholder="Ciudad" class="w-full p-4 border rounded-lg mb-4" required>
                        <select class="w-full p-4 border rounded-lg mb-4" required>
                            <option>País</option>
                        </select>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" class="mr-2" required>
                        <label for="terms" class="text-sm">He leído y acepto las condiciones del <a href="#"
                                class="text-blue-600">contrato de transporte</a> y las restricciones sobre <a href="#"
                                class="text-blue-600">mercancías peligrosas</a>.</label>
                    </div>

                    <!-- Payment Button -->
                    <div class="flex items-center">
                        <input
                            class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 cursor-pointer"
                            type="submit" value="Confirmar y pagar" />
                        <p class="text-sm text-green-600 ml-4"><i class="fas fa-lock mr-1"></i>Usamos métodos de confianza para procesar tus pagos de forma segura.</p>
                    </div>
                </form>
            </div>

            <!-- Right side -->
            <div class="w-full lg:w-1/3 bg-gray-200 p-8 flex flex-col">
                <h3 class="text-2xl font-semibold mb-4">Resumen de compra</h3>
                <div class="mb-6 border-solid border-b-2 border-gray-300 pb-4">
                    <h4 class="text-xl font-semibold mb-2">Vuelos</h4>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-plane-departure mr-2 text-black text-lg"></i>
                            <p class="text-lg mb-1 font-semibold">San Salvador a Barcelona</p>
                        </div>
                        <p class="text-base text-gray-600">27 marzo 2024</p>
                        <p class="text-lg font-semibold">2:15 - 7:40</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fa fa-users mr-2 text-black text-base"></i>
                        <p class="text-base">2 pasajeros</p>
                    </div>
                </div>
                <div class="mb-6 border-solid border-b-2 border-gray-300">
                    <h4 class="text-xl font-semibold mb-2">Detalle compra</h4>
                    <div class="mb-4 ml-6 text-gray-600">
                        <div class="flex items-center justify-between w-full">
                            <p class="w-[60%]">2 tiquetes de viaje</p>
                            <p><b>USD</b> 1536,78</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="w-[60%]">2 impuestos a la venta cuando la tarifa se origina en SV</p>
                            <p><b>USD</b> 68,97</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="w-[60%]">2 asientos de pasajero</p>
                            <p><b>USD</b> 98,45</p>
                        </div>
                    </div>
                </div>
                <div class="mt-auto">
                    <p class="text-2xl font-semibold">Total a pagar</p>
                    <p class="text-4xl font-bold">USD 2.705,91</p>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("../components/footer.php"); ?>
</body>

</html>