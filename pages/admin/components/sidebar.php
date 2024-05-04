<?php 
    // % Ruta de acceso a la carpeta de assets desde cualquier archivo
    isset($dipath) ? $dipath : $dipath = "./";

    $element_class = "flex items-center rounded-md p-3 transition ease-in-out duration-350 hover:bg-white hover:text-[#31363F]";
    $focus_element_class = "flex items-center rounded-md p-3 transition ease-in-out duration-350 bg-white text-[#31363F]";
?>

<aside class="">
    <nav class="sticky top-0 bg-[#31363F] text-white p-6 h-[100vh] min-w-[30vh] max-w-[30vh] text-lg flex flex-col justify-between">
        <div class="head flex flex-col items-center my-5">
            <img src="<?php echo $dipath . "../assets/img/pfp.jpg" ?>" alt="Foto" class="rounded-full w-36 h-36 mb-3">
            <img src="<?php echo $dipath . "../assets/img/logo_full_white.png" ?>" alt="Logo" class="">
        </div>
        <hr class="text-red-500 border-[#687180]" />
        <div class="elements mt-5 flex-grow">
            <ul class="">
                <li class="mb-5">
                    <a href="<?php echo $dipath . "index.php" ?>"
                        class="<?php echo $focus === "Inicio" ? $focus_element_class : $element_class ?>">
                        <i class="fas fa-home mr-2"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="mb-5">
                    <a href="<?php echo $dipath . "destinationsForm.php" ?>"
                        class="<?php echo $focus === "Destino" ? $focus_element_class : $element_class ?>">
                        <i class="fa-solid fa-map mr-2"></i>
                        <p>Agregar destino</p>
                    </a>
                </li>

                <li class="mb-5">
                    <a href="<?php echo $dipath . "scheduleForm.php" ?>"
                        class="<?php echo $focus === "Horario" ? $focus_element_class : $element_class ?>">
                        <i class="fa-solid fa-calendar-plus mr-2"></i>
                        <p>Crear nuevo horario</p>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="text-red-500 border-[#687180]" />
        <div class="footer mt-5">
            <div class="flex justify-between items-center text-base">
                <p class="max-w-28 truncate text-[#D1D1D1]">
                    <?php echo $_SESSION['user']['nombres'] ?>
                </p>
                <a href="<?php echo "../../controllers/auth.controller.php?action=logout" ?>">
                    <button type="button"
                        class="p-3 text-center font-bold text-white bg-red-500 hover:bg-red-600 rounded-lg">
                        Cerrar sesión
                    </button>
                </a>
            </div>
        </div>
    </nav>
</aside>