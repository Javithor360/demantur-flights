<link rel="stylesheet" href="../src/css/search.css">
<form class="max-w-xxl mx-auto" action="Vuelos.php">
    <div class="relative flex">
        
        <select id="cantidad-personas" class="rounded-s-lg block w-32 px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300  focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500" required style="background-color: #31363F; color: white;">
            <option value="1">1 persona</option>
            <option value="2">2 personas</option>
            <option value="3">3 personas</option>
            <option value="4">4 personas</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>
        <div class="relative w-full flex">
            <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 border-s-gray-50 border-s-2 border border-gray-300  focus:border-gray-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" placeholder="Destino" required style="background-color: #31363F; color: white;"/>  
        </div>
        <div class="relative">
          
            <input type="date" id="fecha-rango" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 border-s-gray-50 border-s-2 border border-gray-300 focus:border-gray-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500" required style="background-color: #31363F; color: white;"/>
        </div>
        <div class="relative w-12 flex " >
            <button type="submit" class=" rounded-r-lg absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white border border-gray-700 hover:bg-gray-800 focus:outline-none dark:bg-gray-600 dark:hover:bg-gray-700" style="background-color: #222831; color: white;">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>