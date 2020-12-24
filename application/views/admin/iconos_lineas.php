<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 21/09/2020
 * Time: 10:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('admin/admin_master');
$se_puede_asignar = true;

if ($productos_portada) {
    if ($productos_portada->num_rows() > 8) $se_puede_asignar = false;
}
?>

<?php $this->start('css_p') ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>/ui/lib/datatables/datatables.min.css">
<?php $this->stop() ?>

<?php $this->start('header_banner') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h2>Iconos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    <?php
                    if ($lineas_productos) {
                        foreach ($lineas_productos->result() as $linea) { ?>
                            <li class="list-group-item nombre_lineas_menu list-group-item-secondary"><?php echo mb_strtolower($linea->producto_linea); ?>

                                <?php if (linea_tiene_icono($linea->producto_linea)) { ?>
                                    <img src="<?php echo get_icono_linea($linea->producto_linea); ?>" class="icono_lineas">
                                    <!--<a class="btn btn-info" href="#">Actualizar icono</a>-->
                                    <a class="btn btn-danger" href="<?php echo base_url().'index.php/admin/borrar_icono_linea/'.$linea->producto_linea; ?>">Borrar icono</a>



                                <?php } else { ?>
                                    <a class="btn btn-success" href="<?php echo base_url().'index.php/admin/asignar_icono_linea/'.$linea->producto_linea; ?>">Asignar icono </a>
                                <?php } ?>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <hr>

    </div>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
    <script src="<?php echo base_url() ?>/ui/lib/datatables/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#en_portada').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });
            $('#no_portada').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });
        });
    </script>
<?php $this->stop() ?>