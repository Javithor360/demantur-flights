<?php
session_start();


if (isset($_GET['info'])) {
    if ($_GET['info'] === 'error_payment') {
        $msg = "Ha ocurrido un error al procesar el pago, inténtalo más tarde.";
    }
}
?>
<style>
    /* Estilo básico de la modal */
    .modal {
        display: none;
        /* Oculta la modal por defecto */
        position: fixed;
        /* Fija en la pantalla */
        z-index: 1;
        /* Sitúa sobre otros elementos */
        left: 0;
        top: 0;
        width: 100%;
        /* Anchura completa */
        height: 100%;
        /* Altura completa */
        overflow: auto;
        /* Habilita desplazamiento si es necesario */
        background-color: rgba(0, 0, 0, 0.4);
        /* Negro con opacidad */
    }

    /* Contenido de la modal */
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: auto;
        min-width: 20%;
        /* Asegura un ancho mínimo */
    }

    /* Botón para cerrar la modal */
    .close {
        color: #aaa;
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    /* Ajustes de Tailwind CSS */
    @import url('https://cdn.tailwindcss.com');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>


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

                <?php
                if (isset($msg)) { ?>
                    <div class="p-5 mt-4 bg-red-100 border-2 border-red-400">
                        <p class='error-msg'><?= $msg ?></p>
                    </div>
                <?php }
                ?>

                <form action="../controllers/flight.controller.php" method="POST">
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Datos de facturación</h3>
                        <input type="email" name="email" placeholder="Correo electrónico" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="address" placeholder="Dirección de residencia" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="city" placeholder="Ciudad" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="text" name="country" placeholder="País" class="w-full p-4 mb-4 border rounded-lg" required>
                        <input type="button" id="openModal" class="px-6 py-3 bg-red-600 text-white font-bold rounded hover:bg-red-700 transition duration-300" value="Agregar Metodo de Pago">
                        <div id="myModal" class="modal">
                            <!-- Contenido de la modal -->
                            <div class="modal-content">

                                <body class="bg-gray-100">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
                                            <div class="mb-4">
                                                <span class="close">&times;</span>
                                                <img src="./assets/img/logo_full.png" alt="Company logo with a red icon resembling a bird in flight, placed to the left of the company name 'Avianca' in red text." class="mb-6">
                                                <h1 class="mb-2 text-2xl font-bold">Ingresa tu tarjeta</h1>
                                                <p class="mb-6 text-gray-600">Paga seguro con estos medios de pago</p>
                                                <div class="flex mb-6 space-x-2">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="35" height="35" alt="VISA logo">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/375px-Mastercard-logo.svg.png" width="35" height="35" alt="MasterCard logo">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/American_Express_logo_%282018%29.svg/270px-American_Express_logo_%282018%29.svg.png" width="35" height="35" alt="American Express logo">
                                                    <img src="https://raw.githubusercontent.com/Javithor360/Demantur/master/client/src/pages/static/assets/img/logos/png/Logo_Icon-1.png" width="35" height="35" alt="UATP logo">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-bold text-gray-700" for="cardholder-name">
                                                    Nombre del titular
                                                </label>
                                                <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="cardholder-name" type="text" placeholder="Nombre del titular">
                                            </div>
                                            <div class="mb-6">
                                                <label class="block mb-2 text-sm font-bold text-gray-700" for="card-number">
                                                    Número de tarjeta
                                                </label>
                                                <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="card-number" type="text" placeholder="Número de tarjeta">
                                            </div>
                                            <div class="flex justify-between mb-6">
                                                <div class="w-1/2 mr-2">
                                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="expiration-month">
                                                        Expiración
                                                    </label>
                                                    <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="expiration-month" type="text" placeholder="Mes">
                                                </div>
                                                <div class="w-1/3 mx-2">
                                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="expiration-year">
                                                        &nbsp;
                                                    </label>
                                                    <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="expiration-year" type="text" placeholder="Año">
                                                </div>
                                                <div class="w-1/3 ml-2">
                                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="cvv">
                                                        &nbsp;
                                                    </label>
                                                    <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="cvv" type="text" placeholder="CVV">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Código HTML de pago integrado termina aquí -->
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" name="terms" class="mr-2" required>
                        <label for="terms" class="text-sm">He leído y acepto las condiciones del <a href="#" class="text-blue-600">contrato de transporte</a> y las restricciones sobre <a href="#" class="text-blue-600">mercancías peligrosas</a>.</label>
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="action" value="save_flight_reservation" />
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
    <script>
        // Obtiene la modal
        var modal = document.getElementById("myModal");

        // Obtiene el botón que abre la modal
        var btn = document.getElementById("openModal");

        // Obtiene el elemento <span> que cierra la modal
        var span = document.getElementsByClassName("close")[0];

        // Cuando el usuario hace clic en el botón, abre la modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Cuando el usuario hace clic en <span> (x), cierra la modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic en cualquier lugar fuera de la modal, cierra la modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.querySelector('.close').addEventListener('click', function() {
            document.querySelector('#idDeTuModal').style.display = 'none';
        });
    </script>
</body>

</html>