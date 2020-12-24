<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');


$ci =& get_instance();
?>

<?php $this->start('css_p') ?>
<?php header("HTTP/1.0 404 Not Found");  ?>
    <title>404</title>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>
<div class="jumbotron">
    <h1 class="display-4">404</h1>
    <p class="lead">la pagina que busca no existe </p>
    <hr class="my-4">
    <?php
    //print_contenido(get_headers(current_url()));
    ?>
    <a class="btn btn-primary btn-lg" href="<?php echo base_url();?>" role="button">Ir al inicio</a>
</div>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>

