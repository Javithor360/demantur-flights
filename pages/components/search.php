<link rel="stylesheet" href="../src/css/search.css" >
<form class="max-w-xxl  mx-auto" action="./pages/Vuelos.php" method="POST"  >
    <div class="flex items-center shadow-xl  shadow-gray-500/40	 ">
        <select id="cantidad_personas" class="rounded-l-lg px-4  h-20 py-2 text-xl text-gray-900 bg-gray-50 border border-gray-300 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500" required style="background-color: #EEEEEE; color: black;">
            <option value="1">1 persona</option>
            <option value="2">2 personas</option>
            <option value="3">3 personas</option>
            <option value="4">4 personas</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>

        <div class="relative">
        <i style="color:#222831;"  class="fa-solid fa-location-dot ml-1 mr-1   absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"></i>
        
        </div>
        
        <input type="search" name="lugar" id="search-dropdown"  class="pl-12 pr-3 py-3 w-full h-20 text-xl text-gray-900 bg-gray-50 border border-gray-300 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" placeholder="Destino" required style="background-color: #EEEEEE; color: black;"/>
        
        <input type="date" name="fecha_salida"  id="fecha" class="p-3 h-20 w-full text-xl text-gray-900 bg-gray-50 border border-gray-300 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" required style="background-color: #EEEEEE; color: black;" min="<?php echo date('Y-m-d'); ?>" />
        <input type="hidden" name="cantidad_personas" id="cantidad-personas-hidden">
        <button type="submit" class="rounded-r-lg p-3 h-20 text-xl font-medium text-white border border-gray-700 hover:bg-gray-800 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-700" style="background-color: #222831;">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>
</form>
<script>
    // Obtener el elemento select
    const selectCantidadPersonas = document.getElementById('cantidad_personas');
    // Obtener el campo oculto
    const hiddenCantidadPersonas = document.getElementById('cantidad-personas-hidden');

    // Función para actualizar el campo oculto con la cantidad de personas seleccionadas
    function actualizarCantidadPersonas() {
        hiddenCantidadPersonas.value = selectCantidadPersonas.value;
    }

    // Escuchar el evento change del select para actualizar el campo oculto
    selectCantidadPersonas.addEventListener('change', actualizarCantidadPersonas);

    // Llamar a la función una vez al cargar la página para establecer el valor inicial
    actualizarCantidadPersonas();
</script>