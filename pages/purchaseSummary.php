<html lang="es">
<?php 
    session_start();
    $title = "Información de la Reserva";
    $arg = "<link rel='stylesheet' href='./assets/css/purchaseSummary.css'>";
    include_once("./components/headContent.php");

    if(empty($_SESSION['reservation'])) { // Si no hay una reserva en la sesión, redirigir al index
        header("Location: ../index.php");
    }

    $reservation = $_SESSION['reservation'];
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
                    <p><?= $reservation['flight']['codigo'] ?></p>
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
                        <th>Aerolínea</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $reservation['flight']['codigo'] ?></td>
                        <td><?= $reservation['flight']['origen_lugar'] ?></td>
                        <td><?= $reservation['flight']['destino_lugar'] ?></td>
                        <td><?= $reservation['flight']['aerolinea_nombre'] ?></td>
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
                        <th>Número de asiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservation['tickets'] as $passenger) { ?>
                        <tr>
                            <td><?= $passenger['nombre_pasajero'] ?></td>
                            <td><?= $passenger['codigo_boleto'] ?></td>
                            <td><?= $passenger['nombre_asiento'] ?></td>
                        </tr>
                    <?php } ?>
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
                            <?php 
                                foreach($reservation['tickets'] as $passenger) {
                                    echo "<tr>
                                            <td>Viaje desde " . $reservation['flight']['origen_lugar'] . " hasta " . $reservation['flight']['destino_lugar'] . " <br>Asiento de pasajero - " . $passenger['nombre_pasajero'] . "</td>
                                            <td>$" . number_format($reservation['flight']['tarifa'], 2) . "</td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td><?= $reservation['flight']['tarifa'] * count($reservation['tickets']) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="summary-pay-info">
                    <p>Los elementos comprados no son reembolsables. </p>
                    <p>Están sujetos a cambios y disponibilidad.</p>
                    <span><p>¡Ten un excelente vuelo!</p></span>
                </div>
            </div>
        </section>

        <section class="summary-return">
            <a href="../index.php"><button class="return-button">Entendido</button></a>
        </section>
    </main>

    <?php include_once("./components/footer.php") ?>
</body>

</html>