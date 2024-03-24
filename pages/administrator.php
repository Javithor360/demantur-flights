<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vuelo</title>
    <link rel="stylesheet" href="../src/css/admin.css">
    <link rel="stylesheet" href="../src/css/global_index.css">
</head>
<body>
<?php include_once(__DIR__."/../components/navbar.php") ?>
    <div class="container">
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

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>