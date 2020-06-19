<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 18/06/2020
 * Time: 12:29 PM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');

$ci =& get_instance();
?>

<?php $this->start('css_p') ?>

<?php $this->stop() ?>

<?php $this->start('page_content') ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Pagar pedido</h3>
            </div>
        </div>
        <hr>
        <form method="post" action="<?php echo base_url()?>index.php/productos/procesar_pago">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Datos de pago</h3>
                    </div>
                    <div class="card-body">

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="numero_tarjeta">Número de tarjeta </label>
                                        <input type="number" class="form-control" id="numero_tarjeta" name="numero_tarjeta" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleInputPassword1">Expira</label>
                                    <label for="mes_vencimiento_tarjeta">Expira</label>
                                    <select class="form-control" name="mes_vencimiento_tarjeta" id="mes_vencimiento_tarjeta">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="ano_vencimiento_tarjeta"> .</label>
                                    <select class="form-control" name="ano_vencimiento_tarjeta" id="ano_vencimiento_tarjeta">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cvv_tarjeta">CVV</label>
                                        <input type="number" class="form-control" id="cvv_tarjeta" name="cvv_tarjeta" required>
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Datos de pedido</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <table class="table">
                            <?php
                            //print_contenido($productos_pedido);
                            //print_contenido($datos_pedido);

                            foreach ($productos_pedido as $producto) { ?>
                                <tr>
                                    <td>producto:</td>
                                    <td> <?php echo  $producto->codigo_producto?></td>
                                </tr>
                                <tr>
                                    <td><?php echo  $producto->cantidad_producto?> x <?php echo  $producto->precio_producto; ?> </td>
                                    <?php $total_producto = intval($producto->cantidad_producto) * floatval ($producto->precio_producto) ;?>
                                    <td><?php echo  $total_producto; ?></td>
                                </tr>
                            <?php } ?>


                            <tr class="table-dark">
                                <td>Total Pedido:</td>
                                <td>Q.<?php echo  $datos_pedido->total_pedido; ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="hidden" name="pedido_id" value="<?php echo  $datos_pedido->id_pedido; ?>">
                <button type="submit" class="btn btn-success btn-lg">Pagar</button>
            </div>
        </div>
        </form>
    </div>
</section>


<?php $this->stop() ?>
<?php $this->start('js_p') ?>

<script>
    var codigo_producto;
    var cantidad_producto;

    $("#agregar_al_carrito").click(function () {

        var inpObj = document.getElementById("cantidad_producto");
        if (inpObj.checkValidity()) {
            console.log('valido');
            codigo_producto = '<?php echo $producto->producto_codigo;?>';
            cantidad_producto = $("#cantidad_producto").val();
            console.log('agregar ' + cantidad_producto + ' de producto ' + codigo_producto);

            window.location = "<?php echo base_url()?>index.php/carrito/agregar_producto/" + codigo_producto + "/" + cantidad_producto;
        } else {
            console.log('invalido');

        }


    });
</script>
<?php $this->stop() ?>


