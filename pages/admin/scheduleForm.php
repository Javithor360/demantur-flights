<?php
require_once "../../controllers/admin.controller.php";

$focus = "Horario";
$title = "Añadir horarios";
$description = "Defina los horarios del vuelo y detalles del origen y destino";
$type = "Creación de Vuelo";
$arg = "<link rel='stylesheet' href='./assets/css/admin.css'>";

$controller = new AdminController();
$destinations = $controller->fetch_destinations();

if (isset($_GET['info'])) {
    $infoType = str_starts_with($_GET['info'], 'success') ? 'success' : 'error';
    $msg = explode('-', $_GET['info'])[1];

    if ($msg == 'empty_fields') {
        $msg = 'Por favor, rellene todos los campos';
    } else if ($msg == 'new_schedule') {
        $msg = $infoType == 'success' ? 'Horario añadido exitosamente' : 'Error al añadir el horario';
    } else if ($msg == 'invalid_dates') {
        $msg = 'La fecha de salida no puede ser mayor a la fecha de llegada';
    } else if ($msg == 'same_destinations') {
        $msg = 'El lugar de salida no puede ser igual al lugar de llegada';
    } else if ($msg == 'invalid_departure_date') {
        $msg = 'La fecha de salida no puede ser menor a la fecha actual';
    } else if ($msg == 'invalid_arrival_date') {
        $msg = 'La fecha de llegada no puede ser menor a la fecha actual';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once("./components/adminHead.php") ?>

<body>
    <main class="flex">
        <?php require_once("./components/sidebar.php") ?>
        <section class="w-full flex">
            <div class="w-[100%] pl-6 pt-8">
                <?php require_once("./components/pageHeader.php") ?>
                <form method="POST" action="../../controllers/admin.controller.php" class="w-[100%] 2xl:w-[90%] h-fit flex flex-col gap-[2rem] mb-12">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-plane-departure text-[1.3rem] text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Lugar de salida</p>
                            </div>
                            <select id="departure" name="lugar_salida" class="bg-[#EEEEEE] border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                <option disabled selected>Seleccione una opción</option>
                                <?php foreach ($destinations as $destination) { ?>
                                    <option value="<?php echo $destination['id_destino'] ?>"><?php echo $destination['lugar'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-plane-arrival text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Lugar de llegada</p>
                            </div>
                            <select id="arrival" name="lugar_llegada" class="bg-[#EEEEEE] border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                <option disabled selected>Seleccione una opción</option>
                                <?php foreach ($destinations as $destination) { ?>
                                    <option value="<?php echo $destination['id_destino'] ?>"><?php echo $destination['lugar'] ?></option>
                                <?php } ?>
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
                            <input type="date" name="fecha_salida" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" placeholder="Select date">
                        </div>
                        <div class="w-[50%]">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-calendar-day text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Fecha de llegada</p>
                            </div>
                            <input type="date" name="fecha_llegada" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" placeholder="Select date">
                        </div>
                    </div>
                    <hr class="w-[80%]">
                    <div class="flex gap-[1rem] w-[80%]">
                        <div class="w-[50%] relative">
                            <div class="w-[50%]">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-clock text-[#76ABAE] "></i>
                                    <p class="text-[#31363F] font-semibold">Hora de salida</p>
                                </div>
                            </div>
                            <input type="time" id="time" name="hora_salida" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" value="00:00" required />
                        </div>
                        <div class="w-[50%] relative">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-clock text-[#76ABAE] "></i>
                                <p class="text-[#31363F] font-semibold">Hora estimada de llegada</p>
                            </div>
                            <input type="time" id="time" name="hora_llegada" class="bg-[#EEEEEE] border-transparent border-[2px] text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" value="00:00" required />
                        </div>
                    </div>
                    <hr class="w-[80%]">
                    <div class="flex justify-start mt-4 w-[80%]">
                        <div class="w-[20%]">
                            <input type="hidden" name="action" value="new_schedule" />
                            <button type="submit" class="py-3 w-[90%] bg-[#76ABAE] rounded-xl flex items-center justify-center hover:opacity-85 ease-in duration-100">
                                <span class="font-semibold text-[#fff]">Añadir</span>
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
                                    </div>
                                ALERT;
                            } else {
                                echo '<div></div>';
                            }
                        ?>
                    </div>
                </form>
            </div>
            <!-- <div class="w-[40%] bg-cover bg-[2rem] bg-no-repeat" style="background-image: url(../../src/img/world.png)"></div> -->
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const departureSelect = document.getElementById('departure');
            const arrivalSelect = document.getElementById('arrival');

            // Manejar el evento change en el select de salida
            departureSelect.addEventListener('change', function() {
                // Habilitar todas las opciones en el select de llegada
                for (let option of arrivalSelect.options) {
                    option.disabled = false;
                }

                // Obtener el valor seleccionado en el select de salida
                const selectedDeparture = this.value;

                // Deshabilitar la opción seleccionada en el select de llegada
                for (let option of arrivalSelect.options) {
                    if (option.value === selectedDeparture) {
                        option.disabled = true;
                    }
                }
            });

            // Manejar el evento change en el select de llegada
            arrivalSelect.addEventListener('change', function() {
                // Habilitar todas las opciones en el select de salida
                for (let option of departureSelect.options) {
                    option.disabled = false;
                }

                // Obtener el valor seleccionado en el select de llegada
                const selectedArrival = this.value;

                // Deshabilitar la opción seleccionada en el select de salida
                for (let option of departureSelect.options) {
                    if (option.value === selectedArrival) {
                        option.disabled = true;
                    }
                }
            });
        });
    </script>
</body>

</html>