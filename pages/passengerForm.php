<html lang="es">
<?php // Iniciar la sesión al principio del archivo
$title = "Pasajeros";
$arg = "<link rel='stylesheet' href='./assets/css/passengerForm.css'>";
include_once("./components/headContent.php");
?>

<body>
    <?php include_once("./components/navbar.php"); ?>

    <main class="mainContainer min-h-[85vh]">
        <p class="psgTitle marginL">Ingresa la información de los pasajeros</p>

        <div class="mt-4">
            <form action="../controllers/flight.controller.php" method="POST" onsubmit="return validateForm()">
                <div class="space-x-2">
                    <label for="pasajeros">N° pasajeros</label>
                    <select name="pasajeros" id="pasajeros" class="w-1/6 border-2 border-gray-300">
                        <option value="1">1 pasajero</option>
                        <option value="2">2 pasajeros</option>
                        <option value="3">3 pasajeros</option>
                        <option value="4">4 pasajeros</option>
                    </select>
                </div>
                
                <div id="pasajerosContainer"></div>
                <button type='submit' class='continueBtn'>Continuar</button>
                <input type="hidden" name="action" value="selected_passengers_info" />
            </form>
        </div>
    </main>

    <?php include_once("./components/footer.php"); ?>
    <script>
        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll('.inputPassengers');
            inputs.forEach(function(input) {
                let regex;
                let errorMessage;
                let errorSpan = input.nextElementSibling;
                if (input.name.startsWith('names')) {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un nombre válido";
                } else if (input.name.startsWith('lastNames')) {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un apellido válido";
                } else if (input.name.startsWith('document')) {
                    regex = /^[0-9a-zA-Z]+$/;
                    errorMessage = "Ingrese un documento válido";
                }
                if (!regex.test(input.value)) {
                    input.classList.add("invalid");
                    errorSpan.innerText = errorMessage;
                    isValid = false;
                } else {
                    input.classList.remove("invalid");
                    errorSpan.innerText = "";
                }
            });
            return isValid;
        }

        // Función para mostrar u ocultar los componentes inputCard
        function mostrarComponentes(numPasajeros) {
            var container = document.getElementById("pasajerosContainer");
            container.innerHTML = ""; // Limpiar el contenido anterior

            for (var i = 1; i <= numPasajeros; i++) {
                var div = document.createElement("div");
                div.classList.add("shadow-xl", "inputCard");
                div.innerHTML = `
                <p class='inputCardTitle'>Pasajero ${i}:</p>
                <hr class='hrStyleOne'>
                <div class='inputsContainer'>
                    <div class='custom_input'>
                        <i class='fa-regular fa-user input_icon'></i>
                        <input name='names_${i}' class='inputPassengers' type='text' placeholder='Nombres'>
                        <span class='error_span'></span>
                    </div>
                    <div class='custom_input'>
                        <i class='fa-regular fa-user input_icon'></i>
                        <input name='lastNames_${i}' class='inputPassengers' type='text' placeholder='Apellidos'>
                        <span class='error_span'></span>
                    </div>
                    <div class='custom_input'>
                        <i class='fa-regular fa-id-card input_icon'></i>
                        <input name='document_${i}' class='inputPassengers' type='text' placeholder='Documento de identidad (DNI) o Pasaporte'>
                        <span class='error_span'></span>
                    </div>
                </div>
            `;
                container.appendChild(div); // Agregar el componente al contenedor
            }
        }

        // Evento para detectar cambios en el select
        document.getElementById("pasajeros").addEventListener("change", function() {
            var numPasajeros = parseInt(this.value); // Obtener el número de pasajeros seleccionado
            mostrarComponentes(numPasajeros); // Mostrar los componentes inputCard correspondientes
        });

        // Mostrar los componentes inputCard según la selección inicial
        mostrarComponentes(parseInt(document.getElementById("pasajeros").value));
    </script>
</body>

</html>