<html lang="en">

<?php 
    $title = "Inicio";
    require_once(__DIR__."/../components/headContent.php"); 
?>

<body>
    <?php include_once(__DIR__."/../components/navbar.php") ?>

    <main class="main-container">
        <section class="hero">
            <div class="hero-cont">
                <h1>Buscar vuelo</h1>
                <p>Aquí va el componente de búsqueda</p>
            </div>
        </section>

        <section class="main-deal">
            <div class="main-deal-cont">
                <div class="main-deal-img">
                    <img src="../src/img/offer_deal.jpeg" alt="Oferta principal">
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
                        <img src="../src/img/tegucigalpa.webp" alt="Tegucigalpa">
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
                        <img src="../src/img/sanjose.webp" alt="San José">
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
                        <img src="../src/img/ciudaddepanama.jpg" alt="Ciudad de Panamá">
                    </div>
                </a>

            </div>
        </section>
    </main>

    <?php include_once(__DIR__."/../components/footer.php") ?>
</body>

</html>