<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:12 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>
<header>
    <div id="main-nav">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12 col-md-2">
                    <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png">
                </div>
                <div class="col">
                    <nav id="main_nav" class="gothic">
                        <ul>
                            <li><a href="#">Inicio</a></li>
                            <li><a href="#">Quienes somos</a></li>
                            <li><a href="#">Productos</a></li>
                            <li><a href="#">Contacto</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-2">
                    <a href="#">
                        login
                    </a>
                    <a href="#"><i class="fas fa-search"></i></a>
                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="main_banner">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?php echo base_url() ?>/ui/public/imagenes/banner1.jpg"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?php echo base_url() ?>/ui/public/imagenes/banner1.jpg"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?php echo base_url() ?>/ui/public/imagenes/banner1.jpg"
                                         class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</header>
<section id="productos_recomendados">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 id="productos_recomendados">Productos Recomendados <br>
                    <small class="text-muted">Estilos únicos para promocionar tu marca</small>
                </h2>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="<?php echo base_url() ?>/ui/public/imagenes/banner2.jpg" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<section id="catalogos_section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_1.png" class="img-fluid">
            </div>
            <div class="col-md-3">
                <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_2.png" class="img-fluid">
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_3.png" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<footer>
    <div id="fondo_footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo-blanco.png">
                    </p>
                    <p>
                        <a>
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a>
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </p>
                </div>
                <div class="col">
                    <h3>Contacto</h3>
                    <p>
                        8 avenida 17-17 Zona 1, Ciudad de Guatemala
                    </p>
                    <p>
                        PBX: (502)22148900
                    </p>
                </div>
                <div class="col">
                    Suscribete
                    <br>
                    Para recibir información de nuestros
                    productos nuevos
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center" id="copy_row">
            <div class="col">
                <h4 id="copy" class="gothic">© <?php echo date("Y"); ?> Corporación Jumbo. todos los derechos
                    reservados</h4>
            </div>
        </div>
    </div>
</footer>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>




