<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 21/09/2020
 * Time: 12:14
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
                <h2><?php echo $linea; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert alert-info" role="alert">
                    La imagen debe tener el mismo alto que ancho ej. 64 x 64 px al subirla se convertira a 32x 32px
                </div>
                <?php echo form_open_multipart(base_url() . 'index.php/admin/guardar_icono_linea'); ?>
                <input type="hidden" name="linea" value="<?php echo $linea?>">
                <div class="form-group">
                    <label for="imagen">Imagen :</label>
                    <div class="controls">
                        <input type="file" class="form-control" value="" id="imagen" name="imagen"
                               accept=".image/jpeg,.jpg, .png" required/>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </form>
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