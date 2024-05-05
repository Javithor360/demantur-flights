<?php
    $focus = "Vuelo";
    $title = "Agregar vuelos";
    $description = "Texto de ejemplo";
    $type = "Creación de Vuelos";
    $arg = "<link rel='stylesheet' href='./assets/css/admin.css'>";
?>

<!DOCTYPE html>
<html lang="es">
    
<?php include_once("./components/adminHead.php"); ?>

<body>
    <main class="flex">
        <?php include_once("./components/sidebar.php") ?>
        <section class="w-full flex">
            <div class="container mt-12">
                <?php require_once("./components/pageHeader.php") ?>
                <form id="flight-form">
                    <h1 class="form-title">Agregar Vuelo</h1>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="flight-date">Fecha del vuelo</label>
                            <div class="input-group">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="date" id="flight-date" required pattern="\d{4}-\d{2}-\d{2}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="departure-time">Hora de salida</label>
                            <div class="input-group">
                                <i class="fas fa-plane-departure"></i>
                                <input type="time" id="departure-time" required pattern="^([01]\d|2[0-3]):([0-5]\d)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrival-time">Hora de llegada estimada</label>
                            <div class="input-group">
                                <i class="fas fa-plane-arrival"></i>
                                <input type="time" id="arrival-time" required pattern="^([01]\d|2[0-3]):([0-5]\d)$">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="origin">Origen</label>
                            <div class="input-group">
                                <i class="fas fa-plane-departure"></i>
                                <input type="text" id="origin" required pattern="^[a-zA-Z\s]+$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="destination">Destino</label>
                            <div class="input-group">
                                <i class="fas fa-plane-arrival"></i>
                                <input type="text" id="destination" required pattern="^[a-zA-Z\s]+$">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="plane-type">Tipo de avión</label>
                            <div class="input-group">
                                <i class="fas fa-plane"></i>
                                <select id="plane-type" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="grande">Grande</option>
                                    <option value="mediano">Mediano</option>
                                    <option value="pequeño">Pequeño</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ticket-price">Precio del boleto</label>
                            <div class="input-group">
                                <i class="fas fa-dollar-sign"></i>
                                <input type="number" id="ticket-price" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="airline">Aerolínea</label>
                            <div class="input-group">
                                <i class="fas fa-plane"></i>
                                <select id="airline" required>
                                    <option value="" disabled selected>Seleccione una aerolínea</option>
                                    <option value="Avianca El Salvador">Avianca El Salvador</option>
                                    <option value="Volaris El Salvador">Volaris El Salvador</option>
                                    <option value="Copa Airlines">Copa Airlines</option>
                                    <option value="TACA Airlines">TACA Airlines</option>
                                    <option value="Spirit Airlines">Spirit Airlines</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit">Agregar Vuelo</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>