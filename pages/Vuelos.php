<html lang="en">
<?php include_once("./components/navbar.php") ?>
<?php 
    $title = "Vuelos";
    $arg="<link rel='stylesheet' href='./assets/css/vuelos.css'>";

    include_once("./components/headContent.php"); 
    if(isset($_POST['cantidad_personas'])) {
        // Obtener la cantidad de personas seleccionada
        $cantidad_personas = $_POST['cantidad_personas'];
    
        // Imprimir la cantidad de personas seleccionada
        echo "Cantidad de personas seleccionadas: $cantidad_personas";
    } else {
        // Si no se recibió la cantidad de personas, mostrar un mensaje de error o redirigir a la página principal, etc.
        echo "Error: No se recibió la cantidad de personas.";
    }
    if(isset($_POST['lugar']) && isset($_POST['fecha_salida'])) {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', 'root1', 'demantur_flights',3000);
    
        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
    
        // Obtener los valores del formulario
        $lugar = $_POST['lugar'];
        $fecha_salida = $_POST['fecha_salida'];
    
        // Consulta SQL para obtener los vuelos disponibles
        $sql = "SELECT v.*, h.hora_salida, h.hora_llegada, a.nombre AS aerolinea_nombre, 
        origen.lugar AS origen_lugar, destino.lugar AS destino_lugar
 FROM vuelo v
 INNER JOIN horario h ON v.id_horario = h.id_horario
 INNER JOIN destino origen ON h.id_origen = origen.id_destino
 INNER JOIN destino destino ON h.id_destino = destino.id_destino
 INNER JOIN avion av ON v.id_avion = av.id_avion
 INNER JOIN aerolinea a ON av.id_aerolinea = a.id_aerolinea
 WHERE destino.lugar = '$lugar' AND DATE(h.hora_salida) = '$fecha_salida'";
    
        $resultado = $conexion->query($sql);
    
        // Comprobar si se encontraron vuelos
        if ($resultado->num_rows > 0) {
            // Mostrar resultados de vuelos disponibles
            while ($fila = $resultado->fetch_assoc()) {
                // Mostrar la información del vuelo en el formato deseado
            echo "
            <body >
            <p class='uppercase font-bold	 mx-10 mt-10'>Vuelos Disponibles</p>
            <main class='main-container h-full'>
            <Section  class='main-deal bg-white max-w-screen-lg grow 	 mb-10 rounded-lg shadow-lg  shadow-gray-500/40'>
            <div class='flex-col '>
            <div name='info_vuelo' class='flex justify-center items-center bg-gray-100 mt-20 dark:bg-gray-800 rounded-lg p-10 h-50 shadow-md mb-20'>

            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-plane-departure mr-2'></i>
                    <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>Origen</p>
                </div>
                <p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['origen_lugar']}</p>
            </div>
        
            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-plane-arrival mr-2'></i>
                    <p name='destino' class='text-2xl text-gray-700 dark:text-gray-300'>Destino</p>
                </div>
                <p name='lu' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['destino_lugar']}</p>
            </div>
        
            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-ticket mr-2'></i>    
                    <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>Aerolínea</p>
                </div>
                <p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['aerolinea_nombre']}</p>
            </div>
        
            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-calendar-days mr-2'></i>
                    <p name='salida' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de salida</p>
                </div>
                <p name='fecha_salida' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['hora_salida']}</p>
            </div>
        
            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-calendar-day mr-2'></i>
                    <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de llegada</p>
                </div>
                <p name='fecha_llegada' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['hora_llegada']}</p>
            </div>
        
            <div class='flex flex-col items-center'>
                <div class='mr-8 flex items-center'>
                    <i style='color:#76ABAE;' class='fa-solid fa-dollar-sign mr-2'></i>
                    <p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Tarifa</p>
                </div>
                <div class='flex'>
                <p name='tarifa' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['tarifa']} USD</p>
                </div>
              

            </div>
        
            <div>
            <a href='PassengerForm.php?cantidad_personas=$cantidad_personas' class='bg-green-500 text-white items-center py-2 px-4 rounded transition duration-500 ease-in-out hover:bg-green-700 hover:text-white'>Comprar</a>
            </div>
        </div>
        
        </div>
        </div>
        </Section>
        </main>
        </body>
        ";
            }
        } else {
            // Si no se encontraron vuelos disponibles
            echo 
            
            "
            <body class='h-full'>
            <main class='main-container h-full max-screen-h-lg  flex justify-center items-center'>
                <Section class='main-deal max-h-screen-lg bg-white mb-10 rounded-lg shadow-lg shadow-gray-500/40 flex flex-col items-center'>
                    <img src='../pages/assets/img/2813165.png' alt='Sin vuelos' class='w-60 h-50'>
                    <p class='uppercase font-bold text-4xl mx-10 mt-10 text-center'>Lo sentimos, no hay vuelos disponibles para el destino y fecha seleccionados.</p>
                    <a href='../index.php' class='bg-red-500 mb-10 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-10'>Volver</a>
                </Section>
            </main>
        </body>
        

            ";
        }
    
        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        // Si no se han enviado los datos del formulario, muestra un mensaje de error
        echo "Por favor, complete el formulario de búsqueda.";
    }
?>

<?php include_once("./components/footer.php") ?>