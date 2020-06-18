<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 12/06/2020
 * Time: 2:24 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <h3>Busqueda</h3>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar"
                           aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                    </div>
                </div>
                <h3>Categorías</h3>
                <ul class="list-group">
                    <?php
                    if ($lineas_productos) {
                        foreach ($lineas_productos->result() as $linea) { ?>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo base_url().'index.php/productos/linea/'.$linea->producto_linea?>">
                                    <?php echo $linea->producto_linea; ?>
                                </a>

                                <!--<span class="badge badge-primary badge-pill">14</span>-->
                            </li>
                        <?php }
                    }
                    ?>

                </ul>


                <h3>Precio</h3>
                <input type="range" class="custom-range" id="customRange1">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>

                <hr>
            </div>
            <div class="col-12 col-md-9">
                <div class="container">

                    <?php //print_contenido($productos->result()); ?>
                    <?php if ($productos_categoria) { ?>
                        <div class="row">
                            <?php
                            foreach ($productos_categoria->result() as $producto) { ?>
                                <div class="col-12 col-md-4 product_col_categorias">
                                    <div class="card">
                                        <?php
                                        //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                        if (file_exists('/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg')) { ?>
                                            <div class="item">
                                                <img src="<?php  echo base_url().'upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg'; ?>"
                                                     class="img-fluid" >
                                            </div>
                                        <?php } else {?>
                                            <img src="<?php echo base_url()?>ui/public/imagenes/placeholder.png" class="card-img-top " alt="..." >
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
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>

