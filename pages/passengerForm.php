<html lang="es">
<?php 
    $title = "Pasajeros";
    $arg = "<link rel='stylesheet' href='./assets/css/passengerForm.css'>";
    include_once("./components/headContent.php"); 
?>
<body>
    <?php include_once("./components/navbar.php") ?>
    <main class="mainContainer min-h-[85vh]">
        <p class="psgTitle marginL">Ingresa la información de los pasajeros</p>
        <div class="splitMsgContainer marginL">
            <i class="fa-solid fa-pen-clip lightIcon"></i>
            <div class="subdivision"></div>
            <p class="simpleText">Es de vital importancia que proporciones los datos correctos según los documentos de identidad correspondientes de cada pasajero</p>
        </div>

        <?php
        if(isset($_GET['cantidad_personas'])) {
            $cantidad_personas = intval($_GET['cantidad_personas']);
            for($i = 1; $i <= $cantidad_personas; $i++) {
                echo "
                <form id='passengerForm_$i' action='seatsSelection.php' onsubmit='return validateForm()' class='formMargin'>
                    <div class='inputCard shadow-xl'>
                        <p class='inputCardTitle'>Pasajero $i:</p>
                        <hr class='hrStyleOne'>
                        <div class='inputsContainer'>
                            <div class='custom_input'>
                                <i class='fa-regular fa-user input_icon'></i>
                                <input id='names_$i' class='inputPassengers' type='text' placeholder='Nombres'>
                                <span class='error_span'></span>
                            </div>
                            <div class='custom_input'>
                                <i class='fa-regular fa-user input_icon'></i>
                                <input id='lastsNames_$i' class='inputPassengers' type='text' placeholder='Apellidos'>
                                <span class='error_span'></span>
                            </div>
                        </div>
                        <div class='custom_input'>
                            <i class='fa-regular fa-id-card input_icon'></i>
                            <input id='passengerDocument_$i' class='inputPassengers' type='text' placeholder='Documento de identidad (DNI) o Pasaporte'>
                            <span class='error_span'></span>
                        </div>
                    </div>
                </form>
                ";
            }
        } else {
            echo "<p class='psgTitle marginL'>Error: No se recibió la cantidad de personas.</p>";
        }
        ?>

        <div class="btnContainer">
            <button class="continueBtn">Continuar</button>
        </div>
    </main>
    <?php include_once("./components/footer.php") ?>
    <script>
        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll('.inputPassengers');

            inputs.forEach(function(inputContent) {
                let regex;
                let errorMessage;
                let errorSpan = inputContent.nextElementSibling;

                if (inputContent.id.startsWith('names')) {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un nombre válido";
                } else if (inputContent.id.startsWith('lastsNames')) {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un apellido válido";
                } else if (inputContent.id.startsWith('passengerDocument')) {
                    regex = /^[0-9a-zA-Z]+$/;
                    errorMessage = "Ingrese un documento válido";
                }

                if (!regex.test(inputContent.value)) {
                    inputContent.classList.add("invalid");
                    errorSpan.innerText = errorMessage;
                    isValid = false;
                } else {
                    inputContent.classList.remove("invalid");
                    errorSpan.innerText = "";
                }
            });

            return isValid;
        }
    </script>
</body>
</html>