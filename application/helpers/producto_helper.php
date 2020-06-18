<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 11:56 PM
 */



function nombre_de_producto_por_codigo($producto_id){
    $ci =& get_instance();
    $datos_de_producto = $ci->Productos_model->get_info_producto($producto_id);
    if($datos_de_producto){
        $datos_de_producto = $datos_de_producto->row();
    }
    return $datos_de_producto;
}

?>