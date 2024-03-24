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
    </main>

</body>

</html>