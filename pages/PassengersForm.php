<html lang="es">
<?php 
    $title = "Pasajeros";
    $arg = "<link rel='stylesheet' href='../src/css/PassengersForm.css'>";
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
        <form action="SeatSelection.php">
            <div class="inputCard shadow-xl">
                <p class="inputCardTitle">Pasajero 1:</p>
                <hr class="hrStyleOne">
                <div class="inputsContainer">
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input class="input" type="text" placeholder="Nombres" pattern="[A-Za-záéíóúÁÉÍÓÚ\s]{3,}" title="Por favor, ingrese nombres válido (mínimo 3 letras)" required>
                    </div>
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input class="input" type="text" placeholder="Apellidos" pattern="[A-Za-záéíóúÁÉÍÓÚ\s]{3,}" title="Por favor, ingrese apellidos válido (mínimo 3 letras)" required>
                    </div>
                </div>
                <div class="custom_input">
                    <i class="fa-regular fa-id-card input_icon"></i>
                    <input class="input" type="text" placeholder="Documento de identidad (DNI) o Pasaporte" pattern="[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*" title="Debe contener letras, números o caracteres correctos y no puede terminar con guión" required>

                </div>
            </div>
            <div class="btnContainer">
                <button value="Continuar" class="continueBtn">Continuar</button>
            </div>

        </form>
    </main>
    
</body>
</html>