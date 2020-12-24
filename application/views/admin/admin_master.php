<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 27/08/2020
 * Time: 16:40
 */

$ci =& get_instance();


if ($ci->ion_auth->logged_in()) {
    //echo'logeado';
    $user_id = $ci->ion_auth->get_user_id();
    $user_data = $ci->User_model->get_user_by_id($user_id);
    $user_data = $user_data->row();
} else {
    // echo'no logeado';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#003d8e">
    <link rel="manifest" href="<?php echo base_url(); ?>manifest.webmanifest">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url() ?>/ui/public/css/main.css">
    <script src="https://kit.fontawesome.com/fd7d02f666.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,800;1,300&display=swap" rel="stylesheet">
    <?php echo $this->section('css_p') ?>
    <title>Jumbo</title>
</head>
<body>
<header>
    <div id="main-nav">
        <div class="container-fluid">

            <?php
            if ($ci->ion_auth->logged_in()) { ?>
                <div class="row">
                    <div class="col">
                        Bienvenido <?php echo $user_data->first_name; ?>

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-secondary  btn-sm" href="<?php echo base_url() ?>index.php/User/perfil">Perfil <i
                                        class="fas fa-sign-in-alt"></i></a>
                            <!--<a class="top_boton" href="<?php echo base_url() ?>User/perfil">Perfil <i
                                        class="fas fa-sign-in-alt"></i></a>-->
                            <?php
                            //print_contenido($user_data);
                            if($ci->ion_auth->in_group('administracion',$user_id)){?>
                                <a class="btn btn-secondary  btn-sm" href="<?php echo base_url() ?>index.php/Admin">Admin panel <i
                                            class="fas fa-sign-in-alt"></i></a>
                            <?php }else{ ?>

                            <?php } ?>


                            <?php //if ($ci->ion_auth->is_admin()) { ?>
                                <!--<a class="btn btn-secondary  btn-sm" href="<?php /*echo base_url() */?>Admin">Admin panel <i
                                            class="fas fa-sign-in-alt"></i></a>-->
                            <?php //} ?>
                        </div>
                    </div>





                </div>
                <hr>
            <?php } else { ?>
            <?php } ?>


            <div class="row align-items-center justify-content-between ">
                <div class="col-3 col-md-2 align-self-center order-1 order-sm-1">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png" class="img-fluid"
                             id="logo_main">
                    </a>
                </div>
                <div class="col-12 col-md-10 order-3 order-sm-2 align-self-center main_menu_col">
                    <nav class="navbar navbar-expand-md navbar-light ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul id="main_nav" class="navbar-nav nav nav-pills nav-fill arial_rounded ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo base_url() ?>">Inicio</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <?php echo $this->section('header_banner') ?>
    <!-- /.content-wrapper -->
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url() ?>index.php/admin/listado_pedidos">pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>index.php/admin/banners_header">Banners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>index.php/admin/productos_portada">Productos de portada</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>index.php/admin/iconos_lineas">Iconos lineas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>index.php/admin/catalogos">Catálogos</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <!-- Content Wrapper. Contains page content -->
            <?php echo $this->section('page_content') ?>
            <!-- /.content-wrapper -->
        </div>
    </div>

</div>



<footer>
    <div id="fondo_footer">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-12 col-md-2">
                    <p>
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo-blanco.png" class="img-fluid">
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <h3>Contacto</h3>
                    <p class="direccion">
                        8 avenida 17-17 Zona 1, Ciudad de Guatemala
                        <br>
                        PBX: (502)22148900
                    </p>

                    <p>
                        <a href="https://www.instagram.com/jumbo_guatemala/" target="_blank">
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/instagram.png">
                        </a>
                        <a href="https://www.facebook.com/JumboGuatemala/" target="_blank">
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/facebook_logo.png">
                        </a>
                        <a class="telefono_footer" role="button" aria-pressed="true" href="https://wa.me/50256921011"
                           target="_blank"> <img src="<?php echo base_url() ?>/ui/public/imagenes/whatsapp.png"> 56921011</a>
                    </p>
                </div>
                <div class="col-12 col-md-3">
                   <p>
                      <span id="suscribirse_t">Suscribete</span>
                       <br>
                       Para recibir información de<br>
                       productos nuevos
                    <br>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email, mantente actualizado"
                               aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" id="button-addon2">Registrar</button>
                        </div>
                    </div>
                    <h4 id="copy" class="gothic">© <?php echo date("Y"); ?> Jumbo derechos reservados</h4>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>


<?php echo $this->section('js_p') ?>
</body>
</html>
