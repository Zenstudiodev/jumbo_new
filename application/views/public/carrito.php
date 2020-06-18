<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 12:05 PM
 */


$this->layout('public/public_master');
$ci =& get_instance();
?>



<?php $this->start('page_content') ?>
<div class="container">
    <br>
    <h1>carro de compras</h1>

    <?php if($ci->cart->contents()){?>

    <?php echo form_open(base_url().'index.php/carrito/actualizar'); ?>
    <div class="table-responsive">
        <table class="table">

            <tr>
                <th>Cantidad</th>
                <th>Nombre de producto</th>
                <th>Código</th>
                <th style="text-align:right">Precio producto</th>
                <th style="text-align:right">Sub-Total</th>
            </tr>

            <?php $i = 1; ?>

            <?php
            //print_contenido($ci->cart->contents());
            //echo 'numero de items'. $ci->cart->total_items();
            ?>

            <?php foreach ($contenido_carrito as $items): ?>
                <?php //print_contenido($items)?>

                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                <tr>
                    <td><?php echo form_input(array('type' => 'number', 'name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'class'=>'form-control')); ?></td>
                    <td>
                        <?php $datos_producto = nombre_de_producto_por_codigo($items['id']);
                        //print_contenido($datos_producto);
                        ?>
                        <?php echo $datos_producto->producto_nombre; ?>

                        <?php if ($ci->cart->has_options($items['rowid']) == TRUE): ?>
                            <p>
                                <?php foreach ($ci->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?> <?php echo $option_value; ?><br />

                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $datos_producto->producto_codigo; ?>
                    </td>

                    <td style="text-align:right"><?php echo $ci->cart->format_number($items['price']); ?></td>
                    <td style="text-align:right">Q.<?php echo $ci->cart->format_number($items['subtotal']); ?></td>
                </tr>

                <?php $i++; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="2"> </td>
                <td class="right"><strong>Total</strong></td>
                <td class="right">Q.<?php echo $ci->cart->format_number($ci->cart->total()); ?></td>
            </tr>

        </table>
            </div>
    <p><?php echo form_submit('', 'Actualizar Carrito',array('class'=>'btn btn-info') ); ?></p>
    <!--<div class="row">
        <div class="col">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h2><strong>Políticas de envío</strong></h2>
                <p>You should check in on some of those fields below.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>-->
<hr>
    <p><a class="btn btn-success" href="<?php echo base_url()?>index.php/Productos/crear_predido">Generar pedido</a></p>
</div>
<?php }else{ ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h2><strong>Carro vacio</strong></h2>
                <p>Agregue productos a su carro para generar un pedido.</p>
                <a class="btn btn-success" href="<?php echo base_url()?>index.php/Productos/">Ver productos</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<?php $this->stop() ?>