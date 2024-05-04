<html lang="en">

<?php 
    $title = "Inicio Sesion - Demantur Flights";
    $arg = "<link rel='stylesheet' href='./assets/css/login.css'>";
    include_once("./components/headContent.php");

    $error = null;
    $form_type = null;
    $success = null;

    if (isset($_GET['success'])) {
        $success = $_GET['success'];
    }

    if (isset($_GET['form'])) {
        $form_type = $_GET['form'];
    }

    if (isset($_GET['error'])) {
        $error_code = $_GET['error'];

        // Mensajes de error según el tipo de error
        $error_messages = [
            "empty_files" => "Por favor, completa todos los campos.",
            "dui" => "Dui existente, pruebe con otro.",
            "login" => "Las credenciales no existen."
        ];

        // Asignar el mensaje de error correspondiente si está definido
        if (isset($error_messages[$error_code])) {
            $error = $error_messages[$error_code];
        }
    }

    function show_error($msg)
    {
        echo "<span class='text-red-400 font-bold'>$msg</span>";
    }
?>
<body>
  <div class="main_container">
    <?php include_once("./components/navbar.php") ?>
    <div class="content_container">
      <div class="container-login <?php echo ($form_type == 'register') ? 'active' : ''?>" id="container">
          <div class="form-container sign-up">
              <form action="../controllers/auth.controller.php" method="POST">
                  <h1 class="title-login">Crear una cuenta</h1>
                  <span class="mb-10">Utiliza tu Email para crear tu cuenta con nosotros</span>
                  <input type="text" id="names" name="names" placeholder="Nombres">
                  <input type="text" id="last_names" name="last_names" placeholder="Apellidos">
                  <input type="text" id="dui" name="dui" placeholder="DUI (12345678-9)">
                  <input type="email" id="email" name="email" placeholder="Correo">
                  <input type="password" id="password" name="password" placeholder="Contraseña">
                  <input type="hidden" name="action" value="register" />
                  <button>Registrarse</button>
                  <?php
                    if ($error) {
                        show_error($error);
                    }
                    if ($success == 'register') {
                        echo "<span class='text-green-400 font-bold'>Registro completado satisfactoriamente</span>";
                    }
                  ?>
              </form>
          </div>
          <div class="form-container sign-in">
              <form method="POST" action="../controllers/auth.controller.php">
                  <h1 class="title-login">Iniciar Sesión</h1>
                  <span class="mb-10">Utiliza tus credenciales creadas previamente</span>
                  <input type="email" id="email" name="email" placeholder="Correo">
                  <input type="password" id="password" name="password" placeholder="Contraseña">
                  <input type="hidden" name="action" value="login" />
                  <button>Iniciar Sesión</button>
                  <?php
                      if ($error) {
                          show_error($error);
                      }
                  ?>
              </form>
          </div>
          <div class="toggle-container">
              <div class="toggle">
                  <div class="toggle-panel toggle-left">
                      <h1 class="title-login">¡Bienvenido de Nuevo!</h1>
                      <p>Tu lugar seguro para concretar ese viaje que tanto deseas.&nbsp;Ingresa tus datos para empezar.</p>
                      <button class="hidden-button" id="login">Iniciar Sesión</button>
                  </div>
                  <div class="toggle-panel toggle-right">
                      <h1 class="title-login">¿Qué tal Amigo?</h1>
                      <p>Ahora que estas de regreso puedes ingresar tus datos para&nbsp;volver a tus asuntos</p>
                      <button class="hidden-button" id="register">Registrarse</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  <script src="./assets/js/login_script.js"></script>
</body>
</html>