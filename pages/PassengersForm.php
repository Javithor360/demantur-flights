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
        <form action="">
            <div class="inputCard shadow-xl">
                <p class="inputCardTitle">Pasajero 1:</p>
                <hr class="hrStyleOne">
                <div class="inputsContainer">
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input class="input" type="text" placeholder="Nombres" title="Por favor, ingrese un nombre válido (mínimo 3 letras)" required>
                    </div>
                    <div class="custom_input">
                        <i class="fa-regular fa-user input_icon"></i>
                        <input class="input" type="text" placeholder="Apellidos">
                    </div>
                </div>
                <div class="custom_input">
                    <i class="fa-regular fa-id-card input_icon"></i>
                    <input class="input" type="text" placeholder="Documento de identidad">
                </div>
            </div>
            <div class="btnContainer">
                <a class="continueBtn"> Continuar </a>
            </div>

        </form>
    </main>
    
</body>
</html>