<?php include("template/header.php"); ?>

<section class="hero"
    style="background-image: url('img/safaebg.png'); background-size: 100% auto; background-position: center; object-fit: contain; height: 500px;">
    <br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="hero-content">
                    <h1 class="display-3 text-white">Bienvenido a MCompany</h1>
                    <p class="lead text-white">Descubra nuestra amplia gama de productos y haga un pedido hoy.</p>
                    <a class="btn btn-primary btn-lg" href="products.php" role="button">Ver Productos</a>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="features">
    <div class="container">
        <br />
        <div class="row">
            <div class="col-md-4">
                <div class="feature">
                    <img class="" src="img/shipping-icon.png" width="20" alt="Fast Shipping">
                    <h3>Envío Rápido</h3>
                    <p>Recibe tus productos en la puerta de tu hogar de manera rápida y eficiente.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <img class="" src="img/quality-icon.png" width="20" alt="High-Quality Products">
                    <h3>Productos de Alta Calidad</h3>
                    <p>Nuestros productos cumplen con los más altos estándares de calidad.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <img class="" src="img/support-icon.png" width="20" alt="24/7 Customer Support">
                    <h3>Soporte al Cliente 24/7</h3>
                    <p>Nuestro equipo de atención al cliente está disponible las 24 horas del día para ayudarte en lo
                        que necesites.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <blockquote>
                                <p>"Me encantan los productos que compré en MCompany. Son de excelente calidad y el
                                    servicio al cliente es excelente".</p>
                                <footer> - Juan Pérez</footer>
                            </blockquote>
                        </div>
                        <div class="carousel-item">
                            <blockquote>
                                <p>"MCompany ofrece una amplia gama de productos para elegir. Es mi tienda de confianza
                                    para todas mis necesidades".</p>
                                <footer> - María González</footer>
                            </blockquote>
                        </div>
                        <div class="carousel-item">
                            <blockquote>
                                <p>"Recomiendo ampliamente MCompany. El proceso de compra es sencillo y los productos
                                    siempre llegan a tiempo".</p>
                                <footer> - Carlos Rodríguez</footer>
                            </blockquote>
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonial-carousel" data-slide-to="1"></li>
                        <li data-target="#testimonial-carousel" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include("template/footer.php"); ?>