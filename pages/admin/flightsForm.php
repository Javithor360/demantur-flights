<?php
require_once "../../controllers/admin.controller.php";

$focus = "Vuelo";
$title = "Agregar vuelos";
$description = "Texto de ejemplo";
$type = "Creación de Vuelos";
$arg = "<link rel='stylesheet' href='./assets/css/admin.css'>";

$controller = new AdminController();
$schedules = $controller->fetch_schedules();
$airplanes = $controller->fetch_airplanes();

if (isset($_GET['info'])) {
    $infoType = str_starts_with($_GET['info'], 'success') ? 'success' : 'error';
    $msg = explode('-', $_GET['info'])[1];

    if ($msg == 'empty_fields') {
        $msg = 'Por favor, rellene todos los campos';
    } else if ($msg == 'new_flight') {
        $msg = $infoType == 'success' ? 'Vuelo añadido exitosamente' : 'Ha ocurrido un error al añadir el vuelo';
    } else if ($msg == 'invalid_price') {
        $msg = 'Precio de boleto inválido: Debe ser un número mayor a 0';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("./components/adminHead.php"); ?>

<body>
    <main class="flex">
        <?php include_once("./components/sidebar.php") ?>
        <section class="w-full flex">
            <div class="container mt-12">
                <?php require_once("./components/pageHeader.php") ?>
                <form method="POST" action="../../controllers/admin.controller.php">
                    <h1 class="form-title">Agregar Vuelo</h1>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="flight-date">Horario del vuelo</label>
                            <div class="input-group">
                                <i class="fas fa-calendar-alt"></i>
                                <select id="schedule" name="schedule" class="bg-[#EEEEEE] border border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                    <option value="" disabled selected>Seleccione un horario</option>
                                    <?php foreach ($schedules as $schedule) : ?>
                                        <option value="<?= $schedule['id_horario'] ?>">
                                            <?= $schedule['aeropuerto_origen'] ?> - <?= $schedule['aeropuerto_destino'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="departure-date">Fecha de salida</label>
                            <div class="input-group">
                                <i class="fas fa-plane-departure"></i>
                                <input type="date" id="departure-date" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="departure-time">Hora de salida</label>
                            <div class="input-group">
                                <i class="fas fa-plane-departure"></i>
                                <input type="time" id="departure-time" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="arrival-date">Fecha de llegada</label>
                            <div class="input-group">
                                <i class="fas fa-plane-arrival"></i>
                                <input type="date" id="arrival-date" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrival-time">Hora de llegada estimada</label>
                            <div class="input-group">
                                <i class="fas fa-plane-arrival"></i>
                                <input type="time" id="arrival-time" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="origin">Origen</label>
                            <div class="input-group">
                                <i class="fas fa-plane-departure"></i>
                                <input type="text" id="origin" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="destination">Destino</label>
                            <div class="input-group">
                                <i class="fas fa-plane-arrival"></i>
                                <input type="text" id="destination" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="airplane">Avión y Aerolínea</label>
                            <div class="input-group">
                                <i class="fas fa-plane"></i>
                                <select id="airplane" name="airplane">
                                    <option value="" disabled selected>Seleccione un avión</option>
                                    <?php foreach ($airplanes as $airplane) : ?>
                                        <option value="<?= $airplane['id_avion'] ?>">
                                            <?= $airplane['codigo_avion'] ?> - <?= $airplane['aerolinea'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ticket-price">Precio del boleto</label>
                            <div class="input-group">
                                <i class="fas fa-dollar-sign"></i>
                                <input type="number" id="ticket-price" name="ticket-price" step="0.01">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start mt-4">
                            <div class="w-[20%]">
                                <input type="hidden" name="action" value="new_flight">
                                <button type="submit" class="py-3 w-[90%] bg-[#76ABAE] rounded-xl flex items-center justify-center hover:opacity-85 ease-in duration-100">
                                    <span class="font-semibold text-[#fff]">Agregar</span>
                                </button>
                            </div>
                            <?php
                                if(isset($msg) && isset($infoType)) {
                                    $div = $infoType == 'success' ? 'w-[80%] border border-green-400 bg-green-200 rounded-xl flex items-center gap-2 px-4' : 'w-[80%] border border-red-400 bg-red-200 rounded-xl flex items-center gap-2 px-4';
                                    $icon = $infoType == 'success' ? 'fa-solid fa-circle-check text-green-400' : 'fa-solid fa-circle-exclamation text-red-400';

                                    echo <<<ALERT
                                        <div class="$div">
                                        <i class="$icon"></i>
                                        <span class="text-[#31363F]">$msg</span>
                                    ALERT;
                                } else {
                                    // Si no hay alerta definida, mostrar un div vacío para evitar errores de renderizado HTML
                                    echo '<div></div>';
                                }
                            ?>
                        </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        // Capturar el evento de cambio en el select
        document.getElementById('schedule').addEventListener('change', function() {
            // Obtener el valor seleccionado del select
            var selectedOption = this.value;

            // Buscar el elemento correspondiente en el array asociativo
            var selectedSchedule = <?= json_encode($schedules) ?>.find(schedule => schedule.id_horario == selectedOption);

            // Llenar los inputs deshabilitados con los valores correspondientes
            document.getElementById('departure-date').value = selectedSchedule.hora_salida.split(' ')[0];
            document.getElementById('departure-time').value = selectedSchedule.hora_salida.split(' ')[1].slice(0, 5);
            document.getElementById('arrival-date').value = selectedSchedule.hora_llegada.split(' ')[0];
            document.getElementById('arrival-time').value = selectedSchedule.hora_llegada.split(' ')[1].slice(0, 5);
            document.getElementById('origin').value = selectedSchedule.origen;
            document.getElementById('destination').value = selectedSchedule.destino;
        });
    </script>
</body>

</html>