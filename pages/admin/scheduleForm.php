<?php 
    $focus = "Horario";
    $title = "Añadir horarios";
    $description = "Defina los horarios del vuelo y detalles del origen y destino";
    $type = "Creación de Vuelo";
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
                    <form action="" class="w-[100%] 2xl:w-[90%] h-fit flex flex-col gap-[2rem] mb-12">
                        <div class="flex gap-[1rem] w-[80%]">
                            <div class="w-[50%]">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-plane-departure text-[1.3rem] text-[#76ABAE] "></i>
                                    <p class="text-[#31363F] font-semibold">Lugar de salida</p>
                                </div>
                                <select id="countries" class="bg-[#EEEEEE] border border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                    <option disabled selected>Seleccione una opción</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="FR">France</option>
                                    <option value="DE">Germany</option>
                                </select>
                            </div>
                            <div class="w-[50%]">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-plane-arrival text-[#76ABAE] "></i>
                                    <p class="text-[#31363F] font-semibold">Lugar de llegada</p>
                                </div>
                                <select id="countries" class="bg-[#EEEEEE] border border-[2px] border-transparent text-gray-900 text-sm rounded-lg focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none">
                                    <option disabled selected>Seleccione una opción</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="FR">France</option>
                                    <option value="DE">Germany</option>
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
                                <input type="date" class="bg-[#EEEEEE] border-transparent border border-[2px] text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" placeholder="Select date">
                            </div>
                            <div class="w-[50%]">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-calendar-day text-[#76ABAE] "></i>
                                    <p class="text-[#31363F] font-semibold">Fecha de llegada</p>
                                </div>
                                <input type="date" class="bg-[#EEEEEE] border-transparent border border-[2px] text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" placeholder="Select date">
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
                                <input type="time" id="time" class="bg-[#EEEEEE] border-transparent border border-[2px] text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" value="00:00" required />
                            </div>
                            <div class="w-[50%] relative">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fa-solid fa-clock text-[#76ABAE] "></i>
                                    <p class="text-[#31363F] font-semibold">Hora estimada de llegada</p>
                                </div>
                                <input type="time" id="time" class="bg-[#EEEEEE] border-transparent border border-[2px] text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-[#e0e0e0] focus:border-[#e0e0e0] focus:bg-[#fff] block w-full p-2.5 ease-in duration-100 outline-none" value="00:00" required />
                            </div>
                        </div>
                        <hr class="w-[80%]">
                        <div class="flex justify-start mt-4 w-[80%]">
                            <div class="w-[20%]">
                                <button type="submit" class="py-3 w-[90%] bg-[#76ABAE] rounded-xl flex items-center justify-center hover:opacity-85 ease-in duration-100">
                                    <span class="font-semibold text-[#fff]">Añadir</span>
                                </button>
                            </div>
                            <?php
                                $success = true;
                            ?>
                            <div class="<?php echo $success ? 'w-[80%] border border-green-400 bg-green-200 rounded-xl flex items-center gap-2 px-4' : 'w-[80%] border border-red-400 bg-red-200 rounded-xl flex items-center gap-2 px-4'; ?>">
                                <i class="<?php echo $success ? 'fa-solid fa-circle-check text-green-400' : 'fa-solid fa-circle-exclamation text-red-400'; ?>"></i>
                                <span class="text-[#31363F]"><?php echo $success ? 'Horario añadido exitosamente' : 'Error al añadir el horario'; ?></span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="w-[40%] bg-cover bg-[2rem] bg-no-repeat" style="background-image: url(../../src/img/world.png)"></div> -->
        </section>
    </main>
</body>
</html>