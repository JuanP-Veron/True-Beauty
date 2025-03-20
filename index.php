<?php
include "incluides/header.php";
?>
<header id="header" class="header">
<?php
include "php/menu.php";
include "modelo/connect.php";
?>
        
        <div class="header-content container">
            <div class="header-txt">
                <h1>Descubre tu mejor versión</h1>
                <p>¡Bienvenidos a tu refugio de belleza exclusivo! Nos especializamos en realzar tu belleza natural con servicios personalizados de maquillaje, peinados y uñas, pensados para mujeres que desean sentirse únicas, radiantes y confiadas</p>
                <a class="btn-1" href="php/appointment.php">Reserva tu cita</a>
            </div>
            <div class="header-img">
                <img src="assets/img/foto2.webp" alt="">
            </div>
        </div>
        
    </header>
    <section id="about" class="about container">
        <div class="about-img">
            <img src="assets/img/salon.jpeg" alt="">
        </div>
        <div class="about-txt">
            <h2>Nosotros</h2>
            <p>Somos una Sociedad Anónima ubicada en Luque, especializados en belleza integral para mujeres y hombres. Ofrecemos una variedad de servicios personalizados, desde cortes y peinados hasta maquillaje y tratamientos de bienestar, utilizando técnicas modernas y productos de alta calidad.</p>
            <br>
            <p>Nos comprometemos a brindar una experiencia única, garantizando el más alto nivel de calidad, higiene y seguridad. En True-Beauty, te ayudamos a realzar tu belleza natural y a sentirte increíble en cada ocasión.</p>
        </div>
    </section>
    
        <main id="servicios" class="servicios">
            <h2>servicios</h2>
            <div class="servicios-content container">
                <div class="servicio-1">
                    <i class="fa-solid fa-scissors"></i>
                    <h3>Maquillaje Profesional</h3>
                </div>
    
                <div class="servicio-1">
                    <i class="fa-solid fa-eye"></i>
                    <h3>Cuidados faciales</h3>
                </div>
    
                <div class="servicio-1">
                    <i class="fa-solid fa-spa"></i>
                    <h3>Peluqueria</h3>
                </div>
            </div>
        </main>

<!-- PRICING SECTION  -->

<section class="pricing_section" >

    <!-- START GET CATEGORIES  PRICES FROM DATABASE -->

    <?php

    $stmt = $con->prepare("Select * from service_categories");
    $stmt->execute();
    $categories = $stmt->fetchAll();

    ?>

    <!-- END -->

    <div class="container">
        <div class="section_heading">
            <h3>Somos tu mejor opción</h3>
            <h2>Nuestros Precios</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            <?php

            foreach ($categories as $category) {
                $stmt = $con->prepare("Select * from services where category_id = ?");
                $stmt->execute(array($category['category_id']));
                $totalServices =  $stmt->rowCount();
                $services = $stmt->fetchAll();

                if ($totalServices > 0) {
            ?>

                    <div class="col-lg-4 col-md-6 sm-padding">
                        <div class="price_wrap">
                            <h3><?php echo $category['category_name'] ?></h3>
                            <ul class="price_list">
                                <?php

                                foreach ($services as $service) {
                                ?>

                                    <li>
                                        <h4><?php echo $service['service_name'] ?></h4>
                                        <p><?php echo $service['service_description'] ?></p>
                                        <span class="price">$<?php echo $service['service_price'] ?></span>
                                    </li>

                                <?php
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

            <?php
                }
            }
            
            ?>

</div>
</div>
<a class="reserva" href="php/appointment.php" >Reserva tu Cita</a>
</section>


    <?php
    include "incluides/footer.php";
    ?>
</body>
</html>