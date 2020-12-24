<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 1/06/2017
 * Time: 4:09 PM
 */
?>
<?php $this->layout('admin/admin_master',
    array(
        //'menu' => $menu
    ));
?>
<?php $this->start('css_p') ?>
<!--cargamos css personalizado-->

<?php $this->stop() ?>


<?php $this->start('page_content') ?>


<div id="content">
    <a href="<?php echo base_url()?>index.php/admin/crear_catalogo" class="btn btn-success">Nuevo</a>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <?php if ($catalogos_list){ ?>

                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Listado de Banners</h5>
                    </div>

                    <?php
                   // print_contenido($catalogos_list);
                    echo 'print';
                    ?>

                    <div class="widget-content nopadding">

                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>accion</th>
                                    <th>Titulo</th>
                                    <th>Link</th>
                                    <th>editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($catalogos_list->result() as $catalgo) {
                                    ?>
                                    <tr class="gradeX">
                                        <td> <a class="btn btn-danger" href="<?php echo base_url().'admin/borrar_catalogo/'.$catalgo->catalogo_id?>">Borrar catalogo</a> </td>
                                        <td><?php echo  $catalgo->titulo?></td>
                                        <td><?php echo  $catalgo->link?></td>

                                        <td >
                                            <a class="btn btn-success" href="<?php echo base_url().'admin/editar_catalogo/'.$catalgo->catalogo_id?>">Editar</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                    <?php
                } else {
                    echo 'Aun no hay banners';
                } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>


<?php $this->start('js_p') ?>

<?php $this->stop() ?>
