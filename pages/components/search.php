<link rel="stylesheet" href="../src/css/search.css" >
<form class="mx-auto max-w-xxl" action="./controllers/flight.controller.php" method="POST"  >
    <div class="flex items-center shadow-xl shadow-gray-500/40 ">
        <div class="relative">
            <i style="color:#222831;"  class="absolute inset-y-0 left-0 flex items-center pl-4 ml-1 mr-1 pointer-events-none fa-solid fa-location-dot"></i>
        </div>
        
        <input type="text" name="lugar" id="search-dropdown"  class="w-full h-20 py-3 pl-12 pr-3 text-xl text-gray-900 border border-gray-300 bg-gray-50 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" placeholder="Destino" required style="background-color: #EEEEEE; color: black;"/>
        
        <input type="date" name="fecha_salida" id="fecha" class="w-full h-20 p-3 text-xl text-gray-900 border border-gray-300 bg-gray-50 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" required style="background-color: #EEEEEE; color: black;" min="<?php echo date('Y-m-d'); ?>" />
        
        <input type="hidden" name="action" value="filter_flight">

        <input type="hidden" name="location" value="index">
        
        <button type="submit" class="h-20 p-3 text-xl font-medium text-white border border-gray-700 rounded-r-lg hover:bg-gray-800 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-700" style="background-color: #222831;">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span class="sr-only">Search</span>
        </button>
    </div>
</form>