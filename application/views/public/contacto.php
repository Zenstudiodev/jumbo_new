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

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <!--<img src="<?php echo base_url() ?>/ui/public/imagenes/banner_contacto.jpg" class="img-fluid">-->
                <h2 id="productos_recomendados">NUESTRAS SUCURSALES<br>
                    <!--<small class="text-muted">!VISITANOS¡</small>-->
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1623.1167184174906!2d-90.51360728593237!3d14.630725401953791!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3bb3c3a2b769d74!2sAlmacen%20Jumbo%20S.A.!5e0!3m2!1ses-419!2sgt!4v1589318147600!5m2!1ses-419!2sgt"
                        frameborder="0"
                        aria-hidden="false" tabindex="0" class="mapa_contacto"></iframe>
                <h2 id="productos_recomendados">CENTRAL</h2>
                <p class="text-center"><a class="btn btn-success" href="https://www.waze.com/ul?ll=14.63115000%2C-90.51290300&navigate=yes" target="_blank"><i class="fab fa-waze"></i> Ver en Waze</a></p>
                <p class="direccion_contacto">
                    8 Av. 17-17 zona 1<br>
                    <b>Tel: 2214-8900</b><br>
                    <small>
                        Parqueo: 8AV. 16-28 Zona 1
                    </small>
                </p>
            </div>
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1623.1167184174906!2d-90.51360728593237!3d14.630725401953791!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3bb3c3a2b769d74!2sAlmacen%20Jumbo%20S.A.!5e0!3m2!1ses-419!2sgt!4v1589318147600!5m2!1ses-419!2sgt"
                        frameborder="0"
                        aria-hidden="false" tabindex="0" class="mapa_contacto"></iframe>
                <h2 id="productos_recomendados">RESALTA</h2>
                <p class="text-center"><a class="btn btn-success" href="https://www.waze.com/ul?ll=14.62909000%2C-90.51813800&navigate=yes" target="_blank"><i class="fab fa-waze"></i> Ver en Waze</a></p>
                <p class="direccion_contacto">
                    Av. Bolívar 20-64 zona 1<br>
                    <b>Tel: 2221-2867</b><br>
                    <small>
                        Parqueo: propio
                    </small>
                </p>
            </div>
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1623.1167184174906!2d-90.51360728593237!3d14.630725401953791!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3bb3c3a2b769d74!2sAlmacen%20Jumbo%20S.A.!5e0!3m2!1ses-419!2sgt!4v1589318147600!5m2!1ses-419!2sgt"
                        frameborder="0"
                        aria-hidden="false" tabindex="0" class="mapa_contacto"></iframe>
                <h2 id="productos_recomendados">ZONA 11</h2>
                <p class="text-center"><a class="btn btn-success" href="https://www.waze.com/ul?ll=14.62909000%2C-90.51813800&navigate=yes" target="_blank"><i class="fab fa-waze"></i> Ver en Waze</a></p>
                <p class="direccion_contacto">
                    Diagonal 20 9-38 zona. 11 colonia Mariscal<br>
                    <b>Tel: 2433-9449</b><br>
                    <small>
                        Parqueo: propio
                    </small>
                </p>
            </div>
            <div class="col-12 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1623.1167184174906!2d-90.51360728593237!3d14.630725401953791!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3bb3c3a2b769d74!2sAlmacen%20Jumbo%20S.A.!5e0!3m2!1ses-419!2sgt!4v1589318147600!5m2!1ses-419!2sgt"
                        frameborder="0"
                        aria-hidden="false" tabindex="0" class="mapa_contacto"></iframe>
                <h2 id="productos_recomendados">Central Promocionales</h2>
                <p class="text-center"><a class="btn btn-success" href="https://www.waze.com/ul?ll=14.63115000%2C-90.51290300&navigate=yes" target="_blank"><i class="fab fa-waze"></i> Ver en Waze</a></p>
                <p class="direccion_contacto">
                    8av.17-11 zona 1<br>
                    <b>Tel: 2433-9449</b><br>
                    <small>
                        Parqueo: propio
                    </small>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 id="productos_recomendados">CONTACTO<br>
                    <!--<small class="text-muted">!SERA UN GUSTO ATENDERTE¡</small>-->
                </h2>
                <div class="form_contacto_container">
                    <form action="<?php echo base_url()?>index.php/Empresa/enviar_formulario_contacto" method="post">
                        <div class="form-group">
                            <label for="nombre_contacto">Nombre</label>
                            <input type="nombre" class="form-control" id="nombre_contacto" name="nombre_contacto" required>
                        </div>
                        <div class="form-group">
                            <label for="correo_contacto">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo_contacto" name="correo_contacto" required>
                        </div>
                        <div class="form-group">
                            <label for="mensaje_contacto">Mensajes</label>
                            <textarea class="form-control " id="mensaje_contacto" name="mensaje_contacto" placeholder="Mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>




