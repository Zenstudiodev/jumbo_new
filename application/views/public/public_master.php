<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 3:36 PM
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
        <div class="container">

            <?php
            if ($ci->ion_auth->logged_in()) { ?>
                <div class="row">

                    Bienvenido <?php echo $user_data->first_name; ?>
                    <!--<a class="top_boton" href="<?php echo base_url() ?>User/perfil">Perfil <i
                                        class="fas fa-sign-in-alt"></i></a>-->
                    <a class="btn btn-secondary  btn-sm" href="<?php echo base_url() ?>index.php/User/perfil">Perfil <i
                                class="fas fa-sign-in-alt"></i></a>
                    <?php
                    if ($ci->ion_auth->is_admin()) { ?>
                        <a class="btn btn-secondary  btn-sm" href="<?php echo base_url() ?>Admin">Admin panel <i
                                    class="fas fa-sign-in-alt"></i></a>
                    <?php } ?>
                </div>
                <hr>
            <?php } else { ?>

            <?php } ?>


            <div class="row align-items-end justify-content-center">
                <div class="col-3 col-md-1 align-self-center order-1 order-sm-1">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo.png" class="img-fluid"
                             id="logo_main">
                    </a>
                </div>
                <div class="col-12 col-md-7 order-3 order-sm-2 ">
                    <nav class="navbar navbar-expand-md navbar-light ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul id="main_nav" class="navbar-nav mr-auto gothic">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo base_url() ?>">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>index.php/empresa/quienes_somos">Quienes
                                        somos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>index.php/productos">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>index.php/empresa/contacto">Contacto</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-6 col-md-3 order-2 order-sm-3">
                    <?php
                    if ($ci->ion_auth->logged_in()) { ?>
                        <br>
                        <!--<a class="top_boton" href="<?php echo base_url() ?>User/perfil">Perfil <i
                                        class="fas fa-sign-in-alt"></i></a>-->
                        <a class="top_boton" href="<?php echo base_url() ?>index.php/auth/logout">Cerrar <i
                                    class="fas fa-sign-in-alt"></i></a>
                    <?php } else { ?>
                        <a class="top_boton" href="<?php echo base_url() ?>index.php/User/login">Ingresar <i
                                    class="fas fa-sign-in-alt"></i></a>
                        <!--<a class="top_boton" href="<?php echo base_url() ?>User/registro">Registrarse <i
                                    class="fas fa-user-plus"></i></a>-->
                    <?php } ?>

                    <a href="#"><i class="fas fa-search"></i></a>
                    <a href="<?php echo base_url(); ?>index.php/carrito/ver"><i class="fas fa-shopping-cart"></i></a>
                    <span class="badge badge-info"><?php echo $ci->cart->total_items(); ?></span>

                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <?php echo $this->section('header_banner') ?>
    <!-- /.content-wrapper -->
</header>
<!-- Content Wrapper. Contains page content -->
<?php echo $this->section('page_content') ?>
<!-- /.content-wrapper -->

<footer>
    <div id="fondo_footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-1">
                    <p>
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo-blanco.png" class="img-fluid">
                    </p>
                </div>
                <div class="col-12 col-md-7">
                    <h3>Contacto</h3>
                    <p>
                        8 avenida 17-17 Zona 1, Ciudad de Guatemala
                    </p>
                    <p>
                        PBX: (502)22148900
                        <br>
                    </p>
                    <p>
                        <a class="btn btn-success" role="button" aria-pressed="true" href="https://wa.me/50259319442"
                           target="_blank"> <i class="fa fa-whatsapp"></i> Chatea con nosotros</a>
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
                <div class="col-12 col-md-4">
                    Suscribete
                    <br>
                    Para recibir información de nuestros
                    productos nuevos
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email, mantente actualizado"
                               aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" id="button-addon2">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" id="copy_row">
                <div class="col">
                    <h4 id="copy" class="gothic">© <?php echo date("Y"); ?> Jumbo derechos
                        reservados</h4>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<!-- Código de instalación Cliengo para https://corporacionjumbo.com/new/ -->
<script type="text/javascript">(function () {
        var ldk = document.createElement('script');
        ldk.type = 'text/javascript';
        ldk.async = true;
        ldk.src = 'https://s.cliengo.com/weboptimizer/5e862acee4b07bd91f6ace0f/5e862ad1e4b07bd91f6ace12.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ldk, s);
    })();</script>
<?php echo $this->section('js_p') ?>
</body>
</html>
