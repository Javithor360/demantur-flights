<?php 
    $title = "Inicio";
    $dipath = "./pages/";

    if (isset($_SESSION['reservation'])){
        unset($_SESSION['reservation']);
    }
     // Limpiando la variable de sesión de la reservación
?>

<html lang="en">

<?php include_once("./pages/components/headContent.php"); ?>

<body>
    <?php include_once("./pages/components/navbar.php") ?>

    <main class="main-container">
        <section class="hero">
            <div class="hero-cont">
                <h1>Buscar vuelo</h1>
                <?php include_once("./pages/components/search.php") ?>
            </div>
        </section>
       

        <section class="main-deal">
            <div class="main-deal-cont">
                <div class="main-deal-img">
                    <img src="./pages/assets/img/offer_deal.jpeg" alt="Oferta principal">
                </div>
                <div class="main-deal-info">
                    <div class="top-info">
                        <h2>¡Disfruta de tus vacaciones deseadas!</h2>
                        <p>Vuela en verano de 2024</p>
                    </div>
                    <div class="bottom-info">
                        <div class="price-info">
                            <p>Trayectos desde</p>
                            <p class="price">USD 999</p>
                        </div>
                        <button class="button">Ver más</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="main-offers">
            <h2>Ofertas que no te puedes perder</h2>

            <div class="offer-cards-container">

                <a href="#">
                    <div class="offer-card">
                        <div class="offer-content">
                            <p class="offer-title">Tegucigalpa</p>
                            <div class="offer-desc">
                                <p class="offer-label">Precios desde</p>
                                <p class="offer-price">USD 1</p>
                            </div>
                        </div>
                        <img src="./pages/assets/img/tegucigalpa.webp" alt="Tegucigalpa">
                    </div>
                </a>

                <a href="#">
                    <div class="offer-card">
                        <div class="offer-content">
                            <p class="offer-title">San José</p>
                            <div class="offer-desc">
                                <p class="offer-label">Precios desde</p>
                                <p class="offer-price">USD 1</p>
                            </div>
                        </div>
                        <img src="./pages/assets/img/sanjose.webp" alt="San José">
                    </div>
                </a>

                <a href="#">
                    <div class="offer-card">
                        <div class="offer-content">
                            <p class="offer-title">Ciudad de Panamá</p>
                            <div class="offer-desc">
                                <p class="offer-label">Precios desde</p>
                                <p class="offer-price">USD 1</p>
                            </div>
                        </div>
                        <img src="./pages/assets/img/ciudaddepanama.jpg" alt="Ciudad de Panamá">
                    </div>
                </a>

            </div>
        </section>
    </main>

    <?php include_once("./pages/components/footer.php") ?>
</body>

</html>