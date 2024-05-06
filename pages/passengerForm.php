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
        <?php
        if (isset($_GET['cantidad_personas'], $_GET['origen'], $_GET['destino'])) {
            $cantidad_personas = intval($_GET['cantidad_personas']);
            $origen = $_GET['origen'];
            $destino = $_GET['destino'];
            echo "<form action='seatsSelection.php' method='post' onsubmit='return validateForm()'>";
            echo "<input type='hidden' name='cantidad_personas' value='{$cantidad_personas}'>";
            echo "<input type='hidden' name='origen' value='{$origen}'>";
            echo "<input type='hidden' name='destino' value='{$destino}'>";
            for ($i = 1; $i <= $cantidad_personas; $i++) {
                echo "
                <div class='inputCard shadow-xl'>
                    <p class='inputCardTitle'>Pasajero $i:</p>
                    <hr class='hrStyleOne'>
                    <div class='inputsContainer'>
                        <div class='custom_input'>
                            <i class='fa-regular fa-user input_icon'></i>
                            <input name='names_$i' class='inputPassengers' type='text' placeholder='Nombres'>
                            <span class='error_span'></span>
                        </div>
                        <div class='custom_input'>
                            <i class='fa-regular fa-user input_icon'></i>
                            <input name='lastNames_$i' class='inputPassengers' type='text' placeholder='Apellidos'>
                            <span class='error_span'></span>
                        </div>
                        <div class='custom_input'>
                            <i class='fa-regular fa-id-card input_icon'></i>
                            <input name='document_$i' class='inputPassengers' type='text' placeholder='Documento de identidad (DNI) o Pasaporte'>
                            <span class='error_span'></span>
                        </div>
                    </div>
                </div>
                ";
            }
            echo "<button type='submit' class='continueBtn'>Continuar</button>";
            echo "</form>";
        } else {
            echo "<p>Error: No se recibió la cantidad de personas o los datos de vuelo.</p>";
        }
        ?>
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
    </script>
</body>
</html>
