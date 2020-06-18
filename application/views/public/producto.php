<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 11/06/2020
 * Time: 3:14 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
if ($producto) {
    $producto = $producto->row();
}

$ci =& get_instance();
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <?php if ($producto) { ?>
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a
                                        href="<?php echo base_url() . 'index.php/productos/linea/' . $producto->producto_linea ?>"><?php echo $producto->producto_linea; ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                        href="<?php echo base_url() . 'index.php/productos/categoria/' . $producto->producto_linea . '/' . $producto->producto_categoria ?>"><?php echo $producto->producto_categoria; ?></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        <?php } ?>
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
                <h3>Líneas</h3>
                <ul class="list-group">
                    <?php
                    if ($lineas_productos) {
                        foreach ($lineas_productos->result() as $linea) { ?>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo base_url() . 'index.php/productos/linea/' . $linea->producto_linea ?>">
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
                    <?php if ($producto) { ?>
                        <div class="row">
                            <div class="col">
                                <?php if (isset($mensaje)) { ?>
                                    <div class="alert alert-success alert-block"><a class="close" data-dismiss="alert"
                                                                                    href="#">×</a>
                                        <h4 class="alert-heading">Acción exitosa!</h4>
                                        <p>
                                            <?php echo $mensaje; ?> <a
                                                    href="<?php echo base_url() ?>index.php/carrito/ver"
                                                    class="btn btn-success">Ver carrito</a>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">

                                        <?php
                                        //echo '/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/'.$producto->producto_codigo.'.jpg';
                                        if (file_exists('/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg')) { ?>
                                            <div class="carousel-item active">
                                                <img src="<?php echo base_url() . 'upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '.jpg'; ?>"
                                                     class="d-block w-100"
                                                     alt="<?php echo $producto->producto_codigo; ?>">
                                            </div>

                                        <?php } else { ?>
                                            <div class="carousel-item active">
                                                <img src="<?php echo base_url() ?>ui/public/imagenes/placeholder.png"
                                                     class="d-block w-100"
                                                     alt="<?php echo $producto->producto_codigo; ?>">
                                            </div>
                                        <?php } ?>

                                        <?php
                                        $x = 2;
                                        while (file_exists('/home/corpjcgd/public_html/new/upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '_' . $x . '.jpg')) { ?>

                                            <div class="carousel-item ">
                                                <img src="<?php echo base_url() . 'upload/imagenes_productos/' . $producto->producto_codigo . '/' . $producto->producto_codigo . '_' . $x . '.jpg'; ?>"
                                                     class="d-block w-100"
                                                     alt="<?php echo $producto->producto_codigo; ?>">
                                            </div>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <p>
                                    Código: <span
                                            class="badge badge-secondary"><?php echo $producto->producto_codigo; ?></span>
                                </p>
                                <h2 class="nombre_producto"><?php echo $producto->producto_nombre; ?></h2>
                                <p class="precio">
                                    <span class="cantidad_precio">
                                        <span class="simbolo_precio">Q</span><?php echo $producto->producto_precio; ?>
                                    </span>
                                </p>
                                <p><?php echo $producto->producto_descripcion; ?></p>
                                <p>

                                    <?php
                                    if ($ci->ion_auth->logged_in()) { ?>

                                <div class="input-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="0"
                                           aria-label="Cantidad de productos" aria-describedby="agregar_al_carrito"
                                           id="cantidad_producto" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button" id="agregar_al_carrito">Agregar a
                                            carrito
                                        </button>
                                    </div>
                                </div>

                                <?php } else { ?>
                                    Para comprar debe iniciar sesión
                                    <br>
                                    <a class="btn btn-success" href="<?php echo base_url() ?>index.php/User/login">Ingresar <i
                                                class="fas fa-sign-in-alt"></i></a>
                                    <!--<a class="top_boton" href="<?php echo base_url() ?>User/registro">Registrarse <i
                                    class="fas fa-user-plus"></i></a>-->
                                <?php } ?>

                                </p>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Material:</span> <?php echo $producto->producto_material; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Marca:</span> <?php echo $producto->producto_marca; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Color:</span> <?php echo $producto->producto_color; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Medidas:</span> <?php echo $producto->producto_medidas; ?>
                                    </li>
                                    <li class="list-group-item"><span
                                                class="badge badge-secondary">Estilo:</span> <?php echo $producto->producto_estilo; ?>
                                    </li>
                                    <li class="list-group-item"><span class="badge badge-secondary">Técnica de inmpresión:</span> <?php echo $producto->producto_tecnica_de_impresion; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php //print_contenido($producto); ?>

                    <? } else { ?>
                        <h3>Producto no disponible</h3>
                    <? } ?>

                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<script>
    var codigo_producto;
    var cantidad_producto;

    $("#agregar_al_carrito").click(function () {

        var inpObj = document.getElementById("cantidad_producto");
        if (inpObj.checkValidity()) {
            console.log('valido');
            codigo_producto = '<?php echo $producto->producto_codigo;?>';
            cantidad_producto = $("#cantidad_producto").val();
            console.log('agregar ' + cantidad_producto + ' de producto ' + codigo_producto);

            window.location = "<?php echo base_url()?>index.php/carrito/agregar_producto/" + codigo_producto + "/" + cantidad_producto;
        } else {
            console.log('invalido');

        }


    });
</script>
<?php $this->stop() ?>
