<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/DSS FINAL/demantur-flights/models/class.connection.php';

$db = new Database();
$conn = $db->connect();

$id_horario = $_SESSION['id_horario'] ?? 1;
$cantidad_personas = isset($_POST['cantidad_personas']) ? $_POST['cantidad_personas'] : $_SESSION['cantidad_personas'];
$pasajeros = isset($_POST['pasajeros']) ? $_POST['pasajeros'] : (isset($_SESSION['pasajeros']) ? $_SESSION['pasajeros'] : null);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['selectedSeats'])) {
        $_SESSION['selectedSeats'] = $_POST['selectedSeats']; // Guardar los asientos en la sesión
    }

    // Otros procesamientos necesarios...
}


$detalleVuelo = null;
$total = 0;

if ($id_horario) {
    $stmt = $conn->prepare("SELECT h.*, v.tarifa, d1.lugar as origen, d2.lugar as destino 
                            FROM horario h 
                            JOIN vuelo v ON h.id_horario = v.id_horario 
                            JOIN destino d1 ON h.id_origen = d1.id_destino 
                            JOIN destino d2 ON h.id_destino = d2.id_destino
                            WHERE h.id_horario = :id_horario");
    $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
    $stmt->execute();
    $detalleVuelo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($detalleVuelo) {
        $total = $cantidad_personas * $detalleVuelo['tarifa'];
    }
}

$conn = null;
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
        <div class="flex flex-col lg:flex-row justify-between bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Left side -->
            <div class="w-full lg:w-2/3 p-8">
                <h2 class="text-2xl font-semibold mb-2">Pagar y confirmar reserva</h2>
                <p class="text-lg text-gray-600 mb-6">Elige tu método de pago favorito.</p>

                <form action="./infoCard.php" method="POST">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Datos de facturación</h3>
                        <input type="email" name="email" placeholder="Correo electrónico" class="w-full p-4 border rounded-lg mb-4" required>
                        <input type="text" name="address" placeholder="Dirección de residencia" class="w-full p-4 border rounded-lg mb-4" required>
                        <input type="text" name="city" placeholder="Ciudad" class="w-full p-4 border rounded-lg mb-4" required>
                        <input type="text" name="country" placeholder="País" class="w-full p-4 border rounded-lg mb-4" required>
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" name="terms" class="mr-2" required>
                        <label for="terms" class="text-sm">He leído y acepto las condiciones del <a href="#" class="text-blue-600">contrato de transporte</a> y las restricciones sobre <a href="#" class="text-blue-600">mercancías peligrosas</a>.</label>
                    </div>

                    <div class="flex items-center">
                        <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 cursor-pointer" type="submit">Confirmar y pagar</button>
                        <p class="text-sm text-green-600 ml-4"><i class="fas fa-lock mr-1"></i>Usamos métodos de confianza para procesar tus pagos de forma segura.</p>
                    </div>
                </form>
            </div>

            <!-- Right side -->
            <div class="w-full lg:w-1/3 bg-gray-200 p-8 flex flex-col">
                <h3 class="text-2xl font-semibold mb-4">Resumen de compra</h3>
                <?php if ($detalleVuelo): ?>
                <div class="mb-6 border-solid border-b-2 border-gray-300 pb-4">
                    <h4 class="text-xl font-semibold mb-2">Vuelos</h4>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-plane-departure mr-2 text-black text-lg"></i>
                            <p class="text-lg mb-1 font-semibold"><?= $detalleVuelo['origen'] . ' a ' . $detalleVuelo['destino']; ?></p>
                        </div>
                        <p class="text-base text-gray-600"><?= date('d-m-Y H:i', strtotime($detalleVuelo['hora_salida'])); ?> - <?= date('d-m-Y H:i', strtotime($detalleVuelo['hora_llegada'])); ?></p>
                    </div>
                    <div class="flex items-center">
                        <i class="fa fa-users mr-2 text-black text-base"></i>
                        <p class="text-base"><?= $cantidad_personas ?> pasajeros</p>
                    </div>
                </div>
                <?php if ($pasajeros && is_array($pasajeros)) : ?>
                    <div class="mb-6 border-solid border-b-2 border-gray-300 pb-4">
                        <h4 class="text-xl font-semibold mb-2">Pasajeros</h4>
                        <?php foreach ($pasajeros as $index => $pasajero) : ?>
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2 text-black text-lg"></i>
                                <p class="text-lg mb-1 font-semibold"><?php echo htmlspecialchars($pasajero); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-6 border-solid border-b-2 border-gray-300">
                    <h4 class="text-xl font-semibold mb-2">Detalle de compra</h4>
                    <div class="mb-4 ml-6 text-gray-600">
                    <div class="mb-4 ml-6 text-gray-600">
    <?php 
    // Decodificar JSON si es necesario y asegurarse de que es un arreglo antes de iterar
    $selectedSeats = isset($_SESSION['selectedSeats']) ? $_SESSION['selectedSeats'] : [];
    if (is_string($selectedSeats)) {
        $selectedSeats = json_decode($selectedSeats, true);
    }

    foreach ($selectedSeats as $index => $seat) {
        echo "<p>Asiento para pasajero " . ($index + 1) . ": " . htmlspecialchars($seat) .
             " - Precio: USD " . number_format($detalleVuelo['tarifa'], 2) . "</p>";
    }
    ?>
</div>

                    </div>
                </div>

                <div class="mt-auto">
                    <p class="text-2xl font-semibold">Total a pagar</p>
                    <p class="text-4xl font-bold">USD <?= number_format($total, 2); ?></p>
                </div>
                <?php else: ?>
                    <p>No se ha encontrado información del vuelo seleccionado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include_once("./components/footer.php"); ?>
</body>
</html>
