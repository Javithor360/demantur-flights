<html lang="es">
<?php 
    $title = "Pasajeros";
    $arg = "<link rel='stylesheet' href='../src/css/passengersForm.css'>";
    require_once(__DIR__."/../components/headContent.php"); 
?>
<body>
    <?php include_once(__DIR__."/../components/navbar.php") ?>
    <main class="mainContainer">
        <p class="psgTitle marginL">Ingresa la información de los pasajeros</p>
        <div class="splitMsgContainer marginL">
            <i class="fa-solid fa-pen-clip lightIcon"></i>
            <div class="subdivision"></div>
            <p class="simpleText">Es de vital importancia que proporciones los datos correctos según los documentos de identidad correspondientes de cada pasajero</p>
        </div>
        <form id="passengerForm" action="seatsSelection.php" onsubmit="return validateForm()">
            <div class="inputCard shadow-xl">
                <p class="inputCardTitle">Pasajero 1:</p>
                <hr class="hrStyleOne">
                <div class="inputsContainer">
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input id="names" class="inputPassengers" type="text" placeholder="Nombres">
                        <span class="error_span"></span>
                    </div>
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input id="lastsNames" class="inputPassengers" type="text" placeholder="Apellidos">
                        <span class="error_span"></span>
                    </div>
                </div>
                <div class="custom_input">
                    <i class="fa-regular fa-id-card input_icon"></i>
                    <input id="passengerDocument" class="inputPassengers" type="text" placeholder="Documento de identidad (DNI) o Pasaporte">
                    <span class="error_span"></span>
                </div>
            </div>
            <div class="btnContainer">
                <button class="continueBtn">Continuar</button>
            </div>
        </form>
    </main>
    <?php include_once(__DIR__."/../components/footer.php") ?>
    <script>
        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll('.inputPassengers');

            inputs.forEach(function(inputContent) {
                let regex;
                let errorMessage;
                let errorSpan = inputContent.nextElementSibling;

                if (inputContent.id === 'names') {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un nombre válido";
                } else if (inputContent.id === 'lastsNames') {
                    regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
                    errorMessage = "Ingrese un apellido válido";
                } else if (inputContent.id === 'passengerDocument') {
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