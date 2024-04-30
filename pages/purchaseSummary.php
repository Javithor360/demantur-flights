<html lang="es">
<?php 
    $title = "Información de la Reserva";
    $arg = "<link rel='stylesheet' href='./assets/css/purchaseSummary.css'>";
    include_once("./components/headContent.php"); 
?>

<body>
    <?php include_once("./components/navbar.php") ?>

    <main class="summary-main">
        <section class="summary-title">
            <h1>¡Todo listo!</h1>
            <div class="summary-title-img">
                <img src="./assets/img/logo_full_white.png" alt="Demantur Flights">
            </div>
        </section>

        <section class="summary-header">
            <div class="summary-head-container">
                <h2>Información de reservación</h2>
                <div class="summary-head-id">
                    <h3>Número de reserva:</h3>
                    <p>WXIKXI</p>
                </div>
            </div>
        </section>

        <section class="summary-flights">
            <table border="1">
                <thead>
                    <tr>
                        <th>Vuelo</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Avión</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>WK 2200</td>
                        <td>San Salvador, El Salvador</td>
                        <td>Ciudad de Panamá, Panamá</td>
                        <td>333</td>
                    </tr>
                    <tr>
                        <td>WK 2200</td>
                        <td>San Salvador, El Salvador</td>
                        <td>Ciudad de Panamá, Panamá</td>
                        <td>333</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="summary-passengers">
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre del pasajero</th>
                        <th>Código de ticket</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Daniel Ernesto Meléndez Serrano</td>
                        <td>123456</td>
                    </tr>
                    <tr>
                        <td>Alvin Josué Vásquez Ventura</td>
                        <td>789012</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="summary-payment">
            <div class="summary-pay-cont">
                <div class="summary-pay-receipt">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Detalle</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Vuel. WK2200 San Salvador - Ciudad de Panamá</td>
                                <td>$325.90</td>
                            </tr>
                            <tr>
                                <td>Vuel. WK2200 San Salvador - Ciudad de Panamá</td>
                                <td>$325.90</td>
                            </tr>
                            <tr>
                                <td>Servicios de aeropuerto</td>
                                <td>$65.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>$981.80</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="summary-pay-info">
                    <p>Los elementos comprados no son reembolsables. </p>
                    <p>Están sujetos a cambios y disponibilidad.</p>
                    <span><p>¡Ten un excelente vuelo!</p></span>
                    <p>Pago efectuado con la tarjeta terminada en 9999</p>
                </div>
            </div>
        </section>

        <section class="summary-return">
            <a href="./index.php"><button class="return-button">Entendido</button></a>
        </section>
    </main>

    <?php include_once("./components/footer.php") ?>
</body>

</html>