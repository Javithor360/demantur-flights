<html lang="en">
<head>
    <title>Vuelos</title>
    <link rel='stylesheet' href='./assets/css/vuelos.css'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <?php 
    include_once("./components/headContent.php"); 
    include_once("./components/navbar.php")
    ?>
    
</head>
<body>
    <div class="container mx-auto mt-10">
        <?php
        if (isset($_POST['cantidad_personas'])) {
            $cantidad_personas = $_POST['cantidad_personas'];
//            echo "<div class='text-lg mb-5'>Cantidad de personas seleccionadas: $cantidad_personas</div>";
        }

        if (isset($_POST['lugar']) && isset($_POST['fecha_salida'])) {
            $conexion = new mysqli('localhost', 'root', '12345', 'demantur_flights', 3306);
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $lugar = $_POST['lugar'];
            $fecha_salida = $_POST['fecha_salida'];
            $sql = "SELECT v.*, h.hora_salida, h.hora_llegada, a.nombre AS aerolinea_nombre, origen.lugar AS origen_lugar, destino.lugar AS destino_lugar
                    FROM vuelo v
                    INNER JOIN horario h ON v.id_horario = h.id_horario
                    INNER JOIN destino origen ON h.id_origen = origen.id_destino
                    INNER JOIN destino destino ON h.id_destino = destino.id_destino
                    INNER JOIN avion av ON v.id_avion = av.id_avion
                    INNER JOIN aerolinea a ON av.id_aerolinea = a.id_aerolinea
                    WHERE LOWER(destino.lugar) LIKE LOWER('%$lugar%') AND DATE(h.hora_salida) = '$fecha_salida'";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<p class='uppercase font-bold mx-10 mt-10'>Vuelos Disponibles</p>";
                echo "<main class='main-container h-full'>";
                echo "<section class='main-deal bg-white max-w-screen-lg grow mb-10 rounded-lg shadow-lg shadow-gray-500/40'>";

                while ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='flex-col'>";
                    echo "<div name='info_vuelo' class='flex justify-center items-center bg-gray-100 mt-20 dark:bg-gray-800 rounded-lg p-10 h-50 shadow-md mb-20'>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-plane-departure mr-2'></i>";
                    echo "<p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>Origen</p>";
                    echo "</div>";
                    echo "<p name='origen' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['origen_lugar']}</p>";
                    echo "</div>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-plane-arrival mr-2'></i>";
                    echo "<p name='destino' class='text-2xl text-gray-700 dark:text-gray-300'>Destino</p>";
                    echo "</div>";
                    echo "<p name='lu' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['destino_lugar']}</p>";
                    echo "</div>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-ticket mr-2'></i>";
                    echo "<p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>Aerolínea</p>";
                    echo "</div>";
                    echo "<p name='aerolinea' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['aerolinea_nombre']}</p>";
                    echo "</div>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-calendar-days mr-2'></i>";
                    echo "<p name='salida' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de salida</p>";
                    echo "</div>";
                    echo "<p name='fecha_salida' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['hora_salida']}</p>";
                    echo "</div>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-calendar-day mr-2'></i>";
                    echo "<p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Fecha y Hora de llegada</p>";
                    echo "</div>";
                    echo "<p name='fecha_llegada' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['hora_llegada']}</p>";
                    echo "</div>";
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div class='mr-8 flex items-center'>";
                    echo "<i style='color:#76ABAE;' class='fa-solid fa-dollar-sign mr-2'></i>";
                    echo "<p name='llegada' class='text-2xl text-gray-700 dark:text-gray-300'>Tarifa</p>";
                    echo "</div>";
                    echo "<div class='flex'>";
                    echo "<p name='tarifa' class='text-2xl text-gray-700 dark:text-gray-300'>{$fila['tarifa']} USD</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='PassengerForm.php?cantidad_personas=$cantidad_personas&origen={$fila['origen_lugar']}&destino={$fila['destino_lugar']}' class='bg-green-500 text-white items-center py-2 px-4 rounded transition duration-500 ease-in-out hover:bg-green-700 hover:text-white'>Comprar</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                echo "</section>";
                echo "</main>";
            } else {
                echo "<body class='h-full'>
                <main class='main-container h-full max-screen-h-lg  flex justify-center items-center'>
                    <Section class='main-deal max-h-screen-lg bg-white mb-10 rounded-lg shadow-lg shadow-gray-500/40 flex flex-col items-center'>
                        <img src='https://live.staticflickr.com/65535/53702588027_b50384a2f5_m.jpg' alt='Sin vuelos' class='w-60 h-50'>
                        <p class='uppercase font-bold text-4xl mx-10 mt-10 text-center'>Lo sentimos, no hay vuelos disponibles para el destino y fecha seleccionados.</p>
                        <a href='../index.php' class='bg-red-500 mb-10 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-10'>Volver</a>
                    </Section>
                </main>
            </body>";
            }

            $conexion->close();
        } else {
            echo "<p class='text-xl text-red-500'>Por favor, complete el formulario de búsqueda.</p>";
        }
        ?>
    </div>
    <?php include_once("./components/footer.php"); ?>
</body>