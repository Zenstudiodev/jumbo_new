<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 11/06/2020
 * Time: 2:23 PM
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

                    <?php //print_contenido($categorias->result()); ?>
                    <?php if ($categorias) { ?>
                        <div class="row">
                            <?php
                            foreach ($categorias->result() as $categoria) { ?>
                                <div class="col-12 col-md-4 product_col_categorias">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="card-title"><?php echo  $categoria->producto_categoria;?></h5>
                                            <a href="<?php echo base_url().'index.php/productos/categoria/'.$linea_actual.'/'. $categoria->producto_categoria;?>" class="btn btn-primary">Ver productos</a>
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
