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

<?php $this->start('header_banner') ?>
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
<?php $this->stop() ?>

<?php $this->start('page_content') ?>



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

            <?php if ($productos_recomendados) { ?>
                <div class="row">
                    <?php
                    foreach ($productos_recomendados->result() as $producto) { ?>
                        <div class="col-12 col-md-2 product_col_categorias">
                            <div class="card">
                                <?php
                                //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                if (file_exists('/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg')) { ?>
                                    <div class="item">
                                        <img src="<?php  echo base_url().'upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg'; ?>"
                                             class="card-img-top img-fluid home_producto_recomendado" >
                                    </div>
                                <?php } else {?>
                                    <img src="<?php echo base_url()?>ui/public/imagenes/placeholder.png" class="card-img-top home_producto_recomendado" alt="..." >
                                <?php } ?>


                                <div class="card-body">
                                    <h5 class="card-title nombre_producto_listado_categoria"><?php echo strtolower($producto->producto_nombre); ?></h5>
                                    <p class="card-text">Código: <?php echo $producto->producto_codigo; ?></p>
                                    <a href="<?php echo base_url().'index.php/productos/ver_producto/'. $producto->producto_codigo; ?>" class="btn btn-primary">Ver producto</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <? } else { ?>
                <h3>No hay productos</h3>
            <? } ?>

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
            <div class="col-md-3 align-self-center">
                <div class="text-center">
                    <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_1.png" class="img-fluid">
                </div>

            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_2.png" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img src="<?php echo base_url() ?>/ui/public/imagenes/catalogo_3.png" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>




