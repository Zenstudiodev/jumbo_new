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
                <div class="col-9 col-md-10 order-3 order-sm-2 align-self-center main_menu_col">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>index.php/empresa/quienes_somos">Quienes
                                        somos</a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="<?php /*echo base_url() */?>index.php/productos">Productos</a>
                                </li>-->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url() ?>index.php/empresa/contacto">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <?php
                                    if ($ci->ion_auth->logged_in()) { ?>
                                        <!--<a class="top_boton" href="<?php echo base_url() ?>User/perfil">Perfil <i
                                        class="fas fa-sign-in-alt"></i></a>-->
                                        <a class="nav-link" href="<?php echo base_url() ?>index.php/auth/logout">Cerrar <i
                                                    class="fas fa-sign-in-alt"></i></a>
                                    <?php } else { ?>
                                        <a class="nav-link" href="<?php echo base_url() ?>index.php/User/login">Ingresar <i
                                                    class="fas fa-sign-in-alt"></i></a>
                                        <!--<a class="top_boton" href="<?php echo base_url() ?>User/registro">Registrarse <i
                                    class="fas fa-user-plus"></i></a>-->
                                    <?php } ?>
                                </li>
                                <li class="nav-item">
                                    <a href="#"><i class="fas fa-search"></i></a>
                                    <a href="<?php echo base_url(); ?>index.php/carrito/ver"><i class="fas fa-shopping-cart"></i></a>
                                    <span class="badge badge-info"><?php echo $ci->cart->total_items(); ?></span>
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
<!-- Content Wrapper. Contains page content -->
<?php echo $this->section('page_content') ?>
<!-- /.content-wrapper -->

<footer>
    <div id="fondo_footer">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-12 col-md-2">
                    <p>
                        <img src="<?php echo base_url() ?>/ui/public/imagenes/logo-blanco.png" class="img-fluid" id="logo_footer">
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
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/instagram.png" class="iconos_footer">
                        </a>
                        <a href="https://www.facebook.com/JumboGuatemala/" target="_blank">
                            <img src="<?php echo base_url() ?>/ui/public/imagenes/facebook_logo.png" class="iconos_footer">
                        </a>
                        <a class="telefono_footer" role="button" aria-pressed="true" href="https://wa.me/50256921011"
                           target="_blank"> <img src="<?php echo base_url() ?>/ui/public/imagenes/whatsapp.png" class="iconos_footer"> 56921011</a>
                    </p>
                </div>
                <div class="col-12 col-md-3">
                   <p>
                      <span id="suscribirse_t">Suscribete</span>
                       <br>
                       Para recibir información de<br>
                       productos nuevos
                    <br>
                       <!-- Begin Mailchimp Signup Form -->
                       <link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
                       <style type="text/css">
                           #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                           /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                              We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                       </style>
                    <form action="https://corporacionjumbo.us2.list-manage.com/subscribe/post?u=68a1f76b97cdd7dd4028f47cb&amp;id=c67738ffdf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div class="input-group mb-3">


                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email " class="form-control" required>
                        <div class="input-group-append">
                            <input type="submit" value="Subscribete" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-secondary">

                        </div>
                    </div>
                    <div id="mc_embed_signup">



                            <div id="mc_embed_signup_scroll">
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_68a1f76b97cdd7dd4028f47cb_c67738ffdf" tabindex="-1" value=""></div>
                                <div class="clear"></div>
                            </div>

                    </div>
                    </form>

                    <!--End mc_embed_signup-->




                    <h4 id="copy" class="gothic">© <?php echo date("Y"); ?> Jumbo derechos reservados</h4>
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
<!--Jivo Chat-->
<script src="//code.jivosite.com/widget/zl58Kwq5m6" async></script>
<?php echo $this->section('js_p') ?>
<script>
    $(document).ready(function () {
        $('#mce-EMAIL').addClass("form-control");
    });

    // Check that service workers are supported
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/jumbo_sw.js');
        });
    }
</script>
</body>
</html>
