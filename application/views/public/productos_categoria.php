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

<?php if(isset($keyword)){?>
    <meta name="robots"  content="noindex,nofollow"  />

    <meta name="keywords" content="<?php echo $keyword  ?>">
    <title>JUMBO - <?php echo $keyword  ?></title>
<?php }else{?>
    <meta name="robots"  content="index,follow"  />
    <meta name="keywords" content="<?php echo $linea.','.$categoria;  ?>">
    <title>JUMBO - <?php echo $linea.', '.$categoria;  ?></title>
<?php }?>


<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-2 side_col">

                <form action="<?php echo base_url()?>productos/buscar" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar" name="keyword"
                               aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <h3 class="titulo_lineas">Líneas</h3>
                <ul class="list-group">
                    <?php
                    if ($lineas_productos) {
                        foreach ($lineas_productos->result() as $linea) { ?>

                            <li class="list-group-item  align-items-center">

                                <?php $categorias = categorias_de_linea($linea->producto_linea);
                                if ($categorias) {
                                    ?>

                                    <div class="dropdown">
                                        <a class=" dropdown-toggle nombre_lineas_menu"
                                           href="<?php echo base_url() . 'index.php/productos/linea/' . $linea->producto_linea ?>"
                                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true"
                                           aria-expanded="false">
                                            <?php if (linea_tiene_icono($linea->producto_linea)) { ?>
                                                <img src="<?php echo get_icono_linea($linea->producto_linea); ?>" class="icono_lineas">
                                            <?php } else { ?>
                                            <?php } ?>
                                            <?php echo mb_strtolower($linea->producto_linea); ?>
                                        </a>

                                        <div class="dropdown-menu categorias_dropdown_container nombre_lineas_menu sumenu" aria-labelledby="dropdownMenuLink">
                                            <?php foreach ($categorias as $categoria) { ?>
                                                <a class="dropdown-item" href="<?php echo base_url().'index.php/productos/categoria/'.$linea->producto_linea.'/'. $categoria->producto_categoria;?>">
                                                    <?php echo mb_strtolower($categoria->producto_categoria); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <a href="<?php echo base_url() . 'index.php/productos/linea/' . $linea->producto_linea ?>">
                                        <?php echo $linea->producto_linea; ?>
                                    </a>
                                <?php } ?>


                                <!--<span class="badge badge-primary badge-pill">14</span>-->
                            </li>
                        <?php }
                    }
                    ?>

                </ul>
                <hr>
                <?php if($catalogos_list){

                    //print_contenido($catalogos_list);
                    ?>

                    <ul class="list-group">
                        <?php foreach ($catalogos_list->result() as $catalogo) { ?>
                            <li class="list-group-item  align-items-center">
                                <a href="<?php echo $catalogo->link;?>" class="nombre_lineas_menu" target="_blank"><?php echo $catalogo->titulo;?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>


                <!--<h3>Precio</h3>
                <input type="range" class="custom-range" id="customRange1">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Filtrar</button>-->

                <hr>
            </div>
            <div class="col-12 col-md-12 col-xl-10">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>

                    <?php //print_contenido($productos->result()); ?>
                    <?php if ($productos_categoria) { ?>
                        <div class="row" id="productos_list_container">
                            <?php
                            foreach ($productos_categoria->result() as $producto) { ?>
                                <div class="col-12 col-md-4 product_col_categorias">
                                    <div class="card">
                                        <h2 id="titulo_producto_list">
                                            <?php echo mb_strtolower($producto->producto_nombre); ?>
                                        </h2>

                                        <?php
                                        //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                        if (file_exists('/home4/ajumbo/public_html/upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg')) { ?>
                                            <div class="item">
                                                <img src="<?php echo base_url() . 'upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg'; ?>"
                                                     class=" card-img-top img_lista_categoria">
                                            </div>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>ui/public/imagenes/placeholder.png"
                                                 class="card-img-top img_lista_categoria " alt="...">
                                        <?php } ?>


                                        <div class="card-body">
                                            <!--<p class="card-text cat_codigo_producto">Código: <?php /*echo $producto->producto_codigo; */?></p>-->
                                            <!--<a href="<?php /*echo base_url() . 'index.php/productos/ver_producto/' . $producto->producto_codigo; */?>" class="btn btn-primary product_list_btn">Cotizar</a>-->
                                            <a href="<?php echo base_url() . 'index.php/productos/ver_producto/' . $producto->producto_codigo; ?>" class="btn btn-primary product_list_btn">Código: <?php echo $producto->producto_codigo; ?></a>
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

