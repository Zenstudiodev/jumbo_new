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
<meta name="robots"  content="index,follow"  />
<meta name="keywords" content="jumbo promocionales, articulos para cocina, accesorios para baño, articulos decorativos, regalos personalizados, accesorios para el hogar, adornos para casas, articulos para jardin,  hieleras guatemala, tazas personalizadas, adornos para el hogar, productos para el hogar por mayor, regalos navideños, juego de bebidas, tazas magicas, regalos para el hogar">
<meta name="description" content="Somos una Corporación con más de 40 años en el mercado, integrado por nuestras diferentes unidades de negocios, Jumbo Internacional, Almacén Jumbo, Jumbo Promocionales, Resalta Promo, Decofiestas y Éxito Impresiones; enfocados en generar negocios comerciales rentables para los diferentes segmentos del mercado nacional e internacional.">

<title>Jumbo</title>
<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <?php if($header_banners){ ?>
                <div id="main_banner">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $start_indicator = 0;
                            foreach ($header_banners->result() as $banner) { ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $start_indicator; ?>" class="<?php if ($start_indicator < 1) {
                                    echo 'active';
                                } ?>"></li>
                                <?php $start_indicator++ ?>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $start_banner = 0;
                            foreach ($header_banners->result() as $banner) { ?>
                                <div class="carousel-item <?php if ($start_banner < 1) {
                                    echo 'active';
                                } ?> ">
                                    <a href="<?php echo $banner->link_bh ?>" target="_blank"
                                       banner_id="<?php echo $banner->id_bh; ?>">
                                        <img src="<?php echo base_url() . 'ui/public/imagenes/banners/' . $banner->imagen_bh . '.jpg' ?>"
                                             class="d-block w-100">
                                    </a>
                                </div>

                                <?php $start_banner++ ?>


                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class=" add-button">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12 col_add_btn">
                            <p class="text-center">
                                <button class=" btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Para un fácil acceso agréganos como app</button>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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


               <!-- <h3>Precio</h3>
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
                    <?php if ($productos) { ?>
                        <div class="row" id="productos_list_container">
                            <?php
                            foreach ($productos->result() as $producto) { ?>
                                <div class="col-12 col-md-4 product_col_categorias">
                                    <div class="card">
                                        <h2 id="titulo_producto_list">
                                            <?php echo mb_strtolower($producto->producto_nombre); ?>
                                        </h2>

                                        <?php
                                        //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                        if (file_exists('/home4/ajumbo/public_html/upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg')) { ?>
                                            <div class="item">
                                                <a href="<?php echo base_url() . 'index.php/productos/ver_producto/' . $producto->producto_codigo; ?>" >
                                                <img src="<?php echo base_url() . 'upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg'; ?>"
                                                     class=" card-img-top img_lista_categoria">
                                                </a>
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

<script>
    let deferredPrompt;
    const addBtn = document.querySelector('.add-button');
    addBtn.style.display = 'none';

    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Update UI to notify the user they can add to home screen
        addBtn.style.display = 'block';

        addBtn.addEventListener('click', (e) => {
            // hide our user interface that shows our A2HS button
            addBtn.style.display = 'none';
            // Show the prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                } else {
                    console.log('User dismissed the A2HS prompt');
                }
                deferredPrompt = null;
            });
        });
    });
</script>
<?php $this->stop() ?>




