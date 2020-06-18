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
                <img src="<?php echo base_url() ?>/ui/public/imagenes/banner_quienes_somos.jpg" class="img-fluid">
                <h3>QUE SOMOS</h3>
               <p> Somos una Corporación con más de 40 años en el mercado, integrado por nuestras diferentes unidades de
                negocios, Jumbo Internacional, Almacén Jumbo, Jumbo Promocionales, Resalta Promo, Decofiestas y Éxito
                Impresiones; enfocados en generar negocios comerciales rentables para los diferentes segmentos del
                mercado nacional e internacional.</p>

                <h3>VISIÓN</h3>
                <p>Ser la empresa líder en Centro América, en la comercialización de productos y servicios que generen un
                    valor agregado a nuestros clientes.</p>

                <h3>MISIÓN</h3>
                <p>Somos una Corporación generadora de ideas y proyectos innovadores, que puedan satisfacer las necesidades
                de nuestros clientes de manera rentable, garantizando un servicio con valor relevante y brindando
                oportunidades de crecimiento para nuestros colaboradores, así como un desarrollo sostenible para la
                    región.</p>

                <h3>VALORES</h3>
                <ul>
                    <li>Integridad</li>
                    <li>Responsabilidad</li>
                    <li>Transparencia</li>
                    <li>Disposición al cambio</li>
                    <li>Conciencia social y ecológica</li>
                </ul>

            </div>
        </div>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>




