<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 10/09/2020
 * Time: 13:45
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
            <h2>Productos en portada</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <?php if ($productos_portada) { ?>
                <div class="table-responsive">
                    <table id="en_portada" class="display table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Línea</th>
                            <th>Categoría</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($productos_portada->result() as $producto) { ?>

                            <tr>
                                <td><?php echo $producto->producto_nombre; ?></td>
                                <td><?php echo $producto->producto_codigo; ?></td>
                                <td><?php echo $producto->producto_linea; ?></td>
                                <td><?php echo $producto->producto_categoria; ?></td>
                                <td>
                                    <a class="btn btn-danger"
                                       href="<?php echo base_url() . 'index.php/admin/quitar_portada/' . $producto->producto_codigo; ?>">Quitar de portada</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Línea</th>
                            <th>Categoría</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <h3>No hay productos</h3>
                </div>
            <?php } ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">

            <?php if ($productos_no_portada) { ?>
                <div class="table-responsive">
                    <table id="no_portada" class="display table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Línea</th>
                            <th>Categoría</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($productos_no_portada->result() as $producto) { ?>

                            <tr>
                                <td><?php echo $producto->producto_nombre; ?></td>
                                <td><?php echo $producto->producto_codigo; ?></td>
                                <td><?php echo $producto->producto_linea; ?></td>
                                <td><?php echo $producto->producto_categoria; ?></td>
                                <td>
                                    <?php if ($se_puede_asignar) { ?>
                                    <a class="btn btn-success"
                                       href="<?php echo base_url() . 'index.php/admin/asignar_portada/' . $producto->producto_codigo; ?>">Asignar a portada</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Línea</th>
                            <th>Categoría</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <h3>No hay productos</h3>
                </div>
            <?php } ?>
        </div>
    </div>
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
