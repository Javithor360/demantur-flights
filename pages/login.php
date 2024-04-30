<html lang="en">

<?php 
    $title = "Inicio Sesion - Demantur Flights";
    $arg = "<link rel='stylesheet' href='./assets/css/login.css'>";
    include_once("./components/headContent.php"); 
?>
<body>
  <div class="main_container">
    <?php include_once("./components/navbar.php") ?>
    <div class="content_container">
      <div class="container-login" id="container">
          <div class="form-container sign-up">
              <form>
                  <h1 class="title-login">Crear una cuenta</h1>
                  <span class="mb-10">Utiliza tu Email para crear tu cuenta con nosotros</span>
                  <input type="text" placeholder="Nombres">
                  <input type="text" placeholder="Apellidos">
                  <input type="text" placeholder="DUI (12345678-9)">
                  <input type="email" placeholder="Correo">
                  <input type="password" placeholder="Contraseña">
                  <button>Registrarse</button>
              </form>
          </div>
          <div class="form-container sign-in">
              <form>
                  <h1 class="title-login">Iniciar Sesión</h1>
                  <span class="mb-10">Utiliza tus credenciales creadas previamente</span>
                  <input type="email" placeholder="Correo">
                  <input type="password" placeholder="Contraseña">
                  <button>Iniciar Sesión</button>
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