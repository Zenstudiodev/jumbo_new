<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 1/06/2017
 * Time: 4:09 PM
 */
if ($banner_data) {
    $banner = $banner_data->row();
}
?>
<?php $this->layout('admin/admin_master',
    array(
        'menu' => $menu
    ));

$hoy = New DateTime();
$fecha_vencimiento_sugerida = New DateTime();
$fecha_vencimiento_sugerida->modify('+ 30 days');


?>
<?php $this->start('css_p') ?>

<?php $this->stop() ?>


<?php $this->start('page_content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h5>Datos del banner</h5>

            <?php echo form_open_multipart(base_url() . 'index.php/admin/guardar_catalogo' );?>
            <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" placeholder="Titulo" value="" id="titulo" name="titulo" required/>
                </div>
                <div class="form-group">
                    <label for="link">Link :</label>
                    <input type="url" class="form-control" placeholder="Link" value="" id="link" name="link" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>


            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>


<?php $this->start('js_p') ?>

<?php $this->stop() ?>
