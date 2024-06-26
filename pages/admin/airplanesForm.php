<?php 
    require_once("../../controllers/admin.controller.php");

    $focus = "Aviones";
    $title = "Añadir aviones";
    $description = "Defina los aviones para proceder con el control de los vuelos";
    $type = "Control de aviones";
    $arg = "<link rel='stylesheet' href='./assets/css/admin.css'>";
    $controller = new AdminController();
    $aerolineas = $controller->fetch_airlines();

    // Información de la alerta recibida como parámetro en la petición GET
    if (isset($_GET['info'])) {
        // Verificando el tipo de alerta
        $infoType = str_starts_with($_GET['info'], 'success') ? 'success' : 'error';
        // Extrayendo el mensaje de la alerta
        $msg = explode('-', $_GET['info'])[1];

        // Definición de mensajes según el tipo de alerta
        if($msg == 'empty_fields') {
            $msg = 'Por favor, rellene todos los campos';
        } else if($msg == 'new_airplane') {
            $msg = $infoType == 'success' ? 'Avión añadido exitosamente' : 'Ha ocurrido un error al añadir el avión';
        } else if ($msg == 'invalid_code') {
            $msg = 'Código de avión inválido: No debe exceder los 4 caracteres';
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
                <div class="w-[50%] pl-6 pt-8">
                    <?php require_once("./components/pageHeader.php") ?>
                    <form method="POST" action="../../controllers/admin.controller.php" class="w-[100%] 2xl:w-[90%] h-fit flex flex-col gap-[2rem]">
                        <div class="bg-[#EEEEEE] h-[3rem] w-full rounded-xl flex border-[2px] border-transparent focus-within:shadow-md focus-within:bg-white focus-within:border-[#e0e0e0] focus-within:border-[2px] hover:border-[2px] hover:border-[#e0e0e0] ease-in duration-100 overflow-hidden">
                            <div class="h-full pl-6 pr-4 flex items-center justify-center">
                                <i class="fa-solid fa-globe text-[1.3rem] text-[#707070]" ></i>
                            </div>
                            <div class="h-full w-[85%]">
                                <select id="aerolinea" name="aerolinea" class="bg-[#EEEEEE] border-[2px] border-transparent rounded-lg focus:ring-[#e0e0e0] focus:bg-[#fff] block w-full h-full ease-in duration-100 outline-none cursor-pointer text-[#707070] text-[1rem]">
                                    <option value="" disabled selected>Seleccione una aerolínea</option>
                                        <?php if (empty($aerolineas)) : ?>
                                            <option value="" disabled>No hay aerolíneas disponibles</option>
                                        <?php else : ?>
                                            <?php foreach ($aerolineas as $aerolinea) : ?>
                                                <option value="<?= $aerolinea['id_aerolinea'] ?>">
                                                    <?= $aerolinea['nombre'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="bg-[#EEEEEE] h-[3rem] w-full rounded-xl flex border-[2px] border-transparent focus-within:shadow-md focus-within:bg-white focus-within:border-[#e0e0e0] focus-within:border-[2px] hover:border-[2px] hover:border-[#e0e0e0] ease-in duration-100 overflow-hidden">
                            <div class="h-full pl-6 pr-4 flex items-center justify-center">
                                <i class="fa-solid fa-plane-up text-[1.3rem] text-[#707070]" ></i>
                            </div>
                            <div class="h-full w-[80%]">
                                <input
                                    type="text" 
                                    name="codigo" 
                                    placeholder="Ingresa el código del avión (p. ej. AV08)" 
                                    class="h-full w-full bg-transparent outline-none placeholder:text-[#707070] text-[#707070]"
                                />
                            </div>
                        </div>
                        <div class="flex justify-start mt-4">
                            <div class="w-[20%]">
                                <input type="hidden" name="action" value="new_airplane">
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
                                        </div>
                                    ALERT;
                                } else {
                                    // Si no hay alerta definida, mostrar un div vacío para evitar errores de renderizado HTML
                                    echo '<div></div>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <div class="w-[50%] bg-cover bg-no-repeat" style="background-image: url(../assets/img/world.png)"></div>
        </section>
    </main>
</body>
</html>