<?php 
    $title = "Añadir destinos";
    $description = "Defina los destinos, tanto de salida o de llegada según disponibilidad";
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once("../components/headContent.php") ?>

<body>
<main class="flex">
        <?php require_once("./components/sidebar.php") ?>
        <section class="w-full flex">
                <div class="w-[60%] pl-6 pt-8">
                    <?php require_once("./components/pageHeader.php") ?>
                    <form action="" class="w-[100%] 2xl:w-[90%] h-fit flex flex-col gap-[2rem]">
                        <div class="bg-[#EEEEEE] h-[3rem] w-full rounded-xl flex border-[2px] border-transparent focus-within:shadow-md focus-within:bg-white focus-within:border-[#e0e0e0] focus-within:border-[2px] hover:border-[2px] hover:border-[#e0e0e0] ease-in duration-100 overflow-hidden">
                            <div class="h-full pl-6 pr-4 flex items-center justify-center">
                                <i class="fa-solid fa-globe text-[1.3rem] text-[#707070]" ></i>
                            </div>
                            <div class="h-full w-[80%]">
                                <input
                                type="text"
                                placeholder="Ingrese un lugar"
                                class="h-full w-full bg-transparent outline-none placeholder:text-[#707070] text-[#707070]"
                                />
                            </div>
                        </div>
                        <div class="bg-[#EEEEEE] h-[3rem] w-full rounded-xl flex border-[2px] border-transparent focus-within:shadow-md focus-within:bg-white focus-within:border-[#e0e0e0] focus-within:border-[2px] hover:border-[2px] hover:border-[#e0e0e0] ease-in duration-100 overflow-hidden">
                            <div class="h-full pl-6 pr-4 flex items-center justify-center">
                                <i class="fa-solid fa-plane-up text-[1.3rem] text-[#707070]" ></i>
                            </div>
                            <div class="h-full w-[80%]">
                                <input
                                type="text"
                                placeholder="Ingrese el aeropuerto del lugar"
                                class="h-full w-full bg-transparent outline-none placeholder:text-[#707070] text-[#707070]"
                                />
                            </div>
                        </div>
                        <div class="flex justify-start mt-4">
                            <div class="w-[20%]">
                                <button type="submit" class="py-3 w-[90%] bg-[#76ABAE] rounded-xl flex items-center justify-center hover:opacity-85 ease-in duration-100">
                                    <span class="font-semibold text-[#fff]">Agregar</span>
                                </button>
                            </div>
                            <!-- <?php
                                $success = true;
                            ?>
                            <div class="<?php echo $success ? 'w-[80%] border border-green-400 bg-green-200 rounded-xl flex items-center gap-2 px-4' : 'w-[80%] border border-red-400 bg-red-200 rounded-xl flex items-center gap-2 px-4'; ?>">
                                <i class="<?php echo $success ? 'fa-solid fa-circle-check text-green-400' : 'fa-solid fa-circle-exclamation text-red-400'; ?>"></i>
                                <span class="text-[#31363F]"><?php echo $success ? 'Lugar añadido exitosamente' : 'Error al añadir el lugar'; ?></span>
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="w-[40%] bg-cover bg-no-repeat" style="background-image: url(../assets/img/world.png)"></div>
                
        </section>
    </main>
</body>
</html>