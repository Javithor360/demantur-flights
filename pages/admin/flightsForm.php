<?php
require_once "../../controllers/admin.controller.php";

$focus = "Vuelo";
$title = "Agregar vuelos";
$description = "Seleccione los datos necesarios para completar la información de un vuelo";
$type = "Vuelo";
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
            <div class="w-[100%] pl-6 pt-8">
                <?php require_once("./components/pageHeader.php") ?>
                <div class="w-[100%] 2xl:w-[90%]">
                    <?php
                        if(isset($msg) && isset($infoType)) {
                            $div = $infoType == 'success' ? 'w-[80%] h-11 mb-8 border border-green-400 bg-green-200 rounded-xl flex items-center gap-2 px-4' : 'w-[80%] h-11 mb-8 border border-red-400 bg-red-200 rounded-xl flex items-center gap-2 px-4';
                            $icon = $infoType == 'success' ? 'fa-solid fa-circle-check text-green-400' : 'fa-solid fa-circle-exclamation text-red-400 mt-0-5';

                            echo <<<ALERT
                                <div class="$div">
                                <i class="$icon"></i>
                                <span class="text-[#31363F]">$msg</span>
                                </div>
                            ALERT;
                        } else {
                            // Si no hay alerta definida, mostrar un div vacío para evitar errores de renderizado HTML
                            echo '<div></div>';
                        }
                    ?>
                </div>
                
                <form method="POST" action="../../controllers/admin.controller.php" class="w-[100%] 2xl:w-[90%] h-fit flex flex-col gap-[2rem] mb-12">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-earth-americas text-[1.3rem] text-[#76ABAE]"></i>
                                <p class="text-[#31363F] font-semibold">Horario del Vuelo</p>
                            </div>
                            <select id="schedule" name="schedule" class="bg-[#EEEEEE] border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                <option value="" disabled selected>Seleccione un horario</option>
                                <?php if (empty($schedules)) : ?>
                                    <option value="" disabled>No hay horarios disponibles</option>
                                <?php else : ?>
                                    <?php foreach ($schedules as $schedule) : ?>
                                        <option value="<?= $schedule['id_horario'] ?>">
                                            <?= $schedule['aeropuerto_origen'] ?> - <?= $schedule['aeropuerto_destino'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-plane text-[1.3rem] text-[#76ABAE]"></i>
                                <p class="text-[#31363F] font-semibold">Avión y aerolínea</p>
                            </div>
                            <select id="airplane" name="airplane" class="bg-[#EEEEEE] border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                            <option value="" disabled selected>Seleccione un avión</option>
                                <?php if (empty($airplanes)) : ?>
                                    <option value="" disabled>No hay aviones o aerolíneas disponibles</option>
                                <?php else : ?>
                                    <?php foreach ($airplanes as $airplane) : ?>
                                        <option value="<?= $airplane['id_avion'] ?>">
                                            <?= $airplane['codigo_avion'] ?> - <?= $airplane['aerolinea'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <hr class="w-[80%]">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-calendar-day text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Fecha de salida</p>
                            </div>
                            <input placeholder="Aquí se mostrará la fecha correspondiente al horario" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" id="departure-date" readonly>
                        </div>
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-clock text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Hora de salida</p>
                            </div>
                            <input placeholder="Aquí se mostrará la hora correspondiente al horario" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" id="departure-time" readonly>
                        </div>
                    </div>
                    <hr class="w-[80%]">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-calendar-day text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Fecha de llegada</p>
                            </div>
                            <input placeholder="Aquí se mostrará la fecha correspondiente al horario" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" id="arrival-date" readonly>
                        </div>
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-clock text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Hora de llegada</p>
                            </div>
                            <input placeholder="Aquí se mostrará la hora correspondiente al horario" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" id="arrival-time" readonly>
                        </div>
                    </div>
                    <hr class="w-[80%]">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[70%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-money-bill text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Precio del boleto</p>
                            </div>
                            <input placeholder="Ingrese el precio en dólares del boleto" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" type="number" id="ticket-price" name="ticket-price" step="0.01">
                        </div>
                        <div class="w-[30%] flex items-center justify-end">
                            <input type="hidden" name="action" value="new_flight">
                            <button type="submit" class="py-2.5 w-[90%] bg-[#76ABAE] rounded-xl flex items-center justify-center hover:opacity-85 ease-in duration-100 mt-8">
                                <span class="font-semibold text-[#fff]">Agregar</span>
                            </button>
                        </div>
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